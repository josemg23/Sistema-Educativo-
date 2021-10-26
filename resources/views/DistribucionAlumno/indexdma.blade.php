@extends('layouts.nav')


@section('title', 'Asignación')



@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<section class="content">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">

                <a class="btn btn-info float-right" href="{{route('distrimas.create')}}"><i class="fas fa-plus"></i>
                    CREAR ASIGNACION</a>
                    <h1 class="font-weight-light">Asignación de Alumno/Curso</h1>
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
                                    <th scope="col">Unidad Educativa</th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Paralelo</th>
                                    <th scope="col">Materias</th>
                                    <th scope="col">Alumno</th>
                                    <th scope="col">Estado</th>
                                    <th></th>
                                    <th scope="col">Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($distrimas as $distrima)
                                <tr>

                                    <th scope="row">{{$distrima['id']}}</th>
                                    <td>{{$distrima->instituto->nombre}} </td>


                                    <td>
                                        @if($distrima->distribucionmacu->curso->nombre != null)
                                        <span class="badge badge-success">
                                            {{$distrima->distribucionmacu->curso->nombre}}
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($distrima->nivel->nombre != null)
                                        <span class="badge badge-success">
                                            {{$distrima->nivel->nombre}}
                                        </span>
                                        @endif
                                    </td>

                                    <td>

                                        @foreach($distrima->distribucionmacu->materias as $mat)
                                        <span class="badge badge-success">
                                            {{ $mat->nombre}}
                                        </span>
                                        @endforeach


                                    </td>


                                    <td>
                                        @if($distrima->user != null)

                                        {{$distrima->user->name}}

                                        @endif
                                    </td>


                                    <td>{{ $distrima['estado']}}</td>

                                    <td> </td>


                                    <td class="table-button ">
                                        <a class="btn btn-info " href="{{route('distrimas.show',$distrima->id)}}"><i
                                                class="fas fa-eye"></i></a>

                                    </td>
                                    <td class="table-button ">
                                        <a class="btn btn-success btn"
                                            href="{{route('distrimas.edit', $distrima->id)}}"><i
                                                class=" fas fa-pencil-alt"></i></a>
                                    </td>
                                    <td class="table-button ">
                                        <!--metodo delete funciona pero hay que almacenar la variable array en una variable temporal-->
                                        <form method="POST" action="{{route('distrimas.destroy', $distrima->id)}}}">
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
                        {{$distrimas->links()}}
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