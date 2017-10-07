@section('customcss')
  <link rel="stylesheet" href="/datatables/jquery.dataTables.css">
  <link rel="stylesheet" href="/datatables/extensions/Buttons-1.3.1/css/buttons.dataTables.min.css">

@endsection
@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">Bitacora</h4>
                            <p class="category">Lista de Movimientos</p>
                        </div>
                                <section class="content-header">
                                  <ol class="breadcrumb">
                                    <li>
                                        <a href="/home"><i class="fa fa-dashboard"></i>
                                            Home
                                        </a>
                                    </li>
                                    <li class="active">
                                        Bitacora
                                    </li>
                                  </ol>
                                </section><br>
                                <div class="card-content table-responsive">
                                    @include('flash::message')
        	   				        @include('Bitacora.listarBitacora')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customjs')
<script src="/datatables/jquery.dataTables.js"></script>
<script src="/datatables/dataTables.bootstrap.min.js"></script>
<script src="/datatables/extensions/Buttons-1.3.1/js/dataTables.buttons.min.js"></script>
<script src="/datatables/extensions/Buttons-1.3.1/js/buttons.bootstrap.min.js"></script>
<script src="/datatables/extensions/Buttons-1.3.1/js/buttons.flash.min.js"></script>
<script src="/datatables/extensions/Buttons-1.3.1/js/buttons.html5.js"></script>
<script src="/datatables/extensions/Buttons-1.3.1/js/buttons.print.min.js"></script>
<script>
    //Initialize Select2 Elements

    $(document).ready(function(){
      var oTable= $('#Bitacora').DataTable({
            "responsive": true,  
            dom: 'Bfrtip',
          "order": [0,'des'],
            buttons: [
                'excel', 'copy', 'csv',  'pdf', 'print'
            ],  
            
            //"paging": false,
            "language": {
                       "info": "Se Encontro _TOTAL_ Registros",
                       "search": "Filtrar:",
                       "infoFiltered": " - De _MAX_ Posibles",
                       "zeroRecords": "No Se ha Encontrado el Docente",
                       "infoEmpty": "Registros _TOTAL_",
                       "loadingRecords": "Por favor Espere Estamos Buscando Registros",
                       "processing": "Procesando sus datos",
                        "lengthMenu": "Cantidad de Registros _MENU_"
                     },
        });
    });
</script>
@endsection