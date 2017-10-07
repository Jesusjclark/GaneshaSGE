<form role="form" method="POST" action="/Asignar/notas">
  {{ csrf_field() }}
   @if(session()->has('msj') )
  <div class="alert alert-success">{{ session('msj') }}
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
   </div>
  @endif
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
        @foreach($listaestu as $essec)
          @if($essec == $estu->ci_est)
            <tr>

              <td>
            <input class="hide" type="text" value="{{$estu->ci_est}}" name="ci[]"> {{ $estu->ci_est }}</input>
              </td>
              <td>{{ $estu->nom_est }}</td>
              <td>{{ $estu->ape_est }}</td>
              <td>
                
                @if(isset($evaasignar))
                <input type="number" step="0.01" name="nota[]" max="{{$evaasignar}}" min="0" id ="not" style="width: 50px;" required > 
           
                @endif 
               <b> / {{$evaasignar}}</b>
              </td>
            </tr>
          @endif
        @endforeach
      @endforeach
    </tbody>
  </table>
  <button type="submit" class="btn btn-primary btn-xs pull-right">Guardar</button>
<br>

</form>
