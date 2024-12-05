<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <title>Restaurante</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark bg-body-tertiary ">
            <div class="container-fluid justify-content-center ">
                <!-- Links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/">Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/nosotros">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/equipo">Equipo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/mapa">Mapa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/youtube">Youtube</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/twitter">Twitter / X</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/clima">Clima</a>
                    </li>
                </ul>
            </div>

        </nav>
    </header>

    <div class="container">
        @yield('informacion')
    </div>

    <footer>
        <p>Todos los derechos reservados @2024</p>
    </footer>
</body>

</html>
