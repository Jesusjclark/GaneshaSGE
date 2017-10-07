@extends('layouts.app')
@section('customcss')
  <link rel="stylesheet" href="/datatables/jquery.dataTables.css">

@endsection
@section('content')
<!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">Asignacion de Notas</h4>
                            <p class="category">Lista Estudiantes</p>
                        </div><!--fin card header-->
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
                                Registrar Notas 
                            </li>
                          </ol>
                        </section><br>
                        <div class="card-content table-responsive">
                            <br>
                            @include('Notas.listaestunota')
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
       $('#Notas').dataTable({
            //"order": [],
            "paging": false,
            "language": {
                       "info": "Se Encontro _TOTAL_ Registros",
                       "search": "Buscar Estudiante:",
                       "infoFiltered": " - De _MAX_ Posibles",
                       "zeroRecords": "No Se ha Encontrado el Estudiante <br> ¿Desea Crearlo?<br><button type='button' class='btn btn-primary btn-xs' onclick='alert(3)'>Nuevo</button>",
                       "infoEmpty": "Registros _TOTAL_",
                       "loadingRecords": "Por favor Espere Estamos Buscando Registros",
                       "processing": "Procesando sus datos"
                     },

        });

        /*oTable.$('td').click( function () {
            var sData = oTable.fnGetData( this );
                 alert( 'Seleccionastes a '+sData );
               } );*/
                     //"search": {"search": "Initial search"},
               
     });
        function nota(check) {
          alert(check.value);
          

        if ($val>5 && $val <1) {
          
        }

} 


         
</script>    
@endsection