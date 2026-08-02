<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $data = [
            'hero' => [
                'name' => 'HIMSI UBSI',
                'kode_org' => 'HIMSI',
                'description' => 'Himpunan Mahasiswa Sistem Informasi Universitas Bina Sarana Informatika. Wadah pengembangan akademik, inovasi teknologi, dan pengabdian mahasiswa.',
                'logo_url' => '/images/placeholder.svg',
                'thumbnail_url' => '/images/placeholder.svg',
            ],
            'counts' => [
                ['id' => 1, 'name' => 'Anggota Aktif', 'digit' => '500+'],
                ['id' => 2, 'name' => 'Cabang & DPC', 'digit' => '12'],
                ['id' => 3, 'name' => 'Program Kerja', 'digit' => '24'],
                ['id' => 4, 'name' => 'Divisi Organisasi', 'digit' => '6'],
            ],
            'greeting' => [
                'name' => 'Ketua Umum HIMSI',
                'position' => 'Ketua Umum Period 2025/2026',
                'body' => 'Selamat datang di Official Website HIMSI UBSI. Kami berkomitmen untuk menjadi wadah aspirasi, inovasi, dan kolaborasi bagi seluruh mahasiswa Sistem Informasi UBSI.',
                'image_url' => '/images/placeholder.svg',
            ],
            'divisions' => [
                [
                    'id' => 1,
                    'name' => 'Divisi Akademik & Riset',
                    'description' => 'Mengembangkan kegiatan akademik, pelatihan koding, workshop teknologi, dan kajian ilmiah mahasiswa.',
                    'logo_url' => '/images/placeholder.svg',
                    'image_url' => '/images/placeholder.svg',
                    'is_dpp' => true,
                ],
                [
                    'id' => 2,
                    'name' => 'Divisi Humas & Media',
                    'description' => 'Mengelola publikasi, hubungan antar lembaga, serta media komunikasi publik HIMSI.',
                    'logo_url' => '/images/placeholder.svg',
                    'image_url' => '/images/placeholder.svg',
                    'is_dpp' => true,
                ],
                [
                    'id' => 3,
                    'name' => 'Divisi PSDM',
                    'description' => 'Pengembangan sumber daya mahasiswa, kaderisasi, dan penguatan internal kepengurusan.',
                    'logo_url' => '/images/placeholder.svg',
                    'image_url' => '/images/placeholder.svg',
                    'is_dpp' => false,
                ],
            ],
            'branches' => [
                [
                    'id' => 1,
                    'name' => 'HIMSI DPC Pemuda',
                    'location' => 'UBSI Kampus Pemuda',
                    'sektor' => 'Jakarta Timur',
                    'thumbnail_url' => '/images/placeholder.svg',
                    'is_dpp' => false,
                ],
                [
                    'id' => 2,
                    'name' => 'HIMSI DPC Margonda',
                    'location' => 'UBSI Kampus Margonda',
                    'sektor' => 'Depok',
                    'thumbnail_url' => '/images/placeholder.svg',
                    'is_dpp' => false,
                ],
                [
                    'id' => 3,
                    'name' => 'HIMSI DPP Pusat',
                    'location' => 'UBSI Pusat',
                    'sektor' => 'Pusat',
                    'thumbnail_url' => '/images/placeholder.svg',
                    'is_dpp' => true,
                ],
            ],
            'blogs' => [
                [
                    'id' => 1,
                    'title' => 'Pelatihan Web Development Menggunakan Laravel & Filament',
                    'slug' => 'pelatihan-web-development-laravel-filament',
                    'quotes' => 'Meningkatkan skill pemrograman web mahasiswa Sistem Informasi.',
                    'category_name' => 'Workshop',
                    'branch_name' => 'DPP Pusat',
                    'thumbnail_url' => '/images/placeholder.svg',
                    'formatted_date' => date('d M Y'),
                ],
                [
                    'id' => 2,
                    'title' => 'Seminar Nasional Artificial Intelligence & Data Science 2025',
                    'slug' => 'seminar-nasional-ai-data-science-2025',
                    'quotes' => 'Menghadapi tantangan dunia kecerdasan buatan abad ke-21.',
                    'category_name' => 'Seminar',
                    'branch_name' => 'DPC Pemuda',
                    'thumbnail_url' => '/images/placeholder.svg',
                    'formatted_date' => date('d M Y'),
                ],
            ],
            'faqs' => [
                [
                    'id' => 1,
                    'question' => 'Apa itu HIMSI UBSI?',
                    'answer' => 'HIMSI UBSI adalah Himpunan Mahasiswa Sistem Informasi di lingkungan Universitas Bina Sarana Informatika yang menampung serta mengembangkan potensi mahasiswa di bidang akademik dan keorganisasian.',
                ],
                [
                    'id' => 2,
                    'question' => 'Bagaimana cara bergabung dengan kepengurusan HIMSI?',
                    'answer' => 'Pendaftaran pengurus baru dibuka setiap periode Open Recruitment. Informasi pendaftaran akan diumumkan melalui kanal resmi website dan sosial media HIMSI.',
                ],
            ],
        ];

        return view('pages.home', $data);
    }
}
