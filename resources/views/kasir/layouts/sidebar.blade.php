<aside id="main-sidebar"
    class="w-64 flex-col fixed inset-y-0 bg-white border-r border-gray-200 shadow-sm z-30
           transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">

    <div class="flex flex-col h-full">
        <!-- Header Sidebar (Logo & Tombol Minimize) -->
        <div class="h-16 flex items-center justify-between px-4 border-b border-gray-200 flex-shrink-0">
            <!-- Teks Logo -->
            <a href="#" class="text-xl font-bold text-blue-500" id="sidebar-logo-text">
                TOSERBA HASAN
            </a>

            <button id="desktop-minimize-btn" class="hidden lg:block text-slate-500 hover:text-slate-700">
                <!-- Ikon "minimize" (kiri) -->
                <svg class="w-6 h-6" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
        </div>

        <!-- Navigasi Utama -->
        <nav class="flex-1 overflow-y-auto p-4">
            <ul class="space-y-2">

                @php $current = request()->segment(2); @endphp

                <li>
                    <a href="{{ route('kasir') }}"
                        class="flex items-center p-3 rounded-lg transition duration-200 h-12 font-medium
{{ request()->routeIs('kasir') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100' }}">

                        <!-- Icon Dashboard  -->
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>

                        <span class="ml-3 font-medium sidebar-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kasir.transaksi') }}"
                        class="flex items-center p-3 rounded-lg transition duration-200 h-12 font-medium
{{ request()->routeIs('kasir.transaksi') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100' }}">

                        <!-- Icon Transaksi  -->
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" /></svg>
                        <span class="ml-3 font-medium sidebar-text">Transaksi</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('kasir.stok_barang') }}"
                        class="flex items-center p-3 rounded-lg transition duration-200 h-12 font-medium
{{ request()->routeIs('kasir.stok_barang') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100' }}">

                        <!-- Icon stok barang (IKON DIPERBAIKI) -->
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" /></svg>
                        <span class="ml-3 font-medium sidebar-text">Stok Barang</span>
                    </a>
                </li>

            </ul>
        </nav>

        <!-- Footer Sidebar (Hanya Logout) -->
        <div class="p-4 border-t border-gray-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center p-3 rounded-lg transition duration-200 h-12 text-slate-600 hover:bg-slate-100">

                    <!-- Icon Logout (IKON DIPERBAIKI) -->
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke-width="2" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    <span class="ml-3 font-medium sidebar-text">Logout</span>
                </button>
            </form>

        </div>

    </div>
</aside>
