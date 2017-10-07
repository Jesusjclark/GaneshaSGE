@extends('layouts.app')
@section('content')
  
<!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <!--Condiciono que si la variable trae algun valor muestre el formulario de editar -->
                            <h4 class="title">Asignación de Unidades</h4>
                            <p class="category">Lista de Unidades Curriculares</p>
                        </div><!--fin card header-->
                        

                                <section class="content-header">
                                  <ol class="breadcrumb">
                                    <li>
                                        <a href="/home"><i class="fa fa-dashboard"></i>
                                            Home
                                        </a>
                                    </li>
                                    <li class="active">
                                        Asignacion de Usuario
                                    </li>
                                  </ol>
                                </section><br>
                        <div class="card-content">
                            @if(session()->has('msj') )
                            <div class="alert alert-success">{{ session('msj') }}
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                             </div>
                            @endif
        
                            @if(session()->has('msjerr') )
                             <div class="alert alert-danger alert-dismissible">{{ session('msjerr') }}
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
                            @endif
                        @if(isset($editar))
                          
                         

                            @if($editar == 'true')
                                @include('Usuario.Modificar_usu_asignados')
                                @include('Usuario.listadeasig')
                            @endif

                            @if($editar == 'false')
                                @include('Usuario.Asignardocentes')
                                @include('Usuario.listadeasig')
                            @endif
                            
                            @if($editar == 'none')
                                 
                                <br>
                                 @include('Usuario.listadeasig')
                            @endif                       
                            @else
                        
                                @include('Usuario.listadeasig')
                        @endif

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

@endsection

@section('customjs')

<script>
    $(window).load(function(){
        $('#myModal').modal('show');
    });

    $(window).load(function(){
        $('#myModal2').modal('show');
    });
    /*$(document).ready(function(){
     
        $(".Modal_usu_asignados").fadeIn();


    });*/
</script>
@endsection