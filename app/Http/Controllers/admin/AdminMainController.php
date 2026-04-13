<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

class AdminMainController extends Controller
{
    // dashboard view
    public function admin()
    {
        $lowStockProducts = Produk::where('stok_awal', '<', 10)->count();

        return view('admin.dashboard', compact('lowStockProducts'));
    }

    // manage products
    public function manageProducts()
    {
        $categories = Kategori::all();

        $products = Produk::with('kategori')->get();

        return view('admin.manage_produk', compact('categories', 'products'));
    }

    // manage laporan
    public function manageLaporan()
    {
        return view('admin.laporan');
    }

    // manage pengguna
    public function managePengguna()
    {
        return view('admin.manage_pengguna');
    }

    public function storeProduk(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|string|max:255',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'harga' => 'required|numeric|min:0',
            'stok_awal' => 'required|integer|min:0'
        ]);

        // dd($validatedData);

        if ($request->hasFile('foto_produk')) {
            $path = $request->file('foto_produk')->store('products', 'public');
            $validatedData['foto_produk'] = $path;
        }

        Produk::create($validatedData);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil Ditambahkan!');
    }

    public function updateProduk(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga'       => 'required|numeric|min:0',
            'stok_awal'   => 'required|integer|min:0'
        ]);

        if ($request->hasFile('foto_produk')) {
            // Delete old photo if it exists
            if ($produk->foto_produk) {
                Storage::disk('public')->delete($produk->foto_produk);
            }
            $path = $request->file('foto_produk')->store('products', 'public');
            $validatedData['foto_produk'] = $path;
        }

        $produk->update($validatedData);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroyProduk($id)
    {
        $produk = Produk::findOrFail($id);

        // Delete photo from storage
        if ($produk->foto_produk) {
            Storage::disk('public')->delete($produk->foto_produk);
        }

        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}
