<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Kategori;
use Illuminate\Http\Request;


class DataPersediaanController extends Controller
{
    /**
     * HALAMAN DATA PERSEDIAAN
     */
    public function index(Request $request)
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        $persediaan = $this->getDataPersediaan($request);

        return view(
            'logistik.persediaan.index',
            compact('persediaan', 'kategori')
        );
    }


    /**
     * CETAK LAPORAN
     */
    public function cetak(Request $request)
    {
        $persediaan = $this->getDataPersediaan($request);

        return view(
            'logistik.persediaan.cetak',
            compact('persediaan')
        );
    }


    /**
     * EXPORT EXCEL
     */
    public function excel(Request $request)
    {
        $persediaan = $this->getDataPersediaan($request);

        return response()
            ->view(
                'logistik.persediaan.excel',
                compact('persediaan')
            )
            ->header(
                'Content-Type',
                'application/vnd.ms-excel'
            )
            ->header(
                'Content-Disposition',
                'attachment; filename="Laporan_Persediaan_APBD.xls"'
            );
    }


    /**
     * MENGAMBIL DATA PERSEDIAAN
     */
    private function getDataPersediaan(Request $request)
    {
        $tanggalAwal  = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;
        $kategoriId   = $request->kategori_id;


        /*
        |--------------------------------------------------------------------------
        | AMBIL KODE BARANG
        |--------------------------------------------------------------------------
        */

        $kodeMasuk = BarangMasuk::query()
            ->select('kode_barang')
            ->distinct()
            ->pluck('kode_barang');

        $kodeKeluar = BarangKeluar::query()
            ->select('kode_barang')
            ->distinct()
            ->pluck('kode_barang');

        $kodeBarang = $kodeMasuk
            ->merge($kodeKeluar)
            ->unique()
            ->values();


        $persediaan = [];


        /*
        |--------------------------------------------------------------------------
        | PROSES SETIAP BARANG
        |--------------------------------------------------------------------------
        */

        foreach ($kodeBarang as $kode) {

            /*
            |--------------------------------------------------------------------------
            | DATA BARANG MASUK
            |--------------------------------------------------------------------------
            */

            $dataMasuk = BarangMasuk::with('kategori')
                ->where('kode_barang', $kode)
                ->orderBy('tanggal')
                ->first();


            /*
            |--------------------------------------------------------------------------
            | DATA BARANG KELUAR
            |--------------------------------------------------------------------------
            */

            $dataKeluar = BarangKeluar::with('kategori')
                ->where('kode_barang', $kode)
                ->orderBy('tanggal')
                ->first();


            /*
            |--------------------------------------------------------------------------
            | CEK KATEGORI
            |--------------------------------------------------------------------------
            */

          if ($dataMasuk && $dataMasuk->kategori) {

    $kategoriBarangId =
        $dataMasuk->kategori->id;

    $namaKategori =
        $dataMasuk->kategori->nama_kategori;

} elseif ($dataKeluar && $dataKeluar->kategori) {

    $kategoriBarangId =
        $dataKeluar->kategori->id;

    $namaKategori =
        $dataKeluar->kategori->nama_kategori;
}


// FILTER KATEGORI
if ($kategoriId && $kategoriBarangId != $kategoriId) {
    continue;
}

  
            /*
            |--------------------------------------------------------------------------
            | INFORMASI BARANG
            |--------------------------------------------------------------------------
            */

            $namaBarang =
                $dataMasuk->nama_barang
                ?? $dataKeluar->nama_barang
                ?? '-';


            $satuan =
                $dataMasuk->satuan
                ?? $dataKeluar->satuan
                ?? '-';


            $harga =
                $dataMasuk->harga
                ?? $dataKeluar->harga
                ?? 0;


            /*
            |--------------------------------------------------------------------------
            | SALDO AWAL
            |--------------------------------------------------------------------------
            */

            $saldoAwalMasuk = 0;
            $saldoAwalKeluar = 0;

            if ($tanggalAwal) {

                $saldoAwalMasuk = BarangMasuk::where(
                    'kode_barang',
                    $kode
                )
                ->whereDate(
                    'tanggal',
                    '<',
                    $tanggalAwal
                )
                ->sum('qty');


                $saldoAwalKeluar = BarangKeluar::where(
                    'kode_barang',
                    $kode
                )
                ->whereDate(
                    'tanggal',
                    '<',
                    $tanggalAwal
                )
                ->sum('qty');
            }


            $saldoAwalQty =
                $saldoAwalMasuk -
                $saldoAwalKeluar;


            /*
            |--------------------------------------------------------------------------
            | BARANG MASUK SESUAI PERIODE
            |--------------------------------------------------------------------------
            */

            $queryMasuk = BarangMasuk::where(
                'kode_barang',
                $kode
            );


            if ($tanggalAwal) {

                $queryMasuk->whereDate(
                    'tanggal',
                    '>=',
                    $tanggalAwal
                );
            }


            if ($tanggalAkhir) {

                $queryMasuk->whereDate(
                    'tanggal',
                    '<=',
                    $tanggalAkhir
                );
            }


            $transaksiMasuk =
                $queryMasuk->get();


            $masukQty =
                $transaksiMasuk->sum('qty');


            $masukRp =
                $transaksiMasuk->sum(function ($item) {

                    return
                        $item->qty *
                        $item->harga;

                });


            /*
            |--------------------------------------------------------------------------
            | BARANG KELUAR SESUAI PERIODE
            |--------------------------------------------------------------------------
            */

            $queryKeluar = BarangKeluar::where(
                'kode_barang',
                $kode
            );


            if ($tanggalAwal) {

                $queryKeluar->whereDate(
                    'tanggal',
                    '>=',
                    $tanggalAwal
                );
            }


            if ($tanggalAkhir) {

                $queryKeluar->whereDate(
                    'tanggal',
                    '<=',
                    $tanggalAkhir
                );
            }


            $transaksiKeluar =
                $queryKeluar->get();


            $keluarQty =
                $transaksiKeluar->sum('qty');


            $keluarRp =
                $transaksiKeluar->sum(function ($item) {

                    return
                        $item->qty *
                        $item->harga;

                });


            /*
            |--------------------------------------------------------------------------
            | SALDO AKHIR
            |--------------------------------------------------------------------------
            */

            $saldoAkhirQty =
                $saldoAwalQty +
                $masukQty -
                $keluarQty;


            /*
            |--------------------------------------------------------------------------
            | NILAI RUPIAH
            |--------------------------------------------------------------------------
            */

            $saldoAwalRp =
                $saldoAwalQty *
                $harga;


            $saldoAkhirRp =
                $saldoAkhirQty *
                $harga;


            /*
            |--------------------------------------------------------------------------
            | MASUKKAN DATA
            |--------------------------------------------------------------------------
            */

            $persediaan[] = [

                'kategori' =>
                    $namaKategori,

                'kategori_id' =>
                    $kategoriBarangId,

                'kode_barang' =>
                    $kode,

                'nama_barang' =>
                    $namaBarang,

                'satuan' =>
                    $satuan,


                'saldo_awal_qty' =>
                    $saldoAwalQty,

                'saldo_awal_rp' =>
                    $saldoAwalRp,


                'masuk_qty' =>
                    $masukQty,

                'masuk_rp' =>
                    $masukRp,


                'keluar_qty' =>
                    $keluarQty,

                'keluar_rp' =>
                    $keluarRp,


                'saldo_akhir_qty' =>
                    $saldoAkhirQty,

                'saldo_akhir_rp' =>
                    $saldoAkhirRp,


                'keterangan' =>
                    '',
            ];
        }


        return array_values($persediaan);
    }
}