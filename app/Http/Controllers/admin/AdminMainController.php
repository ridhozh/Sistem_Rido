<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminMainController extends Controller
{
    // dashboard view
    public function admin()
    {
        return view('admin.dashboard');
    }

    // manage products
    public function manageProducts()
    {
        return view('admin.manage_produk');
    }

    // manage laporan
    public function manageLaporan()
    {
        return view('admin.laporan');
    }

    // manage pengguna
    public function managePengguna()
    {
        $pengguna = User::orderBy('id', 'asc')->get();
        return view('admin.user.manage_pengguna', compact('pengguna'));
    }

    //  Tambah user
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:6|same:konfirmasi_password'
        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan');
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'role' => 'required',
        ]);

        $data = [
            'name' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // kalau password diisi → update
        if ($request->password) {
            $request->validate([
                'password' => 'min:6|same:konfirmasi_password'
            ]);

            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'User berhasil diupdate');
    }

    // Hapus user
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus');
    }



}
