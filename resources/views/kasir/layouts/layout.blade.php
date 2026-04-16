<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kasir - Toserba Hasan')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('scripts')
</head>

<body class="bg-slate-50 overflow-x-hidden">



    @include('kasir.layouts.sidebar')

    <div id="sidebar-backdrop" class="fixed inset-0 bg-black/30 z-20 hidden"></div>

    <!-- Konten Utama: Kelas lg:ml-64 adalah default -->
    <div id="main-content" class="flex-1 flex flex-col lg:ml-64 transition-all duration-300 ease-in-out">

        <!-- Header -->
        <header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-10">
            <div class="px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

                <!-- Tombol Hamburger (Mobile) -->
                <button id="hamburger-btn" class="lg:hidden text-slate-500 hover:text-slate-700">
                    <span class="sr-only">Buka sidebar</span>
                    <svg class="w-6 h-6" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <!-- Judul Halaman (Desktop) -->
                <h1 class="text-xl font-semibold text-slate-800 hidden lg:block">
                    @yield('page-title', 'Dashboard')
                </h1>

                <!-- Info Pengguna -->
                <div class="flex items-center">
                    <div class="text-right">
                        <div class="text-sm font-medium text-slate-700">Nama Kasir</div>
                        <div class="text-xs text-slate-500">Kasir Toserba Hasan</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Konten Halaman Dinamis -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>

</html>
