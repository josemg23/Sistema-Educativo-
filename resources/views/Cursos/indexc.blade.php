@extends('layouts.nav')

@section('title', 'Curso')

@section('encabezado')


@stop

@section('content')



<section class="content">
    <div class="container">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="row justify-content-center">
            <!-- left column -->
            <div class="col-md-13">
                <a class="btn btn-info float-right " href="{{route('cursos.create')}}"><i class="fas fa-plus"></i>
                    CURSO</a>
                <h1>Cursos</h1>
                <div class="card card-secondary">
                    <div class="card-header">

                        <div class="card-tools">
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Curso</th> 
                                    <th scope="col">Estado</th>
                                    <th></th>
                                    <th></th>
                                    <th scope="col">Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                    @foreach ($cursos as $curso)
                                     <tr>
                                    <th scope="row">{{ $curso['id']}}</th>
                                    <td>{{ $curso['nombre']}}</td>
                                    <td>{{ $curso['estado']}}</td>
                                    <td></td>
                                    <td class="table-button ">
                                        <a class="btn btn-info " href="{{route('cursos.show', $curso->id)}}"><i
                                                class="fas fa-eye"></i></a>

                                    </td>
                                    <td class="table-button ">
                                        <a class="btn btn-success " href="{{route('cursos.edit', $curso->id)}}"><i
                                                class=" fas fa-pencil-alt"></i></a>
                                    </td>
                                    <td class="table-button ">
                                        <!--metodo delete funciona pero hay que almacenar la variable array en una variable temporal-->
                                        <form method="POST" action="{{route('cursos.destroy', $curso->id)}}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger "><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <!--Table body-->

                        </table>
                        {{$cursos->links()}}
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

@stop