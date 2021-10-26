@extends('layouts.nav')

@section('title', 'Post | SmartMoodle')



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
                <h1 class="font-weight-bold text-danger text-center">CREAR PUBLICACION</h1>

                <div class="row">
                    <div class="col-md-12">

                        {!! Form::open(['route'=>'storepostd', 'method'=>'POST','files' => true]) !!}
                        <div class="card-body ">
                            @include('Post.form.form')

                            <div class="form-group" id="dd">
                                <label for="materia">Seleccionar Materia</label>
                                <select class="form-control select2" name="materia" style="width: 99%;"
                                    @change="onMateria()">
                                    <option selected disabled>Elija la Materia...</option>
                                    @foreach($materias as $a)
                                    <option value="{{$a->materia_id}}">
                                        {{$a->nombre_curso}}-{{$a->nombre_materia}}</option>
                                    @endforeach
                                </select>

                                <label>Seleccione el Paralelos</label>
                                <select class="paralelos form-control" name="paralelos"
                                    data-placeholder="Selecciona los paralelo" style="width: 100%;">
                                    <option v-for="paralelo in paralelos" :value="paralelo.id">@{{ paralelo.nombre}}
                                    </option>
                                </select>
                            </div>

                        </div>


                        <a href="{{ url('/sistema/homedoc') }}" class="btn btn-primary">Atras</a>
                        <input type="submit" class="btn btn-dark " value="Guardar">
                        {!! Form::close() !!}
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
<script type="text/javascript" src="{{asset('plugins/customfileinputs/js/custom-file-input.js')}}"></script>

{!! Html::script('vendor/ckeditor/ckeditor.js') !!}
<script>
CKEDITOR.replace('body');
$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>


<script>
const inst = new Vue({
    el: '#dd',
    data: {
        materia: '',
        paralelos: [],
    },

    methods: {
        onMateria(id) {

            var set = this;
            set.paralelos = [];
            axios.post('/sistema/buscarparalelo', {
                id: id,
            }).then(response => {
                set.paralelos = response.data;
                console.log(set.paralelos);
            }).catch(e => {
                console.log(e);
            });
        }
    },

});
</script>

<script>
$(function() {
    var $eventSelect = $(".select2");

    $eventSelect.select2();
    $eventSelect.on("select2:select", function(e) {
        var select_val = $(e.currentTarget).val();

        inst.onMateria(select_val);
    });

})
</script>


@stop