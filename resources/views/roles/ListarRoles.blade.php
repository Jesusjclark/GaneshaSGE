@if(isset($rol) )


        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">
               Roles
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
                      <th align="center">Nombre del Rol</th>
                      <th align="center">Permisologias</th>
                      <th align="center">Acción</th>                      
                  </thead>
                                      @foreach($rol as $rol)                                              

                  <tbody>
                      <td>{{ $rol->nom_rol }}</td>
                          <td>
                            @foreach($rol->modulos as $modu)
                              <b>✓{{ $modu->nom_mod }}</b> <br>
                            @endforeach
                          </td>
                          <td>
                            <div class="tools">
                              <a href="/controllerroles/{{ $rol->id_rol }}/eliminar" id="eliminar" onclick="verifico(this)">
                                <button type='submit' class='btn btn-danger btn-xs'>
                                  <i><img src="/img/iconos/16x16/cancel.png"></i>
                                </button>
                              </a>          
                              <button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target="#ModalRoles_{{$rol->id_rol}}"> 
                                <img src="/img/iconos/16x16/edit.png">
                              </button> 
                            </div>
                          </td>
                  </tbody>
                                      @endforeach

                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>
               
@endif
