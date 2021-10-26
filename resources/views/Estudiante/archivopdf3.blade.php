{{-- @extends('layouts.estapp') --}}
@extends('layouts.nav')
@section('title', 'Unidades | SmartMoodle')

@section('content')

<section class="content">
    <div class="container">
        <h1 class="font-weight-light">Visualización de Documento|Descargable</h1>
        <h3 class="font-weight-light">{{$contenido->nombre}}</h3>


        @isset ($contenido->archivo->url)
        <iframe class="embed-responsive-item" width="800" height="700" src="{{$contenido->archivo->url}}"
            allowfullscreen></iframe>
        @endisset


      





    </div>
</section>

@stop
@section('css')
@stop
@section('js')
@stop