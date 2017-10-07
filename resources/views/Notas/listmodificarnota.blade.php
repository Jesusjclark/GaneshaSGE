
<form role="form" method="POST" action="/Modificar/Notas">
  {{ csrf_field() }}
   @if(session()->has('msj') )
  <div class="alert alert-success">{{ session('msj') }}
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
  @endif
   @include('flash::message')
  <table id="Notas" class="table table-bordered table-striped">
   <input class="hide" type="text" value="{{$id_eva}}" name="id_eva"></input>
    <thead>
      <tr>
        <th>Cedula</th>
        <th>Nombre del Estudiante</th>
        <th>Apellido del Estudiante</th>
        <th>Nota</th>
      </tr>
    </thead>
    <tbody>
      @foreach($estudiantes as $estu)
              @foreach($listaestu as $estusec)
              @foreach($notasalum as $notas)

        @if($estusec == $estu->ci_est )
          @if($notas->ci_est_not == $estu->ci_est ) 

            <tr>
              <td>
            <input class="hide" type="text" value="{{$estu->ci_est}}" name="ci[]"> {{ $estu->ci_est }}</input>
              </td>
              <td>{{ $estu->nom_est }}</td>
              <td>{{ $estu->ape_est }}</td>

                <td>

                  <input type="number" id="not" name="nota[]"  max="{{$evaasignar}}" min="0" value="{{$notas->nota}}" style="width: 38px;" step="0.10" required >  
                       <b> / {{$evaasignar}}</b>
              </td>

            </tr>
                @endif
                @endif
            
      @endforeach
      @endforeach
      @endforeach
    </tbody>
  </table>
  <button type="submit" class="btn btn-primary btn-xs pull-right">Guardar</button>
<br>

</form>

