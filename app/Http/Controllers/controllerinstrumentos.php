<?php

namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;

use GaneshaSIGE\ModelInstrumento;
use Illuminate\Support\Facades\Mail; 
use GaneshaSIGE\ModelBitacora;
use GaneshaSIGE\User;
use \Auth as Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Storage;

//ESTE ES EL NOMBRE DEL MODELO

class controllerinstrumentos extends Controller
{
   
 
    public function mostrar()
    {  
        //$eje_uni = DB::table('mejes_ucs')->get();

        $inst = ModelInstrumento::all();
        //Creo una variable la cual Me trae toda la informacion que contiene la base de datos
        
        //$ejes = ModelEje::all();
        //Creo una variable la cual Me trae toda la informacion que contiene la base de datos
        return view('Instrumentos/G_Instrumentos')->with(['inst' => $inst]);

        //Y Retorno a la vista una variable a la cual le asigno lo que contiene la variable anterior creada
    }

    
    public function index()
    {
        //
    }

    public function create()
    {}
    public function store(Request $request)
    {}

    public function show($id)
    {
        //
    }

    public function edit($id)
    {    }

    public function update(Request $request, $id_inst)
    {
         $iduser = Auth::user() -> id;
        $user=User::find($iduser);
        foreach ($user->roles as $rol) {
          if(!$rol->tienemodulo('modificar.instrumentos')){
           Flash::warning('<h4><b>No posee las permisologías necesarias para la accion:'.$rol->tieneModulo(\Request::route()->getName()).'</b><h4>');

        return back();
        }
      else{
        $this->validate($request, [
            'tip_inst' => 'required',
            'descp_inst' => 'required',
            
            ]);
           $idbit = Auth::user() -> ci_usu;
           
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='modificar.instrumentos'; 

        $inst = ModelInstrumento::find($id_inst);;

        $inst -> tip_inst = $request -> tip_inst;
        $inst -> descp_inst = $request -> descp_inst;

        
        $inst -> save();
         //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='instrumento Modificado: '.$inst-> tip_inst.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////


            return redirect('instrumentos/vista');
          }
        }
    }

   
    public function destroy($id_inst){
         $idbit = Auth::user() -> ci_usu;
           
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='eliminar.instrumentos'; 
        $inst = ModelInstrumento::find($id_inst);
            $instru=$inst-> tip_inst;

        $inst->delete();
         //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='instrumento eliminado: '.$instru.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
        return redirect("instrumentos/vista");
            }



 public function agregar(Request $request)
     {
        $this->validate($request, [
            'tip_inst' => 'required',
            'descp_inst' => 'required',
            
            ]);
        $idbit = Auth::user() -> ci_usu;
           
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='crear.instrumentos'; 


        $inst = new ModelInstrumento();


        $inst -> tip_inst = $request -> tip_inst;
        $inst -> descp_inst = $request -> descp_inst;
       
        $inst -> save();
         //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='instrumento creado: '.$inst -> tip_inst.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////


    return redirect('instrumentos/vista');
        
    }
      public function eliminar($id_inst){

           $idbit = Auth::user() -> ci_usu;
           
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='eliminar.instrumentos'; 
        $inst = ModelInstrumento::find($id_inst);
        $instru=$inst-> tip_inst;

        $inst->delete();
        //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='instrumento eliminado: '.$instru.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////


        return redirect("instrumentos/vista");
            }
}