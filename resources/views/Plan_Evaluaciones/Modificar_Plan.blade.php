 
@if(isset($uni_crr))
	@if(isset($instrumentos))
		@foreach($uni_crr as $uc)
					<div class="modal fade" data-backdrop=”static” data-keyboard=”false” id="ModificarPlan" role="dialog">
						<div class="modal-plan">
							<div class="modal-content">
								<div class="modal-header"> 
								    <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
									<div class="box-header with-border">
										<h3 class="box-title">Modificar Plan de evaluacion a {{$uc->nom_uc}}</h3>
									</div>
				        <!--Hidenssss-->
								    <form name="fo" method="POST" action="/modificarplanevaluaciones/{{$id_plan}}">
				                    	{{ csrf_field() }}

								        <input class="evas hide" type="number" value="{{count($evaluaciones)}}">
									    <div class="modal-body">

											<div class="box box-info">
									            <div class="box-header with-border">
									              	<h3 class="box-title">
										            	Informacion del Plan
										            </h3>
									              	<div class="box-tools pull-right">
									                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
									                        <span class="caret"></span>
									                    </button>
									                </div>
									            </div>
									            <div class="box-body table-responsive no-padding">
									            	<table class="table table-bordered">
						                				<tr>
										                    <th style="width: 150px;">Unidad Curricular:<label> 
										                    {{$uc->nom_uc}}</label></th>
												            <th style="width: 50px;">Trayecto:<label>
												            @if($uc->trayecto==0)
												            	Inicial
												            @endif
												            @if($uc->trayecto==1)
												            	I
												            @endif
												            @if($uc->trayecto==2)
												            	II
												            @endif
												            @if($uc->trayecto==3)
												            	III
												            @endif
												            @if($uc->trayecto==4)
												            	IV
												            @endif
												            </label></th>
												            <th style="width: 30px;">Fase:<label> @if($uc->periodo=='true') I @else II @endif</label></th>
											                <th style="width: 90px;">Densidad:<label> Semanal</label></th>
										                    <th style="width: 90px;">Hora Acad.:<label>{{$uc->hta}}</label></th>
										                    <th style="width: 30px;">HTE:<label> {{$uc->hte}}</label></th>
										                    <th style="width: 30px;">HTT:<label> {{$uc->htt}}</label></th>
											            </tr>
											        </table>
									                <table class="table table-bordered">
											            <tr>
											            	<th style="width: 151px;">
											            		Profesor: 
											            		<label>
											            			@foreach($usuario as $usu)
																		{{$usu->name}}
										               				@endforeach
																</label>
															</th>
								           					<th style="width: 150px;">Lapso:<label> I-2017</label></th>
											            </tr>
											        </table>
								            	</div>
					  <!-- /.table-responsive -->
											</div>
											<div class="box box-info  collapsed-box">
									            <div class="box-header with-border">
									              	<h3 class="box-title">
										            	Modificar Evaluaciones
										            </h3>
									              	<div class="box-tools pull-right">
									                    <button type="button" class="tu btn btn-box-tool" data-widget="collapse">
									                        <span class="caret"></span>
									                    </button>
									                </div>
									            </div>
									            <!-- /.box-header -->
									            <div class="box-body table-responsive no-padding">
									            	<div>  
										            	<button type="button" class="boton btn btn-primary btn-xs" disabled>Nueva Evaluacion</button>
										            	
										            	Cantidad de Puntos a Evaluar esta fase <input type="number" style="width: 40px;" maxlength="2" minlength="1" onKeyPress="return soloNumeros(event)" required   id="puntos" value="0" max="20" min="10" size="2" onblur="canti()">
