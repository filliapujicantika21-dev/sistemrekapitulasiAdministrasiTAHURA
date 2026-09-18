<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mretribusi;

class RetribusiController extends Controller
{
    
    public function index()
    {
        $retribusi = Mretribusi::latest()->paginate(10);
        return view('retribusi.index', compact('retribusi'));
    }

    
    public function create()
    {
        $kode_transaksi = Mretribusi::generateKodeTransaksi();
        return view('retribusi.create', compact('kode_transaksi'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengunjung' => 'required|min:3',
            'jenis_identitas' => 'required',
            'nomor_identitas' => 'required',
            'no_telepon' => 'required',
            'jenis_kendaraan' => 'required',
            'plat_nomor' => 'required',
            'jumlah_orang' => 'required|integer|min:1',
            'kategori' => 'required',
            'tarif' => 'required|numeric',
            'tanggal_masuk' => 'required|date',
            'jam_masuk' => 'required',
        ]);

        $total_bayar = $request->tarif * $request->jumlah_orang;

        Mretribusi::create([
            'kode_transaksi' => $request->kode_transaksi,
            'nama_pengunjung' => $request->nama_pengunjung,
            'jenis_identitas' => $request->jenis_identitas,
            'nomor_identitas' => $request->nomor_identitas,
            'no_telepon' => $request->no_telepon,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'plat_nomor' => $request->plat_nomor,
            'jumlah_orang' => $request->jumlah_orang,
            'kategori' => $request->kategori,
            'tarif' => $request->tarif,
            'total_bayar' => $total_bayar,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jam_masuk' => $request->jam_masuk,
            'status' => 'masuk',
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('retribusi.index')
                         ->with('success', 'Data retribusi berhasil ditambahkan!');
    }


    public function show($id)
    {
        $retribusi = Mretribusi::findOrFail($id);
        return view('retribusi.show', compact('retribusi'));
    }


    public function edit($id)
    {
        $retribusi = Mretribusi::findOrFail($id);
        return view('retribusi.edit', compact('retribusi'));
    }

    
    public function update(Request $request, $id)
    {
        $retribusi = Mretribusi::findOrFail($id);

        $request->validate([
            'nama_pengunjung' => 'required|min:3',
            'jenis_identitas' => 'required',
            'nomor_identitas' => 'required',
            'no_telepon' => 'required',
            'jenis_kendaraan' => 'required',
            'plat_nomor' => 'required',
            'jumlah_orang' => 'required|integer|min:1',
            'kategori' => 'required',
            'tarif' => 'required|numeric',
            'tanggal_masuk' => 'required|date',
            'jam_masuk' => 'required',
        ]);

        $total_bayar = $request->tarif * $request->jumlah_orang;

        $retribusi->update([
            'nama_pengunjung' => $request->nama_pengunjung,
            'jenis_identitas' => $request->jenis_identitas,
            'nomor_identitas' => $request->nomor_identitas,
            'no_telepon' => $request->no_telepon,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'plat_nomor' => $request->plat_nomor,
            'jumlah_orang' => $request->jumlah_orang,
            'kategori' => $request->kategori,
            'tarif' => $request->tarif,
            'total_bayar' => $total_bayar,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jam_masuk' => $request->jam_masuk,
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('retribusi.index')
                         ->with('success', 'Data retribusi berhasil diupdate!');
    }

    
    public function destroy($id)
    {
        $retribusi = Mretribusi::findOrFail($id);
        $retribusi->delete();

        return redirect()->route('retribusi.index')
                         ->with('success', 'Data retribusi berhasil dihapus!');
    }

    
    public function checkout($id)
    {
        $retribusi = Mretribusi::findOrFail($id);
        
        if ($retribusi->status == 'keluar') {
            return redirect()->back()->with('error', 'Data ini sudah checkout!');
        }

        $retribusi->update([
            'status' => 'keluar',
            'tanggal_keluar' => date('Y-m-d'),
            'jam_keluar' => date('H:i:s')
        ]);

        return redirect()->route('retribusi.index')
                         ->with('success', 'Checkout berhasil!');
    }
}