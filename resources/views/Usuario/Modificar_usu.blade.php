@if(isset($mod_usuario))
          <!--Si entro aqui es porque en ciclo de editar se a cumplido bien y me he traido la variable que manda el controlador desde la vista home-->

          <form role="form" method="POST" action="{{ route('controllerusers.update', $mod_usuario->id) }}" enctype="multipart/form-data">
            <!-- Al Form le cambie la accion colocandole la funcion ::route:: la cual indica el controlador a donde a de ir mas la funcion en el mismo, ademas de la variable que resivi del home indicado la id del registro a modificar.
            Esta ruta la puedes verificar con el comando :: php artisan route:list ::-->
            <input name="_method" type="hidden" value="PUT">

            <!-- Cambio el metodo con el cual envio los datos ya que segun la ruta, estos se envian mediante PUT y si no se modifica laravel no lo reconoce-->


            <input class="hide" type="text" name="img" value="{{$mod_usuario->img_perfil}}">
            <!-- Creamos un input oculto para poder enviar el nombre de la imagen a la nueva funcion de update.
            A este le asignamos el valor que viene en la variable resivida de home -->

              {{ csrf_field() }}
               @if(session()->has('msjerr') )
                                     <div class="alert alert-danger alert-dismissible">{{ session('msjerr') }}
                                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
                                  @endif
              <div class="box-body">
                <div class="form-group">
                  <label for="cedula">Cedula</label>
                  <input type="text" class="form-control" name="ci_usu"  maxlength="8" minlength="7" onKeyPress="return soloNumeros(event)" placeholder="Ej. xxxxxxxxx" required  value="{{ $mod_usuario->ci_usu}}">
                  <!--Le damos el valor que resivimos segun sea el que se desea modificar, y dela misma manera mostramos los datos-->
                </div>

                <div class="form-group">
                  <label for="name">Nombre</label>
                  <input type="text" class="form-control" name="name" onkeypress="return soloLetras(event)" maxlength="15" minlength="4" placeholder="Ej. Jose" required  value="{{ $mod_usuario->name}}">
                  <!--Le damos el valor que resivimos segun sea el que se desea modificar, y dela misma manera mostramos los datos-->
                </div>

                <div class="form-group">
                  <label for="ape_usu">Apellido</label>
                  <input type="text" class="form-control" name="ape_usu" onkeypress="return soloLetras(event)" maxlength="15" minlength="4" placeholder="Ej. Perez"  required  value="{{ $mod_usuario->ape_usu}}">
                  <!--Le damos el valor que resivimos segun sea el que se desea modificar, y dela misma manera mostramos los datos-->
                </div>

                <div class="row col-md-offset-1">
                  <div class="col-md-5">  
                    <label for="roles">Roles Del Usuario</label>
                    @if(isset($roles) ) <!-- Verifico que existen modulos-->
                      @foreach($roles as $rol)<!-- inicio foreach con alias-->
                        <a class="list-group-item">
                          <input type="checkbox" id="{{$rol->id_rol}}" @if($mod_usuario->tieneroles($rol->nom_rol)) checked
                              @endif name="id_rol[]" value="{{$rol->id_rol}}" onclick="showContent(this)"><!--mando id -->
                              <!--mando id -->
                                {{$rol->nom_rol}}<!--mando nombre -->
                          </input>
                        </a>
                      @endforeach
                    @endif
                  </div> 
                  
                  <div class="col-md-5" id="divUC" style="display: none;">
                    <label>Unidades Curriculares</label>     
                    <select class="form-control select2" multiple="multiple" data-placeholder="Seleccione Unidades" style="width: 100%;   background-color: #fff;" name="materia[]">
                      @if(isset($uc))
                        @foreach($uc as $unidad)
                          <option @if($mod_usuario->tieneUCCor($unidad->cod_uc_pnf,$mod_usuario->id)) selected @endif value="{{$unidad->cod_uc_pnf}}">
                            {{ $unidad->nom_uc }} 
                          </option>
                        @endforeach
                      @endif
                    </select>
                  </div> 

                </div>
                    <div class="form-group">
                      <label for="email">Correo</label>
                        <input type="email" class="form-control" name="email"  onBlur="revisarEmail(this); "  maxlength="36" minlength="10" placeholder="Ej.  ejemplo@ejemplo.com" required  value="{{ $mod_usuario->email}}">
                        <!--Le damos el valor que resivimos segun sea el que se desea modificar, y dela misma manera mostramos los datos-->
                    </div>
                  <div class="form-group">
                    <label for="tlf">Telefono</label>
                      <input type="text" class="form-control" name="tlf"  onkeypress="return soloNumeros(event)" maxlength="11" minlength="11" placeholder="Ej. 04262341232"  required  value="{{ $mod_usuario->tlf}}">
                        <!--Le damos el valor que resivimos segun sea el que se desea modificar, y dela misma manera mostramos los datos-->
                  </div>              
                  <div class="form-group">
                    <div  class="col-md-4">
                      <label>Foto de Perfil</label>
                    </div>
                  
                    <div  class="col-md-2">
                      <img src='/img_perfil/{{ $mod_usuario->img_perfil}}' class="img-responsive" alt="Responsive image" style="max-width: 100px; max-height: 100px;"> 
                     </div>               

                  <div class="col-md-3">
                    <input type="file" name="img_perfil" >
                      <input class="hide" type='text' name="img_perfil" value="{{ $mod_usuario->img_perfil}}">
                  </div>
                </div>
                
                </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-warning  pull-right">Modificar</button>
                  </div>
          </form>

          <!-- /.box -->
@endif
@section('customjs')
<script>
    //Initialize Select2 Elements
    $(".select2").select2();
  
</script>

<script>
    function showContent(check) 
        {        
   // alert('El check '+check.id+' tiene el valor '+check.value);

        checka = check.id;

        if (checka == '5') {
            element = document.getElementById("divUC");    
            if (check.checked) {
                element.style.display='block';
            }
            else {
                element.style.display='none';
            }
        }
    }
  $(document).on('ready',function(){
    check = $('#5');
    rolesUsu = {{ $rolesUsu }};
    if (rolesUsu != '') {
      element = document.getElementById("divUC"); 
                element.style.display='block';

    }
  });

</script>
@endsection