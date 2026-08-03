<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        $missions = [
            'Meningkatkan kontribusi HIMSI kepada lingkungan kampus serta masyarakat luas, terutama di bidang Sistem Informasi.',
            'Menciptakan prestasi akademik dan non-akademik yang kreatif serta inovatif dari berbagai aspek.',
            'Menanamkan sikap disiplin dan bertanggung jawab dalam berorganisasi kepada setiap anggota.',
            'Menyalurkan dan mengembangkan minat serta bakat setiap anggota.',
            'Menjalin hubungan baik dan kerja sama dengan organisasi lainnya serta menjaga nama baik Himpunan dan Almamater.',
        ];

        $socialMedia = [
            'instagram' => 'https://instagram.com/himsi.ubsi',
            'youtube' => 'https://youtube.com/@himsiubsi',
            'linkedin' => 'https://linkedin.com/company/himsiubsi',
            'tiktok' => 'https://tiktok.com/@himsiubsi',
            'facebook' => '',
            'wa' => '',
            'email' => 'himsi@bsi.ac.id',
        ];

        Organization::updateOrCreate(
            ['kode_org' => 'HIMSI UBSI'],
            [
                'name' => 'Himpunan Mahasiswa Sistem Informasi',
                'logo' => 'https://picsum.photos/seed/himsi-logo/600/600',
                'thumbnail' => 'https://picsum.photos/seed/himsi-organization/1200/800',
                'description' => 'HIMSI UBSI adalah organisasi mahasiswa Program Studi Sistem Informasi yang menjadi ruang pengembangan potensi akademik, teknologi, kepemimpinan, dan kolaborasi mahasiswa. Organisasi ini berperan sebagai wadah aspirasi, kreativitas, serta penguatan kompetensi mahasiswa agar mampu beradaptasi dengan kebutuhan dunia digital.',
                'mision' => array_map(
                    fn (string $mission): array => ['value' => $mission],
                    $missions,
                ),
                'vision' => 'Menjadikan HIMSI sebagai himpunan yang kreatif, kompetitif, bertanggung jawab, dan berwawasan global pada tahun 2025.',
                'purpose' => 'HIMSI UBSI Berfungsi sebagai wadah untuk mewujudkan ide-ide kreatif Mahasiswa wadah aspirasi Mahasiswa Sistem Informasi Universitas Bina Sarana Informatika untuk pengembangan diri dan Himpunan Mahasiswa Sistem Informasi (HIMSI).',
                'address' => 'Jl. Kamal Raya Ringroad No.18 RT06/RW03 Cengkareng, Jakarta Barat11730',
                'sosial_media' => $socialMedia,
                'email' => 'himsi@bsi.ac.id',
                'no_tlpn' => '081234567890',
                'active' => true,
            ],
        );
    }
}
