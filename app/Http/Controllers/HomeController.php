<?php

namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GaneshaSIGE\ModelPlandeEvaluacion;
use GaneshaSIGE\ModelUnidadCurricular;
use GaneshaSIGE\ModelInstrumento;
use GaneshaSIGE\ModelRol;
use GaneshaSIGE\ModelModulo;
use GaneshaSIGE\ModelSeccion;
use GaneshaSIGE\ModelEvaluacion;
use GaneshaSIGE\Email;
use GaneshaSIGE\User;
use GaneshaSIGE\Notifications\InvoicePaid;
use GaneshaSIGE\Notifications\NewPost;
use GaneshaSIGE\Notifications\RecuperarPass;
use GaneshaSIGE\Notifications\Plancoordinadores;
use GaneshaSIGE\ModelBitacora;

//use GaneshaSIGE\Notifications\NewPost;


use \Auth as Auth;
 
use Illuminate\Support\Facades\Mail; 
//use Illuminate\Support\Facades\Notifications; 


class HomeController extends Controller
{


      public function __construct()
    {
        $this->middleware('auth');
    }



      public function index(){
        $user= User::find(1); 
        $when = Carbon::now();
        $when = $when->format('Y-m-d');
        $progreso='FALSE';
        //dd($when);

        HomeController::SeguimientosEva();

        HomeController::mostrarprueba();
         
  
        HomeController::SeguimientosEva();



        $id=Auth::user()-> id;
        $seccion=array();
        $Panel=array();
        $Eva=array();
        $cuentaevafallas=0;

        $ids=DB::table('mpuentemasters')->where('id_usu', $id)->pluck('id_uc_sec');
        //dd($ids);
        $cuentaasig=count($ids);
        if($cuentaasig>0){

        //BUSCO PLANES DE ESTE USER
        foreach ($ids as $key => $value){
          $Planes[] = ModelPlandeEvaluacion::where('cod_sec_plan',$value)->get();
          }

          $Planes=array_flatten($Planes);
          //dd($Planes);

          //VALIDAMOS QUE EXISTAN PLANES PARA CONTINUAR

            $validar=count($Planes);
            //dd($validar);
            #SI NO EXISTEN VACIAMOS A PANEL
            if($validar == 0){
              $Panel='';
            }


            //SI EXISTEN LLENAMOS PANEL
            else{
                 $i=0;
                  foreach ($Planes as $key => $value){
                    //dd($value);
                    $dataunisec[$i]=DB::table('mpuentemasters')->where('id_uc_sec', $value->cod_sec_plan)->get();
                    $dataunisec2=array_flatten($dataunisec);
                    //dd($dataunisec2);

                    $seccion[$i]=ModelSeccion::where('cod_sec',$dataunisec2[$i]->cod_seccion)->get();

                    $unidad[$i]=ModelUnidadCurricular::where('cod_uc_pnf',$dataunisec2[$i]->cod_unidad)->get();
                   // dd($PlanFallos);
                    $i=$i+1;
                  }



                //VERIFICAMOS QUE SE HAYAN LLENADO LAS VAR
                $cuentasec=count($seccion);
                $unidad=array_flatten($unidad); //APLANAMOS EL ARRAY


                //SI SE LLENAN CONTINUAMOS
                if ($cuentasec>0){ //ABRE IF
                  $seccion=array_flatten($seccion);

                  //RECORREMOS PLANES Y LLENAMOS DATOS DE CABECERAS
                  $o=0;
                  foreach ($Planes as $key => $value){
                      $nom_uc=$unidad[$o]->nom_uc;
                      $seccionpaso=$seccion[$o]->cod_sec;
                      $turno=$seccion[$o]->turno;
                      $status=$value->status;
                      $id_plan=$value->id_plan;

                   // dd($seccionpaso,$nom_uc,$status,$turno);


                       $evacuentabuenaporce=ModelEvaluacion::where('id_plan_eva',$id_plan)->where('fec_res','!=','2000-01-01')->get();
                      // dd($when,'dasd');

                        $evasporce=ModelEvaluacion::where('id_plan_eva',$value->id_plan)->get();
                        //CUENTO EVAS PARA PORCENTAJE

                        $evacuentaporce=count($evasporce);
                        //dd($evasfallas);
                        $evacuentabuenaporce=count($evacuentabuenaporce);

    
                       // dd($evacuentabuenaporce);  
                        $porcentaje=$evacuentabuenaporce*100/$evacuentaporce;
                        //dd($porc);
                       $Panel[$o]= ['Plan' => $id_plan,'unidad'=> $nom_uc,'seccion'=>$seccionpaso,'turno'=>$turno,'status'=>$status, 'porcentaje'=>$porcentaje];
                      // dd($Panel);
                    $o=$o+1;
                  }//CIERRA IF CUENTASEC
                        //VALIDAMOS SI EL PLAN RECORRIDO ESTA FALLO
                      if($value->status=='FAIL'){

                        $evasfallas=ModelEvaluacion::where('id_plan_eva',$value->id_plan)->where('fec_prop','<',$when)->get();

                        //dd($evasfallas);
                        $cuentaevafallas=count($evasfallas);
                        //dd($cuentaevafallas);
                         if($cuentaevafallas>0){
                                $evas=ModelEvaluacion::where('id_plan_eva',$value->id_plan)->get();

                                //RECORRO EVASFALLAS

                                 foreach ($evasfallas as $key => $value) {
                                   
                                    $unidad=$value->unidad;
                                    $fecha=$value->fec_prop;
                                    $idinst=$value->id_inst_eva;
                                    $instrumento=ModelInstrumento::where('id_inst',$idinst)->pluck('tip_inst');
                                    $pond=$value->ponderacion;
                                    $contenido=$value->contenido;
                           


                                    $idpeva=$value->id_plan_eva;

                                    $Eva[]=['idpeva'=>$idpeva,'unidad'=>$unidad, 'fecha'=>$fecha, 'instrumento'=>$instrumento[0],'pond'=>$pond,'contenido'=>$contenido];
                                   // dd($Eva);
                                  }//FIN FOR EVAFALLAS

                         }
                         //FIN IF CUENTAFALLAS
                       }//fin if planes fallos

                }//CIERROFOREACH PLANES
              
            }//FIN ELSE DE ASIGNACIONES
          if($validar==0){
           
          return view('home');
        }
        else
          //dd($Panel);
          return view('home')->with(['Planes'=>$Panel, 'Eva'=>$Eva, 'porcentaje'=>$porcentaje, 'progreso'=>$progreso]);
        }
            else{
            return view('home')->with('progreso',$progreso);
            
        }
    } 
         
  


