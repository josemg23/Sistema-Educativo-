@extends('layouts.nav')

@section('title', 'Editar')



@section('content')


<section class="content" id="mate">
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="font-weight-light text-center"> Asignación Docente/Materia</h1>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                    
                            <div class="form-group">
                                <label>Unidad Educativa</label>
                                <select class="form-control select" name="instituto" disabled style="width: 99%;">

                                    <option value="{{$instituto->id}}">{{$instituto->nombre}}</option>


                                </select>
                            </div>

                            <div class="form-group">
                                <label>Docente</label>
                                <select class="form-control select" name="user" disabled style="width: 99%;">

                                    <option selected disabled value="{{ $user->id }}">
                                        {{ $user->name }} {{ $user->apellido }}
                                    </option>


                                </select>
                            </div>
                               <div class="form-group">
                                <label>Materia</label>
                                <select class="form-control select" name="user" disabled style="width: 99%;">
                                    <option selected disabled value="">
                                        {{ $materia->nombre }} 
                                    </option>


                                </select>
                            </div>

                            <div class="form-group">
                                <label>Paralelos Asignados</label>
                                <select class="select2" :materias="2" multiple="multiple" name="materia[]"
                                    data-placeholder="Select a State" disabled style="width: 100%;">
                                    @foreach($paralelos as $paralelo)
                                    <option selected value="{{$paralelo->id}}">{{$paralelo->nombre}}</option>
                                    @endforeach
                                  

                                </select>
                            </div>

                            <label for="nombre">Estado</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadoon" name="estado" class="custom-control-input"
                                        value="on" @if($distribuciondo['estado']=="on" ) checked
                                        @elseif(old('estado')=="on" ) checked @endif disabled>
                                    <label class="custom-control-label" for="estadoon">Activo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="estadooff" name="estado" class="custom-control-input"
                                        value="off" @if($distribuciondo['estado']=="off" ) checked
                                        @elseif(old('estado')=="off" ) checked @endif disabled>
                                    <label class="custom-control-label" for="estadooff">No Activo</label>
                                </div>
                                <br><br><br>
                                <a href="{{route('distribuciondos.index')}}" class="btn btn-primary">Atras</a>
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
$(function() {
    //Initialize Select2 Elements
    $(".select2").select2({

    });

})
</script>



@stop