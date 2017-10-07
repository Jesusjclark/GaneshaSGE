<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMestudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mestudiantes', function (Blueprint $table) {
            $table->string('ci_est', 9)->unique();
            $table->primary('ci_est');
            $table->string('nom_est', 30);
            $table->string('ape_est', 30);
            $table->string('cod_pnf_est', 6);
            $table->string('email', 36);

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
        Schema::dropIfExists('mestudiantes');
    }
}
