<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
    //
    use HasFactory;

    protected $table = 'transaksis';

    protected $fillable = [
        'transaction_id',
        'transaction_date',
        'total_amount',
        'cashier_name',
        'payment_method',
    ];
    public function details()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
        'transaction_date' => 'datetime',
    ];
}
