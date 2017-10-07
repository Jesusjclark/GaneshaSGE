<?php
use GaneshaSIGE\ModelEstudiante;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|  
*/
Route::group(['middleware'=>'permisos'],function(){

	//Gestion usuarios
		Route::get('/auth/registrar', 'Auth\RegisterController@mostrar')->name('crear.usuario');
		Route::get( '/Usuario/Asignacion_Unidades', 'controllerusers@MostrarAsignaciones')->name('asignar.usuario');
		Route::post('controllerusers/actualizarasignaruc', 'controllerusers@actualizarasignaruc')->name('asignar.usuario');
		Route::post('controllerusers/asignaruc', 'controllerusers@asignaruc')->name('asignar.usuario');
		Route::post('/Usuario/crear', 'controllerusers@agregar')->name('crear.usuario');
		Route::get('Usuario/G_usu', 'controllerusers@mostrar')->name('consultar.usuario');
	
	//////RUTAS UNIDAD CURRICULAR/////////////
		Route::post('controllerunidadcurriculars/{cod_uc_pnf}', 'controllerunidadcurriculars@agregar')->name('crear.uc');

		Route::get('/controllerunidadcurriculars/{cod_uc_pnf}/eliminar', 'controllerunidadcurriculars@eliminar')->name('eliminar.uc');

	///RUTAS SECCIONES///
		Route::post('controllersecciones/{cod_sec}', 'controllersecciones@agregar')->name('crear.seccion');
		Route::get('/controllersecciones/{cod_sec}/eliminar', 'controllersecciones@eliminar')->name('eliminar.seccion');

	//RUTAS NOTAS
		Route::get('/controllernotas/edit/{id_eva}/{id_uc_sec}', 'controllernotas@Mostrarmodificarnotas')->name('modificar.nota');
		Route::post('/Modificar/Notas', 'controllernotas@ModificarNotas')->name('modificar.nota');
		Route::get('/controllernotas/correo/{id_eva}/{id_uc_sec}', 'controllernotas@enviarcorreo')->name('publicar.nota');
		Route::post('/Asignar/notas', 'controllernotas@GuardarNotas')->name('asignar.nota');
		Route::get('/Notas/Transcripcion', 'controllernotas@transcripcionesMostrar')->name('transcribir.nota');

		Route::post('/transcribir/notas', 'controllernotas@Transcripcion')->name('transcribir.nota');


	///RUTAS INSTRUMENTOS
		Route::post('controllerinstrumentos/{id_inst}', 'controllerinstrumentos@agregar')->name('crear.instrumentos');

		Route::get('/controllerinstrumentos/{id_inst}/eliminar', 'controllerinstrumentos@eliminar')->name('eliminar.instrumentos');

	//RUTAS DE ROLES
		Route::post('controllerroles/{id_rol}', 'controllerroles@agregar')->name('crear.rol');
		Route::get('/controllerroles/{id_rol}/eliminar', 'controllerroles@eliminar')->name('eliminar.rol');

		//Route::post('/controllerroles/modificar', 'controllerroles@updates')->name('modificar.rol');


	//RUTAS ALUMNOS
		Route::post('/ajax-estudianteelimi{id_sec_est}', 'controlleralumnos@eliminar')->name('eliminar.alumno');
		Route::post('/controlleralumnos/listado', 'controlleralumnos@archivo')->name('subir.listado');
		Route::post('/controlleralumnos/listadoact', 'controlleralumnos@archivoactualizar')->name('modificar.listado');
		Route::post('/guardar_alumnos_manual', 'controlleralumnos@guardar_alumnos_manual')->name('agregar.alumnomanual');
		Route::post('/modificar_alumnos_manual', 'controlleralumnos@modificar_alumnos_manual')->name('modificar.alumnomanual');
	
	//RUTAS EJES
		Route::get('/controllerejes/{cod_eje}/eliminar', 'controllerejes@eliminar')->name('eliminar.ejes');
		Route::post('controllerejes/{cod_eje}', 'controllerejes@agregar')->name('crear.ejes');

	//RUTA PLANES
		Route::get( 'Plan_Evaluaciones/{id_plan}/Asignar', 'controllerplanevaluaciones@Asignar')->name('asignar.planhijo');
		Route::post('controllerplanevaluaciones/{id_plan}', 'controllerplanevaluaciones@agregar')->name('crear.planmaestro');
		Route::post('modificarplanevaluaciones/{id_plan}', 'controllerplanevaluaciones@update2')->name('modificar.planhijo');
		Route::get( 'Plan_Evaluaciones/imprimirMaster/{cod_unidad}', 'controllerplanevaluaciones@imprimirmaster')->name('imprimir.plan');
		Route::get('/controllerplanevaluaciones/{id_plan}/eliminar', 'controllerplanevaluaciones@eliminar')->name('eliminar.plan');
		Route::get( 'Plan_Evaluaciones/imprimir/{id_plan}', 'controllerplanevaluaciones@imprimir')->name('imprimir.plan');;
     	

});


