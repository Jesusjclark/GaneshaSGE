<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {                       
            $table->increments('id');
            $table->string('ci_usu', 9)->unique();
            $table->string('name', 15);
            $table->string('ape_usu', 15);
            $table->string('img_perfil');            
            $table->string('email', 36)->unique();
            $table->string('password', 256)->unique();
            $table->string('tlf', 12);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
