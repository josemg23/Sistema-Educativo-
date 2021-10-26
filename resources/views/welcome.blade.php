@extends('layouts.nav')


@section('title', 'Administracion - Inicio')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ App\Instituto::get()->count() }}</h3>

                    <p>Institutos</p>
                </div>
                <div class="icon">
                    <i class="fad fa-school"></i>
                </div>
                <a href="{{ route('institutos.index') }}" class="small-box-footer">Ver Todos <i
                        class="fad fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ App\Materia::get()->count() }}</h3>

                    <p>Materias Creadas</p>
                </div>
                <div class="icon">
                    <i class="fad fa-bookmark"></i>
                </div>
                <a href="{{ route('materias.index') }}" class="small-box-footer">Ver Todas <i
                        class="fad fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ App\User::get()->count() }}</h3>

                    <p>Usuarios Registrados</p>
                </div>
                <div class="icon">
                    <i class="fad fa-user"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">Ver todos <i
                        class="fad fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
      
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3>
                        {{$alumnos}}
                    </h3>
                    <p>Estudiantes Registrados Activos</p>
                </div>
                <div class="icon">
                    <i class="fad fa-user"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">Ver todos <i
                        class="fad fa-arrow-circle-right"></i></a>
            </div>
        </div>
      
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>  {{$docente}}</h3>

                    <p>Docentes Registrados Activos</p>
                </div>
                <div class="icon">
                    <i class="fad fa-user"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">Ver todos <i
                        class="fad fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

    </div>


</div>




@stop
@section('css')
@stop
@section('js')
@stop