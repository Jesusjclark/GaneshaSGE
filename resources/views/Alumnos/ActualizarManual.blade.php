@include('flash::message')
	<div class="form-group col-md-10">
	    <select class="select2" id="alumSelec" style="width: 100%;"  data-placeholder="Agregar Estudiante" >
	    @if(isset($alumnos))			
	        	@foreach($alumnos as $alum)
				    <option value="{{ $alum->ci_est}}">{{ $alum->ci_est.' '.$alum->nom_est.' '.$alum->ape_est }}</option>
 	     		@endforeach
		@endif
	    </select>
	</div>

	
<form role="form" method="POST" action="/modificar_alumnos_manual" id="formulario">
{{--  --}}
	{{ csrf_field() }}
	<input type="text" class="hidden" name="secccion" value="{{$master2}}">

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
	    <tbody>
	        @foreach($alumnos as $alum)
					<input type="text" class="hidden" id="ci{{$e+=1}}" value="{{$alum->ci_est}}">

	        	@foreach($busqueda as $busq)

				    @if($busq->ci_est_tes == $alum->ci_est)
				        <tr id="tr{{ $alum->ci_est}}" class="cd{{$i}}">
			            	<td>
			              		<input type="text" class="hidden c{{$i+=1}}" id="{{ $i }}" name="ci_est[]" value="{{ $alum->ci_est}}">{{ $alum->ci_est}}
			              	</td>
				            <td>
				            	<input type="text" name="nom_est[]" value="{{ $alum->nom_est}}" onkeypress="return soloLetras(event)" maxlength="15" minlength="4" placeholder="Ej. Jose" required autofocus>
				            </td>
				            <td>
				              	<input type="text" name="ape_est[]" value="{{ $alum->ape_est}}" onkeypress="return soloLetras(event)" maxlength="15" minlength="4" placeholder="Ej. Perez" required autofocus>
				            </td>
				            <td>
				            	<input type="email" name="email[]" value="{{ $alum->email}}"  onBlur="validarCorreo(this); "  maxlength="36" minlength="10" placeholder="Ej.  ejemplo@ejemplo.com" required autofocus>
				            </td>

							<td> 
								<button type='button' id="{{ $alum->ci_est}}" value="{{ $busq->id_sec_est}}" onclick="eliminar(this)" class="btn btn-danger btn-xs"> 
                                    <img src="/img/iconos/16x16/cancel.png">
                                </button> 
                            </td>			            
                        </tr>
                        
			        @endif
	        	@endforeach

	        @endforeach
	    </tbody>
  	</table>
  	 <button type="button" id="guardar" class="btn btn-primary btn-xs pull-right">Guardar</button>
	<button type="button" id="tomoEstu" class="btn btn-primary btn-xs ">Nuevo Estudiante</button>
</form>
@section('customjs')

<script src="/datatables/jquery.dataTables.js"></script>
<script src="/datatables/dataTables.bootstrap.min.js"></script>

<script>
var c = parseInt({{ $i }});

$('#tomoEstu').click(function(){
	$('#alumSelec').val('');
		c = c+1;
 	estNuevo ='<tr class="cd'+c+'"><td><input type="text" id="'+c+'" class="c'+c+'" name="ci_est[]" style="width: 70px;" onblur="cedula(this)"  maxlength="8" minlength="7" onKeyPress="return soloNumeros(event)" placeholder="Ej. xxxxxxxxx" required autofocus></td><td><input type="text" name="nom_est[]"  onkeypress="return soloLetras(event)" maxlength="15" minlength="4" placeholder="Ej. Jose" required autofocus></td><td><input type="text" name="ape_est[]"  onkeypress="return soloLetras(event)" maxlength="15" minlength="4" placeholder="Ej. Perez" required autofocus></td><td><input type="email" name="email[]"  onBlur="revisarEmail(this); "  maxlength="36" minlength="10" placeholder="Ej.  ejemplo@ejemplo.com" required autofocus></td><td><button type="button" id="'+c+'" onclick="elimino(this)" class="btn btn-danger btn-xs">'+'<img src="/img/iconos/16x16/cancel.png">'+'</button></td></tr>';
	$('#estu').append(estNuevo);
});

