<?php
/**
*@autor: jesusjclark
**/ 
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call('UsersSeeder');
        $this->call('PnfSeeder');
        $this->call('PensumSeeder');
        $this->call('EjesSeeder');
        $this->call('ModulosSeeder');
        $this->call('SeccionSeeder');
        $this->call('SeccionUnidadSeeder');
        $this->call('UnidadesSeeder');
        $this->call('RolesSeeder');
        $this->call('RolesUsuSeeder');
        $this->call('IntrumentosSeeder');


      
        // $this->call(UsersTableSeeder::class);
    }
}
