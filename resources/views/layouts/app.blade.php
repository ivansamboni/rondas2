<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user" content="{{ Auth::user() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" sizes="38x38" type="image/png" href="{{ asset('img/auditarlogo2.ico') }}"/>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('css/charts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

        <nav class="navbar navbar-expand-md navbar-secundary bg-secundary shadow-sm">
            <div class="container">
            <img  src="{{ asset('img/auditarlogo2.png') }}" alt="" width="80px">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <a class="navbar-brand" >                      
                    </a>
                    <a class="navbar-brand" href="{{ url('/home') }}"><i class="bi bi-house-door"></i>
                        {{'Inicio'}}
                    </a>

                    <ul class="navbar-nav me-auto">
                        <a class="navbar-brand" href="{{ url('/auditar') }}"><i class="bi bi-receipt"></i>
                            {{'Auditar'}}
                        </a>
                        @if(auth()->user()->rol === 'admin')
                       <a class="navbar-brand" href="{{ url('/ediciones') }}"><i class="bi bi-pencil-square"></i>
                            {{'Ediciones'}}
                        </a>
                        @endif                     
                        
                        <a class="navbar-brand" href="{{ url('/dashboard') }}"><i class="bi bi-reception-4"></i>
                            {{'Dashboard'}}
                        </a>
                        <a class="navbar-brand" href="{{ url('/observaciones') }}"><i class="bi bi-book"></i>
                            {{'Observaciones'}}
                        </a>
                        @if(auth()->user()->rol === 'admin')
                        <a class="navbar-brand" href="{{ url('/usuarios') }}"><i class="bi bi-person-add"></i>
                            {{'Usuarios'}}
                        </a>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }} ({{Auth::user()->rol }})
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Salir') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    
    <main class="py-4">
        @yield('content')
    </main>
    
</body>

</html>