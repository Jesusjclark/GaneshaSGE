<?php
/*
*@author: Jesusjclark, Enyer Freitez. @GaneshaDevTeam
*
*/
namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use GaneshaSIGE\ModelPlandeEvaluacion;
use GaneshaSIGE\ModelUnidadCurricular;
use GaneshaSIGE\ModelInstrumento;
use GaneshaSIGE\ModelRol;
use GaneshaSIGE\ModelModulo;
use GaneshaSIGE\ModelSeccion;
use GaneshaSIGE\ModelEvaluacion;
use GaneshaSIGE\ModelBitacora;
use GaneshaSIGE\User;
use Illuminate\Support\Collection as Collection;
use \Auth as Auth;
use Laracasts\Flash\Flash;
use GaneshaSIGE\Notifications\ModifPlanCoor;
use Carbon\Carbon;



class ControllerPlanEvaluaciones extends Controller
{


  //PLANES MAESTROS
    
    public function MostrarMaestro()
    {  
      $sec = ModelSeccion::where('cod_sec','<>','NULL')->get();
      $seccuenta=count($sec);
    
      $id = Auth::user() -> id; 
      $usuarios = User::where('id', $id)->get(); 
      //$planeva = ModelPlandeEvaluacion::all();
      $uni_crr = ModelUnidadCurricular::all();
      $master = DB::table('mpuentemasters')->where('id_usu', $id)->where('cod_seccion', 'NULL')->get();
      $instrumentos = ModelInstrumento::all();
      //$eva= ModelEvaluacion::all();
      //$status= DB::table('mplan_evas')->get(['status']);
      return view('Plan_Evaluaciones/Gestion_master')->with(['uni_crr' => $uni_crr, 'usuarios' => $usuarios, 'seccuenta'=>$seccuenta,'master' => $master, 'instrumentos' => $instrumentos]);
    }

    public function imprimirmaster($cod_unidad)
    {  
    
      $id = Auth::user() -> id; 
      $idbit = Auth::user() -> ci_usu;
   
      $nom=Auth::user() -> name;
      $ape=Auth::user() -> ape_usu;
      $name=$nom.' '.$ape.'';
      $accion='imprimir.planmaster';
      //busco la informacion de el registro de esa unidad curricular en la puente y mostrarla para luego verificar si se tiene o no planes
      $busqueda=DB::table('mpuentemasters')->where('cod_unidad', $cod_unidad)->where('coordinador', 'TRUE')->where('id_usu', $id)->pluck('id_uc_sec');
      $planeva = ModelPlandeEvaluacion::where('cod_sec_plan', $busqueda[0])->get();

      /////////////////Para Modificarlo\\\\\\\\\\\\\\\\\\\\''
      //todas las Evaluaciones para ese plan
      $evaluaciones = '';

      $planeva2 = ModelPlandeEvaluacion::where('cod_sec_plan', $busqueda[0])->pluck('id_plan');

      if(count($planeva2) > 0){
        $evaluaciones= ModelEvaluacion::where('id_plan_eva', $planeva2[0])->get();
      } 
      //Creo variable que me lleva el contro para saber que hacer con ellas
      $editar='false';

      // si me trae alguna informacion la tabla de plan (si tienes planes la unidad)
      $algo=(count($planeva));


       //si tiene planes cambio el valor del condicional
      if($algo > 0 ){ 
        
        $id_master=DB::table('mpuentemasters')->where('cod_unidad', $cod_unidad)->where('cod_seccion','!=','NULL')->pluck('id_uc_sec');

        foreach ($id_master as $id_mas) {
          $planeshijos = ModelPlandeEvaluacion::where('cod_sec_plan', $id_mas)->pluck('status');    
        }
        
        if(count($planeshijos) == 0){
          $editar='MASTER';    
        }
        else{
          $editar='ASIGNADO';
        }

      }
      ///////////////Informacion para crear plan\\\\\\\\\\\\\\\\\\
      $uni_crr = ModelUnidadCurricular::where('cod_uc_pnf', $cod_unidad)->get();
      $usuario = User::where('id', $id)->get();
      $master = DB::table('mpuentemasters')->where('cod_unidad', $cod_unidad)->where('coordinador', 'TRUE')->where('id_usu', $id)->get();
      $instrumentos = ModelInstrumento::all();

       //GUARDO EN BITACORA///
      $bitacora= new ModelBitacora;
      $observacion='Impresion Generada para el plan de la unidad: '.$cod_unidad.''; 
      $bitacora->registra($idbit,$accion,$observacion,$name);


      return view('Plan_Evaluaciones/imprimirPlan')->with(['editar' => $editar, 'instrumentos' => $instrumentos, 'master' => $master, 'usuario' => $usuario, 'uni_crr' => $uni_crr, 'planeva' => $planeva, 'evaluaciones' => $evaluaciones, 'cod_unidad' => $cod_unidad, 'planeva2' => $planeva2]);
    }




