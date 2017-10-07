{{-- Modal --}}
@if(isset($sec) )
@foreach($sec as $secc)
<div class="modal fade" id="ModificaSec_{{$secc->cod_sec}}" role="dialog">
	<div class="modal-dialogs">
		<div class="modal-content">
			<div class="modal-header"> 
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
				<div class="box-header with-border">
					<h3 class="box-title">Modificar Sección {{$secc->cod_sec}}</h3>
				</div>

            <form role="form" method="POST" action="{{ route('controllersecciones.update', $secc->cod_sec) }}">
                        <input name="_method" type="hidden" value="PUT">

                        {{ csrf_field() }}
					<div class="modal-body">
					<!-- SELECT2 EXAMPLE -->
						<div class="box box-primary">
					        <!-- /.box-header -->
					        <div class="box-body">
					         	<div class="row">
									<div class="col-md-12">

						                <div class="form-group">
						                 	<label>Codigo de Seccion</label>
						                    <input type="text" class="form-control" name="cod_sec" readonly value="{{$secc->cod_sec}}">
						                    @if($errors->has('cod_sec'))
                    							<span style="color:red;">{{ $errors->first('cod_sec') }}</span>
                  							@endif
						                </div>

							                <!-- /.form-group -->
							                <div class="diva"></div>
							                
										<div class="form-group de" >
						                    <label>Unidades Curriculares</label>     
						                    <select class="form-control select2" multiple="multiple" data-placeholder="Seleccione Unidades" style="width: 100%;   background-color: #fff;" name="materia[]" required>
						                      @if(isset($uni_crr))
						                        @foreach($uni_crr as $unidad)
						                        @if($unidad->trayecto == $secc->trayecto)
						                          <option @if($sec2->tieneUC2($unidad->cod_uc_pnf,$secc->cod_sec)) selected @endif 
						                          value="{{$unidad->cod_uc_pnf}}">
						                            {{ $unidad->nom_uc }} 
						                          </option>
						                          @endif
						                        @endforeach
						                      @endif
						                    </select>
						                 </div> 

										

								          <!-- /.form-group -->
								                <div class="form-group">
							               		 <label>Turno</label>
							                     <select class="select" simple="simple" data-placeholder="Seleccione Turno" style="width: 100%;" name="turno" required>
							                       @if(isset($secc->turno)) 
													<option selected value="{{$secc->turno}}" ">{{$secc->turno}}</option>
													@endif
											            <option value='Mañana'>Mañana</option>
								                  		<option value='Tarde'>Tarde</option>
								                  		<option value='Noche'>Noche</option>
										       	 </select>	
						                		</div>
						                <div class="form-group">
							                <label>Trayecto</label>
							                
						                   <select class="select" id="selecte" onchange="tray(this)" simple="simple"  data-placeholder="Seleccione Trayecto" style="width: 100%;" name="trayecto" required>
												@if(isset($secc->trayecto)) 
												<option selected value="{{$secc->trayecto}}">

													@if($secc->trayecto==0)
													Inicial
													@endif
													@if($secc->trayecto==1)
													I
													@endif
													@if($secc->trayecto==2)
													II
													@endif
													@if($secc->trayecto==3)
													III
													@endif
													@if($secc->trayecto==4)
													IV
													@endif
												</option>
												@endif
												<option value="0" ">Inicial</option>
												<option value="1" ">I</option>
												<option value="2" ">II</option>
												<option value="3" ">III</option>
												<option value="4" ">IV</option>
													
									        </select>
						                </div>		
						                {{-- @if(isset($master) )
					                
							                <div class="form-group">
								                <label>Unidades Curriculares</label>     
	                                            <select class="form-control select2" multiple="multiple" data-placeholder="Seleccione Unidades" style="width: 100%;" name="materia[]">
	                                                @foreach($master as $mas)
	                                                    @if($mas->trayecto == '0')
	                                                        <option value='{{ $uc->cod_uc_pnf }}' >
	                                                            {{ $uc->nom_uc.' '. $uc->trayecto }} 
	                                                        </option>
	                                                    @endif
	                                                @endforeach
	                                            </select>
							                </div>
							            @endif --}}

							    	</div>
						            <!-- /.col -->
								</div>
						          <!-- /.row -->
							</div>
							<!-- /.box-body -->
						</div>
						<!-- /.box -->
						<div class="modal-footer">

							<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
		    	            <button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endforeach
@endif