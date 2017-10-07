@extends('layouts.Principal')

@section('content')

<div class="container-fluid register-backgrounds">

    <div class="row"><br>
        <div class="col-md-6 col-md-offset-1">

                            <div id="carousel-example-generic" class="carousel slide">
                        <!-- Indicators -->
                        <ol class="carousel-indicators hidden-xs">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                              <div class="item active">
                                  <img class="img-responsive img-full" src="img/slide-1.jpg" alt="">
                              </div>
                              <div class="item">
                                  <img class="img-responsive img-full" src="img/slide-2.jpg" alt="">
                              </div>
                              <div class="item">
                                  <img class="img-responsive img-full" src="img/slide-3.jpeg" alt="">
                              </div>
                        </div><!--FIN CARRUSEL INNER-->

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="icon-next"></span>
                        </a>
                    </div>
                    </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Bienvenido</h4>
                    <p class="category">Ingrese sus Datos</p>
                </div>                
                <div class="card-content">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}


                        <div class="{{ $errors->has('ci_usu') ? ' has-error' : '' }}">
                            <label for="ci_usu" class="control-label">Cedula de Identidad</label>
                                <input id="ci_usu" type="text" class="form-control" name="ci_usu" value="{{ old('ci_usu') }}" maxlength="8" minlength="7" onKeyPress="return soloNumeros(event)" placeholder="xxxxxxxxx" required autofocus>
                                @if ($errors->has('ci_usu'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ci_usu') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Recordarme
                            </label>
                            <br>
                            <button type="submit" class="btn btn-primary">
                                Entrar
                            </button>
                            <a class="btn btn-link" href="/passw">
                                ¿Olvido su Contraseña?
                            </a>

                    </form> 
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
 
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Ingreso para Estudiante</h4>
                    <p class="category">Consulta tu Nota</p>
                </div>          
            <!-- /.box-header -->
                <div class="card-content">
                            @include('flash::message')
                    
                    @include('Alumnos.Datos_Consulta')
                </div>
            <!-- /.box-body -->
            </div>
          <!-- /.box -->
        </div>
    </div>
</div>
@endsection
@section('customjs')

  <script>

$('#guardar').click(function(){
    ci_usu = $('.ci').val();
    password = $('.pass').val();
    if (ci_usu == password) {
        $('#guardar').attr("type", "submit");
    }
    else{
        alert('Los Datos Ingresados Son incorrectos o Distintos Por Favor Verifique');
    }
});
    </script>
@endsection
