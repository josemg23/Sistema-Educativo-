<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>TABLA DE DOCENTES GENERALES</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
</head>

<body>
   
    <main>
        <div class="container">
            <h5 style="text-align: center"><strong>TABLA DE DOCENTES GENERALES</strong></h5>
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Unidad Educativa</th>
                        <th scope="col">Docente</th>
                        <th scope="col">Materia(s)</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($docs as $dis)
                    <tr>

                        <th scope="row">{{$dis['id']}}</th>
                        <td>{{$dis->instituto->nombre}} </td>
                        <td>
                            {{$dis->user->name}}
                            {{$dis->user->apellido}}
                        </td>
                        <td>
                            @if($dis->materias != null)
                            @foreach($dis->materias as $dismacu)
                            <span class="badge badge-success">
                                {{$dismacu->nombre}}
                            </span>

                            @endforeach
                            @endif
                        </td>
                        <td>{{ $dis['estado']}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
    <!-- <footer>
        <p><strong>PRUEBA PDF</strong></p>
    </footer> -->
</body>

</html>