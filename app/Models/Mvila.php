<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mvila extends Model
{
    use HasFactory;

    protected $table = 'penyewaan_vila';

    protected $fillable = [
        'kode_sewa',
        'nama_penyewa',
        'nomor_identitas',
        'no_telepon',
        'email',
        'nama_vila',
        'tipe_vila',
        'jumlah_kamar',
        'tanggal_checkin',
        'tanggal_checkout',
        'lama_menginap',
        'harga_per_malam',
        'total_harga',
        'status_pembayaran',
        'status_ketersediaan',
        'catatan'
    ];

    protected $casts = [
        'tanggal_checkin' => 'date',
        'tanggal_checkout' => 'date',
        'harga_per_malam' => 'decimal:2',
        'total_harga' => 'decimal:2',
    ];

    // Format Rupiah
    public function getHargaPerMalamRupiahAttribute()
    {
        return 'Rp ' . number_format($this->harga_per_malam, 0, ',', '.');
    }

    public function getTotalHargaRupiahAttribute()
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    // Scope filter
    public function scopeStatusPembayaran($query, $status)
    {
        return $query->where('status_pembayaran', $status);
    }

    public function scopeStatusKetersediaan($query, $status)
    {
        return $query->where('status_ketersediaan', $status);
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('nama_penyewa', 'LIKE', "%$keyword%")
                     ->orWhere('kode_sewa', 'LIKE', "%$keyword%")
                     ->orWhere('nama_vila', 'LIKE', "%$keyword%");
    }

    // Generate kode sewa
    public static function generateKodeSewa()
    {
        $tanggal = date('Ymd');
        $count = self::whereDate('created_at', date('Y-m-d'))->count() + 1;
        return 'VILA-' . $tanggal . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    // Hitung lama menginap
    public static function hitungLamaMenginap($checkin, $checkout)
    {
        $checkinDate = new \DateTime($checkin);
        $checkoutDate = new \DateTime($checkout);
        $interval = $checkinDate->diff($checkoutDate);
        return $interval->days;
    }

    // Hitung total harga
    public static function hitungTotalHarga($harga_per_malam, $lama_menginap)
    {
        return $harga_per_malam * $lama_menginap;
    }
}