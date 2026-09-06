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

        if (! empty($entityContext['organization'])) {
            $org = $entityContext['organization'];
            $parts[] = "\n\n=== DATA ORGANISASI (REALTIME) ===";
            $parts[] = "Nama: {$org['name']}";
            if ($org['description']) {
                $parts[] = "Deskripsi: " . mb_substr($org['description'], 0, 300);
            }
            if ($org['vision']) {
                $parts[] = "Visi: {$org['vision']}";
            }
            if (! empty($org['missions'])) {
                $parts[] = "Misi:";
                foreach ($org['missions'] as $m) {
                    $parts[] = "- {$m}";
                }
            }
            if ($org['address']) {
                $parts[] = "Alamat: {$org['address']}";
            }
            if ($org['email']) {
                $parts[] = "Email: {$org['email']}";
            }
            if ($org['no_tlpn']) {
                $parts[] = "Telepon: {$org['no_tlpn']}";
            }
            if (! empty($org['sosial_media'])) {
                $parts[] = "Media Sosial: " . implode(', ', $org['sosial_media']);
            }
            if (! empty($org['stats'])) {
                $parts[] = "Statistik: " . implode(', ', $org['stats']);
            }
        }

        if (! empty($entityContext['branch'])) {
            $branch = $entityContext['branch'];
            $parts[] = "\n\n=== DATA CABANG (REALTIME) ===";
            $parts[] = "Nama: {$branch['name']}";
            $parts[] = "Lokasi: {$branch['location']}";
            $parts[] = "Sektor: {$branch['sektor']}";
            $parts[] = "Tipe: {$branch['is_dpp']}";
            if ($branch['description']) {
                $parts[] = "Deskripsi: " . mb_substr($branch['description'], 0, 400);
            }
            if ($branch['grup_wa']) {
                $parts[] = "Grup WA: {$branch['grup_wa']}";
            }
            if (! empty($entityContext['branch_structure'])) {
                $parts[] = "Kepengurusan:";
                foreach ($entityContext['branch_structure'] as $s) {
                    $line = "- {$s['position']}: {$s['name']}";
                    if ($s['no_wa']) {
                        $line .= " (WA: {$s['no_wa']})";
                    }
                    $parts[] = $line;
                }
            }
        }

        if (! empty($entityContext['divisions'])) {
            $parts[] = "\n\n=== DATA DIVISI (REALTIME) ===";
            foreach ($entityContext['divisions'] as $div) {
                $parts[] = "Divisi {$div['name']} ({$div['level']}):";
                if ($div['description']) {
                    $parts[] = mb_substr($div['description'], 0, 300);
                }
            }
        }

        if (! empty($entityContext['blogs'])) {
            $label = ! empty($entityContext['branch'])
                ? "Kegiatan terbaru {$entityContext['branch']['name']}:"
                : "Kegiatan / blog terbaru HIMSI:";
            $parts[] = "\n{$label}";
            foreach ($entityContext['blogs'] as $blog) {
                $parts[] = "- {$blog['title']} ({$blog['date']})";
            }
        }

        if (! empty($entityContext['faqs'])) {
            $parts[] = "\n\n=== FAQ HIMSI ===";
            foreach ($entityContext['faqs'] as $faq) {
                $parts[] = "Q: {$faq['question']}";
                $parts[] = "A: {$faq['answer']}";
            }
        }

        if (! empty($entityContext['milestones'])) {
            $parts[] = "\n\n=== PENCAPAIAN / MILESTONE ===";
            foreach ($entityContext['milestones'] as $m) {
                $parts[] = "- {$m}";
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
