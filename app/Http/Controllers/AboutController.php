<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $data = [
            'hero' => [
                'title' => 'Tentang HIMSI UBSI',
                'subtitle' => 'Mengenal Lebih Dekat Himpunan Mahasiswa Sistem Informasi UBSI',
            ],
            'organization' => [
                'name' => 'HIMSI UBSI',
                'kode_org' => 'HIMSI',
                'description' => 'Himpunan Mahasiswa Sistem Informasi Universitas Bina Sarana Informatika adalah organisasi kemahasiswaan berbasis akademik dan profesi yang menaungi seluruh mahasiswa program studi Sistem Informasi.',
                'vision' => 'Menjadi himpunan mahasiswa yang unggul, inovatif, dan berdaya saing tinggi dalam bidang teknologi informasi serta berakhlak mulia.',
                'mision' => [
                    'Menyelenggarakan kegiatan pengembangan skill koding & teknologi bagi mahasiswa.',
                    'Membangun jejaring kolaborasi antara alumni, akademisi, dan dunia industri.',
                    'Mendorong keaktifan mahasiswa dalam kompetisi ilmiah & pengabdian masyarakat.',
                ],
                'purpose' => 'HIMSI dibentuk untuk wadah pengasahan minat bakat, pengembangan potensi akademik, serta pembentukan karakter kepemimpinan mahasiswa Sistem Informasi.',
                'address' => 'Jl. Pemuda No. 8, Rawamangun, Jakarta Timur',
                'email' => 'info@himsi.org',
                'no_tlpn' => '0812-3456-7890',
                'logo_url' => '/images/placeholder.svg',
                'thumbnail_url' => '/images/placeholder.svg',
                'sosial_media' => [
                    ['platform' => 'Instagram', 'url' => '@himsi.ubsi'],
                    ['platform' => 'YouTube', 'url' => 'HIMSI UBSI Official'],
                ],
            ],
            'milestones' => [
                ['id' => 1, 'sort' => 1, 'year' => '2018', 'list' => ['Pembentukan awal Himpunan Mahasiswa Sistem Informasi.', 'Pengukuhan pengurus perdana periode 2018/2019.']],
                ['id' => 2, 'sort' => 2, 'year' => '2021', 'list' => ['Perluasan cabang DPC ke kampus UBSI Jabodetabek.', 'Penyelenggaraan Seminar Nasional Teknologi Informasi pertama.']],
                ['id' => 3, 'sort' => 3, 'year' => '2025', 'list' => ['Peluncuran Portal Website HIMSI Official.', 'Pengembangan sistem admin terintegrasi dengan Filament.']],
            ],
            'divisions' => [
                [
                    'id' => 1,
                    'name' => 'Divisi Akademik & Riset',
                    'description' => 'Fokus pada pengasahan skill koding, kajian ilmiah, dan penyelenggaraan workshop teknologi.',
                    'logo_url' => '/images/placeholder.svg',
                    'image_url' => '/images/placeholder.svg',
                    'job_description' => ['Menyelenggarakan workshop', 'Kajian teknologi baru'],
                    'is_dpp' => true,
                ],
                [
                    'id' => 2,
                    'name' => 'Divisi Humas & Media',
                    'description' => 'Fokus pada manajemen media sosial, publikasi berita, dan menjalin kerjasama eksternal.',
                    'logo_url' => '/images/placeholder.svg',
                    'image_url' => '/images/placeholder.svg',
                    'job_description' => ['Mengelola Instagram & Website', 'Publikasi artikel berita'],
                    'is_dpp' => true,
                ],
                [
                    'id' => 3,
                    'name' => 'Divisi Litbang & Inovasi',
                    'description' => 'Fokus pada riset teknologi, inovasi proyek perangkat lunak, dan pengawalan kompetisi.',
                    'logo_url' => '/images/placeholder.svg',
                    'image_url' => '/images/placeholder.svg',
                    'job_description' => ['Riset software architecture', 'Pengembangan produk digital'],
                    'is_dpp' => true,
                ],
                [
                    'id' => 4,
                    'name' => 'Divisi Kaderisasi & Organisasi',
                    'description' => 'Fokus pada pembinaan karakter kepemimpinan, regenerasi pengurus, dan keakraban internal.',
                    'logo_url' => '/images/placeholder.svg',
                    'image_url' => '/images/placeholder.svg',
                    'job_description' => ['Latihan kepemimpinan', 'Bonding internal pengurus'],
                    'is_dpp' => true,
                ],
            ],
            'greeting' => [
                'name' => 'Ketua Umum HIMSI',
                'position' => 'Ketua Umum Period 2025/2026',
                'body' => 'Mari bersama-sama memajukan HIMSI UBSI menjadi organisasi yang solid dan berdampak nyata bagi mahasiswa.',
                'image_url' => '/images/placeholder.svg',
            ],
        ];

        return view('pages.about', $data);
    }
}
