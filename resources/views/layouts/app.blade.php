{{--<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href=" {{ asset('/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href=" {{ asset('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{ asset('/dist/css/adminlte.min.css') }}">
  
  @livewireStyles
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
@livewireScripts

<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src=" {{ asset('/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-success">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color:white;"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Inicio</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contacto</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search" style="color:white;"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search" style="color:white;"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times" style="color:white;"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell" style="color:white;"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notificaciones</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2" style="color:white;"></i> 4 nuevos mensajes
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt" style="color:white;"></i>
        </a>
      </li>
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user-alt" style="color:white;"></i>
          <!-- <span class="badge badge-danger navbar-badge">3</span> -->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="{{ route('profile.show') }}" class="dropdown-item d-flex justify-content-center">
              Configuración de la cuenta
          </a>
          <div class="dropdown-divider"></div>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            this.closest('form').submit();" class="dropdown-item dropdown-footer">Cerrar Sesión</a>
        </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-green elevation-4" style="background-color: rgb(15, 97, 0);">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <svg class="pl-2" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve" width="30">
        <path style="fill:#DEC33D;" d="M411.813,212.139c-11.026-22.588-27.216-42.088-46.209-58.554
          c-14.589-12.644-35.218-38.233-45.731-86.573C302.56-12.608,256.19,0.861,256.19,0.861s-46.373-13.469-63.687,66.152
          c-10.512,48.34-31.142,73.929-45.731,86.573c-18.993,16.463-35.186,35.966-46.209,58.554
          c-20.922,42.864-40.739,111.128-13.725,189.985c0,0,64.823,165.924,169.352,89.064c104.529,76.86,169.348-89.064,169.348-89.064
          C452.553,323.268,432.732,255.007,411.813,212.139z"/>
        <path style="fill:#FBD960;" d="M349.558,171.567c-12.843-11.655-36.689-42.02-45.943-86.579
          c-15.244-73.39-47.426-64.293-47.426-64.293s-0.048-0.013-0.135-0.035h-0.902c-0.083,0.022-0.135,0.035-0.135,0.035
          s-32.188-9.097-47.429,64.293c-9.254,44.556-33.1,74.924-45.943,86.579C147.1,184.769,90.44,233.835,97.916,339.359
          c2.619,37.003,14.245,73.066,35.726,103.312c25.255,35.568,66.909,68.588,121.374,22.209l0,0v0.867
          c0.196-0.148,0.392-0.292,0.584-0.433c0.196,0.141,0.392,0.286,0.587,0.433v-0.867l0,0c54.468,46.379,96.119,13.359,121.374-22.209
          c21.477-30.246,33.103-66.306,35.726-103.312C420.763,233.835,364.102,184.769,349.558,171.567z"/>
        <path style="fill:#F27B2C;" d="M334.536,186.393c-11.173-10.891-40.598-42.447-45.057-84.621
          c-7.065-66.896-27.701-65.51-33.074-66.797v-0.1c-0.055,0.01-0.132,0.039-0.189,0.051c-0.035-0.006-0.08-0.022-0.116-0.032v0.064
          c-5.37,1.287-26.696-0.08-33.074,66.797c-4.025,42.216-33.883,73.73-45.057,84.621c-12.66,12.335-63.343,47.503-56.84,146.109
          c2.282,34.577,12.4,68.274,31.094,96.536c21.702,32.818,61.276,53.309,103.964,15.539c42.129,37.774,82.387,17.304,104.092-15.52
          c18.694-28.266,28.815-61.96,31.094-96.536C397.883,233.896,347.199,198.729,334.536,186.393z"/>
        <path style="fill:#FBD960;" d="M277.115,139.761c-15.905-63.61-8.49-117.509-8.49-117.509l-12.573-1.592l-0.157,131.18
          l-0.157-131.504l-12.573,1.595c0,0,7.415,53.9-8.487,117.509c-15.712,62.846-97.595,127.014,13.016,252.503
          c2.244,2.545,5.717,3.74,9.106,3.852l4.07-2.305c4.06,0.135,3.955,0.761,6.638-2.285
          C376.788,267.153,292.789,202.465,277.115,139.761z"/>
        <path style="fill:#EAAB57;" d="M256.742,376.089c0,0,108.275-92.765-1.14-218.661C255.603,157.431,152.987,266.453,256.742,376.089z
          "/>
        <g>
          <circle style="fill:#A05F32;" cx="234.322" cy="213.327" r="10.56"/>
          <circle style="fill:#A05F32;" cx="256.181" cy="213.327" r="10.56"/>
          <circle style="fill:#A05F32;" cx="244.882" cy="256.243" r="10.56"/>
          <circle style="fill:#A05F32;" cx="268.635" cy="234.576" r="10.557"/>
          <circle style="fill:#A05F32;" cx="289.756" cy="233.292" r="10.56"/>
          <circle style="fill:#A05F32;" cx="268.635" cy="191.651" r="10.557"/>
          <circle style="fill:#A05F32;" cx="227.709" cy="234.641" r="10.56"/>
          <circle style="fill:#A05F32;" cx="223.761" cy="277.588" r="10.56"/>
          <circle style="fill:#A05F32;" cx="227.709" cy="299.255" r="10.56"/>
          <circle style="fill:#A05F32;" cx="268.635" cy="277.588" r="10.557"/>
          <circle style="fill:#A05F32;" cx="257.432" cy="320.376" r="10.56"/>
          <circle style="fill:#A05F32;" cx="266.741" cy="256.243" r="10.557"/>
          <circle style="fill:#A05F32;" cx="256.181" cy="173.525" r="10.56"/>
          <circle style="fill:#A05F32;" cx="248.83" cy="299.255" r="10.56"/>
          <circle style="fill:#A05F32;" cx="289.756" cy="277.588" r="10.56"/>
          <circle style="fill:#A05F32;" cx="289.756" cy="299.255" r="10.56"/>
          <circle style="fill:#A05F32;" cx="259.391" cy="356.872" r="10.56"/>
          <circle style="fill:#A05F32;" cx="279.205" cy="320.376" r="10.56"/>
          <circle style="fill:#A05F32;" cx="246.872" cy="338.993" r="10.56"/>
        </g>
        <path style="opacity:0.1;enable-background:new    ;" d="M152.037,171.05c0,0-96.019,86.075-34.455,222.635
          c35.244,78.176,105.707,98.632,176.423,93.593c-56.577-4.494-108.695-29.884-137.417-93.593
          C95.024,257.129,191.043,171.05,191.043,171.05s50.356-26.504,50.356-95.416c0-36.743,13.555-60.576,26.215-74.915
          c-7.033-0.735-11.803,0.632-11.803,0.632s-17.503-5.049-35.016,9.492c-9.851,14.63-18.405,35.642-18.405,64.791
          C202.396,144.546,152.037,171.05,152.037,171.05z"/>
        <path style="opacity:0.2;enable-background:new    ;" d="M294.006,487.278c-70.716,5.036-141.179-15.417-176.423-93.593
          C56.018,257.129,152.037,171.05,152.037,171.05s50.356-26.504,50.356-95.416c0-29.149,8.554-50.16,18.405-64.791
          c-10.994,9.129-21.994,25.955-28.67,56.66c-10.512,48.34-31.142,73.929-45.731,86.573c-18.993,16.463-35.186,35.966-46.209,58.554
          c-20.922,42.864-40.739,111.128-13.725,189.985c0,0,64.823,165.924,169.352,89.064c49.079,36.088,89.401,18.652,118.373-9.999
          C347.767,486.922,320.407,489.374,294.006,487.278z"/>
        <g style="opacity:0.3;">
          <circle style="fill:#FFFFFF;" cx="378.348" cy="211.799" r="21.394"/>
          <circle style="fill:#FFFFFF;" cx="403.705" cy="257.784" r="10.698"/>
        </g>
        <g>
        </g>
        <g>
        </g>
        <g>
        </g>
        <g>
        </g>
        <g>
        </g>
        <g>
        </g>
        <g>
        </g>
        <g>
        </g>
        <g>
        </g>
        <g>
        </g>
        <g>
        </g>
        <g>
        </g>
        <g>
        </g>
        <g>
        </g>
        <g>
        </g>
      </svg>
      <span class="brand-text font-weight-light pl-2">Papaya Maradol</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ ucwords(Auth::user()->name) }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item {{ Route::is('dashboard') ? 'menu-open' : '' }}">
            <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if(\Auth::user()->can('usuario.create') || \Auth::user()->can('usuario.index') || \Auth::user()->can('usuario.editar.avanzado') || \Auth::user()->can('usuario.desactivar.activar'))
            <li class="nav-header">SEGURIDAD</li>
            <li class="nav-item {{ Route::is('user.create') || Route::is('user.index') || Route::is('user.update') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link" style="{{ Route::is('user.create') || Route::is('user.index') || Route::is('user.update') ? 'background-color:#B5AD0E' : '' }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Usuarios
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('usuario.crear')
                  <li class="nav-item">
                    <a href="{{ route('user.create') }}" class="nav-link {{ Route::is('user.create') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Crear Usuario</p>
                    </a>
                  </li>
                @endcan
                @can('usuario.index')
                  <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link {{ Route::is('user.index') || Route::is('user.update') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lista de Usuarios</p>
                    </a>
                  </li>
                @endcan
              </ul>
            </li>
          @endif
          @if(\Auth::user()->can('rol.crear') || \Auth::user()->can('rol.index') || \Auth::user()->can('rol.editar.avanzado') || \Auth::user()->can('rol.asignar') || \Auth::user()->can('rol.revocar'))
            <li class="nav-item {{ Route::is('role.index') | Route::is('role.create.get') | Route::is('role.update.get') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link" style="{{ Route::is('role.create') || Route::is('role.index') || Route::is('role.update') ? 'background-color:#B5AD0E' : '' }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Roles
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('rol.index')
                  <li class="nav-item">
                    <a href="{{ route('role.index') }}" class="nav-link {{ Route::is('role.index') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lista de Roles</p>
                    </a>
                  </li>
                @endcan
              </ul>
            </li>
          @endif
          <li class="nav-header">GESTION INTERNA</li>
          <li class="nav-item {{ Route::is('cliente.create') || Route::is('cliente.index') 
                                || Route::is('tipo.gasto.create') || Route::is('tipo.gasto.index') || Route::is('tipo.gasto.update')
                                  ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                MANTENIMIENTO
                <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: {{ Route::is('cliente.create') || Route::is('cliente.index') 
                                                        || Route::is('tipo.gasto.create') || Route::is('tipo.gasto.index') || Route::is('tipo.gasto.update')
                                                        || Route::is('producto.create') || Route::is('producto.index') || Route::is('producto.update')
                                                        || Route::is('sector.create') || Route::is('sector.index') || Route::is('sector.update')
                                                        || Route::is('lote.create') || Route::is('lote.index') || Route::is('lote.update')
                                                        || Route::is('empleado.create') || Route::is('empleado.index') || Route::is('empleado.update')
                                                      ? 'block' : 'none' }};">
                @if(\Auth::user()->can('cliente.crear') || \Auth::user()->can('cliente.index') || \Auth::user()->can('cliente.editar.avanzado'))
                  <li class="nav-item {{ Route::is('cliente.create') || Route::is('cliente.index') ? 'menu-is-opening menu-open' : '' }}">
                      <a href="#" class="nav-link" style="{{ Route::is('cliente.create') || Route::is('cliente.index') || Route::is('cliente.update') ? 'color: white; background-color:#B5AD0E' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                              Clientes
                          <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: {{ Route::is('cliente.create') || Route::is('cliente.index') ? 'block' : 'none' }};">
                          @can('cliente.crear')
                              <li class="nav-item">
                              <a href="{{ route('cliente.create') }}" class="nav-link {{ Route::is('cliente.create') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Crear Cliente</p>
                              </a>
                              </li>
                          @endcan
                          @can('cliente.index')
                              <li class="nav-item">
                              <a href="{{ route('cliente.index') }}" class="nav-link {{ Route::is('cliente.index') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Lista de clientes</p>
                              </a>
                              </li>
                          @endcan
                      </ul>
                  </li>
                @endif
                @if(\Auth::user()->can('empleado.crear') || \Auth::user()->can('empleado.index') || \Auth::user()->can('empleado.editar.avanzado'))
                  <li class="nav-item {{ Route::is('empleado.create') || Route::is('empleado.index') ? 'menu-is-opening menu-open' : '' }}">
                      <a href="#" class="nav-link" style="{{ Route::is('empleado.create') || Route::is('empleado.index') || Route::is('empleado.update') ? 'color: white; background-color:#B5AD0E' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                              Empleado
                          <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: {{ Route::is('empleado.create') || Route::is('empleado.index') ? 'block' : 'none' }};">
                          @can('empleado.crear')
                              <li class="nav-item">
                              <a href="{{ route('empleado.create') }}" class="nav-link {{ Route::is('empleado.create') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Crear Empleado</p>
                              </a>
                              </li>
                          @endcan
                          @can('empleado.index')
                              <li class="nav-item">
                              <a href="{{ route('empleado.index') }}" class="nav-link {{ Route::is('empleado.index') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Lista de Empleados</p>
                              </a>
                              </li>
                          @endcan
                      </ul>
                  </li>
                @endif
                @if(\Auth::user()->can('tipo.gasto.crear') || \Auth::user()->can('tipo.gasto.index') || \Auth::user()->can('tipo.gasto.editar.avanzado'))
                  <li class="nav-item {{ Route::is('tipo.gasto.create') || Route::is('tipo.gasto.index') || Route::is('tipo.gasto.update') ? 'menu-is-opening menu-open' : '' }}">
                      <a href="#" class="nav-link" style="{{ Route::is('tipo.gasto.create') || Route::is('tipo.gasto.index') || Route::is('tipo.gasto.update') ? 'color: white; background-color:#B5AD0E' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Tipos Gastos
                          <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: {{ Route::is('tipo.gasto.create') || Route::is('tipo.gasto.index') || Route::is('tipo.gasto.update') ? 'block' : 'none' }};">
                        @can('tipo.gasto.crear')
                          <li class="nav-item">
                            <a href="{{ route('tipo.gasto.create') }}" class="nav-link {{ Route::is('tipo.gasto.create') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Crear Tipo Gasto</p>
                            </a>
                          </li>
                        @endcan
                        @can('tipo.gasto.index')
                          <li class="nav-item">
                            <a href="{{ route('tipo.gasto.index') }}" class="nav-link {{ Route::is('tipo.gasto.index') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Lista Tipo Gasto</p>
                            </a>
                          </li>
                        @endcan
                      </ul>
                  </li>
                @endif
                @if(\Auth::user()->can('producto.crear') || \Auth::user()->can('producto.index') || \Auth::user()->can('producto.editar.avanzado'))
                  <li class="nav-item {{ Route::is('producto.create') || Route::is('producto.index') || Route::is('producto.update') ? 'menu-is-opening menu-open' : '' }}">
                      <a href="#" class="nav-link" style="{{ Route::is('producto.create') || Route::is('producto.index') || Route::is('producto.update') ? 'color: white; background-color:#B5AD0E' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Productos
                          <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: {{ Route::is('producto.create') || Route::is('producto.index') || Route::is('producto.update') ? 'block' : 'none' }};">
                        @can('producto.crear')
                          <li class="nav-item">
                            <a href="{{ route('producto.create') }}" class="nav-link {{ Route::is('producto.create') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Crear Producto</p>
                            </a>
                          </li>
                        @endcan
                        @can('producto.index')
                          <li class="nav-item">
                            <a href="{{ route('producto.index') }}" class="nav-link {{ Route::is('producto.index') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Lista Productos</p>
                            </a>
                          </li>
                        @endcan
                      </ul>
                  </li>
                @endif
                @if(\Auth::user()->can('sector.crear') || \Auth::user()->can('sector.index') || \Auth::user()->can('sector.editar.avanzado'))
                  <li class="nav-item {{ Route::is('sector.create') || Route::is('sector.index') || Route::is('sector.update') ? 'menu-is-opening menu-open' : '' }}">
                      <a href="#" class="nav-link" style="{{ Route::is('sector.create') || Route::is('sector.index') || Route::is('sector.update') ? 'color: white; background-color:#B5AD0E' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Sector
                          <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: {{ Route::is('sector.create') || Route::is('sector.index') || Route::is('sector.update') ? 'block' : 'none' }};">
                        @can('sector.crear')
                          <li class="nav-item">
                            <a href="{{ route('sector.create') }}" class="nav-link {{ Route::is('sector.create') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Crear Sector</p>
                            </a>
                          </li>
                        @endcan
                        @can('sector.index')
                          <li class="nav-item">
                            <a href="{{ route('sector.index') }}" class="nav-link {{ Route::is('sector.index') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Lista Sector</p>
                            </a>
                          </li>
                        @endcan
                      </ul>
                  </li>
                @endif
                @if(\Auth::user()->can('lote.crear') || \Auth::user()->can('lote.index') || \Auth::user()->can('lote.editar.avanzado'))
                  <li class="nav-item {{ Route::is('lote.create') || Route::is('lote.index') || Route::is('lote.update') ? 'menu-is-opening menu-open' : '' }}">
                      <a href="#" class="nav-link" style="{{ Route::is('lote.create') || Route::is('lote.index') || Route::is('lote.update') ? 'color: white; background-color:#B5AD0E' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Hectarea
                          <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: {{ Route::is('lote.create') || Route::is('lote.index') || Route::is('lote.update') ? 'block' : 'none' }};">
                        @can('lote.crear')
                          <li class="nav-item">
                            <a href="{{ route('lote.create') }}" class="nav-link {{ Route::is('lote.create') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Crear Hectarea</p>
                            </a>
                          </li>
                        @endcan
                        @can('lote.index')
                          <li class="nav-item">
                            <a href="{{ route('lote.index') }}" class="nav-link {{ Route::is('lote.index') ? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Lista Hectarea</p>
                            </a>
                          </li>
                        @endcan
                      </ul>
                  </li>
                @endif
            </ul>
          </li>
          <li class="nav-header">PROCESOS DETALLADOS</li>
          @if(\Auth::user()->can('gasto.crear') || \Auth::user()->can('gasto.index') || \Auth::user()->can('gasto.editar.avanzado') || \Auth::user()->can('gasto.eliminar'))
            <li class="nav-item {{ Route::is('gasto.create') || Route::is('gasto.index') || Route::is('gasto.update') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link" style="{{ Route::is('gasto.create') || Route::is('gasto.index') || Route::is('gasto.update') ? 'color: white; background-color:#B5AD0E' : '' }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Gastos
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('gasto.crear')
                  <li class="nav-item">
                    <a href="{{ route('gasto.create') }}" class="nav-link {{ Route::is('gasto.create') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ingreso de Gasto</p>
                    </a>
                  </li>
                @endcan
                @if(\Auth::user()->can('gasto.index') || \Auth::user()->can('gasto.eliminar'))
                  <li class="nav-item">
                    <a href="{{ route('gasto.index') }}" class="nav-link {{ Route::is('gasto.index') || Route::is('gasto.update') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Reporte de Gastos</p>
                    </a>
                  </li>
                @endcan
              </ul>
            </li>
          @endif
          @if(\Auth::user()->can('produccion.crear') || \Auth::user()->can('produccion.index') || \Auth::user()->can('produccion.editar.avanzado') || \Auth::user()->can('produccion.desactivar.activar'))
            <li class="nav-item {{ Route::is('produccion.create') || Route::is('produccion.index') || Route::is('produccion.update') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link" style="{{ Route::is('produccion.create') || Route::is('produccion.index') || Route::is('produccion.update') ? 'color: white; background-color:#B5AD0E' : '' }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Producción
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('produccion.crear')
                  <li class="nav-item">
                    <a href="{{ route('produccion.create') }}" class="nav-link {{ Route::is('produccion.create') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ingreso de produccion</p>
                    </a>
                  </li>
                @endcan
                @can('produccion.index')
                  <li class="nav-item">
                    <a href="{{ route('produccion.index') }}" class="nav-link {{ Route::is('produccion.index') || Route::is('produccion.update') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Reporte de Produccion</p>
                    </a>
                  </li>
                @endcan
              </ul>
            </li>
          @endif
          @if(\Auth::user()->can('venta.crear') || \Auth::user()->can('venta.index') || \Auth::user()->can('venta.editar.avanzado') || \Auth::user()->can('venta.desactivar.activar'))
            <li class="nav-item {{ Route::is('venta.create') || Route::is('venta.index') || Route::is('venta.update') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link" style="{{ Route::is('venta.create') || Route::is('venta.index') || Route::is('venta.update') ? 'color: white; background-color:#B5AD0E' : '' }}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Venta
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('venta.crear')
                  <li class="nav-item">
                    <a href="{{ route('venta.create') }}" class="nav-link {{ Route::is('venta.create') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ingreso de venta</p>
                    </a>
                  </li>
                @endcan
                @can('venta.index')
                  <li class="nav-item">
                    <a href="{{ route('venta.index') }}" class="nav-link {{ Route::is('venta.index') || Route::is('venta.update') ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Reporte de Ventas</p>
                    </a>
                  </li>
                @endcan
              </ul>
            </li>
          @endif
          <li class="nav-header">REPROTES GENERALES</li>
          <li class="nav-item">
            <a href="#" class="nav-link" style="">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Reportes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('reports.balance.general.get') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Balance Final</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-3">
    <!-- Page Heading -->
    @if (isset($header))
      <div class="col-sm-6 mb-3">
        <h3 class="m-0">{{ $header }}</h3>
      </div>
    @endif
    {{ $slot }}
  </div>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <strong>Copyright &copy;  Joel Garcia.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 3.1.0
        </div>
      </footer>
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/dist/js/adminlte.js') }}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('/js/validation.js') }}"></script>
    <script src="{{ asset('/dist/js/pages/dashboard2.js') }}"></script>
  </body>
</html>