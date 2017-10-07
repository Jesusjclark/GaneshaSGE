<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <link rel="apple-touch-icon" sizes="76x76" href="/img/icon-evernote.png" />
  <link rel="icon" type="image/png" href="/img/icon-evernote.png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ 'Ganesha[SIGE]' }}</title>


    <!--Styles-->
    <link href="/css/estilos.css" rel="stylesheet">
  <!-- Select2 -->
  <link rel="stylesheet" href="/css/bootstrap.css">
  <link rel="stylesheet" href="/css/AdminLTE.css">
  <link rel="stylesheet" href="/css/_all-skins.css">
  <link rel="stylesheet" href="/css/select2.css">

  @yield('customcss')
</head>
<body>  

    <div class="wrapper ">
      <header class='main-header'>
        <nav class="navbar-header navbar-static-top">

            <a class="navbar-brand">
              <img class='logo2 img-responsive' alt="Responsive image" src='/img/ganesha.png' style="max-width: 50px; max-height: 50px;">
            </a>
            <a href="/" class="navbar-brand">
              <font color="white">
                <h4>
                  Sistema de Informacion Para la Gestion de Evaluaciones GANESHA |SIGE|
                </h4>
              </font>
            </a>  
        
            <a class="navbar-brand">
<img class='logotype img-responsive' src='/img/logo.png' alt="Responsive image" style="max-width: 50px; max-height: 50px;">
            </a>
            <a class="navbar-brand">
              <font color="white">
                <h4>
                  UPTAEB
                </h4>
              </font>
            </a>  
                      <div class="col-md-2"></div>

            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
                    <font color="white">Ayuda<span class="caret"></span></font> 
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">E-mail</a></li>
                    <li><a target="_blank" href="docs/Manual de Usuario.pdf">Manual de usuario</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">About</a></li>
                  </ul>
                </li>
              </ul>
            </div>
        </nav>
      </header>
     
<div class="content-wrapper">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reseteo de Password</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
 
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 </div>
    
  </div>
   <!-- Jquery a de estar siempre de primero -->
  <script src="{{ asset('/js/jquery.js') }}"></script>
  <script src="{{ asset('/js/bootstrap.js') }}"></script>
  <script src="{{ asset('/js/functions.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('/js/select2.full.js') }}"></script>
  <script src="{{ asset('/js/Admin.min.js') }}"></script>
                

@yield('customjs')
</body>
</html>