@if(session()->has('msj') )
    <div class="alert alert-success">{{ session('msj') }}
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    </div>
@endif
<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Ya existen Un Plan Maestro para esta unidad, Por ende Puede Modificar, Eliminar y Asignar Planes.</b><br>
                <h4>Ganesha -SIGE.</h4> </div>

<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Si desea Asignar El Plan Maestro a los Docetes NO se podra luego Modificar o Eliminar este Plan<b><br>
                <h4>Ganesha -SIGE.</h4> </div>

<div class="row  col-offset-1">
<center>
@foreach($planeva2 as $id_plan)
    <div class="col-md-12">
        <label> <h1>Seleccióne su Opción</h1></label><br>
        <button type='button' class='btn btn-primary btn-xs'>
          <img src="/img/iconos/32x32/edit-alt-1.png" data-toggle='modal' data-target='#ModificarPlanMaestro'>
        </button>               
        <a href="/Plan_Evaluaciones/{{$id_plan}}/Asignar" id="Asignar"  onclick="verificoAsig(this)">
            <button type='button' class='btn btn-warning btn-xs'>
              <img src="/img/iconos/32x32/elevator.png">
            </button>                       
        </a>
        <a href="/controllerplanevaluaciones/{{$id_plan}}/eliminar" id="eliminar" onclick="verifico(this)">
            <button type='button' class='btn btn-danger btn-xs'>
                <img src="/img/iconos/32x32/cancel.png">
            </button>                       
        </a>
    </div>
@endforeach
    </center>
</div>