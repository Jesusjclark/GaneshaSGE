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
                            <h4 class="title">Gestion de Notas</h4>
                            <p class="category">Transcripción de Notas</p>
                        </div><!--fin card header-->
                        <section class="content-header">
                          <ol class="breadcrumb">
                            <li>
                                <a href="/home"><i class="fa fa-dashboard"></i>
                                    Home
                                </a>
                            </li> 
                            <li>
                                <a href="/Notas/Transcripcion"><i class="fa fa-dashboard"></i>
                                    Transcribir Notas
                                </a>
                            </li>
                          </ol>
                        </section><br>
                       
                        <div class="card-content">
                        @include('flash::message')
                        
                            <div class="col-md-offset-11">
                                
                            </div><br><!--fin colcard-->
                            @include('Notas.listatranscripnota')
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
