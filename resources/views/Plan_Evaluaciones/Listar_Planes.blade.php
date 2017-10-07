
  @if(isset($master))
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title"> Unidades Asignadas</h3>
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
              <th>Codigo de la Unidad</th>
              <th>Codigo de la Seccion</th>
              <th>Turno</th>
              <th>Nombre de la Unidad</th>
              <th>Verificar</th>
            </thead>
              @foreach($master as $mas)
                  @foreach($planeva as $plan)
                    @foreach($uni_crr as $uc)
                      @if($plan->cod_sec_plan == $mas->id_uc_sec && $mas->cod_unidad == $uc->cod_uc_pnf)
                        <tbody>
                          <td>
                            {{$mas->cod_unidad}}
                          </td>
                          <td>
                            {{$mas->cod_seccion}}
                          </td>
                          <td>
                            @foreach($seccion as $sec)
                              @if($sec->cod_sec == $mas->cod_seccion)
                                {{ $sec->turno }}
                              @endif
                            @endforeach
                          </td>
                          <td>
                            {{$uc->nom_uc}}
                          </td>
                          <td>
                            <div class="tools">
                              <a href="/controllerplan/{{$plan->id_plan}}">
                                <button type='button' class='btn btn-primary btn-xs'>
                                  <img src="/img/iconos/16x16/checkbox.png">
                                </button>                       
                              </a>
                            </div>
                          </td>
                        </tbody>
                      @endif     
                    @endforeach
                  @endforeach
              @endforeach
          </table>
        </div>
      </div>
    </div>
  @else
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      -No tiene Planes Asignados, Por Favor comuniquese con el Coordinador del sistema 
      <br>
      <h4>Ganesha -SIGE.</h4>
    </div>

  @endif