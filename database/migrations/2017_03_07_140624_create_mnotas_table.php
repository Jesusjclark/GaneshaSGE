<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMnotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mnotas', function (Blueprint $table) {
            $table->increments('id_nota');
            $table->string('id_eva_not')->unique();
            $table->string('ci_est', 9);

            $table->foreign('id_eva_not')->references('id_eva')->on('mevaluacions')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('mnotas');
    }
}
