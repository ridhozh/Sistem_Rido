<?php

namespace App\Http\Controllers\kasir;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\ModalKasir;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Throwable;

class KasirMainController extends Controller
{
    //
    public function index()
    {
        $today = Carbon::today();

        $todayRevenue = DetailTransaksi::whereDate('created_at', $today)
            ->sum('subtotal');

        $todayCash = Transaksi::whereDate('transaction_date', $today)
            ->whereRaw('LOWER(payment_method) = ?', ['tunai'])
            ->sum('total_amount');

        $todayNonCash = Transaksi::whereDate('transaction_date', $today)
            ->whereRaw('LOWER(payment_method) != ?', ['tunai'])
            ->sum('total_amount');

        $todayModalKasir = (float) (ModalKasir::whereDate('tanggal', $today)->value('modal_awal') ?? 0);
        $todayKasKasir = $todayModalKasir + $todayCash;

        $totalItemsSold = DetailTransaksi::whereDate('created_at', $today)
            ->sum('qty');

        $latestTransactions = Transaksi::latest()
            ->take(3)
            ->get();

        $salesData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);

            $revenue = Transaksi::whereDate('created_at', $date)
                ->sum('total_amount');

            $salesData[] = [
                'label'     => $date->isoFormat('ddd'), // Format: Sen, Sel, Rab...
                'revenue'   => $revenue,
                'formatted' => 'Rp ' . number_format($revenue, 0, ',', '.')
            ];
        }

        // 4. Skala Grafik (Y-Axis)
        $maxRevenue = collect($salesData)->max('revenue');
        $yAxisMax = $maxRevenue > 0 ? $maxRevenue : 1000000; // Default 1jt jika kosong

        return view('kasir.dashboard', compact(
            'todayRevenue',
            'todayCash',
            'todayNonCash',
            'todayModalKasir',
            'todayKasKasir',
            'totalItemsSold',
            'latestTransactions',
            'salesData',
            'yAxisMax'
        ));
    }

    public function transaksi()
    {
        $categories = Kategori::with('produks');
        return view('kasir.transaksi', compact('categories'));
    }

    public function stok_barang()
    {
        $categories = Kategori::all();

        return view('kasir.stok_barang', compact('categories'));
    }

    public function checkout(Request $request)
    {
        $cart = $this->normalizeCart($request->input('cart', []));

        if (empty($cart)) {
            return response()->json(['status' => 'error', 'message' => 'Keranjang kosong'], 400);
        }

        $serverKey = config('services.midtrans.serverKey');
        $isProduction = config('services.midtrans.isProduction');
        $apiUrl = $isProduction ? 'https://app.midtrans.com/snap/v1/transactions' : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        $orderId = 'TRX-' . time() . '-' . rand(1000, 9999);

        $itemDetails = [];
        $grossAmount = 0;
        foreach ($cart as $item) {
            $itemDetails[] = [
                'id' => substr((string) $item['id'], 0, 50),
                'price' => $item['price'],
                'quantity' => $item['qty'],
                'name' => substr($item['name'], 0, 50)
            ];
            $grossAmount += ($item['price'] * $item['qty']);
        }

        $payload = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'item_details' => $itemDetails,
            'callbacks' => [
                'finish' => route('kasir.transaksi.finish')
            ]
        ];

        $response = Http::withBasicAuth($serverKey, '')->post($apiUrl, $payload);

        if ($response->successful()) {
            session()->put("midtrans_pending_transactions.$orderId", $cart);

            return response()->json([
                'status' => 'success',
                'snap_token' => $response->json('token'),
                'order_id' => $orderId
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Gagal terhubung dengan Midtrans',
            'debug' => $response->json()
        ], 500);
    }

    public function simpanTransaksi(Request $request)
    {
        try {
            $request->validate([
                'order_id' => ['required', 'string'],
                'payment_type' => ['required', 'string'],
                'cart' => ['required', 'array', 'min:1'],
            ]);

            $cart = $this->normalizeCart($request->input('cart', []));
            $transaksi = $this->persistTransaction(
                $request->order_id,
                $request->payment_type,
                $cart
            );

            return response()->json([
                'message' => 'Transaksi berhasil disimpan',
                'transaction_id' => $transaksi->transaction_id,
            ]);
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'message' => $e->getMessage() ?: 'Gagal menyimpan transaksi',
            ], 422);
        }
    }

    public function finishTransaksi(Request $request)
    {
        $orderId = $request->query('order_id');

        if (! $orderId) {
            return redirect()
                ->route('kasir.transaksi')
                ->with('error', 'Order ID Midtrans tidak ditemukan.');
        }

        try {
            $serverKey = config('services.midtrans.serverKey');
            $isProduction = config('services.midtrans.isProduction');
            $statusUrl = $isProduction
                ? "https://api.midtrans.com/v2/{$orderId}/status"
                : "https://api.sandbox.midtrans.com/v2/{$orderId}/status";

            $response = Http::withBasicAuth($serverKey, '')->get($statusUrl);

            if (! $response->successful()) {
                return redirect()
                    ->route('kasir.transaksi')
                    ->with('error', 'Gagal memverifikasi status pembayaran Midtrans.');
            }

            $status = $response->json('transaction_status');
            $paymentType = $response->json('payment_type', 'midtrans');

            if (! in_array($status, ['capture', 'settlement'], true)) {
                return redirect()
                    ->route('kasir.transaksi')
                    ->with('error', 'Pembayaran belum berhasil diselesaikan.');
            }

            $cart = session()->get("midtrans_pending_transactions.$orderId", []);

            if (empty($cart)) {
                return redirect()
                    ->route('kasir.transaksi')
                    ->with('error', 'Data keranjang transaksi Midtrans tidak ditemukan.');
            }

            $this->persistTransaction($orderId, $paymentType, $cart);
            session()->forget("midtrans_pending_transactions.$orderId");

            return redirect()
                ->route('kasir.transaksi')
                ->with('success', 'Pembayaran Midtrans berhasil dan transaksi telah disimpan.');
        } catch (Throwable $e) {
            report($e);

            return redirect()
                ->route('kasir.transaksi')
                ->with('error', $e->getMessage() ?: 'Terjadi kesalahan saat menyimpan transaksi Midtrans.');
        }
    }

    private function normalizeCart(array $cart): array
    {
        if (empty($cart)) {
            return [];
        }

        $productIds = collect($cart)
            ->pluck('id')
            ->map(fn($id) => (int) $id)
            ->filter()
            ->unique()
            ->values();

        $products = Produk::whereIn('id', $productIds)->get()->keyBy('id');

        $normalizedCart = [];

        foreach ($cart as $item) {
            $productId = (int) ($item['id'] ?? 0);
            $qty = (int) ($item['qty'] ?? 0);
            $product = $products->get($productId);

            if (! $product || $qty < 1) {
                continue;
            }

            $normalizedCart[] = [
                'id' => $product->id,
                'name' => $product->nama_produk,
                'price' => (float) $product->harga,
                'qty' => $qty,
            ];
        }

        return $normalizedCart;
    }

    private function persistTransaction(string $orderId, string $paymentType, array $cart): Transaksi
    {
        $existingTransaction = Transaksi::where('transaction_id', $orderId)->first();

        if ($existingTransaction) {
            return $existingTransaction;
        }

        return DB::transaction(function () use ($orderId, $paymentType, $cart) {
            $total = 0;

            $transaksi = Transaksi::create([
                'transaction_id' => $orderId,
                'transaction_date' => now(),
                'user_id' => Auth::id(),
                'cashier_name' => Auth::user()->name ?? 'Kasir',
                'total_amount' => 0,
                'payment_method' => $paymentType,
            ]);

            foreach ($cart as $item) {
                $produk = Produk::whereKey($item['id'])->lockForUpdate()->firstOrFail();

                if ($produk->stok_awal < $item['qty']) {
                    throw new \RuntimeException("Stok produk {$produk->nama_produk} tidak mencukupi.");
                }

                $subtotal = $produk->harga * $item['qty'];
                $total += $subtotal;

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $produk->id,
                    'qty' => $item['qty'],
                    'harga' => $produk->harga,
                    'harga_modal' => $produk->harga_modal ?? 0,
                    'subtotal' => $subtotal,
                ]);

                $produk->decrement('stok_awal', $item['qty']);
            }

            $transaksi->update(['total_amount' => $total]);

            return $transaksi;
        });
    }
}
