<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesSeeder extends Seeder
{
  
    public function run() {
        $roles = array(
            array('nom_rol' => 'Administrador', 'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),
            array('nom_rol' => 'Coord Departamento','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),
            array('nom_rol' => 'Asis Administrativo','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),
            array('nom_rol' => 'Docente','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),
            array('nom_rol' => 'Coordinador','created_at'=>Carbon::now(),'updated_at'=>Carbon::now())
            );
        DB::table('mrols')->insert($roles);
    }
}

