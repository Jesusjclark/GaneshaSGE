{{-- Modal --}}
        @if(isset($ejes) )
                @foreach($ejes as $ej)

<div class="modal fade" id="ModifEje_{{$ej->cod_eje}}" role="dialog">
	<div class="modal-dialogs">
		<div class="modal-content">
			<div class="modal-header"> 
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
				<div class="box-header with-border">
					<h3 class="box-title">Modificar Datos del Eje {{$ej->nom_eje}}</h3>
				</div>

            <form role="form" method="POST" action="{{ route('controllerejes.update', $ej->cod_eje) }}">
                        <input name="_method" type="hidden" value="PUT">

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
						                    <input type="text" class="form-control" name="nom_eje" value="{{$ej->nom_eje}}" onkeypress="return soloLetras(event)" maxlength="20" minlength="4" placeholder="Ejp: Cutural" required autofocus>
						                    @if($errors->has('nom_eje'))
                    							<span style="color:red;">{{ $errors->first('nom_eje') }}</span>
                  							@endif
						                </div>
								          <!-- /.form-group -->

						                <div class="form-group">
							                <label>Descripcion</label>
                  							<textarea type="text" class="form-control" name="descripcion" placeholder="Ejp: Es Importante Saber de Nuestras Raizes" required autofocus style="width: 200px; height: 80px;"  onkeypress="return soloLetras(event)" >{{$ej->descripcion}}</textarea>
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
                @endforeach

@endif