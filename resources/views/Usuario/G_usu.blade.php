@section('customcss')
  <link rel="stylesheet" href="/datatables/jquery.dataTables.css">

@endsection
@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">Gestion de Usuarios</h4>
                            <p class="category">Lista de Usuarios</p>
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
                                        <a href="/Usuario/G_usu"><i class="fa fa-dashboard"></i>
                                            Gestion de Usuarios
                                        </a>
                                    </li>
                                    <li class="active">
                                        Modificar Usuario
                                    </li>
                                  </ol>
                                </section><br>
                                <div class="card-content table-responsive">
                            <!--Condiciono que si la variable trae algun valor muestre el formulario de editar -->
                                    @include('flash::message')
                                    
                                    @include('Usuario.Modificar_usu')
                            @else
                                <section class="content-header">
                                  <ol class="breadcrumb">
                                    <li>
                                        <a href="/home"><i class="fa fa-dashboard"></i>
                                            Home
                                        </a>
                                    </li>
                                    <li class="active">
                                        Gestion de Usuarios
                                    </li>
                                  </ol>
                                </section><br>
                                <div class="card-content table-responsive">
                                    <table align="right">
                                        <tr>
                                            <td colspan="8"></td>                                    
                                            <td>
                                                <a href="/auth/registrar">
                                                    <button type="submit" class="btn btn-primary btn-xs" >
                                                        <font color='white'>Registrar</font>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                        @include('flash::message')
                                    
        					       @include('Usuario.listar_usu')
                            @endif
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
<script>
    //Initialize Select2 Elements
    $(".select2").select2();

    $(document).ready(function(){
        var oTable=$('#Usuarios').DataTable({
            "responsive": true,  
            "order": [],
            //"paging": false,
            "language": {
                       "info": "Se Encontro _TOTAL_ Registros",
                       "search": "Buscar Docente:",
                       "infoFiltered": " - De _MAX_ Posibles",
                       "zeroRecords": "No Se ha Encontrado el Docente",
                       "infoEmpty": "Registros _TOTAL_",
                       "loadingRecords": "Por favor Espere Estamos Buscando Registros",
                       "processing": "Procesando sus datos",
                        "lengthMenu": "Cantidad de Registros _MENU_"
                     },      

        });
        //oTable.fnDestroy();
    });
    
    function verifico(check){
        {{-- value="{{ $n->ci_usu }}" onclick="verifico(this)" --}}
        elimi = check.value;
        if (confirm("¿Desea Eliminar Al Usuario con la Cedula de Identidad: "+elimi+"?\nRecuerde que esto puede Traer perdida de Informacion") == true) {
            $('.btn-danger').attr("type", "submit");
        } else {
        }
    }
</script>
@endsection