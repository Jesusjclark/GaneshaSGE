<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsecEstsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msec_ests', function (Blueprint $table) {
            $table->increments('id_sec_est');
            $table->string('cod_sec_tes', 6)->unique();
            $table->foreign('cod_sec_tes')->references('cod_sec')->on('mseccions')->onDelete('cascade')->onUpdate('cascade');

            $table->string('ci_est_tes', 6)->unique();
            $table->foreign('ci_est_tes')->references('ci_est')->on('mestudiantes')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('msec_ests');
    }
}
