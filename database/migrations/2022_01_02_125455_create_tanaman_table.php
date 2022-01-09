<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanaman', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('kategori')->nullable();
            $table->string('nama', 150)->nullable();
            $table->string('img', 50)->nullable();
            $table->integer('harga_beli')->nullable();
            $table->integer('harga_jual')->nullable();
            $table->tinyInteger('stok')->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('tanaman');
    }
}