    public function Asignar($id_plan)
    {
      $id = Auth::user() -> id;
      $idbit = Auth::user() -> ci_usu;
  
      $nom=Auth::user() -> name;
      $ape=Auth::user() -> ape_usu;
      $name=$nom.' '.$ape.'';
      $accion='asignar.planhijo';
     
      
      $busquedaPlan = ModelPlandeEvaluacion::where('id_plan', $id_plan)->pluck('cod_sec_plan');

      $busquedaPuente=DB::table('mpuentemasters')->where('id_uc_sec', $busquedaPlan[0])->pluck('cod_unidad');

      $infoPuente=DB::table('mpuentemasters')->where('cod_unidad', $busquedaPuente[0])->where('coordinador', 'FALSE')->pluck('id_uc_sec');

      //dd($busquedaPuente);
      
      $evaluaciones = ModelEvaluacion::where('id_plan_eva', $id_plan)->get();
      $i = 0;
      foreach ($infoPuente as $InfPue) {

        $PlanHijo = new ModelPlandeEvaluacion;
        $PlanHijo->status = 'ASIGNADO';
        $PlanHijo->cod_sec_plan = $InfPue;
        $PlanHijo->save();
        $seccionasignada=DB::table('mpuentemasters')->where('id_uc_sec', $InfPue)->where('coordinador', 'FALSE')->pluck('cod_seccion');

        //GUARDO EN BITACORA///
        $bitacora= new ModelBitacora;
        $observacion='Asignación con exito para la unidad: '.$busquedaPuente[0].'  seccion: '.$seccionasignada[0].''; 
        $bitacora->registra($idbit,$accion,$observacion,$name);


        foreach ($evaluaciones as $evas) {

          $EvasHijo = new ModelEvaluacion;
          $EvasHijo->id_plan_eva = $PlanHijo->id_plan;
          $EvasHijo->id_inst_eva = $evas->id_inst_eva;
          $EvasHijo->unidad = $evas->unidad;
          $EvasHijo->criterio = $evas->criterio;
          $EvasHijo->tecnica = $evas->tecnica;
          $EvasHijo->contenido = $evas->contenido;
          $EvasHijo->observacion ='Agregar Observacion';
          $EvasHijo->corte = 'SIN ASIGNAR';
          $EvasHijo->ponderacion= $evas->ponderacion;
          $EvasHijo->fec_prop = $evas->fec_prop;
          $EvasHijo->fec_res ='2000-01-01';
          $EvasHijo->fec_part ='2000-01-01';
          $EvasHijo->save();
        }
      }
        
      $sec = ModelSeccion::where('cod_sec','<>','NULL')->get();
      $seccuenta=count($sec);
        
        /*$PlanMaster = ModelPlandeEvaluacion::find($id_plan);
        $PlanMaster->status = 'ASIGNADO';
        $PlanMaster->save();
        */
      return redirect('Plan_Evaluaciones/Gestion_master')->with('msj', 'Plan Maestro Asignado')->with('seccuenta',$seccuenta);
    }
    public function verificar($cod_unidad){
      $id = Auth::user() -> id; 

      //busco la informacion de el registro de esa unidad curricular en la puente y mostrarla para luego verificar si se tiene o no planes
      $busqueda=DB::table('mpuentemasters')->where('cod_unidad', $cod_unidad)->where('coordinador', 'TRUE')->where('id_usu', $id)->pluck('id_uc_sec');
      $planeva = ModelPlandeEvaluacion::where('cod_sec_plan', $busqueda[0])->get();

      /////////////////Para Modificarlo\\\\\\\\\\\\\\\\\\\\''
      //todas las Evaluaciones para ese plan
      $evaluaciones = '';

      $planeva2 = ModelPlandeEvaluacion::where('cod_sec_plan', $busqueda[0])->pluck('id_plan');
      
      if(count($planeva2) > 0){
        $evaluaciones= ModelEvaluacion::where('id_plan_eva', $planeva2[0])->get();
      } 
        //Creo variable que me lleva el contro para saber que hacer con ellas
      $editar='false';

        // si me trae alguna informacion la tabla de plan (si tienes planes la unidad)
      $algo=(count($planeva));


        //si tiene planes cambio el valor del condicional
      if($algo !=0 ){ 
        
        $id_master=DB::table('mpuentemasters')->where('cod_unidad', $cod_unidad)->where('cod_seccion','!=','NULL')->pluck('id_uc_sec');

        foreach ($id_master as $id_mas) {
          $planeshijos = ModelPlandeEvaluacion::where('cod_sec_plan', $id_mas)->pluck('status');    
        }
      //  dd(count($id_master));
        if(count($planeshijos) == 0){
          $editar='MASTER';    
        }
        else{
          $editar='ASIGNADO';
        }
      }


      ///////////////Informacion para crear plan\\\\\\\\\\\\\\\\\\
      $uni_crr = ModelUnidadCurricular::where('cod_uc_pnf', $cod_unidad)->get();
      $usuario = User::where('id', $id)->get();
      $master = DB::table('mpuentemasters')->where('cod_unidad', $cod_unidad)->where('coordinador', 'TRUE')->where('id_usu', $id)->get();
      $hijo = DB::table('mpuentemasters')->where('cod_unidad', $cod_unidad)->where('coordinador', 'FALSE')->where('id_usu', $id)->get();
      $instrumentos = ModelInstrumento::all();
      $sec = ModelSeccion::where('cod_sec','<>','NULL')->get();
      $seccuenta=count($sec);

      return view('Plan_Evaluaciones/Gestion_master')->with(['editar' => $editar, 'instrumentos' => $instrumentos, 'master' => $master, 'usuario' => $usuario, 'uni_crr' => $uni_crr, 'planeva' => $planeva, 'evaluaciones' => $evaluaciones, 'cod_unidad' => $cod_unidad, 'planeva2' => $planeva2,'seccuenta'=>$seccuenta]);
    }

 

