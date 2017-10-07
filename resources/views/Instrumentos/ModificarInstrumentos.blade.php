{{-- Modal --}}
        @if(isset($inst) )
                @foreach($inst as $inst)

<div class="modal fade" id="ModalModificar_{{$inst->id_inst}}" role="dialog">
  <div class="modal-dialogs">
    <div class="modal-content">
      <div class="modal-header"> 
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
        <div class="box-header with-border">
          <h3 class="box-title">Modificar Datos del Instrumento {{$inst->id_inst}}</h3>
        </div>

            <form role="form" method="POST" action="{{ route('controllerinstrumentos.update', $inst->id_inst) }}">
                        <input name="_method" type="hidden" value="PUT">

                        {{ csrf_field() }}
        <div class="modal-body">
          <!-- SELECT2 EXAMPLE -->
            <div class="box box-primary">
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="row">
                  <div class="col-md-5">

                            <div class="form-group">
                  
                                <input type="hidden" class="form-control" name="id_inst" value="{{$inst->id_inst}}">
                                @if($errors->has('id_inst'))
                                  <span style="color:red;">{{ $errors->first('id_inst') }}</span>
                                @endif
                            </div>
                          <!-- /.form-group -->

                            <div class="form-group">
                              <label>Tipo de Instrumento</label>
                                <input type="text" class="form-control" name="tip_inst" value="{{$inst->tip_inst}}" onkeypress="return soloLetras(event)" maxlength="35" minlength="4" placeholder="Ejp: Examen" required autofocus >
                                @if($errors->has('tip_inst'))
                                  <span style="color:red;">{{ $errors->first('tip_inst') }}</span>
                                @endif
                            </div>
                             <div class="form-group">
                              <label>Descripción del Instrumento</label>
                                <input type="text" class="form-control" name="descp_inst" value="{{$inst->descp_inst}}" placeholder="Ejp: Evaluacion Individual" required autofocus >
                                @if($errors->has('descp_inst'))
                                  <span style="color:red;">{{ $errors->first('descp_inst') }}</span>
                                @endif
                            </div>
                              </div>
                          <!-- /.form-group --> 

                  </div>
                      <!-- /.form-group -->
                        <!-- /.col -->
                </div>
                      <!-- /.row -->
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

                @endforeach

@endif