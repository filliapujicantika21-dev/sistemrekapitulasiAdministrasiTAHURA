<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penyewaan_fasilitas', function (Blueprint $table) {

            $table->string('satuan_tampilan')
                  ->nullable()
                  ->after('jumlah_sesi');

        });
    }


    public function down(): void
    {
        Schema::table('penyewaan_fasilitas', function (Blueprint $table) {

            $table->dropColumn('satuan_tampilan');

        });
    }
};