<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    //
    use HasFactory;

    protected $table = 'produks';

    protected $fillable = [
        'nama_produk',
        'kategori_id',
        'foto_produk',
        'harga',
        'stok_awal',
    ];

    /**
     * Get the category that owns the product.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
