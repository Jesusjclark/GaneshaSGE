
<HR>

              <div>
                <table id="Usuarios" class="table table-bordered table-responsive">
                	@if(isset($usuarios) )

		<thead>
			<th>Foto de perfil</th>
			<th>Cedula</th>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Correo</th>
			<th>Tlf</th>
			<th>Acción</th>

		</thead>
		<tbody>
			
			@foreach($usuarios as $n)
				<tr>
					<td>
						<img src="/img_perfil/{{ $n->img_perfil }}" class="img-responsive" alt="Responsive image" style="max-width: 100px; max-height: 100px;">
					</td>
					
					<td>{{ $n->ci_usu }}</td>

					<td>{{ $n->name }}</td>

					<td>{{ $n->ape_usu }}</td>

					<td>{{ $n->email }}</td>

					<td>{{ $n->tlf }}</td>
					
					<td>
					    <div class="tools">
                                    
						<a href="/controllerusers/{{ $n->id }}/edit">
							<button type='button' class='btn btn-warning btn-xs'>
                                <i><img src="/img/iconos/16x16/edit.png"></i>
                            </button>
						</a>

						
						<form action="{{ route('controllerusers.destroy', $n->id )}}" method="POST">

							<input name="_method" type="hidden" value="DELETE">

							{{ csrf_field() }}
                                    <button type='button' value="{{ $n->ci_usu }}" onclick="verifico(this)" class='btn btn-danger btn-xs'>
                                      <i><img src="/img/iconos/16x16/cancel.png"></i>
                                    </button>
						</form>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	@endif
</table>
