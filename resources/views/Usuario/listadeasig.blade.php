@if(isset($listaUC))
    @if(count($listaUC) != 0)
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
                </thead>
                    @foreach($listaUC as $uc) 

                        @if($uc->trayecto == '0')

                            <tbody>
                                <td>{{ $uc->cod_uc_pnf }}</td>
                                <td>{{ $uc->cod_uc_nac }}</td>
                                <td>{{ $uc->nom_uc }}</td>

 
    
                                <td>
                                <input type="text" class="hide" id="cod_uc_pnf" value="{{$uc->cod_uc_pnf}}">
 
                                    <div class="tools">                <a href="/controllerusers/{{$uc->cod_uc_pnf}}">
                                  <button type='button' class='btn btn-primary btn-xs'>
                                    <img src="/img/iconos/16x16/edit.png">
                                  </button>                       
                                </a>      
                                    
                                        {{-- data-toggle='modal' data-target="#Modalasig_{{$uc->cod_uc_nac}}" --}}
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
                
                @foreach($listaUC as $uc)                                    
                    @if($uc->trayecto == '1') 
                        <tbody>
                                <td>{{ $uc->cod_uc_pnf }}</td>
                                <td>{{ $uc->cod_uc_nac }}</td>
                                <td>{{ $uc->nom_uc }}</td>

 
    
                                <td>
                                <input type="text" class="hide" id="cod_uc_pnf" value="{{$uc->cod_uc_pnf}}">
 
                                    <div class="tools">                <a href="/controllerusers/{{$uc->cod_uc_pnf}}">
                                  <button type='button' class='btn btn-primary btn-xs'>
                                    <img src="/img/iconos/16x16/edit.png">
                                  </button>                       
                                </a>      
                                    
                                        {{-- data-toggle='modal' data-target="#Modalasig_{{$uc->cod_uc_nac}}" --}}
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
                
                @foreach($listaUC as $uc)                                    
                    @if($uc->trayecto == '2') 
                        <tbody>
                                <td>{{ $uc->cod_uc_pnf }}</td>
                                <td>{{ $uc->cod_uc_nac }}</td>
                                <td>{{ $uc->nom_uc }}</td>
 
 
    
                                <td>
                                <input type="text" class="hide" id="cod_uc_pnf" value="{{$uc->cod_uc_pnf}}">
 
                                    <div class="tools">                <a href="/controllerusers/{{$uc->cod_uc_pnf}}">
                                  <button type='button' class='btn btn-primary btn-xs'>
                                    <img src="/img/iconos/16x16/edit.png">
                                  </button>                       
                                </a>      
                                    
                                        {{-- data-toggle='modal' data-target="#Modalasig_{{$uc->cod_uc_nac}}" --}}
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
                
                @foreach($listaUC as $uc)                                    
                    @if($uc->trayecto == '3') 
                       <tbody>
                                <td>{{ $uc->cod_uc_pnf }}</td>
                                <td>{{ $uc->cod_uc_nac }}</td>
                                <td>{{ $uc->nom_uc }}</td>

 
    
                                <td>
                                <input type="text" class="hide" id="cod_uc_pnf" value="{{$uc->cod_uc_pnf}}">
 
                                    <div class="tools">                <a href="/controllerusers/{{$uc->cod_uc_pnf}}">
                                  <button type='button' class='btn btn-primary btn-xs'>
                                    <img src="/img/iconos/16x16/edit.png">
                                  </button>                       
                                </a>      
                                    
                                        {{-- data-toggle='modal' data-target="#Modalasig_{{$uc->cod_uc_nac}}" --}}
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
                
                @foreach($listaUC as $uc)                                    
                    @if($uc->trayecto == '4') 
                        <tbody>
                                <td>{{ $uc->cod_uc_pnf }}</td>
                                <td>{{ $uc->cod_uc_nac }}</td>
                                <td>{{ $uc->nom_uc }}</td>

 
    
                                <td>
                                <input type="text" class="hide" id="cod_uc_pnf" value="{{$uc->cod_uc_pnf}}">
 
                                    <div class="tools">                <a href="/controllerusers/{{$uc->cod_uc_pnf}}">
                                  <button type='button' class='btn btn-primary btn-xs'>
                                    <img src="/img/iconos/16x16/edit.png">
                                  </button>                       
                                </a>      
                                    
                                        {{-- data-toggle='modal' data-target="#Modalasig_{{$uc->cod_uc_nac}}" --}}
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


@endif
@endif
