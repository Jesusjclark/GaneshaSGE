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
use GaneshaSIGE\ModelBitacora;

use \Auth as Auth;

use Illuminate\Support\Facades\Mail; 

        // FUNCION SEGUIMIENTO

      public function SeguimientosEva(){

      $date = Carbon::now();
      $date = $date->format('d-m-Y');

          $TodasEval=ModelEvaluacion::all();
          foreach ($TodasEval as $EvaMonitor) {
            if($EvaMonitor->fec_prop > $date )
              if ($EvaMonitor->fec_res <>'00-00-00') {
              $PlanMonitor = ModelPlandeEvaluacion::find($EvaMonitor->id_plan_eva);
                $PlanMonitor->status =='FAIL';
                dd($PlanMonitor);
                $PlanMonitor->save();

              }
          }
        }


class EmailController extends Controller
{
          public function mostrarprueba(){
            $now = Carbon::now();
            $now = $now->format('l'); 
            if($now === 'Wednesday' || $now === 'Monday'){
         
                    //consulto todos los planes
                  $PlanFallo = ModelPlandeEvaluacion::where('status', 'FAIL')->pluck('usuplan'); //planes Fallos con su usu plan

                    foreach ($PlanFallo as $x) {//Variable Principal
 
                      $busqueda= User::where('id',$x)->pluck('email'); 
                      foreach ($busqueda as $b) {
                        $contenido='Saludos desde Ganesha, nos debes evaluaciones';
                        $asunto='Regañoprueba GaneshaSIGE';
                       EmailController::enviar($b); 
                        }
                                      
                    } 
                    
                 }
            
                 }
 // public function SeguimientosPlan(){
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