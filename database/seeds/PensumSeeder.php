<?php
/**
*@autor: jesusjclark
**/ 
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
 
class PensumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
	    DB::table('mpensums') -> insert([
        'cod_pnf_p'=>'001',
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now()
    	]);
    }
}