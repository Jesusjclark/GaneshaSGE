@section('customcss')
  <link rel="stylesheet" href="/datatables/jquery.dataTables.css">

@endsection
@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">Gestion de Usuarios</h4>
                            <p class="category">Lista de Usuarios</p>
                        </div>
                        <div class="card-content">
                                                    <section class="content-header">
                              <ol class="breadcrumb">
                                <li>
                                    <a href="/home"><i class="fa fa-dashboard"></i>
                                        Home
                                    </a>
                                </li>
                                <li class="active">
                                    Configuración de Usuario
                                </li>
                              </ol>
                            </section><br>
                                @if(isset($mod_usuario))
          <!--Si entro aqui es porque en ciclo de editar se a cumplido bien y me he traido la variable que manda el controlador desde la vista home-->

                                            <form role="form" method="POST" action="/edicion/perfils" enctype="multipart/form-data">
                                              <!-- Al Form le cambie la accion colocandole la funcion ::route:: la cual indica el controlador a donde a de ir mas la funcion en el mismo, ademas de la variable que resivi del home indicado la id del registro a modificar.
                                              Esta ruta la puedes verificar con el comando :: php artisan route:list ::-->
                                       

                                              <!-- Cambio el metodo con el cual envio los datos ya que segun la ruta, estos se envian mediante PUT y si no se modifica laravel no lo reconoce-->


                                              <input class="hide" type="text" name="img" value="{{$mod_usuario->img_perfil}}">
                                              <!-- Creamos un input oculto para poder enviar el nombre de la imagen a la nueva funcion de update.
                                              A este le asignamos el valor que viene en la variable resivida de home -->

                                                {{ csrf_field() }}
                                                
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
                                                         <div class="col-md-5">
                                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                            <label for="password" class="control-label">Contraseña</label>
                                                            <div>
                                                                <input id="password" type="password" class="form-control" name="password" required>
                                                                @if ($errors->has('password'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('password') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>    
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="password-confirm" class="control-label">Confirmar Contraseña</label>
                                                            <div>
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                                           
                                                    
                                                    <div class="form-group">
                                                      <div  class="col-md-4">
                                                        <label>Foto de Perfil</label>
                                                      </div>
                                                    
                                                      <div  class="col-md-2">
                                                        <img src='/img_perfil/{{ $mod_usuario->img_perfil}}' class="img-responsive" alt="Responsive image" style="max-width: 100px; max-height: 100px;"> 
                                                       </div>               
                                                    
                                                    <div class="col-md-3">
                                                      <input type="file" name="img_perfil" required value="{{ $mod_usuario->img_perfil}}" >
                                                        <input class="hide" type='text' name="img_perfil" value="{{ $mod_usuario->img_perfil}}">
                                                    </div>
                                                  </div>
                                                  <div class="row col-md-offset-1">
                                      </div>
                                                    <!-- /.box-body -->
                                                    <div class="box-footer">
                                                      <button type="submit" class="btn btn-warning  pull-right">Modificar</button>
                                                    </div>
                                            </form>

                                            <!-- /.box -->
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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
</script>

<script src="/datatables/jquery.dataTables.js"></script>
<script src="/datatables/dataTables.bootstrap.min.js"></script>
<script>
    //Initialize Select2 Elements
    $(".select2").select2();

    $(document).ready(function(){
        var oTable=$('#Usuarios').DataTable({
            "responsive": true,  
            "order": [],
            //"paging": false,
            "language": {
                       "info": "Se Encontro _TOTAL_ Registros",
                       "search": "Buscar Docente:",
                       "infoFiltered": " - De _MAX_ Posibles",
                       "zeroRecords": "No Se ha Encontrado el Docente",
                       "infoEmpty": "Registros _TOTAL_",
                       "loadingRecords": "Por favor Espere Estamos Buscando Registros",
                       "processing": "Procesando sus datos",
                        "lengthMenu": "Cantidad de Registros _MENU_"
                     },      

        });
        oTable.fnDestroy();
    });
</script>
@endsection
