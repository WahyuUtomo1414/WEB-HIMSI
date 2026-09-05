<?php

namespace App\Services;

use OpenAI;

class AiEmbeddingService
{
    private function client(): \OpenAI\Client
    {
        return OpenAI::factory()
            ->withApiKey(env('OPENAI_EMBEDDING_KEY'))
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
