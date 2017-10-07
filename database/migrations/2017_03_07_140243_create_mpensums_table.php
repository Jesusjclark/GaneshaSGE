<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpensumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpensums', function (Blueprint $table) {

            $table->increments('cod_pen');
            $table->integer('cod_pnf_p')->unsigned();
            $table->foreign('cod_pnf_p')->references('cod_pnf')->on('mpnfs')->onDelete('cascade');
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
        Schema::dropIfExists('mpensums');
    }
}
