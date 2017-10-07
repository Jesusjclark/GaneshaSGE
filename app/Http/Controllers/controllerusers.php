<?php

namespace GaneshaSIGE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GaneshaSIGE\User;
use GaneshaSIGE\ModelRol;
use GaneshaSIGE\ModelSeccion;
use \Auth as Auth;
use GaneshaSIGE\ModelUnidadCurricular;
use GaneshaSIGE\Notifications\InvoicePaid ;
use Laracasts\Flash\Flash;
use GaneshaSIGE\ModelBitacora;


use Illuminate\Support\Collection as Collection;

use Storage;
//indico al modelo que utilizara la Clase de Storage
class ControllerUsers extends Controller
{

    public function index()
    {}
    public function pass(){
        return view('Usuario/recuperarpassword');
    }
    
    
    public function asignaciones($cod_uc_pnf)
    {     
        $busqueda=DB::table('mpuentemasters')->where('cod_unidad', $cod_uc_pnf)->where('coordinador', 'FALSE')->where('id_usu','<>','2')->where('cod_seccion','<>','NULL')->get();
        $busqueda22=DB::table('mpuentemasters')->where('cod_unidad', $cod_uc_pnf)->where('coordinador', 'FALSE')->where('id_usu','2')->where('cod_seccion','<>','NULL')->get();
        $editar='none';
        $algo=(count($busqueda));

        if($algo !=0 ){ 
            $editar='true';            
        }
        else{
            if($busqueda22){
                $editar='false';  
            }
        }
        $cod_vuelta=$cod_uc_pnf;
        $docentes=DB::table('mrol_usus')->where('id_rol_tru', '4')->get();
        $listaUse = User::all(); //todos los usuarios
              //lista de todas las unidades//
              $listaUC = ModelUnidadCurricular::all();
              //lista de todas las secciones//

              $listaSec = ModelSeccion::where('cod_sec','<>','NULL')->get();
                $puente=DB::table('mpuentemasters')->get();
            $listaSecvalid =DB::table('mpuentemasters')->where('cod_unidad', $cod_uc_pnf)->where('coordinador', 'FALSE')->where('cod_seccion','<>','NULL')->pluck('cod_seccion');
            //dd($listaSec); 
          return view('/Usuario/Asignacion_Unidades')->with([ 'listaSec' => $listaSec, 'listaUse' => $listaUse, 'listaUC' => $listaUC , 'docentes' => $docentes, 'puente' => $puente,'listaSecvalid'=>$listaSecvalid, 'cod_vuelta'=>$cod_vuelta, 'editar'=>$editar, 'puente2'=>$busqueda]);
         
    }
    
    //Agregarlas
    public function asignaruc(Request $request)
    {
        $usuario= new User;
        $unidad=$request->cod_uc;
        $secciones=$request->cod_secc;
        $doc=$request->docente;
        $i=0;
       $idbit = Auth::user() -> ci_usu;
            
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='asignar.uc'; 
       
        foreach ($secciones as $sec) {

        $usuario->MasterPuente_User_UniCrr()->attach($unidad,['id_usu' => $doc[$i],'cod_seccion'=> $sec , 'coordinador' => 'FALSE']);
             //GUARDO EN BITACORA///
                $nombredocente=DB::table('users')->where('id',$docc[$i])->value('name');
                $apellidocente=DB::table('users')->where('id',$docc[$i])->value('ape_usu');
                $docentecompleto=$nombredocente.' '.$apellidocente.'';
                //dd($docentecompleto);
                $bitacora= new ModelBitacora;
                $observacion='Nueva Docente para la Unidad/Seccion:'.$uc.'/'.$secc.' responsable: '.$docentecompleto.' '; 

                $bitacora->registra($idbit,$accion,$observacion,$name);
            $i=$i+1;
          ////////////////////////////////
       }
            

          return redirect('/Usuario/Asignacion_Unidades')->with('msj', 'Datos Guardados');
    }



