<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search', '');
        $categoryId = $request->query('category', '');

        $blogsList = [
            [
                'id' => 1,
                'title' => 'Pelatihan Web Development Menggunakan Laravel & Filament',
                'slug' => 'pelatihan-web-development-laravel-filament',
                'quotes' => 'Meningkatkan skill pemrograman web mahasiswa Sistem Informasi.',
                'body' => 'HIMSI UBSI sukses menyelenggarakan pelatihan web development tingkat lanjut dengan materi Laravel 13 dan Filament v5 untuk mengembangkan kemampuan coding mahasiswa.',
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
                'body' => 'Seminar nasional ini menghadirkan berbagai praktisi kecerdasan buatan ternama untuk memberikan wawasan mendalam mengenai prospek karir di bidang data science dan AI.',
                'category_name' => 'Seminar',
                'branch_name' => 'DPC Pemuda',
                'thumbnail_url' => '/images/placeholder.svg',
                'formatted_date' => date('d M Y'),
            ],
            [
                'id' => 3,
                'title' => 'Open Recruitment & Hackathon Internal HIMSI 2025',
                'slug' => 'open-recruitment-hackathon-himsi-2025',
                'quotes' => 'Wadah bagi mahasiswa baru untuk berkolaborasi dan berkompetisi.',
                'body' => 'Kegiatan tahunan Open Recruitment pengurus baru sekaligus ajang kompetisi Hackathon internal HIMSI untuk mengasah kemampuan kolaborasi tim.',
                'category_name' => 'Pengumuman',
                'branch_name' => 'DPP Pusat',
                'thumbnail_url' => '/images/placeholder.svg',
                'formatted_date' => date('d M Y'),
            ],
            [
                'id' => 4,
                'title' => 'Juara 1 Lomba Software Engineering National IT Competition',
                'slug' => 'juara-1-lomba-software-engineering-national-it',
                'quotes' => 'Mahasiswa Sistem Informasi UBSI torehkan prestasi nasional.',
                'body' => 'Tim delegasi HIMSI UBSI berhasil mengamankan posisi pertama dalam ajang kejuaraan pengembang perangkat lunak tingkat nasional.',
                'category_name' => 'Prestasi',
                'branch_name' => 'DPC Margonda',
                'thumbnail_url' => '/images/placeholder.svg',
                'formatted_date' => date('d M Y'),
            ],
            [
                'id' => 5,
                'title' => 'Kunjungan Industri & Study Banding ke Google Indonesia',
                'slug' => 'kunjungan-industri-study-banding-google-indonesia',
                'quotes' => 'Melihat langsung budaya kerja dan ekosistem perusahaan teknologi kelas dunia.',
                'body' => 'Sebanyak 50 pengurus HIMSI mengikuti kegiatan Company Visit ke kantor Google Indonesia Jakarta untuk mempelajari kultur teknis terkini.',
                'category_name' => 'Workshop',
                'branch_name' => 'DPP Pusat',
                'thumbnail_url' => '/images/placeholder.svg',
                'formatted_date' => date('d M Y'),
            ],
            [
                'id' => 6,
                'title' => 'Malam Keakraban & Upgrading Organisasi Pengurus HIMSI 2025',
                'slug' => 'malam-keakraban-upgrading-pengurus-himsi-2025',
                'quotes' => 'Mempererat tali silaturahmi dan solidaritas antar divisi.',
                'body' => 'Kegiatan rutin upgrading kepemimpinan serta keakraban seluruh divisi HIMSI untuk menyelaraskan visi misi periode pergerakan terbaru.',
                'category_name' => 'Pengumuman',
                'branch_name' => 'DPC Pemuda',
                'thumbnail_url' => '/images/placeholder.svg',
                'formatted_date' => date('d M Y'),
            ],
        ];

        // Create length-aware paginator for 12 total items (2 pages of 6 items)
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $paginator = new LengthAwarePaginator(
            $blogsList,
            12,
            6,
            $currentPage,
            ['path' => route('blog.index')]
        );

        $categories = [
            ['id' => 1, 'name' => 'Workshop'],
            ['id' => 2, 'name' => 'Seminar'],
            ['id' => 3, 'name' => 'Pengumuman'],
            ['id' => 4, 'name' => 'Prestasi'],
        ];

        $data = [
            'hero' => [
                'title' => 'Blog & Artikel HIMSI',
                'subtitle' => 'Kumpulan Berita, Informasi Kegiatan, dan Artikel Edukatif Terkini',
            ],
            'blogs' => $blogsList,
            'paginator' => $paginator,
            'categories' => $categories,
            'currentSearch' => $search,
            'currentCategory' => $categoryId,
        ];

        return view('pages.blog.index', $data);
    }

    public function show(string $blog): View
    {
        $data = [
            'blog' => [
                'id' => 1,
                'title' => 'Pelatihan Web Development Menggunakan Laravel & Filament v3',
                'slug' => 'pelatihan-web-development-laravel-filament',
                'quotes' => 'Meningkatkan pemahaman arsitektur web modern bagi mahasiswa Sistem Informasi.',
                'body' => '<p>Kegiatan pelatihan web development telah sukses dilaksanakan oleh Divisi Akademik HIMSI. Pelatihan ini membahas dasar framework Laravel 13 dan pembuatan admin panel yang efisien memakai Filament v3.</p><p>Para peserta diajak mempraktikkan pembentukan arsitektur aplikasi berbasis Model-View-Controller (MVC) serta integrasi komponen UI modern.</p>',
                'category_name' => 'Workshop',
                'branch_name' => 'DPP Pusat',
                'thumbnail_url' => '/images/placeholder.svg',
                'formatted_date' => date('d M Y'),
                'images' => [
                    ['id' => 1, 'image_url' => '/images/placeholder.svg', 'description' => 'Foto Sesi Pelatihan Koding'],
                ],
            ],
            'relatedBlogs' => [
                [
                    'id' => 2,
                    'title' => 'Seminar Nasional Artificial Intelligence 2025',
                    'slug' => 'seminar-nasional-ai-2025',
                    'quotes' => 'Kecerdasan buatan dalam lanskap teknologi.',
                    'category_name' => 'Seminar',
                    'branch_name' => 'DPC Pemuda',
                    'thumbnail_url' => '/images/placeholder.svg',
                    'formatted_date' => date('d M Y'),
                ],
            ],
        ];

        return view('pages.blog.show', $data);
    }
}
