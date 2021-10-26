@extends('layouts.nav')

@section('title', 'Editar Menú')



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
                <h1 class="font-weight-light"> Permiso de Acceso </h1>
                <div class="row">
                    <div class="col-md-8">
                        <form method="POST" action="{{route('permissions.update', $permission->id)}}">
                            @method('PUT')
                            @csrf

                            <div class=" card-body">
                                <div class="form-group">
                                    <label for="namep"> Nombre del Menu</label>
                                    <input type="text" class="form-control" value="{{$permission->namep}}" name="namep"
                                        id="namep" placeholder="Menu" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug del Menú</label>
                                    <input type="text" class="form-control" name="slug" tag="slug" id="slug"
                                        placeholder="Slug" value="{{$permission->slug}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="descripcionp"> descripcionp</label>
                                    <input type="text" class="form-control" value="{{$permission->descripcionp}}"
                                        name="descripcionp" tag="descripcionp" id="descripcionp"
                                        placeholder="Descripción" readonly>
                                </div>

                                <label for="nombre">Estado </label>
                                <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadoon" name="estado" class="custom-control-input"
                                        value="on" @if($permission['estado']=="on" ) checked @elseif(old('estado')=="on"
                                        ) checked @endif disabled>
                                    <label class="custom-control-label" for="estadoon">Activo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadooff" name="estado" class="custom-control-input"
                                        value="off" @if($permission['estado']=="off" ) checked
                                        @elseif(old('estado')=="off" ) checked @endif disabled>
                                    <label class="custom-control-label" for="estadooff">No Activo</label>
                                </div>
                                <br><br>
                                <a href="{{route('permissions.index')}}"  class="btn btn-primary">Atras</a>
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


<script>
$(document).ready(function() {

    $('#namep').keyup(function(e) {
        var str = $('#namep').val();
        str = str.replace(/\W+(?!$)/g, '.')
            .toLowerCase(); // remplazamos el estdo de dashe el punto se lo puede cambiar
        $('#slug').val(str);
        $('slug').attr('placeholder', str);
    });

});
</script>

@stop