    public function agregar(Request $request){

      $id = Auth::user() -> id;
      $idbit = Auth::user() -> ci_usu;

      $nom=Auth::user() -> name;
      $ape=Auth::user() -> ape_usu;
      $name=$nom.' '.$ape.'';
      $accion='crear.planmaster'; 

      //Busco la unidad exacta a la cual le agregare el plan
      $idsecc = DB::table('mpuentemasters')->where('cod_unidad',$request -> cod_unidad)->where('cod_seccion', 'NULL')->where('id_usu', $id)->pluck('id_uc_sec');
      $planeva = new ModelPlandeEvaluacion();
      $planeva -> status = 'MASTER';
      $planeva -> cod_sec_plan = $idsecc[0];
      $planeva -> save();
       ///ASIGNO TODOS LOS INPUT DE LA VIEW//        
      //EN MATRIZ
      $array = $request->input();

      //dd($array);
      
      //CONTADOR
      $pos=0;
      //recojo array por indices
      //ASIGNO A OTROS ARRAY POR CABECERAS

      $Arrunidad=($array['unidad']);
      $Arrcontenido=($array['contenido']);
      $Arrtecnica=($array['tecnica']);
      $Arrcriterio=($array['criterio']);
      $Arrid_inst_eva=($array['id_inst']);
      $ArrPod=($array['ponderacion']);
      $ArrFec=($array['semana']);
    
      
      //RECORRO SEGUN X'S VAR 
      //CASO UNIDADCURRICULAR
      foreach ($Arrunidad as $key) {
        //INSTANCIO OBJETO MODELEVA
        $Evaluacion = new ModelEvaluacion();

        //ASIGNO VARIABLES DE LA MATRIZ
        //tematica
        $Evaluacion->id_plan_eva = $planeva->id_plan;

        $Evaluacion->id_inst_eva = $Arrid_inst_eva[$pos];
        
        $Evaluacion->unidad = $Arrunidad[$pos];

        $Evaluacion->criterio = $Arrcriterio[$pos];
        
        $Evaluacion->tecnica = $Arrtecnica[$pos];
        
        $Evaluacion->contenido = $Arrcontenido[$pos];
        
        $Evaluacion->observacion ='Agregar Observacion';
        
        $Evaluacion->corte = 'SIN ASIGNAR';
        
        $Evaluacion->ponderacion=$ArrPod[$pos];
        
        $Evaluacion->fec_prop = $ArrFec[$pos];
        
        $Evaluacion->fec_res ='01-01-2000';
        
        $Evaluacion->fec_part ='01-01-2000';
        
        //GUARDAR
        $Evaluacion->save();
        
        //SE ACUMULA CONTADOR
        $pos=$pos+1;
      }
      //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='PLan Creado con exito para la unidad: '.$request -> cod_unidad.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

      ////////////////////////////////
          
      return redirect('Plan_Evaluaciones/Gestion_master')->with('msj', 'Plan Creado');
    }   
    
