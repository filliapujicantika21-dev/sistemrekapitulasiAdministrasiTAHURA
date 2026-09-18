<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\DataPersediaanController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\SewaFasilitasController;
use App\Http\Controllers\RetribusiController;


/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'prosesLogin'])
        ->name('login.proses');

});


/*
|--------------------------------------------------------------------------
| SEMUA HALAMAN SETELAH LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [AuthController::class, 'dashboard'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    /*
    |--------------------------------------------------------------------------
    | RETRIBUSI
    |--------------------------------------------------------------------------
    */

    Route::resource('retribusi', RetribusiController::class);


    /*
    |--------------------------------------------------------------------------
    | LOGISTIK
    |--------------------------------------------------------------------------
    */

    Route::resource('kategori', KategoriController::class);
    Route::resource('barang-masuk', BarangMasukController::class);
    Route::resource('barang-keluar', BarangKeluarController::class);


    /*
    |--------------------------------------------------------------------------
    | DATA PERSEDIAAN
    |--------------------------------------------------------------------------
    */

    Route::get('/persediaan',
        [DataPersediaanController::class, 'index']
    )->name('persediaan.index');
    Route::get('/persediaan/cetak',
        [DataPersediaanController::class, 'cetak']
    )->name('persediaan.cetak');
    Route::get('/persediaan/excel',
        [DataPersediaanController::class, 'excel']
    )->name('persediaan.excel');


    /*
    |--------------------------------------------------------------------------
    | RESERVASI VILLA
    |--------------------------------------------------------------------------
    */

    Route::resource('reservasi', ReservasiController::class);


    /*
    |--------------------------------------------------------------------------
    | RESERVASI - PDF
    |--------------------------------------------------------------------------
    */

    Route::get('/reservasi-preview',
        [ReservasiController::class, 'preview']
    )->name('reservasi.preview');
    Route::get('/reservasi-pdf',
        [ReservasiController::class, 'pdf']
    )->name('reservasi.pdf');
    Route::get('/reservasi-excel',
        [ReservasiController::class, 'excel']
    )->name('reservasi.excel');


    /*
    |--------------------------------------------------------------------------
    | RESERVASI - INVOICE
    |--------------------------------------------------------------------------
    */

    Route::get('/reservasi/{id}/invoice/pdf',
        [ReservasiController::class, 'invoicePdf']
    )->name('reservasi.invoice.pdf');
    Route::get('/reservasi/{id}/invoice/excel',
        [ReservasiController::class, 'invoiceExcel']
    )->name('reservasi.invoice.excel');


    /*
    |--------------------------------------------------------------------------
    | CEK KAMAR
    |--------------------------------------------------------------------------
    */

    Route::get('/cek-kamar',
        [ReservasiController::class, 'cekKamar']
    )->name('reservasi.cekKamar');


    /*
    |--------------------------------------------------------------------------
    | SEWA FASILITAS - ROUTE KHUSUS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/sewa-fasilitas/riwayat',
        [SewaFasilitasController::class, 'riwayat']
    )->name('sewa-fasilitas.riwayat');

    Route::get(
        '/sewa-fasilitas/laporan',
        [SewaFasilitasController::class, 'laporan']
    )->name('sewa-fasilitas.laporan');
    Route::post(
        '/sewa-fasilitas/{id}/selesaikan',
        [SewaFasilitasController::class, 'selesaikan']
    )->name('sewa-fasilitas.selesaikan');
    Route::get(
        '/sewa-fasilitas/{id}/invoice',
        [SewaFasilitasController::class, 'downloadInvoice']
    )->name('sewa-fasilitas.invoice');


    /*
    |--------------------------------------------------------------------------
    | SEWA FASILITAS - RESOURCE
    |--------------------------------------------------------------------------
    */
    Route::resource(
        'sewa-fasilitas',
        SewaFasilitasController::class
    );



Route::middleware(['auth'])->group(function () {


    Route::get('/dashboard',
        [AuthController::class,'dashboard']
    )->name('dashboard');
    Route::post('/logout',
        [AuthController::class,'logout']
    )->name('logout');



    // =========================
    // ADMIN + RETRIBUSI
    // =========================

    Route::middleware('role:admin,retribusi')->group(function(){

        Route::resource(
            'retribusi',
            RetribusiController::class
        );

    });



    // =========================
    // ADMIN + LOGISTIK
    // =========================

    Route::middleware('role:admin,logistik')->group(function(){

        Route::resource(
            'kategori',
            KategoriController::class
        );
        Route::resource(
            'barang-masuk',
            BarangMasukController::class
        );
        Route::resource(
            'barang-keluar',
            BarangKeluarController::class
        );
        Route::get('/persediaan',
            [DataPersediaanController::class,'index']
        )->name('persediaan.index');
        Route::get('/persediaan/cetak',
            [DataPersediaanController::class,'cetak']
        )->name('persediaan.cetak');
        Route::get('/persediaan/excel',
            [DataPersediaanController::class,'excel']
        )->name('persediaan.excel');

    });



    // =========================
    // ADMIN + RESERVASI
    // =========================

    Route::middleware('role:admin,reservasi')->group(function(){

        Route::resource(
            'reservasi',
            ReservasiController::class
        );
        Route::get('/cek-kamar',
            [ReservasiController::class,'cekKamar']
        )->name('reservasi.cekKamar');
        Route::get('/reservasi-preview',
            [ReservasiController::class,'preview']
        )->name('reservasi.preview');
        Route::get('/reservasi-pdf',
            [ReservasiController::class,'pdf']
        )->name('reservasi.pdf');
        Route::get('/reservasi-excel',
            [ReservasiController::class,'excel']
        )->name('reservasi.excel');

    });



    // =========================
    // ADMIN + SEWA
    // =========================

    Route::middleware('role:admin,sewa')->group(function(){

        Route::resource(
            'sewa-fasilitas',
            SewaFasilitasController::class
        );
        Route::get(
            '/sewa-fasilitas/riwayat',
            [SewaFasilitasController::class,'riwayat']
        )->name('sewa-fasilitas.riwayat');
        Route::get(
            '/sewa-fasilitas/laporan',
            [SewaFasilitasController::class,'laporan']
        )->name('sewa-fasilitas.laporan');

    });


});
});