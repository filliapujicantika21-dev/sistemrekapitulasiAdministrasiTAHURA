<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mretribusi extends Model
{
    use HasFactory;

    protected $table = 'retribusi';

    protected $fillable = [
        'kode_transaksi',
        'nama_pengunjung',
        'jenis_identitas',
        'nomor_identitas',
        'no_telepon',
        'jenis_kendaraan',
        'plat_nomor',
        'jumlah_orang',
        'kategori',
        'tarif',
        'total_bayar',
        'tanggal_masuk',
        'jam_masuk',
        'tanggal_keluar',
        'jam_keluar',
        'status',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_keluar' => 'date',
        'jam_masuk' => 'datetime:H:i',
        'jam_keluar' => 'datetime:H:i',
        'tarif' => 'decimal:2',
        'total_bayar' => 'decimal:2',
    ];

    // Format Rupiah
    public function getTarifRupiahAttribute()
    {
        return 'Rp ' . number_format($this->tarif, 0, ',', '.');
    }

    public function getTotalBayarRupiahAttribute()
    {
        return 'Rp ' . number_format($this->total_bayar, 0, ',', '.');
    }

    // Scope filter
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeTanggalMasuk($query, $tanggal)
    {
        return $query->whereDate('tanggal_masuk', $tanggal);
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('nama_pengunjung', 'LIKE', "%$keyword%")
                     ->orWhere('kode_transaksi', 'LIKE', "%$keyword%")
                     ->orWhere('plat_nomor', 'LIKE', "%$keyword%");
    }

    // Generate kode transaksi
    public static function generateKodeTransaksi()
    {
        $tanggal = date('Ymd');
        $count = self::whereDate('created_at', date('Y-m-d'))->count() + 1;
        return 'TRX-' . $tanggal . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    // Hitung total bayar
    public static function hitungTotalBayar($tarif, $jumlah_orang)
    {
        return $tarif * $jumlah_orang;
    }
}