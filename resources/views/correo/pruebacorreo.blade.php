@extends('layouts.app')
    @section('customcss')

    @endsection
@section('content')


<!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title">Gestion de Instrumentos</h4>
                                <p class="category">Lista de Instrumentos</p>
                            </div> <!--Fin card header-->
                            <div class="card-content">
                                <div class="col-md-offset-11">
                                <a href="enviar_correo">
                                    <button type='button'> 
                                        Agregar
                                    </button>
                                </a>    

                                </div><br><!--fin col-->
                                @include('correo.form_mail')
                   </div><!--card-->
                </div><!--col-->
            </div><!--row-->
        </div><!--container--> 
    </div><!--content--> 
</div><!--content--> 
@endsection
@section('customjs')

@endsection
