<?php

namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;


use GaneshaSIGE\ModelRol;
use GaneshaSIGE\ModelModulo;
use GaneshaSIGE\ModelBitacora;
use \Auth as Auth;
use Carbon\Carbon;
use GaneshaSIGE\User;
use Laracasts\Flash\Flash;

use Illuminate\Support\Facades\DB;
class controllerroles extends Controller
{
   
   

         public function mostrar()
        {  
        $rol = ModelRol::all();
        //Creo una variable la cual Me trae toda la informacion que contiene la base de datos
        
        $mod = ModelModulo::all();
        //Creo una variable la cual Me trae toda la informacion que contiene la base de datos
        return view('roles/G_roles')->with([ 'rol' => $rol, 'mod' => $mod]);
        //Y Retorno a la vista una variable a la cual le asigno lo que contiene la variable anterior creada
        }
  
   
        public function update(Request $request, $id_rol)
        {
        $this->validate($request, [
            'id_rol' => 'required',
            'nom_rol' => 'required',
            'id_mod'=> 'required',
            ]);
        $idbit = Auth::user() -> ci_usu;
        $iduser = Auth::user() -> id;
           
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='modificar.rol'; 


        $user=User::find($iduser);
        foreach ($user->roles as $rol) {
          if($rol->tienemodulo('modificar.rol')){
        
      
            
              $rol = ModelRol::find($id_rol);

              $rol -> id_rol = $request -> id_rol;
              $rol -> nom_rol = $request -> nom_rol;
              $rol -> save();

           //GUARDO EN BITACORA///
            $bitacora= new ModelBitacora;
            $observacion='Rol Modificado: '.$rol -> nom_rol.''; 

            $bitacora->registra($idbit,$accion,$observacion,$name);

            ////////////////////////////////
              $modulo = $request -> id_mod; 
              $cantimodu=count($modulo);
              //dd($modulo);

              if($cantimodu > 0){
              $ModulosAsignados=DB::table('mrol_mods')->where('id_rol_trm',$id_rol)->pluck('id_mod_trm');

               //dd($ModulosAsignados,$id_rol,$modulo);

                foreach ($modulo as $key => $value) {

                 if(in_array($ModulosAsignados,$modulo )){
                    dd($value);
                 }
                    
                    if($rol->tienemodulo($value)){

                    }
                    else{
                    $rol->modulos()->sync($modulo);
                    }
                }
              }    

                return redirect('roles/vista');
      }

        
      else{
        Flash::warning('<h4><b>No posee las permisologías necesarias para la accion:'.$rol->tieneModulo(\Request::route()->getName()).'</b><h4>');

        return back();
      } 
      }     
    }

   
        public function destroy($id_rol){

        $rol = ModelRol::find($id_rol);
        $rol->delete();
        return redirect("roles/vista");
            }

        public function agregar(Request $request)
        {
             $this->validate($request, [
            'nom_rol' => 'required',
            ]);

            $idbit = Auth::user() -> ci_usu;
           
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='crear.rol'; 

        $rol = new ModelRol();

        $rol -> nom_rol = $request -> nom_rol;
        $rolbusca=$request -> nom_rol;
        $rolvalida=ModelRol::where('nom_rol',$rolbusca)->get();
        $rolvalid=(count($rolvalida));
       // dd($rolvalida,$rolvalid);

        if($rolvalid>0){  
        Flash::warning('<h4><b>Ya existe Roles con este Nombre: '.$rolbusca.'!</b></h4>');
          //dd('yaexiste');
        }else{


        $rol -> save();
        
        }


        //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='Nuevo Rol Creado: '.$rol -> nom_rol.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
          $cuentamodu=count($request -> id_mod);
          //dd($cuentamodu);
          if($cuentamodu>0){
        foreach ($request -> id_mod as $id) {

            $mod = ModelModulo::find($id);

            if (!is_null($mod)) {
                $rol->modulos()->attach($mod);
            }
          }
        }
        else{

        }
    
        return redirect('roles/vista');

    }

       public function eliminar($id_rol)
        {
            $idbit = Auth::user() -> ci_usu;
           
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='eliminar.rol'; 

        $rol = ModelRol::find($id_rol);
        $role=$rol-> nom_rol;
        $rol->delete();
          $bitacora= new ModelBitacora;
          $observacion=' Rol eliminado: '.$role.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
        return redirect("roles/vista");
        }

        
//RESOURCE
    public function index(){}
    public function create(){}
    public function store(Request $request){}
    public function show($id){}
    public function edit($id){}

}
