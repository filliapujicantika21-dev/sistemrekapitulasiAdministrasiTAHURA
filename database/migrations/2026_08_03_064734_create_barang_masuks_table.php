<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_masuks', function (Blueprint $table) {

            $table->id();

            $table->foreignId('kategori_id')
                    ->constrained('kategoris')
                    ->cascadeOnDelete();

            $table->string('kode_barang');

            $table->string('nama_barang');

            $table->string('satuan');

            $table->integer('qty');

            $table->decimal('harga',15,2);

            $table->string('supplier')->nullable();

            $table->date('tanggal');

            $table->text('keterangan')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};