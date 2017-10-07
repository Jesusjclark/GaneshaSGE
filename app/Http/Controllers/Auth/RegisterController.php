<?php

namespace GaneshaSIGE\Http\Controllers\Auth;

use GaneshaSIGE\User;
use GaneshaSIGE\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Storage;
use GaneshaSIGE\ModelUnidadCurricular;
use GaneshaSIGE\ModelRol;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'Usuario/G_usu';

    public function mostrar()
    { 

        $roles = ModelRol::all();
        //Creo una variable la cual Me trae toda la informacion que contiene la base de datos
        $uc = ModelUnidadCurricular::all();

        //$ejes = ModelEje::all();
        //Creo una variable la cual Me trae toda la informacion que contiene la base de datos
        return view('auth/register')->with(['roles' => $roles, 'uc' => $uc]);

        //Y Retorno a la vista una variable a la cual le asigno lo que contiene la variable anterior creada
    }
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:15',
            'ape_usu' => 'required|max:15',
            'ci_usu' => 'required|digits:8|numeric|unique:users',
            'email' => 'required|email|max:30|unique:users',
            'password' => 'required|min:6|confirmed',
            'tlf'  => 'required|numeric|digits:11',

          //'img_perfil'      => 'required'|'regex:/^(.*.{1}(jpg|jpeg|png))$/i',   //^(.*.(jpg|jpeg|png|gif))$/i'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function username()
        {
        return 'ci_usu';
 }
    protected function create(array $data)
    {
        //-- Esta parte es para guardar los Archivos en la BD y en el disco --//

                $usuario = new User();

        if ($data['img_perfil'] == 'usericon.png') {
            $img = $data['img_perfil'];
            $usuario = $img;            
            //le asigno a la variable $noticia la variable que deseamos guardar. #Recordemos que esta variable tiene el nombre imagen# code...
        }
        else{
           $img = $data['img_perfil'];
            //$variable_nmb = $lo_que_resibe_por_request -> Funcion[ file('nombre_del_input_file')] 

            $file_route = time().'_'.$img->getClientOriginalName();
            //nmb_variable = funcion time().'_'.$variable_nmb->funcion getClientOriginalName()
            //la idea de agregar la hora de el nobre de la imagen es para identificarla de de otra img igual 

            Storage::disk('img_perfil')->put($file_route, file_get_contents( $img->getRealPath() ) );
            //Le decimos a la clase Storage que guarde el archivo en el disco que anteriormente creamos, la funcion ::put:: le ingresa la ruta mas el contenido que contiene la variable img el cual sera la imagen
            $usuario = $file_route;
            //le asigno a la variable $noticia la variable que deseamos guardar. #Recordemos que esta variable tiene el nombre imagen# code...
        }
             

        return User::create([
            'name' => $data['name'],
            'ci_usu' => $data['ci_usu'],
            'ape_usu' => $data['ape_usu'],
            'tlf' => $data['tlf'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'img_perfil' => $usuario,
        ]);
         //-- Hasta aqui la funcion para guardar los archivos --//# code...
    
        
    }
}
