@if(isset($uc))
    @if(isset($puente) )
        @foreach($uc as $u)
            @foreach($puente as $pu)
                @if($u->cod_uc_pnf == $pu->cod_unidad)
                    <div class="box box-info  collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title">
                        <b> Unidad:</b> {{ $u->nom_uc}}<br>
                        <b> Seccion: </b> {{ $pu->cod_seccion}}<br>
                        @if(isset($secc))
                        @foreach($secc as $sec)
                        @if($sec->cod_sec == $pu->cod_seccion)
                        <b>Turno:</b> {{ $sec->turno }}
                        @endif
                        @endforeach
                        @endif
                            </h3>
                             @if(session()->has('msj') )
                                    <div class="alert alert-success">{{ session('msj') }}
                                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
                                @endif
                          <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <span class="caret"></span>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
              
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                        <th>N° de Unidad</th>
                                        <th>Fecha propuesta</th>
                                        <th>Tipo Instrumento</th>
                                        <th>Ponderación</th>
                                        <th>Contenido</th>

                                        <th>Accion</th>
                                   
                                    </thead>
                                    @if(isset($planes))
                                        @foreach($planes as $plan)
                                            @if($plan->cod_sec_plan == $pu->id_uc_sec)
                                                @if(isset($evas))
                                                    @foreach($evas as $eva)
                                                    @if($eva->id_plan_eva == $plan->id_plan)
                                                    <tbody>
                                                   
                                                        <td>{{ $eva->unidad}}</td>
                                                        <td>{{ $eva->fec_prop }}</td>

                                                            @if(isset($instrument))
                                                                @foreach($instrument as $inst)
                                                                    @if($inst->id_inst == $eva->id_inst_eva)
                                                                        <td>{{ $inst->tip_inst }}</td>

                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        <td>{{$eva->ponderacion}}</td>
                                                        <td>{{ $eva->contenido }}</td>

                                                                 

                                                        <td>

                                                             <input type="text" class="hide" id="cod_uc_pnf" value="{{$eva->id_eva}}">
 
                                                             <div class="tools">                <a href="/controllernotas/{{$eva->id_eva}}/{{ $pu->id_uc_sec}}">
                                                              <button title="Verificar" type='button' class='btn btn-primary btn-xs'>
                                                                <img src="/img/iconos/16x16/checkbox.png">
                                                              </button>                       
                                                            </a>      
                                                        </td>
                                                        <td>
                                                             <input type="text" class="hide" id="cod_uc_pnf" value="{{$eva->id_eva}}">
 
                                                             <div class="tools">      <a href="/controllernotas/correo/{{$eva->id_eva}}/{{ $pu->id_uc_sec}}">
                                                              <button title="Publicar Notas" type='button' class='btn btn-warning btn-xs'>
                                                                <img src="/img/iconos/16x16/mail.png">
                                                              </button>
                                                                                     
                                                            </a>      
                                                        </td>
                                                    
                                                    </tbody>
                                                    @endif
                                                    @endforeach   
                                                 @endif
                                             @endif
                                         @endforeach   
                                     @endif   
                                </table>
                            </div>
                          <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                @endif
            @endforeach     
        @endforeach     
    @endif
@endif
