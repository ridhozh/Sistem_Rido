@extends('kasir.layouts.layout')

@section('title', 'Transaksi Kasir - Toserba Hasan')
@section('page-title', 'Transaksi Baru')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white p-6 rounded-[2.5rem] border border-gray-100 shadow-sm">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Katalog Produk
                        </h2>
                    </div>

                    <div class="relative w-full md:w-80">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" placeholder="Cari barang..."
                            class="block w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all outline-none text-sm">
                    </div>
                </div>

                <div class="overflow-y-auto pr-2 custom-scrollbar" style="max-height: 700px;">
                    @foreach ($categories as $category)
                        @if ($category->produks->count() > 0)
                            <div class="category-section mb-12">
                                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-6 ml-1">
                                    {{ $category->nama_kategori }}
                                </h3>

                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                                    @foreach ($category->produks as $item)
                                        <div
                                            class="group bg-white border border-slate-100 rounded-[2rem] p-3 shadow-sm hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300">

                                            <div
                                                class="relative w-full aspect-square rounded-[1.5rem] mb-4 overflow-hidden bg-slate-50">
                                                <img src="{{ asset('storage/' . $item->foto_produk) }}"
                                                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                                    alt="{{ $item->nama_produk }}">

                                                <button type="button" data-id="{{ $item->id }}"
                                                    data-name="{{ $item->nama_produk }}" data-price="{{ $item->harga }}"
                                                    class="btn-add-to-cart absolute bottom-2 right-2 bg-blue-600 text-white p-2.5 rounded-xl shadow-lg transform translate-y-12 group-hover:translate-y-0 transition-all duration-300 z-10">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-width="2.5" d="M12 4.5v15m7.5-7.5h-15" />
                                                    </svg>
                                                </button>
                                            </div>

                                            <div class="px-1 text-center sm:text-left">
                                                <h3 class="text-[11px] font-bold text-slate-700 truncate mb-1">
                                                    {{ $item->nama_produk }}</h3>
                                                <p class="text-sm font-black text-blue-600">
                                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                                </p>
                                                <p class="text-[9px] text-slate-400 mt-1 italic">Stok:
                                                    {{ $item->stok_awal }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 space-y-6">

            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white p-6 rounded-[2.5rem] border border-gray-100 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-3">
                        <div class="p-2 bg-blue-50 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2.5"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        Ringkasan
                    </h2>

                    <div id="ringkasan-list" class="space-y-4 overflow-y-auto pr-1 mb-6" style="max-height: 250px;">
                    </div>

                    <div class="bg-slate-900 p-6 rounded-[2rem] text-white shadow-xl">
                        <div class="space-y-2">
                            <div class="flex justify-between items-center text-slate-400 text-xs">
                                <span>Subtotal</span>
                                <span id="subtotal-display" class="font-bold text-white">Rp 0</span>
                            </div>
                            <div class="pt-4 border-t border-slate-800">
                                <p class="text-[10px] text-slate-400 mb-1 uppercase tracking-widest">Total Tagihan</p>
                                <p id="total-tagihan" class="text-3xl font-black text-blue-400">Rp 0</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2.5rem] border border-gray-100 shadow-sm">
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 gap-4">
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Metode
                                    Bayar</label>
                                <select id="metode-bayar" onchange="toggleTunaiFields()"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-700 outline-none">
                                    <option value="midtrans" selected>QRIS / Transfer (Midtrans)</option>
                                    <option value="tunai">Tunai</option>
                                </select>
                            </div>
                        </div>

                        <div id="tunai-fields" class="space-y-4 hidden">
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Uang
                                    Bayar</label>
                                <input type="number" id="input-bayar" value="0"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-black text-blue-600 outline-none">
                            </div>

                            <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl flex justify-between items-center">
                                <span class="text-[10px] font-bold text-blue-800/50 uppercase">Kembalian</span>
                                <span id="kembalian-text" class="text-xl font-black text-blue-600">Rp 0</span>
                            </div>
                        </div>

                        <button onclick="prosesTransaksi()"
                            class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold text-sm transition-all shadow-lg shadow-blue-500/25 flex items-center justify-center gap-2">
                            PROSES TRANSAKSI
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-12 mt-4">
            <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-lg font-bold text-slate-800">Detail Barang Terpilih</h2>
                    <span id="jenis-produk-count"
                        class="px-4 py-1.5 bg-slate-100 text-slate-600 rounded-full text-[10px] font-bold uppercase">0 Jenis
                        Produk</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead>
                            <tr class="text-slate-400">
                                <th class="px-6 py-4 text-left text-[10px] font-bold uppercase tracking-widest">Nama Produk
                                </th>
                                <th class="px-6 py-4 text-left text-[10px] font-bold uppercase tracking-widest">Harga</th>
                                <th class="px-6 py-4 text-left text-[10px] font-bold uppercase tracking-widest">Qty</th>
                                <th class="px-6 py-4 text-left text-[10px] font-bold uppercase tracking-widest">Subtotal
                                </th>
                                <th class="px-6 py-4 text-right text-[10px] font-bold uppercase tracking-widest">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="keranjang-items" class="divide-y divide-slate-50">
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic text-sm">
                                    Belum ada barang yang dipilih.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
    </style>
