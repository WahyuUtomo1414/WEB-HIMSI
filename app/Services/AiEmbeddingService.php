<?php

namespace App\Services;

use OpenAI;

class AiEmbeddingService
{
    private function client(): \OpenAI\Client
    {
        $key = env('OPENAI_EMBEDDING_KEY');

        if (empty($key)) {
            throw new \RuntimeException('OPENAI_EMBEDDING_KEY belum diset di .env');
        }

        return OpenAI::factory()
            ->withApiKey($key)
            ->withBaseUri(env('OPENAI_EMBEDDING_BASE_URI', 'api.openai.com/v1'))
            ->make();
    }

    public function embed(string $text): array
    {
        $response = $this->client()->embeddings()->create([
            'model' => env('AI_EMBEDDING_MODEL', 'text-embedding-3-small'),
            'input' => mb_substr($text, 0, 8000),
        ]);

        return $response->embeddings[0]->embedding;
    }

    public function embedBatch(array $texts): array
    {
        $inputs = array_map(fn ($t) => mb_substr($t, 0, 8000), $texts);

        $response = $this->client()->embeddings()->create([
            'model' => env('AI_EMBEDDING_MODEL', 'text-embedding-3-small'),
            'input' => $inputs,
        ]);

        $embeddings = [];
        foreach ($response->embeddings as $item) {
            $embeddings[$item->index] = $item->embedding;
        }

        ksort($embeddings);

        return array_values($embeddings);
    }

    public function cosineSimilarity(array $a, array $b): float
    {
        $dot = 0.0;
        $normA = 0.0;
        $normB = 0.0;
        $count = count($a);

        for ($i = 0; $i < $count; $i++) {
            $dot += $a[$i] * $b[$i];
            $normA += $a[$i] ** 2;
            $normB += $b[$i] ** 2;
        }

        $denom = sqrt($normA) * sqrt($normB);

        return $denom > 0 ? $dot / $denom : 0.0;
    }
}
