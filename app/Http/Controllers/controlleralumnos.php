<?php

namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GaneshaSIGE\ModelEstudiante;
use Illuminate\Support\Facades\Mail; 
use \Auth as Auth;
use GaneshaSIGE\ModelSeccion;
use GaneshaSIGE\ModelUnidadCurricular;
use GaneshaSIGE\ModelPlandeEvaluacion;
use GaneshaSIGE\ModelEvaluacion;
use GaneshaSIGE\ModelNota;



use GaneshaSIGE\ModelBitacora;
use GaneshaSIGE\User;

use Excel;
use Storage;
use Laracasts\Flash\Flash;




class controlleralumnos extends Controller
{
    /////////  MOSTRAR DATOS    ///////////////////
    public function mostrar()
    {  
        $id = Auth::user() -> id; 
        $master = DB::table('mpuentemasters')->where('cod_seccion', '!=', 'NULL')->where('id_usu', $id)->get();
        $unidadex=DB::table('muni_crrs')->select('nom_uc');

        $unidades=ModelUnidadCurricular::all();
        //dd($unidades);
        return view('Alumnos/G_Alumnos')->with(['master' => $master,'unidades'=>$unidades]);

    }

    public function verifica(Request $request, $id_uc_sec)
    {
        $id = Auth::user() -> id; 
        $tipo = $request->Tipo;
        $busqueda=DB::table('msec_ests')->where('id_master', $id_uc_sec)->get();
        //$busqueda= array_flatten($busqueda);
        //dd($busqueda);
        $cuentabusqueda=count($busqueda);
        $i = 0;
        $e =0;
        if ($cuentabusqueda!=0){
            $validate='true';
            if($tipo == 'Listado'){
                Flash::warning('Ya hay Alumnos Para esta Seccion!<br>¿Desea Actualizarlo?<br>!!Si es lo que desea se Reemplazara todos los estudiantes de la seccion. Asegurece que se encuentren todos los estudiantes en el listado¡¡');

                return view('Alumnos/G_Alumnos')->with(['master2'=> $id_uc_sec,'validate'=> $validate, 'tipo' => $tipo]);
            }
            else{

                $alumnos= ModelEstudiante::all();             
                $busque=DB::table('msec_ests')->where('id_master', '!=' ,$id_uc_sec)->get();

                Flash::warning('Ya hay Alumnos Para esta Seccion!<br>¿Desea Actualizarlos? <br>!!Si agrega un nuevo estudiante para la seccion y ya a pasado notas para alguna evaluación, a este se le asignara por defecto 0. <br>Si desea cambiarlo dirijase a la Gestion de notas');

                return view('Alumnos/G_Alumnos')->with(['busqueda' =>$busqueda,'master2'=> $id_uc_sec,'validate'=> $validate, 'tipo' => $tipo, 'alumnos' => $alumnos, 'busque'=> $busque, 'i' => $i, 'e' => $e]);
            }
        }
        else{
            $validate='false';
            if($tipo == 'Listado'){
                Flash::success('No Tiene Alumnos para esta Seccion <br>¿Desea Ingresarlos?');
                return view('Alumnos/G_Alumnos')->with(['master2'=> $id_uc_sec,'validate'=> $validate, 'tipo' => $tipo]);
            }
            else{
                $alumnos = ModelEstudiante::get();
                Flash::success('No Tiene Alumnos para esta Seccion <br>¿Desea Ingresarlos?');
                return view('Alumnos/G_Alumnos')->with(['master2'=> $id_uc_sec,'validate'=> $validate, 'tipo' => $tipo, 'alumnos' => $alumnos, 'i' => $i]);
            }
         }
         //dd($validate, $masterverif);
    }
    ///////////////////////////////FUNCION AUTOMATICA EXCEL CSV/////////////////////