@endsection

@push('scripts')
    @php
        $isProduction = config('services.midtrans.isProduction');
        $clientKey = config('services.midtrans.clientKey');
        $snapUrl = $isProduction ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js';
    @endphp
    <script src="{{ $snapUrl }}" data-client-key="{{ $clientKey }}"></script>
    <script>
        let cart = [];

        // Add Item to Cart (Triggered by Katalog Buttons)
        document.addEventListener('click', function(e) {
            const button = e.target.closest('.btn-add-to-cart');
            if (button) {
                const id = button.dataset.id;
                const name = button.dataset.name;
                const price = Number(button.dataset.price);
                addToCart(id, name, price);
            }
        });

        function addToCart(id, name, price) {
            const existingItem = cart.find(item => item.id === id);
            if (existingItem) {
                existingItem.qty += 1;
                existingItem.subtotal = existingItem.qty * existingItem.price;
            } else {
                cart.push({
                    id,
                    name,
                    price,
                    qty: 1,
                    subtotal: price
                });
            }
            renderEverything();
        }

        // Change Quantity (+ / -)
        function changeQty(id, delta) {
            const item = cart.find(item => item.id == id);
            if (item) {
                item.qty += delta;
                if (item.qty <= 0) {
                    removeFromCart(id);
                } else {
                    item.subtotal = item.qty * item.price;
                    renderEverything();
                }
            }
        }

        function removeFromCart(id) {
            cart = cart.filter(item => item.id != id);
            renderEverything();
        }

        function renderEverything() {
            const tbody = document.getElementById('keranjang-items');
            const sidebarList = document.getElementById('ringkasan-list');

            tbody.innerHTML = '';
            sidebarList.innerHTML = '';

            if (cart.length === 0) {
                tbody.innerHTML =
                    '<tr><td colspan="5" class="px-6 py-12 text-center text-slate-400 italic">Belum ada barang dipilih.</td></tr>';
                sidebarList.innerHTML = '<p class="text-center text-slate-400 text-xs py-4">Keranjang kosong</p>';
                updateSummary(0);
                return;
            }

            let grandTotal = 0;

            cart.forEach(item => {
                grandTotal += item.subtotal;

                // Render Bottom Table
                tbody.insertAdjacentHTML('beforeend', `
                <tr>
                    <td class="px-6 py-4 text-sm font-bold text-slate-700">${item.name}</td>
                    <td class="px-6 py-4 text-sm text-slate-500">Rp ${item.price.toLocaleString('id-ID')}</td>
                    <td class="px-6 py-4 text-sm text-slate-700 font-bold">${item.qty}</td>
                    <td class="px-6 py-4 text-sm text-blue-600 font-black">Rp ${item.subtotal.toLocaleString('id-ID')}</td>
                    <td class="px-6 py-4 text-right">
                        <button onclick="removeFromCart('${item.id}')" class="text-red-400 hover:text-red-600">Hapus</button>
                    </td>
                </tr>
            `);

                // Render Sidebar Ringkasan
                sidebarList.insertAdjacentHTML('beforeend', `
                <div class="flex items-center gap-3 bg-slate-50/80 p-3 rounded-2xl border border-slate-100">
                    <div class="flex-1 min-w-0">
                        <h4 class="font-bold text-slate-800 text-xs truncate">${item.name}</h4>
                        <p class="text-[10px] text-slate-500">Rp ${item.price.toLocaleString('id-ID')} x ${item.qty}</p>
                    </div>
                    <div class="flex items-center bg-white rounded-lg border border-slate-200 p-1">
                        <button onclick="changeQty('${item.id}', -1)" class="w-5 h-5 flex items-center justify-center text-slate-400">-</button>
                        <span class="w-6 text-center font-bold text-xs">${item.qty}</span>
                        <button onclick="changeQty('${item.id}', 1)" class="w-5 h-5 flex items-center justify-center text-slate-400">+</button>
                    </div>
                </div>
            `);
            });

            updateSummary(grandTotal);
        }

        function updateSummary(total) {
            document.getElementById('subtotal-display').innerText = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('total-tagihan').innerText = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('jenis-produk-count').innerText = `${cart.length} Jenis Produk`;
            hitungKembalian(); // Recalculate change whenever total changes
        }

        // Hitung Kembalian Logic
        document.addEventListener('DOMContentLoaded', function() {
            const inputBayar = document.getElementById('input-bayar');

            // Trigger calculation every time a key is pressed
            if (inputBayar) {
                inputBayar.addEventListener('input', hitungKembalian);
            }
        });

        function hitungKembalian() {
            // 1. Get the Total Tagihan (Strip "Rp" and "." so it becomes a number)
            const totalElement = document.getElementById('total-tagihan');
            if (!totalElement) return;

            const totalValue = parseInt(totalElement.innerText.replace(/[^0-9]/g, '')) || 0;

            // 2. Get the amount paid by the customer
            const bayarValue = parseInt(document.getElementById('input-bayar').value) || 0;

            // 3. Calculate Change
            const kembalian = bayarValue - totalValue;

            // 4. Display the result
            const kembalianDisplay = document.getElementById('kembalian-text');

            if (kembalian < 0) {
                kembalianDisplay.innerText = "Rp 0";
                kembalianDisplay.classList.add('text-red-500'); // Optional: show red if not enough
            } else {
                kembalianDisplay.innerText = "Rp " + kembalian.toLocaleString('id-ID');
                kembalianDisplay.classList.remove('text-red-500');
            }
        }

        function toggleTunaiFields() {
            const metodeBayar = document.getElementById('metode-bayar').value;
            const tunaiFields = document.getElementById('tunai-fields');
            if (metodeBayar === 'tunai') {
                tunaiFields.classList.remove('hidden');
            } else {
                tunaiFields.classList.add('hidden');
            }
        }

        function prosesTransaksi() {
            if (cart.length === 0) return alert("Keranjang masih kosong!");
            
            const metodeBayar = document.getElementById('metode-bayar').value;

            if (metodeBayar === 'tunai') {
                const totalValue = parseInt(document.getElementById('total-tagihan').innerText.replace(/[^0-9]/g, '')) || 0;
                const bayarValue = parseInt(document.getElementById('input-bayar').value) || 0;
                
                if (bayarValue < totalValue) {
                    return alert("Uang pembayaran kurang!");
                }

                alert("Transaksi Tunai Berhasil diproses!");
                cart = [];
                renderEverything();
                document.getElementById('input-bayar').value = 0;
                hitungKembalian();
                return;
            }

            // Proses Midtrans
            const btnProses = document.querySelector('button[onclick="prosesTransaksi()"]');
            const originalText = btnProses.innerHTML;
            btnProses.innerHTML = '<span class="flex items-center justify-center gap-2"><svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> MEMPROSES...</span>';
            btnProses.disabled = true;

            fetch('{{ route('kasir.transaksi.checkout') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ cart: cart })
            })
            .then(response => response.json())
            .then(data => {
                btnProses.innerHTML = originalText;
                btnProses.disabled = false;

                if (data.status === 'success') {
                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result){
                            alert("Pembayaran Berhasil! Order ID: " + data.order_id);
                            cart = [];
                            renderEverything();
                            document.getElementById('input-bayar').value = 0;
                            hitungKembalian();
                        },
                        onPending: function(result){
                            alert("Menunggu pembayaran Anda!");
                        },
                        onError: function(result){
                            alert("Pembayaran Gagal!");
                        },
                        onClose: function(){
                            alert("Anda menutup halaman sebelum menyelesaikan pembayaran!");
                        }
                    });
                } else {
                    alert("Gagal memproses transaksi: " + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                btnProses.innerHTML = originalText;
                btnProses.disabled = false;
                console.error('Error:', error);
                alert("Terjadi kesalahan pada sistem!");
            });
        }
    </script>
@endpush
