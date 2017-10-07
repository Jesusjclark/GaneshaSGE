@if(isset($master2))

		{{-- Modal --}}
		<div class="modal fade" id="ActualizarListado{{$master2}}" div class="modal fade" data-backdrop="static" data-keyboard=”false”>
			<div class="modal-dialogs">
				<div class="modal-content">
					<div class="modal-header"> 
					    <button type="button" class="close" data-dismiss="modal">x</button>
						<div class="box-header with-border">
							<h3 class="box-title">Actualizar listados {{$master2}}</h3>
						</div>
					</div>
					<form name="import_file" method="POST"  action="/controlleralumnos/listadoact" class="formulario_archivo" enctype="multipart/form-data" >
						<div class="modal-body">
						@include('flash::message')
							<input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>"> 
							<input type="hidden" name="id_cod" id="id_cod"  value={{$master2}} 

				            <label>Agregar Archivo de Excel </label>
				             <input name="import_file" id="archivo" type="file"   class="archivo form-control"  required/><br><br>
				            
				            <div class="form-group radio">
									        <label>
									        	<input type="radio"  name="Email" value='TRUE' checked>
									        	Incluir Correos Electrónicos
									        </label><br>
											<label>
												<input type="radio" name="Email" value="FALSE"><b>NO</b> Incluir Correos
											</label>
							</div>
							
	      				</div>
	      				</div>
					    <div class="box-footer">
	                        <button type="submit" class="btn btn-primary btn-xs pull-right">Actualizar Listado</button> 
	                        <a href="/alumnos/vista">
								<button type="button" class="btn btn-primary btn-xs"">Cancelar</button>
							</a>
					    </div>
					</form>
				</div>

			</div>
		</div>
@endif