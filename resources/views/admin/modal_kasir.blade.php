@extends('admin.layouts.layout')

@section('title', 'Modal Awal Kasir - Toserba Hasan')
@section('page-title', 'Modal Awal Kasir (Cash Float)')

@section('content')
<div class="space-y-6">

    @if (session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-xl shadow-sm">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-rose-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <ul class="text-sm font-medium text-rose-800 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- 3 Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: Modal Awal Kasir Hari Ini -->
        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
            <div class="flex justify-between items-start mb-2">
                <h3 class="text-sm font-semibold text-slate-600">Modal Awal Kasir Hari Ini</h3>
                <span class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </span>
            </div>
            <p class="text-2xl font-bold text-slate-800">Rp {{ number_format($modalAwalHariIni, 0, ',', '.') }}</p>
            <p class="text-xs text-slate-500 mt-1">Uang kembalian yang disiapkan untuk kasir</p>
        </div>

        <!-- Card 2: Penjualan Tunai Hari Ini -->
        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
            <div class="flex justify-between items-start mb-2">
                <h3 class="text-sm font-semibold text-slate-600">Total Penjualan Tunai Hari Ini</h3>
                <span class="p-2 bg-emerald-100 rounded-lg">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </span>
            </div>
            <p class="text-2xl font-bold text-emerald-600">Rp {{ number_format($todayCashSales, 0, ',', '.') }}</p>
            <p class="text-xs text-slate-500 mt-1">Akumulasi penerimaan uang tunai masuk</p>
        </div>

        <!-- Card 3: Total Kas Fisik di Kasir Saat Ini -->
        <div class="bg-gradient-to-br from-blue-600 to-indigo-700 p-5 rounded-xl text-white shadow-md">
            <div class="flex justify-between items-start mb-2">
                <h3 class="text-sm font-semibold text-blue-100">Uang Fisik Kasir Saat Ini</h3>
                <span class="p-2 bg-white/20 rounded-lg backdrop-blur-sm">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                </span>
            </div>
            <p class="text-2xl font-bold">Rp {{ number_format($totalKasFisikHariIni, 0, ',', '.') }}</p>
            <p class="text-xs text-blue-200 mt-1">Modal Awal + Transaksi Tunai (Harus sesuai uang di laci)</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form Input Modal Awal -->
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
            <h2 class="text-base font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                {{ $todayModal ? 'Perbarui Modal Hari Ini' : 'Input Modal Awal Kasir' }}
            </h2>

            <form action="{{ route('admin.modal_kasir.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="tanggal" class="block text-xs font-semibold text-slate-600 uppercase mb-1">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" 
                        value="{{ old('tanggal', date('Y-m-d')) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <div>
                    <label for="modal_awal" class="block text-xs font-semibold text-slate-600 uppercase mb-1">Jumlah Modal Awal (Rp)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 text-sm font-semibold">Rp</span>
                        <input type="number" id="modal_awal" name="modal_awal" 
                            value="{{ old('modal_awal', $todayModal->modal_awal ?? '') }}" 
                            placeholder="Contoh: 100000"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" required min="0">
                    </div>
                    <p class="text-[11px] text-slate-500 mt-1">Uang pecahan yang diserahkan ke kasir untuk kembalian.</p>
                </div>

                <div>
                    <label for="keterangan" class="block text-xs font-semibold text-slate-600 uppercase mb-1">Catatan / Keterangan</label>
                    <textarea id="keterangan" name="keterangan" rows="3"
                        placeholder="Contoh: Pecahan 2.000, 5.000, dan 10.000"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('keterangan', $todayModal->keterangan ?? '') }}</textarea>
                </div>

                <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm transition duration-200 text-sm">
                    Simpan Modal Kasir
                </button>
            </form>
        </div>

        <!-- Tabel Riwayat Modal Kasir Harian -->
        <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-800 mb-4">Riwayat Modal Awal Kasir</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Tanggal</th>
                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Modal Awal</th>
                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Catatan</th>
                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Diinput Oleh</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($historyModal as $item)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-4 py-3 whitespace-nowrap font-medium text-slate-800">
                                        {{ $item->tanggal ? $item->tanggal->format('d M Y') : '-' }}
                                        @if($item->tanggal && $item->tanggal->isToday())
                                            <span class="ml-1 text-[10px] bg-blue-100 text-blue-700 px-1.5 py-0.5 rounded-full font-semibold">Hari Ini</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap font-semibold text-slate-900">
                                        Rp {{ number_format($item->modal_awal, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-slate-600">
                                        {{ $item->keterangan ?: '-' }}
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-slate-500 text-xs">
                                        {{ $item->user->name ?? 'Admin' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-6 text-slate-400">
                                        Belum ada riwayat modal kasir yang dicatat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($historyModal->hasPages())
                <div class="mt-4 pt-3 border-t border-gray-100">
                    {{ $historyModal->links() }}
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