      public function SeguimientosEva(){
      $idbit = Auth::user() -> ci_usu;

      $nom=Auth::user() -> name;
      $ape=Auth::user() -> ape_usu;
      $name=$nom.' '.$ape.'';
      $accion='Seguimiento.Evaluaciones'; 
      $date = Carbon::now();
     
     // $date = $date->format('Y-m-d');
       ///$date = $date->addDays(5);
     // dd($date);
          $TodasEval=ModelEvaluacion::all();
            foreach ($TodasEval as $EvaMonitor) {

              $valid = date_create($EvaMonitor->fec_prop);
              date_add($valid, date_interval_create_from_date_string('10 days'));
                  if($valid < $date )
                    if ($EvaMonitor->fec_res == "2000-01-01") {
                            //GUARDO EN BITACORA///
                      $idsec=ModelPlandeEvaluacion::where('id_plan',$EvaMonitor->id_plan_eva)->value('cod_sec_plan');
                      $unidad=DB::table('mpuentemasters')->where('id_uc_sec', $idsec)->value('cod_unidad');
                      $seccion=DB::table('mpuentemasters')->where('id_uc_sec', $idsec)->value('cod_seccion');
                      //dd($idsec,$seccion,$unidad);
                  $bitacora= new ModelBitacora;
                  $observacion='Evaluacion Fallida para la Unidad/Sección: '.$unidad.'/'.$seccion.''; 

                  $bitacora->registra($idbit,$accion,$observacion,$name);

                  ////////////////////////////////
                      
                      $PlanMonitor = ModelPlandeEvaluacion::find($EvaMonitor->id_plan_eva);
                      $PlanMonitor->status = "FAIL";
                      $PlanMonitor -> save();
                   //dd($PlanMonitor->status);
                  }
                  if($EvaMonitor->fec_res != "2000-01-01"){
                      $PlanMonitor = ModelPlandeEvaluacion::find($EvaMonitor->id_plan_eva);
                      $PlanMonitor->status = "ASIGNADO";
                      $PlanMonitor -> save();
                   //dd($PlanMonitor->status);
                  
                  }
          }
        }


