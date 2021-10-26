@extends('layouts.nav')

@section('title', 'Password | SmartMoodle')



@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> Parece que hay porblemas o Malas decisiones <br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<section class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/sistema/homees') }}">
                <span class="brand-text font-weight-dark">SmartMoodle</span>
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Cambio de Contraseña
                </p>

                <form method="POST" action="{{route('Estudiantes.updatep')}}">
                    @csrf

                    <!-- <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña Actual">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div> -->
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="newpassword" placeholder="Nueva Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="newpassword_confirmation"
                            placeholder="Confirmar Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" class="btn btn-primary btn-block" value="Cambiar Contraseña">

                        </div>
                        <!-- /.col -->
                    </div>
                </form>


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
</section>
@stop
@section('css')
@stop
@section('js')

@stop