@if(isset($uni_crr))
	@if(isset($instrumentos))

	    @foreach($uni_crr as $uc)
	        @foreach($master as $mas)
	            @if($uc->cod_uc_pnf == $mas->cod_unidad)
					<div class="modal fade" data-backdrop="static" data-keyboard=”false” id="AgregarPlanMaestro">
						<div class="modal-plan">
							<div class="modal-content">
								<div class="modal-header">
									<div class="box-header with-border">
										<h3 class="box-title">Crear Plan Maestro a {{$uc->nom_uc}}</h3>
									</div>

									<div class="alert alert-info">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<b>No Existe Planes Para Esta Unidad Curricular <br>¿Desea Crearlo?<b><br>
										<h4>Ganesha -SIGE.</h4>
									</div>

					            	<form role="form" method="POST" class="e" action="/controllerplanevaluaciones/agregar">
					                        {{ csrf_field() }}
				       		 		<input class="hide" type="text" id="cod_uc_pnf" name="cod_unidad" value="{{$mas->cod_unidad}}">

									    <div class="modal-body">
										<!-- SELECT2 EXAMPLE -->
											<div class="box box-info">
									            <div class="box-header with-border">
									              	<h3 class="box-title">
										            	Informacion del Plan
										            </h3>
									              	<div class="box-tools pull-right">
									                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
									                        <span class="caret"></span>
									                    </button>
									                </div>
									            </div>
									            <!-- /.box-header -->
									            <div class="box-body table-responsive no-padding">
									                <table class="table table-bordered">
						                				<tr>
										                    <th style="width: 150px;">Unidad Curricular:<label> 
										                    {{$uc->nom_uc}}</label></th>
												            <th style="width: 50px;">Trayecto:<label>
												            @if($uc->trayecto==0)
												            	Inicial
												            @endif
												            @if($uc->trayecto==1)
												            	I
												            @endif
												            @if($uc->trayecto==2)
												            	II
												            @endif
												            @if($uc->trayecto==3)
												            	III
												            @endif
												            @if($uc->trayecto==4)
												            	IV
												            @endif
												            </label></th>
												            <th style="width: 30px;">Fase:<label> @if($uc->periodo=='true') I @else II @endif</label></th>
											                <th style="width: 90px;">Densidad:<label> Semanal</label></th>
										                    <th style="width: 90px;">Hora Acad.:<label>{{$uc->hta}}</label></th>
										                    <th style="width: 30px;">HTE:<label> {{$uc->hte}}</label></th>
										                    <th style="width: 30px;">HTT:<label> {{$uc->htt}}</label></th>
											            </tr>
											        </table>
									                <table class="table table-bordered">
											            <tr>
											            	<th style="width: 151px;">
											            		Profesor: 
											            		<label>
																	@foreach($usuario as $usu)
																		@if($mas->id_usu == $usu->id)
																			{{$usu->name}}
																		@endif
																	@endforeach
																</label>
															</th>
								           					<th style="width: 150px;">Lapso:<label> I-2017</label></th>
											            </tr>
											        </table>
								            	</div>
											              <!-- /.table-responsive -->
											</div>
											<div class="box box-info  collapsed-box">
									            <div class="box-header with-border">
									              	<h3 class="box-title">
										            	Plan de Evaluacion
										            </h3>
									              	<div class="box-tools pull-right">
									                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
									                        <span class="caret"></span>
									                    </button>
									                </div>
									            </div>
									            <!-- /.box-header -->
									            <div class="box-body table-responsive no-padding">
									            	<div>  
										            	<button type="button" class="boton btn btn-primary btn-xs" disabled>Nueva Evaluacion</button>
										            	
										            	Cantidad de Puntos a Evaluar esta fase <input type="number" style="width: 40px;"  maxlength="2" minlength="1" onKeyPress="return soloNumeros(event)" required id="puntos" value="0" max="20" min="10" size="2" onblur="canti()">

										            	|| Puntos Restantes: <input type="text" id="quedan" max="2" size="2" disabled>
										            	|| Lleva: <input type="text" id="llevo" max="2" size="2" disabled> Puntos 
									            	</div>
									                <table class="tabla"  border="1" cellpadding="0" cellspacing="0" id="Coleccion" value="hola">
						                				<thead>
						                				<tr>
										                    <th style="width: 40px;"><center>Unidad</center></th>
										                    <th style="width: 40px;"><center>Eliminar</center></th>
												            <th style="width: 150px;"><center>Contenido</center></th>
												            <th>
												            	<table class="table">
												            		<tr><center>Estrategias de Evaluación</center></tr>
												            		<tr>
												            			<td style="width: 40px;"><center>Tecnicas</center></th>
												            			<td style="width: 40px;"><center>Instrumento</center></th>
												            			<td style="width: 100px;"><center>Criterios Evaluetivos</center></th>
												            		</tr>
												            	</table>
												            </th>
											                <th>							            	
											                	<table class="table">
												            		<tr><center>Forma de Participacion</center></tr>
												            		<tr>
												            			<td style="width: 10px;"><center>A</center></td>
												            			<td style="width: 10px;"><center>C</center></td>
												            			<td style="width: 10px;"><center>D</center></td>
												            		</tr>
												            	</table>
												            </th>
												            <th style="width: 70px;"><center>Fecha</center></th>
										                    <th style="width: 70px;"><center>Ponderación</center></th>
										                    
											            </tr>
											            </thead>

												        <tbody class="Evaluaciones">

														</tbody>	
											        </table>

								            	</div>
											              <!-- /.table-responsive -->
											</div>
											<div class="modal-footer">
											    <a href="/Plan_Evaluaciones/Gestion_master">
													<button type="button" class="btn btn-primary">Cancelar</button>
												</a>
							        			<button type="submit" class=" guardar btn btn-primary" disabled>Guardar</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				@endif
			@endforeach
		@endforeach
	@endif
@endif