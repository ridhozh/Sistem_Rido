let cart = [];

// Add Item to Cart (Triggered by Katalog Buttons)
document.addEventListener('click', function (e) {
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
document.addEventListener('DOMContentLoaded', function () {
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

        fetch('/simpan-transaksi', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                order_id: 'CASH-' + Date.now(),
                payment_type: 'tunai',
                cart: cart
            })
        })
            .then(res => res.json())
            .then(res => {
                alert("Transaksi Tunai Berhasil!");

                cart = [];
                renderEverything();
                document.getElementById('input-bayar').value = 0;
                hitungKembalian();
            });
    }

    // Proses Midtrans
    const btnProses = document.querySelector('button[onclick="prosesTransaksi()"]');
    const originalText = btnProses.innerHTML;
    btnProses.innerHTML =
        '<span class="flex items-center justify-center gap-2"><svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> MEMPROSES...</span>';
    btnProses.disabled = true;

    fetch('{{ route('kasir.transaksi.checkout') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            cart: cart
        })
    })
        .then(response => response.json())
        .then(data => {
            btnProses.innerHTML = originalText;
            btnProses.disabled = false;

            if (data.status === 'success') {
                window.snap.pay(data.snap_token, {
                    onSuccess: function (result) {
                        alert("Pembayaran Berhasil! Order ID: " + data.order_id);

                        // 🔥 kirim ke backend
                        fetch('/simpan-transaksi', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                order_id: data.order_id,
                                payment_type: result.payment_type,
                                cart: cart
                            })
                        })
                            .then(res => res.json())
                            .then(res => {
                                console.log(res);

                                // reset UI
                                cart = [];
                                renderEverything();
                                document.getElementById('input-bayar').value = 0;
                                hitungKembalian();
                            })
                            .catch(err => {
                                console.error(err);
                                alert("Gagal simpan transaksi!");
                            });
                        document.getElementById('input-bayar').value = 0;
                        hitungKembalian();
                    },
                    onPending: function (result) {
                        alert("Menunggu pembayaran Anda!");
                    },
                    onError: function (result) {
                        alert("Pembayaran Gagal!");
                    },
                    onClose: function () {
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