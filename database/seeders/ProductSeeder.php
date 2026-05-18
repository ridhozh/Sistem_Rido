<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $data = [
            [
                'nama_produk' => 'Beras Premium 5kg',
                'kategori_id' => 1, // Misal: Bahan Pokok
                'foto_produk' => null,
                'harga' => 75000,
                'stok_awal' => 50,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_produk' => 'Minyak Goreng 2 Liter',
                'kategori_id' => 1,
                'foto_produk' => null,
                'harga' => 34000,
                'stok_awal' => 24,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_produk' => 'Gula Pasir 1kg',
                'kategori_id' => 1,
                'foto_produk' => null,
                'harga' => 17500,
                'stok_awal' => 40,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_produk' => 'Telur Ayam 1kg (Isi 16)',
                'kategori_id' => 1,
                'foto_produk' => null,
                'harga' => 28000,
                'stok_awal' => 10,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_produk' => 'Indomie Goreng Spesial (Karton)',
                'kategori_id' => 2, // Misal: Mie Instan
                'foto_produk' => null,
                'harga' => 115000,
                'stok_awal' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_produk' => 'Susu Kental Manis Putih 370g',
                'kategori_id' => 3, // Misal: Susu/Minuman
                'foto_produk' => null,
                'harga' => 12500,
                'stok_awal' => 15,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_produk' => 'Kopi Kapal Api 165g',
                'kategori_id' => 3,
                'foto_produk' => null,
                'harga' => 14000,
                'stok_awal' => 20,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_produk' => 'Sabun Mandi Batang 75g',
                'kategori_id' => 4, // Misal: Kebersihan
                'foto_produk' => null,
                'harga' => 4500,
                'stok_awal' => 60,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_produk' => 'Deterjen Bubuk 800g',
                'kategori_id' => 4,
                'foto_produk' => null,
                'harga' => 21000,
                'stok_awal' => 12,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_produk' => 'Garam Dapur Beriodium 250g',
                'kategori_id' => 1,
                'foto_produk' => null,
                'harga' => 3500,
                'stok_awal' => 100,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('products')->insert($data);
    }
}
