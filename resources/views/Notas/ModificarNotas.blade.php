@extends('layouts.app')
@section('customcss')
  <link rel="stylesheet" href="/datatables/dataTables.bootstrap.css">

@endsection
@section('content')
<!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">Modificar Notas</h4>
                            <p class="category">Lista Estudiantes</p>
                        </div><!--fin card header-->
                        <div class="card-content">
                        <section class="content-header">
                          <ol class="breadcrumb">
                            <li>
                                <a href="/home"><i class="fa fa-dashboard"></i>
                                    Home
                                </a>
                            </li> 
                            <li>
                                <a href="/Notas/G_notas"><i class="fa fa-dashboard"></i>
                                    Gestion de Notas
                                </a>
                            </li>
                            <li class="active">
                                Modificar Notas 
                            </li>
                          </ol>
                        </section><br>
                            <br>
                            @include('Notas.listmodificarnota')
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

<script src="/datatables/jquery.dataTables.js"></script>
<script src="/datatables/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('#Notas').DataTable({
            "bPaginate": false,        
        });
    });
    function nota(check) {
        
        if (check.value>5) {
          alert('La Nota debe ser menor a 5pts y mayor a 1');
          
        }
         if (check.value<1) {
          alert('La Nota debe ser menor a 5pts y mayor a 1');
          
        }
    }
</script>    
@endsection