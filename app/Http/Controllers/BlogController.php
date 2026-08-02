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
                'title' => 'Pelatihan Web Development Menggunakan Laravel & Filament v3',
                'slug' => 'pelatihan-web-development-laravel-filament',
                'quotes' => 'Meningkatkan pemahaman arsitektur web modern bagi mahasiswa.',
                'category_name' => 'Workshop',
                'branch_name' => 'DPP Pusat',
                'thumbnail_url' => '/images/placeholder.svg',
                'formatted_date' => date('d M Y'),
            ],
            [
                'id' => 2,
                'title' => 'Seminar Nasional Artificial Intelligence & Data Science 2025',
                'slug' => 'seminar-nasional-ai-data-science-2025',
                'quotes' => 'Menghadapi tantangan kecerdasan buatan abad ke-21.',
                'category_name' => 'Seminar',
                'branch_name' => 'DPC Pemuda',
                'thumbnail_url' => '/images/placeholder.svg',
                'formatted_date' => date('d M Y'),
            ],
        ];

        // Create a simple length-aware paginator for static display
        $paginator = new LengthAwarePaginator(
            $blogsList,
            count($blogsList),
            9,
            1,
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