///RUTAS PUBLICAS////////////*********************

	//HOME
		Route::get('/', function () {
		    return view('welcome');
		})->name('welcome');

		Route::get('/home', 'HomeController@index');

	//PERFIL
		Route::get('/edit/perfil/', 'controllerusers@mostrarperfil');

		Route::post('/edicion/perfils', 'controllerusers@EditarPerfil');

	//ALUMNOS
		Route::get('/Consulta/Alumnos', function () {
		    return view('/Alumnos/ConsultaNotasAlumnos');
		});
		Route::post('/Consulta/Alumnos_Nota', 'controllernotas@consultanotaestu');

		Route::get('/passw', function () {
	    return view('Usuario/recuperarpassword');
	});

 

	//RUTA CORREO
		Route::get('/correo/pruebacorreo', 'emailcontroller@mostrarprueba');
		Route::get('/correo/enviar_correo', 'emailcontroller@enviar');

	///RUTAS INSTRUMENTOS//
		Route::get('/instrumentos/vista', 'controllerinstrumentos@mostrar');

	///RUTA UNIDADCURRICICULAR
		Route::get( 'Uni_Crr/G_uc', 'controllerunidadcurriculars@mostrar');

	///RUTAS NOTAS//
		Route::get('/controllernotas/{id_eva}/{id_uc_sec}', 'controllernotas@VerificaNota');
		Route::get('/verificar/AprovadosReprobado/{id_uc_sec}', 'controllernotas@verificarAprovadosReprobado');
		Route::get('/Notas/G_notas', 'controllernotas@mostrar');
		Route::get('/Notas/Estadisticas', 'controllernotas@AprobadosReprobados');

		Route::post('/transcribir/corte', 'controllernotas@Corte');

	///RUTAS ROLES//
		Route::get('/roles/vista', 'controllerroles@mostrar');
	//RUTAS SECCIONES
		Route::get('/Secciones/G_Secciones', 'controllersecciones@mostrar');


	Auth::routes();
////////////////////////////////////////*********************






//Route::post('/notifications/', 'NotificationController');
		
	//RUTAS DE VISTA Para Consulta de Notas ALUMNOS
	Route::get('/Consulta/Alumnos', function () {
	    return view('/Alumnos/ConsultaNotasAlumnos');
	});
	Route::post('/Consulta/Alumnos_Nota', 'controllernotas@consultamasterestu');
	Route::get('/ajax-master/{id_master}/{ci_est}', 'controllernotas@consultanotaestu');


	//////RUTAS ALUMNOS/////////////
	Route::get('/alumnos/vista', 'controlleralumnos@mostrar');
	Route::get('/ajax-estudiante',function(){
		$est_ci = Input::get('est_ci');
		$ced_est[] = ModelEstudiante::find($est_ci);
		return Response::json($ced_est);
	});
	Route::post('/controlleralumnos/{id_uc_sec}/verifica', 'controlleralumnos@verifica');
	Route::post('/cargar_datos_usuarios', 'controlleralumnos@cargar_datos_usuarios');

	
	
  //////rutas de Plan de Evaluacion/////////////
    
    /////Rutas Planes Maestros////////
    Route::get( 'Plan_Evaluaciones/Gestion_master', 'controllerplanevaluaciones@MostrarMaestro');
	Route::post( 'Plan_Evaluaciones/{id_plan}', 'controllerplanevaluaciones@modificar');
    Route::get('/controllerplanevaluaciones/{cod_unidad}', 'controllerplanevaluaciones@verificar');

   
      
     

    ////Rutas Planes Hijos////
     Route::get( 'Plan_Evaluaciones/Gestion_Planes', 'controllerplanevaluaciones@MostrarPlan');
      Route::get('controllerplan/{cod_unidad}', 'controllerplanevaluaciones@verificarPlan');


	/////rutas de Ejes/////////////
	Route::get( 'Ejes/G_ejes', 'controllerejes@mostrar');


	//////Rutas de Usuario/////////
	Route::post( 'mi_ruta_post', 'controllerusers@accion');
	Route::post( '/pass', 'controllerusers@resetpass');
	Route::get('/controllerusers/{cod_uc_pnf}', 'controllerusers@asignaciones');
	Route::get('Bitacora', 'controllerusers@Bitacora');

	//////Rutas de Vistar/////////
	Route::resource('/controllerplanevaluaciones', 'controllerplanevaluaciones');
	Route::resource('/controllerejes', 'controllerejes');
	Route::resource('/controllerunidadcurriculars', 'controllerunidadcurriculars');
	Route::resource('/controllerusers', 'controllerusers');
	Route::resource('/controllerinstrumentos', 'controllerinstrumentos');
	Route::resource('/controllerroles', 'controllerroles');
	Route::resource('/controlleralumnos', 'controlleralumnos');
	Route::resource('/controllersecciones', 'controllersecciones');

	//Route::get('/controlleralumnos/{id_uc_sec}/manual', 'controlleralumnos@muestramanual');


	//Route::get('form_cargar_datos_usuarios', 'controlleralumnos@form_cargar_datos_usuarios');

