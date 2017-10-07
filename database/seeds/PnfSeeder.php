<?php
/**
*@autor: jesusjclark
**/ 
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
 
class PnfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
	    DB::table('mpnfs') -> insert([
        'cod_pnf'=>'001',
        'nom_pnf'=>'PNF INFORMATICA',
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now()
    	]);
    }
}