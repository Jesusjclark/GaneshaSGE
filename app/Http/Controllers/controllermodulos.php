<?php

namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GaneshaSIGE\ModelModulo;
use GaneshaSIGE\ModelRol;
use GaneshaSIGE\ModelBitacora;

class controllermodulos extends Controller
{
  

    public function mostrar()
    {  
        $rol_mod = DB::table('mrol_mods')->get();
        $mod = ModelModulo::all();
        //Creo una variable la cual Me trae toda la informacion que contiene la base de datos
        
        //$ejes = ModelEje::all();
        //Creo una variable la cual Me trae toda la informacion que contiene la base de datos
        return view('modulos/G_modulos')->with(['mod' => $mod]);

        //Y Retorno a la vista una variable a la cual le asigno lo que contiene la variable anterior creada
    }
    public function index(){ }

 
    public function create(){ }

 
    public function store(Request $request){ }


    public function show($id){ }

  
    public function edit($id){ }

 
    public function update(Request $request, $id){ }

  
    public function destroy($id){ }
}