<input type="text" id="fecas" class="hide" value="<?php echo date("Y-m-d");?>" ></td>
										            	|| Puntos Restantes: <input type="text" id="quedan" max="2" size="2" disabled>
										            	|| Lleva: <input type="text" id="llevo" max="2" size="2" disabled> Puntos 
									            	</div>  
									                <table class="tablaModi"  border="1" cellpadding="0" cellspacing="0" id="Coleccion" value="hola">
						                				<thead>
							                				<tr>
											                    <th style="width: 40px;"><center>Unidad</center></th>
											                    <th style="width: 40px;"><center>Eliminar</center></th>
											                    <th style="width: 40px;"><center>Rezagada</center></th>
													            <th style="width: 150px;"><center>Contenido</center></th>
													            <th>
													            	<table class="table">
													            		<tr><center>Estrategias de Evaluación</center></tr>
													            		<tr>
													            			<td style="width: 40px;"><center>Tecnicas</center></th>
													            			<td style="width: 40px;"><center>Instrumento</center></th>
													            			<td style="width: 100px;"><center>Criterios Evaluetivos</center></th>
													            		</tr>
													            	</table>
													            </th>
												                <th>							            	
												                	<table class="table">
													            		<tr><center>Forma de Participacion</center></tr>
													            		<tr>
													            			<td style="width: 10px;"><center>A</center></td>
													            			<td style="width: 10px;"><center>C</center></td>
													            			<td style="width: 10px;"><center>D</center></td>
													            		</tr>
													            	</table>
													            </th>
											                    <th style="width: 70px;"><center>Fecha</center></th>
											                    <th style="width: 70px;"><center>Ponderación</center></th>
											                    <th style="width: 150px;"><center>Observacion</center></th>
												            </tr>
												        </thead>
												        <tbody class="Evaluaciones" >

														</tbody>								            
											        </table>
								            	</div>
								            </div>
							            	<div class="modal-footer">
												<button type="button" class="btn btn-primary btn-xs" data-dismiss="modal">Cancelar</button>
							        			<button type="submit" class="guardar btn btn-primary btn-xs" disabled>Guardar</button>
							            	</div>
								        </div>
							        </form>
							    </div>
							</div>
						</div>
					</div>
		@endforeach
	@endif
@endif




@section('customjs')

<script>

var nuevoValor = 0;
var pond = 0;
var quedan =0;       
var iCnt = 0;   //controla la cantidad de tr
var puntos = 0;    //controla la cantidad de boton eliminar
var posicion = {{ count($evaluaciones) }};
var e = 0;
var pondeTotal = 0;

