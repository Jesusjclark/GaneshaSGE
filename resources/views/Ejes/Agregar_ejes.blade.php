
{{-- Modal --}}
<div class="modal fade" id="ModalAgregarEje" role="dialog" style="display: none;">
	<div class="modal-dialogs" role="document">
		<div class="modal-content">
			<div class="modal-header"> 
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
				<div class="box-header with-border">
					<h3 class="box-title">Agregar Datos del Eje</h3>
				</div>

            	<form role="form" method="POST" action="/controllerejes/agregar">
                        {{ csrf_field() }}
				    <div class="modal-body">
					<!-- SELECT2 EXAMPLE -->
						<div class="box box-primary">
					        <!-- /.box-header -->
					        <div class="box-body">
					         	<div class="row">
									<div class="col-md-4">
						                <div class="form-group">
						                 	<label>Nombre del Eje</label>
						                    <input type="text" class="form-control" name="nom_eje" onkeypress="return soloLetras(event)" maxlength="20" minlength="4" placeholder="Ejp: Cutural" required autofocus>
						                    @if($errors->has('nom_eje'))
                    							<span style="color:red;">{{ $errors->first('nom_eje') }}</span>
                  							@endif
						                </div>
								          <!-- /.form-group -->

						                <div class="form-group">
							                <label>Descripcion</label>
                  							<textarea type="text" class="form-control" name="descripcion" placeholder="Ejp: Es Importante Saber de Nuestras Raizes" required autofocus style="width: 200px; height: 80px;"  onkeypress="return soloLetras(event)" ></textarea>
						                    @if($errors->has('descripcion'))
                    							<span style="color:red;">{{ $errors->first('descripcion') }}</span>
                  							@endif
						                </div>
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
</div>

