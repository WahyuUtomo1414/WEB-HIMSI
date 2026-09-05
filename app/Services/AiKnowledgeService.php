<?php

namespace App\Services;

use App\Models\AiKnowledgeChunk;
use App\Models\AiKnowledgeSource;
use Illuminate\Support\Facades\Http;
use Smalot\PdfParser\Parser as PdfParser;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AiKnowledgeService
{
    private const CHUNK_SIZE = 2000;
    private const CHUNK_OVERLAP = 200;

    public function __construct(private AiEmbeddingService $embedding) {}

    public function processSource(AiKnowledgeSource $source, bool $force = false): void
    {
        if (! $force && in_array($source->status, ['processing', 'ready'])) {
            return;
        }

        $source->update(['status' => 'processing', 'error_message' => null]);

        try {
            $text = $this->parseContent($source);

            if (blank($text)) {
                throw new \RuntimeException('Konten kosong setelah parsing. Pastikan file atau URL memiliki isi teks.');
            }

            $chunks = $this->splitIntoChunks($text);

            $source->chunks()->delete();

            $rows = [];
            foreach ($chunks as $index => $chunk) {
                $embedding = $this->embedding->embed($chunk);
                $rows[] = [
                    'source_id' => $source->id,
                    'chunk_index' => $index,
                    'content' => $chunk,
                    'embedding' => json_encode($embedding),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            AiKnowledgeChunk::insert($rows);

            $source->update([
                'status' => 'ready',
                'processed_at' => now(),
                'error_message' => null,
            ]);
        } catch (\Throwable $e) {
            $source->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    public function retrieveChunks(array $questionEmbedding, int $topN = 5): array
    {
        $chunks = AiKnowledgeChunk::query()
            ->whereHas('source', fn ($q) => $q->where('is_active', true)->where('status', 'ready')->where('active', true))
            ->get(['id', 'content', 'embedding']);

        if ($chunks->isEmpty()) {
            return [];
        }

        $scored = $chunks->map(function ($chunk) use ($questionEmbedding) {
            $embedding = is_array($chunk->embedding) ? $chunk->embedding : json_decode($chunk->embedding, true);
            return [
                'content' => $chunk->content,
                'score' => $this->embedding->cosineSimilarity($questionEmbedding, $embedding),
            ];
        });

        return $scored
            ->sortByDesc('score')
            ->take($topN)
            ->values()
            ->all();
    }

    private function parseContent(AiKnowledgeSource $source): string
    {
        return match ($source->source_type) {
            'text' => $source->raw_content ?? '',
            'pdf' => $this->parsePdf($source->file_path),
            'excel' => $this->parseExcel($source->file_path),
            'url' => $this->parseUrl($source->file_path),
            default => throw new \RuntimeException("Tipe sumber tidak dikenal: {$source->source_type}"),
        };
    }

    private function parsePdf(string $path): string
    {
        $fullPath = storage_path('app/public/' . $path);

        if (! file_exists($fullPath)) {
            throw new \RuntimeException("File PDF tidak ditemukan: {$path}");
        }

        $parser = new PdfParser();
        $pdf = $parser->parseFile($fullPath);

        return $pdf->getText();
    }

    private function parseExcel(string $path): string
    {
        $fullPath = storage_path('app/public/' . $path);

        if (! file_exists($fullPath)) {
            throw new \RuntimeException("File Excel tidak ditemukan: {$path}");
        }

        $spreadsheet = IOFactory::load($fullPath);
        $lines = [];

        foreach ($spreadsheet->getAllSheets() as $sheet) {
            foreach ($sheet->toArray() as $row) {
                $line = implode(' | ', array_filter(array_map('strval', $row), fn ($v) => $v !== ''));
                if ($line) {
                    $lines[] = $line;
                }
            }
        }

        return implode("\n", $lines);
    }

    private function parseUrl(string $url): string
    {
        $response = Http::timeout(15)->get($url);

        if (! $response->successful()) {
            throw new \RuntimeException("Gagal mengambil konten dari URL: HTTP {$response->status()}");
        }

        return strip_tags($response->body());
    }

    private function splitIntoChunks(string $text): array
    {
        $text = preg_replace('/\s+/', ' ', trim($text));
        $length = mb_strlen($text);
        $chunks = [];
        $offset = 0;

        while ($offset < $length) {
            $chunk = mb_substr($text, $offset, self::CHUNK_SIZE);
            $chunks[] = trim($chunk);
            $offset += self::CHUNK_SIZE - self::CHUNK_OVERLAP;
        }

        return array_filter($chunks, fn ($c) => mb_strlen($c) > 50);
    }
}
