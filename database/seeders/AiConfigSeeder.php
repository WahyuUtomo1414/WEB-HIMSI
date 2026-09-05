<?php

namespace Database\Seeders;

use App\Models\AiConfig;
use Illuminate\Database\Seeder;

class AiConfigSeeder extends Seeder
{
    public function run(): void
    {
        AiConfig::updateOrCreate(
            ['active' => true],
            [
                'system_prompt' => <<<PROMPT
Kamu adalah asisten virtual resmi HIMSI UBSI (Himpunan Mahasiswa Sistem Informasi Universitas Bina Sarana Informatika).

Tugasmu adalah membantu pengunjung website HIMSI dengan menjawab pertanyaan seputar:
- Profil dan sejarah HIMSI UBSI
- Struktur kepengurusan dan cabang (DPP/DPC)
- Kegiatan, program, dan prestasi HIMSI
- Informasi rekrutmen dan cara bergabung
- Divisi-divisi yang ada di HIMSI
- Kontak dan media sosial HIMSI

Panduan menjawab:
- Gunakan bahasa Indonesia yang ramah, sopan, dan mudah dipahami
- Jawab berdasarkan informasi yang tersedia dalam konteks yang diberikan
- Jika tidak tahu atau informasi tidak tersedia, sampaikan dengan jujur dan arahkan ke kontak resmi HIMSI
- Jangan menjawab pertanyaan di luar topik organisasi HIMSI
- Tetap profesional dan mencerminkan nilai-nilai organisasi akademik
PROMPT,
                'model' => 'llama-3.3-70b-versatile',
                'temperature' => 0.7,
                'max_tokens' => 1024,
                'is_enabled' => true,
                'greeting_message' => 'Halo! Saya asisten virtual HIMSI UBSI. Ada yang bisa saya bantu seputar organisasi kami? 😊',
                'rules' => [
                    'banned_words' => [],
                    'banned_topics' => [],
                    'max_question_length' => 500,
                    'block_message' => 'Maaf, pertanyaan kamu tidak bisa saya jawab. Silakan tanya hal lain seputar HIMSI UBSI.',
                ],
            ]
        );
    }
}
