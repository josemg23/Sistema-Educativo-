@extends('layouts.nav')

@section('title', 'Edicion de Roles|SmartMoodle')



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
                <h1 class="font-weight-light">Editar Roles </h1>
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-8">
                        <!-- general form elements -->


                        <form method="POST" action="{{route('roles.update', $role->id)}}">
                            @method('PUT')
                            @csrf
                            <div class=" card-body">
                                <div class="form-group">
                                    <label for="name">Rol Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Rol Name"
                                        value="{{$role->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Rol descripcion</label>
                                    <input type="text" class="form-control" name="descripcion" id="descripcion"
                                        placeholder="Rol descripcion" value="{{$role->descripcion}}">
                                </div>

                                <div class="form-group">
                                    <label for="name"> Acceso Completo</label>
                                    <br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="fullaccessyes" name="full-access"
                                            class="custom-control-input" value="yes" @if ( $role['full-access']=="yes" )
                                            checked @elseif (old('full-access')=="yes" ) checked @endif>
                                        <label class="custom-control-label" for="fullaccessyes">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="fullaccessno" name="full-access"
                                            class="custom-control-input" value="no" @if ( $role['full-access']=="no" )
                                            checked @elseif (old('full-access')=="no" ) checked @endif>
                                        <label class="custom-control-label" for="fullaccessno">No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Estado </label>
                                    <br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="estadoon" name="estado" class="custom-control-input"
                                            value="on" @if($role['estado']=="on" ) checked @elseif(old('estado')=="on" )
                                            checked @endif>
                                        <label class="custom-control-label" for="estadoon">Activo</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="estadooff" name="estado" class="custom-control-input"
                                            value="off" @if($role['estado']=="off" ) checked
                                            @elseif(old('estado')=="off" ) checked @endif>
                                        <label class="custom-control-label" for="estadooff">No Activo</label>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <label for="name"> Lista de Menu</label>
                                    @foreach($permissions as $permission)

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                            id="permission_{{$permission->id}}" value="{{$permission->id}}"
                                            name="permission[]" @if(is_array(old('permission')) &&
                                            in_array("$permission->id",old('permission')))
                                        checked
                                        @elseif(is_array($permission_role)
                                        && in_array("$permission->id",$permission_role))
                                        checked
                                        @endif
                                        >

                                        <label class="custom-control-label" for="permission_{{$permission->id}}">
                                            {{$permission->id}}
                                            -
                                            {{$permission->namep}}
                                            <em>({{$permission->descripcionp}})</em>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <a href="{{route('roles.index')}}"  class="btn btn-primary">Atras</a>
                                <input type="submit" class="btn btn-dark " value="Guardar">
                                
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
console.log('Hi!');
</script>

<script>
$(document).ready(function() {

    $('#name').keyup(function(e) {
        var str = $('#name').val();
        str = str.replace(/\W+(?!$)/g, '-').toLowerCase(); // remplazamos el estdo de dashe
        $('#descripcion').val(str);
        $('descripcion').attr('placeholder', str);
    });

});
</script>
@stop