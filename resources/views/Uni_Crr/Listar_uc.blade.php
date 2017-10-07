@if(isset($uni_crr) )
    @if(count($uni_crr) != 0)
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
                    <th>Codigo Pnf</th>
                    <th>Codigo Nacional</th>
                    <th>Nombre</th>
                    <th>Creditos</th>
                    <th>HTA</th>
                    <th>HTE</th>
                    <th>HTT</th>     
                    <th>Periodo</th>
                    <th>Accion</th>
                </thead>
                @foreach($uni_crr as $uc)                                    
                    @if($uc->trayecto == '0') 
                        <tbody>
                            <td>{{ $uc->cod_uc_pnf }}</td>
                            <td>{{ $uc->cod_uc_nac }}</td>
                            <td>{{ $uc->nom_uc }}</td>
                            <td>{{ $uc->creditos }}</td>
                            <td>{{ $uc->hta }}</td>
                            <td>{{ $uc->hte }}</td>
                            <td>{{ $uc->htt }}</td>
                            <td>{{ $uc->periodo }}</td>
                            <td>
                                <div class="tools">
                                    <a href="/controllerunidadcurriculars/{{ $uc->cod_uc_pnf }}/eliminar" id="eliminar" onclick="verifico(this)">
                                        <button type='button' class='btn btn-danger btn-xs'>
                                            <i><img src="/img/iconos/16x16/cancel.png"></i>
                                        </button>                                        
                                    </a>
                                                  
                                    <button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target="#ModifUC_{{$uc->cod_uc_nac}}"> 
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
                    <th>Codigo Pnf</th>
                    <th>Codigo Nacional</th>
                    <th>Nombre</th>
                    <th>Creditos</th>
                    <th>HTA</th>
                    <th>HTE</th>
                    <th>HTT</th>     
                    <th>Periodo</th>
                    <th>Accion</th>
                </thead>
                @foreach($uni_crr as $uc)                                    
                    @if($uc->trayecto == '1') 
                        <tbody>
                            <td>{{ $uc->cod_uc_pnf }}</td>
                            <td>{{ $uc->cod_uc_nac }}</td>
                            <td>{{ $uc->nom_uc }}</td>
                            <td>{{ $uc->creditos }}</td>
                            <td>{{ $uc->hta }}</td>
                            <td>{{ $uc->hte }}</td>
                            <td>{{ $uc->htt }}</td>
                            <td>{{ $uc->periodo }}</td>
                            <td>
                                <div class="tools">
                                    <a href="/controllerunidadcurriculars/{{ $uc->cod_uc_pnf }}/eliminar" id="eliminar" onclick="verifico(this)">
                                        <button type='button' class='btn btn-danger btn-xs'>
                                            <i><img src="/img/iconos/16x16/cancel.png"></i>
                                        </button>                                        
                                    </a>
                                                  
                                    <button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target="#ModifUC_{{$uc->cod_uc_nac}}"> 
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
                    <th>Codigo Pnf</th>
                    <th>Codigo Nacional</th>
                    <th>Nombre</th>
                    <th>Creditos</th>
                    <th>HTA</th>
                    <th>HTE</th>
                    <th>HTT</th>     
                    <th>Periodo</th>
                    <th>Accion</th>
                </thead>
                @foreach($uni_crr as $uc)                                    
                    @if($uc->trayecto == '2') 
                        <tbody>
                            <td>{{ $uc->cod_uc_pnf }}</td>
                            <td>{{ $uc->cod_uc_nac }}</td>
                            <td>{{ $uc->nom_uc }}</td>
                            <td>{{ $uc->creditos }}</td>
                            <td>{{ $uc->hta }}</td>
                            <td>{{ $uc->hte }}</td>
                            <td>{{ $uc->htt }}</td>
                            <td>{{ $uc->periodo }}</td>

                            <td>
                                <div class="tools">
                                    <a href="/controllerunidadcurriculars/{{ $uc->cod_uc_pnf }}/eliminar" id="eliminar" onclick="verifico(this)">
                                        <button type='button' class='btn btn-danger btn-xs'>
                                            <i><img src="/img/iconos/16x16/cancel.png"></i>
                                        </button>                                        
                                    </a>
                                                  
                                    <button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target="#ModifUC_{{$uc->cod_uc_nac}}"> 
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
                    <th>Codigo Pnf</th>
                    <th>Codigo Nacional</th>
                    <th>Nombre</th>
                    <th>Creditos</th>
                    <th>HTA</th>
                    <th>HTE</th>
                    <th>HTT</th>     
                    <th>Periodo</th>
                    <th>Accion</th>
                </thead>
                @foreach($uni_crr as $uc)                                    
                    @if($uc->trayecto == '3') 
                        <tbody>
                            <td>{{ $uc->cod_uc_pnf }}</td>
                            <td>{{ $uc->cod_uc_nac }}</td>
                            <td>{{ $uc->nom_uc }}</td>
                            <td>{{ $uc->creditos }}</td>
                            <td>{{ $uc->hta }}</td>
                            <td>{{ $uc->hte }}</td>
                            <td>{{ $uc->htt }}</td>
                            <td>{{ $uc->periodo }}</td>

                            <td>
                                <div class="tools">
                                    <a href="/controllerunidadcurriculars/{{ $uc->cod_uc_pnf }}/eliminar" id="eliminar" onclick="verifico(this)">
                                        <button type='button' class='btn btn-danger btn-xs'>
                                            <i><img src="/img/iconos/16x16/cancel.png"></i>
                                        </button>                                        
                                    </a>
                                                  
                                    <button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target="#ModifUC_{{$uc->cod_uc_nac}}"> 
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
                    <th>Codigo Pnf</th>
                    <th>Codigo Nacional</th>
                    <th>Nombre</th>
                    <th>Creditos</th>
                    <th>HTA</th>
                    <th>HTE</th>
                    <th>HTT</th>     
                    <th>Periodo</th>
                    <th>Accion</th>
                </thead>
                @foreach($uni_crr as $uc)                                    
                    @if($uc->trayecto == '4') 
                        <tbody>
                            <td>{{ $uc->cod_uc_pnf }}</td>
                            <td>{{ $uc->cod_uc_nac }}</td>
                            <td>{{ $uc->nom_uc }}</td>
                            <td>{{ $uc->creditos }}</td>
                            <td>{{ $uc->hta }}</td>
                            <td>{{ $uc->hte }}</td>
                            <td>{{ $uc->htt }}</td>
                            <td>{{ $uc->periodo }}</td>

                            <td>
                                <div class="tools">
                                    <a href="/controllerunidadcurriculars/{{ $uc->cod_uc_pnf }}/eliminar" id="eliminar" onclick="verifico(this)">
                                        <button type='button' class='btn btn-danger btn-xs'>
                                            <i><img src="/img/iconos/16x16/cancel.png"></i>
                                        </button>                                        
                                    </a>
                                                  
                                    <button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target="#ModifUC_{{$uc->cod_uc_nac}}"> 
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
        <div class="col-md-4 col-md-offset-4">
            <b>No tiene Unidades Curriculares Ingresadas en el Sistema<br>
                por Favor Registre</b><br><br>
        </div>
    @endif
@endif