    public function archivo(Request $request)
    {   
        $idbit = Auth::user() -> ci_usu;       
        $nom=Auth::user() -> name;
        $ape=Auth::user() -> ape_usu;
        $name=$nom.' '.$ape.'';
        //obtengo dir del archivo//               
        $path = $request->file('import_file')->getRealPath();
        //leo el archivo cargandolo en el componente
        $data = Excel::load($path, function($reader) {})->get();
        #dd($request, $data);
        //verifico que no este vacio
        $valid=$request->Email;
        #dd($valid);
        if(!empty($data) && $data->count())
        {   
          dd($data->toArray());
            //recorro la data del archivo y asigno cada celda a un
            //arreglo con cabeceras iguales a la bd
            if(!$valid){
                foreach ($data->toArray() as $key => $value) {
                $insert[] = ['ci_est' => $value['cedula'], 'nom_est' => $value['nombre'], 'ape_est' => $value['apellido'],'cod_pnf_est' =>'1','email'=>'NULL'];
                }
            }
            if($valid){
                foreach ($data->toArray() as $key => $value) {
                $insert[] = ['ci_est' => $value['cedula'], 'nom_est' => $value['nombre'], 'ape_est' => $value['apellido'],'cod_pnf_est' => '1','email'=>$value['email']];
                }
            }
            //consulto la tabla estudiantes y solo extraigo las ci
            $estudiantes=DB::table('mestudiantes')->pluck('ci_est');
            //cuento la cantidad de estudiantes
            $contador=count($estudiantes);

            //si existen estudiantes comienzo a validar
            if($contador!=0) 
            {
                foreach ($insert as $estuarchivo){
                    
                    $buscame=$estuarchivo['ci_est'];
                    //dd($buscame);
                    $encuentra=DB::table('mestudiantes')->where('ci_est', $buscame)->pluck('ci_est');
                    $cantencontrados=count($encuentra);

                   //dd($cantencontrados,$estuarchivo);
                        if($cantencontrados==0) {
                            //dd($estuarchivo);
                          DB::table('mestudiantes')->insert($estuarchivo);
                          //dd($estuarchivo);
                        $secvalidd=$request->id_cod;
                                    
                        $plandetectado=ModelPlandeEvaluacion::where('cod_sec_plan',$secvalidd)->first();
                        //dd($plandetectado);
                          $evas=ModelEvaluacion::where('id_plan_eva',$plandetectado->id_plan)->get();
                          //dd($evas);
                          $cuentaeva=count($evas);
                          if($cuentaeva>0){
                            //dd($evas);
                          foreach ($evas as $keyx => $value) {
                           // dd($evas,$key,$value);
                            $NotasAsignadas=ModelNota::where('id_eva_not',$value->id_eva)->first();
                            $cuentaNotas=count($NotasAsignadas);
                           // dd($cuentaNotas);
                            if($cuentaNotas>0){
                              $validNotaNew=ModelNota::where('id_eva_not',$value->id_eva)->where('ci_est_not',$buscame)->first();
                              $cuentavalidNota=count($validNotaNew);
                              if($cuentavalidNota==0){
                              $NuevaNota=new ModelNota;
                              $NuevaNota->id_eva_not=$value->id_eva;
                              $NuevaNota->ci_est_not=$buscame;
                              $NuevaNota->nota=0;
                              $NuevaNota->save();
                              }
                              else{

                                 # code...
                               } 
                            }
                            //dd($NotasAsignadas,$cuentaNotas);
                          }
                        }
                        //GUARDO EN BITACORA///
                             $accion='subir.listado'; 

                              $bitacora= new ModelBitacora;
                              $observacion='alumno registrado: '.$estuarchivo['nom_est'].''.$estuarchivo['nom_est']; 

                              $bitacora->registra($idbit,$accion,$observacion,$name);

                              ////////////////////////////////    

                          
                        }

                        else{
                        $varact=array(DB::table('mestudiantes')->where('ci_est', $buscame)->get());
                       // dd($estuarchivo['ci_est']);
                             $varact=array_flatten($varact,$estuarchivo['nom_est']);
                        if($valid){
                         DB::table('mestudiantes')->where('ci_est', $buscame)->update(['nom_est'=>$estuarchivo['nom_est'],'ape_est'=>$estuarchivo['ape_est'],'email'=>$estuarchivo['email']]);
                       }
                         if($valid==='FALSE'){
                          DB::table('mestudiantes')->where('ci_est', $buscame)->update(['nom_est'=>$estuarchivo['nom_est'],'ape_est'=>$estuarchivo['ape_est'],'email'=>'NULL']);
                         }
                        
                        //GUARDO EN BITACORA///
                              $bitacora= new ModelBitacora;
                                $accion='modificar.listado'; 

                              $observacion='alumno actualizado: '.$estuarchivo['nom_est'].''.$estuarchivo['nom_est']; 

                              $bitacora->registra($idbit,$accion,$observacion,$name);

                              ////////////////////////////////    
                        }

                }   
            }
            else{
                //sino existen estudiantes aun, agrego el listado completo
                 DB::table('mestudiantes')->insert($insert); 
                 foreach ($insert as $estuarchivo){
                 //GUARDO EN BITACORA///
                             $accion='subir.listado'; 

                              $bitacora= new ModelBitacora;
                              $observacion='alumno registrado: '.$estuarchivo['nom_est'].''.$estuarchivo['nom_est']; 

                              $bitacora->registra($idbit,$accion,$observacion,$name);

                              //////////////////////////////// 
                              }   
            }


                //creo nuevo array para insersion en tabla puente
                foreach ($data->toArray() as $key => $value) {
                $insert2[] = ['ci_est_tes' => $value['cedula'],'id_master' => $request->id_cod,];
        
                }

            //verifico si el archivo no esta vacio
            if(!empty($insert)){     
                $puente=DB::table('msec_ests')->where('id_master', $request->id_cod)->get();

                $var=count($puente);
                //variables de control
                $error='false';
                    //si ya existen registros de esta uc/sec para puente estudiantes
                    if ($var!=0){
                            //traigo nombre de la unidad que ya existe
                            $cod=$request->id_cod;
                            $cod_uc=DB::table('mpuentemasters')->where('id_uc_sec', $cod)->pluck('cod_unidad');
                            
                            $name=ModelUnidadCurricular::find($cod_uc[0]);

                            $mensaje='Ya existen estudiantes asignados en esta seccion para la unidad curricular : ' . ' ' . $name->nom_uc;
                            $error='true';
                            $id = Auth::user() -> id; 
                            $master = DB::table('mpuentemasters')->where('cod_seccion', '!=', 'NULL')->where('id_usu', $id)->get();
                        

                            //envio error a pantalla
                        return redirect('/alumnos/vista')->with('msjerr',$mensaje);
                    }
                        else{
                            //sino existen registros, inserto el array del puente y mando alerta con el nombre de la unidad al que se le registraron estudiantes
                            DB::table('msec_ests')->insert($insert2);
                            $cod=$request->id_cod;
                            $cod_uc=DB::table('mpuentemasters')->where('id_uc_sec', $cod)->pluck('cod_unidad');
                            
                            $name=ModelUnidadCurricular::find($cod_uc[0]);
                            $id = Auth::user() -> id; 
                            $master = DB::table('mpuentemasters')->where('cod_seccion', '!=', 'NULL')->where('id_usu', $id)->get();
                            $mensaje='Listado ALMACENADO     con exito para la unidad curricular : ' . ' ' . $name->nom_uc;

                          return redirect('/alumnos/vista')->with('msj',$mensaje);
                        }
                }
            }
 
            return back()->with('error','Please Check your file, Something is wrong there.');
    }

