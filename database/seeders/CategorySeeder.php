<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Kegiatan',
                'description' => 'Kategori untuk publikasi agenda, dokumentasi acara, dan aktivitas HIMSI.',
            ],
            [
                'name' => 'Pendidikan',
                'description' => 'Kategori untuk artikel edukasi seputar sistem informasi, teknologi, dan pengembangan kompetensi mahasiswa.',
            ],
            [
                'name' => 'Informasi dan Pengumuman',
                'description' => 'Kategori untuk pengumuman resmi, informasi akademik, dan pemberitahuan organisasi.',
            ],
            [
                'name' => 'Prestasi dan Akademik',
                'description' => 'Kategori untuk kabar prestasi mahasiswa, capaian akademik, lomba, dan apresiasi.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                $category + ['active' => true],
            );
        }
    }
}
