<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Mpuentemaster extends Migration
{  

    public function up()
    {
     Schema::create('mpuentemasters', function (Blueprint $table) {


            $table->increments('id_uc_sec')->unique();
            $table->string('cod_unidad', 9)->unsigned();
            $table->integer('id_usu')->unsigned();
            $table->string('cod_seccion')->unsigned();
            $table->boolean('coordinador');

            $table->foreign('id_usu')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('cod_seccion')->references('cod_sec')->on('mseccions')->onDelete('cascade');
            
            $table->foreign('cod_unidad')->references('cod_uc_pnf')->on('muni_crrs')->onDelete('cascade');
            
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
        Schema::dropIfExists('mpuentemasters');
    }
}

/*
    * Esta table permite la creaccion de Del Registro y el contror de una unidad y su seccion junto al profesor que la da

    _________________________________________________________________
    |  id  |  cod_unidad  |  id_usu  |  cod_seccion  |  coordinador  |
    |______|______________|__________|_______________|_______________|
    |  1   |    MATE123   |     1    |     IN3121    |      TRUE     |
    |______|______________|__________|_______________|_______________|

    * Asi cuando agregemos un Nuevo Usuario le Indicaremos si es coordinador o Profesor, si es profesor daremos la opcion para asignarles las unidades curriculares y la seccion a la cual le dara clases y las guardaremos en esta tabla diciendole que coordinador es NULL indicandole que solo dara clase. 
    * Si es Coordiador lo trabajaremos de la misma forma actual pero agregaremos este registro aqui asi evitamos la repeticion de campos.

*/