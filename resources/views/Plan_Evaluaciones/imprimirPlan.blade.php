<!DOCTYPE html>
<html lang="en">
    <head>
  <meta charset="utf-8">
  <link rel="apple-touch-icon" sizes="76x76" href="/img/icon-evernote.png" />
  <link rel="icon" type="image/png" href="/img/icon-evernote.png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Ganesha[SIGE]</title>


  <link rel="stylesheet" href="/css/bootstrap.css">

  <link rel="stylesheet" href="/css/AdminLTE.css">

  <link rel="stylesheet" href="/css/_all-skins.css">

    </head>
    <body >
       <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="card">
<img src="/img/membrerte juventud.jpg">
                            <div class="card-content">
@if(isset($uni_crr))
    @if(isset($instrumentos))
        @foreach($uni_crr as $uc)
            @foreach($planeva as $plan)
                @foreach($master as $Tpuente)

                    <hr>
                        <!--Hidenssss-->
                    <div  class="table-responsive no-padding">
                        <table class="table" border="1">
                            <tr>
                                <th style="width: 150px;">Unidad Curricular:<label> 
                                {{$uc->nom_uc}}</label></th>
                                <th style="width: 50px;">Trayecto:<label>
                                @if($uc->trayecto==0)
                                    Inicial
                                @endif
                                @if($uc->trayecto==1)
                                    I
                                @endif
                                @if($uc->trayecto==2)
                                    II
                                @endif
                                @if($uc->trayecto==3)
                                    III
                                @endif
                                @if($uc->trayecto==4)
                                    IV
                                @endif
                                </label></th>
                                <th style="width: 30px;">Fase:<label> @if($uc->periodo=='true') I @else II @endif</label></th>
                                <th style="width: 90px;">Densidad:<label> Semanal</label></th>
                                <th style="width: 90px;">Hora Acad.:<label>{{$uc->hta}}</label></th>
                                <th style="width: 30px;">HTE:<label> {{$uc->hte}}</label></th>
                                <th style="width: 30px;">HTT:<label> {{$uc->htt}}</label></th>
                            </tr>
                        </table>
                        <table class="table"  border="1">
                            <tr>
                                <th style="width: 152px;">
                                    Profesor: 
                                    <label>
                                        @foreach($usuario as $usu)
                                            {{$usu->name}}
                                        @endforeach
                                    </label>
                                </th>
                                <th style="width: 150px;">Lapso:<label> I-2017</label></th>
                            </tr>
                        </table><br>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th style="width: 40px;">
                                        <center>Unidad</center>
                                    </th>
                                    <th style="width: 150px;">
                                        <center>Contenido</center>
                                    </th>
                                    <th class="text-center"  style="width: 500px;">
                                        <table class="table">
                                            <tr>
                                                <center>Estrategias de Evaluación</center>
                                            </tr>
                                            <tr>
                                                <td style="width: 100px;">
                                                    Tecnicas
                                                </td>
                                                <td style="width: 100px;">
                                                    Instrumento
                                                </td>
                                                <td style="width: 200px;">
                                                    Criterios Evaluetivos
                                                </td>
                                            </tr>
                                        </table>
                                    </th>
                                    <th>                                            
                                        <table class="table">
                                            <tr>
                                                <center>Forma de Participacion</center>
                                            </tr>
                                            <tr>
                                                <td style="width: 10px;">
                                                    <center>A</center>
                                                </td>
                                                <td style="width: 10px;">
                                                    <center>C</center>
                                                </td>
                                                <td style="width: 10px;">
                                                    <center>D</center>
                                                </td>
                                            </tr>
                                        </table>
                                    </th>
                                    <th style="width: 70px;">
                                        <center>Ponderación</center>
                                    </th>
                                    <th style="width: 100px;">
                                        <center>Fecha Propuesta</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($evaluaciones as $eva)
                                    <tr class="text-center" >
                                        <td style="width: 40px;">
                                            {{ $eva->unidad }}
                                        </td>
                                        <td style="width: 150px;">
                                            {{ $eva->contenido }}
                                        </td>
                                        <td style="width: 500px;">
                                            <table>
                                                <tr>
                                                </tr>
                                                <tr class="text-center" >
                                                    <td style="width: 100px;">
                                                        {{ $eva->tecnica }}
                                                    </td>
                                                    <td style="width: 100px;">
                                                        @foreach($instrumentos as $in)
                                                            @if($eva->id_inst_eva == $in->id_inst)
                                                                {{ $in->tip_inst }}
                                                            @endif 
                                                        @endforeach
                                                    </td>
                                                    <td style="width: 200px;">
                                                        {{ $eva->criterio }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="thd" >
                                            <table class="table">
                                                <tr>
                                                    <td style="width: 10px;">
                                                        <input type="checkbox" name="A"value="TRUE">
                                                    </td>
                                                    <td style="width: 10px;">
                                                        <input type="checkbox" name="C" value="TRUE" >
                                                    </td>
                                                    <td style="width: 10px;">
                                                        <input type="checkbox" name="D" value="TRUE" >
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td class="tdp" style="width: 70px;">
                                            {{ $eva->ponderacion }}-Ptos
                                        </td>
                                        <td class="tdf" style="width: 70px;">
                                            {{ $eva->fec_prop}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>                                            
                        </table>
                    </div>
 <div class="col-md-4">
                    <div class="form-group">
                        _____________________________ 
                        FIRMA DE PROFESOR
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        _____________________________ 
                        FIRMA DE PROFESOR
                    </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        _____________________________ 
                        FIRMA DE PROFESOR    
                    </div>
                    </div>   
                @endforeach 
            @endforeach
        @endforeach
    @endif
@endif
                    
                    <!-- /.nav-tabs-custom -->
                </div>

            </div>
        </div>
        
        <script>
        window.print();
        </script>
    </body>
</html>
