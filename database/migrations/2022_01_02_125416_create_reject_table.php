<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRejectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reject', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tanaman_id')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('total')->nullable();
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
        Schema::dropIfExists('reject');
    }
}
