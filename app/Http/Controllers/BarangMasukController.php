<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Menampilkan data barang masuk
     */
    public function index()
    {
        $masuk = BarangMasuk::with('kategori')
                    ->orderBy('tanggal', 'desc')
                    ->get();

        return view('logistik.masuk.index', compact('masuk'));
    }

    /**
     * Form tambah barang masuk
     */
    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('logistik.masuk.create', compact('kategori'));
    }

    /**
     * Simpan data
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'satuan'      => 'required',
            'qty'         => 'required|integer|min:1',
            'harga'       => 'required|numeric|min:0',
            'tanggal'     => 'required|date',
        ]);

        BarangMasuk::create($request->all());

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Barang masuk berhasil ditambahkan.');
    }

    /**
     * Form edit
     */
    public function edit(BarangMasuk $barang_masuk)
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('logistik.masuk.edit', compact('barang_masuk', 'kategori'));
    }

    /**
     * Update data
     */
    public function update(Request $request, BarangMasuk $barang_masuk)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'satuan'      => 'required',
            'qty'         => 'required|integer|min:1',
            'harga'       => 'required|numeric|min:0',
            'tanggal'     => 'required|date',
        ]);

        $barang_masuk->update($request->all());

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Barang masuk berhasil diubah.');
    }

    /**
     * Hapus data
     */
    public function destroy(BarangMasuk $barang_masuk)
    {
        $barang_masuk->delete();

        return redirect()
            ->route('barang-masuk.index')
            ->with('success', 'Barang masuk berhasil dihapus.');
    }
}