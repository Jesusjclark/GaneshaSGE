<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMnotasTable extends Migration
{
    public function up()
    {
        Schema::create('mnotas', function (Blueprint $table) {
            $table->increments('id_nota');
            $table->integer('id_eva_not');
            $table->string('ci_est_not', 9);
            $table->float('nota', 2, 2);

            $table->foreign('id_eva_not')->references('id_eva')->on('mevaluacions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('mnotas');
    }
}
