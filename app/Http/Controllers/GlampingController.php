<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mglamping;

class GlampingController extends Controller
{
    public function index()
    {
        $glamping = Mglamping::latest()->paginate(10);
        return view('glamping.index', compact('glamping'));
    }

    public function create()
    {
        $kode_booking = Mglamping::generateKodeBooking();
        $tipe_tenda = Mglamping::getTipeTenda();
        $fasilitas = Mglamping::getFasilitasTambahan();
        return view('glamping.create', compact('kode_booking', 'tipe_tenda', 'fasilitas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tamu' => 'required|min:3',
            'nomor_identitas' => 'required',
            'no_telepon' => 'required',
            'tipe_tenda' => 'required',
            'jumlah_tenda' => 'required|integer|min:1',
            'jumlah_orang' => 'required|integer|min:1',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'harga_per_malam' => 'required|numeric',
        ]);

        $lama_menginap = Mglamping::hitungLamaMenginap($request->tanggal_checkin, $request->tanggal_checkout);
        $total_harga = Mglamping::hitungTotalHarga($request->harga_per_malam, $lama_menginap, $request->jumlah_tenda);

        Mglamping::create([
            'kode_booking' => $request->kode_booking,
            'nama_tamu' => $request->nama_tamu,
            'nomor_identitas' => $request->nomor_identitas,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'tipe_tenda' => $request->tipe_tenda,
            'jumlah_tenda' => $request->jumlah_tenda,
            'jumlah_orang' => $request->jumlah_orang,
            'tanggal_checkin' => $request->tanggal_checkin,
            'tanggal_checkout' => $request->tanggal_checkout,
            'lama_menginap' => $lama_menginap,
            'harga_per_malam' => $request->harga_per_malam,
            'total_harga' => $total_harga,
            'fasilitas_tambahan' => $request->fasilitas_tambahan,
            'status_pembayaran' => $request->status_pembayaran ?? 'belum_bayar',
            'status_ketersediaan' => 'dipesan',
            'catatan' => $request->catatan
        ]);

        return redirect()->route('glamping.index')
                         ->with('success', 'Data glamping berhasil ditambahkan!');
    }

    public function show($id)
    {
        $glamping = Mglamping::findOrFail($id);
        return view('glamping.show', compact('glamping'));
    }

    public function edit($id)
    {
        $glamping = Mglamping::findOrFail($id);
        $tipe_tenda = Mglamping::getTipeTenda();
        $fasilitas = Mglamping::getFasilitasTambahan();
        return view('glamping.edit', compact('glamping', 'tipe_tenda', 'fasilitas'));
    }

    public function update(Request $request, $id)
    {
        $glamping = Mglamping::findOrFail($id);

        $request->validate([
            'nama_tamu' => 'required|min:3',
            'nomor_identitas' => 'required',
            'no_telepon' => 'required',
            'tipe_tenda' => 'required',
            'jumlah_tenda' => 'required|integer|min:1',
            'jumlah_orang' => 'required|integer|min:1',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'harga_per_malam' => 'required|numeric',
        ]);

        $lama_menginap = Mglamping::hitungLamaMenginap($request->tanggal_checkin, $request->tanggal_checkout);
        $total_harga = Mglamping::hitungTotalHarga($request->harga_per_malam, $lama_menginap, $request->jumlah_tenda);

        $glamping->update([
            'nama_tamu' => $request->nama_tamu,
            'nomor_identitas' => $request->nomor_identitas,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'tipe_tenda' => $request->tipe_tenda,
            'jumlah_tenda' => $request->jumlah_tenda,
            'jumlah_orang' => $request->jumlah_orang,
            'tanggal_checkin' => $request->tanggal_checkin,
            'tanggal_checkout' => $request->tanggal_checkout,
            'lama_menginap' => $lama_menginap,
            'harga_per_malam' => $request->harga_per_malam,
            'total_harga' => $total_harga,
            'fasilitas_tambahan' => $request->fasilitas_tambahan,
            'status_pembayaran' => $request->status_pembayaran,
            'status_ketersediaan' => $request->status_ketersediaan,
            'catatan' => $request->catatan
        ]);

        return redirect()->route('glamping.index')
                         ->with('success', 'Data glamping berhasil diupdate!');
    }

    public function destroy($id)
    {
        $glamping = Mglamping::findOrFail($id);
        $glamping->delete();

        return redirect()->route('glamping.index')
                         ->with('success', 'Data glamping berhasil dihapus!');
    }
}