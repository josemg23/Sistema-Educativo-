@extends('layouts.nav')

@section('title', 'Menú')
@section('content')

<section class="content">
    <div class="container">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-13">
                    <a class="btn btn-info float-right" href="{{route('permissions.create')}}"><i
                            class="fas fa-plus"></i> MENÚ</a>
                    <h1>Permisos de Acceso </h1>
                  
                       
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="myTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Detalle</th>
                                        <th scope="col">Estado</th>
                                        <th></th>          
                                        <th></th>
                                    
                                        <th width="80px">&nbsp;</th>


                                    </tr>
                                </thead>
                                <tbody>
                                   
                                        @foreach ($permissions as $permiso)
                                         <tr>
                                        <th scope="row">{{ $permiso['id']}}</th>
                                        <td>{{ $permiso['namep']}}</td>
                                        <td>{{ $permiso['slug']}}</td>
                                        <td>{{ $permiso['descripcionp']}}</td>
                                        
                                        <td>{{ $permiso['estado']}}</td>
                                      

                                        <td class="table-button ">
                                            <a class="btn btn-info"
                                                href="{{route('permissions.show', $permiso->id)}}"><i
                                                    class="fas fa-eye"></i></a>

                                        </td>
                                        <td class="table-button ">
                                            <a class="btn btn-success "
                                                href="{{route('permissions.edit',$permiso->id)}}"><i
                                                    class=" fas fa-pencil-alt"></i></a>
                                        </td>
                                        <td class="table-button ">
                                            <!--metodo delete funciona pero hay que almacenar la variable array en una variable temporal-->
                                            <form method="POST"
                                                action="{{route('permissions.destroy', $permiso->id)}}}">
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
                "info": true,
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