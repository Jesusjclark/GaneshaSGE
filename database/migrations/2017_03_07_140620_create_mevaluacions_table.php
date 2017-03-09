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
            $table->string('id_eva');
            $table->primary('id_eva');
            $table->string('id_plan_eva')->unique();
            $table->string('id_inst_eva')->unique();
            $table->string('criterio', 15);
            $table->text('observacion');
            $table->date('fec_prop');
            $table->date('fec_res');
            $table->date('fec_part');
            $table->string('corte');
            $table->text('contenido');


            $table->foreign('id_plan_eva')->references('id_plan')->on('mplan_evas')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('id_inst_eva')->references('id_inst')->on('minstrumentos')->onDelete('cascade')->onUpdate('cascade');       

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
