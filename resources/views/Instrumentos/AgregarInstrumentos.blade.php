{{-- Modal --}}
<div class="modal fade" id="ModalAgregar" role="dialog">
	<div class="modal-dialogs">
		<div class="modal-content">
			<div class="modal-header"> 
			    <button type="button" class="close" data-dismiss="modal">x</button>
				<div class="box-header with-border">
					<h3 class="box-title">Agregar instrumento</h3>
				</div>

            	<form role="form" method="POST" action="/controllerinstrumentos/agregar">
                        {{ csrf_field() }}
				    <div class="modal-body">
					<!-- SELECT2 EXAMPLE -->
						<div class="box box-primary">
					        <!-- /.box-header -->
					        <div class="box-body">
					         	<div class="row">
									<div class="col-md-5">

								          <!-- /.form-group -->

						                <div class="form-group">
							                <label>Tipo de Instrumento</label>
						                    <input type="text" class="form-control" name="tip_inst"  onkeypress="return soloLetras(event)" maxlength="35" minlength="4" placeholder="Ejp: Examen" required autofocus style="width: 300px;">
						                    @if($errors->has('tip_inst'))
                    							<span style="color:red;">{{ $errors->first('tipo_inst') }}</span>
                  							@endif
						                </div>
						                 <div class="form-group">
							                <label>Descripcion del instrumento</label>
						                    <input type="text" class="form-control" name="descp_inst" placeholder="Ejp: Evaluacion Individual" required autofocus  style="width: 500px;">
						                    @if($errors->has('descp_inst'))
                    							<span style="color:red;">{{ $errors->first('tipo_inst') }}</span>
                  							@endif
						                </div>
								          <!-- /.form-group -->
							        
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


