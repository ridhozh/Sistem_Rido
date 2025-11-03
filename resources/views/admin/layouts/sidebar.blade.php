<aside id="main-sidebar"
    class="w-64 flex-col fixed inset-y-0 bg-white border-r border-gray-200 shadow-sm z-30
           transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">

    <div class="flex flex-col h-full">
        <!-- Header Sidebar (Logo & Tombol Minimize) -->
        <div class="h-16 flex items-center justify-between px-4 border-b border-gray-200 flex-shrink-0">
            <!-- Teks Logo -->
            <a href="#" class="text-xl font-bold text-slate-800" id="sidebar-logo-text">
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
                    <a href="{{ route('admin') }}"
                        class="flex items-center p-3 rounded-lg transition duration-200 h-12 font-medium
{{ request()->routeIs('admin') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100' }}">

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
                    <a href="{{ route('admin.products') }}"
                        class="flex items-center p-3 rounded-lg transition duration-200 h-12 font-medium
{{ request()->routeIs('admin.products') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100' }}">

                        <!-- Icon Produk  -->
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10.5 11.25h3M12 15h.008m-7.5 0h15" />
                        </svg>
                        <span class="ml-3 font-medium sidebar-text">Produk</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.laporan') }}"
                        class="flex items-center p-3 rounded-lg transition duration-200 h-12 font-medium
{{ request()->routeIs('admin.laporan') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100' }}">

                        <!-- Icon Laporan (IKON DIPERBAIKI) -->
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                        </svg>
                        <span class="ml-3 font-medium sidebar-text">Laporan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.manage_pengguna') }}"
                        class="flex items-center p-3 rounded-lg transition duration-200 h-12 font-medium
{{ request()->routeIs('admin.manage_pengguna') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100' }}">

                        <!-- Icon Pengguna (IKON DIPERBAIKI) -->
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.003c0 1.113.285 2.16.786 3.07M15 19.128c.331.18.681.303 1.05.372M9 11.25a3 3 0 100-6 3 3 0 000 6zM12 15a5.25 5.25 0 00-5.25 5.25H17.25a5.25 5.25 0 00-5.25-5.25z" />
                        </svg>
                        <span class="ml-3 font-medium sidebar-text">Pengguna</span>
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
