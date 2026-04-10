@extends('kasir.layouts.layout')

@section('title', 'Transaksi Kasir - Toserba Hasan')
@section('page-title', 'Transaksi Baru')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <div class="lg:col-span-7 space-y-6">
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                            Katalog Produk
                        </h2>
                    </div>
                    
                    <div class="relative w-full md:w-72">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" placeholder="Cari barang..." 
                            class="block w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all outline-none text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6 overflow-y-auto pr-2" style="max-height: 600px;">
                    
                    @php
                        $dummies = [
                            ['nama' => 'Susu UHT Ultra 250ml', 'harga' => '6.500', 'img' => 'https://images.unsplash.com/photo-1556228720-195a672e8a03?q=80&w=200&h=200&auto=format&fit=crop'],
                            ['nama' => 'Indomie Goreng', 'harga' => '3.500', 'img' => 'https://images.unsplash.com/photo-1621444541669-d89e217f24c8?q=80&w=200&h=200&auto=format&fit=crop'],
                            ['nama' => 'Sabun Lifebuoy', 'harga' => '5.000', 'img' => 'https://images.unsplash.com/photo-1599411511211-7360a0a544c4?q=80&w=200&h=200&auto=format&fit=crop'],
                            ['nama' => 'Aqua Botol 600ml', 'harga' => '4.000', 'img' => 'https://images.unsplash.com/photo-1600612253954-049886a111a9?q=80&w=200&h=200&auto=format&fit=crop'],
                            ['nama' => 'Pringles Original', 'harga' => '22.000', 'img' => 'https://images.unsplash.com/photo-1566478989037-eec170784d0b?q=80&w=200&h=200&auto=format&fit=crop'],
                            ['nama' => 'Coca Cola 330ml', 'harga' => '7.000', 'img' => 'https://images.unsplash.com/photo-1622483767028-3f66f32aef97?q=80&w=200&h=200&auto=format&fit=crop'],
                            ['nama' => 'KitKat Chocolate', 'harga' => '12.000', 'img' => 'https://images.unsplash.com/photo-1582176604447-aa5144675a31?q=80&w=200&h=200&auto=format&fit=crop'],
                            ['nama' => 'Roti Tawar Sari', 'harga' => '15.000', 'img' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=200&h=200&auto=format&fit=crop'],
                        ];
                    @endphp

                    @foreach($dummies as $item)
                    <div class="group bg-white border border-slate-100 rounded-3xl p-3 shadow-sm hover:shadow-xl hover:shadow-blue-500/5 transition-all duration-300">
                        <div class="relative aspect-square rounded-2xl mb-4 overflow-hidden bg-slate-50">
                            <img src="{{ $item['img'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <button class="absolute bottom-2 right-2 bg-blue-600 text-white p-2.5 rounded-xl shadow-lg transform translate-y-12 group-hover:translate-y-0 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                            </button>
                        </div>
                        <h3 class="text-xs font-bold text-slate-700 truncate px-1">{{ $item['nama'] }}</h3>
                        <p class="text-sm font-black text-blue-600 mt-1 px-1">Rp {{ $item['harga'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="lg:col-span-5 space-y-8">
            
            <div class="bg-white p-8 rounded-[32px] border border-gray-100 shadow-sm">
                <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                    <div class="p-2 bg-blue-50 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    Keranjang Belanja
                </h2>

                <div class="space-y-4 overflow-y-auto pr-1" style="max-height: 280px;">
                    <div class="flex items-center gap-4 bg-slate-50/50 p-4 rounded-2xl border border-slate-100">
                        <div class="flex-1">
                            <h4 class="font-bold text-slate-800 text-sm">Susu UHT Ultra 250ml</h4>
                            <p class="text-xs text-slate-500 font-medium">Rp 6.500</p>
                        </div>
                        <div class="flex items-center bg-white rounded-xl border border-slate-200 p-1">
                            <button class="w-7 h-7 flex items-center justify-center text-slate-400 hover:text-blue-600">-</button>
                            <span class="w-8 text-center font-bold text-sm">2</span>
                            <button class="w-7 h-7 flex items-center justify-center text-slate-400 hover:text-blue-600">+</button>
                        </div>
                        <div class="text-right min-w-[80px]">
                            <p class="font-bold text-slate-800 text-sm">Rp 13.000</p>
                        </div>
                        <button class="p-2 text-slate-300 hover:text-red-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </div>
                    </div>
            </div>

            <div class="bg-white p-8 rounded-[32px] border border-gray-100 shadow-xl shadow-blue-500/5">
                <div class="space-y-6">
                    <div class="flex justify-between items-center text-slate-500">
                        <span class="font-medium">Subtotal</span>
                        <span class="font-bold">Rp 13.000</span>
                    </div>

                    <div class="flex justify-between items-end border-t border-slate-100 pt-6">
                        <span class="text-slate-800 font-bold">Total Tagihan</span>
                        <span class="text-blue-600 text-4xl font-black">Rp 13.000</span>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mt-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Metode</label>
                            <select class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold text-slate-700 outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                                <option>Tunai</option>
                                <option>QRIS</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Bayar (Tunai)</label>
                            <input type="text" value="20000" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-black text-blue-600 outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                        </div>
                    </div>

                    <div class="bg-blue-50/50 border border-blue-100 p-5 rounded-2xl flex justify-between items-center">
                        <span class="text-sm font-bold text-blue-900/50">Kembalian</span>
                        <span class="text-2xl font-black text-blue-600">Rp 7.000</span>
                    </div>

                    <button class="w-full py-5 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-black text-lg transition-all shadow-lg shadow-blue-500/25 active:scale-[0.98] flex items-center justify-center gap-3 mt-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                        SELESAIKAN TRANSAKSI
                    </button>
                </div>
            </div>
        </div>

    </div>
@endsection