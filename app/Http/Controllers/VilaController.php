<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mvila;

class VilaController extends Controller
{
    public function index()
    {
        $vila = Mvila::latest()->paginate(10);
        return view('vila.index', compact('vila'));
    }

    public function create()
    {
        $kode_sewa = Mvila::generateKodeSewa();
        return view('vila.create', compact('kode_sewa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penyewa' => 'required|min:3',
            'nomor_identitas' => 'required',
            'no_telepon' => 'required',
            'nama_vila' => 'required',
            'tipe_vila' => 'required',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'harga_per_malam' => 'required|numeric',
        ]);

        $lama_menginap = Mvila::hitungLamaMenginap($request->tanggal_checkin, $request->tanggal_checkout);
        $total_harga = Mvila::hitungTotalHarga($request->harga_per_malam, $lama_menginap);

        Mvila::create([
            'kode_sewa' => $request->kode_sewa,
            'nama_penyewa' => $request->nama_penyewa,
            'nomor_identitas' => $request->nomor_identitas,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'nama_vila' => $request->nama_vila,
            'tipe_vila' => $request->tipe_vila,
            'jumlah_kamar' => $request->jumlah_kamar,
            'tanggal_checkin' => $request->tanggal_checkin,
            'tanggal_checkout' => $request->tanggal_checkout,
            'lama_menginap' => $lama_menginap,
            'harga_per_malam' => $request->harga_per_malam,
            'total_harga' => $total_harga,
            'status_pembayaran' => $request->status_pembayaran ?? 'belum_bayar',
            'status_ketersediaan' => 'disewa',
            'catatan' => $request->catatan
        ]);

        return redirect()->route('vila.index')
                         ->with('success', 'Data penyewaan vila berhasil ditambahkan!');
    }

    public function show($id)
    {
        $vila = Mvila::findOrFail($id);
        return view('vila.show', compact('vila'));
    }

    public function edit($id)
    {
        $vila = Mvila::findOrFail($id);
        return view('vila.edit', compact('vila'));
    }

    public function update(Request $request, $id)
    {
        $vila = Mvila::findOrFail($id);

        $request->validate([
            'nama_penyewa' => 'required|min:3',
            'nomor_identitas' => 'required',
            'no_telepon' => 'required',
            'nama_vila' => 'required',
            'tipe_vila' => 'required',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'harga_per_malam' => 'required|numeric',
        ]);

        $lama_menginap = Mvila::hitungLamaMenginap($request->tanggal_checkin, $request->tanggal_checkout);
        $total_harga = Mvila::hitungTotalHarga($request->harga_per_malam, $lama_menginap);

        $vila->update([
            'nama_penyewa' => $request->nama_penyewa,
            'nomor_identitas' => $request->nomor_identitas,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'nama_vila' => $request->nama_vila,
            'tipe_vila' => $request->tipe_vila,
            'jumlah_kamar' => $request->jumlah_kamar,
            'tanggal_checkin' => $request->tanggal_checkin,
            'tanggal_checkout' => $request->tanggal_checkout,
            'lama_menginap' => $lama_menginap,
            'harga_per_malam' => $request->harga_per_malam,
            'total_harga' => $total_harga,
            'status_pembayaran' => $request->status_pembayaran,
            'status_ketersediaan' => $request->status_ketersediaan,
            'catatan' => $request->catatan
        ]);

        return redirect()->route('vila.index')
                         ->with('success', 'Data penyewaan vila berhasil diupdate!');
    }

    public function destroy($id)
    {
        $vila = Mvila::findOrFail($id);
        $vila->delete();

        return redirect()->route('vila.index')
                         ->with('success', 'Data penyewaan vila berhasil dihapus!');
    }
}