    ///////////ACTUALIZARRRRRRRR///////////////////////

    public function archivoactualizar(Request $request)
    {
            //BORRO ANTIGUO Y INSTANCIO EL METODO ARCHIVO DE SUBIDA//
         DB::table('msec_ests')->where('id_master', $request->id_cod)->delete();
        
            controlleralumnos::archivo($request);

            $cod=$request->id_cod;
            $cod_uc=DB::table('mpuentemasters')->where('id_uc_sec', $cod)->pluck('cod_unidad');

            ///MUESTREO DE MENSAJE//

            $name=ModelUnidadCurricular::find($cod_uc[0]);
            $id = Auth::user() -> id; 
            $master = DB::table('mpuentemasters')->where('cod_seccion', '!=', 'NULL')->where('id_usu', $id)->get();
            $mensaje='Listado ACTUALIZADO con exito para la unidad curricular : ' . ' ' . $name->nom_uc;

         return redirect('/alumnos/vista')->with('msj',$mensaje);
    }

    ////////////funcion de archivo alojado en public////////////////////////

public function guardar_alumnos_manual(Request $request)
    {

        $id=$request->ci_est;
        $data=$request;
        $estu=$data->ci_new;
        $i=0;
        $seccion=$data->secccion;
        $error='false'; 
        $idbit = Auth::user() -> ci_usu;
           
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
        //dd($data,$seccion,'dasd');
       // dd($data);

        foreach ($estu as $key) {

            $alum=ModelEstudiante::where('ci_est',$key)->get();
            //dd($alum);
            $cuetnavalid=count($alum); 
            if($cuetnavalid>0){

                  $vaina=DB::table('msec_ests')->where('id_master',$seccion)->where('ci_est_tes', $key)->get();
                  $cuenta=count($vaina);
                 // dd($cuenta);

                  if($cuenta==0){

                      DB::table('msec_ests')->insert([
                      ['ci_est_tes' => $key, 'id_master' => $seccion]]);
                        
                          foreach ($alum as $estuarchivo){
                           //GUARDO EN BITACORA///
                                       $accion='agregar.alummanual'; 

                                        $bitacora= new ModelBitacora;
                                        $observacion='alumno registrado: '.$estuarchivo['nom_est'].''.$estuarchivo['nom_est']; 

                                        $bitacora->registra($idbit,$accion,$observacion,$name);

                                        //////////////////////////////// 
                                      }
                }
                else{

                }


                $i=$i+1;

            }
            else{
          
            $alum2= new ModelEstudiante;
            $alum2->ci_est=$data->ci_new[$i];  
            $alum2->nom_est=$data->nom_new[$i];
            $alum2->ape_est=$data->ape_new[$i];
            $alum2->email=$data->email_new[$i];
            $alum2->cod_pnf_est="1";
            $id=$data->ci_new[$i];

            $alum2->save();
            //GUARDO EN BITACORA///
                             $accion='subir.listado'; 

                              $bitacora= new ModelBitacora;
                              $observacion='alumno registrado: '.$alum2->nom_est.''.$alum2->ape_est.''; 

                              $bitacora->registra($idbit,$accion,$observacion,$name);

                              ////////////////////////////////    
             $vaina=DB::table('msec_ests')->where('id_master',$seccion)->where('ci_est_tes', $key)->get();
              $cuenta=count($vaina);
            //dd($cuenta);

            if($cuenta==0){
            DB::table('msec_ests')->insert([
            ['ci_est_tes' => $key, 'id_master' => $seccion]]);

           // dd($alum2);
            
            $i=$i+1;
        }
        

        }
      }
         return redirect('/alumnos/vista');

    
}
    


