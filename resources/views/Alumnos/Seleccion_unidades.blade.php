@if(isset($master) )
@if(isset($unidades))

  <div class="table-responsive">
    <table class="table no-margin">
    <thead>
        <th>Sección</th>
        <th>Unidad Curricular</th>
        <th>Nombre UC</th>
        <th>Listado</th>
        <th>Manual</th>

    </thead> 



      @foreach($master as $ma)
        <form  method="POST"  action="/controlleralumnos/{{$ma->id_uc_sec}}/verifica" >
                        {{ csrf_field() }}
        <tbody>
          <td>{{$ma->cod_seccion}}</td>
          <td>{{$ma->cod_unidad}}</td>
          <td>
          @foreach($unidades as $uc)
            @if($ma->cod_unidad==$uc->cod_uc_pnf)
              {{ $uc->nom_uc }}  
            @endif  
          @endforeach
          </td>
          <td>
              <button type='submit' name="Tipo" value="Listado" class='btn btn-primary btn-xs'>
                <i><img src="/img/iconos/16x16/book.png"></i>
              </button>
          </td>
          <td>
              <button type='submit' name="Tipo" value="Manual" class='btn btn-xs'>
                <i><img src="/img/iconos/16x16/file-add.png"></i>
              </button>
          </td>
        </tbody>
              </form>

      @endforeach
    </table>
  </div>
@endif
@endif

