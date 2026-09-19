<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Helper helper id kategori
        $getKatId = function (string $name) {
            $cat = Kategori::where('nama_kategori', $name)->first();
            return $cat ? $cat->id : 1;
        };

        $idRumahTangga = $getKatId('Kebutuhan Rumah Tangga');
        $idMakananMinuman = $getKatId('Makanan & Minuman');
        $idAlatTulis = $getKatId('Alat Tulis');
        $idKesehatan = $getKatId('Kesehatan & Kecantikan');

        $products = [
            [
                'nama_produk' => 'Beras Premium 5kg',
                'kategori_id' => $idRumahTangga,
                'foto_produk' => null,
                'harga_modal' => 62000,
                'harga' => 75000,
                'stok_awal' => 50,
            ],
            [
                'nama_produk' => 'Minyak Goreng 2 Liter',
                'kategori_id' => $idRumahTangga,
                'foto_produk' => null,
                'harga_modal' => 29000,
                'harga' => 34000,
                'stok_awal' => 24,
            ],
            [
                'nama_produk' => 'Gula Pasir 1kg',
                'kategori_id' => $idRumahTangga,
                'foto_produk' => null,
                'harga_modal' => 14500,
                'harga' => 17500,
                'stok_awal' => 40,
            ],
            [
                'nama_produk' => 'Telur Ayam 1kg',
                'kategori_id' => $idMakananMinuman,
                'foto_produk' => null,
                'harga_modal' => 23000,
                'harga' => 28000,
                'stok_awal' => 20,
            ],
            [
                'nama_produk' => 'Indomie Goreng Spesial (Karton)',
                'kategori_id' => $idMakananMinuman,
                'foto_produk' => null,
                'harga_modal' => 102000,
                'harga' => 115000,
                'stok_awal' => 15,
            ],
            [
                'nama_produk' => 'Kopi Kapal Api 165g',
                'kategori_id' => $idMakananMinuman,
                'foto_produk' => null,
                'harga_modal' => 11000,
                'harga' => 14000,
                'stok_awal' => 30,
            ],
            [
                'nama_produk' => 'Susu Kental Manis Putih 370g',
                'kategori_id' => $idMakananMinuman,
                'foto_produk' => null,
                'harga_modal' => 10000,
                'harga' => 12500,
                'stok_awal' => 25,
            ],
            [
                'nama_produk' => 'Sabun Mandi Batang 75g',
                'kategori_id' => $idKesehatan,
                'foto_produk' => null,
                'harga_modal' => 3200,
                'harga' => 4500,
                'stok_awal' => 60,
            ],
            [
                'nama_produk' => 'Shampo Pantene 160ml',
                'kategori_id' => $idKesehatan,
                'foto_produk' => null,
                'harga_modal' => 18000,
                'harga' => 23000,
                'stok_awal' => 20,
            ],
            [
                'nama_produk' => 'Deterjen Bubuk 800g',
                'kategori_id' => $idRumahTangga,
                'foto_produk' => null,
                'harga_modal' => 17500,
                'harga' => 21000,
                'stok_awal' => 15,
            ],
            [
                'nama_produk' => 'Buku Tulis 38 Lembar (Pack)',
                'kategori_id' => $idAlatTulis,
                'foto_produk' => null,
                'harga_modal' => 28000,
                'harga' => 35000,
                'stok_awal' => 20,
            ],
            [
                'nama_produk' => 'Bolpoin Gel Hitam (Pack)',
                'kategori_id' => $idAlatTulis,
                'foto_produk' => null,
                'harga_modal' => 15000,
                'harga' => 20000,
                'stok_awal' => 30,
            ],
        ];

        foreach ($products as $item) {
            Produk::updateOrCreate(
                ['nama_produk' => $item['nama_produk']],
                $item
            );
        }
    }
}
