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

<section class="content" id="role">
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="font-weight-light">Editar Usuario</h1>
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
                                            value="{{$user->cedula}}" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="name"> Nombres</label>
                                        <input class="form-control" name="name" id="name" placeholder="Primer Nombre"
                                            value="{{$user->name}}" required>
                                    </div>

                                    <div class="col">
                                        <label for="apellido">Apellidos</label>
                                        <input class="form-control" name="apellido" id="apellido"
                                            placeholder="Primer Apellido" value="{{$user->apellido}}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="domicilio">Domicilio</label>
                                    <input class="form-control" name="domicilio" id="domicilio" placeholder="Domicilio"
                                        value="{{$user->domicilio}}" required>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="telefono">Teléfono Fijo</label>
                                        <input class="form-control" name="telefono" id="telefono" placeholder="Télefono"
                                            value="{{$user->telefono}}" required>
                                    </div>
                                    <div class="col">
                                        <label for="celular">Teléfono</label>
                                        <input class="form-control" name="celular" id="celular" placeholder="Celular"
                                            value="{{$user->celular}}" required>
                                    </div>
                                </div>

                                <br>
                                @foreach($roluser as $role)
                                @if($role['descripcion']== 'estudiante' or 'docente')
                                <div class="form-group">
                                    <label>Instituto</label>
                                    <select class="form-control select" v-model="instituto" name="instituto"  style="width: 99%;" @change="getDistrubucion">
                                        <option selected :value="{{ $institutouser->id }}">
                                            {{ $institutouser->nombre }}
                                        </option>
                                       
                                        @foreach($institutos as $instituto)
                                        <option value="{{$instituto->id}}">{{$instituto->nombre}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                @endif
                                @endforeach

                                <div class="form-group">
                                    <label>Rol</label>
                                    <select class="form-control" name="roles" id="roles">
                                    <option value="{{ $rol['id']}}" selected>{{$rol['name']}}</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}" 
                                            >{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" name="email" id="email" placeholder="Email"
                                        value="{{$user->email}}">
                                </div>


                                <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadoon" name="estado" class="custom-control-input"
                                        value="on" @if($user['estado']=="on" ) checked @elseif(old('estado')=="on" )
                                        checked @endif>
                                    <label class="custom-control-label" for="estadoon">Activo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadooff" name="estado" class="custom-control-input"
                                        value="off" @if($user['estado']=="off" ) checked @elseif(old('estado')=="off" )
                                        checked @endif>
                                    <label class="custom-control-label" for="estadooff">No Activo</label>
                                </div>
                                <br><br>


                           
                               
<div class=" estudiante" v-if="estudiante">
                                <hr>
                                <h3 class="font-weight-light">Sección Estudiante</h3>
                                <div class="form-group">
                                    <label>Actualizar Curso</label>
                                    <select class="form-control select" name="curso" style="width: 99%;">
                            
                                        <option v-for="(curso, index) in cursos" :selected="index == 0" :value="curso.id">
                                            @{{ curso.curso }}
                                        </option>
                                
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Actualizar Paralelo</label>
                                    <select class="form-control select" name="paralelo" style="width: 99%;">

                                        @foreach($niveluser as $nvuser)

                                        <option selected  value="{{ $nvuser->id }}">
                                            {{ $nvuser->nombre }}
                                        </option>

                                        @endforeach

                                        @foreach($nivels as $nivel)
                                        <option value="{{$nivel->id}}">{{$nivel->nombre}}</option>
                                        @endforeach

                                    </select>
                                </div>

                             
                            </div>
                          

                                <br><br>
                                <a href="{{route('users.index')}}" class="btn btn-primary">Atras</a>
                                <input type="submit" class="btn btn-dark " value="Actualizar">
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
    let curso = @json($curso);

    let cursos = @json($asignacion);
    let rol = @json($rol);
    let instituto = @json($institutouser->id);
const random = new Vue({
    el: "#role",
    data: {
        password: '',
        curso:  curso,
        cursos:  cursos,
        asignaciones:[],
        instituto:instituto,
        estudiante: false,
        role: '', //para la vista
    },
    mounted: function(){
        if (rol.id == 2) {
            this.estudiante = true;
            let c = {id:curso.id ,curso:curso.nombre}
        this.cursos.unshift(c);
        }
        
     

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
                set.cursos = response.data;
                console.log(set.cursos);
            }).catch(e => {
                console.log(e);
            });
        }
    }
});

$(function() {
    $(document).ready(function() {
$("#roles").on("change",function(){
    let role = $("#roles").val(); 
    console.log(role) 
if (role == 2) {
    random.estudiante = true;
}else if(role == 3 || 1){
    random.estudiante = false;
}
    });
});
});


</script>

@stop