<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin DPP',
                'password' => Hash::make('password'),
            ]
        );

        if (class_exists(\Spatie\Permission\Models\Role::class)) {
            $role = \Spatie\Permission\Models\Role::where('name', 'super_admin')->first() 
                ?? \Spatie\Permission\Models\Role::first();

            if ($role) {
                $admin->assignRole($role);
            }
        }
    }
}
