@extends('layouts.nav')

@section('title', 'Editar Nivel')



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
                <h1 class="font-weight-light"> Paralelo</h1>
                <div class="row">
                    <div class="col-md-6">

                        <form method="POST" action="{{route('nivels.update', $nivel->id)}} ">
                            @method('PUT')
                            @csrf
                            <div class=" card-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre"
                                        value="{{$nivel->nombre}}" placeholder="Edición del Nivel" readonly>
                                </div>
                                <label for="nombre">Estado </label>
                                <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadoon" name="estado" class="custom-control-input"
                                        value="on" @if($nivel['estado']=="on" ) checked @elseif(old('estado')=="on" )
                                        checked @endif disabled>
                                    <label class="custom-control-label" for="estadoon">Activo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadooff" name="estado" class="custom-control-input"
                                        value="off" @if($nivel['estado']=="off" ) checked @elseif(old('estado')=="off" )
                                        checked @endif disabled>
                                    <label class="custom-control-label" for="estadooff">No Activo</label>
                                </div>
                                <br><br><br>
                                
                                <a href="{{url()->previous()}}" class="btn btn-primary">Regesar</a>
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