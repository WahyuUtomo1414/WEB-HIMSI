<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class BranchController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search', '');
        $sektor = $request->query('sektor', '');
        $type = $request->query('type', '');

        $data = [
            'hero' => [
                'title' => 'Cabang & DPC HIMSI',
                'subtitle' => 'Daftar Wilayah Kepengurusan Himpunan Mahasiswa Sistem Informasi',
            ],
            'branches' => [
                [
                    'id' => 1,
                    'name' => 'HIMSI DPP Pusat',
                    'location' => 'UBSI Pusat',
                    'sektor' => 'Pusat',
                    'description' => 'Dewan Pimpinan Pusat HIMSI UBSI yang membawahi seluruh cabang DPC.',
                    'grup_wa' => 'https://chat.whatsapp.com/example',
                    'thumbnail_url' => '/images/placeholder.svg',
                    'is_dpp' => true,
                    'sosial_media' => [['platform' => 'Instagram', 'url' => '@himsi.pusat']],
                ],
                [
                    'id' => 2,
                    'name' => 'HIMSI DPC Pemuda',
                    'location' => 'UBSI Kampus Pemuda',
                    'sektor' => 'Jakarta Timur',
                    'description' => 'Dewan Pimpinan Cabang HIMSI UBSI Kampus Pemuda Jakarta Timur.',
                    'grup_wa' => 'https://chat.whatsapp.com/example',
                    'thumbnail_url' => '/images/placeholder.svg',
                    'is_dpp' => false,
                    'sosial_media' => [['platform' => 'Instagram', 'url' => '@himsi.pemuda']],
                ],
                [
                    'id' => 3,
                    'name' => 'HIMSI DPC Margonda',
                    'location' => 'UBSI Kampus Margonda',
                    'sektor' => 'Depok',
                    'description' => 'Dewan Pimpinan Cabang HIMSI UBSI Kampus Margonda Depok.',
                    'grup_wa' => 'https://chat.whatsapp.com/example',
                    'thumbnail_url' => '/images/placeholder.svg',
                    'is_dpp' => false,
                    'sosial_media' => [['platform' => 'Instagram', 'url' => '@himsi.margonda']],
                ],
            ],
            'sektors' => ['Pusat', 'Jakarta Timur', 'Depok', 'Bekasi', 'Tangerang'],
            'currentSearch' => $search,
            'currentSektor' => $sektor,
            'currentType' => $type,
        ];

        return view('pages.branch.index', $data);
    }

    public function show(string $branch): View
    {
        $data = [
            'branch' => [
                'id' => 1,
                'name' => 'HIMSI DPC Pemuda',
                'location' => 'UBSI Kampus Pemuda',
                'sektor' => 'Jakarta Timur',
                'description' => 'Dewan Pimpinan Cabang HIMSI UBSI Kampus Pemuda Rawamangun Jakarta Timur.',
                'grup_wa' => 'https://chat.whatsapp.com/example',
                'thumbnail_url' => '/images/placeholder.svg',
                'is_dpp' => false,
                'sosial_media' => [
                    ['platform' => 'Instagram', 'url' => '@himsi.pemuda'],
                    ['platform' => 'Email', 'url' => 'dpc.pemuda@himsi.org'],
                ],
            ],
            'structures' => [
                [
                    'id' => 1,
                    'name' => 'Ahmad Rizky',
                    'position' => 'Ketua Cabang',
                    'no_wa' => '08123456789',
                    'division_name' => 'Pengurus Harian',
                    'image_url' => '/images/placeholder.svg',
                ],
                [
                    'id' => 2,
                    'name' => 'Siti Nurhaliza',
                    'position' => 'Sekretaris Cabang',
                    'no_wa' => '08123456788',
                    'division_name' => 'Pengurus Harian',
                    'image_url' => '/images/placeholder.svg',
                ],
            ],
            'blogs' => [],
        ];

        return view('pages.branch.show', $data);
    }
}
