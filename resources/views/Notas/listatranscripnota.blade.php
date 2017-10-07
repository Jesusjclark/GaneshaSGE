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
                                        <th>Estado de Evaluación</th>
                                        <th>N° de Unidad</th>
                                        <th>Fecha propuesta</th>
                                        <th>Tipo Instrumento</th>
                                        <th>Contenido</th>

                                        <th>Seleccionar</th>
                                   
                                    </thead>
                                   <form role="form" method="POST" action="/transcribir/notas">
  									{{ csrf_field() }}

                                    @if(isset($planes))
                                        @foreach($planes as $plan)
                                            @if($plan->cod_sec_plan == $pu->id_uc_sec)
                                                @if(isset($evas))
                                                        @foreach($evas as $eva)
                                                    @if($eva->id_plan_eva == $plan->id_plan)
                                                    <tbody>
                                                                                                    
                                                        <td>
                                                        @if($eva->corte == 'ASIGNADA')
                                                            <img  style="display:auto;width: 100%; border: 0;max-width: 25px; padding: 0px;" src="/img/iconos/16x16/download2.png"/> Disponible
                                                            @endif

                                                            @if($eva->corte == 'TRANSCRITA')
                                                            <img style="display:auto;width: 100%; border: 0;max-width: 25px; padding: 0px;" src="/img/iconos/16x16/exclamation-mark.png" width="10" height="10"/> Transcrita
                                                            @endif

                                                            @if($eva->corte == 'SIN ASIGNAR')
                                                            <img style="display:auto;width: 100%; border: 0;max-width: 25px; padding: 0px;" src="/img/iconos/16x16/advertencia.png" width="10" height="10"/> SIN ASGINAR
                                                            @endif
                                                        </td>
                                                        <td>{{ $eva->unidad}}</td>
                                                        @if($eva->fec_res == "2000-01-01")
                                                        <td>{{ $eva->fec_prop }}</td>
                                                        @else

                                                        <td>{{ $eva->fec_res }}</td>

                                                        @endif
                                                            @if(isset($instrument))
                                                                @foreach($instrument as $inst)
                                                                    @if($inst->id_inst == $eva->id_inst_eva)
                                                                        <td>{{ $inst->tip_inst }}</td>

                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        
                                                        <td>{{ $eva->contenido }}</td>

                                                                
                                                        <td>
                                                       @if($eva->corte != 'SIN ASIGNAR')
                                                        <input type="text" class='hide' name="unidadsec" value="{{$plan->cod_sec_plan}}">

                                                             <input type="checkbox" id="checkbox" name="checkid[]" value="{{$eva->id_eva}}">
                                                        @endif
                                                             
                                                        </td>
                                                    
                                                    </tbody>
                                                    @endif
                                                    @endforeach   
                                                 @endif
                                             @endif
                                         @endforeach   
                                     @endif   
                                </table>
                                 <button type="submit" id="Enviar" onclick="verifico(this)" class="btn btn-primary btn-xs pull-right">Generar Corte</button>
                                 </form>
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