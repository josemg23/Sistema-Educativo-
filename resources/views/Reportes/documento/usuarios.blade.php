<table id="myTable3" class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Unidad Educativa</th>
            <th scope="col">Nombre/Apellido</th>
            <th scope="col">Rol</th>
            <th scope="col">Ultimo Acceso</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>
                @isset($user->instituto->nombre)
                {{$user->instituto->nombre}}
                @endisset
            </td>
            <td>{{$user->name}} {{$user->apellido}}</td>
            <td>
                @foreach($user->roles as $role)
                <span class="badge badge-primary"> {{$role->name}}
                </span>
                @endforeach
            </td>
            <td> {{$user->created_at->diffForHumans()}}</td>
        </tr>

        @endforeach
    </tbody>
</table>