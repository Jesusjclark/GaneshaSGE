<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
class SeccionSeeder extends Seeder
{
    public function run(){
     $action = array(
    array('cod_sec' => 'NULL', 'turno' => 'Master', 'trayecto' => '0','created_at'=> Carbon::now(),'updated_at'=>Carbon::now()),

    );
         DB::table('mseccions')->insert($action);
    }


}

