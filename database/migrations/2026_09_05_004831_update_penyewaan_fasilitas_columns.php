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
    Schema::table('penyewaan_fasilitas', function (Blueprint $table) {

        if (!Schema::hasColumn('penyewaan_fasilitas', 'tanggal_mulai')) {
            $table->date('tanggal_mulai')->nullable();
        }

        if (!Schema::hasColumn('penyewaan_fasilitas', 'jam_mulai')) {
            $table->time('jam_mulai')->nullable();
        }

        if (!Schema::hasColumn('penyewaan_fasilitas', 'tanggal_selesai')) {
            $table->date('tanggal_selesai')->nullable();
        }

        if (!Schema::hasColumn('penyewaan_fasilitas', 'jam_selesai')) {
            $table->time('jam_selesai')->nullable();
        }

        if (!Schema::hasColumn('penyewaan_fasilitas', 'lama_sewa_hari')) {
            $table->integer('lama_sewa_hari')->default(0);
        }

        if (!Schema::hasColumn('penyewaan_fasilitas', 'lama_sewa_jam')) {
            $table->integer('lama_sewa_jam')->default(0);
        }

        if (!Schema::hasColumn('penyewaan_fasilitas', 'harga_sewa')) {
            $table->integer('harga_sewa')->default(0);
        }

        if (!Schema::hasColumn('penyewaan_fasilitas', 'total_biaya')) {
            $table->integer('total_biaya')->default(0);
        }

        if (!Schema::hasColumn('penyewaan_fasilitas', 'status_sewa')) {
            $table->string('status_sewa')->default('aktif');
        }

        if (!Schema::hasColumn('penyewaan_fasilitas', 'status_pembayaran')) {
            $table->string('status_pembayaran')->default('belum');
        }

    });
}
    public function down(): void
    {
        //
    }
};
