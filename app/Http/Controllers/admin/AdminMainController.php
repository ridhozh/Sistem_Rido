<?php

namespace App\Http\Controllers\admin;

use App\Exports\TransactionsExport;
use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminMainController extends Controller
{
    // dashboard view
    public function admin()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        $todayRevenue = DetailTransaksi::whereDate('created_at', $today)->sum('subtotal');
        $todayQty = DetailTransaksi::whereDate('created_at', $today)->sum('qty');

        $yesterdayRevenue = DetailTransaksi::whereDate('created_at', $yesterday)->sum('subtotal');
        $yesterdayQty = DetailTransaksi::whereDate('created_at', $yesterday)->sum('qty');

        $revenueChange = $this->calculatePercentage($yesterdayRevenue, $todayRevenue);
        $qtyChange = $this->calculatePercentage($yesterdayQty, $todayQty);

        $mostSoldProduct = DetailTransaksi::whereDate('created_at', $today)
            ->select('produk_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('produk_id')
            ->orderByDesc('total_qty')
            ->with('produk:id,nama_produk')
            ->first();

        $lowStockProducts = Produk::where('stok_awal', '<', 10)->count();

        $salesData = [];
        $maxRevenue = 0;

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);

            $revenue = Transaksi::whereDate('transaction_date', $date)->sum('total_amount') ?? 0;

            $salesData[] = [
                'label' => $date->isoFormat('ddd'),
                'revenue' => (float) $revenue,
                'formatted' => 'Rp ' . number_format($revenue, 0, ',', '.')
            ];

            if ($revenue > $maxRevenue) $maxRevenue = $revenue;
        }

        if ($maxRevenue > 0) {
            if ($maxRevenue < 1000) {
                // If sales are small (like 450), set max to 500 or 1000
                $yAxisMax = ceil($maxRevenue / 100) * 100;
            } else {
                // If sales are big (like 2jt), set max to nearest 1jt
                $yAxisMax = ceil($maxRevenue / 1000000) * 1000000;
            }
        } else {
            $yAxisMax = 1000; // Fallback
        }

        return view('admin.dashboard', compact(
            'lowStockProducts',
            'todayRevenue',
            'revenueChange',
            'todayQty',
            'qtyChange',
            'mostSoldProduct',
            'salesData',
            'yAxisMax'
        ));
    }

    // manage products
    public function manageProducts()
    {
        $categories = Kategori::all();
        return view('admin.manage_produk', compact('categories'));
    }

    // manage laporan
    public function manageLaporan(Request $request)
    {
        $start_date = $request->input('tanggal_awal');
        $end_date = $request->input('tanggal_akhir');

        $query = Transaksi::query();

        if ($start_date && $end_date) {
            $query->whereBetween('created_at', [
                Carbon::parse($start_date)->startOfDay(),
                Carbon::parse($end_date)->endOfDay()
            ]);
        }

        $transaksis = $query->latest()->paginate(10);

        $totalPendapatan = $query->sum('total_amount');

        return view('admin.laporan', compact('transaksis', 'start_date', 'end_date', 'totalPendapatan'));
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

    public function exportPDF(Request $request)
    {
        $start = $request->tanggal_awal;
        $end = $request->tanggal_akhir;

        $query = Transaksi::query();
        if ($start && $end) {
            $query->whereBetween('created_at', [
                Carbon::parse($start)->startOfDay(),
                Carbon::parse($end)->endOfDay()
            ]);
        }

        $transaksis = $query->latest()->get();

        $pdf = Pdf::loadView('admin.pdf_template', compact('transaksis', 'start', 'end'));
        return $pdf->download('Laporan_Transaksi_' . now()->format('Ymd') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $start = $request->tanggal_awal;
        $end = $request->tanggal_akhir;

        // dd(Transaksi::all()->toArray());

        return Excel::download(new TransactionsExport($start, $end), 'Laporan_Transaksi.xlsx');
    }

    private function calculatePercentage($old, $new)
    {
        $old = (float) $old;
        $new = (float) $new;

        if ($old == 0) {
            return $new > 0 ? 100 : 0;
        }

        $diff = (($new - $old) / $old) * 100;

        return round($diff, 1);
    }
}
