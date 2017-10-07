<?php

use Illuminate\Database\Seeder;
use GaneshaSIGE\ModelRol;
use GaneshaSIGE\ModelModulo;

use GaneshaSIGE\User as User;
use Carbon\Carbon;

class RolesUsuSeeder extends Seeder
	
{

    public function run()
    {
        $roles = ModelRol::all();
        $usuario = User::find(1);
        foreach ($roles as $role) {
        	DB::table('mrol_usus') -> insert([
            	'id_rol_tru' => $role->id_rol,
            	'id_tru' => $usuario->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
        	]);
        }
        DB::table('mrol_usus') -> insert([
                'id_rol_tru' => '5',
                'id_tru' => '2',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);

        
        $AccionesAdmin = [
      
            //Notas
            'consultar.nota',
            'asignar.nota',
            'transcribir.nota',
            'modificar.nota',
            'publicar.nota',
            //estadisticas
            'consulta.aprobados',
            'consulta.secciones',
            'consulta.per',
            //alumnos
            'consultar.alumno',
            'subir.listado',
            'eliminar.alumno',
            'agregar.alumnomanual',
            'modificar.alumnomanual',
            'modificar.listado',
            //secciones
            'crear.seccion',
            'eliminar.seccion',
            'modificar.seccion',
            //unidades curriculres
            'crear.uc',
            'consultar.uc',
            'eliminar.uc',
            'modificar.uc',
            //planes
            'consultar.planes',
            
            'crear.planmaestro',
            'eliminar.plan',
            'modificar.planmaestro',
            'modificar.planhijo',
            'asignar.planhijo',
            'imprimir.plan',
            'modificar.rol',
            //ejes
            'crear.ejes',
            'eliminar.ejes',
            'modificar.ejes',
            //instrumentos
             'crear.instrumentos',
            'eliminar.instrumentos',
            'modificar.instrumentos',
            //usuario
            'consultar.usuario',
            'crear.usuario',
            'eliminar.usuario',
            'modificar.usuario',
            'asignar.usuario',
            //rol
            'consultar.rol',
            'crear.rol',
            'eliminar.rol'


        ];

          $AccionesDocente = [
      
            //Notas
            'asignar.nota',
            'transcribir.nota',
            'modificar.nota',
            'publicar.nota',
            'consultar.nota',

            //estadisticas
            'consulta.aprobados',
            'consulta.secciones',
            'consulta.per',

            //alumnos
            'subir.listado',
            'eliminar.alumno',
            'agregar.alumnomanual',
            'modificar.alumnomanual',
            'modificar.listado',
            'consultar.alumno',
          
            //unidades curriculres
            'consultar.uc',

            //planes
            'consultar.planes',
            
            'modificar.planhijo',
            'imprimir.plan',

            //ejess
            //instrumentos
            'crear.instrumentos',
            'modificar.instrumentos',
            'consultar.rol'





        ];

          $AccionesCoorUC = [
      
            //Notas
            'consultar.nota',

            //estadisticas
            'consulta.aprobados',
            'consulta.secciones',
            'consulta.per',

            //alumnos
            'consultar.alumno',
          
            //unidades curriculres
            'consultar.uc',

            //planes
            'consultar.planes',

            'crear.planmaestro',
            'eliminar.plan',
            'modificar.planmaestro',
            'imprimir.plan',

            //ejess
            //instrumentos
            'crear.instrumentos',
            'modificar.instrumentos',
            'consultar.rol'



        ];

        $AccionesAsisAdministrativo = [
      
            
            
            //estadisticas
            'consulta.aprobados',
            'consulta.secciones',
            'consulta.per',
           
            //secciones
            'crear.seccion',
            'modificar.seccion',

            //unidades curriculres
            'crear.uc',
            'consultar.uc',
            'modificar.uc',

            //ejes
            'crear.ejes',
            'modificar.ejes',

            //instrumentos
            'crear.instrumentos',
            'modificar.instrumentos',

            'crear.usuario',
            'consultar.usuario',
            'modificar.usuario'

           


        ];
     
        //ROLES PREDETERMINADOS DEL SISTEMA
            //ADMIN

        foreach($AccionesAdmin as $AccionAdmin){
            $id=ModelModulo::where('nom_mod', $AccionAdmin)->value('id_mod');
            DB::table('mrol_mods') -> insert([
            'id_rol_trm' => '1',
            'id_mod_trm' => $id
            ]);
            
        }
        //CoorDpto
            foreach($AccionesAdmin as $AccionCoord){
            $id=ModelModulo::where('nom_mod', $AccionCoord)->value('id_mod');
            DB::table('mrol_mods') -> insert([
            'id_rol_trm' => '2',
            'id_mod_trm' => $id
            ]);
            
        }
        //Asis Administrativo
           foreach($AccionesAsisAdministrativo as $AccionAsis){
            $id=ModelModulo::where('nom_mod', $AccionAsis)->value('id_mod');
            DB::table('mrol_mods') -> insert([
            'id_rol_trm' => '3',
            'id_mod_trm' => $id
            ]);
            
        }
        //Docente
           foreach($AccionesDocente as $AccionDoc){
            $id=ModelModulo::where('nom_mod', $AccionDoc)->value('id_mod');
            DB::table('mrol_mods') -> insert([
            'id_rol_trm' => '4',
            'id_mod_trm' => $id
            ]);
            
        }

        //Coor UC
           foreach($AccionesCoorUC as $AccionCoorUC){
            $id=ModelModulo::where('nom_mod', $AccionCoorUC)->value('id_mod');
            DB::table('mrol_mods') -> insert([
            'id_rol_trm' => '5',
            'id_mod_trm' => $id
            ]);
            
        }


    }



}

