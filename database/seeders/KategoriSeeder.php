<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Kebutuhan Rumah Tangga',
            'Makanan & Minuman',
            'Alat Tulis',
            'Elektronik',
            'Kesehatan & Kecantikan',
            'Perlengkapan Bayi',
            'Peralatan Dapur',
            'Mainan',
        ];

        foreach ($categories as $cat) {
            Kategori::firstOrCreate([
                'nama_kategori' => $cat,
            ]);
        }
    }
}
