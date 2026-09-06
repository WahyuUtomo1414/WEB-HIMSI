<?php

namespace App\Services;

class AiGuardService
{
    public function check(string $question, array $rules): ?string
    {
        $maxLength = (int) ($rules['max_question_length'] ?? 500);
        $blockMessage = $rules['block_message'] ?? 'Maaf, pertanyaan kamu tidak bisa saya jawab. Silakan tanya hal lain seputar HIMSI.';

        if (mb_strlen($question) > $maxLength) {
            return $blockMessage;
        }

        foreach ($rules['banned_words'] ?? [] as $word) {
            if ($word && mb_stripos($question, $word) !== false) {
                return $blockMessage;
            }
        }

        foreach ($rules['banned_topics'] ?? [] as $topic) {
            if ($topic && mb_stripos($question, $topic) !== false) {
                return $blockMessage;
            }
        }

        return null;
    }
}
