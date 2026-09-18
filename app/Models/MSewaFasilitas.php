<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MSewaFasilitas extends Model
{
    use HasFactory;

    protected $table = 'penyewaan_fasilitas';

    protected $fillable = [
        'kode_sewa',
        'nama_penyewa',
        'no_telepon',
        'fasilitas',
        'kategori_sewa',
        'jumlah_unit',
        'tanggal_mulai',
        'jam_mulai',
        'tanggal_selesai',
        'jam_selesai',
        'lama_sewa_hari',
        'lama_sewa_jam',
        'harga_sewa',
        'total_biaya',
        'status_pembayaran',
        'status_sewa',
        'keterangan',
        
        // ===== KOLOM BARU UNTUK REVISI HARGA =====
        'tipe_kamar',      // Untuk Pesanggrahan: standar/deluxe/superior
        'extra_bed',       // Untuk Pesanggrahan: 0 atau 1
        'durasi_jam',      // Untuk Pendopo: durasi dalam jam
        'jumlah_sesi',     // Untuk Pendopo: hasil ceil(durasi_jam / 4)
        'satuan_tampilan', // Teks satuan untuk invoice

        // ===== KOLOM BARU UNTUK GAZEBO =====
        'lokasi',          // Lokasi fasilitas (Mandiangin / Bukit Batu)
        'satuan',          // Satuan sewa (4 Jam / per hari / dll)
    ];

    public function getHargaSewaRupiahAttribute()
    {
        return 'Rp ' . number_format($this->harga_sewa, 0, ',', '.');
    }

    public function getTotalBiayaRupiahAttribute()
    {
        return 'Rp ' . number_format($this->total_biaya, 0, ',', '.');
    }

    /**
     * Generate kode sewa unik dengan format SEWA-YYYYMMDD-XXXX
     * Dilengkapi pengecekan untuk menghindari duplikat
     */
    public static function generateKodeSewa()
    {
        $tanggal = date('Ymd');
        
        // Cari kode terakhir untuk tanggal hari ini
        $last = self::where('kode_sewa', 'LIKE', 'SEWA-' . $tanggal . '-%')
                    ->orderBy('kode_sewa', 'desc')
                    ->first();
        
        if ($last) {
            // Ambil angka 4 digit terakhir dari kode
            $lastNumber = (int) substr($last->kode_sewa, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        // Buat kode baru
        $kode = 'SEWA-' . $tanggal . '-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        
        // ===== CEK DUPLIKAT (JAGA-JAGA) =====
        // Jika kode sudah ada, increment sampai dapat yang unik
        while (self::where('kode_sewa', $kode)->exists()) {
            $newNumber++;
            $kode = 'SEWA-' . $tanggal . '-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        }
        
        return $kode;
    }

    public static function hitungLamaSewa($tanggal_mulai, $jam_mulai, $tanggal_selesai, $jam_selesai)
    {
        $mulai = new \DateTime($tanggal_mulai . ' ' . $jam_mulai);
        $selesai = new \DateTime($tanggal_selesai . ' ' . $jam_selesai);
        $diff = $mulai->diff($selesai);
        
        return [
            'hari' => $diff->days,
            'jam' => $diff->h,
        ];
    }

    public static function hitungTotalBiaya($harga_sewa, $lama_hari)
    {
        return $harga_sewa * $lama_hari;
    }
}