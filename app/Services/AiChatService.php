<?php

namespace App\Services;

use App\Models\AiChatLog;
use App\Models\AiConfig;
use OpenAI\Laravel\Facades\OpenAI;

class AiChatService
{
    public function __construct(
        private AiGuardService $guard,
        private AiEmbeddingService $embedding,
        private AiKnowledgeService $knowledge,
        private AiEntityService $entity,
    ) {}

    public function chat(string $question, string $sessionId, array $history, string $ip): array
    {
        $config = AiConfig::query()->where('active', true)->where('is_enabled', true)->first();

        if (! $config) {
            return ['answer' => 'Asisten AI sedang tidak tersedia.', 'blocked' => false];
        }

        // 1. Guard
        $blocked = $this->guard->check($question, $config->rules ?? []);
        if ($blocked) {
            return ['answer' => $blocked, 'blocked' => true];
        }

        // 2. Entity detection
        $entityContext = $this->entity->resolve($question);

        // 3. RAG
        $ragChunks = [];
        $sourcesUsed = [];
        try {
            $questionEmbedding = $this->embedding->embed($question);
            $ragChunks = $this->knowledge->retrieveChunks($questionEmbedding);
            $sourcesUsed = array_column($ragChunks, 'content');
        } catch (\Throwable) {
            // embedding gagal tidak boleh stop chat
        }

        // 4. Prompt assembly
        $systemMessage = $this->buildSystemMessage($config->system_prompt, $ragChunks, $entityContext);

        $messages = [['role' => 'system', 'content' => $systemMessage]];

        foreach (array_slice($history, -6) as $msg) {
            if (isset($msg['role'], $msg['content'])) {
                $messages[] = ['role' => $msg['role'], 'content' => $msg['content']];
            }
        }

        $messages[] = ['role' => 'user', 'content' => $question];

        // 5. Call LLM
        $response = OpenAI::chat()->create([
            'model' => $config->model,
            'messages' => $messages,
            'temperature' => $config->temperature,
            'max_tokens' => $config->max_tokens,
        ]);

        $answer = $response->choices[0]->message->content ?? 'Maaf, saya tidak dapat memberikan respons saat ini.';

        // 6. Log
        AiChatLog::create([
            'session_id' => $sessionId,
            'question' => $question,
            'answer' => $answer,
            'sources_used' => $sourcesUsed ?: null,
            'entity_context' => $entityContext ?: null,
            'model' => $config->model,
            'ip_address' => $ip,
        ]);

        return ['answer' => $answer, 'blocked' => false];
    }

    private function buildSystemMessage(string $systemPrompt, array $ragChunks, array $entityContext): string
    {
        $parts = [$systemPrompt];

        if (! empty($entityContext)) {
            $parts[] = "\n\n=== DATA CABANG (REALTIME) ===";
            $branch = $entityContext['branch'];
            $parts[] = "Nama: {$branch['name']}";
            $parts[] = "Lokasi: {$branch['location']}";
            $parts[] = "Sektor: {$branch['sektor']}";
            $parts[] = "Tipe: {$branch['is_dpp']}";
            if ($branch['description']) {
                $parts[] = "Deskripsi: " . mb_substr($branch['description'], 0, 500);
            }
            if ($branch['grup_wa']) {
                $parts[] = "Grup WA: {$branch['grup_wa']}";
            }
            if (! empty($entityContext['blogs'])) {
                $parts[] = "\nKegiatan terbaru:";
                foreach ($entityContext['blogs'] as $blog) {
                    $parts[] = "- {$blog['title']} ({$blog['date']})";
                }
            }
        }

        if (! empty($ragChunks)) {
            $parts[] = "\n\n=== KONTEKS PENGETAHUAN ===";
            foreach ($ragChunks as $i => $chunk) {
                $parts[] = "[" . ($i + 1) . "] " . $chunk['content'];
            }
            $parts[] = "\nGunakan konteks di atas sebagai referensi dalam menjawab. Jika informasi tidak ada dalam konteks, sampaikan dengan jujur.";
        }

        return implode("\n", $parts);
    }
}
