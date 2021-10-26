<div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #465256;">
        <a href="{{ url('/sistema/homedoc') }}" class="brand-link">
            <img src=" {{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-4" style="opacity: .8">
            <span class="brand-text font-weight-bold text-light">SmartMoodle</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a href="{{ url('/sistema/perfile') }}" class="nav-link">Materias</a>
                </li>
                <li class="nav-item active">
                    <a href="{{ url('/sistema/post-estudiante') }}" class="nav-link">Crear Post</a>
                </li>
                <li class="nav-item active">
                    <a href="{{ url('/sistema/post-docentes-estudiantes') }}" class="nav-link">Publicaciones Generales</a>
                </li>
             
            </ul>
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
                        <a class="dropdown-item" href="{{ url('sistema/docente/password') }}">
                            <i class="fas fa-lock"></i> Cambiar Contraseña
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-in-alt"></i>Cerrar Sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </nav>
        <!-- Navbar -->
       {{--  <nav class=" navbar navbar-expand navbar-light bg-light fixed-top">

            <!-- SEARCH FORM -->
            <a href="{{ url('/sistema/homees') }}" class="brand-link">
                <img src=" {{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-4" style="opacity: .8">
                <span class="brand-text font-weight-light">SmartMoodle</span>
            </a>
            <ul class="navbar-nav">
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/sistema/home') }}" class="nav-link">Administracion</a>
                </li>  -->
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/sistema/perfile') }}" class="nav-link">Materias</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/sistema/post-estudiante') }}" class="nav-link">Crear Post</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Cursos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">FAQ</a>
                        <a class="dropdown-item" href="#">Support</a>
                        <a class="dropdown-item" href="#">Contact</a>
                    </div>
                </li>
            </ul>

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
                        <a class="dropdown-item" href="{{ url('sistema/estudiante/password') }}">
                        <i class="fas fa-lock"></i> Cambiar Contraseña
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-in-alt"></i> Cerrar Sesión
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>

        </nav> --}}
    </div>
    <br><br><br>
    <section class="content">
        @yield('content')
    </section>
