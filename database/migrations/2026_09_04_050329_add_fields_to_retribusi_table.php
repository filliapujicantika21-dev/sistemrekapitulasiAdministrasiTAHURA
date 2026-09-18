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

        $table->string('nama_pengunjung');
        $table->string('jenis_identitas');
        $table->string('nomor_identitas');
        $table->string('no_telepon');
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
