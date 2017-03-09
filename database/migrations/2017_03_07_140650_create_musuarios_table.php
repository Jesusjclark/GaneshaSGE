<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musuarios', function (Blueprint $table) {
            $table->string('ci_usu', 9);
            $table->primary('ci_usu');
            $table->string('nom_usu', 15);
            $table->string('ape_usu', 15);
            $table->string('correo', 25);
            $table->string('tlf', 12);
            $table->string('password', 15);
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
        Schema::dropIfExists('musuarios');
    }
}
