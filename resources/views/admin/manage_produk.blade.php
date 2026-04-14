@extends('admin.layouts.layout')

@section('title', 'Manajemen Produk - Toserba Hasan')
@section('page-title', 'Manajemen Produk')

@section('content')

    <div class="fixed top-10 inset-x-0 z-[100] flex flex-col items-center pointer-events-none space-y-4">

        @if ($errors->any())
            <div id="toast-error"
                class="pointer-events-auto min-w-[320px] max-w-md bg-white/80 backdrop-blur-lg border border-red-200 shadow-2xl rounded-2xl overflow-hidden transform transition-all duration-500">
                <div class="p-4 flex items-start space-x-4">
                    <div class="flex-shrink-0 bg-red-100 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-gray-900 font-bold text-sm">Terjadi Kesalahan</h3>
                        <ul class="text-xs text-gray-600 mt-1 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button onclick="closeToast('toast-error')" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" />
                        </svg>
                    </button>
                </div>
                <div class="h-1 bg-red-100 w-full">
                    <div id="error-progress" class="h-1 bg-red-500 transition-all linear duration-[5000ms] w-full"></div>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div id="toast-success"
                class="pointer-events-auto min-w-[320px] max-w-md bg-white/80 backdrop-blur-lg border border-emerald-200 shadow-2xl rounded-2xl overflow-hidden transform transition-all duration-500">
                <div class="p-4 flex items-center space-x-4">
                    <div class="flex-shrink-0 bg-emerald-100 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-gray-900 font-bold text-sm">Berhasil!</h3>
                        <p class="text-xs text-gray-600">{{ session('success') }}</p>
                    </div>
                    <button onclick="closeToast('toast-success')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" />
                        </svg>
                    </button>
                </div>
                <div class="h-1 bg-emerald-100 w-full">
                    <div id="success-progress" class="h-1 bg-emerald-500 transition-all linear duration-[5000ms] w-full">
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Kontainer Utama -->
    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-slate-700">Daftar Produk</h2>
            <button id="btn-tambah-produk"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 inline-flex items-center space-x-2">
                <!-- Icon Plus -->
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Tambah Produk</span>
            </button>
        </div>

        <!-- Tabel Responsif -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Produk</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($products as $produk)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $produk->nama_produk }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $produk->kategori->nama_kategori ?? 'Tanpa Kategori' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp
                                {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $produk->stok_awal }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                <button class="btn-edit text-indigo-600 hover:text-indigo-900" data-id="{{ $produk->id }}"
                                    data-nama="{{ $produk->nama_produk }}" data-kategori="{{ $produk->kategori_id }}"
                                    data-harga="{{ $produk->harga }}" data-stok="{{ $produk->stok_awal }}"
                                    data-foto="{{ $produk->foto_produk }}">
                                    Edit
                                </button>
                                <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Hapus produk ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center bg-gray-50">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <span class="text-gray-500 font-medium text-lg">Belum ada produk di toko ini.</span>
                                    <p class="text-gray-400 text-sm">Silahkan tambahkan produk baru melalui form di atas.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <!-- Modal Tambah/Edit Produk -->
    <div id="modal-produk" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-lg">

            <!-- Header Modal -->
            <div class="flex justify-between items-center mb-4">
                <h3 id="modal-title" class="text-lg font-semibold text-slate-800">Tambah Produk Baru</h3>
                <button id="btn-tutup-modal" class="text-gray-500 hover:text-gray-800">&times;</button>
            </div>

            <!-- Form di dalam Modal -->
            <form id="form-produk" action="{{ route('admin.produk.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="produk-id" name="produk_id">

                <div class="space-y-4">
                    <div>
                        <label for="nama_produk" class="block text-sm font-medium text-slate-700">Nama Produk</label>
                        <input type="text" id="nama_produk" name="nama_produk"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="nama_produk" class="block text-sm font-medium text-slate-700">Foto Produk</label>
                        <input type="file" name="foto_produk" class="form-control border rounded w-full py-2 px-3">

                        <div id="file-info" class="mt-2 text-xs text-gray-500 hidden italic">
                            <span class="text-blue-600 font-semibold">Catatan:</span> Sudah ada gambar tersimpan. Biarkan
                            kosong jika tidak ingin mengubahnya.
                            <div id="preview-container" class="mt-1">
                                <img id="old-photo-preview" src=""
                                    class="h-10 w-10 object-cover rounded border shadow-sm hidden">
                            </div>
                        </div>

                    </div>
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-slate-700">Kategori</label>
                        <select id="kategori" name="kategori_id"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="harga" class="block text-sm font-medium text-slate-700">Harga</label>
                        <input type="number" id="harga" name="harga"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="stok_awal" class="block text-sm font-medium text-slate-700">Stok Awal</label>
                        <input type="number" id="stok_awal" name="stok_awal"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Footer Modal [cite: 87] -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" id="btn-batal"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Menjalankan script setelah dokumen siap
        document.addEventListener('DOMContentLoaded', function() {

            const modal = document.getElementById('modal-produk');
            const formProduk = document.getElementById('form-produk');
            const btnTambah = document.getElementById('btn-tambah-produk');
            const btnTutupModal = document.getElementById('btn-tutup-modal');
            const btnBatal = document.getElementById('btn-batal');
            const modalTitle = document.getElementById('modal-title');


            // Fungsi untuk menampilkan modal
            const bukaModal = (mode = 'tambah', data = null) => {
                // Reset form (jika perlu)
                formProduk.reset();
                const existingMethod = formProduk.querySelector('input[name="_method"]');
                if (existingMethod) existingMethod.remove();

                if (mode === 'edit' && data) {
                    modalTitle.textContent = 'Edit Produk';
                    formProduk.action = `/admin/produk/${data.id}`;

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    formProduk.appendChild(methodInput);

                    if (document.getElementById('produk-id')) document.getElementById('produk-id').value = data
                        .id;
                    if (document.getElementById('nama_produk')) document.getElementById('nama_produk').value =
                        data.nama;
                    if (document.getElementById('kategori')) document.getElementById('kategori').value = data
                        .kategori_id;
                    if (document.getElementById('harga')) document.getElementById('harga').value = data.harga;
                    if (document.getElementById('stok_awal')) document.getElementById('stok_awal').value = data
                        .stok;
                    const fileInfo = document.getElementById('file-info');
                    const photoPreview = document.getElementById('old-photo-preview');

                    if (fileInfo && photoPreview) {
                        // Jika ada data foto (tidak null dan tidak kosong)
                        if (data.foto && data.foto !== '') {
                            fileInfo.classList.remove('hidden');

                            // Pastikan path image sesuai dengan folder storage Anda
                            photoPreview.src = `/storage/${data.foto}`;
                            photoPreview.classList.remove('hidden');
                        } else {
                            // Jika tidak ada foto, pastikan info ini tersembunyi
                            fileInfo.classList.add('hidden');
                            photoPreview.classList.add('hidden');
                        }
                    }

                } else {
                    modalTitle.textContent = 'Tambah Produk Baru';
                    // Kembalikan action ke route STORE
                    formProduk.action = "{{ route('admin.produk.store') }}";
                    document.getElementById('produk-id').value = '';
                }
                modal.classList.remove('hidden');
            };

            // Fungsi untuk menutup modal
            const tutupModal = () => {
                modal.classList.add('hidden');
            };

            // Event listener untuk tombol Tambah
            if (btnTambah) btnTambah.addEventListener('click', () => bukaModal('tambah'));

            // Event listener untuk tombol Edit (perlu delegasi event)
            document.addEventListener('click', function(e) {
                // Cari apakah yang diklik adalah tombol edit atau icon di dalam tombol edit
                const btnEdit = e.target.closest('.btn-edit');
                if (btnEdit) {
                    const data = {
                        id: btnEdit.getAttribute('data-id'),
                        nama: btnEdit.getAttribute('data-nama'),
                        kategori_id: btnEdit.getAttribute('data-kategori'),
                        harga: btnEdit.getAttribute('data-harga'),
                        stok: btnEdit.getAttribute('data-stok'),
                        foto: btnEdit.getAttribute('data-foto')
                    };
                    bukaModal('edit', data);
                }
            });

            // Event listener untuk tombol Hapus (Sesuai wireframe [cite: 91])
            document.querySelectorAll('.btn-hapus').forEach(button => {
                button.addEventListener('click', () => {
                    // Konfirmasi JS sebelum hapus
                    if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                        // TODO: Logika hapus (submit form hapus, dll)
                        console.log('Hapus produk');
                    }
                });
            });

            // Event listener untuk tombol tutup dan batal
            btnTutupModal.addEventListener('click', tutupModal);
            btnBatal.addEventListener('click', tutupModal);

            // Tutup modal jika klik di luar area modal
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    tutupModal();
                }
            });

            const errorToast = document.getElementById('toast-container');
            if (errorToast) {
                setTimeout(() => {
                    errorToast.style.opacity = '0';
                    errorToast.style.transform = 'translateX(20px)';
                    setTimeout(() => errorToast.remove(), 500);
                }, 5000);
            }

            // Auto hide success toast
            const successToast = document.getElementById('toast-success');
            if (successToast) {
                setTimeout(() => {
                    successToast.style.opacity = '0';
                    successToast.style.transform = 'translateX(20px)';
                    setTimeout(() => successToast.remove(), 500);
                }, 5000);
            }
        });
    </script>
@endpush
