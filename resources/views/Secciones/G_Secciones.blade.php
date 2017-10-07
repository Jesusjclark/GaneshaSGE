@extends('layouts.app')
    @section('customcss')

    @endsection
@section('content')
    @include('Secciones.Agregar_sec')
    @include('Secciones.Modificar_sec')

<!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">Gestion de  Secciones</h4>
                            <p class="category">Lista de  Secciones</p>
                        </div><!--fin card header-->
                        <section class="content-header">
                          <ol class="breadcrumb">
                            <li>
                                <a href="/home"><i class="fa fa-dashboard"></i>
                                    Home
                                </a>
                            </li>
                            <li class="active">
                                Gestion de Secciones
                            </li>
                          </ol>
                        </section><hr>
                        <div class="card-content">
                            
                            @if($cuentauc>3)
                           
                                <button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#ModalAgregar'> 
                                    Agregar
                                </button>
                                </div><!--fin colcard-->

                            @include('Secciones.Listar_sec')
                        </div>
                        <!-- /#ion-icons -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
    </div>

    @else
     <div class="col-md">
                                <h2>Debe registrar primero las unidades curriculares min(4)</h2>
                                </div><!--fin colcard-->
                                   </div>
                        <!-- /#ion-icons -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
    </div>                
@endif
                        
   @endsection
@section('customjs')
<script>                        

    function verifico(check){
        {{-- id="eliminar" onclick="verifico(this)" --}}
        if (confirm("¿Desea Eliminar La Seccion?\nRecuerde que esto puede traer Perdida de Informacion") == true) {
        } else {
            event.preventDefault();        
        }
    }


$(".select2").select2();
$('#todas').click(function() {
    $('#d').remove();
});

$('#select').click(function() {
    $('#selec').attr("checked", false); 
     $('#todas').attr("required", true); 
   $('#d').remove();
});

   function Seccion(check) {        
        tray = $('#select').val();
        checka = check.id;
        element = document.getElementById("divUC");    

        if (checka == 'selec') {
            if (check.checked) {
                element.style.display='block';
                if (tray == 0) {

                    var selet = '<div id="d"><label>Unidades Curriculares</label>'+     
                                '<select class="select2" multiple="multiple" data-placeholder="Seleccione Unidades" style="width: 100%;" name="materia[]" required>'+
                                    '@if(isset($uni_crr) )'+
                                        '@foreach($uni_crr as $uc)'+
                                            '@if($uc->trayecto == "0")'+
                                            '<option value="{{ $uc->cod_uc_pnf}}">{{ $uc->nom_uc}}</option>'+
                                            '@endif'+
                                        '@endforeach'+
                                    '@endif'+
                                '</select></div>';
                    $('#d').remove();
                    $('#divUC').append(selet);
                    $(".select2").select2();
                }
                if (tray == 1) {

                    var selet = '<div id="d"><label>Unidades Curriculares</label>'+     
                                '<select class="select2" multiple="multiple" data-placeholder="Seleccione Unidades" style="width: 100%;" name="materia[]" required>'+
                                    '@if(isset($uni_crr) )'+
                                        '@foreach($uni_crr as $uc)'+
                                            '@if($uc->trayecto == "1")'+
                                            '<option value="{{ $uc->cod_uc_pnf}}">{{ $uc->nom_uc}}</option>'+
                                            '@endif'+
                                        '@endforeach'+
                                    '@endif'+
                                '</select></div>';
                    $('#d').remove();
                    $('#divUC').append(selet);
                    $(".select2").select2();
                }
                if (tray == 2) {

                    var selet = '<div id="d"><label>Unidades Curriculares</label>'+     
                                '<select class="select2" multiple="multiple" data-placeholder="Seleccione Unidades" style="width: 100%;" name="materia[]" required>'+
                                    '@if(isset($uni_crr) )'+
                                        '@foreach($uni_crr as $uc)'+
                                            '@if($uc->trayecto == "2")'+
                                            '<option value="{{ $uc->cod_uc_pnf}}">{{ $uc->nom_uc}}</option>'+
                                            '@endif'+
                                        '@endforeach'+
                                    '@endif'+
                                '</select></div>';
                    $('#d').remove();
                    $('#divUC').append(selet);
                    $(".select2").select2();
                }
                if (tray == 3) {

                    var selet = '<div id="d"><label>Unidades Curriculares</label>'+     
                                '<select class="select2" multiple="multiple" data-placeholder="Seleccione Unidades" style="width: 100%;" name="materia[]" required>'+
                                    '@if(isset($uni_crr) )'+
                                        '@foreach($uni_crr as $uc)'+
                                            '@if($uc->trayecto == "3")'+
                                            '<option value="{{ $uc->cod_uc_pnf}}">{{ $uc->nom_uc}}</option>'+
                                            '@endif'+
                                        '@endforeach'+
                                    '@endif'+
                                '</select></div>';
                    $('#d').remove();
                    $('#divUC').append(selet);
                    $(".select2").select2();
                }
                if (tray == 4) {

                    var selet = '<div id="d"><label>Unidades Curriculares</label>'+     
                                '<select class="select2" multiple="multiple" data-placeholder="Seleccione Unidades" style="width: 100%;" name="materia[]" required>'+
                                    '@if(isset($uni_crr) )'+
                                        '@foreach($uni_crr as $uc)'+
                                            '@if($uc->trayecto == "4")'+
                                            '<option value="{{ $uc->cod_uc_pnf}}">{{ $uc->nom_uc}}</option>'+
                                            '@endif'+
                                        '@endforeach'+
                                    '@endif'+
                                '</select></div>';
                    $('#d').remove();
                    $('#divUC').append(selet);
                    $(".select2").select2();

                }

            }
        }
        else {
            element.style.display='none';
        }
    }

