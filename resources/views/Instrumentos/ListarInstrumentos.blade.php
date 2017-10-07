@if(isset($inst) )


        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">
                Instrumentos
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
                    <th>Tipo de Instrumento</th>
                    <th>Descripción de Instrumento</th>
             
                </thead>
                @foreach($inst as $inst)                                    
                 
                        <tbody>
                            <td>{{ $inst->tip_inst }}</td>
                            <td>{{ $inst->descp_inst }}</td>
                            <td>
                                <div class="tools">
                                  <a href="/controllerinstrumentos/{{ $inst->id_inst }}/eliminar"  id="eliminar" onclick="verifico(this)" >
                                    <button type='submit' class='btn btn-danger btn-xs'>
                                      <i><img src="/img/iconos/16x16/cancel.png"></i>
                                    </button>
                                  </a>          
                                    <button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target="#ModalModificar_{{$inst->id_inst}}"> 
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
