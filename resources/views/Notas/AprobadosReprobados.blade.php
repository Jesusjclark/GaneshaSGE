@extends('layouts.app')
    @section('customcss')
    @endsection
@section('content')
<!-- Main content -->
  <div class="content col-md-offset-1">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">Aprobados Y Reprobados</h4>
                <p class="category">Lista de Secciones</p>
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
                    Aprobados y Reprobados
                </li>
              </ol>
            </section><br><br>  
            <div class="card-content col-md-12">
              @include('flash::message')
              @if(isset($listado))
                <canvas id="pieChart" style="height:250px"></canvas>
                <br>
                <br>
                <br>
                <br>
                <center>
                  <div class="box-body col-md-12">
                    @if($aprobados!=0)
                    <div class="col-md-4">
                      <b> <label style="color: #58FAAC">◕</label>Estudiantes Aprobados</b> {{ $aprobados }}<br> <br>  
                      <table  border="1" style="border: 1px solid #58FAAC;" >
                        <thead>
                          <th>Cedula</th>
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>Ponderacion</th>
                        </thead>
                        @foreach($lista_estu as $lis_estu)
                          @foreach($estudiantes as $lista)
                            @if($lista['acum'] > $ponderacion && $lista['ci_est_not'] == $lis_estu->ci_est)
                              <tbody>

                                <td style="width:150px">
                                  {{ $lista['ci_est_not'] }}
                                </td>
                                <td style="width:150px">{{ $lis_estu->nom_est }}</td>
                                <td style="width:150px">{{ $lis_estu->ape_est }}</td>
                                <td style="width:150px">
                                  {{ $lista['acum'] }}
                                </td>
                              </tbody>
                            @endif
                          @endforeach
                        @endforeach
                      </table>
                    </div>
                    @endif

                    @if($PERcount!=0)
                        <div class="col-md-4">
                      <b> <label style="color: #FFBF00">◕</label> Con Opción a P.E.R. </b>{{ $PERcount }}<br> <br> 
                      <table  border="1" style="border: 1px solid #FFBF00;" >
                        <thead>
                          <th  style="width:100px">Cedula</th>
                          <th style="width:150px">Nombre</th>
                          <th style="width:150px">Apellido</th>
                          <th style="width:100px">Ponderacion</th>
                        </thead>
                        @foreach($lista_estu as $lis_estu)
                          @foreach($estudiantes as $lista)
                            @if($lista['acum'] >$PER && $lista['acum']<$ponderacion||$lista['acum'] ==$PER && $lista['acum']<$ponderacion)
                              @if( $lista['ci_est_not'] == $lis_estu->ci_est)
                                <tbody>
                                  <td>
                                    {{ $lista['ci_est_not'] }}
                                  </td>
                                  <td>{{ $lis_estu->nom_est }}</td>
                                  <td>{{ $lis_estu->ape_est }}</td>
                                  <td>
                                    {{ $lista['acum'] }}
                                  </td>
                                </tbody>
                              @endif
                            @endif
                          @endforeach
                        @endforeach
                      </table>
                    </div>
                    @endif
                    @if($reprobados!=0)
                        <div class="col-md-4">
                      <b > <label style="color: #FF0000">◕</label> Estudiantes Reprobados </b>{{ $reprobados + $PERcount}}<br> <br> 
                      <table  border="1" style="border: 1px solid #FE2E2E;" >
                        <thead>
                          <th  style="width:100px">Cedula</th>
                          <th style="width:150px">Nombre</th>
                          <th style="width:150px">Apellido</th>
                          <th style="width:100px">Ponderacion</th>
                        </thead>
                        @foreach($lista_estu as $lis_estu)
                          @foreach($estudiantes as $lista)
                            @if($lista['acum'] < $ponderacion && $lista['ci_est_not'] == $lis_estu->ci_est)
                              <tbody>
                                <td>
                                  {{ $lista['ci_est_not'] }}
                                </td>
                                <td>{{ $lis_estu->nom_est }}</td>
                                <td>{{ $lis_estu->ape_est }}</td>
                                <td>
                                  {{ $lista['acum'] }}
                                </td>
                              </tbody>
                            @endif
                          @endforeach
                        @endforeach
                      </table>
                    </div>
                    @endif

                  </div>
                </center>
              @else
                @include('Notas.listarAprobadosReprobados')
              @endif
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
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
  @if(isset($listado))
    {{-- <script src="/flot/jquery.flot.min.js"></script>
    <script src="/flot/jquery.flot.pie.js"></script> --}}
    <script src="/chartjs/Chart.min.js"></script>

    <script>

      $(function () {

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
          {
            value: {{ $PERcount }},
            color: "#FFBF00",
            highlight: "#FFBF00",
            label: "P.E.R."
          },{
            value: {{ $reprobados }},
            color: "#FE2E2E",
            highlight: "#FE2E2E",
            label: "Reprobados"
          },
          {
            value: {{ $aprobados }},
            color: "#00a65a",
            highlight: "#00a65a",
            label: "Aprobados"
          }
        ];
        var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 5,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 150,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
      tooltipCornerRadius: 16,
          animateRotate: true,

          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,

          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);
      });
    </script>
  @endif
@endsection
