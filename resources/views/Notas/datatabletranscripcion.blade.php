
   @if(session()->has('msj') )
  <div class="alert alert-success">{{ session('msj') }}
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
  @endif

  <table id="Notas" class="table table-bordered table-striped">
   <input class="hide" type="text" value="" name="id_eva"> </input>
    <thead>
      <tr>
        <th>Cedula </th>
        <th>Nombre del Estudiante</th>
        <th>Apellido del Estudiante</th>
        @for($i = 1; $i<= $a; $i++) 
          <th>Notas</th>
        @endfor
      </tr>
    </thead>
    <tbody>
      @foreach($estudiantes as $estu)
            <tr>

              <td>{{ $estu->ci_est }}
              <input class="hide" type="text" value="{{ $estu->ci_est }}" name="ci_est[]"> </input>
              </td>
              <td>{{ $estu->nom_est }}
              <input class="hide" type="text" value="{{ $estu->nom_est }}" name="nom_est[]"> </input>
              </td>
              <td>{{ $estu->ape_est }}
              <input class="hide" type="text" value="{{ $estu->ape_est }}" name="ape_est[]"> </input>
              </td>

                @foreach($notas as $not)
                  @if($not->ci_est_not == $estu->ci_est )

                    <td>
                      {{$not->nota}}
                      <input class="hide" type="number" value="{{$not->nota}}" name="nota[]"> </input>
                    </td>
                  @endif
                @endforeach
                
            </tr>
      @endforeach
    </tbody>
  </table>  
<br>
