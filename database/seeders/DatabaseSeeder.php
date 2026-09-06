<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@himsi.org'],
            [
                'name' => 'Super Admin HIMSI',
                'password' => Hash::make('password'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        if (class_exists(\Spatie\Permission\Models\Role::class)) {
            $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
            $superAdmin->assignRole($role);
        }

        $this->call([
            UserSeeder::class,
            BranchSeeder::class,
            CountSeeder::class,
            DivisionSeeder::class,
            FaqSeeder::class,
            StatusSeeder::class,
            OrganizationSeeder::class,
            CategorySeeder::class,
            BlogSeeder::class,
            AiConfigSeeder::class,
        ]);
    }
}
