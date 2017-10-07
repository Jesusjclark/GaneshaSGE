@include('flash::message')

<div class="form-group col-md-10">
    <select class="select2" id="alumSelec" style="width: 100%;"  data-placeholder="Buscar Estudiante" >
	@if(isset($alumnos))			
		@foreach($alumnos as $alum)
            <option value='{{ $alum->ci_est}}' title="{{ $alum->nom_est }}">{{ $alum->ci_est.' '.$alum->nom_est.' '.$alum->ape_est }}
            </option>
      	@endforeach
	@endif
    </select>
</div>

<form role="form" method="POST" action="/guardar_alumnos_manual">
{{--  --}}
					                        {{ csrf_field() }}
	<input type="text" class="hidden" name="secccion" value="{{ $master2 }}">
	<table id="estu" class="table table-bordered table-striped">
	    <thead>
	      <tr>
	        <th>Cedula</th>
	        <th>Nombre del Estudiante</th>
	        <th>Apellido del Estudiante</th>
	        <th>Correo</th>
	        <th>Eliminar</th>

	      </tr>
	    </thead>
	    <tbody id="estudiantes">
	    @foreach($alumnos as $alum)
			<input type="text" class="hidden" id="ci{{ $i+=1 }}" value="{{$alum->ci_est}}">

      	@endforeach
	        <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
	    </tbody>
  	</table>
  	<button type="button" id="tomoEstu" class="btn btn-primary btn-xs ">Nuevo Estudiante</button>

  	  <button type="button" id="guardar" class="btn btn-primary btn-xs pull-right">Guardar</button>

</form>

@section('customjs')

<script src="/datatables/jquery.dataTables.js"></script>
<script src="/datatables/dataTables.bootstrap.min.js"></script>

        
<script>
var c = 0;

//Activar modar a entrar a la pagina
    $(window).load(function(){
	    //Initialize Select2 Elements
	    $(".select2").select2({
	    	//maximumSelectionLength: 1,

	  		allowClear: true,
	    	tags: false,
	    	language: "es"
	    });
 	});

$('#tomoEstu').click(function(){
	$('#alumSelec').val('');
		c = c+1;
 	estNuevo ='<tr class="c'+c+'"><td><input type="text" id="'+c+'" name="ci_new[]" style="width: 70px;" onblur="cedula(this)" maxlength="8" minlength="7" onKeyPress="return soloNumeros(event)" placeholder="Ej. xxxxxxxxx" required autofocus></td><td><input type="text" name="nom_new[]"  onkeypress="return soloLetras(event)" maxlength="15" minlength="4" placeholder="Ej. Jose" required autofocus></td><td><input type="text" name="ape_new[]" onkeypress="return soloLetras(event)" maxlength="15" minlength="4" placeholder="Ej. Perez" required autofocus></td><td><input type="email" name="email_new[]"  onBlur="validarCorreo(this); "  maxlength="36" minlength="10" placeholder="Ej.  ejemplo@ejemplo.com" required autofocus></td><td><button type="button" id="'+c+'" onclick="elimino(this)" class="btn btn-danger btn-xs">'+'<img src="/img/iconos/16x16/cancel.png">'+'</button></td></tr>';
	$('#estu').append(estNuevo);
});

	$('#alumSelec').val('');
       $('#estu').dataTable({
       	"sort": false,
            "paging": false,
            "language": {
                       "info": "Se Encontro _TOTAL_ Registros",
                       "search": "Buscar Estudiante:",
                       "infoFiltered": " - De _MAX_ Posibles",
                       "zeroRecords": "No Se ha Encontrado el Estudiante <br> ¿Desea Crearlo?<br><button type='button' class='btn btn-primary btn-xs' onclick='alert(3)'>Nuevo</button>",
                       "infoEmpty": "Registros _TOTAL_",
                       "loadingRecords": "Por favor Espere Estamos Buscando Registros",
                       "processing": "Procesando sus datos"
                     },
			"searching": false,


        /*oTable.$('td').click( function () {
            var sData = oTable.fnGetData( this );
                 alert( 'Seleccionastes a '+sData );
               } );*/
                     //"search": {"search": "Initial search"},
               
     });
$('#alumSelec').on('change', function(e){
	console.log(e);
	var est_ci = e.target.value;
	$.get("/ajax-estudiante?est_ci=" + est_ci, function(data){
		$.each(data, function(Agregar_Manual, estObj){	
			c = c+1
			estud='<tr id="tr'+estObj.ci_est+'" role="row" class="c'+c+' odd"><td><input type="text" id="'+c+'" class="hidden '+c+'" name="ci_new[]" value="'+estObj.ci_est+'">'+estObj.ci_est+'</td><td><input type="text" name="nom_new[]" class="hidden" value="'+estObj.nom_est+'">'+estObj.nom_est+'</td><td><input type="text"  name="ape_new[]" class="hidden" value="'+estObj.ape_est+'">'+estObj.ape_est+'</td><td><input type="text"  name="email_new[]" class="hidden" value="'+estObj.email+'">'+estObj.email+'</td><td><button type="button" id="'+c+'" onclick="elimino(this)" class="btn btn-danger btn-xs">'+'<img src="/img/iconos/16x16/cancel.png">'+'</button></td></tr>';
			if (c != 1) {
				for (var i = 1; i < c; i++) {
					e=c-1;
					ced_new = estObj.ci_est;
					ced_tab = $('#'+i).val();
					if (ced_new == ced_tab) {
						alert('El Estudiante ya se encuentra Asignado a esta Seccion O lo acaba de agregar');
						estud = '';
					}
				}
			}
			$('#estu').append(estud);

		});

	});
});

function elimino(e) {
	id = e.id;	
	elimi = $('.c'+id);
	elimi.remove();
	c = c-1;
}

function cedula(e) {
	valor = e.value;
	id= e.id;
	cle = $('.c'+id).html();
	cantAlum = {{ count($alumnos) }}	

	if(valor != ''){
		for (var i = 1; i <= cantAlum; i++) {
			ced_tab = $('#'+i).val();
			cla = $('.c'+i).html();
			ci_us = $('#ci'+i).val();
			if (valor == ced_tab && cle != cla) {
				alert('El Estudiante ya se encuentra Agregardo');
				$('#'+id).val('');
			}
			if (valor == ci_us) {
				alert('El Estudiante ya se encuentra registrado en el sistema\nPor favor busque la CI en el cajetin de arriba');
				$('#'+id).val('');
				$('#'+id).focus();
			}		
		}
	}	
}


$('#guardar').click(function(){
	if (c != 0) {
		$('#guardar').attr("type", "submit");
	}
	else{
		alert('Debe de Agregar un estudiante a la Sección');
	}
});

</script>
@endsection

