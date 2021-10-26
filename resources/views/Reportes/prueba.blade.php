<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>TABLA DE USUARIOS GENERALES</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    @page {
        margin: 0cm 0cm;
        font-size: 1em;
    }

    body {
        margin: 3cm 2cm 2cm;
    }

    header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;
        background-color: #46C66B;
        color: white;
        text-align: center;
        line-height: 30px;
    }

    footer {
        position: fixed;
        bottom: 0cm;
        left: 0cm;
        right: 0cm;
        height: 1cm;
        background-color: #46C66B;
        color: white;
        text-align: center;
        line-height: 35px;
    }
    </style>
</head>

<body>
    <header>
        <br>
        <p><strong>USUARIOS GENERALES</strong></p> 
    </header>
    <main>
        <div class="container">
            <h5 style="text-align: center"><strong>TABLA DE USUARIOS</strong></h5>
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Unidad Educativa</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Estado</th>
                      
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>

                        <td>{{$user->email}}</td>

                        <td>
                            @isset($user->instituto->nombre)
                            {{$user->instituto->nombre}}
                            @endisset
                        </td>

                        <td>
                            @foreach($user->roles as $role)
                            {{$role->name}}

                            @endforeach
                        </td>
                        <td>{{$user->estado}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
  
</body>

</html>