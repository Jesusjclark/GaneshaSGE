@extends('layouts.app')
    @section('customcss')

    @endsection
@section('content')

@include('roles.AgregarRoles')
@include('roles.ModificarRoles')



<!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title">Gestion de Roles</h4>
                                <p class="category">Listado</p>
                            </div> <!--Fin card header-->
                        <section class="content-header">
                          <ol class="breadcrumb">
                            <li>
                                <a href="/home"><i class="fa fa-dashboard"></i>
                                    Home
                                </a>
                            </li>
                            <li class="active">
                                Gestion de Roles
                            </li>
                          </ol>
                        </section><hr>
                            <div class="card-content">
                                <div class="col-md-offset-11">
                                    <button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#ModalAgregar'> 
                                        Agregar
                                    </button>
                                </div><!--fin col-->
                        @include('flash::message')
                                
                                @include('roles.ListarRoles')
                   </div><!--card-->
                </div><!--col-->
            </div><!--row-->
        </div><!--container--> 
    </div><!--content--> 
</div><!--content--> 
@endsection
@section('customjs')
<script>
    //Initialize Select2 Elements
    $(".select2").select2();

    function verifico(check){
        {{-- id="eliminar" onclick="verifico(this)" --}}
        if (confirm("¿Desea Eliminar el Rol?\nRecuerde que esto puede traer Perdida de Informacion") == true) {
        } else {
            event.preventDefault();        
        }
    }
</script>
@endsection