          public function mostrarprueba(){
            
            $now = Carbon::now();
            $now = $now->format('l'); 
          
            $hour= Carbon::now();
            $hour= $hour->format('h:i');
            #dd($hour,$now);
          
             // dd(date("h:i"));

            if($now === 'Tuesday' || $now === 'Monday'){
              if($hour > "01:00" && $hour < "01:50"){
                HomeController::ComienzaSegui();

        
                 }

              
              }
           
            }
            public function ComienzaSegui(){
                    $idbit = Auth::user() -> ci_usu;

                    $nom=Auth::user() -> name;
                    $ape=Auth::user() -> ape_usu;
                    $name=$nom.' '.$ape.'';
                    $accion='Seguimiento.Planes';
         
                    //consulto todos los planes
                  $PlanFallo = ModelPlandeEvaluacion::where('status', 'FAIL')->pluck('cod_sec_plan'); //planes Fallos con su usu plan
                  //dd($PlanFallo);
                    foreach ($PlanFallo as $x) {//Variable Principal
                      //id usuarios a joder//
                      $busqueda= DB::table('mpuentemasters')->where('id_uc_sec',$x)->pluck('id_usu'); 


                            //id del plan jodio//
                            $idplan = ModelPlandeEvaluacion::where('cod_sec_plan', $x)->where('status', 'FAIL')->pluck('id_plan');
                            
                            //codigo de la unidad jodida//
                            $busquedauni= DB::table('mpuentemasters')->where('id_uc_sec',$x)->where('id_usu', $busqueda)->pluck('cod_unidad');
                            $buscasec= DB::table('mpuentemasters')->where('id_uc_sec',$x)->where('id_usu', $busqueda)->pluck('cod_seccion');
                            $busquedasec=ModelSeccion::where('cod_sec',$buscasec[0])->get();
                            //nombre de la unidad//
                            $uni=ModelUnidadCurricular::where('cod_uc_pnf', $busquedauni)->pluck('nom_uc');
                            //dd($busquedasec,$buscasec);
                           // $plan= DB::table('mpuentemasters')->where('id_uc_sec',$x)->pluck('cod_unidad'); 
                        //dd($hour,$now,$busqueda);


                            //GUARDO EN BITACORA///
                      
                      $unidad=DB::table('mpuentemasters')->where('id_uc_sec', $x)->value('cod_unidad');
                      $seccion=DB::table('mpuentemasters')->where('id_uc_sec', $x)->value('cod_seccion');
                      //dd($idsec,$seccion,$unidad);
                  $bitacora= new ModelBitacora;
                  $observacion='Plan Fallido para la Unidad/Sección: '.$unidad.'/'.$seccion.''; 

                  $bitacora->registra($idbit,$accion,$observacion,$name);

                  ////////////////////////////////

                       foreach ($busqueda as $b) {
                        $id_plan = ModelPlandeEvaluacion::find($idplan);

                        //$busqueda2= User::where('id',$b)->pluck('email');
                        //dd($hour,$now);
                        $user= User::find($b);
                        $user2=$user;

                        //dd($idplan[0], $user, $busquedauni[0],$uni);
                        //dd($busquedasec);
                          try{$user->generateNotifyPlan($busquedasec,$uni,(new NewPost($user,$busquedasec[0],$uni[0])));
                          } catch (\Exception $e) {
                            dd('error');
                            
                          }
                          //dd($user2);
                        $IdcordinadorUC=DB::table('mpuentemasters')->where('coordinador', 'TRUE')->where('cod_unidad', $busquedauni[0])->pluck('id_usu');

                        //dd($IdcordinadorUC);
                        $CorreoCoordinadorUC=User::find($IdcordinadorUC[0]);

                          try{$CorreoCoordinadorUC->generateNotifyPlanCor($user2,$busquedasec,$uni,(new Plancoordinadores($CorreoCoordinadorUC,$user2,$busquedasec[0],$uni[0])));
                            
                          } catch (\Exception $e) {
                           // dd('error');
                            
                          }

                          
                        $IdCoordinadorPNF=DB::table('mrol_usus')->where('id_rol_tru', '1')->pluck('id_tru');
                        $CorreoCordinadorPNF=User::find($IdCoordinadorPNF[0]);
                             try{$CorreoCordinadorPNF->generateNotifyPlanCor($user2,$busquedasec,$uni,(new Plancoordinadores($CorreoCordinadorPNF,$user2,$busquedasec[0],$uni[0])));
                            
                          } catch (\Exception $e) {
                           // dd('error');
                            
                          }

                        
                         
                      }          
                    } 
                   // }
            }

            
                 
