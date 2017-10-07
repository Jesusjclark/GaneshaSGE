<?php

namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;
use GaneshaSIGE\ModelSeccion;
use GaneshaSIGE\ModelUnidadCurricular;
use GaneshaSIGE\ModelBitacora;
use GaneshaSIGE\User;
use \Auth as Auth;
use Carbon\Carbon;
use Laracasts\Flash\Flash;

use Illuminate\Support\Facades\DB;

class controllersecciones extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
      public function mostrar()
    {  
        $sec = ModelSeccion::where('cod_sec','<>','NULL')->get();
        $seccuenta=count($sec);
        //dd($seccuenta);
        $sec2 = new ModelSeccion;

        //Creo una variable la cual Me trae toda la informacion que contiene la base de datos
        $uni_crr = ModelUnidadCurricular::all();
        $cuentauc=count($uni_crr);
        
          $master=DB::table('mpuentemasters')->where('cod_seccion','<>','NULL')->get();

        //Creo una variable la cual Me trae toda la informacion que contiene la base de datos
        return view('Secciones/G_Secciones')->with(['sec' => $sec,'seccuenta' => $seccuenta,'sec2' => $sec2, 'uni_crr' => $uni_crr,'cuentauc' => $cuentauc, 'master' => $master]);

        //Y Retorno a la vista una variable a la cual le asigno lo que contiene la variable anterior creada
    }



       public function agregar(Request $request)

     {
           $this->validate($request, [
            'cod_sec' => 'required',
            'turno' => 'required',
            'trayecto' => 'required',
            ]);

            $idbit = Auth::user() -> ci_usu;
           
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='crear.seccion'; 

  
        $sec = new ModelSeccion();
        $comprueba= $request-> UC;

        $sec -> cod_sec = $request -> cod_sec;
        $secbusca= $request -> cod_sec;

        $sec -> turno = $request -> turno;
        $sec -> trayecto = $request -> trayecto;
        $id = $request -> trayecto;
        $seccasig[0]=$request->cod_sec;

        $sevalida=ModelSeccion::find($secbusca);

        $secvalid=(count($sevalida));
        if($secvalid>0){  
        Flash::warning('<h4><b>Ya existe secciones con este codigo: '.$secbusca.'!</b></h4>');
          //dd('yaexiste');
        }else{


        $sec -> save();
        }

          
       
         
          //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='Seccion Creada: '.$sec -> cod_sec.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
        $user=['2'];
           $coordinador='FALSE';

           if ($comprueba== 'NULL') {
           // dd('null');
             $uc = ModelUnidadCurricular::where('trayecto', $id)
             ->pluck('cod_uc_pnf');
             
             if (!is_null($uc)) {
                foreach ($uc as $key) {
                 $sec->MasterPuente_Secc_UniCrr()->attach( $key ,['cod_seccion'=>$seccasig[0],'id_usu'=>$user[0], 'coordinador'=>'FALSE']);
                }
                }

         }
         if ($comprueba=='TRUE') {
            //dd('true');

            $unidades=$request-> materia;
              foreach ($unidades as $key) {
                 $sec->MasterPuente_Secc_UniCrr()->attach( $key ,['cod_seccion'=>$seccasig[0],'id_usu'=>$user[0], 'coordinador'=>'FALSE']);
                }
         }
       
        

    return redirect('Secciones/G_Secciones');
        
    }

    

    public function update(Request $request, $cod_sec)
    {
      $this->validate($request, [
            'cod_sec' => 'required',
            'turno' => 'required',
            'trayecto' => 'required',
            ]);


            $idbit = Auth::user() -> ci_usu;
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='modificar.seccion'; 
            $secc = ModelSeccion::find($cod_sec);
            $iduser = Auth::user() -> id;
            $user=User::find($iduser);
              foreach ($user->roles as $rol) {
                if(!$rol->tienemodulo('modificar.seccion')){
                 Flash::warning('<h4><b>No posee las permisologías necesarias para la accion:'.$accion.'</b><h4>');

                    return back();
                }
                    else
                  {
                          $materias=$request-> materia;
                          
                          $secc -> turno = $request -> turno;
                          $secc -> trayecto = $request -> trayecto;
                          $seccasig[0]=$request->cod_sec;

                          $secc -> save();
                          //GUARDO EN BITACORA///
                          $bitacora= new ModelBitacora;
                          $observacion='Seccion Modificada: '.$secc -> cod_sec.''; 

                          $bitacora->registra($idbit,$accion,$observacion,$name);

                          ////////////////////////////////

                               $secc -> cod_sec = $request -> cod_sec;
                            
                               $id = $request -> trayecto;

                               $user=['2'];
                               
                              $unidadesasignadas=DB::table('mpuentemasters')->where('cod_seccion', $seccasig[0])->pluck('cod_unidad');
                              

                                        
                                    if (!is_null($materias)) {
                                    foreach ($materias as $key){
                                            //dd($key,$seccasig[0],$user[0]);
                                         /* 
                                          $var=DB::table('mpuentemasters')->where('cod_seccion', $seccasig)->where('id_usu', $user[0])->where('coordinador', 'FALSE')->get();
                                          //dd($var,'usuario',$user[0],$user,'seccion',$seccasig);
                                            
                                          DB::table('mpuentemasters')->where('cod_seccion', $seccasig)->where('id_usu', $user[0])->where('coordinador', 'FALSE')->update(['cod_unidad' =>DB::raw($key)]);*/

                                        if($secc->notieneUC2($key, $seccasig[0])){  
                                          $secc->MasterPuente_Secc_UniCrr()->attach( $key ,['cod_seccion'=>$seccasig[0],'id_usu'=>$user[0], 'coordinador'=>'FALSE']);
                                          }

                                          if ($secc->tieneUC2($key, $seccasig[0])) {

                                          } 
                                          }

                                            foreach ($unidadesasignadas as $asig) {
                                               if (in_array($asig, $materias)) {
                                                           
                                                //dd($asig,$unidadesasignadas,$materias);
                                                } 
                                                else{
                                                    $secc->MasterPuente_Secc_UniCrr()->detach( $asig ,['cod_seccion'=>$seccasig[0],'id_usu'=>$user[0], 'coordinador'=>'FALSE']);
                                                }
                                                      
                                             }  
                                      }
                                      else{
                                        $uc = ModelUnidadCurricular::where('trayecto', $id)
                                         ->pluck('cod_uc_pnf');
                                         
                                         if (!is_null($uc)) {
                                            foreach ($uc as $key) {
                                             $secc->MasterPuente_Secc_UniCrr()->attach( $key ,['cod_seccion'=>$seccasig[0],'id_usu'=>$user[0], 'coordinador'=>'FALSE']);
                                            }
                                            }
                                    }
                                    return redirect('Secciones/G_Secciones');
                  }
              }
}
     
    public function eliminar($cod_sec){
        $idbit = Auth::user() -> ci_usu;
        $nom=Auth::user() -> name;
        $ape=Auth::user() -> ape_usu;
        $name=$nom.' '.$ape.'';
        $accion='eliminar.seccion'; 

        $sec = ModelSeccion::find($cod_sec);
        $sec->delete();
        //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='Seccion Eliminada: '.$sec -> cod_sec.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
      return redirect('Secciones/G_Secciones');
            }

    public function create()
    {}

    public function store(Request $request)
    {}

    public function show($id)
    {}

    public function edit($id)
    {}

  

    public function destroy($id)
    {}
}
