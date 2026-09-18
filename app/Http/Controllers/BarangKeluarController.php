<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Menampilkan daftar barang keluar
     */
    public function index()
    {
        $keluar = BarangKeluar::with('kategori')
                    ->orderBy('tanggal', 'desc')
                    ->get();

        return view('logistik.keluar.index', compact('keluar'));
    }

    /**
     * Form tambah barang keluar
     */
    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('logistik.keluar.create', compact('kategori'));
    }

    /**
     * Simpan data barang keluar
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'satuan'      => 'required',
            'qty'         => 'required|integer|min:1',
            'tanggal'     => 'required|date',
        ]);

        BarangKeluar::create([
            'kategori_id' => $request->kategori_id,
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'satuan'      => $request->satuan,
            'qty'         => $request->qty,
            'tanggal'     => $request->tanggal,
            'keterangan'  => $request->keterangan,
        ]);

        return redirect()
            ->route('barang-keluar.index')
            ->with('success', 'Barang keluar berhasil ditambahkan.');
    }

    /**
     * Form edit
     */
    public function edit(BarangKeluar $barang_keluar)
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('logistik.keluar.edit', compact('barang_keluar', 'kategori'));
    }

    /**
     * Update data barang keluar
     */
    public function update(Request $request, BarangKeluar $barang_keluar)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'satuan'      => 'required',
            'qty'         => 'required|integer|min:1',
            'tanggal'     => 'required|date',
        ]);

        $barang_keluar->update([
            'kategori_id' => $request->kategori_id,
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'satuan'      => $request->satuan,
            'qty'         => $request->qty,
            'tanggal'     => $request->tanggal,
            'keterangan'  => $request->keterangan,
        ]);

        return redirect()
            ->route('barang-keluar.index')
            ->with('success', 'Barang keluar berhasil diubah.');
    }

    /**
     * Hapus data
     */
    public function destroy(BarangKeluar $barang_keluar)
    {
        $barang_keluar->delete();

        return redirect()
            ->route('barang-keluar.index')
            ->with('success', 'Barang keluar berhasil dihapus.');
    }
}