<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create akun user admin
        \App\Models\User::create([
            'name' => 'Admin Toserba Hasan',
            'email' => 'admin@toserbahasan.test',
            'password' => 'Admin@12345',
            'role' => 0,
        ]);

        //create akun user kasir
        \App\Models\User::create([
            'name' => 'Kasir Toserba Hasan',
            'email' => 'kasir@toserbahasan.test',
            'password' => 'Kasir@12345',
            'role' => 1,
        ]);

        $categories = [
            ['nama_kategori' => 'Kebutuhan Rumah Tangga'],
            ['nama_kategori' => 'Alat Tulis'],
            ['nama_kategori' => 'Elektronik'],
            ['nama_kategori' => 'Kesehatan & Kecantikan'],
            ['nama_kategori' => 'Perlengkapan Bayi'],
            ['nama_kategori' => 'Peralatan Dapur'],
            ['nama_kategori' => 'Mainan'],
        ];

        foreach ($categories as $cat) {
            Kategori::updateOrCreate(
                ['nama_kategori' => $cat['nama_kategori']], // Unique identifier
                $cat
            );
        }
    }
}
