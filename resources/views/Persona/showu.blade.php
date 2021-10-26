@extends('layouts.nav')

@section('title', 'Editar Usuario')

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

<section class="content">
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="font-weight-light"> Usuario</h1>
                <div class="row">
                    <div class="col-md-10">

                        <form method="POST" action="{{route('users.update', $user->id)}} ">
                            @method('PUT')
                            @csrf

                            <div class=" card-body">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="cedula">Cédula</label>
                                        <input class="form-control" name="cedula" id="cedula" placeholder="Cédula"
                                            value="{{$user->cedula}}" readonly>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="name"> Nombres</label>
                                        <input class="form-control" name="name" id="name" placeholder="Primer Nombre"
                                            value="{{$user->name}}" readonly>
                                    </div>

                                    <div class="col">
                                        <label for="apellido">Apellidos</label>
                                        <input class="form-control" name="apellido" id="apellido"
                                            placeholder="Primer Apellido" value="{{$user->apellido}}" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="domicilio">Domicilio</label>
                                    <input class="form-control" name="domicilio" id="domicilio" placeholder="Domicilio"
                                        value="{{$user->domicilio}}" readonly>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="telefono">Teléfono Fijo</label>
                                        <input class="form-control" name="telefono" id="telefono" placeholder="Télefono"
                                            value="{{$user->telefono}}" readonly>
                                    </div>
                                    <div class="col">
                                        <label for="celular">Teléfono</label>
                                        <input class="form-control" name="celular" id="celular" placeholder="Celular"
                                            value="{{$user->celular}}" readonly>
                                    </div>
                                </div>

                                <br>
                                @foreach($roluser as $role)
                                @if($role['descripcion']=='estudiante')
                                <div class="form-group">
                                    <label>Instituto</label>
                                    <select class="form-control select" name="instituto" style="width: 99%;" disabled>
                                        @foreach($institutouser as $instuser)
                                        <option selected disabled value="{{ $instuser->id }}">
                                            {{ $instuser->nombre }}
                                        </option>
                                        @endforeach
                                        @foreach($institutos as $instituto)
                                        <option value="{{$instituto->id}}">{{$instituto->nombre}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                @elseif($role['descripcion']=='docente')
                                <div class="form-group">
                                    <label>Instituto</label>
                                    <select class="form-control select" name="instituto" style="width: 99%;" disabled>
                                        @foreach($institutouser as $instuser)
                                        <option selected disabled value="{{ $instuser->id }}">
                                            {{ $instuser->nombre }}
                                        </option>
                                        @endforeach
                                        @foreach($institutos as $instituto)
                                        <option value="{{$instituto->id}}">{{$instituto->nombre}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                @endif
                                @endforeach

                                <div class="form-group">
                                    <label>Rol</label>
                                    <select class="form-control" name="roles" id="roles" disabled>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @isset($user->roles[0]->name)
                                            @if($role->name == $user->roles[0]->name)
                                            selected
                                            @endif
                                            @endisset
                                            >{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" name="email" id="email" placeholder="Email"
                                        value="{{$user->email}}" readonly>
                                </div>


                                <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadoon" name="estado" class="custom-control-input"
                                        value="on" @if($user['estado']=="on" ) checked @elseif(old('estado')=="on" )
                                        checked @endif disabled>
                                    <label class="custom-control-label" for="estadoon">Activo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadooff" name="estado" class="custom-control-input"
                                        value="off" @if($user['estado']=="off" ) checked @elseif(old('estado')=="off" )
                                        checked @endif disabled>
                                    <label class="custom-control-label" for="estadooff">No Activo</label>
                                </div>
                                <br><br>


                                @foreach($roluser as $role)
                                @if($role['descripcion']=='estudiante')
                                <hr>
                                <h4 class="font-weight-light">Sección Estudiante</h4>
                                <div class="form-group">
                                    <label> Curso</label>
                                    <select class="form-control select" name="curso" style="width: 99%;" disabled>
                                        {{-- @foreach($cursouser as $cuser) --}}
                                        <option selected disabled value="{{ $curso->id }}">
                                            {{ $curso->nombre }}
                                        </option>
                                       {{--  @endforeach --}}
                                     {{--    @foreach($cursos as $curso)
                                        <option value="{{$curso->id}}">{{$curso->nombre}}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Paralelo</label>
                                    <select class="form-control select" name="paralelo" style="width: 99%;" disabled>
                                        @foreach($niveluser as $nvuser)
                                        <option selected disabled value="{{ $nvuser->id }}">
                                            {{ $nvuser->nombre }}
                                        </option>
                                        @endforeach
                                        @foreach($nivels as $nivel)
                                        <option value="{{$nivel->id}}">{{$nivel->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                                @endforeach
                                <br><br>
                                <a href="{{route('users.index')}}" class="btn btn-primary">Atras</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>

@stop

@section('css')

@stop

@section('js')
<script>
console.log('Hi!');
</script>
@stop