{{-- Modal --}}
        @if(isset($rol) )
                @foreach($rol as $rol)

<div class="modal fade" id="ModalRoles_{{$rol->id_rol}}" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"> 
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
				<div class="box-header with-border">
					<h3 class="box-title">Modificar Datos de la Unidad {{$rol->nom_rol}}</h3>
				</div>

            <form role="form" method="POST" action="{{ route('controllerroles.update', $rol->id_rol) }}">
                        <input name="_method" type="hidden" value="PUT">

                        {{ csrf_field() }}
				<div class="modal-body">
					<!-- SELECT2 EXAMPLE -->
						<div class="box box-primary">
					        <!-- /.box-header -->
					        <div class="box-body">
					         	<div class="row">

									<div class="col-md-4">
						                <input type="hidden" class="form-control" name="id_rol" value="{{$rol->id_rol}}">
								          <!-- /.form-group -->

						                <div class="form-group">
							                <label>Nombre Rol</label>
						                    <input type="text" class="form-control" name="nom_rol" value="{{$rol->nom_rol}}" onkeypress="return soloLetras(event)" maxlength="35" minlength="5" placeholder="Ej. Administrador" required autofocus>
						                    @if($errors->has('nom_rol'))
                    							<span style="color:red;">{{ $errors->first('nom_rol') }}</span>
                  							@endif
						                </div>
								          <!-- /.form-group -->
							          

								    </div><!--fin col -->
								    <label>Modulos</label>

								    <div class="form-group">
										    @if(isset($mod) ) <!-- Verifico que existen modulos-->
												@foreach($mod as $modu)<!-- inicio foreach con alias-->
													<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					
														 <!--Inicio Columna-->

														<a href="#{{$modu->id_mod}}" class="list-group-item" onClick="setCheck('{{$modu->id_mod}}')">

															<input type="checkbox" id="{{$modu->nom_mod}}" @if($rol->tieneModulo($modu->nom_mod)) checked
																@endif name="id_mod[]" value="{{$modu->id_mod}}">
																<!--mando id -->
																	{{$modu->nom_mod}}<!--mando nombre -->

															<!-- Mando Array con los id del modulo y sus nombres, muestro solo los nombres -->
															</input>
														</a>
													</div><!-- /.col-xs-12 col-sm-6 col-md-4 col-lg-4-->
													 <!--Fin columna Modulos -->
												@endforeach
											@endif
									</div>
											<!-- Fin formgroup -->
									</div>
						         <!--  fin row-->
							</div>
						     <!-- box-body -->
					 </div>
					<!-- /.box-primary -->
				</div>
				<!-- /.Modalbody -->

				</div>
				<!-- Modalheader -->

					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
		                <button type="submit" class="btn btn-primary">Guardar</button>
					</div><!-- Modalfooter -->

			</form>
		</div>
		<!-- Modalcontent -->
	</div>
	<!-- Modaldiag -->
</div>
<!-- Modalfade -->

                @endforeach

@endif