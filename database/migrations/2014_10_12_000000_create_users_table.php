<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('img', 50)->nullable();
            $table->string('nama', 100)->nullable();
            $table->boolean('gender')->nullable();
            $table->string('no_tlp', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->text('alamat')->nullable();
            $table->date('regdate')->nullable();
            $table->string('password', 255)->nullable();
            $table->tinyInteger('level')->nullable();
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
        Schema::dropIfExists('users');
    }
}
