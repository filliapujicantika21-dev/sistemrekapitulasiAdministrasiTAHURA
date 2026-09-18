<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('retribusi', function (Blueprint $table) {

        $table->string('plat_nomor')->nullable();
        $table->integer('jumlah_orang')->default(1);
        $table->string('kategori')->nullable();

        $table->decimal('tarif',10,2)->default(0);
        $table->decimal('total_bayar',10,2)->default(0);

        $table->date('tanggal_masuk')->nullable();
        $table->time('jam_masuk')->nullable();

        $table->string('status')->default('masuk');

        $table->date('tanggal_keluar')->nullable();
        $table->time('jam_keluar')->nullable();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('retribusi', function (Blueprint $table) {
            //
        });
    }
};