/////Para Mostrar las Evaluaciones que ya estan registradas para este plan
$(window).load(function() { 

	@foreach($evaluaciones as $eva)
	        // sumo el tr nuevo al control
		iCnt = iCnt + 1;

		//tomo todas las notas que trae el plan
	        pondEva = {{ $eva->ponderacion }};
	        pondeTotal = pondeTotal + pondEva;

	    @if($eva->fec_res != '2000-01-01')
	    //creo una nueva fila
	    var fila='<tr id="xD'+ iCnt +'" ><td style="width: 40px;">{{ $eva->unidad }}</td>'+
		    		'<td style="width: 40px;"><center><button type="button" name="Eliminar" id="'+iCnt+'" onclick="eliminar(this)" class="btn btn-danger btn-xs" disabled><img src="/img/iconos/16x16/cancel.png"></button></center></td>'+
		    		'<td style="width: 40px;"><center><button type="button" name="Rezagada" id="'+iCnt+'" onclick="rezagar(this)" class="btn btn-warning btn-xs reza'+iCnt+'" disabled><img src="/img/iconos/16x16/check.png"></button><input class="hide" type="text" name="rezaga[]" id="Rezagada'+iCnt+'" value="0"></center></td>'+
		             '<td style="width: 200px;">{{ $eva->contenido }}</td>'+
		             '<th><table class="table">'+
		                    '<tr><td style="width: 140px;"><center>{{ $eva->tecnica }}</center></td>'+
		                         '<td style="width: 40px;"><center>@foreach($instrumentos as $in)@if($in->id_inst == $eva->id_inst_eva)'+
		             '<input class="hide" type="text" name="id_inst[]" value="{{$in->id_inst}}" >'+
		                          '{{$in->tip_inst}} @endif @endforeach</center></td>'
		                         +'<td style="width: 200px;"><center>{{ $eva->criterio }}</center></td>'+'</tr></table></th>'+
		             '<th><table class="table">'+'<tr><td style="width: 10px;"><input type="checkbox" name="A"value="TRUE"><input type="checkbox" name="C" value="TRUE" ><input type="checkbox" name="D" value="TRUE" ></td>'+'</tr></table></th>'+
		             
		             '<td style="width: 30px;">{{ $eva->fec_prop}}</td>'+
		             
		             '<td style="width: 70px;">{{ $eva->ponderacion }}</td>'+
		             '<td style="width: 200px;">{{ $eva->observacion }}'+
		             ///Hiden
		             '<input class="hide" type="text" name="unidad[]" value="{{ $eva->unidad }}" >'+
		             '<input class="hide" type="text" name="id_eva[]" value="{{ $eva->id_eva }}" >'+
		             '<input class="hide" type="text" name="contenido[]" value="{{ $eva->contenido }}" >'+
		             '<input class="hide" type="text" name="tecnica[]" value="{{ $eva->tecnica }}" >'+
		             '<input class="hide" type="text" name="criterio[]" value="{{ $eva->criterio }}" >'+
		             '<input class="hide" type="text" name="semana[]" value="{{ $eva->fec_prop}}" >'+
		             '<input class="hide" type="text" name="ponderacion[]" value="{{ $eva->ponderacion }}" >'+
		             '<input class="hide" type="text" name="observacion[]" value="{{ $eva->observacion }}" >'+'</td>'+'</tr>';
	    $('.Evaluaciones').append(fila);
		
		@else
			    		    var fila='<tr id="xD'+ iCnt +'" ><td style="width: 40px;"><input type="text" pattern="[0-9]" name="unidad[]" id="unidad'+iCnt+'" value="{{ $eva->unidad }}" size="2" maxlength="2" minlength="1" onKeyPress="return soloNumeros(event)" required autofocus onchange="agregarobservacion(this)"></td>'+
		    		'<td style="width: 40px;"><center><button type="button" name="Eliminar" id="'+iCnt+'" onclick="eliminar(this)" class="btn btn-danger btn-xs"><img src="/img/iconos/16x16/cancel.png"></button></center></td>'+
		    		'<td style="width: 40px;"><center><button type="button" name="Rezagada" id="'+iCnt+'" onclick="rezagar(this)" class="btn btn-warning btn-xs"><img src="/img/iconos/16x16/check.png"></button></center><input class="hide" type="text" name="rezaga[]" id="Rezagada'+iCnt+'" value="0"></td>'+
		             '<td style="width: 200px;"><input class="hide" type="text" name="id_eva[]" value="{{ $eva->id_eva }}" ><textarea name="contenido[]" id="contenido'+iCnt+'" onkeypress="return soloLetras(event)" minlength="4" required autofocus style="width: 200px; height: 80px;" onchange="agregarobservacion(this)" required>{{ $eva->contenido }}</textarea></td>'+
		             '<th><table class="table">'+
		                    '<tr><td style="width: 40px;"><center><input type="text" name="tecnica[]" id="tecnica'+iCnt+'" size="20" value="{{ $eva->tecnica }}" onkeypress="return soloLetras(event)" maxlength="25" minlength="4" placeholder="Ej. Observación" required autofocus onchange="agregarobservacion(this)"></center></td>'+
		                         '<td style="width: 40px;"><select simple="simple" id="id_inst'+iCnt+'" name="id_inst[]" required>'+'@foreach($instrumentos as $in)'+'<option @if($in->id_inst == $eva->id_inst_eva) selected @endif  value="'+{{$in->id_inst}}+'">'+'{{$in->tip_inst}}'+'</option>@endforeach'+'</select>'+'</td>'
		                         +'<td style="width: 200px;"><textarea name="criterio[]" id="criterio'+iCnt+'" style="width: 200px; height: 80px;" onchange="agregarobservacion(this)"  onkeypress="return soloLetras(event)" required autofocus>{{ $eva->criterio }}</textarea></td>'+'</tr></table></th>'+
		             '<th><table class="table">'+'<tr><td style="width: 10px;"><input type="checkbox" name="A"value="TRUE"><input type="checkbox" name="C" value="TRUE" ><input type="checkbox" name="D" value="TRUE" ></td>'+'</tr></table></th>'+
		             
		             '<td style="width: 30px;">'+'<input type="date" value="{{ $eva->fec_prop}}" class="fec'+iCnt+'" name="semana[]" size="7"  onfocus="tomo_fec(this)" onchange="date(this)" id="'+iCnt+'" required>'+
		             
		             '<td style="width: 70px;">'+'<input type="text" id="ponderacion'+iCnt+'" name="ponderacion[]"  onchange="controlpon(this)" onfocus="tomo_pon(this)" class="'+iCnt+'" value="{{ $eva->ponderacion }}" size="2"  max="5" min="1" maxlength="2" minlength="1" onKeyPress="return soloNumeros(event)" required autofocus> <label class="ptos"> Ptos</label>'+'</td>'+
		             '<td style="width: 200px;"><textarea name="observacion[]" id="observacion'+iCnt+'" class="observacion'+iCnt+'" style="width: 200px; height: 80px;" onchange="observacion()" required>{{ $eva->observacion }}</textarea></td>'+'</tr>';


	    $('.Evaluaciones').append(fila);

		@endif
	    //añado fila a la tabla 
    @endforeach

});

