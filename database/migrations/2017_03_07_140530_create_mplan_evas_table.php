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
            $table->string('id_plan');
            $table->primary('id_plan');
            $table->string('status', 10);

            $table->string('cod_sec_plan', 6)->unique();
            $table->foreign('cod_sec_plan')->references('cod_sec')->on('mseccions')->onDelete('cascade')->onUpdate('cascade');
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
