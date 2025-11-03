// Menunggu sampai semua konten HTML dimuat
document.addEventListener('DOMContentLoaded', () => {

    // Ambil semua elemen yang kita butuhkan
    const sidebar = document.getElementById('main-sidebar');
    const mainContent = document.getElementById('main-content');
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const minimizeBtn = document.getElementById('minimize-btn');
    const backdrop = document.getElementById('sidebar-backdrop');
    const logoText = document.getElementById('sidebar-logo-text');
    const sidebarTexts = document.querySelectorAll('.sidebar-text');

    // Cek apakah elemen-elemen ada (penting agar tidak error jika di layout lain)
    if (!sidebar || !mainContent || !hamburgerBtn || !minimizeBtn || !backdrop) {
        console.log('Elemen sidebar tidak ditemukan di halaman ini.');
        return; // Hentikan script jika elemen tidak ada
    }

    // 1. FUNGSI UNTUK HAMBURGER (MOBILE/TABLET)
    const toggleMobileSidebar = () => {
        sidebar.classList.toggle('-translate-x-full'); // Tampilkan/Sembunyikan sidebar
        backdrop.classList.toggle('hidden'); // Tampilkan/Sembunyikan backdrop
    };

    // Klik tombol hamburger
    hamburgerBtn.addEventListener('click', toggleMobileSidebar);

    // Klik backdrop (untuk menutup)
    backdrop.addEventListener('click', toggleMobileSidebar);


    // 2. FUNGSI UNTUK MINIMIZE (DESKTOP)
    minimizeBtn.addEventListener('click', () => {
        // Toggle lebar sidebar
        sidebar.classList.toggle('w-64'); // Lebar penuh
        sidebar.classList.toggle('w-20'); // Lebar minimize (hanya ikon)

        // Toggle margin konten utama
        mainContent.classList.toggle('lg:ml-64');
        mainContent.classList.toggle('lg:ml-20');

        // Sembunyikan semua teks menu
        sidebarTexts.forEach(text => {
            text.classList.toggle('hidden');
        });

        // Sembunyikan teks logo
        if (logoText) {
            logoText.classList.toggle('hidden');
        }

        // Ubah ikon tombol minimize (opsional, tapi bagus)
        const minimizeIcon = minimizeBtn.querySelector('svg');
        if (sidebar.classList.contains('w-20')) {
            // Jika sidebar kecil, tunjukkan ikon "expand"
            minimizeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />';
        } else {
            // Jika sidebar besar, tunjukkan ikon "minimize"
            minimizeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />';
        }
    });

});
