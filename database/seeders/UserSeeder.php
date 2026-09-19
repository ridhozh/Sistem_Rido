<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Akun Admin (role = 0)
        User::updateOrCreate(
            ['email' => 'admin@toserbahasan.test'],
            [
                'name' => 'Admin Toserba Hasan',
                'password' => Hash::make('Admin@12345'),
                'role' => 0,
            ]
        );

        // Akun Kasir (role = 1)
        User::updateOrCreate(
            ['email' => 'kasir@toserbahasan.test'],
            [
                'name' => 'Kasir Toserba Hasan',
                'password' => Hash::make('Kasir@12345'),
                'role' => 1,
            ]
        );
    }
}
