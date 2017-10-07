@if(isset($master))
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"> Unidades a Coordinar</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse">
          <span class="caret"></span>
        </button>
      </div>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table class="table no-margin">
          <thead>
            <th>Unidades Asignadas</th>
            <th>Verificar</th>
          </thead>
          @foreach($master as $mas)
            <tbody>
              <td>
                @foreach($uni_crr as $uc)
                  @if($uc->cod_uc_pnf == $mas->cod_unidad)
                    {{$uc->nom_uc}}
                  @endif
                @endforeach             
              </td>
              <td>
              <input class="hide" type="text" value="{{$mas->cod_unidad}}"></input>
                <div class="tools">
                  <a href="/controllerplanevaluaciones/{{$mas->cod_unidad}}">
                    <button type='button' class='btn btn-primary btn-xs'>
                      <img src="/img/iconos/16x16/checkbox.png">
                    </button>                       
                  </a>
                </div>
              </td>
            </tbody>
          @endforeach
        </table>
      </div>
    </div>
  </div>
@endif