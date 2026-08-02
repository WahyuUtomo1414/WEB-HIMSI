<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DivisionController extends Controller
{
    public function show(string $division): View
    {
        $data = [
            'division' => [
                'id' => 1,
                'name' => 'Divisi Akademik & Riset',
                'description' => 'Divisi Akademik & Riset bertugas menyelenggarakan program pelatihan koding, kajian ilmiah, klinik tugas akhir, dan workshop perkembangan teknologi terkini untuk mahasiswa Sistem Informasi.',
                'job_description' => [
                    'Menyelenggarakan Bootcamp Koding & Workshop Web Development.',
                    'Membuka Klinik Belajar & Bimbingan Matakuliah Pemrograman.',
                    'Mengelola Kompetisi Internal & Pendampingan Lomba Karya Tulis Ilmiah.',
                    'Menyiapkan modul dan materi repositori belajar mahasiswa.',
                ],
                'is_dpp' => true,
                'logo_url' => '/images/placeholder.svg',
                'image_url' => '/images/placeholder.svg',
            ],
        ];

        return view('pages.division.show', $data);
    }
}
