import './bootstrap';


document.addEventListener('DOMContentLoaded', () => {

    const sidebar = document.getElementById('main-sidebar');
    const mainContent = document.getElementById('main-content');
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const desktopMinimizeBtn = document.getElementById('desktop-minimize-btn');
    const backdrop = document.getElementById('sidebar-backdrop');
    const logoText = document.getElementById('sidebar-logo-text');
    const sidebarTexts = document.querySelectorAll('.sidebar-text');

    // Cek elemen penting
    if (sidebar && mainContent && hamburgerBtn && backdrop && desktopMinimizeBtn) {

        const toggleMobileSidebar = () => {
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        };

        hamburgerBtn.addEventListener('click', toggleMobileSidebar);
        backdrop.addEventListener('click', toggleMobileSidebar);

        desktopMinimizeBtn.addEventListener('click', () => {
            // ... your existing minimize logic ...
            if (sidebar.classList.contains('w-64')) {
                sidebar.classList.replace('w-64', 'w-20');
                mainContent.classList.replace('lg:ml-64', 'lg:ml-20');
            } else {
                sidebar.classList.replace('w-20', 'w-64');
                mainContent.classList.replace('lg:ml-20', 'lg:ml-64');
            }
        });

        console.log("Sidebar JS: Loaded successfully.");
    } else {
        console.warn("Sidebar JS: One or more IDs are missing from the HTML.");
    }

    const minimizeIcon = desktopMinimizeBtn.querySelector('svg');
    const iconMinimize = '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />';
    const iconExpand = '<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />';

    // --- LOGIKA UNTUK MOBILE (REVISI V3: Tidak merusak state desktop) ---
    const toggleMobileSidebar = () => {

        // REVISI: Logika ini tidak boleh mengubah state w-64/w-20
        // Cukup tampilkan/sembunyikan sidebar mobile
        sidebar.classList.toggle('-translate-x-full');
        backdrop.classList.toggle('hidden');
    };

    hamburgerBtn.addEventListener('click', toggleMobileSidebar);
    backdrop.addEventListener('click', toggleMobileSidebar);


    // --- LOGIKA UNTUK MINIMIZE DESKTOP (Logika ini sudah benar) ---
    desktopMinimizeBtn.addEventListener('click', () => {

        if (sidebar.classList.contains('w-64')) {
            // --- Menjadi Minimize (w-20) ---
            sidebar.classList.remove('w-64');
            sidebar.classList.add('w-20');

            // REVISI: Logika margin konten yang robust
            mainContent.classList.remove('lg:ml-64');
            mainContent.classList.add('lg:ml-20'); // <-- Ini yang butuh "umpan" JIT

            // Sembunyikan teks
            if (logoText) logoText.classList.add('hidden');
            sidebarTexts.forEach(text => text.classList.add('hidden'));

            // Ganti ikon ke "expand"
            if (minimizeIcon) minimizeIcon.innerHTML = iconExpand;

        } else {
            // --- Menjadi Penuh (w-64) ---
            sidebar.classList.add('w-64');
            sidebar.classList.remove('w-20');

            // REVISI: Logika margin konten yang robust
            mainContent.classList.add('lg:ml-64');
            mainContent.classList.remove('lg:ml-20');

            // Tampilkan teks
            if (logoText) logoText.classList.remove('hidden');
            sidebarTexts.forEach(text => text.classList.remove('hidden'));

            // Ganti ikon ke "minimize"
            if (minimizeIcon) minimizeIcon.innerHTML = iconMinimize;
        }
    });

});



