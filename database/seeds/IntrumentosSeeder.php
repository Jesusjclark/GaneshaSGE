<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class IntrumentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run() {
        $inst = array(
            array('tip_inst' => 'Examen', 'descp_inst' => 'Evaluación Individual', 'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),

             array('tip_inst' => 'Taller', 'descp_inst' => 'Evaluación Grupal', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()),    
        
            );

        DB::table('minstrumentos')->insert($inst);
    }
}
