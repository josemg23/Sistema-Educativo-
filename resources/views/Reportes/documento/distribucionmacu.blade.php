<table id="myTable" class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Unidad Educativa</th>
                            <th scope="col">Curso</th>
                            <th scope="col">Materia</th>
                            <th scope="col">Unidad</th>
                            <th scope="col">Taller</th>
                            <th scope="col">Promedio</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dist as $dis)
                        @if($dis->materias != null)
                        @foreach($dis->materias as $ma)
                        @if($ma->contenidos != null)
                        @foreach($ma->contenidos as $contenido)
                        @if($contenido->tallers != null)
                        @foreach($contenido->tallers as $tl)
                        <tr>
                            <td>{{$dis->instituto->nombre}}</td>
                            <td>{{$dis->curso->nombre}}</td>
                            <td>{{$ma->nombre}}</td>
                            <td>{{$contenido->nombre}}</td>
                            <td>{{$tl->nombre}}</td>
                            <td>promedio</td>

                        </tr>
                        @endforeach
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                        @endif
                        @endforeach

                    </tbody>
                </table>