    public function actualizarasignaruc(Request $request)
    {
            //dd($request);
            $usuario= new User;
            $uc=$request->cod_uc;
            $secciones=$request->cod_secc;
            $docc=$request->docente;
            $usuario->id_usu=$docc;
            $idbit = Auth::user() -> ci_usu;

            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='asignar.uc'; 
           
            $editar='none';

            $i=0;
         foreach ($secciones as $secc) {

            $busqueda = DB::table('mpuentemasters')->where('cod_seccion',$secc)->where('cod_unidad', $uc)->get();
            
            $d=count($busqueda);
            //dd($docc);
            if ($d != 0){
                DB::table('mpuentemasters')->where('cod_seccion', $secc)->where('cod_unidad', $uc)->where('coordinador', 'FALSE')->update(['id_usu' =>DB::raw($docc[$i])]);

                
                
                
    
                  //GUARDO EN BITACORA///
                $nombredocente=DB::table('users')->where('id',$docc[$i])->value('name');
                $apellidocente=DB::table('users')->where('id',$docc[$i])->value('ape_usu');
                $docentecompleto=$nombredocente.' '.$apellidocente.'';
                //dd($docentecompleto);
                $bitacora= new ModelBitacora;
                $observacion='Nueva Docente para la Unidad/Seccion:'.$uc.'/'.$secc.' responsable: '.$docentecompleto.' '; 

                $bitacora->registra($idbit,$accion,$observacion,$name);
            $i=$i+1;
          ////////////////////////////////


           }
         }


            return redirect('/Usuario/Asignacion_Unidades')->with('msj', 'Datos Guardados');

    }        
    
        ///MOSTRAR ASIGNACIONES------------UNIDADES Y DOCENTES A ASIGNAR----

    public function MostrarAsignaciones(){ 
          //id users docentes//
          $docentes=DB::table('mrol_usus')->where('id_rol_tru', '4')->get();
          //usuarios todo//
          $listaUse = User::all(); //todos los usuarios
          //lista de todas las unidades//
         $editar='none';

          $listaUC = ModelUnidadCurricular::all();
          //lista de todas las secciones//
          $listaSec = ModelSeccion::all();
            $puente =DB::table('mpuentemasters')->get();
            $tru='0';

           // $listaSecvalid =DB::table('mpuentemasters')->where('cod_unidad', '0000')->where('coordinador', 'FALSE')->where('cod_seccion','<>','NULL')->pluck('cod_seccion');

          return view('/Usuario/Asignacion_Unidades')->with([ 'listaSec' => $listaSec, 'listaUse' => $listaUse, 'listaUC' => $listaUC , 'docentes' => $docentes, 'puente' => $puente, 'tru'=>$tru, 'editar', $editar]);
     }

    public function mostrar(){  

    $usuarios = User::where('id','<>','2')->get();
    //Creo una variable la cual Me trae toda la informacion que contiene la base de datos
    

    return view('Usuario/G_usu')->with(['usuarios' => $usuarios]);
    //Y Retorno a la vista una variable a la cual le asigno lo que contiene la variable anterior creada
    }

   

