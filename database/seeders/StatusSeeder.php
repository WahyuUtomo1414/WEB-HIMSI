<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'Belum Diverifikasi',
                'description' => 'Pendaftaran sudah masuk ke sistem dan menunggu proses pengecekan oleh pengurus.',
            ],
            [
                'name' => 'Terverifikasi',
                'description' => 'Pendaftaran sudah dicek dan dinyatakan memenuhi persyaratan awal.',
            ],
        ];

        foreach ($statuses as $status) {
            Status::updateOrCreate(
                ['name' => $status['name']],
                $status + ['active' => true],
            );
        }
    }
}
