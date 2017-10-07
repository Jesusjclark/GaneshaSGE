@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">Registro de Usuario</h4>
                            <p class="category">Ingrese los Datos del Nuevo Usuario</p>
                        </div>
                        <div class="card-content">

                            <section class="content-header">
                              <ol class="breadcrumb">
                                <li>
                                    <a href="/home"><i class="fa fa-dashboard"></i>
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="/Usuario/G_usu"><i class="fa fa-dashboard"></i>
                                        Gestion de Usuarios
                                    </a>
                                </li>
                                <li class="active">
                                    Registrare Usuario
                                </li>
                              </ol>
                            </section><br>
                            <form class="form-horizontal" role="form" method="POST" action="/Usuario/crear" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row col-md-offset-1">
                                    <div class="col-md-5">
                                        <div class="form-group {{ $errors->has('ci_usu') ? ' has-error' : '' }}">
                                            <label for="ci_usu" class="control-label">Cedula De Identidad</label>
                                            <div>
                                                <input id="ci_usu" type="text" class="form-control" name="ci_usu" value="{{ old('ci_usu') }}"  maxlength="8" minlength="7" onKeyPress="return soloNumeros(event)" placeholder="Ej. xxxxxxxxx" required autofocus>
                                                @if ($errors->has('ci_usu'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('ci_usu') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="img_perfil" class="control-label">Imagen de Perfil</label>
                                            <div>
                                                <input type="file" name="img_perfil" required/>
                                                <input class="hide" type='text' name="img_perfil" value="usericon.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-offset-1">
                                    <div class="col-md-5">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}  ">
                                            <label for="name" class="control-label">Nombre de Usuario</label>
                                            <div>
                                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" onkeypress="return soloLetras(event)" maxlength="15" minlength="4" placeholder="Ej. Jose" required autofocus>
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <div class="form-group{{ $errors->has('ape_usu') ? ' has-error' : '' }}">
                                            <label for="ape_usu" class="control-label">Apellido del Usuario</label>
                                            <div>
                                                <input id="ape_usu" type="text" class="form-control" name="ape_usu" value="{{ old('ape_usu') }}" onkeypress="return soloLetras(event)" maxlength="15" minlength="4" placeholder="Ej. Perez"  required autofocus>
                                                @if ($errors->has('ape_usu'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('ape_usu') }}</strong>
                                                    </span>
                                                @endif
                                            </div>        
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-offset-1">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="roles">Roles Del Usuario</label>
                                            <div class="col-md-offset-1"> 
                                                @if(isset($roles) )
                                                    @foreach($roles as $rol)
                                                        <input type="checkbox" id="{{$rol->id_rol}}" name="id_rol[]" value="{{$rol->id_rol}}" onclick="showContent(this)"><!--mando id -->
                                                                {{$rol->nom_rol}}
                                                        </input><br>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                        {{-- div oculto --}}
                                    <div class="col-md-5" id="divUC" style="display: none;">
                                        <div class="form-group">
                                            <label>Unidades Curriculares</label>     
                                            <select class="form-control select2" multiple="multiple" data-placeholder="Seleccione Unidades" style="width: 100%;" name="materia[]">
                                                @if(isset($uc) )
                                                    @foreach($uc as $uc)
                                                        <option value='{{ $uc->cod_uc_pnf }}' >

                                                            {{ $uc->nom_uc }} 
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row col-md-offset-1">
                                    <div class="col-md-5">                                        
                                        <div class="form-group{{ $errors->has('tlf') ? ' has-error' : '' }}">
                                            <label for="tlf" class="control-label">Telefono Celular</label>
                                            <div>
                                                <input id="tlf" type="text" class="form-control" name="tlf" value="{{ old('tlf') }}"  onkeypress="return soloNumeros(event)" maxlength="11" minlength="11" placeholder="Ej. 04262341232"  required autofocus>
                                                @if ($errors->has('tlf'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('tlf') }}</strong>
                                                    </span>                                                
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="control-label">Correo Electronico</label>
                                            <div>
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  onBlur="revisarEmail(this); "  maxlength="36" minlength="10" placeholder="Ej.  ejemplo@ejemplo.com" required autofocus>
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-right">
                                        Registrar
                                    </button>
                                </div>
                                <div class="clearfix"></div>
                            </form>
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

<script type="text/javascript">
    function showContent(check) 
        {        
   // alert('El check '+check.id+' tiene el valor '+check.value);
        checka = check.id;
        if (checka == '5') {
            element = document.getElementById("divUC");    
            if (check.checked) {
                $('.select2').attr("required", true);
                element.style.display='block';
            }
            else {
                $('.select2').attr("required", false);

                element.style.display='none';
            }
        }
    }
</script>
@endsection