<?php
/**
*@autor: jesusjclark
**/ 
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
 
class ModulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
      public function run()
    {
        $modulos = array(
            //usuarios
            array('nom_mod' => 'crear.usuario' ,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),
            array('nom_mod' => 'eliminar.usuario' ,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),
            array('nom_mod' => 'modificar.usuario','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'asignar.usuario','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
              array('nom_mod' => 'consultar.usuario','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),

            
            //roles
            array('nom_mod' => 'crear.rol' ,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),
            array('nom_mod' => 'eliminar.rol' ,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),
            array('nom_mod' => 'modificar.rol','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'consultar.rol','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),

            //ejes
            array('nom_mod' => 'crear.ejes','created_at'=>Carbon::now(),'updated_at'=>Carbon::now(),'created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'eliminar.ejes','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'modificar.ejes','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),


            //instrumentos
            array('nom_mod' => 'crear.instrumentos','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'eliminar.instrumentos','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'modificar.instrumentos','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),

            //unidades curriculares
            array('nom_mod' => 'crear.uc','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),
            array('nom_mod' => 'consultar.uc','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),

            array('nom_mod' => 'eliminar.uc','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'modificar.uc','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),

            //planes
            array('nom_mod' => 'crear.planmaestro','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'eliminar.plan','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'modificar.planmaestro','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'modificar.planhijo','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'asignar.planhijo','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'imprimir.plan','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),       
             array('nom_mod' => 'consultar.planes','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),



            //alumnos
            array('nom_mod' => 'subir.listado','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'eliminar.alumno' ,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),
            array('nom_mod' => 'agregar.alumnomanual','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'modificar.alumnomanual','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'modificar.listado','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'consultar.alumno','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),



            //secciones
            array('nom_mod' => 'crear.seccion','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'eliminar.seccion' ,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),
            array('nom_mod' => 'modificar.seccion','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),

            //Notas
            array('nom_mod' => 'asignar.nota','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'transcribir.nota','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'modificar.nota' ,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),
             array('nom_mod' => 'publicar.nota' ,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),
             array('nom_mod' => 'consultar.nota' ,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),




            //estadisticas
            array('nom_mod' => 'consulta.aprobados','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),
            array('nom_mod' => 'consulta.secciones' ,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),
            array('nom_mod' => 'consulta.per','created_at'=>Carbon::now(),'updated_at'=>Carbon::now() ),

        
            );

      DB::table('mmodulos')->insert($modulos);
    }
}
