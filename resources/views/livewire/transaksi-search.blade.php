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
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari barang..."
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
                                <div wire:key="product-card-{{ $item->id }}"
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
