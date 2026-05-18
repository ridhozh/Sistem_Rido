<aside id="main-sidebar"
    class="w-64 flex-col fixed inset-y-0 bg-slate-50 border-r border-gray-200 shadow-xl z-30 
           transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-in-out">

    <div class="flex flex-col h-full bg-white/80 backdrop-blur-md">
        <div class="h-20 flex items-center justify-between px-6 border-b border-gray-100 flex-shrink-0">
            <a href="#" class="flex items-center gap-2 group" id="sidebar-logo-text">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-200">
                    <span class="text-white font-bold text-sm">H</span>
                </div>
                <span
                    class="text-lg font-extrabold tracking-tight text-slate-800 group-hover:text-blue-600 transition-colors">
                    TOSERBA <span class="text-blue-600">HASAN</span>
                </span>
            </a>

            <button id="desktop-minimize-btn"
                class="hidden lg:flex p-1.5 rounded-full hover:bg-slate-100 text-slate-400 hover:text-blue-600 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke-width="2.5" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
        </div>

        <nav class="flex-1 overflow-y-auto py-6 px-4 custom-scrollbar">
            <p
                class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-4 mb-4 sidebar-text transition-opacity duration-300">
                Menu Utama
            </p>

            <ul class="space-y-1.5">
                @php $current = request()->segment(2); @endphp

                <li>
                    <a href="{{ route('kasir') }}"
                        class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 relative
                {{ request()->routeIs('kasir')
                    ? 'bg-blue-600 text-white shadow-lg shadow-blue-100'
                    : 'text-slate-600 hover:bg-white hover:shadow-md hover:text-blue-600' }}">

                        <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-200 group-hover:scale-110"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="ml-3 font-semibold sidebar-text whitespace-nowrap">Dashboard</span>

                        @if (request()->routeIs('kasir'))
                            <div class="absolute right-2 w-1.5 h-1.5 bg-white rounded-full sidebar-text"></div>
                        @endif
                    </a>
                </li>

                <li>
                    <a href="{{ route('kasir.transaksi') }}"
                        class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 relative
                {{ request()->routeIs('kasir.transaksi')
                    ? 'bg-blue-600 text-white shadow-lg shadow-blue-100'
                    : 'text-slate-600 hover:bg-white hover:shadow-md hover:text-blue-600' }}">

                        <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-200 group-hover:scale-110"
                            fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                        <span class="ml-3 font-semibold sidebar-text whitespace-nowrap">Transaksi</span>

                        @if (request()->routeIs('kasir.transaksi'))
                            <div class="absolute right-2 w-1.5 h-1.5 bg-white rounded-full sidebar-text"></div>
                        @endif
                    </a>
                </li>

                <li>
                    <a href="{{ route('kasir.stok_barang') }}"
                        class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 relative
                {{ request()->routeIs('kasir.stok_barang')
                    ? 'bg-blue-600 text-white shadow-lg shadow-blue-100'
                    : 'text-slate-600 hover:bg-white hover:shadow-md hover:text-blue-600' }}">

                        <svg class="w-5 h-5 flex-shrink-0 transition-transform duration-200 group-hover:scale-110"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                        </svg>
                        <span class="ml-3 font-semibold sidebar-text whitespace-nowrap">Stok Barang</span>

                        @if (request()->routeIs('kasir.stok_barang'))
                            <div class="absolute right-2 w-1.5 h-1.5 bg-white rounded-full sidebar-text"></div>
                        @endif
                    </a>
                </li>
            </ul>
        </nav>

        <div class="p-4 bg-slate-50/50">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="group flex w-full items-center px-4 py-3 rounded-xl text-rose-500 hover:bg-rose-50 transition-all duration-200 font-semibold">
                    <div
                        class="p-2 rounded-lg bg-rose-100 text-rose-600 group-hover:bg-rose-500 group-hover:text-white transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke-width="2.5" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                    </div>
                    <span class="ml-3 sidebar-text">Keluar Aplikasi</span>
                </button>
            </form>
        </div>
    </div>
</aside>
