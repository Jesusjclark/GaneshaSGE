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
                            <h4 class="title">Gestion de Planes de Evaluaciones</h4>
                            <p class="category">Lista de Planes</p>
                        </div>
                        @if(isset($editar))
                            <section class="content-header">
                              <ol class="breadcrumb">
                                <li>
                                    <a href="/home"><i class="fa fa-dashboard"></i>
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="/Plan_Evaluaciones/Gestion_Planes"><i class="fa fa-dashboard"></i>
                                        Gestion de Planes
                                    </a>
                                </li>
                                <li class="active">
                                    Gestion de Plan de Evaluacion
                                </li>
                              </ol>
                            </section><br>
                            <div class="card-content">
                        @include('flash::message')

                            @include('Plan_Evaluaciones.Panel_GestionPlan')
                            @include('Plan_Evaluaciones.Modificar_Plan')
                        @else
                            <section class="content-header">
                              <ol class="breadcrumb">
                                <li>
                                    <a href="/home"><i class="fa fa-dashboard"></i>
                                        Home
                                    </a>
                                </li>
                                <li class="active">
                                    Gestion de Planes de Evaluacion
                                </li>
                              </ol>
                            </section><br>
                            <div class="card-content">
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
                        @include('flash::message')
                            
                            @include('Plan_Evaluaciones.Listar_Planes')

                        @endif
                        </div>
                    </div>
                        <!-- /#ion-icons -->
                </div>
                    <!-- /.tab-content -->
            </div>
                <!-- /.nav-tabs-custom -->
        </div>
            <!-- /.col --> 
    </div>
@endsection