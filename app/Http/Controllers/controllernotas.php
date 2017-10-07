<?php

namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use GaneshaSIGE\ModelNota;
use GaneshaSIGE\ModelPlandeEvaluacion;
use GaneshaSIGE\ModelUnidadCurricular;
use GaneshaSIGE\ModelSeccion;
use GaneshaSIGE\ModelEstudiante;
use GaneshaSIGE\ModelEvaluacion;
use GaneshaSIGE\ModelInstrumento;
use GaneshaSIGE\User;
use GaneshaSIGE\ModelBitacora;
use \Auth as Auth;
use Illuminate\Support\Facades\DB;
use GaneshaSIGE\Notifications\EmailNota;
use Illuminate\Support\Facades\Mail; 
use Excel;


//Para Eviar mensajes sin de otra forma se agrega esta class en el controllers
//y en el config/app tanto en providers como en aliases
//se agregara la misma

use Laracasts\Flash\Flash;

class controllernotas extends Controller
{
    public function mostrar()
    {
        $id = Auth::user() -> id; 

        $puente=DB::table('mpuentemasters')->where('id_usu', $id)->where('cod_seccion', '<>', 'NULL')->get();
        
        $uc=ModelUnidadCurricular::all();
        $evas=ModelEvaluacion::all();
        $secc=ModelSeccion::all();
        $plan=ModelPlandeEvaluacion::where('status','!=','MASTER')->get();
        $instrument=ModelInstrumento::all();
        
        //$evas=ModelEvaluacion::
        //dd($var, $uc, $puente);
        return view('Notas/G_notas')->with(['puente' => $puente, 'uc'=> $uc, 'planes' => $plan, 'evas' => $evas, 'instrument' => $instrument, 'secc' => $secc]);
    }
    ////////////////////////////////////////////////////////////7
     public function transcripcionesMostrar()
    {

        $id = Auth::user() -> id; 

        $puente=DB::table('mpuentemasters')->where('id_usu', $id)->where('cod_seccion', '<>', 'NULL')->get();
        
        $uc=ModelUnidadCurricular::all();
        $evas=ModelEvaluacion::all();
        $notas=ModelNota::all();
        $secc=ModelSeccion::all();
        $plan=ModelPlandeEvaluacion::where('status','!=','MASTER')->get();
        $instrument=ModelInstrumento::all();
        return view('Notas/Transcripcion')->with(['puente' => $puente, 'nota'=>$notas,'uc'=> $uc, 'planes' => $plan, 'evas' => $evas, 'instrument' => $instrument, 'secc' => $secc]);
    }
    //////////////////////////////////////////////////////////////
    public function Mostrarmodificarnotas($id_eva, $id_uc_sec){

        $estudiantes=ModelEstudiante::all();
        $estu_sec=DB::table('msec_ests')->where('id_master', $id_uc_sec)->pluck('ci_est_tes');
        $notas=ModelNota::where('id_eva_not', $id_eva)->get();
        //dd($notas); 
        $cuenta=count($notas);
        $evaasignar=ModelEvaluacion::Where('id_eva', $id_eva)->pluck('ponderacion');
        if($cuenta==0){
        
        Flash::warning('No tiene Notas a Editar!');

        return redirect('Notas/G_notas');
        }
        else{

        return view('Notas/ModificarNotas')->with(['estudiantes'=>$estudiantes, 'listaestu'=>$estu_sec, 'id_eva'=>$id_eva, 'notasalum'=>$notas, 'evaasignar'=>$evaasignar[0]]);
        }
    }
    //////////////////////////////////////////////////////////////////
    public function asignarnotas($id_eva, $id_uc_sec)
    {
        
        $estudiantes=ModelEstudiante::all();
        $estu_sec=DB::table('msec_ests')->where('id_master', $id_uc_sec)->pluck('ci_est_tes');
        $notas=ModelNota::where('id_eva_not', $id_eva)->get();
        $evaasignar=ModelEvaluacion::Where('id_eva', $id_eva)->pluck('ponderacion');
        return view('Notas/asignacionnota')->with(['estudiantes'=>$estudiantes, 'listaestu'=>$estu_sec, 'id_eva'=>$id_eva, 'notasalum'=>$notas, 'evaasignar'=>$evaasignar[0]]);
    }
    /////////////////////////////////////////////////////////77
    public function enviarcorreo(Request $request,$id_eva, $id_uc_sec)
    {
        $idbit = Auth::user() -> ci_usu;
           
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='publicar.notas'; 
            
        //estudiantes que estan en la unidad/seccion
        $estu_sec2=DB::table('msec_ests')->where('id_master', $id_uc_sec)->pluck('ci_est_tes');
            //dd($estu_sec2, $id_uc_sec);

        //cod de la unidad a enviar correo
        $uc=DB::table('mpuentemasters')->where('id_uc_sec', $id_uc_sec)->pluck('cod_unidad');
        //nombre de la unidad curricular
        $ucname=ModelUnidadCurricular::where('cod_uc_pnf',$uc[0])->pluck('nom_uc');
        //dd($ucname);

        //id del plan de evaluacion
         $idplan=ModelEvaluacion::where('id_eva',$id_eva)->pluck('id_plan_eva');
        //dd($id_eva,$idplan[0]);
         $buscasec=DB::table('mpuentemasters')->where('id_uc_sec', $id_uc_sec)->pluck('cod_seccion');
        $busquedasec=ModelSeccion::where('cod_sec',$buscasec[0])->get();
         //todas las evaluaciones de ese plan
        $todaseva=ModelEvaluacion::where('id_plan_eva',$idplan[0])->where('fec_res','<>','2000-01-01')->pluck('id_eva');

        $i=0;
        $vaina=array();
        $error='false';
        $cuentatodaseva=count($todaseva);
        if($cuentatodaseva > 0){
        foreach ($estu_sec2 as $correo){

            //estudiante a enviar
            $estudiantecorreo=ModelEstudiante::find($correo);

            //nota estudiante
            $Nota=ModelNota::where('id_eva_not',$request->id_eva)->where('ci_est_not',$correo)->pluck('nota');
            //dd($request->id_eva,$id_eva);

            foreach ($todaseva as $todasevass => $evacheck) {
                //BUSQUEDA DE TIPO DE EVALUACION//
            $evas=ModelEvaluacion::find($evacheck)->pluck('id_inst_eva');
            $pond[$i]=ModelEvaluacion::where('id_eva',$evacheck)->pluck('ponderacion');
            //dd($eva[0]);
            $tipoevas[$i]=ModelInstrumento::where('id_inst',$evas[$i])->pluck('tip_inst');
            $Notas[$i]=ModelNota::where('id_eva_not',$evacheck)->where('ci_est_not',$correo)->pluck('nota');
            
            $i=$i+1;
            }

            $i=0;
            $cuentanota=count($Notas);

            if($cuentanota != 0){
        
            $Notas=array_flatten($Notas);
            $tipoevas=array_flatten($tipoevas);
            $Pond=array_flatten($pond);
            //dd($cuentanota);
            
            $eva=ModelEvaluacion::find($id_eva)->pluck('id_inst_eva');
            //dd($eva[0]);

            $tipoeva=ModelInstrumento::where('id_inst',$eva[0])->pluck('tip_inst');
           // dd($tipoeva,$Notas,$tipoevas,$Pond, $evacheck,$todaseva);

            try{$estudiantecorreo->generateNotifyNota($tipoevas,$ucname,$Notas,$Pond,$busquedasec,(new EmailNota($estudiantecorreo, $tipoevas,$ucname, $Notas,$Pond,$busquedasec)));
                 } catch (\Exception $e) {
                            $error='true';
                            
                          }
            //dd($error);
       
         }

            else{
                Flash::error('<b>¡Oops! No se ha podido enviar el correo, <br> ¡Aun <u>NO</u> has asignado Notas que publicar!</b> ');
                return redirect('Notas/G_notas');

            }
             
            
        }

        if($error=='true'){
                Flash::error('<h3><b>¡Ha ocurrido un ERROR al Enviar, por favor revisa tu conexión a internet!</b></h3>');
                return redirect('Notas/G_notas');
                }
                if($error=='false'){
                 
                Flash::success('<h4><b>¡Correos Enviados exitosamente!</b></h4>');
                return redirect('Notas/G_notas');
                }
         
            ///GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='Se ha intenado Publicar Notas para la unidad: '.$ucname.' seccion'.$buscasec[0].''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
       }
       else{
        Flash::warning('<h4><b>¡Aun no ha asignado notas!</b></h4>');
                return redirect('Notas/G_notas');
            //$i=$i+1;
       }
    }
    ///////////////////////////////////////////////////////////////////////
    public function modificarnotas(Request $request){
       $estudiantes=$request->ci;
       $notas=$request->nota;
       $id_eva=$request->id_eva;
       $i=0;
       $var=0;
       $o=0;
       $idbit = Auth::user() -> ci_usu;
           
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='modificar.notas'; 
            
       //dd($request);
        foreach ($estudiantes as $key => $value) {

            $notavar=$notas[$i];

            $EstudianteAsig=ModelNota::where('ci_est_not',$value)->where('id_eva_not',$id_eva)->get();

             DB::table('mnotas')->where('ci_est_not', $value)->where('id_eva_not',$id_eva)->update(['nota'=>$notavar]);

            $i=$i+1;
            ///GUARDO EN BITACORA///
            $nomestu=ModelEstudiante::where('ci_est',$value)->value('nom_est');
            $apeestu=ModelEstudiante::where('ci_est',$value)->value('ape_est');
            $estudiantemodif=$nomestu.' '.$apeestu.'';
            $bitacora= new ModelBitacora;
            $observacion='Se han modificado las notas para: '.$estudiantemodif.''; 

            $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////

            
        }
        
        $evachange=ModelEvaluacion::find($id_eva);
            $evachange->corte='ASIGNADA';
           // $evachange->fec_res=$date;
            $evachange->save();
     
            Flash::success('Notas Actualizadas!');
            return redirect('Notas/G_notas');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    public function AprobadosReprobados(){
        $id = Auth::user() -> id; 
        $puente=DB::table('mpuentemasters')->where('id_usu', $id)->where('cod_seccion', '<>', 'NULL')->get();
        $uc=ModelUnidadCurricular::all();
        $secc=ModelSeccion::all();
        return view('Notas/AprobadosReprobados')->with(['puente' => $puente, 'uc'=> $uc, 'secc' => $secc]);
    }
      ////////////////////////////////////////////////////////////////////////////////////////////////////
    function unique_multidim_array($array, $key) 
    { 
        $temp_array = array(); 
        $i = 0; 
        $key_array = array(); 
    
        foreach($array as $val) { 
            if (!in_array($val[$key], $key_array)) { 
                $key_array[$i] = $val[$key]; 
                $temp_array[$i] = $val; 
            } 
            $i++; 
        } 
     return $temp_array; 
    } 


    ///////////////***********************************************//////////////////////////////////////////
    public function verificarAprovadosReprobado($id_uc_sec)
    {   
        #Cedula de los alumnos de la seccion ingresada
        $alum=DB::table('msec_ests')->where('id_master', $id_uc_sec)->pluck('ci_est_tes');
        $lista_estu= ModelEstudiante::all();
        
        $nota2='';
        #Plan de la seccion
        $plan=ModelPlandeEvaluacion::where('cod_sec_plan', $id_uc_sec)->value('id_plan');
        
        #Si tengo planes para la seccion Entro
        if(count($plan) != 0 && count($alum) != 0){

            #Evaluaciones para el Plan de Evaluacion que ya tienen notas. 
            #Por ello el Where de la busqueda
            $evas=ModelEvaluacion::where('id_plan_eva',$plan)->where('fec_res', '<>', '2000-01-01')->pluck('id_eva');
        
            #$i = 0;
            #$x=0;

            #Si no tengo Evaluaciones con notas pasadas entro
            if (count($evas) > 0) {
                
                #Recorro cada evaluacion con Notas asignadas
                foreach ($evas as $value2) {

                    $pondera[]=ModelEvaluacion::where('id_eva',$value2)->value('ponderacion');
                    $comienza=0;
                    foreach ($alum as $value) {
                        #Notas de los estudiantes por posicion
                        $notas_estu=ModelNota::where('ci_est_not', $value)->where('id_eva_not',$value2)->first();
                        $cuentaNotas=count($notas_estu);
                        //dd($cuentaNotas,$notas_estu);
                        if($cuentaNotas > 0){
                            $Notvar[]=['ci_est_not'=>$value,'acum'=>$notas_estu->nota+$comienza,'idplan'=>$plan];
                        }
                        else{
                            $Notvar[]=['ci_est_not'=>$value,'acum'=>0+$comienza,'idplan'=>$plan];
                        }                #Notas por estudiante con su ci como cabezera
                        #$notas[]=ModelNota::where('id_eva_not',$value2)->where('ci_est_not', $value)->pluck('nota','ci_est_not');
                        #$i=$i+1;
                        $ponderas[]=ModelEvaluacion::where('id_eva',$value2)->value('ponderacion');

                        #$x=$x+1;
                    }

                }
                #dd($notas,$value2,$value);

                $cuentaeva=count($evas);
                #$notas_arry=array_flatten($notas);
                //dd($notas_id);
               // $beta[]=['ci_est_not'=>,'acum'=> 0]
                $x=0;  

                foreach ($alum as $keyx) {


                    $beta[]=['ci_est_not'=>$keyx,'acum'=> 0];
                    foreach ($Notvar as $key => $valuez) {
                    

                     //   dd($Notvar[$x]['ci_est_not']);
                        if($valuez['ci_est_not']==$keyx){
                        $beta[$x]['acum']=$beta[$x]['acum']+$valuez['acum'];
                        }


                    }
                    $x=$x+1;

                }
                        #dd($lista_estu);

                //dd($beta);
                      //  dd($pondera);
                $pondera=array_sum($pondera);
                    //dd($notas,$notas_estu,$notas_arry,$notas,$alum,$pondera);

                

                $aprobados=0;
                $reprobados=0;
                $f=0;

                #Ponderacion por evaluacion
                
                //dd($notas_estu,$notas_arry,$notas,$alum,$ced,$notas_arry2,$notas_arry3,$pondera);
        

                $h = 0;
               // dd($ponderax);
            
                    //dd($ponderax);  
                $arrypon = $pondera*0.60;
                $arryPER=$pondera*0.30;

                $aprobados = 0;
                $reprobados = 0;
                $per=0;

                foreach ($beta as $nota) {
                  //  dd($nota,$arrypon);
                    if ($nota['acum'] > $arrypon){
                        $aprobados +=1;
                    }
                    if($nota['acum']>=$arryPER && $nota['acum'] < $arrypon){
                        $per+=1;                                                

                    }
                    if($nota['acum'] < $arryPER){
                        $reprobados +=1;
                    }
                    // dd($arryPER,$pondera);               # code...
                    $h =$h+1;
                }

                //dd($per);
                $details = controllernotas::unique_multidim_array($beta,'ci_est_not'); 

                //dd($reprobados,$aprobados);
                $CantidadMinSec=2;//cantidad recibida en form
                //posibles secciones derepitientes segun escala
                $PosiblesSeccionesRepitientes=$reprobados/$CantidadMinSec;
                //posibles secciones que avanzan segun escala
                $SeccionQueAvanza=$aprobados/$CantidadMinSec;

                #$details=array_flatten($details); 
                
                $evastotal=ModelEvaluacion::where('id_plan_eva',$plan)->pluck('id_eva');
                //$evastotal=array_flatten($evastotal);
                
                $evano=0;
                foreach ($evastotal as $key => $value) {
                    $evano=$evano+1;
                }

                $evarealizadas=count($evas);
                //dd($evano,$evarealizadas);
                if($evarealizadas<$evano){
                    Flash::error('<h3><b>¡Aun no has asignado notas a todas las evaluaciones Pautadas!, Estas estadísticas están en base a la ponderación de las notas ya asignadas<br> Ponderación: '.$pondera.'</b></h3>');
                }
                if($evarealizadas==$evano){
                    Flash::success('<h3><b>Estas estadísticas están en base a la ponderación de las notas ya asignadas: '.$pondera.'</b></h3>');
                }
                //dd('Las secciones repitientes son:'.$PosiblesSeccionesRepitientes.'','Las secciones que avanzan son:'.$SeccionQueAvanza.'', 'segun la escala de min de alumnos por cada seccion',-$CantidadMinSec,'los aprobados son: '.$aprobados.'  los reprobados son: '.$reprobados.'   y los detalles son',$beta);
                #dd($lista_estu);
                return view('Notas/AprobadosReprobados')->with(['reprobados' => $reprobados, 'aprobados' => $aprobados, 'listado' => 'listado','estudiantes'=>$details,'ponderacion'=>$arrypon ,'PER'=>$arryPER,'PERcount'=>$per, 'lista_estu' => $lista_estu]);
            }
            else{
                Flash::warning('No Tiene Notas Asignadas Para Esta Unidad');
                return redirect('/Notas/Estadisticas');
            }
        }
        else{
            Flash::warning('No Tiene Planes o Alumnos asignados para esta Seccion');
            return redirect('/Notas/Estadisticas');
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////    /

    public function Transcripcion(Request $request)
    {
        $idbit = Auth::user() -> ci_usu;
       
        $nom=Auth::user() -> name;
        $ape=Auth::user() -> ape_usu;
        $name=$nom.' '.$ape.'';
        $accion='transcribir.notas'; 
        /////////LISTA DE EVALUACIONES////////
        $evas=$request-> checkid;
        $var2='';
        $o=0;

        $cuenta=count($evas);
        if($cuenta>0){
            foreach ($evas as $key){
               $var2=ModelNota::where('id_eva_not',$key)->where('nota','<>',null)->get();
               $var[]= $var2;
                DB::table('mevaluacions')->where('id_eva', $key)->update(['corte'=>'TRANSCRITA']);


                $o=+1;
            }

        ///////////////////////////////////////////////
            $estudiantesseccion=DB::table('msec_ests')->where('id_master',$request->unidadsec)->pluck('ci_est_tes');

        if (count($estudiantesseccion)>0) {
            
        ////ARREGLO ESTUDIANTES///////////////////////
            foreach ($estudiantesseccion as $estudiante => $value) {
              
               $Exporta[]=ModelEstudiante::where('ci_est', $value)->get();
               //$nombre=ModelEstudiante::where('ci_est', $value)->pluck('nom_est');
                //busco apellido del estudiante
                //$apellido=ModelEstudiante::where('ci_est', $value)->pluck('ape_est');
            //            $Exporta= ['ci_est' => $value,'nom_est'=>$nombre[0],'ape_est'=>$apellido[0]];
            //7          $Exportados[] =$Exporta;
            }
            $vart=array_flatten($var);
            //dd($vart[0]->ci_est_not);  
            //////////////////////////////////////////////
            $Expor=array_flatten($Exporta);

            $a = count($Expor);
            $e = count($vart);
            $a = $e / $a ;
             ///GUARDO EN BITACORA///
            foreach ($evas as $key2 => $value) {
               $idplanbit=ModelEvaluacion::where('id_eva',$value)->value('id_plan_eva');
               $codsecplanbit=ModelPlandeEvaluacion::where('id_plan',$idplanbit)->value('cod_sec_plan');
               $codsecbit=DB::table('mpuentemasters')->where('id_uc_sec',$codsecplanbit)->value('cod_seccion');
               $codunidadbit=DB::table('mpuentemasters')->where('id_uc_sec',$codsecplanbit)->value('cod_unidad');
            }
            $bitacora= new ModelBitacora;
            $observacion='Se ha intentado transcribir las notas para La Unidad/Seccion;  '.$codunidadbit.'/'.$codsecbit.''; 
            $bitacora->registra($idbit,$accion,$observacion,$name);

              ////////////////////////////////
            return view('Notas/trans')->with(['estudiantes'=>$Expor, 'notas'=>$vart, 'a'=> $a]);
            }
            else{
                 Flash::warning('<h4><b>No tiene estudiantes para esta Seccion </b><h4>');
            return back();
            }
        }
        else{
             Flash::warning('<h4><b>No ha seleccionado ninguna evaluacion   </b><h4>');
            return back();
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    public function VerificaNota($id_eva, $id_uc_sec){
        $estudiantes=ModelEstudiante::all();
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $notas=ModelNota::where('id_eva_not', $id_eva)->get();
        //dd($notas); 
        $cuenta=count($notas);
        $evaasignar=ModelEvaluacion::Where('id_eva', $id_eva)->pluck('ponderacion');
           $evaasignarvalid=ModelEvaluacion::Where('id_eva', $id_eva)->get();
        $estu_sec=DB::table('msec_ests')->where('id_master', $id_uc_sec)->pluck('ci_est_tes');
        if($evaasignarvalid[0]->fec_prop >$date){
              Flash::error('<h2><b>Aun no puedes asignar notas para esta evaluación!</h2></b>');
            return redirect('Notas/G_notas');
            }
            else{

        

        if($cuenta==0){
            

        
            //vista asignar

            //dd($evaasignar[0],$estudiantes);
            //dd('asignar');
            

            return view('Notas/asignacionnota')->with(['estudiantes'=>$estudiantes, 'listaestu'=>$estu_sec, 'id_eva'=>$id_eva, 'notasalum'=>$notas, 'evaasignar'=>$evaasignar[0]],$notas);
        }
        else{
            //dd('modificar',$estu_sec,$evaasignar[0]);

            //vista Modificar
        
        Flash::warning('¡Ya has asignado calificaciones para esta evaluación!, Ahora estás en <b>MODO EDICIÓN</b>');
        return view('Notas/ModificarNotas')->with(['estudiantes'=>$estudiantes, 'listaestu'=>$estu_sec, 'id_eva'=>$id_eva, 'notasalum'=>$notas, 'evaasignar'=>$evaasignar[0]]);
        
        }


        }      
        
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////
    public function Transcripcion2(Request $request)
    {
        // dd($request)
        $evas=$request-> checkid;
      
       // $Exporta= array('CI','nombre','apellido','tipo de eva','nota');
        $estudiantesseccion=DB::table('msec_ests')->where('id_master',$request->unidadsec)->pluck('ci_est_tes');

        //dd($estudiantesseccion);
        $o=0;
         foreach ($evas as $key){
            $var[$o]=DB::table('mnotas')->where('id_eva_not',$key)->get();
        $o=+1;
        }
       

        $i=0;
        foreach ($estudiantesseccion as $estudiante => $value) {

            $nombre=ModelEstudiante::where('ci_est', $value)->pluck('nom_est');
            //busco apellido del estudiante
            $apellido=ModelEstudiante::where('ci_est', $value)->pluck('ape_est');
            $Exportados[]= ['CI' => $value,'nombre'=>$nombre[0],'apellido'=>$apellido[0]];

          
        }
        $u=0;
          foreach ($var as $key2){
            foreach ($key2 as $key3 => $value2) {
              //  dd($value2->ci_est_not);
                if($value = $value2->ci_est_not){
                    
                $idtipoeva=ModelEvaluacion::find($value2->id_eva_not)->pluck('id_inst_eva');
                //busco nombre del tipo de eva
                $nombreeva=ModelInstrumento::where('id_inst',$idtipoeva[0])->pluck('tip_inst');
              
                $Evaluar[$u] = ['eva'=>$value2->id_eva_not,'tipo de eva'=>$nombreeva[0], 'nota'=>$value2->nota];

                $Exportados[$i]=array_add($Exportados[$i],'eva'.$u.'',$value2->id_eva_not);

                $Exportados[$i]=array_add($Exportados[$i],'nota'.$u.'',$value2->nota);
                 }
                 //'tipo de eva'= $nombreeva[0], 'nota'= $value->nota);
                $u=+1;

                $i=+1;
            
            }
            }
            //$data=array_collapse([$Exportados,$Evaluar]);

            dd($Exportados,$Evaluar);

        //dd($Exportados);
    
       //dd($datos,$Exportados,$Evaluar);
    
        //recorro las evaluaciones

        
     

        Excel::create('Transcripcion', function($excel) use($Exportados) {
    
      

            $excel->sheet('ModelNota', function($sheet) use($Exportados) {

                $products = ModelNota::all();

                $sheet->fromArray($Exportados);

            });
        })->export('xml');

    }

    //////////////////////////////////////////////////////////////////////////////////////////////////
    public function GuardarNotas(Request $request)
    {   
        $idbit = Auth::user() -> ci_usu;
           
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='asginar.notas'; 
         $date = Carbon::now();
         $date = $date->format('Y-m-d');
            $evavalid=ModelEvaluacion::where('id_eva',$request->id_eva)->get();
           //dd($evavalid[0]->fec_prop,$date);
            
                    //dd($evavalid[0]->ponderacion);

                $i=0;
             $notas=$request->nota;
                // dd($notas);
                foreach ($notas as $not){
                $nuevanota= new ModelNota;

                $validation= ModelNota::where('id_eva_not', $request->id_eva)->where('ci_est_not',$request->ci[$i])->get();
             $cuenta=count($validation);
            // $not=-50;
                if($cuenta==0){
                if($not > $evavalid[0]->ponderacion){
                    $not=$evavalid[0]->ponderacion;
                }   
                else{
                    $not=$not;  
                } 

                if($not <1 ){
                    $not=1;
                }   
                else{
                    $not=$not;  
                 }   

                    $nuevanota->id_eva_not=$request->id_eva;
                    $nuevanota->ci_est_not=$request->ci[$i];
                    $nuevanota->nota=$not;
                    $nuevanota->save();
                    ///GUARDO EN BITACORA///
            $nomestu=ModelEstudiante::where('ci_est',$request->ci[$i])->value('nom_est');
            $apeestu=ModelEstudiante::where('ci_est',$request->ci[$i])->value('ape_est');
            $estudiantemodif=$nomestu.' '.$apeestu.'';
          $bitacora= new ModelBitacora;
          $observacion='Se han asignado las notas para: '.$estudiantemodif.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
   
                    }
                    $i=$i+1;
                }
            $evachange=ModelEvaluacion::find($request->id_eva);
            $evachange->corte='ASIGNADA';
            $evachange->fec_res=$date;
            $evachange->save();

            //esta es la forma de enviar los mensajes

            Flash::success('Notas registradas!');
            
            return redirect('Notas/G_notas');
        
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    public function Corte(Request $request)
    {   
        dd($request);  
        $eva=ModelEvaluacion::find($request->id_eva);
        
        $eva->corte='SIN ASIGNAR';

        $eva->save();
        Flash::success('¡Archivo Generado!');

        return redirect('/Notas/Transcripcion');
        
    } 

    
    ////////////CONSULTA DE NOTAS ALUMNOS7777777777777777777777777777777777777//////////////////

    public function consultanotaestu($id_master, $ci_est){
        $plan=ModelPlandeEvaluacion::where('cod_sec_plan', $id_master)->pluck('id_plan');
        $i=0;
        $tipoinst= 0;
        if (count($plan)>0) {
        
            $evas = ModelEvaluacion::where('id_plan_eva', $plan)->get(); 

            foreach ($evas as $eva) {
                $notas[] = ModelNota::where('id_eva_not', $eva->id_eva)->where('ci_est_not', $ci_est)->value('nota');
                if($notas != null){
                    $ponderaciones[] = $eva->ponderacion;
                    $tipoinst = ModelInstrumento::where('id_inst', $eva->id_inst_eva)->value('tip_inst');
                    $contenido[] = $eva->contenido;
                    $struct[]=['nota'=>$notas[$i],'ponderacion'=>$ponderaciones[$i], 'tipoinst'=>$tipoinst,'contenido'=>$contenido[$i]];
                }else{
                    //AQUI MANO
                }
                    $i=$i+1;
            
            }
      #dd($notas);
            //$struct=array_flatten($struct);
           // $notas = array_flatten($notas);
            $totalnotas = count($notas);
            #$tipoinst = array_flatten($tipoinst);
            if ($totalnotas>0 && count($tipoinst)>0) {
               # dd($notas,$totalnotas,$ponderaciones,$tipoinst,$contenido);                
                return response()->json($struct);
            }
            else{
            Flash::error('Usted No se Encuentra Registrado en el Sistema <br>Por favor comuniquese con Alguno de sus Docentes');

                $mensaje ='No Han subido notas para esta seccion/Unidad';
                return response()->json($mensaje);
            }
        }
        else{
            $mensaje ='No tienes planes para esta seccion';
            return response()->json([$mensaje]);
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////
    public function consultamasterestu(Request $request){
        $ci_est = $request->ci_usu;
        //Secciones del estudiante
        $estu_sec=DB::table('msec_ests')->where('ci_est_tes', $ci_est)->get();
        $estudiante = ModelEstudiante::where('ci_est', $ci_est)->get();
        $uni_crr = ModelUnidadCurricular::all();

        if (count($estu_sec) > 0){
            foreach ($estu_sec as $est_sec) {
                $puente[] = DB::table('mpuentemasters')->where('id_uc_sec', $est_sec->id_master)->get();
            }
                $puente = array_flatten($puente);
            #dd($estu_sec,$uni_crr,$puente,$estudiante);
            return view('Alumnos/ConsultaNotasAlumnos')->with(['estu_sec' => $estu_sec, 'uni_crr' => $uni_crr, 'puente' => $puente, 'estudiante' => $estudiante, 'ci_est' => $ci_est]);
        }
        else{
            Flash::error('Usted No se Encuentra Registrado en el Sistema <br>Por favor comuniquese con Alguno de sus Docentes');

            return redirect('/');
        }
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
}
