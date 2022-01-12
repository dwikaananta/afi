<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnHargaJualToHargaBeliFromDetailPengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_pengadaan', function (Blueprint $table) {
            $table->after('harga_jual', function ($table) {
                $table->integer('harga_beli')->nullable();
            });
            $table->dropColumn('harga_jual');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_pengadaan', function (Blueprint $table) {
            //
        });
    }
}
