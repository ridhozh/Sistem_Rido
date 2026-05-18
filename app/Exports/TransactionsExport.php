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
        $query = Transaksi::query();

        if ($this->start && $this->end) {
            $query->whereBetween('created_at', [
                Carbon::parse($this->start)->startOfDay(),
                Carbon::parse($this->end)->endOfDay()
            ]);
        }

        return $query->latest();
    }

    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Nama Pelanggan',
            'Total Belanja',
            'Metode Pembayaran',
            'Waktu Transaksi'
        ];
    }

    public function map($transaksi): array
    {
        return [
            $transaksi->transaction_id,
            $transaksi->cashier_name ?? 'Guest',
            'Rp ' . number_format($transaksi->total_amount ?? 0, 0, ',', '.'),
            $transaksi->payment_method ?? 'Cash',
            $transaksi->transaction_date->format('d/m/Y H:i'),
        ];
    }
}
