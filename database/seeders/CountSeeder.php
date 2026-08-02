<?php

namespace Database\Seeders;

use App\Models\Count;
use Illuminate\Database\Seeder;

class CountSeeder extends Seeder
{
    public function run(): void
    {
        $counts = [
            ['name' => 'Tahun Berdiri', 'digit' => '2012'],
            ['name' => 'Cabang', 'digit' => '10'],
            ['name' => 'Divisi', 'digit' => '4'],
            ['name' => 'Anggota', 'digit' => '214'],
        ];

        foreach ($counts as $count) {
            Count::updateOrCreate(
                ['name' => $count['name']],
                $count + ['active' => true],
            );
        }
    }
}
