<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $branches = [
            ['name' => 'DPC BSD', 'location' => 'BSD, Tangerang Selatan', 'grup_wa' => 'https://chat.whatsapp.com/DD7fue3sDAf6Zv6bRoQQs5?mode=ems_wa_t', 'sektor' => 'sektor_barat'],
            ['name' => 'DPC Cengkareng', 'location' => 'Cengkareng, Jakarta Barat', 'grup_wa' => 'https://chat.whatsapp.com/KFGx00FPeZF89qk8scg6Od?mode=ems_copy_t', 'sektor' => 'sektor_barat'],
            ['name' => 'DPC Slipi', 'location' => 'Slipi, Jakarta Barat', 'grup_wa' => 'https://chat.whatsapp.com/JpLiyhPGMrDD90JX7eAPa7?mode=ems_copy_c', 'sektor' => 'sektor_barat'],
            ['name' => 'DPC Cimone', 'location' => 'Cimone, Tangerang Kota', 'grup_wa' => 'https://chat.whatsapp.com/HKDof7DhZbd2wDzrygxGlV?mode=ems_copy_c', 'sektor' => 'sektor_barat'],
            ['name' => 'DPC Samudra', 'location' => 'Kramat, Jakarta Pusat', 'grup_wa' => 'https://chat.whatsapp.com/KXyGLKPd4Jv8sWdaXXOf1L?mode=ems_copy_c', 'sektor' => 'sektor_tengah'],
            ['name' => 'DPC Marwati', 'location' => 'Depok, Jawa Barat', 'grup_wa' => 'https://chat.whatsapp.com/GvJEDOXX9m3HyguKWaL4A7?mode=ems_copy_t', 'sektor' => 'sektor_tengah'],
            ['name' => 'DPC Kaliabang', 'location' => 'Bekasi, Jawa Barat', 'grup_wa' => 'https://chat.whatsapp.com/FtAs6PDUPsTFZ7zRar6VjB?mode=ems_copy_c', 'sektor' => 'sektor_timur'],
            ['name' => 'DPC Cikarang', 'location' => 'Cikarang, Jawa Barat', 'grup_wa' => '', 'sektor' => 'sektor_timur'],
            ['name' => 'DPC Kalimalang', 'location' => 'Kalimalang, Jakarta Timur', 'grup_wa' => '', 'sektor' => 'sektor_timur'],
            ['name' => 'DPC Jatiwaringin', 'location' => 'Pondok Gede, Jakarta Timur', 'grup_wa' => 'https://chat.whatsapp.com/FHQ0SDXBGXj1qS30AeXh43?mode=ems_copy_c', 'sektor' => 'sektor_timur'],
        ];

        foreach ($branches as $row) {
            $branch = Branch::updateOrCreate(
                ['name' => $row['name']],
                [
                    'location' => $row['location'],
                    'thumbnail' => 'https://picsum.photos/seed/'.Str::slug($row['name']).'/800/600',
                    'description' => "{$row['name']} adalah cabang HIMSI UBSI yang berlokasi di {$row['location']}. Cabang ini menjadi ruang koordinasi, pengembangan anggota, dan pelaksanaan program kerja di wilayah {$row['sektor']}.",
                    'grup_wa' => $row['grup_wa'],
                    'sektor' => $row['sektor'],
                    'sosial_media' => [
                        'instagram' => 'https://instagram.com/'.Str::slug($row['name'], ''),
                        'website' => '',
                        'youtube' => '',
                        'linkedin' => '',
                        'tiktok' => '',
                        'facebook' => '',
                        'wa' => $row['grup_wa'],
                    ],
                    'is_dpp' => false,
                    'active' => true,
                ],
            );

            // Nanti di jalanin kalo udah ada data role

            $email = Str::slug($row['name'], '').'@gmail.com';
            $password = Str::random(16);
            $user = User::firstOrNew(['email' => $email]);
            $isNewUser = ! $user->exists;

            $user->name = 'KOOR RSDM '.$row['name'];
            $user->branch_id = $branch->id;

            if ($isNewUser) {
                $user->password = Hash::make($password);
            }

            $user->save();

            if (method_exists($user, 'assignRole') && class_exists(Role::class)) {
                $role = Role::find(3);

                if ($role) {
                    $user->assignRole($role->name);
                }
            }

            $message = $isNewUser
                ? "Akun cabang dibuat: {$user->email}, password: {$password}"
                : "Akun cabang sudah ada: {$user->email}";

            $this->command?->info($message);
        }
    }
}
