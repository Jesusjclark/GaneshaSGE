@if(isset($alum) )

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
                    <th>CI Estudiante</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                   
                </thead>
                @foreach($alum as $alum)                                    
                    @if($alum->cod_pnf_est == '1') 
                        <tbody>
                            <td>{{ $alum->cod_pnf_est }}</td>
                            <td>{{ $alum->ci_est }}</td>
                            <td>{{ $alum->nom_est }}</td>
                            <td>{{ $alum->ape_est }}</td>
                            
                            <td>
                                <div class="tools">
                                    <button type='button' class='btn btn-danger btn-xs'>
                                        <a href="/controlleralumnos/{{ $alum->cod_uc_pnf }}/verifica">
                                            <i><img src="/img/iconos/16x16/cancel.png"></i>
                                        </a>
                                    </button>

                                    <button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target="#ModalAgregar"> 
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
                            <th>PNF</th>
                            <th>Codigo Seccion</th>
                            <th>Turno</th>
                        </thead>
                        
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
                           <th>PNF</th>
                            <th>Codigo Seccion</th>
                            <th>Turno</th>
                        </thead>
                        
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
                          <th>PNF</th>
                            <th>Codigo Seccion</th>
                            <th>Turno</th>
                        </thead>
                        
                        </table>
                        </div>
              <!-- /.table-responsive -->
                    </div>
            <!-- /.box-body -->
          </div>
         
@endif
