<table id="myTable2" class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Unidad Educativa</th>
            <th scope="col">Estudiante</th>
            <th scope="col">Curso</th>
            <th scope="col">Paralelo</th>
            <th scope="col">Materia</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($est as $es)
        @if($es->materias != null)
        @foreach($es->materias as $ma)
        @if($ma->distribucionmacus != null)
        @foreach($ma->distribucionmacus as $cur)
        <tr>
            <td>{{$es->instituto->nombre}}</td>
            <td>{{$es->user->name}} {{$es->user->apellido}}</td>
            <td>{{$cur->curso->nombre}}</td>
            <td>{{$es->user->nivel->nombre}}</td>
            <td>{{$ma->nombre}}</td>
        </tr>
        @endforeach
        @endif
        @endforeach
        @endif
        @endforeach
    </tbody>
</table>