    public function update2(Request $request, $id_plan){ 
      $id = Auth::user() -> id;
      $idbit = Auth::user() -> ci_usu;
      //dd($request);     
      $nom=Auth::user() -> name;
      $ape=Auth::user() -> ape_usu;
      $name=$nom.' '.$ape.'';
      $accion='modificar.planhijo'; 
      //dd($request);

     //$idbuscar = $request -> cod_uc_pnf;
      //$idsecc = $request -> idpuente;
      $planeva = ModelPlandeEvaluacion::find($id_plan);
      //$planeva -> cod_sec_plan = $idsecc;
      $planeva -> save();

      //cargo las evaluaciones ya asignadas para validar
      $EvaluacionesAsignadas=ModelEvaluacion::where('id_plan_eva', $id_plan)->pluck('id_eva');

     // dd($EvaluacionesAsignadas);

     ///ASIGNO TODOS LOS INPUT DE LA VIEW//        
      //EN MATRIZ
      
      $array = $request->input();
      //dd($array);
      
      //CONTADOR
      $pos=0;

      //ASIGNO A OTROS ARRAY POR CABECERAS

      $Arrunidad=($array['unidad']);
      $Arrcontenido=($array['contenido']);
      $Arrtecnica=($array['tecnica']);
      $Arrcriterio=($array['criterio']);
      $Arrid_inst_eva=($array['id_inst']);
      $ArrPod=($array['ponderacion']);
      $ArrFec=($array['semana']);
      $Arreva=($array['id_eva']);
      $ArreObser=($array['observacion']);
      $ArrReza=($array['rezaga']);
     // dd($array);

      $validemail=0;
      $EmailFecpart[]=array();
      $EmailFecprop[]=array();
      $EmailInst[]=array();
      $EmailObservacion[]=array();
      $EmailUnidad[]=array();


      //dd($array,$ArrReza);
      
      //RECORRO SEGUN X'S VAR 
      //CASO UNIDADCURRICULAR
      foreach ($Arrunidad as $key) {

        $id_evas = $Arreva[$pos];
              
        if($id_evas==''){
            
            
          $Evaluacion = new ModelEvaluacion();

          $Evaluacion->id_plan_eva = $planeva->id_plan;

          $Evaluacion->id_inst_eva = $Arrid_inst_eva[$pos];
          
          $Evaluacion->unidad = $Arrunidad[$pos];

          $Evaluacion->criterio = $Arrcriterio[$pos];
          
          $Evaluacion->tecnica = $Arrtecnica[$pos];
          
          $Evaluacion->contenido = $Arrcontenido[$pos];
          
          $Evaluacion->observacion=$ArreObser[$pos];
          
          $Evaluacion->corte = 'SIN ASIGNAR';
          
          $Evaluacion->ponderacion=$ArrPod[$pos];

          $Evaluacion->fec_part ='01-01-2000';

          $Evaluacion->fec_prop = $ArrFec[$pos];
          
          $Evaluacion->fec_res ='01-01-2000';
          
        

          //GUARDAR
          $Evaluacion->save();

          //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='Plan Hijo Modificado: NUEVA EVALUACION '.$request -> cod_unidad.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
          
          $pos=$pos+1;
        }
        else{
          //INSTANCIO OBJETO MODELEVA
          $Evaluacion = ModelEvaluacion::find($id_evas);
          //dd($ArrReza[$pos]);
          if($ArrReza[$pos] > 0){
                //GUARDO EN BITACORA///
            $bitacora= new ModelBitacora;
            $observacion='Evaluación rezagada para el dia '.$ArrFec[$pos].'unidad'.$request -> cod_unidad.''; 
            $bitacora->registra($idbit,$accion,$observacion,$name);
          }else{

          }          
          //ASIGNO VARIABLES DE LA MATRIZ
          //tematica
            //dd($request); 
          $Evaluacion->id_plan_eva = $planeva->id_plan;

          
          $Evaluacion->unidad = $Arrunidad[$pos];

          $Evaluacion->criterio = $Arrcriterio[$pos];
          
          $Evaluacion->tecnica = $Arrtecnica[$pos];
          
          $Evaluacion->contenido = $Arrcontenido[$pos];
          
          $Evaluacion->observacion=$ArreObser[$pos];
          
          //$Evaluacion->corte = FALSE;
          
          $Evaluacion->ponderacion=$ArrPod[$pos];
          
          if($Evaluacion->fec_prop != $ArrFec[$pos] || $Evaluacion->id_inst_eva != $Arrid_inst_eva[$pos]){

            $buscainst= $Evaluacion->id_inst_eva;

            $nombreinst=ModelInstrumento::where('id_inst',$buscainst)->value('tip_inst');
            $Evaluacion->fec_part = $Evaluacion->fec_prop;

            $Evaluacion->fec_prop = $ArrFec[$pos];
           
            $EmailFecpart[$validemail]=$Evaluacion->fec_prop;
            $EmailFecprop[$validemail]=$ArrFec[$pos];
            $tipoevas=ModelInstrumento::where('id_inst',$Arrid_inst_eva[$pos])->pluck('tip_inst');
            $EmailViejoInst[$validemail]=$nombreinst;
            $EmailInst[$validemail]=$tipoevas[0];
            $EmailObservacion[$validemail]=$ArreObser[$pos];
            $EmailUnidad[$validemail]=$Arrunidad[$pos];
            $validemail=$validemail+1;
           // dd($nombreinst,$EmailViejoInst[0]);
          }
          else{
            $Evaluacion->fec_part = '01-01-2000';

            $Evaluacion->fec_prop = $Evaluacion->fec_prop;
          }
          $Evaluacion->id_inst_eva = $Arrid_inst_eva[$pos];
          
          //$Evaluacion->fec_res ='01-01-2000';
          
          
          //GUARDAR
          $Evaluacion->save();
          //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='Plan Hijo Modificado: EVALUACION MODIFICADA '.$request -> cod_unidad.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
          //SE ACUMULA CONTADOR
          $i=0;
         // dd($EvaluacionesAsignadas,$Arreva);
             foreach ($EvaluacionesAsignadas as $key => $value) {
               
                if(in_array($value, $Arreva)){
                  $i=+1;
                }
           
                  if(!in_array($value, $Arreva)){
                  //$delet=$Arreva[$i];
                  //dd($value,$delet,$EvaluacionesAsignadas);
                  $buscalo=ModelEvaluacion::where('id_eva',$value)->first();
                  //$buscalox=array_flatten($buscalo);
                  //dd($buscalo);
                  $dead=$buscalo;
                  // dd($dead);
                  if($dead != ''){
                  $dead->delete();

                  $i=+1;
                  }
                  else{
                    
                  } 
                  }

                 
              }
          $pos=$pos+1;
        }  
      }
      // dd($validemail,$EmailFecpart, $EmailFecprop,$EmailInst,$EmailObservacion);
       //usuario online
      if($validemail!=0){
        $id = Auth::user() -> id;
        $user2=User::find($id);
        //cod_unidad del plan a notificar
        $busquedauni=DB::table('mpuentemasters')->where('id_uc_sec', $planeva->cod_sec_plan)->pluck('cod_unidad');
        //cod seccion del plan a notificar
        $buscasec=DB::table('mpuentemasters')->where('id_uc_sec', $planeva->cod_sec_plan)->pluck('cod_seccion');
        //datos de la seccion del plan
        $busquedasec=ModelSeccion::where('cod_sec',$buscasec[0])->get();
        #datos de launidad curricular
            $uni=ModelUnidadCurricular::where('cod_uc_pnf', $busquedauni)->pluck('nom_uc');

        //DATOS del coordinador de la unidad
        $IdcordinadorUC=DB::table('mpuentemasters')->where('coordinador', 'TRUE')->where('cod_unidad', $busquedauni[0])->pluck('id_usu');
        $CorreoCoordinadorUC=User::find($IdcordinadorUC[0]);
        //dd($CorreoCoordinadorUC,$IdcordinadorUC[0],$uni[0],$busquedasec[0],$user2);

        //Funcion de envio de notificacion
        $CorreoCoordinadorUC->generateNotifyPlanModifCor($user2,$busquedasec,$uni,$EmailFecpart, $EmailFecprop,$EmailInst,$EmailObservacion,$EmailUnidad,$EmailViejoInst,(new ModifPlanCoor($CorreoCoordinadorUC,$user2,$busquedasec[0],$uni[0],$EmailFecpart, $EmailFecprop,$EmailInst,$EmailObservacion,$EmailUnidad,$EmailViejoInst)));
   
              /* try{$CorreoCoordinadorUC->generateNotifyPlanModifCor($user2,$busquedasec,$uni,(new ModifPlanCoor($CorreoCoordinadorUC,$user2,$busquedasec[0],$uni[0])));
                            
                          } catch (\Exception $e) {
                            dd('error');
                            
                          }*/                  
                          
        return back()->with('msj', 'Datos Actualizados');
      }
      else{
        return back()->with('msj', 'Datos Actualizados');
      }
    
    }

