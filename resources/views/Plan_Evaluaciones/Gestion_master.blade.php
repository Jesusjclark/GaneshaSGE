@extends('layouts.app')
    @section('customcss')
<style media="print" type="text/css">
@media print
{
body * { visibility: hidden; }
#PrintDiv * { visibility: visible; }
#PrintDiv { position: absolute; top: 40px; left: 30px; }
}

</style>
    @endsection
@section('content')
@if($seccuenta>3)

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title">Gestionar Plan Maestro</h4>
                                <p class="category">Lista de Unidades</p>
                            </div>
                                @if(isset($editar))
                                    @if($editar=='false')
                                        @include('Plan_Evaluaciones.Agregar_PlanEva')
                                    @else
                                        @if($editar=='MASTER')
                                            <section class="content-header">
                                              <ol class="breadcrumb">
                                                <li>
                                                    <a href="/home"><i class="fa fa-dashboard"></i>
                                                        Home
                                                    </a>
                                                </li>
                                                <li class="active">
                                                    Gestion de Plan Maestro
                                                </li>
                                              </ol>
                                            </section><br>

                                            <div class="card-content">
                        @include('flash::message')

                                            @include('Plan_Evaluaciones.Panel_GestionCreado')
                                            @include('Plan_Evaluaciones.Modificar_PlanEva')
                                        @else
                                            <div class="card-content">
                                            @include('Plan_Evaluaciones.Visualizar_PlanEva')
                                        @endif
                                    @endif
                                @else
                                    @if(session()->has('msj') )
                                        <div class="alert alert-success">{{ session('msj') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        </div>
                                    @endif
                                    @if(session()->has('eli') )
                                        <div class="alert alert-success">{{ session('eli') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        </div>
                                    @endif
                                    <section class="content-header">
                                      <ol class="breadcrumb">
                                        <li>
                                            <a href="/home"><i class="fa fa-dashboard"></i>
                                                Home
                                            </a>
                                        </li>
                                        <li class="active">
                                            Gestion de Planes Maestro
                                        </li>
                                      </ol>
                                    </section><br>

                                    <div class="card-content">
                        @include('flash::message')
                                    
                                    @include('Plan_Evaluaciones.Lista_PlanMaster')

                                @endif

                            </div>
                            <!-- /#ion-icons -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
            </div>
        </div>
@else
     <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title">Gestionar Plan Maestro</h4>
                                <p class="category">Lista de Unidades</p>
                            </div>
                            <section class="content-header">
                                <ol class="breadcrumb">
                                    <li>
                                    <a href="/home"><i class="fa fa-dashboard"></i>
                                            Home
                                        </a>
                                    </li>
                                <li class="active">
                                    Gestion de Plan Maestro
                                </li>
                              </ol>
                            </section><br>
                            <div class="card-content">
                            <h2>Debe Primero crear Secciones y Unidades Curriculares</h2>
                            </div>
                        </div><
                    </div><
                </div><
            </div><
    </div><

@endif
@endsection
@section('customjs')

<script>

//Activar modar a entrar a la pagina
    $(window).load(function(){
        $('#AgregarPlanMaestro').modal('show');

    });

var nuevoValor = 0;
var pond = 0;
var quedan =0;       
var iCnt = 0;   //controla la cantidad de tr
var puntos = 0;    //controla la cantidad de boton eliminar
var posicion = 0;
var anterior = 0;
    
    function verifico(check){
        {{-- id="eliminar" onclick="verifico(this)" --}}
        if (confirm("¿Desea Eliminar el Plan Maestro?\nSi Realiza esto puede perder las Evaluaciones plasmadas en El") == true) {
        } else {
            event.preventDefault();        
        }
    }
    function verificoAsig(check){
        {{-- id="eliminar" onclick="verifico(this)" --}}
        if (confirm("¿Desea Asignar el Plan Maestro?\nSi Realiza esto Luego No Podra tener Modificaciones") == true) {
        } else {
            event.preventDefault();        
        }
    }


//Agregar evaluaciones dinamicamente
$('.boton').click(function() {  
    iCnt = iCnt + 1;    // sumo el tr nuevo al control
        $('#puntos').attr("disabled", true);

    var fila=  '<tr id="xD'+ iCnt +'" ><td style="width: 40px;"><input type="text" maxlength="2" minlength="1" onKeyPress="return soloNumeros(event)" required autofocus name="unidad[]" id="unida'+iCnt+'" size="2" ></td>'+
                '<td style="width: 40px;"><center><button type="button" name="Eliminar" id="'+iCnt+'" onclick="eliminar(this)" class="btn btn-danger btn-xs"><img src="/img/iconos/16x16/cancel.png"></button></center></td>'+
             '<td style="width: 200px;"><textarea name="contenido[]" id="'+iCnt+'" style="width: 200px; height: 80px;" onkeypress="return soloLetras(event)" minlength="4"  required autofocus></textarea></td>'+
             '<th><table class="table">'+
                    '<tr><td style="width: 40px;"><center><input type="text" name="tecnica[]" size="20" id="'+iCnt+'" onkeypress="return soloLetras(event)" maxlength="25" minlength="4" placeholder="Ej. Observación" required autofocus><label class="est">Agregar Evaluacion:</label></center></td>'+
                         '<td style="width: 40px;"><select simple="simple" name="id_inst[]">'+'@foreach($instrumentos as $in)'+
            '<option value="'+{{$in->id_inst}}+'">'+'{{$in->tip_inst}}'+'</option>@endforeach'+'</select>'+'</td>'+'<td style="width: 200px;"><textarea name="criterio[]" id="'+iCnt+'" style="width: 200px; height: 80px;" required></textarea></td>'+'</tr></table></th>'+
             '<th><table class="table">'+'<tr><td style="width: 10px;"><input type="checkbox" name="A"value="TRUE"><input type="checkbox" name="C" value="TRUE" ><input type="checkbox" name="D" value="TRUE" ></td>'+'</tr></table></th>'+
             '<td style="width: 30px;">'+'<input type="date" id="'+iCnt+'" class="fec'+iCnt+'" name="semana[]" size="7" onfocus="tomo_fec(this)" onchange="date(this)" required><input type="text" id="fecas" class="hide" value="<?php echo date("Y-m-d");?>" ></td>'+
             '<td style="width: 70px;">'+'<center><input type="text" style="width: 30px;" id="ponderacion'+iCnt+'" name="ponderacion[]" size="2" max="5" min="1" maxlength="2" minlength="1" onKeyPress="return soloNumeros(event)" required autofocus class="'+iCnt+'" onchange="controlpon(this)" onfocus="tomo_pon(this)" value="0" disabled><label> Ptos</label></center>'+'</td>'+'</tr>';

    //añado fila a la tabla 
    $('.Evaluaciones').append(fila);
        $('.boton').attr("disabled", true);
        quedan = puntos -pond;
        $('#quedan').val(quedan);
        $('#llevo').val(pond);

});


//Para Eliminar cada Evaluacion
function eliminar(check) {        

        if (confirm("¿Desea Eliminar la Evaluacion?\nSi Realiza esto puede perder la Informacion plasmadas en Ella") == true) {
                
            $('.boton').attr("disabled", false);
            $('.guardar').attr("disabled", true);
            checka = parseFloat(check.id);  
            var eli = "#ponderacion"+checka;
            var elim = parseFloat($(eli).val());
            pond = pond - elim;
            $('#xD'+checka).remove();  posicion= posicion -1;
            /*if(checka < iCnt){
                checko =checka + 1;
                hola ='#xD'+checko;
                checka = hola;
                alert($(checka).html());
            }*/
            quedan = puntos -pond;

            $('#quedan').val(quedan);

            $('#llevo').val(pond);

        } else {
        }
}

//Contar ponderación de cada evaluacion

function canti(){
    hola = $('#puntos').val();
    puntos = parseFloat($('#puntos').val());

        if ( hola == '') {
                $('.boton').attr("disabled", true);

            alert('Debe colocar un dato valido');
        }
        else{

            if(puntos > 20 || puntos < 10){
                $('.boton').attr("disabled", true);

                alert('Por Favor colocar una ponderacion validad, esta no a de ser menos de 10 ni mayor a 20');
            }
            else{
                $('.boton').attr("disabled", false);
            }
        }
    }


function tomo_pon(check){

    checka = check.value;  
    vali = parseFloat(checka); //tomo su valor y lo transformo a int 
 
    if(vali > 5 || vali < 1){
        anterior = 0;
    }
    else{
        anterior = vali;
    }
}
////PONDERACION CONTROL

function controlpon(check){
    checka = check.value; //valor del campo que tomo
    checke = check.id;    
    checke = '#'+checke;
    checla = check.class;

    idfecha = "#fecha"+iCnt;     //busco el campo
    nuevoValor = parseFloat(checka); //tomo su valor y lo transformo a int 
    if(checka == ''){//SI el campo esta vacio
        $(checke).val(0);//Coloco la casilla en 0
        $('.boton').attr("disabled", true);
        $(idfecha).focus();
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
            $(idfecha).focus();

        }
        else{ // si la ponderacion es valida
            posicion= posicion +1;
            
            $('.boton').attr("disabled", false); //activo la opcion de agregar nueva eva
            if (checla == iCnt) {//Si esta Agregando la ponderacion sin editar la anterior
                pond = pond + nuevoValor; //sumo el valor que esta llegando con un contador
              
                if(pond > puntos){ //si estecontador supera los 20 puntos
                    //desactivo el boton de nueva eva
                    $('.boton').attr("disabled", true);
                    //le notifico al usuario
                    alert('La Suma de las Evaluaciones es Mayor a La estipulada Para evaluar normal');
                    $(checke).val(0);
                    pond = pond - nuevoValor;
                    $(idfecha).focus();
                }

                if(pond == puntos){//si las ponderaciones es igual a lo indicado anteriormente se avilita el guardar y se cancela el de nueva eva
                    $('.boton').attr("disabled", true);
                    $('.guardar').attr("disabled", false);
                    $(idfecha).focus();
                }   

               if(pond != puntos){//si esdistinto es porque la suma total no es igual y falta una evaluacion
                    $('.boton').attr("disabled", false);
                    $('.guardar').attr("disabled", true);
                    $(idfecha).focus();
                }
                $(idfecha).focus();
            }

            else{//Si Voy a editar una ponderacion anterior
                if (anterior > nuevoValor && anterior != 0) {//si el valor anterior es mayor al actual
                     nuevoValor= anterior - nuevoValor; //se lo resto a la suma total
                    pond = pond - nuevoValor; //sumo el valor que esta llegando al contador
                    
                    if(pond > puntos){ //si estecontador supera los 20 puntos
                        //desactivo el boton de nueva eva
                        $('.boton').attr("disabled", true);
                        //le notifico al usuario
                        alert('La Suma de las Evaluaciones es Mayor a La estipulada Para evaluar siendo mayor');
                        $(checke).val(0);
                        pond = pond - nuevoValor;
                        $(idfecha).focus();
                    }

                    if(pond == puntos){//si las ponderaciones es igual a lo indicado anteriormente se avilita el guardar y se cancela el de nueva eva
                        $('.boton').attr("disabled", true);
                        $('.guardar').attr("disabled", false);
                        $(idfecha).focus();
                    }

                    if(pond != puntos){//si esdistinto es porque la suma total no es igual y falta una evaluacion
                        $('.boton').attr("disabled", false);
                        $('.guardar').attr("disabled", true);
                        $(idfecha).focus();
                    }
                    anterior=0;
                    posicion= posicion -1;
                    $(idfecha).focus();
                }

                else{ //Si el Valor es Anterior es menor al actual
                    pond = pond - anterior; //se lo resto a la suma total
                    pond = pond + nuevoValor; //se lo resto a la suma total
                    if(pond > puntos){ //si estecontador supera los 20 puntos
                        //desactivo el boton de nueva eva
                        $('.boton').attr("disabled", true);
                        //le notifico al usuario
                        alert('La Suma de las Evaluaciones es Mayor a La estipulada Para evaluar siendo menor');
                        $(checke).val(0);
                        pond = pond - nuevoValor;
                        $(idfecha).focus();
                    }

                    if(pond == puntos){//si las ponderaciones es igual a lo indicado anteriormente se avilita el guardar y se cancela el de nueva eva
                        $('.boton').attr("disabled", true);
                        $('.guardar').attr("disabled", false);
                        $(idfecha).focus();
                    } 
                    if(pond != puntos){//si esdistinto es porque la suma total noes igualy falta una evaluacion
                        $('.boton').attr("disabled", false);
                        $('.guardar').attr("disabled", true);
                        $(idfecha).focus();
                    }
                    anterior=0;
                    posicion= posicion -1;
                    $(idfecha).focus();
                }
            }
        }
    }
        quedan = puntos -pond;

    $('#quedan').val(quedan);

    $('#llevo').val(pond);

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
                        $('.'+id).attr("disabled", true);

                    }
                    else{//si no hay peo es porque la fecha es totalmente valida
                        $('.'+id).attr("disabled", false);
                    }
                }
                else{
                    fechasAnteriores = $('.fec'+i).val(); //fechas de las casillas enteriores
                    $('.'+id).attr("disabled", true);
                    if (fechaNew == fechasAnteriores && id != i) {
                        //Verifico que la nueva fecha nosea igual a las enteriores o menos a alguna de ellas
                        alert('Fecha No valida, \nNo han de haber 2 evaluaciones con la misma fecha'); //Aviso
                        fechaNew = ''; //Vasio la nueva fecha
                        $(input).val(''); //Vasio el campo
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
    }
    else{
        alert('La Fecha a de ser Mayor a la fecha Actual');
        today = '';
        $(input).val('');
    }
}
</script>

@endsection
