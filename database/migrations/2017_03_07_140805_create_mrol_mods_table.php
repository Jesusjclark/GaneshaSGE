<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMrolModsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mrol_mods', function (Blueprint $table) {
            $table->increments('id_rol_mod')->unique();

            $table->integer('id_rol_trm');
            $table->foreign('id_rol_trm')->references('id_rol')->on('mrols')->onDelete('cascade');

            $table->integer('id_mod_trm');
            $table->foreign('id_mod_trm')->references('id_mod')->on('mmodulos')->onDelete('cascade');

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
        Schema::dropIfExists('mrol_mods');
    }
}
