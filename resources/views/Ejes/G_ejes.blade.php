@extends('layouts.app')

    @section('customcss')
    
    @endsection

@section('content')
    @include('Ejes.Agregar_ejes')
    @include('Ejes.Modificar_ejes')


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title">Gestion de Ejes</h4>
                                <p class="category">Lista de Ejes</p>
                            </div>

                        <section class="content-header">
                          <ol class="breadcrumb">
                            <li>
                                <a href="/home"><i class="fa fa-dashboard"></i>
                                    Home
                                </a>
                            </li>
                            <li class="active">
                                Gestion de Ejes
                            </li>
                          </ol>
                        </section><br><br><button type='button' class='col-md-offset-11 btn btn-primary btn-xs' data-toggle='modal' data-target='#ModalAgregarEje'> 
                                    Agregar
                                </button>
                            <div class="card-content">
                                

                                <!--Condiciono que si la variable trae algun valor muestre el formulario de editar -->
                        @include('flash::message')

                                    @include('Ejes.Listar_ejes')    

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
    function verifico(check){
        {{-- id="eliminar" onclick="verifico(this)" --}}
        if (confirm("¿Desea Eliminar el Eje?\nRecuerdeque esto puede Traer perdidas de informacion") == true) {
        } else {
            event.preventDefault();        
        }
    }
</script>
@endsection