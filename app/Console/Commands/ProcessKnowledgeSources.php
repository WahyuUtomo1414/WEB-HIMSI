<?php

namespace App\Console\Commands;

use App\Models\AiKnowledgeSource;
use App\Services\AiKnowledgeService;
use Illuminate\Console\Command;

class ProcessKnowledgeSources extends Command
{
    protected $signature = 'ai:process-sources
                            {--id= : Proses sumber spesifik berdasarkan ID}
                            {--force : Paksa proses ulang meski status sudah ready}';

    protected $description = 'Proses embedding sumber pengetahuan AI (parse → chunk → embed)';

    public function handle(AiKnowledgeService $service): int
    {
        $force = (bool) $this->option('force');
        $id = $this->option('id');

        if ($id) {
            $source = AiKnowledgeSource::find($id);

            if (! $source) {
                $this->error("Sumber dengan ID {$id} tidak ditemukan.");
                return self::FAILURE;
            }

            return $this->processOne($service, $source, $force);
        }

        $query = AiKnowledgeSource::query()->where('active', true);

        if (! $force) {
            $query->whereIn('status', ['pending', 'failed']);
        }

        $sources = $query->get();

        if ($sources->isEmpty()) {
            $this->info('Tidak ada sumber yang perlu diproses.');
            return self::SUCCESS;
        }

        $this->info("Memproses {$sources->count()} sumber...");

        $success = 0;
        $failed = 0;

        foreach ($sources as $source) {
            $result = $this->processOne($service, $source, $force);
            $result === self::SUCCESS ? $success++ : $failed++;
        }

        $this->newLine();
        $this->info("Selesai. Berhasil: {$success}, Gagal: {$failed}.");

        return $failed > 0 ? self::FAILURE : self::SUCCESS;
    }

    private function processOne(AiKnowledgeService $service, AiKnowledgeSource $source, bool $force): int
    {
        $this->line("  → [{$source->id}] {$source->title}");

        try {
            $service->processSource($source, $force);
            $this->info("    ✓ Berhasil");
            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error("    ✗ Gagal: {$e->getMessage()}");
            return self::FAILURE;
        }
    }
}
