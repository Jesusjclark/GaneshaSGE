   

<table id="Bitacora" class="table table-bordered table-responsive">
 @if(isset($listaBistacora) )

 	@if($cuenta != 0)
	<thead>
		<th>Id</th>
		<th>Nombre del Usuario</th>
		<th>Cedula del Usuario</th>
		<th>Realizo</th>
		<th>Observación</th>
		<th>Fecha y hora</th>

	</thead>
	<tbody>
		@foreach($listaBistacora as $lista)
			<tr>
				<td>{{ $lista->id_bitacora }}</td>
				
				<td style="width: 150px;">{{ $lista->nombre }}</td>

				<td style="width: 150px;">{{ $lista->id_usuario }}</td>

				<td>{{ $lista->accion }}</td>

				<td>{{ $lista->observación }}</td>

				<td style="width: 150px;">{{ $lista->created_at }}</td>
			</tr>
		@endforeach
	</tbody>
	@else
		<div class="alert alert-danger">
		No tiene Acciones Realizadas
	     	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	    </div>
	@endif

@endif
</table>

