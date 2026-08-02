<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['question' => 'Bagaimana cara bergabung dengan HIMSI UBSI?', 'answer' => 'Mahasiswa Sistem Informasi UBSI dapat bergabung melalui open recruitment yang diumumkan di media sosial atau website HIMSI.'],
            ['question' => 'Siapa saja yang bisa menjadi anggota HIMSI?', 'answer' => 'Seluruh mahasiswa aktif Program Studi Sistem Informasi Universitas Bina Sarana Informatika.'],
            ['question' => 'Ada berapa divisi di HIMSI UBSI?', 'answer' => 'HIMSI memiliki 4 divisi utama: Pendidikan, Kominfo, RSDM, dan Litbang.'],
            ['question' => 'Apa keuntungan menjadi anggota HIMSI?', 'answer' => 'Anggota dapat menyalurkan aspirasi, mengembangkan diri, memperluas relasi, serta berpartisipasi dalam kegiatan akademik maupun non-akademik.'],
            ['question' => 'Apakah ada biaya untuk menjadi anggota HIMSI?', 'answer' => 'Tidak ada biaya pendaftaran, cukup mengikuti seleksi dan berkomitmen aktif dalam kegiatan HIMSI.'],
            ['question' => 'Kegiatan apa saja yang diadakan oleh HIMSI?', 'answer' => 'HIMSI rutin mengadakan seminar, workshop, lomba, bakti sosial, dan kegiatan kebersamaan untuk mempererat solidaritas anggota.'],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                $faq + ['active' => true],
            );
        }
    }
}
