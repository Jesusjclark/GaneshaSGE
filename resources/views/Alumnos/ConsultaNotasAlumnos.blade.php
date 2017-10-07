@extends('layouts.Principal')
@section('content')
        <div class="container-fluid"  >
            <div class="row col-md-8 col-md-offset-2"><br><br><br>
                    <div class="card" id="PrintDiv">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">Consulta de Nota</h4>
                            
                                @foreach($estudiante as $estu)
                                    <h5><b>{{ $estu->nom_est }} {{ $estu->ape_est }}</b></h5>
                                @endforeach
                        </div><!--fin card header-->

                        <div class="card-content">
                            @include('flash::message')
                            
                            <div class="form-group col-md-12">
                                <select class="select2" id="SecMaster" style="width: 100%;"  data-placeholder="Buscar Seccion" >
                                @if(isset($estu_sec))            
                                    @foreach($puente as $puent)
                                        @foreach($uni_crr as $uc)
                                            @if($puent->cod_unidad == $uc->cod_uc_pnf)
                                                <option value='{{ $puent->id_uc_sec}}' title="{{ $puent->cod_unidad }}">{{ $puent->cod_seccion.' '.$uc->nom_uc }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endif
                                </select>
                        @include('flash::message')
                            </div>  
                            <div class="form-group  col-md-10" id="data" >
                                <table id="estu" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Contenido</th>
                                            <th>Tipo deEvaluacion</th>
                                            <th>Nota</th>
                                        </tr>
                                    </thead>
                                    <tbody id="aqui">
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                    </tbody>
                                </table>  
                            </div>
                        </div>
                        <button type="button" onclick="window.print();" id="Imprimir" class="col-md-offset-11 btn btn-xs btn-primary">Imprimir</button>
<br><br>
                    </div>
                </div>
        </div>
@endsection
@section('customjs')
  <script src="/js/select2.full.js"></script>

<script src="/datatables/jquery.dataTables.js"></script>
<script src="/datatables/dataTables.bootstrap.min.js"></script>
        
<script>
var c = 0;

var notas ='';
//Activar modar a entrar a la pagina
    $(window).load(function(){
        //Initialize Select2 Elements

        $(".select2").select2({
            //maximumSelectionLength: 1,
            allowClear: true,
            tags: false,
            language: "es"
        });
            $('#data').hide();
            $('#Imprimir').hide();


$('#estu').DataTable({
        "sort": false,
            "paging": false,


            "searching": false,
            "language": {
                "info": "Se Encontro _TOTAL_ Registros",
                "search": "Introdusca Cedula:",
                "infoFiltered": " - De _MAX_ Posibles",
                "zeroRecords": "No Se ha Encontrado el Estudiante",
                "infoEmpty": "Registros _TOTAL_",
                "loadingRecords": "Por favor Espere Estamos Buscando Registros",
                "processing": "Procesando sus datos"
            },
        });

    });
$('.select2').val('');

$('#SecMaster').on('change', function(e){
    console.log(e);
    var id_master = e.target.value;
            $('#data').show();
            $('#Imprimir').show();
            $('#aqui').empty();

    $.get("/ajax-master/"+id_master+"/"+{{ $ci_est }}, function(data){
        $.each(data, function(consultanotaestu, evasObj){  
    console.log(evasObj);

            //c = c+1
            notas='<tr><td>'+evasObj.contenido+'</td><td>'+evasObj.tipoinst+'</td><td>'+evasObj.nota+'/'+evasObj.ponderacion+'</td></tr>';
                //notas = evasObj.mensaje;
          {{--   cuenta = {{ count($alumnos) }};

            for (var i = 1; i <= cuenta; i++) {
                ced_new = estObj.ci_est;
                ced_tab = $('#'+i).val();
                if (ced_new == ced_tab) {
                    {{ $i = $i-1 }}
                    alert('El Estudiante ya se encuentra Asignado a esta Seccion O lo acaba de agregar');
                    estud = '';
                }           
            }--}} 
            $('#aqui').append(notas);


        });
    });


});

</script>
@endsection