//Para agregar una nueva evaluacion al plan
$('.boton').click(function() { 

 //lo tranformo a numerico
    iCnt = iCnt + 1;    // sumo el tr nuevo al control
    //creo una nueva fila
	    var fila='<tr id="xD'+ iCnt +'" ><td style="width: 40px;"><input type="text" name="unidad[]" id="'+iCnt+'" size="2"  maxlength="2" minlength="1" onKeyPress="return soloNumeros(event)" required autofocus></td>'+
	    		'<td style="width: 40px;"><center><button type="button" name="Eliminar" id="'+iCnt+'" onclick="eliminar(this)" class="btn btn-danger btn-xs"><img src="/img/iconos/16x16/cancel.png"></button></center></td>'+
	    		'<td style="width: 40px;"><center><button type="button" name="Rezagada" id="reza'+iCnt+'" onclick="rezagar(this)" class="btn btn-warning btn-xs" disabled><img src="/img/iconos/16x16/check.png" ></button></center></td>'+
	             '<td style="width: 200px;"><input class="hide" type="text" name="id_eva[]"><textarea name="contenido[]" id="'+iCnt+'" onkeypress="return soloLetras(event)" minlength="4" required autofocus  style="width: 200px; height: 80px;"></textarea></td>'+
	             '<th><table class="table">'+
	                    '<tr><td style="width: 40px;"><center><input type="text" name="tecnica[]" size="20"  id="'+iCnt+'" onkeypress="return soloLetras(event)" maxlength="25" minlength="4" placeholder="Ej. Observación" required autofocus></center></td>'+
	                         '<td style="width: 40px;"><select simple="simple" name="id_inst[]" required>'+'@foreach($instrumentos as $in)'+
	            '<option value="'+{{$in->id_inst}}+'">'+'{{$in->tip_inst}}'+'</option>@endforeach'+'</select>'+'</td>'+'<td style="width: 200px;"><textarea name="criterio[]" id="'+iCnt+'" style="width: 200px; height: 80px;" onkeypress="return soloLetras(event)" minlength="4" required autofocus></textarea></td>'+'</tr></table></th>'+
	             '<th><table class="table">'+'<tr><td style="width: 10px;"><input type="checkbox" name="A"value="TRUE"><input type="checkbox" name="C" value="TRUE" ><input type="checkbox" name="D" value="TRUE" ></td>'+'</tr></table></th>'+
	             
	             '<td class="FEC" style="width: 30px;">'+'<input type="date" class="fec'+iCnt+'" name="semana[]" size="7"  onfocus="tomo_fec(this)" onchange="date(this)" id="'+iCnt+'" required></td>'+
	             
	             '<td class="PON" style="width: 70px;">'+'<input type="text" class="'+iCnt+'" id="ponderacion'+iCnt+'" name="ponderacion[]"  onchange="controlpon(this)" onclick="tomo_pon(this)" value="0" size="2" max="5" min="1" maxlength="2" minlength="1" onKeyPress="return soloNumeros(event)" required autofocus disabled > <label class="ptos"> Ptos</label>'+'</td>'+

	             '<td style="width: 200px;"><textarea name="observacion[]" id="observacion'+iCnt+'" style="width: 200px; height: 80px; " required >Agregar Observacion</textarea></td>'+'</tr>';
    //añado fila a la tabla 
    $('.Evaluaciones').append(fila);
    });


