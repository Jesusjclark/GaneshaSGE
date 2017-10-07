<?php
/**
*@autor: jesusjclark
**/ 
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
 
class EjesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
	    DB::table('mejes') -> insert([
        'nom_eje'=>'Estetico Ludico',
        'descripcion'=>'Descripcion del Ludico',
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now()
    	]);
    }
}

