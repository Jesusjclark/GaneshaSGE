<?php

namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;
//////////BD//////////////////
use Illuminate\Support\Facades\DB;
use GaneshaSIGE\User;

use GaneshaSIGE\ModelEje;
//ESTE ES EL NOMBRE DEL MODELO

use GaneshaSIGE\ModelUnidadCurricular;
//ESTE ES EL NOMBRE DEL MODELO
use GaneshaSIGE\ModelSeccion;
//ESTE ES EL NOMBRE DEL MODELO
use Laracasts\Flash\Flash;
use GaneshaSIGE\ModelBitacora;
use \Auth as Auth;
use Carbon\Carbon;


 
class ControllerUnidadCurriculars extends Controller
{
     public function validarNull($tray)
    {
            if($tray=='1'){
                $tray ='NULL1'; 
            }
             if($tray=='2'){
                $tray ='NULL2';     
            }
            if($tray=='3'){
                $tray ='NULL3';  
            }
             if($tray=='4'){
                $tray  ='NULL4';
            }
             if($tray=='0'){
                $tray ='NULL0';
            }
            return $tray;
    }


    public function mostrar()
    {  
        $uni_crr = ModelUnidadCurricular::all();
        //Creo una variable la cual Me trae toda la informacion que contiene la base de datos
        
        $ejes = ModelEje::all();
        //Creo una variable la cual Me trae toda la informacion que contiene la base de datos
        return view('Uni_Crr/G_uc')->with(['uni_crr' => $uni_crr, 'ejes' => $ejes]);

        //Y Retorno a la vista una variable a la cual le asigno lo que contiene la variable anterior creada
    }


