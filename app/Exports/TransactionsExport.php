<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class TransactionsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $start, $end;

    public function __construct($start = null, $end = null)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function query()
    {
        // Use eager loading for relationships to avoid 'null' data issues
        $query = Transaksi::with(['details.produk']);

        if ($this->start && $this->end) {
            $query->whereBetween('transaction_date', [
                Carbon::parse($this->start)->startOfDay(),
                Carbon::parse($this->end)->endOfDay()
            ]);
        }

        return $query->latest('transaction_date');
    }

    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Kasir / Pelanggan',
            'Metode Pembayaran',
            'Total Belanja (Omzet)',
            'Total Modal (HPP)',
            'Laba Kotor',
            'Waktu Transaksi'
        ];
    }

    public function map($transaksi): array
    {
        return [
            $transaksi->transaction_id,
            $transaksi->cashier_name ?? 'Kasir',
            $transaksi->payment_method ?? 'Tunai',
            'Rp ' . number_format($transaksi->total_amount ?? 0, 0, ',', '.'),
            'Rp ' . number_format($transaksi->total_modal ?? 0, 0, ',', '.'),
            'Rp ' . number_format($transaksi->laba_kotor ?? 0, 0, ',', '.'),
            $transaksi->transaction_date ? $transaksi->transaction_date->format('d/m/Y H:i') : '-',
        ];
    }
}
