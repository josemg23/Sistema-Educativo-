<title>TABLA DE DOCENTES GENERALES</title>
<div class="container">
    <h5 style="text-align: center"><strong>TABLA DE DOCENTES GENERALES</strong></h5>
    <table id="myTable1" class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Unidad Educativa</th>
                <th scope="col">Docente</th>
                <th scope="col">Curso</th>
                <th scope="col">Paralelos</th>
                <th scope="col">Materia</th>
                <th scope="col">Ultimo Acceso</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doc as $do)
            <tr>
                <td>{{$do->instituto->nombre}}</td>
                <td>{{$do->user->name}} {{$do->user->apellido}}</td>
                <td>
                    @foreach($do->materia->distribucionmacus as $c)
                    {{$c->curso->nombre}}
                    @endforeach
                </td>
                <td class="text-center">
                    {{$do->materia->nombre}}
                </td>
                <td class="text-center">
                    @if($do->paralelos != null)
                    @foreach($do->paralelos as $dismacu)
                    <span class="badge badge-success">
                        {{$dismacu->nombre}}
                    </span>

                    @endforeach
                    @endif
                </td>
                <td> {{$do->user->created_at->diffForHumans()}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>