    public function edit($id)
    {
        $iduser = Auth::user() -> id;
        $user=User::find($iduser);
        foreach ($user->roles as $rol) {
            if(!$rol->tienemodulo('modificar.usuario')){
               Flash::warning('<h4><b>No posee las permisologías necesarias para la accion:'.$rol->tieneModulo(\Request::route()->getName()).'</b><h4>');
                return back();
            }
            else{
                $roles = ModelRol::all();

                $usuario_edit = User::find($id);
                $materias = DB::table('mpuentemasters')->where('id_usu', $id)->pluck('cod_unidad');//asigno unidades de user
                $uc = ModelUnidadCurricular::all();//Asigno todas las unidades a colleccion
                //dd($materias, $uc);
                $rolesUsu = DB::table('mrol_usus')->where('id_rol_tru', 5)->where('id_tru', $id)->pluck('id_rol_usu');//asigno unidades de user
                
                $unidad=$uc->all();//lo convierto en arreglo comun y asigno todas las uc

                return view('Usuario/G_usu')->with(['editar' => true, 'mod_usuario' => $usuario_edit, 'roles' => $roles, 'materias'=>$materias, 'uc' => $uc, 'rolesUsu' => $rolesUsu]);
            }
        }
    }

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function agregar(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'ci_usu' => 'required',
            'ape_usu'=> 'required',
            'tlf'=> 'required',
            'email'=> 'required',
            'img_perfil'=> 'required',
            'id_rol'=> 'required',
            ]);
            $idbit = Auth::user() -> ci_usu;
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='crear.usuario'; 
            $usuario = new User();
            $usuario -> name = $request -> name;
            $usuario -> ci_usu = $request -> ci_usu;
            $usuario -> ape_usu = $request -> ape_usu;
            $usuario -> tlf = $request -> tlf;
            $usuario -> email = $request -> email;
            $usuario -> password = bcrypt($request -> ci_usu);
            $usuario -> img_perfil = $request -> img_perfil;
            $userbusca=$request -> ci_usu;
            $uservalida=User::where('ci_usu',$userbusca)->get();
            $uservalid=(count($uservalida));

            if($uservalid>0){  
                Flash::warning('<h4><b>Ya existen usuarios con esta CI: '.$userbusca.'!</b></h4>');
                return redirect('Usuario/G_usu');
            }
            else{
                $usuario -> save();
             //GUARDO EN BITACORA///
                $nombredocente=DB::table('users')->where('ci_usu',$request -> ci_usu)->value('name');
                $apellidocente=DB::table('users')->where('ci_usu',$request -> ci_usu)->value('ape_usu');
                $docentecompleto=$nombredocente.' '.$apellidocente.'';
                //dd($docentecompleto,$request -> ci_usu);
                $bitacora= new ModelBitacora;
                $observacion='Se ha creado un nuevo docente: '.$docentecompleto.' '; 
                $bitacora->registra($idbit,$accion,$observacion,$name);
            $rolee=$request -> id_rol;

            $cuentarol=count($rolee);
            //dd($rolee,$cuentarol);

            if($cuentarol>0){

            foreach ($request -> id_rol as $id) {
                //dd($id);
                $rol = ModelRol::find($id);  
                    
                    if ($rol->id_rol == '5') {

                        //se guarda toda la informacion en la MasterPuente

                        $uc = ModelUnidadCurricular::find($request->materia);

                        $secc = 'NULL';  

                        //Guardo el registro en la MasterPuente
                            //con los datos del usuario, seccion, unidad y le indico que es coordinador
                                  
                      foreach ($uc as $uc) {

                            if (!is_null($uc)) {

                                $usuario->MasterPuente_User_UniCrr()->attach($uc, ['cod_seccion'=>$secc, 'coordinador'=>'TRUE']);
                            }
                        }
                        //Aqui guardo los roles
                        if (!is_null($rol)) {
                            $usuario->roles()->attach($rol);
                        }                                     
                    }

                    else{

                        if (!is_null($rol)) {
                            $usuario->roles()->attach($rol);
                        }
                    }      
            }
            }
            else{

            }
                try{$usuario->generatenotify((new InvoicePaid($usuario)));
                          
                        } catch (\Exception $e) {
                         // dd('error');
                          
                        }
            
            
            

        return redirect('Usuario/G_usu');
    }
    }
    public function mostrarperfil()
    {
        $id = Auth::user() -> id; 

        $usuario_edit = User::find($id);
        return view('Usuario/editarperfil')->with(['mod_usuario' => $usuario_edit,'editar' => true]);
    
    }
    public function EditarPerfil(Request $request)
    {
         $this->validate($request, [
            'name' => 'required',
            'ci_usu' => 'required',
            'ape_usu'=> 'required',
            'tlf'=> 'required',
            'email'=> 'required',
            'img_perfil'=> 'required',

        ]);
            $idbit = Auth::user() -> ci_usu;
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='modificar.usuario'; 
            $id = Auth::user() -> id; 

            $usuario = User::find($id);
        
            $usuario -> name = $request -> name;
            $usuario -> ci_usu = $request -> ci_usu;
            $usuario -> ape_usu = $request -> ape_usu;
            $usuario -> tlf = $request -> tlf;
            $usuario -> email = $request -> email;
            $usuario -> password = bcrypt($request -> password);

            if($request->img_perfil == 'usericon.png') {
              $img = $request->img_perfil;  
              $file_route = time().'_'.$img;
              Storage::disk('img_perfil')->delete($request->img);
              $usuario -> img_perfil = $img;         
             }
            else{
              $img = $request -> file('img_perfil'); 

              $file_route = time().'_'.$img->getClientOriginalName();

              Storage::disk('img_perfil')->put($file_route, file_get_contents( $img->getRealPath() ) );
              Storage::disk('img_perfil')->delete($request->img);
                //Mando al disco a eliminar la imagen segun el nombre que resivo median la vista de modificar
                //esto para evitar que quede guardado en el mismo luego de averlo modificarlo del registro

                $usuario -> img_perfil = $file_route;         
                //le asigno a la variable $noticia la variable que deseamos guardar. #Recordemos que esta variable tiene el nombre imagen# code...
             }

            
             //GUARDO EN BITACORA///
                $nombredocente=DB::table('users')->where('ci_usu',$request -> ci_usu)->value('name');
                $apellidocente=DB::table('users')->where('ci_usu',$request -> ci_usu)->value('ape_usu');
                $docentecompleto=$nombredocente.' '.$apellidocente.'';
                //dd($docentecompleto,$request -> ci_usu);
                $bitacora= new ModelBitacora;
                $observacion='Se ha Editado al docente: '.$docentecompleto.' '; 

                $bitacora->registra($idbit,$accion,$observacion,$name);
           
          ////////////////////////////////


        $usuario -> save();
        Flash::success('¡Perfil Modificado Sastifacctoriamente!');

        return redirect('/home');


    }

    public function update(Request $request, $id)
    {
        /****************
        *Utilizo la misma funcion de agregar solo 
        *que con algunas modification
        *****************/
    //dd($request,$id);    

        $this->validate($request, [
            'name' => 'required',
            'ci_usu' => 'required',
            'ape_usu'=> 'required',
            'tlf'=> 'required',
            'email'=> 'required',
            'img_perfil'=> 'required',
            'id_rol'=> 'required',
        ]);


        $idbit = Auth::user() -> ci_usu;
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $name=$nom.' '.$ape.'';
            $accion='modificar.usuario'; 

            $mateexiste=$request->materia;

            if(isset($mateexiste)){
                    
                foreach ($mateexiste as $mate) {    
                
                $existente = DB::table('mpuentemasters')->where('cod_unidad', $mate)->where('coordinador', 'TRUE')->where('id_usu', '!=' , $id)->where('id_usu','!=','2')->pluck('id_uc_sec');
                $count=count($existente);


                    if($count>0){

                        $name=ModelUnidadCurricular::find($mate);

                        $mensaje='Ya existen coordinadores para la unidad:' . '' . $name->nom_uc.'';
                         return back()->with('msjerr', $mensaje);  
                    }
                    else{
                    
                    }
                }
            }

        $usuario = User::find($id);
        
            $usuario -> name = $request -> name;
            $usuario -> ci_usu = $request -> ci_usu;
            $usuario -> ape_usu = $request -> ape_usu;
            $usuario -> tlf = $request -> tlf;
            $usuario -> email = $request -> email;

        if($request->img_perfil == $usuario->img_perfil) {
              $img = $request->img_perfil;  
              $file_route = time().'_'.$img;
              $usuario -> img_perfil = $img;         
        }
        else{
              $img = $request -> file('img_perfil'); 

              $file_route = time().'_'.$img->getClientOriginalName();

              Storage::disk('img_perfil')->put($file_route, file_get_contents( $img->getRealPath() ) );
              Storage::disk('img_perfil')->delete($request->img);
                //Mando al disco a eliminar la imagen segun el nombre que resivo median la vista de modificar
                //esto para evitar que quede guardado en el mismo luego de averlo modificarlo del registro

                $usuario -> img_perfil = $file_route;         
                //le asigno a la variable $noticia la variable que deseamos guardar. #Recordemos que esta variable tiene el nombre imagen# code...
             }

        $usuario -> save();
       // /GUARDO EN BITACORA///
                $nombredocente=DB::table('users')->where('ci_usu',$request -> ci_usu)->value('name');
                $apellidocente=DB::table('users')->where('ci_usu',$request -> ci_usu)->value('ape_usu');
                $docentecompleto=$nombredocente.' '.$apellidocente.'';
                //dd($docentecompleto,$request -> ci_usu);
                $bitacora= new ModelBitacora;
                $observacion='Se ha Editado al docente: '.$docentecompleto.' '; 

                $bitacora->registra($idbit,$accion,$observacion,$name);
           
          ////////////////////////////////

        $rol = $request -> id_rol;
        $cantirole= count($rol);
        //dd($cantirole);
            //cuento roles que entran por request, si hay los sincroniza,si no hay los elimina
            if($cantirole > 0){
                $usuario->roles()->sync($rol);
            }
             
             if($cantirole==0)
            {
                $usuario->roles()->detach($rol);
            }


            $asignadas = DB::table('mpuentemasters')->where('id_usu', $id)->where('coordinador', 'TRUE')->pluck('cod_unidad');
            //asigno unidades de user
            $uc = ModelUnidadCurricular::all();//Asigno todas las unidades a colleccion
            //dd($materias, $uc);
            //dd($asignadas);
            $secc='NULL';

                $materias=$request->materia;
           // dd($asignadas,$materias);
                $cuentamateria=count($materias);
                #SI NO HAY MATERIAS SE BORRAN LAS ASIGNACIONES QUE TENIA ANTES
                    if($cuentamateria==0){  
                    $cuentaasignada=count($asignadas);  
                            if($cuentaasignada>0){
                            foreach ($asignadas as $asig) {
                                
                              $puentetabla=DB::table('mpuentemasters')->where('id_usu',$id)->where('cod_seccion',$secc)->where('cod_unidad',$asig)->where('coordinador', 'TRUE')->value('id_uc_sec');
                                    DB::table('mpuentemasters')
                                    ->where('id_uc_sec', $puentetabla)
                                    ->update(['id_usu' => 2]);

                                                  
                                
                            }
                        }

                    }

                foreach ($rol as $key){
                
                    //dd($key,$rol);
                    if ($key==5 && $cuentamateria>0) {
                     //echo "dsad".$key."";

                        foreach ($materias as $mat) {
                        
                    //---Si ya tiene materias salta, sino registrala//
                            if($usuario->tieneUCCor($mat,$id)) {   
                               // dd($mat.$usuario);
                            }
                            else{   
                                     $puentetabla=DB::table('mpuentemasters')->where('cod_seccion',$secc)->where('cod_unidad',$mat)->where('id_usu',2)->where('coordinador', 'TRUE')->value('id_uc_sec');

                                     $cuenta=count($puentetabla);
                                     //
                                //dd($cuenta,$puentetabla);
                                     //si encuentra materias registradas sin cordinador lo asigna al elegido
                                     if($cuenta > 0){
                                        

                                        //dd($id);
                                    DB::table('mpuentemasters')
                                    ->where('id_uc_sec', $puentetabla)
                                    ->update(['id_usu' => $id]);
                                    }
                                    //si no encuentra registros los crea con el id del modificado
                                    if($cuenta<=0){
                                       // dd('dsad');
                                         $usuario->MasterPuente_User_UniCrr()->attach($mat, ['cod_seccion'=>$secc, 'coordinador'=>'TRUE','id_usu'=>$id]);

                                    }
                              
                              
                                }
                        
                          foreach ($asignadas as $asig){

                            if (in_array($asig, $materias)){

                            }
                            else{
                                $puentetabla2=DB::table('mpuentemasters')->where('cod_seccion',$secc)->where('cod_unidad',$asig)->where('id_usu',$id)->where('coordinador', 'TRUE')->value('id_uc_sec');

                                    DB::table('mpuentemasters')
                                    ->where('id_uc_sec', $puentetabla2)
                                    ->update(['id_usu' => 2]);
                                }
                            }
                    }
                    
                    
            }    

            
       /* if(  ){ 
            return redirect('Usuario/G_usu')->with('msj', 'Datos Modificados');
            //mando redireccionar a la vista luego de haber modificado todos los datos
        } else {
            return back()->with('msjerr', 'Los datos no se Guardaron');
        }*/   
    }
    return redirect('Usuario/G_usu');

   
   }    
    public function destroy($id)
    {
            $idbit = Auth::user() -> ci_usu;
            $nom=Auth::user() -> name;
            $ape=Auth::user() -> ape_usu;
            $validarno=Auth::user() -> id;

            $name=$nom.' '.$ape.'';
            $accion='eliminar.usuario'; 
            $nombredocente=DB::table('users')->where('id',$id)->value('name');
            $apellidocente=DB::table('users')->where('id',$id)->value('ape_usu');
            $docentecompleto=$nombredocente.' '.$apellidocente.'';
           // dd($validarno,$id);
            if($id==$validarno){
                Flash::warning('<h4><b>No puede borrarse así mismo</b><h4>');

                  return back();
              }
            else{
                User::destroy($id);

             //GUARDO EN BITACORA///
               
                //dd($docentecompleto,$request -> ci_usu);
                $bitacora= new ModelBitacora;
                $observacion='Se ha Eliminado al docente: '.$docentecompleto.' '; 

                $bitacora->registra($idbit,$accion,$observacion,$name);
           
          ////////////////////////////////
            Storage::disk('img_perfil')->delete($id);//tengoque eliminar las imagenes
            return redirect('Usuario/G_usu');            
        }
    }
   //////////////////Bitacora

    public function Bitacora()
    {
        $listaBitacora = ModelBitacora::all();
        $cuenta = count($listaBitacora);
                
        return view('Bitacora/G_Bitacora')->with(['listaBistacora' => $listaBitacora, 'cuenta' => $cuenta]);
    }
    public function create()
    {}


    public function store(Request $request)
    {}

    public function show($id)
    {}
}
