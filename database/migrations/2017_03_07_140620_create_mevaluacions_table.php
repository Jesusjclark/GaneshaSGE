<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMevaluacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mevaluacions', function (Blueprint $table) {
            $table->increments('id_eva');
            $table->integer('unidad');
            $table->integer('id_plan_eva');
            $table->integer('id_inst_eva');
            $table->text('criterio');
            $table->string('tecnica', 25);
            $table->text('observacion')->nullable();
            $table->date('fec_prop');
            $table->date('fec_res')->nullable();
            $table->string('participacion', 3)->nullable();
            $table->float('ponderacion', 2, 2);
            $table->date('fec_part')->nullable();
            $table->string('corte');
            $table->text('contenido');


            $table->foreign('id_plan_eva')->references('id_plan')->on('mplan_evas')->onDelete('cascade');

            $table->foreign('id_inst_eva')->references('id_inst')->on('minstrumentos')->onDelete('cascade');       

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
        Schema::dropIfExists('mevaluacions');
    }
}