    public function update(Request $request, $id_plan){ 
      $idbit = Auth::user() -> ci_usu;
      $iduser = Auth::user() -> id;
      $user=User::find($iduser);
      foreach ($user->roles as $rol) {
        
        if($rol->tienemodulo('modificar.planmaestro')){

      
         //$idbuscar = $request -> cod_uc_pnf;
          $idsecc = $request -> idpuente;
          $planeva = ModelPlandeEvaluacion::find($id_plan);
          $planeva -> cod_sec_plan = $idsecc;
          $planeva -> save();

          $id = Auth::user() -> id;

          $nom=Auth::user() -> name;
          $ape=Auth::user() -> ape_usu;
          $name=$nom.' '.$ape.'';
          $accion='modificar.planmaestro'; 
          //cargo las evaluaciones ya asignadas para validar
          $EvaluacionesAsignadas=ModelEvaluacion::where('id_plan_eva', $id_plan)->pluck('id_eva');

         // dd($EvaluacionesAsignadas);

         ///ASIGNO TODOS LOS INPUT DE LA VIEW//        
          //EN MATRIZ
          
          $array = $request->input();
          //dd($array);
          
          //CONTADOR
          $pos=0;

          //ASIGNO A OTROS ARRAY POR CABECERAS

          $Arrunidad=($array['unidad']);
          $Arrcontenido=($array['contenido']);
          $Arrtecnica=($array['tecnica']);
          $Arrcriterio=($array['criterio']);
          $Arrid_inst_eva=($array['id_inst']);
          $ArrPod=($array['ponderacion']);
          $ArrFec=($array['semana']);
          $Arreva=($array['id_eva']);

          //dd($array);
          
          //RECORRO SEGUN X'S VAR 
                  //CASO UNIDADCURRICULAR
          foreach ($Arrunidad as $key) {
           // dd($Arrunidad,$key,$Arreva);
           $id_evas = $Arreva[$pos];
            
            if($id_evas==''){
                
              $Evaluacion = new ModelEvaluacion();

              $Evaluacion->id_plan_eva = $planeva->id_plan;

              $Evaluacion->id_inst_eva = $Arrid_inst_eva[$pos];
              
              $Evaluacion->unidad = $Arrunidad[$pos];

              $Evaluacion->criterio = $Arrcriterio[$pos];
              
              $Evaluacion->tecnica = $Arrtecnica[$pos];
              
              $Evaluacion->contenido = $Arrcontenido[$pos];
              
              $Evaluacion->observacion='Plan Maestro';
              
              $Evaluacion->corte = 'SIN ASIGNAR';
              
              $Evaluacion->ponderacion=$ArrPod[$pos];

              $Evaluacion->fec_part ='01-01-2000';

              $Evaluacion->fec_prop = $ArrFec[$pos];
              
              $Evaluacion->fec_res ='01-01-2000';
              
            

              //GUARDAR
              $Evaluacion->save();
              //GUARDO EN BITACORA///
              $bitacora= new ModelBitacora;
              $observacion='Plan MAESTRO Modificado: NUEVA EVALUACION '.$request -> cod_unidad.''; 

              $bitacora->registra($idbit,$accion,$observacion,$name);

              ////////////////////////////////
              $pos=$pos+1;
            }
            else{
                  //INSTANCIO OBJETO MODELEVA
              $Evaluacion = ModelEvaluacion::find($id_evas);
              
              //ASIGNO VARIABLES DE LA MATRIZ
              //tematica
              $Evaluacion->id_plan_eva = $planeva->id_plan;

              $Evaluacion->id_inst_eva = $Arrid_inst_eva[$pos];
              
              $Evaluacion->unidad = $Arrunidad[$pos];

              $Evaluacion->criterio = $Arrcriterio[$pos];
              
              $Evaluacion->tecnica = $Arrtecnica[$pos];
              
              $Evaluacion->contenido = $Arrcontenido[$pos];
              
              $Evaluacion->observacion='Plan Maestro';
              
              //$Evaluacion->corte = ;
              
              $Evaluacion->ponderacion=$ArrPod[$pos];
             
              $Evaluacion->fec_part = $Evaluacion->fec_prop;

              $Evaluacion->fec_prop = $ArrFec[$pos];
              
              //$Evaluacion->fec_res ='01-01-2000';
              
              
              //GUARDAR
              $Evaluacion->save();
              //GUARDO EN BITACORA///
              $bitacora= new ModelBitacora;
              $observacion='Plan MASTER Modificado: EVALUACION MODIFICADA '.$request -> cod_unidad.''; 

              $bitacora->registra($idbit,$accion,$observacion,$name);

              ////////////////////////////////
              //SE ACUMULA CONTADOR
              $i=0;
              foreach ($EvaluacionesAsignadas as $key => $value) {
               
                if(in_array($value, $Arreva)){
                  $i=+1;
                }
                else{
                  if(!in_array($value, $Arreva)){
                  $delet=$Arreva[$i];
                  //dd($value,$delet,$EvaluacionesAsignadas);
                  $buscalo=ModelEvaluacion::where('id_eva',$value)->get();
                  //dd($buscalo[0]);
                  $dead=$buscalo[0];
                  $dead->delete();
                  $i=+1; 
                  }
                  else{

                  }
                } 
              }
            $pos=$pos+1;

            }  

          }  
        

    
      return back()->with('msj', 'Datos Actualizados');
    }
      else{
          Flash::warning('<h4><b>No posee las permisologías necesarias para la accion:'.$rol->tieneModulo(\Request::route()->getName()).'</b><h4>');

          return back();
        }
    }
    }


