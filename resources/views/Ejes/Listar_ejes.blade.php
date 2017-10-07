@if(isset($ejes) )
    <div class="row">
        <hr><br><br>           

        @foreach($ejes as $ej)

            <div class="col-md-4">
                <div class="box box-primary collapsed-box">
                    <div class="box-header with-border">
                        <div class="box-title">
                            <h5><b>{{ $ej->nom_eje }}</b></h5>
                        </div>
                        <div class="box-tools pull-right">
                            <a href="/controllerejes/{{ $ej->cod_eje }}/eliminar" id="eliminar" onclick="verifico(this)">
                                <button type='button'  class='btn btn-danger btn-xs'>
                                    <i><img src="/img/iconos/16x16/cancel.png"></i>
                                </button>
                            </a>
                                <button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#ModifEje_{{$ej->cod_eje}}'> 
                                        <img src="/img/iconos/16x16/edit.png">
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <span class="caret"></span>
                                </button>                                       
                        </div>
                    </div>
                    <div class="box-body">
                    <h4>Descripción</h4>
                        {{ $ej->descripcion }}
                    </div>
                </div>
            </div>    
        @endforeach
    </div>                        
@endif