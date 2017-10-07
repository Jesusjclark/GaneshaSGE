@if($seccuenta > 0 )

@if(isset($sec) )

          <div class="box box-info  collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">
                Trayecto Inicial
                </h3>
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
                    <th>Codigo Seccion</th>
                    <th>Turno</th>
                    <th>Trayecto</th>

                 
                </thead>
                @foreach($sec as $secc)                                    
                    @if($secc->trayecto == '0' && $secc->cod_sec !== 'NULL0')
                        <tbody>
                            <td>{{ $secc->cod_sec }}</td>
                            <td>{{ $secc->turno }}</td>
                            <td>Inicial</td>
             
                          
                            <td>
                                <div class="tools">
                                <a href="/controllersecciones/{{ $secc->cod_sec }}/eliminar" id="eliminar" onclick="verifico(this)">
                                    <button type='button' class='btn btn-danger btn-xs'>
                                            <i><img src="/img/iconos/16x16/cancel.png"></i>
                                    </button>
                                </a>                                                  
                                    <button type='button' onclick="tomo(this)" value="{{ $secc->trayecto }}" class='btn btn-primary btn-xs' data-toggle='modal' data-target="#ModificaSec_{{ $secc->cod_sec }}"> 
                                        <img src="/img/iconos/16x16/edit.png">
                                    </button> 
                               </div>
                            </td>
                        </tbody>
                    @endif
                @endforeach
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
          <div class="box box-info  collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">
                Trayecto I
                </h3>
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
                    <th>Codigo Seccion</th>
                    <th>Turno</th>
                    <th>Trayecto</th>

                 
                </thead>
                @foreach($sec as $secc)                                    
                    @if($secc->trayecto == '1'  && $secc->cod_sec !== 'NULL1') 
                        <tbody>
                            <td>{{ $secc->cod_sec }}</td>
                            <td>{{ $secc->turno }}</td>
                            <td>{{ $secc->trayecto }}</td>
 
                          
                            <td>
                                <div class="tools">
                                <a href="/controllersecciones/{{ $secc->cod_sec }}/eliminar" id="eliminar" onclick="verifico(this)">
                                    <button type='button' class='btn btn-danger btn-xs'>
                                            <i><img src="/img/iconos/16x16/cancel.png"></i>
                                    </button>
                                </a>                                                  
                                    <button type='button' onclick="tomo(this)" value="{{ $secc->trayecto }}" class='btn btn-primary btn-xs' data-toggle='modal' data-target="#ModificaSec_{{ $secc->cod_sec }}"> 
                                        <img src="/img/iconos/16x16/edit.png">
                                    </button> 
                               </div>
                            </td>
                        </tbody>
                    @endif
                @endforeach
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
            <div class="box box-info  collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">
                Trayecto II
                </h3>
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
                    <th>Codigo Seccion</th>
                    <th>Turno</th>
                    <th>Trayecto</th>
               
                </thead>
                @foreach($sec as $secc)                                    
                    @if($secc->trayecto == '2' && $secc->cod_sec !== 'NULL2') 
                        <tbody>
                            <td>{{ $secc->cod_sec }}</td>
                            <td>{{ $secc->turno }}</td>
                            <td>{{ $secc->trayecto }}</td>
        
                          
                            <td>
                                <div class="tools">
                                    <a href="/controllersecciones/{{ $secc->cod_sec }}/eliminar" id="eliminar" onclick="verifico(this)">
                                        <button type='button' class='btn btn-danger btn-xs'>
                                                <i><img src="/img/iconos/16x16/cancel.png"></i>
                                        </button>
                                    </a>                                                  
                                    <button type='button' onclick="tomo(this)" value="{{ $secc->trayecto }}" class='btn btn-primary btn-xs' data-toggle='modal' data-target="#ModificaSec_{{ $secc->cod_sec }}"> 
                                        <img src="/img/iconos/16x16/edit.png">
                                    </button> 
                               </div>
                            </td>
                        </tbody>
                    @endif
                @endforeach
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
            <div class="box box-info  collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">
                Trayecto III
                </h3>
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
                    <th>Codigo Seccion</th>
                    <th>Turno</th>
                    <th>Trayecto</th>

                 
                </thead>
                @foreach($sec as $secc)                                    
                    @if($secc->trayecto == '3' && $secc->cod_sec !== 'NULL3') 
                        <tbody>
                            <td>{{ $secc->cod_sec }}</td>
                            <td>{{ $secc->turno }}</td>
                            <td>{{ $secc->trayecto }}</td>
        
                          
                            <td>
                                <div class="tools">
                                    <a href="/controllersecciones/{{ $secc->cod_sec }}/eliminar" id="eliminar" onclick="verifico(this)">
                                        <button type='button' class='btn btn-danger btn-xs'>
                                                <i><img src="/img/iconos/16x16/cancel.png"></i>
                                        </button>
                                    </a>                                                  
                                    <button type='button' onclick="tomo(this)" value="{{ $secc->trayecto }}" class='btn btn-primary btn-xs' data-toggle='modal' data-target="#ModificaSec_{{ $secc->cod_sec }}"> 
                                        <img src="/img/iconos/16x16/edit.png">
                                    </button> 
                               </div>
                            </td>
                        </tbody>
                    @endif
                @endforeach
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
        <div class="box box-info  collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">
                Trayecto IV
                </h3>
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
                    <th>Codigo Seccion</th>
                    <th>Turno</th>
                    <th>Trayecto</th>
     
                 
                </thead>
                @foreach($sec as $secc)                                    
                    @if($secc->trayecto == '4' && $secc->cod_sec !== 'NULL4') 
                        <tbody>
                            <td>{{ $secc->cod_sec }}</td>
                            <td>{{ $secc->turno }}</td>
                            <td>{{ $secc->trayecto }}</td>
                 
                          
                            <td>
                               <div class="tools">
                                    <a href="/controllersecciones/{{ $secc->cod_sec }}/eliminar" id="eliminar" onclick="verifico(this)">
                                        <button type='button' class='btn btn-danger btn-xs'>
                                                <i><img src="/img/iconos/16x16/cancel.png"></i>
                                        </button>
                                    </a>                                                  
                                    <button type='button' onclick="tomo(this)" value="{{ $secc->trayecto }}" class='btn btn-primary btn-xs' data-toggle='modal' data-target="#ModificaSec_{{ $secc->cod_sec }}"> 
                                        <img src="/img/iconos/16x16/edit.png">
                                    </button> 
                               </div>
                            </td>
                        </tbody>
                    @endif
                @endforeach
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>

          
@else
       <div class="box box-info  collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">
                Trayecto Inicial
                </h3>
              <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <span class="caret"></span>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <span class="caret">dasdsa</span>
              <!-- /.table-responsive -->
            </div>
        </div>
        

@endif
@else
       <div class="box box-info  collapsed-box">
         <center> <h3>No tiene Secciones registradas</h3></center>              
        </div>

@endif