    public function agregar(Request $request)
     {
        $this->validate($request, [
            'C_uc' => 'required',
            'Trayecto' => 'required',
            'HTT' => 'required',
            'C_ucn' => 'required',
            'Creditos' => 'required',
            'HTE' => 'required',
            'N_uc' => 'required',
            'HTA' => 'required',
            'cod_eje' => 'required',
            ]);

            $idbit = Auth::user() -> ci_usu;
           
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='crear.uc'; 
        $uc = new ModelUnidadCurricular();

        //$sec = new ModelSeccion;

        $trayecto = $request -> Trayecto;


        $uc -> cod_uc_pnf = $request -> C_uc;
        $uc -> cod_uc_nac = $request -> C_ucn;
        $uc -> creditos = $request -> Creditos;
        $uc -> nom_uc = $request -> N_uc;
        $uc -> trayecto = $request -> Trayecto;
        $uc -> hta = $request -> HTA;
        $uc -> htt = $request -> HTT;
        $uc -> hte = $request -> HTE;
        $uc -> periodo = true;
        $uc -> cod_pen_uc = 1;
        $ucbusca=$request -> C_uc;
        $ucvalida=ModelUnidadCurricular::find($ucbusca);

        $ucvalid=(count($ucvalida));
//dd($ucvalida,$ucvalid);

        if($ucvalid>0){  
        Flash::warning('<h4><b>Ya existe esta UC con este codigo: '.$ucbusca.'!</b></h4>');
         
        }else{


        $uc -> save();
        }
   
        

        //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='Unidad Curricular Creada: '.$uc -> nom_uc.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
        foreach ($request -> cod_eje as $id) {

             $eje = ModelEje::find($id);

             if (!is_null($eje)) {
                $uc->ejes()->attach($eje);
             }
         }
        // $tray = $uc -> trayecto; 

        // $sec = ControllerUnidadCurriculars::validarNull($tray);

        // $uc->seccions()->attach($sec);

    return redirect('Uni_Crr/G_uc');
        
    }

   
public function update(Request $request, $cod_uc_pnf)
    {

        $this->validate($request, [
            'C_uc' => 'required',
            'Trayecto' => 'required',
            'HTT' => 'required',
            'C_ucn' => 'required',
            'Creditos' => 'required',
            'HTE' => 'required',
            'N_uc' => 'required',
            'HTA' => 'required',
            'cod_ejes' => 'required',            
            ]);
         $iduser = Auth::user() -> id;
        $user=User::find($iduser);
        foreach ($user->roles as $rol) {
          if(!$rol->tienemodulo('modificar.rol')){
           Flash::warning('<h4><b>No posee las permisologías necesarias para la accion:'.$rol->tieneModulo(\Request::route()->getName()).'</b><h4>');

              return back();}
            else{
            $idbit = Auth::user() -> ci_usu;
            
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='modificar.uc'; 

        $uc = ModelUnidadCurricular::find($cod_uc_pnf);
        

        $unidad = $uc-> cod_uc_pnf;
        $tray = $uc -> trayecto;

        //$seccion = ControllerUnidadCurriculars::validarNull($tray);
        $sec = 'NULL';

        $uc -> cod_uc_nac = $request -> C_ucn;
        $uc -> creditos = $request -> Creditos;
        $uc -> nom_uc = $request -> N_uc;
        $uc -> hta = $request -> HTA;
        $uc -> htt = $request -> HTT;
        $uc -> hte = $request -> HTE;
        $uc -> periodo = true;
        $uc -> cod_pen_uc = 1;   
       
        $uc -> cod_uc_pnf = $request -> C_uc;
        
        $eje = $request -> cod_ejes;

        if(count($eje) > 0){
                $uc->ejes()->sync($eje);
        }    
       
       // $secc = ControllerUnidadCurriculars::validarNull($sec);
    
     
       // $uc->seccions()->detach($seccion);
        //$uc->seccions()->attach($secc);  
        $user=['2'];
        // dd($uc->cod_uc_pnf);

                $puentetabla=DB::table('mpuentemasters')->where('cod_seccion',$sec)->where('cod_unidad',$uc->cod_uc_pnf)->where('coordinador', 'TRUE')->get();
                $puentetabla2=DB::table('mpuentemasters')->where('cod_unidad',$uc->cod_uc_pnf)->where('coordinador', 'FALSE')->get();
        $cuentapuente2=count($puentetabla2);
        $cuentapuente=count($puentetabla);
       // dd($cuentapuente2,$puentetabla);
        if($cuentapuente >0 || $cuentapuente2>0){
        Flash::warning('<h4><b>Se ha actualizado la Unid. Curricular  EXCEPTUANDO las modificaciones del trayecto, ya que esta ya se encuentra ASIGNADA a un grupo de Secciones.</b></h4>');
            //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='Unidad Curricular Modificada de:'.$request -> N_uc.' a: '.$uc -> nom_uc.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
            $uc -> save();
            return redirect('Uni_Crr/G_uc');
        }
        if($cuentapuente<=0){
        Flash::success('<h4><b>Unidad Curricular Actualizada!</b></h4>');
        $uc -> trayecto = $request -> Trayecto;
        $uc -> save();
        //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='Unidad Curricular Modificada: de:'.$request -> N_uc.' a: '.$uc -> nom_uc.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
        return redirect('Uni_Crr/G_uc');
        }
        

    }       

    }
}

    public function eliminar($cod_uc_pnf){
            $idbit = Auth::user() -> ci_usu;
          
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='eliminar.uc'; 
        $Deje = ModelUnidadCurricular::find($cod_uc_pnf);
        $Deje->delete();
        //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='Unidad Curricular eliminada: '.$Deje -> nom_uc.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
        return redirect("Uni_Crr/G_uc");
            }

    public function destroy($cod_uc_pnf)
    {
            $idbit = Auth::user() -> ci_usu;
           
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='eliminar.uc'; 

        $uc = ModelUnidadCurricular::find($cod_uc_pnf);
        $uc->delete();

         //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='Unidad Curricular eliminada: '.$uc -> nom_uc.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
        return redirect("Uni_Crr/G_uc");
    }
    }