<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bienvenido</title>

    <!-- Bootstrap core CSS -->
    <link href="../principal/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i"
        rel="stylesheet">
    <link href="../principal/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    <!-- Custom styles for this template -->
    <link href="../principal/css/coming-soon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/app.css">

</head>

<body>

    <div class="overlay"></div>
    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
        <source src="/principal/mp4/bg.mp4" type="video/mp4">
    </video>

    <div class="masthead">
        <div class="masthead-bg"></div>
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 my-auto">
                    <div class="masthead-content text-white py-5 py-md-0">
                        <h1 class="brand-text font-weight-light">Bienvenido!</h1>
                        <p class="mb-5">
                            Bienvenido al nuevo proyecto en curso!!!
                        </p>
                        <a class="btn btn-block btn-outline-primary" href="{{ route('login') }}" role="submit"> {{ __('Login') }}</a>
                        <!-- <a  class="btn btn-block btn-outline-primary"href="{{ route('register') }}" type="submit"> {{ __('Registrar') }}</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- Bootstrap core JavaScript -->
    <script src="../principal/vendor/jquery/jquery.min.js"></script>
    <script src="../principal/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="../principal/js/coming-soon.min.js"></script>


</body>

</html>