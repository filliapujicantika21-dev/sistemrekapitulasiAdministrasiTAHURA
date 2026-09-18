<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $fillable = [
        'nomor_invoice',
        'nama_penyewa',
        'nomor_penyewa',
        'nomor_kamar',
        'tipe_villa',
        'jumlah_extra_bed',
        'check_in',
        'check_out',
        'payment',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];
}