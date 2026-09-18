<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('penyewaan_fasilitas', function (Blueprint $table) {

        if (!Schema::hasColumn('penyewaan_fasilitas', 'durasi_jam')) {
            $table->integer('durasi_jam')
                  ->default(0)
                  ->after('lama_sewa_jam');
        }

    });
}


public function down(): void
{
    Schema::table('penyewaan_fasilitas', function (Blueprint $table) {

        if (Schema::hasColumn('penyewaan_fasilitas', 'durasi_jam')) {
            $table->dropColumn('durasi_jam');
        }

    });
}
};
