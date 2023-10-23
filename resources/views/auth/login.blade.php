<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" sizes="38x38" type="image/png" href="{{ asset('img/auditarlogo2.ico') }}"/>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="container" style="background-image: url('img/logo.jpg');background-repeat:no-repeat;
background-size: cover;">

    <br><br><br><br><br>
    <div class="container" style="width: 20rem;">
        <div class="card" style="width: 20rem;">
            <div class="card-body">
                <div class="text-center">
            <img  src="{{ asset('img/auditarlogo2.png') }}" alt="" width="100px">
            </div><br>           
                <h2 class="card-title text-center"><strong>Iniciar sesión</strong></h2>
                               
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo electrónico">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <hr>


                    <button type="submit" class="btnblue2 form-control"><i class="bi bi-key-fill"></i>
                        {{ __('Entrar') }}
                    </button><br><br>

                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Restablecer mi contraseña') }}
                    </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</body>
<footer>
    <br><br><br><br>
    <div class="text-center"><strong>Copyright © 2022 Devsamb.com. Todos los derechos reservados. Para más información visite </strong> <a href="https://www.devsamb.com" target="_blank">www.devsamb.com</a> </div>

</footer>
</html>