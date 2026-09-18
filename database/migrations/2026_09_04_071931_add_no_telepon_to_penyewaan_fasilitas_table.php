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
    Schema::table('penyewaan_fasilitas', function (Blueprint $table) {

        $table->string('no_telepon')
              ->nullable()
              ->after('nama_penyewa');

    });
}


public function down()
{
    Schema::table('penyewaan_fasilitas', function (Blueprint $table) {

        $table->dropColumn('no_telepon');

    });

}
};
