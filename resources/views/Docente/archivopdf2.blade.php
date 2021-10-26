{{-- @extends('layouts.docapp') --}}

@extends('layouts.nav')
@section('title', 'Unidades | SmartMoodle')

@section('content')

<section class="content">
    <div class="container">
        <h1 class="font-weight-light">Visualización de Documento|Descargable</h1>
        <h3 class="font-weight-light">{{$contenido->nombre}}</h3>

        <p class="text-center">
        @isset ($contenido->archivo->url)
            <object width="100%" height="650" type="application/pdf"
                data="{{$contenido->archivo->url}}#zoom=85&scrollbar=1&toolbar=1&navpanes=1" id="pdf_content"
                style="pointer-events: none;">
                <p>Insert your error message here, if the PDF cannot be displayed.</p>
            </object>
            @endisset

            <!-- <iframe class="embed-responsive-item" width="800" height="700" src="{{$contenido->archivo->url}}"
                allowfullscreen></iframe> -->



        </p>

    </div>
</section>

@stop
@section('css')
@stop
@section('js')
@stop