    public function modificar_alumnos_manual(Request $request)
    {

        //dd($request);
        $id=$request->ci_est;
        $data=$request;
        $estu=$data->ci_est;
        $i=0;

        $idbit = Auth::user() -> ci_usu;
           
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
        $seccion=$data->secccion;
        //dd($seccion);
        foreach ($estu as $key){
            $alum=ModelEstudiante::where('ci_est',$key)->get();
            //dd($alum);
            $cuetnavalid=count($alum); 
            if($cuetnavalid>0){
            //$alum->ci_est=$data->ci_est;
            $alum->nom_est=$data->nom_est[$i];
            $alum->ape_est=$data->ape_est[$i];
            $alum->email=$data->email[$i];
           // dd($alum);
             DB::table('mestudiantes')
                ->where('ci_est', $key)
                ->update(['nom_est' => $alum->nom_est, 'ape_est'=>$alum->ape_est, 'email'=>$alum->email]);
                //GUARDO EN BITACORA///
                             $accion='modificar.alummanual'; 

                              $bitacora= new ModelBitacora;
                              $observacion='alumno modificado: '.$alum->nom_est.''.$alum->ape_est; 

                              $bitacora->registra($idbit,$accion,$observacion,$name);

                              //////////////////////////////// 
            
             $vaina=DB::table('msec_ests')->where('id_master',$seccion)->where('ci_est_tes', $key)->get();
              $cuenta=count($vaina);

            if($cuenta>0){

            }
            else{
            DB::table('msec_ests')->insert([
            ['ci_est_tes' => $key, 'id_master' => $seccion]]);

                foreach ($alum as $estuarchivo){
                 //GUARDO EN BITACORA///
                             $accion='modificar.alummanual'; 

                              $bitacora= new ModelBitacora;
                              $observacion='alumno modificado: '.$estuarchivo['nom_est'].''.$estuarchivo['nom_est']; 

                              $bitacora->registra($idbit,$accion,$observacion,$name);

                              //////////////////////////////// 
                              }
            
           // dd('posi');
            
             }
             $i=$i+1;
            }
             else{
                 $alum2= new ModelEstudiante;
            $alum2->ci_est=$data->ci_est[$i];  
            $alum2->nom_est=$data->nom_est[$i];
            $alum2->ape_est=$data->ape_est[$i];
            $alum2->email=$data->email[$i];
            $alum2->cod_pnf_est="1";

           // dd($alum2);
            $alum2->save();

              $plandetectado=ModelPlandeEvaluacion::where('cod_sec_plan',$data->secccion)->first();
                $evas=ModelEvaluacion::where('id_plan_eva',$plandetectado->id_plan)->get();
                $cuentaevas=count($evas);
                if($cuentaevas>0){
                foreach ($evas as $keyx => $value) {
                  //dd($evas,$key,$value);
                  $NotasAsignadas=ModelNota::where('id_eva_not',$value->id_eva)->first();
                  $cuentaNotas=count($NotasAsignadas);
                    if($cuentaNotas>0){
                      $validNotaNew=ModelNota::where('id_eva_not',$value->id_eva)->where('ci_est_not',$alum2->ci_est)->first();
                      
                      $cuentavalidNota=count($validNotaNew);
                      if($cuentavalidNota==0){
        
                        $NuevaNota=new ModelNota;
                        $NuevaNota->id_eva_not=$value->id_eva;
                        $NuevaNota->ci_est_not=$alum2->ci_est;
                        $NuevaNota->nota=0;
                        $NuevaNota->save();
                      }
                      else{

                  }
                  //dd($NotasAsignadas,$cuentaNotas);
                }
                }
              }
                //dd($plandetectado,$evas);
         
             //GUARDO EN BITACORA///
                             $accion='modificar.alummanual'; 

                              $bitacora= new ModelBitacora;
                              $observacion='alumno modificado: '.$alum2->nom_est.''.$alum2->ape_est.''; 

                              $bitacora->registra($idbit,$accion,$observacion,$name);

                              ////////////////////////////////    
            DB::table('msec_ests')->insert([
            ['ci_est_tes' => $key, 'id_master' => $seccion]]);
        
                       
            $i=$i+1;
             }
        }
        
         return redirect('/alumnos/vista');
    }

    public function eliminar(Request $request)
    {
        $id_sec_est = $request->id_sec_est;
        
        $sec_est =  DB::table('msec_ests')->where('id_sec_est' ,$id_sec_est)->delete();    
        
        //$sec_est->destroy();
        
        $mensaje = 'El Alumno Fue Eliminado de la Seccion';
        
        return response()->json($mensaje);
    }
    public function index()
    {}
    public function create()
    {}
    public function store(Request $request)
    {}
    public function show($id)
    {}
    public function edit($id)
    {}
    public function update(Request $request, $id)
    {}
    public function destroy($id)
    {}
    public function agregar(Request $request)
    {}
}