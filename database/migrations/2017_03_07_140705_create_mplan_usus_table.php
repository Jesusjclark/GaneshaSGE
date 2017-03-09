<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMplanUsusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mplan_usus', function (Blueprint $table) {
            $table->increments('id_plan_usu');

            $table->string('id_plan_tpu')->unique();
            $table->foreign('id_plan_tpu')->references('id_plan')->on('mplan_evas')->onDelete('cascade')->onUpdate('cascade');

            $table->string('ci_usu_tpu', 9)->unique();
            $table->foreign('ci_usu_tpu')->references('ci_usu')->on('musuarios')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('mplan_usus');
    }
}
