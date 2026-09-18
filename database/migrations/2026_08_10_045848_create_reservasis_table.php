<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservasis', function (Blueprint $table) {

            $table->id();

            $table->string('nomor_invoice')->unique();

            $table->string('nama_penyewa');

            $table->string('nomor_penyewa');

            $table->string('nomor_kamar');

            $table->string('tipe_villa');

            $table->integer('jumlah_extra_bed')->default(0);

            $table->date('check_in');

            $table->date('check_out');

            $table->enum('payment', [
                'Down Payment',
                'Pending',
                'Full Payment'
            ]);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};