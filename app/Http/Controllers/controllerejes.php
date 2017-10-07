<?php

namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;
use GaneshaSIGE\ModelBitacora;
use \Auth as Auth;
use GaneshaSIGE\User;


use GaneshaSIGE\ModelEje;
//ESTE ES EL NOMBRE DEL MODELO

class ControllerEjes extends Controller
{
  

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function mostrar()
    {  
    
        $ejes = ModelEje::all();
        //Creo una variable la cual Me trae toda la informacion que contiene la base de datos
        return view('Ejes/G_ejes')->with(['ejes' => $ejes]);
        //Y Retorno a la vista una variable a la cual le asigno lo que contiene la variable anterior creada
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    
    public function agregar(Request $request)
     {
        $this->validate($request, [
            'nom_eje' => 'required',
            'descripcion' => 'required'
            ]);
        $idbit = Auth::user() -> ci_usu;
        $nom=Auth::user() -> name;
        $ape=Auth::user() -> ape_usu;
        $name=$nom.' '.$ape.'';
        $accion='crear.ejes'; 
       

        $agre_eje = new ModelEje();
        
        $agre_eje -> nom_eje = $request -> nom_eje;
        $agre_eje -> descripcion = $request -> descripcion;
        $agre_eje -> save();
         //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='Nuevo Eje Registrado: '.$agre_eje -> nom_eje.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
        return redirect('Ejes/G_ejes');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_eje)
    { 
        $iduser = Auth::user() -> id;
        $user=User::find($iduser);
        foreach ($user->roles as $rol) {
          if(!$rol->tienemodulo('modificar.ejes')){
           Flash::warning('<h4><b>No posee las permisologías necesarias para la accion:'.$rol->tieneModulo(\Request::route()->getName()).'</b><h4>');

        return back();
        }
      else{


        $this->validate($request, [
            'nom_eje' => 'required',
            'descripcion' => 'required'
        ]);
        $idbit = Auth::user() -> ci_usu;
        $nom=Auth::user() -> name;
        $ape=Auth::user() -> ape_usu;
        $name=$nom.' '.$ape.'';
        $accion='modificar.ejes'; 

        $mod_eje = ModelEje::find($cod_eje);
        
        $mod_eje -> nom_eje = $request -> nom_eje;
        $mod_eje -> descripcion = $request -> descripcion;
        $mod_eje -> save();
         //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='Eje Modificado: de:'.$request -> nom_eje.' a '.$mod_eje -> nom_eje.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
        return redirect('Ejes/G_ejes');    }
    }
}

    public function eliminar($cod_eje)
    {
         $idbit = Auth::user() -> ci_usu;
        $nom=Auth::user() -> name;
        $ape=Auth::user() -> ape_usu;
        $name=$nom.' '.$ape.'';
        $accion='eliminar.ejes'; 

        $Deje = ModelEje::find($cod_eje);
        $Deje->delete();

        //GUARDO EN BITACORA///
          $bitacora= new ModelBitacora;
          $observacion='Eje Eliminado: '.$Deje -> nom_eje.''; 

          $bitacora->registra($idbit,$accion,$observacion,$name);

          ////////////////////////////////
        return redirect("Ejes/G_ejes"); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_eje)
    {  
        $Deje = ModelEje::find($cod_eje);
        $Deje->delete();
        return redirect("Ejes/G_ejes");     }
}