    public function eliminar($id_plan){
      $plan = ModelPlandeEvaluacion::find($id_plan);
      $plan->delete();
      return redirect('Plan_Evaluaciones/Gestion_master')->with('eli', 'Plan Eliminado');
    }



  ////////////////Fin de Planes Maestros

  //Planes Hijos
    
    public function MostrarPlan(){  
    
      $id = Auth::user() -> id; 
      $master = DB::table('mpuentemasters')->where('id_usu', $id)->where('cod_seccion', '!=', 'NULL')->get();
      $planeva = ModelPlandeEvaluacion::all();  

      $uni_crr = ModelUnidadCurricular::all();
      $seccion = ModelSeccion::all();
      $instrumentos = ModelInstrumento::all();
      //$eva= ModelEvaluacion::all();
      //$status= DB::table('mplan_evas')->get(['status']);


      return view('Plan_Evaluaciones/Gestion_Planes')->with(['uni_crr' => $uni_crr, 'master' => $master, 'instrumentos' => $instrumentos, 'planeva' => $planeva, 'seccion' => $seccion]);
    }    

    public function imprimir($id_plan){  

      $id = Auth::user() -> id;
      $idbit = Auth::user() -> ci_usu;
  
      $nom=Auth::user() -> name;
      $ape=Auth::user() -> ape_usu;
      $name=$nom.' '.$ape.'';
      $accion='asignar.planhijo';

      $evaluaciones= ModelEvaluacion::where('id_plan_eva', $id_plan)->get();

      //Creo variable que me lleva el contro para saber que hacer con ellas
      $editar='TRUE';
      
      //INformacion de plan
      $planeshijos = ModelPlandeEvaluacion::where('id_plan', $id_plan)->pluck('cod_sec_plan');    
      
      //$infomaster = DB::table('mpuentemasters')->where('id_uc_sec', $planeshijos[0])->get();
      //, 'infomaster' => $infomaster

      //Unidad
      $master = DB::table('mpuentemasters')->where('id_uc_sec', $planeshijos[0])->pluck('cod_unidad');
      $uni_crr = ModelUnidadCurricular::where('cod_uc_pnf', $master[0])->get();

      $usuario = User::where('id', $id)->get();

      $instrumentos = ModelInstrumento::all();
       //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='Plan hijo Impreso '.$master.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
      return view('Plan_Evaluaciones/imprimir')->with(['editar' => $editar, 'instrumentos' => $instrumentos, 'usuario' => $usuario, 'uni_crr' => $uni_crr, 'evaluaciones' => $evaluaciones, 'id_plan' => $id_plan]);
    }

