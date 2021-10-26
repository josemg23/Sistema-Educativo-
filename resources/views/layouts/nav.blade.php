<!DOCTYPE html>
<html class="@yield('class')">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'SmartMoodle')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/preloader.css') }}">
    <link rel="icon" type="img/png" href="{{ asset('dist/img/AdminLTELogo.png') }}">


    <!-- datatabes -->
    <link rel="stylesheet" href=" {{ asset('https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet"
        href=" {{ asset('https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css')}}">


    <!-- <link rel="stylesheet" href=" {{ asset('css/jquery.dataTables.min.css')}}"> -->
    @livewireStyles

    @yield('css')

</head>

<body class="hold-transition sidebar-mini  layout-fixed">
    <li class="d-none">
        @if (Auth::check())


        @foreach (auth()->user()->roles as $role)
        {{ $rol = $role->descripcion}}
        @endforeach
    </li>
    @if ($rol === 'administrador')
    <!-- Preloader Start -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- layout-navbar-fixed -->
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fad fa-bars"></i></a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            {{--  <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fad fa-search"></i>
                        </button>
                    </div>
                </div>
            </form> --}}

            <ul class="navbar-nav ml-auto">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->name }} <i class="fad fa-sort-down"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <i class="fad fa-sign-in-alt"></i>Cerrar Sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </nav>
        <!-- /.navbar -->



        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/sistema/home') }}" class="brand-link">
                <img src=" {{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-4" style="opacity: .8">
                <span class="brand-text font-weight-light">SmartMoodle</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="true">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        @can('haveaccess', 'rol.index')
                        <li class="nav-header">ADMINISTRACIÓN</li>
                        <li class="nav-item">

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fad 10f19c fa-user-shield"></i>
                                <p>
                                    Roles
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('roles.index')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Lista de Roles</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endcan
                        @can('haveaccess', 'user.index')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fad fa-users"></i>
                                <p>
                                    Usuarios
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('users.index')}}" class="nav-link">
                                        <i class="fad fa-th-list"></i>
                                        <p>Lista de Usuarios</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endcan
                      {{--  @can('haveaccess', 'menu.index')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fad fa-user-cog"></i>
                                <p>
                                    Permisos de Acceso
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('permissions.index')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Lista de Permisos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan --}}
                        @can('haveaccess', 'instituto.index')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fad fa-school"></i>
                                <p>
                                    U. Educativa
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('institutos.index')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Lista de Unidades</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        <!-- @can('haveaccess', 'curso.index')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fad fa-user-cog"></i>
                                <p>
                                    Cursos
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('cursos.index')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Lista de Cursos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan -->

                        <!-- @can('haveaccess', 'nivel.index')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fad fa-user-cog"></i>
                                <p>
                                    Paralelos
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('nivels.index')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Lista de Paralelos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan -->
                        @can('haveaccess', 'nivel.clonacion')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fad fa-clone"></i>
                                <p>
                                    Clonacion
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('clinstitutos.create')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Clonacion de Un. Educativa</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can('haveaccess', 'materia.index')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fad fa-bookmark"></i>
                                <p>
                                    Materias
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('materias.index')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Lista de Materias</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can('haveaccess', 'contenido.index')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                               <i class="fad fa-book-open"></i>
                                <p>
                                    Unidades
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('contenidos.index')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Lista de Unidades</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                      @can('haveaccess', 'documentos.index')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                               <i class="fad fa-book-open"></i>
                                <p>
                                    Documentos
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('documentos.index')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Lista de Documentos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can('haveaccess', 'asignacion.index')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fad fa-users-class"></i>
                                <p>
                                    Cursos
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('distribucionmacus.index')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Lista de Cursos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        <!-- @can('haveaccess', 'asignacionma.index')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fad fa-user-cog"></i>
                                <p>
                                    Asignación Alumno
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('distrimas.index')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Lista de Asignaciones</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan -->
                        @can('haveaccess', 'asignacionma.index')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fad fa-chalkboard-teacher"></i>
                                <p>
                                    Asignación Alumno
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('assignments.index')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Lista de Asignaciones</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can('haveaccess', 'asignacionma.index')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fad fa-newspaper"></i>
                                <p>
                                    Publicaciones
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('posts.index')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Sección Post</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can('haveaccess', 'reporte.index')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fas fa-file-contract"></i>
                                <p>
                                    Reportes
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('Reportes')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Sección Reporte</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        <li class="nav-header">DOCENTE</li>
                        @can('haveaccess', 'asignacionma.index')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fad fa-chalkboard-teacher"></i>
                                <p>
                                    Asignación Docente
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('distribuciondos.index')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Lista de Asignaciones</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can('haveaccess', 'talleres.index')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fad fa-tasks-alt"></i>
                                <p>
                                    Talleres
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.create')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Crear Talleres</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.tallercontable')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Modulos Contables</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can('haveaccess', 'cuentas.index')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fad fa-file-alt"></i>
                                <p>
                                    Plan de Cuentas
                                    <i class="fad fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('pcuentas.index')}}" class="nav-link">
                                        <i class="fad fa-circle nav-icon"></i>
                                        <p>Lista Plan de Cuentas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>



        <div id="preloader">
            <div class="yummy-load">
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="">
            </div>
        </div>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-6">
                        <div class="col-sm-12">
                            @yield('encabezado')
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">

                @yield('content')
            </section>


        </div>
        @elseif($rol ==='estudiante')

        @include('layouts.estapp')
        @elseif($rol ==='docente')

        @include('layouts.docapp')

        @endif
        @endif
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/preloader.js') }}"></script>
    <script src="{{ asset('js/fonts.js') }}"></script>
    <!-- datatables script -->

    <script src="{{ asset('dist/ckeditor/ckeditor.js')}}"></script>
  
    <!-- <script src="{{asset('https://code.jquery.com/jquery-3.5.1.js')}}"></script> -->
    <script src="{{asset('https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js')}}"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>

   


    @livewireScripts

    @yield('js')
    {{--   @include('sweetalert::alert') --}}
</body>

</html>