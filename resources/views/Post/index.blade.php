@extends('layouts.nav')

@section('title', 'Unidad Educativa')



@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<section class="content">
    <div class="container">

        <a class="btn btn-info float-right" href="{{route('posts.create')}}"><i class="fas fa-plus"></i>
            Crear</a>
        <h1 class="font-weight-light">Gestión de Publicaciones</h1>

        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card-body">
                    <table id="myTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Unidad Educativa</th>
                                <th scope="col">Nombre</th>
                                <th scope="col" width="350">Resumen</th>
                                <th scope="col" class="text-center">Tools</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($posts as $post)
                            <tr>
                                <th scope="row">{{$post['id']}}</th>
                                <td>
                                @isset($post->instituto->nombre)
                                {{$post->instituto->nombre}} 
                                @endisset
                                </td>
                                <td>{{$post->nombre}} </td>
                                <td>{{$post->abstract}} </td>
                                <td class="table-button ">
                                    <!--metodo delete funciona pero hay que almacenar la variable array en una variable temporal-->
                                    <form method="POST" action="{{route('posts.destroy', $post->id)}}}">
                                        @method('DELETE')
                                        @csrf

                                        <a class="btn btn-info btn-sm" href="{{route('posts.show',$post->id)}}"><i
                                                class="fas fa-eye"></i></a>
                                        <a class="btn btn-success btn-sm" href="{{route('posts.edit', $post->id)}}"><i
                                                class=" fas fa-pencil-alt"></i></a>

                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                                </th>
                                @endforeach

                        </tbody>
                        <!--Table body-->
                    </table>
                    <!--Table-->
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
    $(document).ready(function() {
        $('#myTable').DataTable({
                "info": false,
                "autoWidth": true,

                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            }

        );
    });

});
</script>


@stop