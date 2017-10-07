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
            $table->integer('id_master');
            $table->string('ci_est_tes', 9);

            $table->foreign('id_master')->references('id_uc_sec')->on('mpuentemasters')->onDelete('cascade');
            $table->foreign('ci_est_tes')->references('ci_est')->on('mestudiantes')->onDelete('cascade');

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
