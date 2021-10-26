<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SMARTMOODLE | REGISTRO</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->

    <link rel="stylesheet" href="css/app.css">

</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <b>Registro</b>SISTEMA
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Registar un nuevo usuario</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="cedula" type="text" placeholder="Cédula"
                            class="form-control @error('cedula') is-invalid @enderror" name="cedula"
                            value="{{ old('cedula') }}" required autocomplete="cedula" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <spam class="fas fa-user-circle"></spam>
                            </div>
                        </div>
                        @error('cedula')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- particion de datos-->
                    <div class="input-group mb-3">
                        <input id="cedula" type="text" placeholder="Fecha Nacimiento"
                            class="form-control @error('fechanacimiento') is-invalid @enderror" name="fechanacimiento"
                            value="{{ old('fechanacimiento') }}" required autocomplete="fechanacimiento" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-address-card"></span>
                            </div>
                        </div>
                        @error('fechanacimiento')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- particion de datos-->

                    <div class="input-group mb-3">
                        <input id="name" type="text" placeholder="Primer Nombre"
                            class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- particion de datos-->
                    <div class="input-group mb-3">
                        <input id="name" type="text" placeholder="Segundo Nombre"
                            class="form-control @error('sname') is-invalid @enderror" name="sname"
                            value="{{ old('sname') }}" required autocomplete="sname" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('sname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- particion de datos-->
                    <div class="input-group mb-3">
                        <input id="name" type="text" placeholder="Primer Apellido"
                            class="form-control @error('apellido') is-invalid @enderror" name="apellido"
                            value="{{ old('apellido') }}" required autocomplete="apellido" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('apellido')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- particion de datos-->
                    <div class="input-group mb-3">
                        <input id="name" type="text" placeholder="Segundo Apellido"
                            class="form-control @error('sapellido') is-invalid @enderror" name="sapellido"
                            value="{{ old('sapellido') }}" required autocomplete="sapellido" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('sapellido')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="name" type="text" placeholder="Domicilio"
                            class="form-control @error('domicilio') is-invalid @enderror" name="domicilio"
                            value="{{ old('domicilio') }}" required autocomplete="domicilio" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('domicilio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- particion de datos-->
                    <div class="input-group mb-3">
                        <input id="name" type="text" placeholder="Teléfono"
                            class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                            value="{{ old('telefono') }}" required autocomplete="telefono" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('telefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- particion de datos-->
                    <div class="input-group mb-3">
                        <input id="name" type="text" placeholder="Celular"
                            class="form-control @error('celular') is-invalid @enderror" name="celular"
                            value="{{ old('celular') }}" required autocomplete="celular" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('celular')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="titulo" type="text" placeholder="Profesion"
                            class="form-control @error('titulo') is-invalid @enderror" name="titulo"
                            value="{{ old('titulo') }}" required autocomplete="titulo">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @error('titulo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- desde aqui empieza todo csm -->
                    <!-- desde aqui empieza todo csm -->
                    <!-- desde aqui empieza todo csm -->
                    <!-- desde aqui empieza todo csm -->
                    <!-- particion de datos-->
                    <div class="input-group mb-3">
                        <input id="fcontrato" type="text" placeholder="fecha contrato"
                            class="form-control @error('fcontrato') is-invalid @enderror" name="fcontrato"
                            value="{{ old('fcontrato') }}" required autocomplete="fcontrato">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @error('fcontrato')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- particion de datos-->
                    <div class="input-group mb-3">
                        <input id="cirepre" type="text" placeholder="Cedula Representante"
                            class="form-control @error('cirepre') is-invalid @enderror" name="cirepre"
                            value="{{ old('cirepre') }}" required autocomplete="cirepre">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @error('cirepre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- particion de datos-->
                    <div class="input-group mb-3">
                        <input id="namerepre" type="text" placeholder="Nombre del representante"
                            class="form-control @error('namerepre') is-invalid @enderror" name="namerepre"
                            value="{{ old('namerepre') }}" required autocomplete="namerepre">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @error('namerepre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- particion de datos-->
                    <div class="input-group mb-3">
                        <input id="namema" type="text" placeholder="nombre de la Mama"
                            class="form-control @error('namema') is-invalid @enderror" name="namema"
                            value="{{ old('namema') }}" required autocomplete="namema">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @error('namema')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- particion de datos-->
                    <div class="input-group mb-3">
                        <input id="namepa" type="text" placeholder="Nombre del Papa"
                            class="form-control @error('namepa') is-invalid @enderror" name="namepa"
                            value="{{ old('namepa') }}" required autocomplete="namepa">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @error('namepa')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- particion de datos-->
                    <div class="input-group mb-3">
                        <input id="telefonorep" type="text" placeholder="Telefono representante"
                            class="form-control @error('telefonorep') is-invalid @enderror" name="telefonorep"
                            value="{{ old('telefonorep') }}" required autocomplete="telefonorep">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @error('telefonorep')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- particion de datos-->
                    <div class="input-group mb-3">
                        <input id="fregistro" type="text" placeholder="Fecha Registro"
                            class="form-control @error('fregistro') is-invalid @enderror" name="fregistro"
                            value="{{ old('fregistro') }}" required autocomplete="fregistro">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @error('fregistro')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- particion de datos-->
                    <div class="input-group mb-3">
                        <h3>Estado del Usuario</h3>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="estadoon" name="estado" class="custom-control-input" value="on"
                                @if(old('estado')=="on" ) checked @endif>
                            <label class="custom-control-label" for="estadoon">Activo</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="estadooff" name="estado" class="custom-control-input" value="off"
                                @if(old('estado')=="off" ) checked @endif>
                            <label class="custom-control-label" for="estadooff">No Activo</label>
                        </div>
                        <br><br>

                        @error('estado')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- particion de datos-->
                    <div class="input-group mb-3">
                        <input id="email" type="email" placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- particion de datos-->

                    <!-- particion de datos-->
                    <div class="input-group mb-3">
                        <input id="password" type="password" placeholder="Password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input id="password-confirm" type="password" placeholder="Confirme password"
                            class="form-control" name="password_confirmation" required autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <a class="btn btn-link" href="{{ route('login') }}">
                                {{ __('Ya tengo una cuenta') }}
                            </a>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <script src="js/app.js"></script>
</body>

</html>