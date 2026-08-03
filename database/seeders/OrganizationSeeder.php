<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        Organization::updateOrCreate(
            ['kode_org' => 'HIMSI-UBSI'],
            [
                'name' => 'Himpunan Mahasiswa Sistem Informasi UBSI',
                'logo' => 'https://picsum.photos/seed/himsi-logo/600/600',
                'thumbnail' => 'https://picsum.photos/seed/himsi-organization/1200/800',
                'description' => 'HIMSI UBSI adalah organisasi mahasiswa Program Studi Sistem Informasi yang menjadi ruang pengembangan potensi akademik, teknologi, kepemimpinan, dan kolaborasi mahasiswa. Organisasi ini berperan sebagai wadah aspirasi, kreativitas, serta penguatan kompetensi mahasiswa agar mampu beradaptasi dengan kebutuhan dunia digital.',
                'mision' => [
                    ['value' => 'Meningkatkan kualitas sumber daya mahasiswa Sistem Informasi melalui kegiatan edukatif dan produktif.'],
                    ['value' => 'Membangun budaya organisasi yang aktif, kolaboratif, dan bertanggung jawab.'],
                    ['value' => 'Mengembangkan program kerja yang relevan dengan teknologi informasi, akademik, dan kebutuhan mahasiswa.'],
                    ['value' => 'Menjalin komunikasi dan kerja sama dengan internal kampus maupun pihak eksternal.'],
                ],
                'vision' => 'Menjadi organisasi mahasiswa Sistem Informasi yang unggul, adaptif, inovatif, dan berkontribusi nyata bagi pengembangan mahasiswa serta lingkungan akademik.',
                'purpose' => 'HIMSI UBSI bertujuan menjadi wadah pengembangan diri mahasiswa Sistem Informasi dalam bidang akademik, organisasi, teknologi, dan sosial. Melalui program kerja yang terarah, HIMSI mendorong mahasiswa untuk memiliki kemampuan analisis, komunikasi, kepemimpinan, dan keterampilan digital yang bermanfaat di dunia kerja maupun masyarakat.',
                'address' => 'Universitas Bina Sarana Informatika, Jakarta',
                'sosial_media' => [
                    ['platform' => 'email', 'url' => 'info@himsi.org'],
                    ['platform' => 'instagram', 'url' => 'https://instagram.com/himsi.ubsi'],
                    ['platform' => 'youtube', 'url' => 'https://youtube.com/@himsiubsi'],
                    ['platform' => 'linkedin', 'url' => 'https://linkedin.com/company/himsiubsi'],
                    ['platform' => 'tiktok', 'url' => 'https://tiktok.com/@himsiubsi'],
                    ['platform' => 'facebook', 'url' => 'https://facebook.com/himsiubsi'],
                    ['platform' => 'wa', 'url' => 'https://wa.me/6281234567890'],
                ],
                'email' => 'himsi@example.com',
                'no_tlpn' => '081234567890',
                'active' => true,
            ],
        );
    }
}