$(document).ready(function() {

	var tabla = $('#estu').dataTable({
	    "sort": false,
	    "paging": false,
	    "language": {
	       	"info": "Se Encontro _TOTAL_ Registros",
	      	"search": "Introdusca Cedula:",
	       	"infoFiltered": " - De _MAX_ Posibles",
	       	"zeroRecords": "No Se ha Encontrado el Estudiante",
	       	"infoEmpty": "Registros _TOTAL_",
	       	"loadingRecords": "Por favor Espere Estamos Buscando Registros",
	       	"processing": "Procesando sus datos"
	    },
	});
	$(".select2").select2({
		allowClear: true,
		tags: false,
		language: "es"
	});		

});

$('#alumSelec').on('change', function(e){
	console.log(e);
	var est_ci = e.target.value;
	$.get("/ajax-estudiante?est_ci=" + est_ci, function(data){
		
		$.each(data, function(Agregar_Manual, estObj){	
			c = c+1
			estud='<tr id="tr'+estObj.ci_est+'" role="row" class="cd'+c+' odd"><td><input type="text" class="hidden '+c+'" id="'+c+'" name="ci_est[]" value="'+estObj.ci_est+'">'+estObj.ci_est+'</td><td><input type="text" name="nom_est[]" value="'+estObj.nom_est+'" onkeypress="return soloLetras(event)" maxlength="15" minlength="4" placeholder="Ej. Jose" required autofocus></td><td><input type="text"  name="ape_est[]" value="'+estObj.ape_est+'" onkeypress="return soloLetras(event)" maxlength="15" minlength="4" placeholder="Ej. Perez" required autofocus></td><td><input type="email"  name="email[]" value="'+estObj.email+'" onBlur="revisarEmail(this); "  maxlength="36" minlength="10" placeholder="Ej.  ejemplo@ejemplo.com" required autofocus></td><td><button type="button" id="'+c+'" onclick="eliminar(this)" class="btn btn-danger btn-xs">'+'<img src="/img/iconos/16x16/cancel.png">'+'</button></td></tr>';

			cuenta = {{ count($alumnos) }};

			for (var i = 1; i <= cuenta; i++) {
				ced_new = estObj.ci_est;
				ced_tab = $('#'+i).val();
				if (ced_new == ced_tab) {
					{{ $i = $i-1 }}
					alert('El Estudiante ya se encuentra Asignado a esta Seccion O lo acaba de agregar');
					estud = '';
				}			
			}
			$('#estu').append(estud);

		});
	});
});

function elimino(e) {
	id = e.id;	
	elimi = $('.cd'+id);
	elimi.remove();
	c = c-1;
}

function eliminar(e) {
	console.log(e);
	var id_sec_est = e.value;
	ced_est = e.id;

	tr = $('#tr'+ced_est);
	formu = $(formulario).serialize();

        {{-- id="eliminar" onclick="verifico(this)" --}}
    if (confirm("¿Desea Eliminar El Estudiante con la CI "+ced_est+" de la Seccion?\nRecuerde que esto puede traer Perdida de Informacion") == true) {

		$.post("/ajax-estudianteelimi"+id_sec_est, formu, function(result){
			alert(result);
			tr.remove();
			c = c-1;
		}).fail(function (){
			id = e.id;	
			elimi = $('.cd'+id);
			elimi.remove();
			c = c-1;
			tr.show();
		});
    }
    else {
        event.preventDefault();        
    }
}



function cedula(e) {
	valor = e.value;
	id= e.id;
	cle = $('.cd'+id).html();
	if(valor != ''){
		cuenta = {{ count($alumnos) }};
		for (var i = 1; i <= cuenta; i++) {
			ced_tab = $('.c'+i).val();
			ci_us = $('#ci'+i).val();
			cla = $('.cd'+i).html();

			if (valor == ced_tab && cle != cla) {
				{{ $i = $i-1 }}
				alert('El Estudiante ya se encuentra Agregardo');
				$('#'+id).val('');

				$('#'+id).focus();
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

$('#alumSelec').val('');

</script>
@endsection
