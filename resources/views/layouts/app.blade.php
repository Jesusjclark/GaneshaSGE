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
  <link rel="stylesheet" href="/css/skin-blue-light.css">
  <link rel="stylesheet" href="/css/select2.css">

  @yield('customcss')
</head>
<body class="hold-transition skin-blue-light sidebar-mini">
  <div class="wrapper">
      <header class='main-header'>

        <a href='/home' class='logo'>
          <span class='logo-mini'>[SIGE]</span>
          <span class='logo-lg'><img class='logot' src='/img/ganesha.png'><font color='white'>GANESHA [SIGE]</font></span>
        </a>

        <nav class="navbar navbar-static-top">
              <!-- boton Sidebar-->
          <a class='navbar-brand' data-toggle="offcanvas" role="button">
            <font color='white'>≡</font>
          </a>
          <a class='navbar-brand'><img class='logo2 img-responsive' alt="Responsive image" src='/img/ganesha.png' style="max-width: 50px; max-height: 50px;"></a>
          <a class='navbar-brand' href='/home'> <font color='white'><h4>Sistema Para Gestion de Evaluaciones GANESHA [SIGE]</h4></font></a>
          <a class='navbar-brand'><img class='logotype img-responsive' src='/img/logo.png' alt="Responsive image" style="max-width: 50px; max-height: 50px;"></a>
          <a class='navbar-brand'><font color='white'><h4>UPTAEB</h4></font></a>


          <!-- Collect the nav links, forms, and other content for toggling -->    
            <div class="navbar-custom-menu">

                      <ul class="nav navbar-nav">
              <li class='dropdown user user-menu'>
                <a href='#' class='dropdown-toggle' data-toggle='dropdown' >
                  <font color='white'> {{Auth::User()->getNombreCompleto()}} <span class="caret"></span></font>
                </a>
                <ul class='dropdown-menu' >
                  <li><a href='/edit/perfil/'>Configuración de usuario</a></li>
                    <li><a target="_blank" href="/docs/Manual de Usuario.pdf">Manual de usuario</a></li>
                    
                  <li role='separator' class='divider'></li>
                  <!-- Authentication Links -->

                    <li>
                      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesion
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                    </li>
                </ul>
              </li>
            </ul>
          </div> 
        </nav>
      </header>
      <aside class="main-sidebar">
        <section class="sidebar">

          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src='/img_perfil/{{Auth::user()->img_perfil()}}' class='img-circle' alt='User Image'>
            </div>
            <div class="pull-left info">
              <p>{{Auth::user()->getNombreCompleto()}}</p> 
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <ul class="sidebar-menu">
            <li class="header">Menu De Navegacion</li>
            <li>
              <a href='/home'>
                <i><img src="/img/iconos/16x16/home.png"></i> <span>Mi Cuenta</span>
              </a>
            </li>
            @if(Auth::user()->tienerolesMod('consultar.usuario'))
            <li class="treeview">
              
              <a href="#">
                <i><img src="/img/iconos/16x16/drawer.png"></i><span>Gestión de Usuarios</span>
              </a>
              
              <ul class="treeview-menu">                
                <li><a href='/Usuario/G_usu'><img src="/img/iconos/16x16/user-alt-2.png"></i>Gestionar Usuarios</a></li>
                
                <li><a href='/Usuario/Asignacion_Unidades'><img src="/img/iconos/16x16/list-ordered.png"></i>Asignar Unidades Curriculares</a></li>
              </ul>

            </li>
            @endif

            <li class="treeview">
              <a href="#">
                <i><img src="/img/iconos/16x16/drawer.png"></i><span>Gestión de Unidades Curriculares</span>
              </a>
              <ul class="treeview-menu">                
                <li><a href="/Ejes/G_ejes"><img src="/img/iconos/16x16/connect-alt-1.png"></i> Gestion Ejes</a></li>
                <li><a href="/Uni_Crr/G_uc"><img src="/img/iconos/16x16/list-ordered.png"></i> Listar Unidades Curriculares</a></li>
                 <li><a href="/instrumentos/vista"><img src="/img/iconos/16x16/list-ordered.png"></i> Listar Instrumentos</a></li>
              </ul>
            </li>

           
            @if(Auth::user()->tienerolesMod('consultar.rol'))
            <li>
              <a href='/roles/vista'>
                <i><img src="/img/iconos/16x16/user-locked.png"></i> <span>Gestión de Roles</span>
              </a>
            </li>
            @endif

            @if(Auth::user()->tienerolesMod('consultar.planes'))
            <li>

              <a href='#'>

                <i><img src="/img/iconos/16x16/table.png"></i> <span>Gestión de Plan de Evaluación</span>
              </a>

               <ul class="treeview-menu">    
               @if(Auth::user()->tienerolesMod('crear.planmaestro'))

                  <li><a href="/Plan_Evaluaciones/Gestion_master"><img src="/img/iconos/16x16/connect-alt-1.png"></i>Gestion de Plan Maestro</a></li>
                 @endif
               @if(Auth::user()->tienerolesMod('modificar.planhijo'))

                <li><a href="/Plan_Evaluaciones/Gestion_Planes"><img src="/img/iconos/16x16/list-ordered.png"></i>Gestion de Planes</a></li>
                @endif
              </ul>
            </li>
            @endif

            @if(Auth::user()->tienerolesMod('consultar.alumno'))
              <li>
                <a href='/alumnos/vista'>
                  <i><img src="/img/iconos/16x16/users-alt.png"></i> <span>Gestión de Alumnos</span>
                </a>
              </li>
            @endif

            <li>
              <a href='/Secciones/G_Secciones'>
                <i><img src="/img/iconos/16x16/window-tile.png"></i> <span>Gestión de Secciones</span>
              </a>
            </li>
            <li>
            @if(Auth::user()->tienerolesMod('consultar.nota'))
              <a href='#'>
                <i><img src="/img/iconos/16x16/list-numbered.png"></i> <span>Gestión de Notas</span>
              </a>
              <ul class="treeview-menu">                
                <li>
                  <a href="/Notas/G_notas"><img src="/img/iconos/16x16/connect-alt-1.png"></i>Asignar Notas</a>
                </li>
                <li>
                  <a href="/Notas/Transcripcion"><img src="/img/iconos/16x16/list-ordered.png"></i>Transcripción de Notas</a>
                </li>
                <li>
                  <a href="/Notas/Estadisticas"><img src="/img/iconos/16x16/preferences.png"></i>Aprobados
                  y Reprobados </a>
                </li>
              </ul>
              
            </li>
            @endif
            <li>
              <a href='/Bitacora'>
                <i><img src="/img/iconos/16x16/computer.png"></i> <span>Bitácora</span>
              </a>
            </li>
          </ul>
        </section>
      </aside>

    <div class="content-wrapper">
      <Br>
      
        @yield('content')
        {{-- Contenido dentro del body --}}
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
