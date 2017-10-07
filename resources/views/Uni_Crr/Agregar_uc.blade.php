
{{-- Modal --}}
<div class="modal fade" id="ModalAgregar" role="dialog">
	<div class="modal-dialogs">
		<div class="modal-content">
			<div class="modal-header"> 
			    <button type="button" class="close" data-dismiss="modal">x</button>
				<div class="box-header with-border">
					<h3 class="box-title">Agregar Unidad Curricular</h3>
				</div>

            	<form role="form" method="POST" action="/controllerunidadcurriculars/agregar">
                        {{ csrf_field() }}
				    <div class="modal-body">
					<!-- SELECT2 EXAMPLE -->
						<div class="box box-primary">
					        <!-- /.box-header -->
					        <div class="box-body">
					         	<div class="row">
									<div class="col-md-4">

						                <div class="form-group">
						                 	<label>Codigo de la unidad</label>
						                    <input type="text" class="form-control" name="C_uc" maxlength="8" minlength="7" placeholder="Ej. PIEL123" onblur="ponerMayusculas(this);" required autofocus>
						                    @if($errors->has('C_uc'))
                    							<span style="color:red;">{{ $errors->first('C_uc') }}</span>
                  							@endif
						                </div>
								          <!-- /.form-group -->

						                <div class="form-group">
							                <label>Trayecto</label>
						                     <select class="select"  simple="simple" data-placeholder="Seleccione Trayecto" style="width: 100%;" name="Trayecto" required>
										            <option value='0'>Inicial</option>
										            <option value='1'>I</option>
							                  		<option value='2'>II</option>
							                  		<option value='3'>III</option>
							                  		<option value='4'>IV</option>
									        </select>
						                </div>
								          <!-- /.form-group -->
							          
						                <div class="form-group">
						                 	<label>HTT</label>
						                 	<input type="text" class="form-control" name="HTT"  maxlength="2" minlength="1" onKeyPress="return soloNumeros(event)" placeholder="Ej. x" required autofocus>
						                    @if($errors->has('HTT'))
                    							<span style="color:red;">{{ $errors->first('HTT') }}</span>
                  							@endif						                
						                </div>
								          <!-- /.form-group -->

								    </div>
						            <!-- /.col -->
						            <div class="col-md-4">
						                <div class="form-group">
						                  	<label>Codigo Nacional de la Unidad</label>
						                    <input type="text" class="form-control" name="C_ucn" maxlength="8" minlength="7" placeholder="Ej. PIEL123" onblur="ponerMayusculas(this);" required autofocus>
						                    @if($errors->has('C_ucn'))
                    							<span style="color:red;">{{ $errors->first('C_ucn') }}</span>
                  							@endif						                    
						                </div>
								          <!-- /.form-group -->
						                
						                <div class="form-group">
						                 	<label>Creditos</label>
						                    <input type="text" class="form-control" name="Creditos" maxlength="2" max="10" minlength="1" onKeyPress="return soloNumeros(event)" placeholder="Ej. x" required autofocus>
						                    @if($errors->has('Creditos'))
                    							<span style="color:red;">{{ $errors->first('Creditos') }}</span>
                  							@endif						                
						                </div>
								          <!-- /.form-group -->
								    
						                <div class="form-group">
						                  	<label>HTE</label>
						                  	<input type="text" class="form-control" name="HTE" maxlength="2" minlength="1" onKeyPress="return soloNumeros(event)" placeholder="Ej. x" required autofocus>
						                    @if($errors->has('HTE'))
                    							<span style="color:red;">{{ $errors->first('HTE') }}</span>
                  							@endif						                
						                </div>
								          <!-- /.form-group -->
									</div>
						            <div class="col-md-4">

						                <div class="form-group">
						                  	<label>Nombre de la Unidad</label>
						                  	<input type="text" class="form-control" name="N_uc"  maxlength="30" minlength="10" placeholder="Ej. Matematica 1" onblur="ponerMayusculas(this);" required autofocus>
						                    @if($errors->has('N_uc'))
                    							<span style="color:red;">{{ $errors->first('N_uc') }}</span>
                  							@endif						                  	
						                </div>
								          <!-- /.form-group -->

										<div class="form-group">
								            <label>Ejes</label>		
							                <select class="form-control select2" multiple="multiple" data-placeholder="Seleccione Ejes" style="width: 100%;" name="cod_eje[]" required>
											@if(isset($ejes) )
												@foreach($ejes as $e)
										            <option value='{{ $e->cod_eje }}' title="{{ $e->descripcion }}">{{ $e->nom_eje }}</option>
							                  	@endforeach
							                @endif

									        </select>
									    </div>

						                <div class="form-group">
						                  	<label>HTA</label>
						                  	<input type="text" class="form-control" name="HTA" maxlength="2" minlength="1" onKeyPress="return soloNumeros(event)" placeholder="Ej. x" required autofocus>
						                    @if($errors->has('HTA'))
                    							<span style="color:red;">{{ $errors->first('HTA') }}</span>
                  							@endif						                
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
</div>

