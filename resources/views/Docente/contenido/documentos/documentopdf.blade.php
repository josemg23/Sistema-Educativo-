{{-- @extends('layouts.docapp') --}}

@extends('layouts.nav')
@section('title', 'Unidades | SmartMoodle')

@section('content')

<section class="content">
    <div class="container">
        <h1 class="font-weight-light">Visualización de Documento</h1>
        <h3 class="font-weight-light">{{$contenido->nombre}}</h3>

        <p class="text-center">
            @isset ($contenido->documentodoc->url)
            <iframe class="embed-responsive-item" width="800" height="700" src="{{$contenido->documentodoc->url}}"
                allowfullscreen></iframe>
            @endisset

        </p>

    </div>
</section>

@stop
@section('css')
@stop
@section('js')
@stop