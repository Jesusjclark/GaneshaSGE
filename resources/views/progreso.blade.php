
@if(isset($progreso))

		{{-- Modal --}}
		<div class="modal fade" id="progreso" role="dialogs">
			<div class="modal-dialogs">
				<div class="modal-content">
					<div class="modal-header"> 
					    <button type="button" class="close" data-dismiss="modal">x</button>
						<div class="box-header with-border">
							<h3 class="box-title">ACTIVANDO SEGUIMIENTO</h3>
						</div>
					</div>
		
						<div class="modal-body">
						@include('flash::message')
						EN ESTE MOMENTO SE ESTA EJECUTANDO EL SEGUIMIENTO DE PLAN, POR FAVOR ESPERE.
							
	      				</div>
	      				</div>
					    <div class="box-footer">
	                     
					    </div>
					
				</div>

			</div>
		</div>
@endif