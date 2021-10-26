@extends('layouts.nav')

@section('title', 'Crear Usuario')


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

<section class="content" id="role">
    <div class="container">
        <div class="card border-0 shadow my-5">

            <div class="card-body p-5">

                <h1 class="font-weight-light">Añadir Usuarios</h1>

                <div class="row">
                    <div class="col-md-10">

                        <form method="POST" action="{{route('users.store')}} ">
                            @csrf
                            <div class=" card-body">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="cedula">Cédula</label>
                                        <input type="text" class="form-control" value="{{ old('cedula') }}"
                                            name="cedula" id="cedula" placeholder="Cédula">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="name"> Nombres</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ old('name') }}" placeholder="Nombres">
                                    </div>

                                    <div class="col">
                                        <label for="apellido">Apellidos</label>
                                        <input type="text" class="form-control" name="apellido" id="apellido"
                                            value="{{ old('apellido') }}" placeholder=" Apellidos">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="domicilio">Domicilio</label>
                                    <input type="text" class="form-control" name="domicilio" id="domicilio"
                                        value="{{ old('domicilio') }}" placeholder="Domicilio">
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="telefono">Teléfono Fijo</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono"
                                            value="{{ old('telefono') }}" placeholder="Télefono">
                                    </div>
                                    <div class="col">
                                        <label for="celular">Teléfono</label>
                                        <input type="text" class="form-control" name="celular" id="celular"
                                            value="{{ old('celular') }}" placeholder="Teléfono">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Rol</label>
                                    <select class="form-control select" name="role" v-model="role" style="width: 99%;">
                                        <option selected disabled>Elija un rol para el Usuario...
                                        </option>
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <!-- prueba -->
                                <template v-if="role =='3'">
                                    <div>
                                        <div class="form-group">
                                            <label>Instituto</label>
                                            <select class="form-control select" name="instituto" style="width: 99%;">
                                                <option selected disabled>Elija una Unidad educativa...</option>
                                                @foreach($institutos as $instituto)
                                                <option value="{{$instituto->id}}">{{$instituto->nombre}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </template>

                                <template v-if="role =='2'">
                                    <div class="form-group">
                                        <label>Instituto</label>
                                        <select class="form-control select" v-model="instituto"  name="instituto" style="width: 99%;" @change="getDistrubucion">
                                            <option selected disabled>Elija una Unidad educativa...</option>
                                            @foreach($institutos as $instituto)
                                            <option value="{{$instituto->id}}">{{$instituto->nombre}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <hr>
                                    <h4 class="font-weight-light">Sección Estudiante</h4>
                                    <div class="form-group">

                                        <label>Curso</label>
                                        <select class="form-control select" name="curso" style="width: 99%;">
                                            <option selected disabled>Elija el Curso...</option>
                                            <option v-for="(asignacion, index) in asignaciones" :value="asignacion.id">@{{asignacion.curso}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Paralelo</label>
                                        <select class="form-control select" name="paralelo" style="width: 99%;">
                                            <option selected disabled>Elija el Paralelo...</option>
                                            @foreach($nivels as $nivel)
                                            <option value="{{$nivel->id}}">{{$nivel->nombre}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <hr>
                                </template>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="email">Correo Electrónico</label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            value="{{ old('email') }}" placeholder="Email">
                                    </div>

                                    <div class="col" id="random">

                                        <label for="password">Contraseña</label>
                                        <input type="password" v-model="password" id="result" class="form-control"
                                            name="password" id="password" value="{{ old('password') }}"
                                            placeholder="Password" minlength="8">
                                        <a href="" class="btn btn-sm btn-primary mt-2"
                                            @click.prevent="generarPass">Generar Aleatoria</a>
                                    </div>

                                    <div class="cold">
                                        <br>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="name"> Estado</label>
                                    <br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="estadoon" name="estado" class="custom-control-input"
                                            value="on" @if(old('estado')=="on" ) checked @endif
                                            @if(old('estado')===null) checked @endif>
                                        <label class="custom-control-label" for="estadoon">Activo</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="estadooff" name="estado" class="custom-control-input"
                                            value="off" @if(old('estado')=="off" ) checked @endif>
                                        <label class="custom-control-label" for="estadooff">No Activo</label>
                                    </div>
                                </div>


                                <a href="{{route('users.index')}}" class="btn btn-primary">Atras</a>
                                <input type="submit" class="btn btn-dark " value="Guardar">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@stop

@section('css')

@stop

@section('js')
<script type="text/javascript">
var random = new Vue({
    el: "#role",
    data: {
        password: '',
        asignaciones:[],
        instituto:'',
        role: '', //para la vista
    },

    methods: {
        generarPass: function() {
            var _this = this;
            var url = '/sistema/admin/ramdom';
            axios.post(url, {

            }).then(response => {
                toastr.success("Clave Generada Satisfactoriamente", "Smarmoddle", {
                    "timeOut": "3000"
                });
                _this.password = response.data;
            }).catch(function(error) {

            });

        },
               getDistrubucion(){
            let set = this;
            set.asignaciones = [];
            axios.post('/sistema/asignaciones', {
                id: set.instituto
            }).then(response => {
                set.asignaciones = response.data;
                console.log(set.asignaciones);
            }).catch(e => {
                console.log(e);
            });
        }



    }


})
</script>


<script>


</script>

@stop