//Para Eliminar cada Evaluacion
function eliminar(check) {        
	 if (confirm("¿Desea Eliminar la Evaluacion?\nSi Realiza esto puede perder la Informacion plasmadas en Ella") == true) {
            
    $('.boton').attr("disabled", false);
    $('.guardar').attr("disabled", true);
    checka = check.id;   
    var eli = "#ponderacion"+checka;
    var elim = parseInt($(eli).val());
    pond = pond - elim;
    $('#xD'+checka).remove();  posicion= posicion -1;
    quedan = pondeTotal -pond;

    $('#quedan').val(quedan);

    $('#llevo').val(pond);
	}else{}
}

//Para Rezagar cada Evaluacion
function rezagar(check) {    
    checka = parseInt(check.id);
	tr = $("#xD"+checka); 

	clonado = tr;
	$(clonado).focus();
	
	observa = $(".observacion"+checka);
    $(observa).val("Evaluacion Rezagada");
    fecha = $(".fec"+checka);
	$(fecha).val('');
	rezaga = $('#Rezagada'+checka);
	$(rezaga).val(checka);
    /*pondera = $("#ponderacion"+checka);
    fecha = $(".fec"+checka);
	id_inst = $("#id_inst"+checka);
    criterio = $("#criterio"+checka);
	unidad = $("#unidad"+checka);
    tecnica = $("#tecnica"+checka);
    contenido = $("#contenido"+checka);
    elimi = $("#elimi"+checka);
    reza = $('.reza'+checka);

    $(observa).val("Evaluacion Rezagada");

    $(elimi).attr("disabled", true);
    $(rezaga).attr("disabled", true);

    $(observa).attr("disabled", true);
    $(pondera).attr("disabled", true);

    $(fecha).attr("disabled", true);
    $(id_inst).attr("disabled", true);
    $(criterio).attr("disabled", true);
    $(unidad).attr("disabled", true);
    $(tecnica).attr("disabled", true);
    $(contenido).attr("disabled", true);
*/
 	$('.Evaluaciones').append(clonado);
    $('#quedan').val(quedan);
    $('#llevo').val(pond);

	alert('::Rezagando Evaluacion::\nPorfavor Cambiar la Fecha de la Evaluacion Para Completar el Proceso');
	$('.guardar').attr("disabled", true);
}

function observacion() {

	if (quedan==0) {
		$('.guardar').attr("disabled", false);

	}
}




//para Obligar a poner observacion a cada evaluación modificada

function agregarobservacion(check){

/////AGREGAR OBSERVACION////////////////////
	idfila = check.id;
	idtextarea = "#observacion"+idfila;
	alert('Por favor Agregar Observacion a la unidad Modificada'+idfila);
	$(idtextarea).focus();
//////////////////////////////
}

//////////PONDERACION//////////////////MODIFICAR//////////////////

//Asigno la nota que trae  al plan a los puntos totales
$(window).load(function() { 
    $('#puntos').val(pondeTotal);
    pond= $('#puntos').val();
    pond = parseInt(pond);
    quedan = pond - pond;
    $('#quedan').val(quedan);
    $('#llevo').val(pond);

	puntos=pond;
    //$('.nweva').attr("disabled", true);
});


//Cantidad de ponderacion a evaluar 
function canti(){
    puntos = parseInt($('#puntos').val());
    if(puntos > 20 || puntos < 5){
        $('.boton').attr("disabled", true);

        alert('Por Favor colocar una ponderacion validad. Esta NO a de ser menos de 10 ni mayor a 20');
        $('#puntos').val(pond);
           		puntos=pond;

    }
    else{

        quedan = puntos -pond;

	    $('#quedan').val(quedan);

	    $('#llevo').val(pond);

        $('.boton').attr("disabled", false);
    }
    if(puntos == pond){
        $('.boton').attr("disabled", true);

        alert('Para Crear una nueva evaluacion debe modificar la Ponderacion final');
    }
    if (pond > puntos) {
        $('.boton').attr("disabled", true);
        alert('Para restar puntos a la ponderacion final del Plan,\n debe tener Puntos Restantes para asignar\n O eliminar una evaluacion');
   		puntos=pond;
        $('#puntos').val(pond);

        quedan = puntos -pond;

	    $('#quedan').val(quedan);

	    $('#llevo').val(pond);
         
    }

}