    public function verificarPlan($id_plan){

      $id = Auth::user() -> id; 

      $evaluaciones= ModelEvaluacion::where('id_plan_eva', $id_plan)->get();

      //Creo variable que me lleva el contro para saber que hacer con ellas
      $editar='TRUE';
      
      //INformacion de plan
      $planeshijos = ModelPlandeEvaluacion::where('id_plan', $id_plan)->pluck('cod_sec_plan');    
      
      //$infomaster = DB::table('mpuentemasters')->where('id_uc_sec', $planeshijos[0])->get();
      //, 'infomaster' => $infomaster

      //Unidad
      $master = DB::table('mpuentemasters')->where('id_uc_sec', $planeshijos[0])->pluck('cod_unidad');
      $uni_crr = ModelUnidadCurricular::where('cod_uc_pnf', $master[0])->get();

      $usuario = User::where('id', $id)->get();

      $instrumentos = ModelInstrumento::all();

      return view('Plan_Evaluaciones/Gestion_Planes')->with(['editar' => $editar, 'instrumentos' => $instrumentos, 'usuario' => $usuario, 'uni_crr' => $uni_crr, 'evaluaciones' => $evaluaciones, 'id_plan' => $id_plan]);

    }

    public function modificar(Request $request, $id_plan){

      dd($request,$id_plan);
    }

  //FUNCIONES RESOURCE
    
    public function store(Request $request){}
    public function index(){}
    public function destroy($id){}
    public function show($id){}
    public function edit(){}
}