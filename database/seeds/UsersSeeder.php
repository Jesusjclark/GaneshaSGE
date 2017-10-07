<?php
/**
*@autor: jesusjclark
**/ 
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
 
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
	    DB::table('users') -> insert([
        'ci_usu'=>'00000420',
        'name'=>env('APP_DEV_USERNAME', 'ganeshadevteam'),
        'ape_usu'=>'|',
        'email'=>'ganeshadevteam@gmail.com',
        'password'=>Hash::make("ganeshap4ss"),
        'tlf'=>$faker->randomNumber($nbDigits=9),
        'img_perfil'=>'1491785651_index.jpeg',
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now()
    	]);

         DB::table('users') -> insert([
        'ci_usu'=>'87654321',
        'name'=>env('APP_DEV_USERNAME', 'NULLUSER'),
        'ape_usu'=>'|',
        'email'=>'admin@noreply.com',
        'password'=>Hash::make("123456"),
        'tlf'=>$faker->randomNumber($nbDigits=9),
        'img_perfil'=>'1491785651_index.jpeg',
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now()
        ]);

         DB::table('users') -> insert([
        'ci_usu'=>'NULLUSER',
        'name'=>env('APP_DEV_USERNAME', 'NULLUSER'),
        'ape_usu'=>'|',
        'email'=>'null@noreply.com',
        'password'=>Hash::make("123456"),
        'tlf'=>$faker->randomNumber($nbDigits=9),
        'img_perfil'=>'1491785651_index.jpeg',
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now()
        ]);
    }
}