 /*   try{$user->generateNotifyPass((new RecuperarPass($user)));
                          
                        } catch (\Exception $e) {
                         // dd('error');
                          
                        }

                 public function SeguimientosPlan(){
 //            $now = Carbon::now();
 //            $now = $now->format('l'); 
     
 //            $count=0; //SI ES LUNES HAS EL BETA

 //            if($now === 'Sunday' || $now === 'Monday'){
         
 //                    //consulto todos los planes
 //                  $PlanFallo = ModelPlandeEvaluacion::where('status', 'FAIL')->pluck('usuplan');
                    
 //                  //si estan fallos entra en condicion  
 //                    foreach ($PlanFallo as $PlanFallox) {
 //                    $busca=$PlanFallox[$count];

 //                    $busqeda = User::where('id',$busca)->get(['email']);
 //                    dd($busqueda);
 //                    //$destinatario=($busqeda['email']);

 //                    $contenido='Saludos desde Ganesha, nos debes evaluaciones';
 //                    $asunto='Regañoprueba GaneshaSIGE';
                    
 //                    EmailController::enviar($destinatario); 
 //                    }
 //                $count=$count+1;
                   


                   /* $busqueda3= DB::table('mpuentemasters')->where('id_uc_sec',$x)->pluck('cod_unidad'); 
 foreach ($busqueda3 as $key){
                         $unidad=ModelUnidadCurricular::where('cod_uc_pnf', $key)->pluck('nom_uc');
                         $nomuni = $unidad[0];*/
 //                 }



                         
            
 //                 }
            


     public function enviar($destinatario)
    {
    
            $asunto="Plan de Evaluacion Pendiente";
            $contenido=("
                Ganesha le informa:::

                Tiene planes de evaluacion pendientes </br>
                debe asogmarles las calificaciones correspondientes");

         
           
           $data = array('contenido' => $contenido);
             $r= Mail::send('correo.plantilla_correo', $data, function ($message) use ($asunto, $destinatario) {
                $message->from('ganeshadevteam@gmail.com', 'GaneshaDevteam');
                $message->to($destinatario)->subject($asunto);

            });
                

                    
    }                    
    
        // //

        //return Mailer::enviar($destinatario, $asunto, $mensaje);
    


}









 




