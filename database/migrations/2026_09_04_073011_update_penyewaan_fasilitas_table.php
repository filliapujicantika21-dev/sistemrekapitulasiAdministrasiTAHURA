<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('penyewaan_fasilitas', function (Blueprint $table) {

            if (!Schema::hasColumn('penyewaan_fasilitas', 'kode_sewa')) {
                $table->string('kode_sewa')->nullable();
            }

            if (!Schema::hasColumn('penyewaan_fasilitas', 'no_telepon')) {
                $table->string('no_telepon')->nullable();
            }

            if (!Schema::hasColumn('penyewaan_fasilitas', 'kategori_sewa')) {
                $table->string('kategori_sewa')->nullable();
            }

            if (!Schema::hasColumn('penyewaan_fasilitas', 'jumlah_unit')) {
                $table->integer('jumlah_unit')->default(1);
            }

            if (!Schema::hasColumn('penyewaan_fasilitas', 'jam_mulai')) {
                $table->time('jam_mulai')->nullable();
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

        });
    }


    public function down(): void
    {
        Schema::table('penyewaan_fasilitas', function (Blueprint $table) {

            $table->dropColumn([
                'kode_sewa',
                'no_telepon',
                'kategori_sewa',
                'jumlah_unit',
                'jam_mulai',
                'jam_selesai',
                'lama_sewa_hari',
                'lama_sewa_jam',
                'harga_sewa',
                'total_biaya'
            ]);

        });
    }
};