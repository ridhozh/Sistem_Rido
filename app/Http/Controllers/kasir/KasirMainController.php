<?php

namespace App\Http\Controllers\kasir;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function checkout(Request $request)
    {
        $cart = $request->input('cart', []);
        
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
                'id' => substr($item['id'], 0, 50),
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
        ];

        $response = Http::withBasicAuth($serverKey, '')->post($apiUrl, $payload);

        if ($response->successful()) {
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
}
