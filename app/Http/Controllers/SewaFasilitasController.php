<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MSewaFasilitas;
use Carbon\Carbon;

class SewaFasilitasController extends Controller
{
    // ===== HALAMAN PESANAN AKTIF =====
    public function index()
    {
        $sewa = MSewaFasilitas::where('status_sewa', '!=', 'selesai')
                              ->latest()
                              ->paginate(10);
        return view('sewa_fasilitas.index', compact('sewa'));
    }

    public function create()
    {
        $kode_sewa = MSewaFasilitas::generateKodeSewa();
        return view('sewa_fasilitas.create', compact('kode_sewa'));
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'nama_penyewa' => 'required|min:3',
            'no_telepon' => 'required|min:10',
            'fasilitas' => 'required',
            'kategori_sewa' => 'required',
            'jumlah_unit' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'jam_mulai' => 'required',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jam_selesai' => 'required',
            'harga_sewa' => 'required|numeric|min:0',
        ]);

        // Hitung Lama Sewa
        $mulai = strtotime($request->tanggal_mulai . ' ' . $request->jam_mulai);
        $selesai = strtotime($request->tanggal_selesai . ' ' . $request->jam_selesai);
        $lama_hari = 1;
        if ($selesai > $mulai) {
            $diffJam = ($selesai - $mulai) / 3600;
            $lama_hari = $diffJam < 24 ? 1 : ceil($diffJam / 24);
        }
        $lama_jam = 0;

        // Hitung Biaya
        $harga_satuan = $request->harga_sewa;
        $total_biaya = 0;
        $durasi_jam = null;
        $jumlah_sesi = null;
        $satuan_tampilan = '';

        if ($request->fasilitas == 'Pesanggrahan') {
            $durasi_jam = $request->durasi_jam;
            $jumlah_sesi = ceil($durasi_jam / 4);
            $total_biaya = $harga_satuan * $request->jumlah_unit * $jumlah_sesi;
            $satuan_tampilan = $durasi_jam . ' jam (' . $jumlah_sesi . ' sesi @ Rp ' . number_format($harga_satuan, 0, ',', '.') . ')';
        } elseif ($request->fasilitas == 'Pendopo') {
            $durasi_jam = $request->durasi_jam;
            $jumlah_sesi = ceil($durasi_jam / 4);
            $total_biaya = $harga_satuan * $request->jumlah_unit * $jumlah_sesi;
            $satuan_tampilan = $durasi_jam . ' jam (' . $jumlah_sesi . ' sesi @ Rp ' . number_format($harga_satuan, 0, ',', '.') . ')';
        } elseif ($request->fasilitas == 'Gazebo Besar' || $request->fasilitas == 'Gazebo Kecil') {
            $durasi_jam = $request->durasi_jam;
            $jumlah_sesi = ceil($durasi_jam / 4);
            $total_biaya = $harga_satuan * $request->jumlah_unit * $jumlah_sesi;
            $satuan_tampilan = $durasi_jam . ' jam (' . $jumlah_sesi . ' sesi x 4 jam)';
        } else {
            $total_biaya = $request->harga_sewa * $request->jumlah_unit * $lama_hari;
            $satuan_tampilan = $lama_hari . ' hari';
        }

        // Simpan
        MSewaFasilitas::create([
            'kode_sewa' => $request->kode_sewa,
            'nama_penyewa' => $request->nama_penyewa,
            'no_telepon' => $request->no_telepon,
            'fasilitas' => $request->fasilitas,
            'kategori_sewa' => $request->kategori_sewa,
            'jumlah_unit' => $request->jumlah_unit,
            'tanggal_mulai' => $request->tanggal_mulai,
            'jam_mulai' => $request->jam_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jam_selesai' => $request->jam_selesai,
            'lama_sewa_hari' => $lama_hari,
            'lama_sewa_jam' => $lama_jam,
            'harga_sewa' => $harga_satuan,
            'total_biaya' => $total_biaya,
            'status_pembayaran' => $request->status_pembayaran ?? 'belum_bayar',
            'status_sewa' => 'aktif',
            'keterangan' => $request->keterangan,
            'durasi_jam' => $durasi_jam,
            'jumlah_sesi' => $jumlah_sesi,
            'satuan_tampilan' => $satuan_tampilan,
        ]);

        return redirect()->route('sewa-fasilitas.index')->with('success', '✅ Sewa fasilitas berhasil ditambahkan!');
    }

    public function show($id)
    {
        $sewa = MSewaFasilitas::findOrFail($id);
        return view('sewa_fasilitas.show', compact('sewa'));
    }

    public function edit($id)
    {
        $sewa = MSewaFasilitas::findOrFail($id);
        return view('sewa_fasilitas.edit', compact('sewa'));
    }

    public function update(Request $request, $id)
    {
        $sewa = MSewaFasilitas::findOrFail($id);
        $request->validate([
            'nama_penyewa' => 'required|min:3',
            'no_telepon' => 'required|min:10',
            'fasilitas' => 'required',
            'kategori_sewa' => 'required',
            'jumlah_unit' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'jam_mulai' => 'required',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jam_selesai' => 'required',
            'harga_sewa' => 'required|numeric|min:0',
            'status_pembayaran' => 'required',
            'status_sewa' => 'required',
        ]);

        $mulai = strtotime($request->tanggal_mulai . ' ' . $request->jam_mulai);
        $selesai = strtotime($request->tanggal_selesai . ' ' . $request->jam_selesai);
        $lama_hari = 1;
        if ($selesai > $mulai) {
            $diffJam = ($selesai - $mulai) / 3600;
            $lama_hari = $diffJam < 24 ? 1 : ceil($diffJam / 24);
        }
        $lama_jam = 0;

        $harga_satuan = $request->harga_sewa;
        $total_biaya = 0;
        $durasi_jam = null;
        $jumlah_sesi = null;
        $satuan_tampilan = '';

        if ($request->fasilitas == 'Pesanggrahan') {
            $durasi_jam = $request->durasi_jam_pesanggrahan;
            $jumlah_sesi = ceil($durasi_jam / 4);
            $total_biaya = $harga_satuan * $request->jumlah_unit * $jumlah_sesi;
            $satuan_tampilan = $durasi_jam . ' jam (' . $jumlah_sesi . ' sesi @ Rp ' . number_format($harga_satuan, 0, ',', '.') . ')';
        } elseif ($request->fasilitas == 'Pendopo') {
            $durasi_jam = $request->durasi_jam_pendopo;
            $jumlah_sesi = ceil($durasi_jam / 4);
            $total_biaya = $harga_satuan * $request->jumlah_unit * $jumlah_sesi;
            $satuan_tampilan = $durasi_jam . ' jam (' . $jumlah_sesi . ' sesi @ Rp ' . number_format($harga_satuan, 0, ',', '.') . ')';
        } elseif ($request->fasilitas == 'Gazebo Besar' || $request->fasilitas == 'Gazebo Kecil') {
            $durasi_jam = $request->durasi_jam_gazebo;
            $jumlah_sesi = ceil($durasi_jam / 4);
            $total_biaya = $harga_satuan * $request->jumlah_unit * $jumlah_sesi;
            $satuan_tampilan = $durasi_jam . ' jam (' . $jumlah_sesi . ' sesi x 4 jam)';
        } else {
            $total_biaya = $request->harga_sewa * $request->jumlah_unit * $lama_hari;
            $satuan_tampilan = $lama_hari . ' hari';
        }

        $sewa->update([
            'nama_penyewa' => $request->nama_penyewa,
            'no_telepon' => $request->no_telepon,
            'fasilitas' => $request->fasilitas,
            'kategori_sewa' => $request->kategori_sewa,
            'jumlah_unit' => $request->jumlah_unit,
            'tanggal_mulai' => $request->tanggal_mulai,
            'jam_mulai' => $request->jam_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jam_selesai' => $request->jam_selesai,
            'lama_sewa_hari' => $lama_hari,
            'lama_sewa_jam' => $lama_jam,
            'harga_sewa' => $harga_satuan,
            'total_biaya' => $total_biaya,
            'status_pembayaran' => $request->status_pembayaran,
            'status_sewa' => $request->status_sewa,
            'keterangan' => $request->keterangan,
            'durasi_jam' => $durasi_jam,
            'jumlah_sesi' => $jumlah_sesi,
            'satuan_tampilan' => $satuan_tampilan,
        ]);

        return redirect()->route('sewa-fasilitas.index')->with('success', '✅ Data sewa fasilitas berhasil diupdate!');
    }

    public function destroy($id)
    {
        $sewa = MSewaFasilitas::findOrFail($id);
        $sewa->delete();
        return redirect()->route('sewa-fasilitas.index')->with('success', '✅ Data sewa fasilitas berhasil dihapus!');
    }

    public function selesaikan($id)
    {
        $sewa = MSewaFasilitas::findOrFail($id);
        $sewa->update([
            'status_sewa' => 'selesai',
            'tanggal_selesai' => date('Y-m-d'),
            'jam_selesai' => date('H:i:s')
        ]);

        return redirect()->route('sewa-fasilitas.index')->with('success', '✅ Sewa fasilitas telah selesai!');
    }

    public function riwayat(Request $request)
    {
        $sewa = MSewaFasilitas::where('status_sewa', 'selesai')->latest()->paginate(10);
        return view('sewa_fasilitas.riwayat', compact('sewa'));
    }

    // ===== FITUR BARU: LAPORAN BULANAN =====
    public function laporan(Request $request)
    {
        // Default ke bulan dan tahun saat ini jika tidak ada filter
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        // Ambil semua data berdasarkan bulan dan tahun
        $query = MSewaFasilitas::whereMonth('tanggal_mulai', $bulan)
                               ->whereYear('tanggal_mulai', $tahun);

        // Data transaksi untuk tabel
        $transaksi = $query->orderBy('tanggal_mulai', 'desc')->get();

        // ===== AGREGASI RINGKASAN =====
        $totalTransaksi = $transaksi->count();
        $totalPendapatan = $transaksi->sum('total_biaya');
        $totalSelesai = $transaksi->where('status_sewa', 'selesai')->count();
        $totalAktif = $transaksi->where('status_sewa', 'aktif')->count();

        // ===== REKAP BERDASARKAN FASILITAS =====
        $rekapFasilitas = $transaksi->groupBy('fasilitas')->map(function ($item) {
            return [
                'jumlah' => $item->count(),
                'total_pendapatan' => $item->sum('total_biaya'),
            ];
        })->sortByDesc('total_pendapatan');

        // ===== REKAP BERDASARKAN STATUS PEMBAYARAN =====
        $rekapPembayaran = $transaksi->groupBy('status_pembayaran')->map(function ($item) {
            return [
                'jumlah' => $item->count(),
                'total_nilai' => $item->sum('total_biaya'),
            ];
        });

        // Nama Bulan dalam Bahasa Indonesia
        $namaBulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $namaBulanTerpilih = $namaBulan[(int)$bulan];

        return view('sewa_fasilitas.laporan', compact(
            'transaksi',
            'totalTransaksi',
            'totalPendapatan',
            'totalSelesai',
            'totalAktif',
            'rekapFasilitas',
            'rekapPembayaran',
            'bulan',
            'tahun',
            'namaBulanTerpilih'
        ));
    }

    public function downloadInvoice($id)
    {
        $sewa = MSewaFasilitas::findOrFail($id);
        $bukitBatu = ['Gazebo Besar', 'Gazebo Kecil'];
        
        if (in_array($sewa->fasilitas, $bukitBatu)) {
            return view('vendor.invoices.templates.bukitbatu', compact('sewa'));
        } else {
            return view('vendor.invoices.templates.default', compact('sewa'));
        }
    }
}