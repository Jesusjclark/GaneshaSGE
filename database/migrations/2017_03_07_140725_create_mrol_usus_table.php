<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMrolUsusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mrol_usus', function (Blueprint $table) {
            $table->increments('id_rol_usu');
            $table->integer('id_tru');
            $table->integer('id_rol_tru');

            $table->foreign('id_tru')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_rol_tru')->references('id_rol')->on('mrols')->onDelete('cascade');

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
        Schema::dropIfExists('mrol_usus');
    }
}
