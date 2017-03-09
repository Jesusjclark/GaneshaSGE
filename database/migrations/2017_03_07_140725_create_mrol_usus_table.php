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

            $table->string('ci_usu_tru', 9)->unique();
            $table->foreign('ci_usu_tru')->references('ci_usu')->on('musuarios')->onDelete('cascade')->onUpdate('cascade');

            $table->string('id_rol_tru')->unique();
            $table->foreign('id_rol_tru')->references('id_rol')->on('mrols')->onDelete('cascade')->onUpdate('cascade');

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
