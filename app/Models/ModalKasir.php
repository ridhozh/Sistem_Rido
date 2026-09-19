<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModalKasir extends Model
{
    use HasFactory;

    protected $table = 'modal_kasirs';

    protected $fillable = [
        'tanggal',
        'user_id',
        'modal_awal',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'modal_awal' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
