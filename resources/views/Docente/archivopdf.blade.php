{{-- @extends('layouts.docapp') --}}

@extends('layouts.nav')
@section('title', 'Unidades | SmartMoodle')

@section('content')

<section class="content">
    <div class="container">
        <h1 class="font-weight-light">Visualización de Documento|No Descargable</h1>
        <h3 class="font-weight-light">{{$contenido->nombre}}</h3>


        <div class="contenedor">
            <div class="pdf">
            @isset($contenido->archivo->url)
                <object data="{{$contenido->archivo->url}}#zoom=85&scrollbar=1&toolbar=0&navpanes=0"
                    type="application/PDF" width="850px" height="850px" align="right"></object>
            @endisset
            </div>
            <div class="bloqueo">
            </div>
        </div>

    </div>
</section>

@stop
@section('css')

<style>
.contenedor {
    position: absolute;
}

.pdf {
    position: relative;
}

.bloqueo {
    position: relative;
    background-color: rgba(255, 255, 255, 0.00);
    width: 830px;
    height: 850px;
}
</style>

@stop
@section('js')
@stop