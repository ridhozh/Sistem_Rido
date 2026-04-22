<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi - Toserba Hasan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h2 { margin: 0; color: #1e293b; }
        .info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #3b82f6; color: white; padding: 10px; text-align: left; }
        td { border-bottom: 1px solid #e2e8f0; padding: 10px; }
        .text-right { text-align: right; }
        .footer { margin-top: 30px; text-align: right; font-style: italic; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Toserba Hasan</h2>
        <p>Laporan Riwayat Transaksi</p>
    </div>

    <div class="info">
        <strong>Periode:</strong> {{ $start ?? 'Semua' }} s/d {{ $end ?? 'Sekarang' }}<br>
        <strong>Dicetak pada:</strong> {{ now()->format('d/m/Y H:i') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pelanggan</th>
                <th>Metode</th>
                <th>Tanggal</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $t)
            <tr>
                <td>#{{ $t->transaction_id }}</td>
                <td>{{ $t->cashier_name ?? 'Guest' }}</td>
                <td>{{ $t->payment_method ?? '-' }}</td>
                <td>{{ $t->transaction_date->format('d/m/Y') }}</td>
                <td class="text-right">Rp {{ number_format($t->total_amount, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Terima kasih atas dedikasi Anda mengelola Toserba Hasan.</p>
    </div>
</body>
</html>