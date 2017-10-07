
@if(isset($uni_crr))
	@if(isset($instrumentos))
		@foreach($uni_crr as $uc)
			@foreach($planeva as $plan)
				@foreach($master as $Tpuente)

					<section class="content-header">
				      <ol class="breadcrumb">
                        <li>
                            <a href="/home"><i class="fa fa-dashboard"></i>
                                Home
                            </a>
                        </li>
				        <li><a href="/Plan_Evaluaciones/Gestion_master"><i class="fa fa-dashboard"></i> Gestion Plan Maestro</a></li>
				        <li class="active">Vistar Plan Maestro</li>
				      </ol>
				    </section><br>
				    <hr>
				    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        - Ya esta Unidad tiene un Plan Maestro el cual ya a sido Creado y Asignado. Actualmente puede Visualizarlo e Imprimirlo.<br>
                	<h4>Ganesha -SIGE.</h4>
                    </div>
				        <!--Hidenssss-->
		            <div  class="table-responsive no-padding" id="myDiv">
		            	<table class="table" border="1">
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
		                <table class="table"  border="1">
				            <tr>
				            	<th style="width: 152px;">
				            		Profesor: 
				            		<label>
				            			@foreach($usuario as $usu)
											{{$usu->name}}
			               				@endforeach
									</label>
								</th>
	           					<th style="width: 150px;">Lapso:<label> I-2017</label></th>
				            </tr>
				        </table><br>
		                <table border="1">
	        				<thead>
	            				<tr>
				                    <th style="width: 40px;">
				                    	<center>Unidad</center>
				                    </th>
						            <th style="width: 150px;">
						            	<center>Contenido</center>
						            </th>
						            <th class="text-center"  style="width: 500px;">
						            	<table class="table">
						            		<tr>
						            			<center>Estrategias de Evaluación</center>
						            		</tr>
						            		<tr>
						            			<td style="width: 100px;">
						            				Tecnicas
						            			</td>
						            			<td style="width: 100px;">
						            				Instrumento
						            			</td>
						            			<td style="width: 200px;">
						            				Criterios Evaluetivos
						            			</td>
						            		</tr>
						            	</table>
						            </th>
					                <th>							            	
					                	<table class="table">
						            		<tr>
						            			<center>Forma de Participacion</center>
						            		</tr>
						            		<tr>
						            			<td style="width: 10px;">
						            				<center>A</center>
						            			</td>
						            			<td style="width: 10px;">
						            				<center>C</center>
						            			</td>
						            			<td style="width: 10px;">
						            				<center>D</center>
						            			</td>
						            		</tr>
						            	</table>
						            </th>
				                    <th style="width: 70px;">
				                    	<center>Ponderación</center>
				                    </th>
				                    <th style="width: 100px;">
				                    	<center>Fecha Propuesta</center>
				                    </th>
					            </tr>
					        </thead>
					        <tbody>
								@foreach($evaluaciones as $eva)
									<tr class="text-center" >
										<td style="width: 40px;">
											{{ $eva->unidad }}
										</td>
										<td style="width: 150px;">
											{{ $eva->contenido }}
										</td>
										<td style="width: 500px;">
											<table>
												<tr>
												</tr>
												<tr class="text-center" >
													<td style="width: 100px;">
														{{ $eva->tecnica }}
													</td>
													<td style="width: 100px;">
														@foreach($instrumentos as $in)
															@if($eva->id_inst_eva == $in->id_inst)
																{{ $in->tip_inst }}
															@endif 
														@endforeach
													</td>
													<td style="width: 200px;">
														{{ $eva->criterio }}
													</td>
												</tr>
											</table>
										</td>
										<td class="thd" >
											<table class="table">
												<tr>
													<td style="width: 10px;">
														<input type="checkbox" name="A"value="TRUE">
													</td>
													<td style="width: 10px;">
														<input type="checkbox" name="C" value="TRUE" >
													</td>
													<td style="width: 10px;">
														<input type="checkbox" name="D" value="TRUE" >
													</td>
												</tr>
											</table>
										</td>
										<td class="tdp" style="width: 70px;">
											{{ $eva->ponderacion }}-Ptos
										</td>
										<td class="tdf" style="width: 70px;">
											{{ $eva->fec_prop}}
										</td>
									</tr>
								@endforeach
							</tbody>								            
				        </table>
	            	</div>
<br>
					<div align="right">
						<a target="_blank" href="/Plan_Evaluaciones/imprimirMaster/{{ $cod_unidad }}"> 
							<button type="button" class="btn btn-primary" >
	               				<img src="/img/iconos/16x16/print.png">
							</button>
						</a> 
					</div>
				@endforeach	
			@endforeach
		@endforeach
	@endif
@endif


@section('customjs')
<script>
function impri(){
	//window.print();
	
	//window.locationf="/Plan_Evaluaciones/imprimirMaster/{{ $cod_unidad }}";
}
</script>
@endsection{{--  class="text-center"  --}}