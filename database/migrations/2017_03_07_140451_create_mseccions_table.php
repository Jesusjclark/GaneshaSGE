<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMseccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mseccions', function (Blueprint $table) {
            $table->string('cod_sec', 6)->unique();
            $table->primary('cod_sec');
            $table->string('turno', 10);

            $table->string('cod_pen_sec')->unique();
            $table->foreign('cod_pen_sec')->references('cod_pen')->on('mpensums')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('mseccions');
    }
}
