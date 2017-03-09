<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMejesUcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mejes_ucs', function (Blueprint $table) {
            $table->increments('cod_uc_ejes')->unique();

            $table->string('cod_uc_pnf_euc', 6)->unsigned();
            $table->foreign('cod_uc_pnf_euc')->references('cod_uc_pnf')->on('muni_crrs')->onDelete('cascade')->onUpdate('cascade');

            $table->string('cod_ejes_euc')->unsigned();
            $table->foreign('cod_ejes_euc')->references('cod_eje')->on('mejes')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('mejes_ucs');
    }
}
