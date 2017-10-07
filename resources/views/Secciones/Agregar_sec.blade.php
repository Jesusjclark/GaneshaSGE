<div class="modal fade" id="ModalAgregar" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"> 
			    <button type="button" class="close" data-dismiss="modal">x</button>
				<div class="box-header with-border">
					<h3 class="box-title">Agregar Seccion</h3>
				</div>

            	<form role="form" method="POST" action="/controllersecciones/agregar">
                        {{ csrf_field() }}
				    <div class="modal-body">
					<!-- SELECT2 EXAMPLE -->
						<div class="box box-primary">
					        <!-- /.box-header -->
					        <div class="box-body">
					         	<div class="row">
									<div class="col-md-5">

						                <div class="form-group">
						                 	<label>Codigo de seccion</label>
						                    <input type="text" class="form-control" name="cod_sec" maxlength="6" minlength="6" placeholder="Ej. IN3121" onblur="ponerMayusculas(this);" required autofocus>
						                    @if($errors->has('cod_sec'))
                    							<span style="color:red;">{{ $errors->first('cod_sec') }}</span>
                  							@endif
						                </div>
								          <!-- /.form-group -->

						                <div class="form-group">
							                <label>Turno</label>
						                     <select class="select" simple="simple" data-placeholder="Seleccione Turno" style="width: 100%;" name="turno" required>
										            <option value='Mañana'>Mañana</option>
							                  		<option value='Tarde'>Tarde</option>
							                  		<option value='Noche'>Noche</option>
									        </select>
						                </div>
								          <!-- /.form-group -->
							          
						                  <div class="form-group">
							                <label>Trayecto</label>
						                     <select id="select" simple="simple" data-placeholder="Seleccione Trayecto" style="width: 100%;" name="trayecto" required>
										            <option value='0'>Inicial</option>
										            <option value='1'>I</option>
							                  		<option value='2'>II</option>
							                  		<option value='3'>III</option>
							                  		<option value='4'>IV</option>
									        </select>
						                </div>
								          <!-- /.form-group -->

								    </div>
						            <!-- /.col -->
						        
									<div class="col-md-5">
							            <!-- /.col -->
                  						<div class="form-group radio">
									        <label>
									        	<input type="radio" onclick="Seccion(this)"  name="UC" id="todas" value='NULL' checked>Todas Las Unidades
									        </label><br>
											<label>
												<input type="radio" onclick="Seccion(this)" name="UC" id="selec" value="TRUE">Seleccionar Unidades
											</label>
										</div>
							            <!-- /.col -->

                                        {{-- div oculto --}}
                                        <div class="form-group" id="divUC" style="display: none;">
                                            {{-- 
                							<label>Unidades Curriculares</label>     
                                            <select class="form-control select2" multiple="multiple" data-placeholder="Seleccione Unidades" style="width: 100%;" name="materia[]">
                                                @if(isset($uni_crr) )
                                                    @foreach($uni_crr as $uc)
                                                        @if($uc->trayecto == '0')
                                                            <option value='{{ $uc->cod_uc_pnf }}' >
                                                                {{ $uc->nom_uc.' '. $uc->trayecto }} 
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>--}}
                                        </div>
									</div>
						            <!-- /.col -->
								</div>
						          <!-- /.row -->
							</div>
							<!-- /.box-body -->
						</div>
						<!-- /.box -->
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal" checked>Cancelar</button>
			                <button type="submit" class="btn btn-primary">Guardar</button>
		                </div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>

