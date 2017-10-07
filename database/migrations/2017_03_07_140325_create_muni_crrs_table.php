<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMuniCrrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muni_crrs', function (Blueprint $table) {
            $table->string('cod_uc_pnf', 9 )->unique();
            $table->primary('cod_uc_pnf');
            $table->string('cod_uc_nac', 9);
            $table->integer('creditos');
            $table->string('nom_uc', 30);
            $table->string('trayecto', 1);
            $table->float('hta');
            $table->float('htt');
            $table->float('hte');
            $table->boolean('periodo');

            $table->integer('cod_pen_uc')->unsigned();

            $table->foreign('cod_pen_uc')->references('cod_pen')->on('mpensums')->onDelete('cascade');
            
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
        Schema::dropIfExists('muni_crrs');
    }
}
