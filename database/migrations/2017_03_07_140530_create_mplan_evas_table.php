<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMplanEvasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mplan_evas', function (Blueprint $table) {
            $table->increments('id_plan');
            $table->string('status', 10);
            $table->integer('cod_sec_plan');
            
            $table->foreign('cod_sec_plan')->references('id_uc_sec')->on('mpuentemasters')->onDelete('cascade');
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
        Schema::dropIfExists('mplan_evas');
    }
}