//Contar ponderación de cada evaluacion


function tomo_pon(check){
    checka = check.value;    
    vali = parseInt(checka); //tomo su valor y lo transformo a int 
    if(vali > 5 || vali < 1){
        anterior = 0;
    }
    else{
        anterior = vali;
    }
}
////PONDERACION CONTROL

function controlpon(check){

    checka = check.value;
    checke = check.id;    
    checke = '#'+checke;
    idfecha = ".fec"+iCnt;     //busco el campo
    nuevoValor = parseInt(checka); //tomo su valor y lo transformo a int 
    
    if(checka == ''){//SI el campo esta vacio
        $(checke).val(0);//Coloco la casilla en 0
        $('.boton').attr("disabled", true);
        pond = pond - anterior;
        alert('Debe colocar un dato valido');
    
    }
    else{ // si no esta vacio

        if(nuevoValor > 5 || nuevoValor < 1){    //SI no es valido
            //le digo que no puede ser asi
            alert('La Ponderacion de las evaluaciones no pueden ser mayor a 5 puntos o menor a 1');
            //desactivo el boton de agregar nueva evaluacion
            $('.boton').attr("disabled", true);
            //coloco la casilla en 0
            $(checke).val(0);
            //y borro la cantidad que tengo 
            //resto el valor de la casilla al control
            pond = pond - anterior;

        }
        else{ // si la ponderacion es valida
            posicion= posicion +1;
            
            $('.boton').attr("disabled", false); //activo la opcion de agregar nueva eva
            
            if (posicion == iCnt) {//Si esta Agregando la ponderacion sin editar la anterior
                pond = pond - anterior;
	                pond = pond + nuevoValor;//sumo el valor que esta llegando con un contador
              	
                if(pond > puntos){ //si estecontador supera los 20 puntos
                    //desactivo el boton de nueva eva
                    $('.boton').attr("disabled", true);
                    //le notifico al usuario
                    alert('La Suma de las Evaluaciones es Mayor a La estipulada Para evaluar');
                    $(checke).val(0);
                    pond = pond - nuevoValor;
                }

                if(pond == puntos){//si las ponderaciones es igual a lo indicado anteriormente se avilita el guardar y se cancela el de nueva eva
                    $('.boton').attr("disabled", true);
                    $('.guardar').attr("disabled", false);
                }   

                if(pond != puntos){//si esdistinto es porque la suma total no es igual y falta una evaluacion
                    $('.boton').attr("disabled", false);
                    $('.guardar').attr("disabled", true);
                }
            }

            else{//Si a edita
                if (anterior > nuevoValor) {//si el valor anterior es mayor al actual
                    nuevoValor= anterior - nuevoValor; //se lo resto a la suma total
                    pond = pond - nuevoValor; //sumo el valor que esta llegando al contador
                    
                    if(pond > puntos){ //si estecontador supera los 20 puntos
                        //desactivo el boton de nueva eva
                        $('.boton').attr("disabled", true);
                        //le notifico al usuario
                        alert('La Suma de las Evaluaciones es Mayor a La estipulada Para evaluar ');
                        $(checke).val(0);
                        pond = pond - nuevoValor;
                    }

                    if(pond == puntos){//si las ponderaciones es igual a lo indicado anteriormente se avilita el guardar y se cancela el de nueva eva
                        $('.boton').attr("disabled", true);
                        $('.guardar').attr("disabled", false);
                    }

                    if(pond != puntos){//si esdistinto es porque la suma total no es igual y falta una evaluacion
                        $('.boton').attr("disabled", false);
                        $('.guardar').attr("disabled", true);
                    }
                    anterior=0;
                    posicion= posicion -1;
                }

                else{ //Si el Valor es Anterior es menor al actual
                    pond = pond - anterior; //se lo resto a la suma total
                    pond = pond + nuevoValor; //se lo resto a la suma total

                    if(pond > puntos){ //si estecontador supera los 20 puntos
                        //desactivo el boton de nueva eva
                        $('.boton').attr("disabled", true);
                        //le notifico al usuario
                        alert('La Suma de las Evaluaciones es Mayor a La estipulada Para evaluar');
                        $(checke).val(0);
                        pond = pond - nuevoValor;
                    }

                    if(pond == puntos){//si las ponderaciones es igual a lo indicado anteriormente se avilita el guardar y se cancela el de nueva eva
                        $('.boton').attr("disabled", true);
                        $('.guardar').attr("disabled", false);
                    } 
                    if(pond != puntos){//si esdistinto es porque la suma total noes igualy falta una evaluacion
                        $('.boton').attr("disabled", false);
                        $('.guardar').attr("disabled", true);
                    }
                    anterior=0;
                    posicion= posicion -1;
                }
            }
        }
    }
        quedan = puntos -pond;

    $('#quedan').val(quedan);

    $('#llevo').val(pond);

/////AGREGAR OBSERVACION////////////////////
	idfila = check.id;
	idtextarea = "#observacion"+idfila;
	alert('Por favor Agregar Observacion a la unidad Modificada');
	$(idtextarea).focus();
	$(idtextarea).val('Ponderacion Modificada');
//---------------------------------------//

} 

