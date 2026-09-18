<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penyewaan_fasilitas', function (Blueprint $table) {

    $table->id();

    $table->string('nama_penyewa');

    $table->string('no_hp')->nullable();

    $table->string('fasilitas');

    $table->date('tanggal_sewa');

    $table->integer('jumlah_hari')->default(1);

    $table->integer('total_bayar')->default(0);

    $table->enum('status_sewa', [
        'menunggu',
        'disetujui',
        'selesai',
        'dibatalkan'
    ])->default('menunggu');

    $table->timestamps();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewaan_fasilitas');
    }
};
