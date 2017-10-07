@extends('layouts.app')
    @section('customcss')

    @endsection
@section('content')
    @include('Uni_Crr.Agregar_uc')
    @include('Uni_Crr.Modificar_uc')

<!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">Gestion de Unidades Curriculares</h4>

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
                                Gestion de Unidades Curriculares
                            </li>
                          </ol>
                        </section><br><hr>
                        <div class="card-content">
                        
                            <div class="col-md-offset-11">
                                <button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#ModalAgregar'> 
                                    Agregar
                                </button>
                            </div><br><!--fin colcard-->
                        @include('flash::message')
                            
                            @include('Uni_Crr.Listar_uc')
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
    //Initialize Select2 Elements
    $(".select2").select2();
  
    function verifico(check){
        {{-- id="eliminar" onclick="verifico(this)" --}}
        if (confirm("¿Desea Eliminar Esta Unidad Curricular?") == true) {
        } else {
            event.preventDefault();        
        }
    }
</script>
@endsection
