<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pengadaan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tanaman_id')->nullable();
            $table->bigInteger('pengadaan_id')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('harga_jual')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pengadaan');
    }
}
