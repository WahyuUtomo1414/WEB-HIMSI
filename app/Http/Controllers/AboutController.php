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
                ['id' => 1, 'sort' => 1, 'year' => '2018', 'list' => ['Pembentukan awal Himpunan Mahasiswa Sistem Informasi.']],
                ['id' => 2, 'sort' => 2, 'year' => '2021', 'list' => ['Perluasan cabang DPC ke kampus UBSI Jabodetabek.']],
                ['id' => 3, 'sort' => 3, 'year' => '2025', 'list' => ['Peluncuran Portal Website HIMSI Official.']],
            ],
            'divisions' => [
                [
                    'id' => 1,
                    'name' => 'Divisi Akademik & Riset',
                    'description' => 'Fokus pada pengembangan skill koding dan kajian ilmiah.',
                    'logo_url' => '/images/placeholder.svg',
                    'image_url' => '/images/placeholder.svg',
                    'job_description' => ['Menyelenggarakan workshop', 'Kajian teknologi baru'],
                    'is_dpp' => true,
                ],
                [
                    'id' => 2,
                    'name' => 'Divisi Humas & Media',
                    'description' => 'Fokus pada publikasi dan relasi eksternal.',
                    'logo_url' => '/images/placeholder.svg',
                    'image_url' => '/images/placeholder.svg',
                    'job_description' => ['Mengelola Instagram & Website', 'Publikasi artikel berita'],
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
