@if(isset($uc))
    @if(isset($puente) )

                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <th>Codigo de Unidad</th>
                                <th>Seccion</th>
                                <th>Turno</th>
                                <th>Verificar</th>
                           
                            </thead>
        @foreach($uc as $u)
            @foreach($puente as $pu)
                @if($u->cod_uc_pnf == $pu->cod_unidad)
                    
                    @if(session()->has('msj') )
                        <div class="alert alert-success">{{ session('msj') }}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        </div>
                    @endif
                            <tbody>
                                <td>{{ $u->nom_uc}}</td>
                                <td>{{ $pu->cod_seccion}}</td>                        
                                <td>
                                    @if(isset($secc))
                                        @foreach($secc as $sec)
                                            @if($sec->cod_sec == $pu->cod_seccion)
                                                <b>Turno:</b> {{ $sec->turno }}
                                            @endif
                                        @endforeach
                                    @endif
                                </td>                        
                                <td>
                                    <input type="text" class="hide" id="cod_uc_pnf" value="{{ $pu->id_uc_sec}}">

                                    <div class="tools">                
                                    <a href="/verificar/AprovadosReprobado/{{$pu->id_uc_sec}}">
                                      <button title="Verificar" type='button' class='btn btn-primary btn-xs'>
                                        <img src="/img/iconos/16x16/checkbox.png">
                                      </button>                       
                                    </a>      
                                </td>
                            </tbody>
                          
                @endif
            @endforeach     
        @endforeach                            
                        </table>
                    </div>
    @endif
@endif
