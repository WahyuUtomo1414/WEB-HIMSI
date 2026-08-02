<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        $divisions = [
            [
                'name' => 'Divisi Pendidikan',
                'description' => 'Divisi Pendidikan bertugas mengembangkan kualitas keilmuan dan keterampilan anggota melalui berbagai program pembelajaran. Fokus utama divisi ini adalah menyusun kurikulum, mengadakan kegiatan pelatihan, serta membangun suasana akademik yang kondusif demi meningkatkan kompetensi sumber daya manusia.',
                'jobs' => [
                    'Menyusun kurikulum pelatihan internal',
                    'Mengelola kegiatan belajar mengajar',
                    'Mengadakan seminar, workshop, dan pelatihan rutin',
                ],
            ],
            [
                'name' => 'Divisi Kominfo',
                'description' => 'Divisi Kominfo berperan dalam mengelola komunikasi internal maupun eksternal organisasi. Divisi ini bertanggung jawab menjaga citra organisasi dengan memanfaatkan media sosial, website, dan kanal publikasi lainnya.',
                'jobs' => [
                    'Mengelola media sosial organisasi',
                    'Membuat konten publikasi kreatif',
                    'Mengelola website dan sistem informasi',
                ],
            ],
            [
                'name' => 'Divisi RSDM',
                'description' => 'Divisi RSDM berfokus pada pengelolaan, pembinaan, dan pengembangan anggota. Tugasnya meliputi pengaturan struktur keanggotaan, penempatan posisi, hingga penyediaan program pelatihan untuk mendukung peningkatan soft skill maupun hard skill para anggota.',
                'jobs' => [
                    'Mengelola data dan database anggota',
                    'Menyusun program pengembangan diri',
                    'Mengatur penempatan dan rotasi anggota',
                ],
            ],
            [
                'name' => 'Divisi Litbang',
                'description' => 'Divisi Litbang berfungsi untuk melakukan riset, analisis, serta inovasi demi mendukung keberlanjutan program kerja organisasi. Divisi ini berfokus pada evaluasi kinerja, pencarian solusi kreatif, serta menciptakan terobosan baru yang bermanfaat bagi perkembangan organisasi.',
                'jobs' => [
                    'Melakukan riset dan analisis organisasi',
                    'Mengembangkan inovasi program kerja',
                    'Mengevaluasi efektivitas kegiatan organisasi',
                ],
            ],
        ];

        foreach ($divisions as $division) {
            Division::updateOrCreate(
                ['name' => $division['name']],
                [
                    'logo' => 'https://picsum.photos/seed/'.str($division['name'])->slug().'-logo/600/600',
                    'image' => 'https://picsum.photos/seed/'.str($division['name'])->slug().'/1000/700',
                    'description' => $division['description'],
                    'job_description' => $division['jobs'],
                    'is_dpp' => false,
                    'active' => true,
                ],
            );
        }
    }
}