{{--                                                         @if($uc->trayecto == '0')
 --}}
var trayViejo = 0;

function tray(check) {
    trayNew = check.value;


        if (trayNew == 0) {
            var selet = '<div class="de"><label>Unidades Curriculares</label>'+     
                        '<select class="select2" multiple="multiple" data-placeholder="Seleccione Unidades" style="width: 100%;" name="materia[]" required>'+
                            '@if(isset($uni_crr) )'+
                                '@foreach($uni_crr as $uc)'+
                                    '@if($uc->trayecto == "0")'+
                                    '<option selected value="{{ $uc->cod_uc_pnf}}">{{ $uc->nom_uc}}</option>'+
                                    '@endif'+
                                '@endforeach'+
                            '@endif'+
                        '</select></div>';
            $('.de').remove();
            $('.diva').append(selet);
            $(".select2").select2();
        }
        if (trayNew == 1) {

            var selet = '<div class="de"><label>Unidades Curriculares</label>'+     
                        '<select class="select2" multiple="multiple" data-placeholder="Seleccione Unidades" style="width: 100%;" name="materia[]" required>'+
                            '@if(isset($uni_crr) )'+
                                '@foreach($uni_crr as $uc)'+
                                    '@if($uc->trayecto == "1")'+
                                    '<option selected value="{{ $uc->cod_uc_pnf}}">{{ $uc->nom_uc}}</option>'+
                                    '@endif'+
                                '@endforeach'+
                            '@endif'+
                        '</select></div>';
            $('.de').remove();
            $('.diva').append(selet);
            $(".select2").select2();
        }
        if (trayNew == 2) {

            var selet = '<div class="de"><label>Unidades Curriculares</label>'+     
                        '<select class="select2" multiple="multiple" data-placeholder="Seleccione Unidades" style="width: 100%;" name="materia[]" required>'+
                            '@if(isset($uni_crr) )'+
                                '@foreach($uni_crr as $uc)'+
                                    '@if($uc->trayecto == "2")'+
                                    '<option selected value="{{ $uc->cod_uc_pnf}}">{{ $uc->nom_uc}}</option>'+
                                    '@endif'+
                                '@endforeach'+
                            '@endif'+
                        '</select></div>';
            $('.de').remove();
            $('.diva').append(selet);
            $(".select2").select2();
        }
        if (trayNew == 3) {

            var selet = '<div class="de"><label>Unidades Curriculares</label>'+     
                        '<select class="select2" multiple="multiple" data-placeholder="Seleccione Unidades" style="width: 100%;" name="materia[]" required>'+
                            '@if(isset($uni_crr) )'+
                                '@foreach($uni_crr as $uc)'+
                                    '@if($uc->trayecto == "3")'+
                                    '<option selected value="{{ $uc->cod_uc_pnf}}">{{ $uc->nom_uc}}</option>'+
                                    '@endif'+
                                '@endforeach'+
                            '@endif'+
                        '</select></div>';
            $('.de').remove();
            $('.diva').append(selet);
            $(".select2").select2();
        }
        if (trayNew == 4) {

            var selet = '<div class="de"><label>Unidades Curriculares</label>'+     
                        '<select class="select2" multiple="multiple" data-placeholder="Seleccione Unidades" style="width: 100%;" name="materia[]" required>'+
                            '@if(isset($uni_crr) )'+
                                '@foreach($uni_crr as $uc)'+
                                    '@if($uc->trayecto == "4")'+
                                    '<option selected value="{{ $uc->cod_uc_pnf}}">{{ $uc->nom_uc}}</option>'+
                                    '@endif'+
                                '@endforeach'+
                            '@endif'+
                        '</select></div>';
            $('.de').remove();
            $('.diva').append(selet);
            $(".select2").select2();

        }
    
 }
 function tomo(e) {
    trayViejo = e.value;
 }
</script>
@endsection
