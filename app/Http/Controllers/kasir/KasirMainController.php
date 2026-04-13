<?php

namespace App\Http\Controllers\kasir;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class KasirMainController extends Controller
{
    //
    public function index()
    {
        return view('kasir.dashboard');
    }

    public function transaksi()
    {
        $categories = Kategori::with('produks')->get();  
        return view('kasir.transaksi', compact('categories'));
    }

    public function stok_barang()
    {
        $categories = Kategori::all();

        $products = Produk::with('kategori')->get();
        return view('kasir.stok_barang', compact('categories', 'products'));
    }
}