//FECHAS//////////////////////7
function tomo_fec(check) {
   fechaResivida = check.value; //Fecha que estaba en la casilla
}

function date(check) {
    id = parseInt(check.id); //posicion casilla
    //idFechaAnte = id-1;

    input = $('.fec'+id); //input de la fecha
    var hoy = $('#fecas').val();  //fecha de hoy

    var fechaNew = check.value; //Fecha ingresada
 
    if (fechaNew > hoy){//La Fecha es Valida y mayor a la de hoy
        //if(iCnt == id){//Tengo alguna evaluacion 

            for (i = 0; i <= iCnt; i++) {
                
                if(fechaResivida == '' ){//Si la fecha que estaba en el input no tiene nada es porque estoy agregando la fecha por primera vez
                    fechasAnterioresAgregando = $('.fec'+i).val(); //fechas de las casillas enteriores
                    if (fechaNew == fechasAnterioresAgregando && id !=i) {
                        //Verifico que la nueva fecha nosea igual a las enteriores o menos a alguna de ellas
                        alert('Fecha No valida, \nNo han de haber 2 evaluaciones con la misma fecha'); //Aviso
                        fechaNew = ''; //Vasio la nueva fecha
                        $(input).val(''); //Vasio el campo
                        $('.guardar').attr("disabled", true);
                        $('.'+id).attr("disabled", true);

                    }
                    else{//si no hay peo es porque la fecha es totalmente valida
                        $('.'+id).attr("disabled", false);

                    }
                }
                else{
                    fechasAnteriores = $('.fec'+i).val(); //fechas de las casillas enteriores
                    if (fechaNew == fechasAnteriores && id != i) {
                        //Verifico que la nueva fecha nosea igual a las enteriores o menos a alguna de ellas
                        alert('Fecha No valida, \nNo han de habsser 2 evaluaciones con la misma fecha'); //Aviso
                        fechaNew = ''; //Vasio la nueva fecha
                        $(input).val(''); //Vasio el campo
                        $('.guardar').attr("disabled", true);
                        $('.'+id).attr("disabled", true);

                    }
                    else{
                        $('.'+id).attr("disabled", false);

                    }
               }
            }
        //}
        //else{
        //    alert('editando');
        //}

        /////AGREGAR OBSERVACION////////////////////
	idfila = check.id;
	idtextarea = "#observacion"+idfila;
	alert('Por favor Agregar Observacion a la unidad Modificada');
	$(idtextarea).val('Fecha Modificada');
	$(idtextarea).focus();
//---------------------------------------//
    }
    else{
        alert('La Fecha a de ser Mayor a la fecha Actual'+fechaNew+' '+hoy);
        today = '';
        $(input).val('');
    }
}

</script>
@endsection