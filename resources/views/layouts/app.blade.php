<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title') @yield('title') | @endif Pollaxm</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{!! asset('estilos.css') !!}">
<!-- datatable -->
     @yield('css')
    

<!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div id="app" >
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Pollaxm
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
					@auth()
                    <ul class="navbar-nav mr-auto">
						<!--Nav Bar Hooks - Do not delete!!-->
						
						
                        @can('modulo-pronosticos')
						<li class="nav-item">
                            <a href="{{ url('/pronosticos') }}" class="nav-link"><i class="fa-solid fa-square-poll-vertical text-info"> </i> Mis Pronosticos</a> 
                        </li>
                        @endcan
                        @can('modulo-resultados')
						<li class="nav-item">
                            <a href="{{ url('/resultados') }}" class="nav-link"><i class="fa-solid fa-futbol text-info"></i> Resultados</a> 
                        </li>
                        @endcan
                        @can('modulo-partidos')
						<li class="nav-item">
                            <a href="{{ url('/partidos') }}" class="nav-link"><i class="fa-solid fa-network-wired text-info"></i> Partidos</a> 
                        </li>
                        @endcan
                        @can('modulo-jugadores')
                        <li class="nav-item">
                            <a href="{{ url('/jugadores') }}" class="nav-link"><i class="fa-solid fa-users text-info"></i> Jugadores</a> 
                        </li>
                        @endcan
                        @can('modulo-jornadas')
                        <li class="nav-item">
                            <a href="{{ url('/jornadas') }}" class="nav-link"><i class="fa-solid fa-network-wired text-info"></i> Jornadas</a> 
                        </li>
                        @endcan
                        @can('modulo-equipos')
						<li class="nav-item">
                            <a href="{{ url('/equipos') }}" class="nav-link"><i class="fa-solid fa-shield-halved text-info"></i> Equipos</a> 
                        </li>
                        @endcan
                        @can('modulo-perfil')
						<li class="nav-item">
                            <a href="{{ url('/perfil') }}" class="nav-link"><i class="fa-regular fa-address-card text-info"></i> Perfil</a> 
                        </li>
                        @endcan
                       
                        <li class="nav-item">
                            <a href="{{ url('/allpronosticos') }}" class="nav-link"><i class="fa-solid fa-square-poll-horizontal text-info"></i> Pronosticos</a> 
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/posiciones') }}" class="nav-link"><i class="fa-solid fa-ranking-star text-info"></i> Posiciones</a> 
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/reglamento') }}" class="nav-link"><i class="fa-solid fa-handshake-angle text-info"></i> Reglas y puntuación</a> 
                        </li>
                    </ul>
					@endauth()

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                                </li>
                            @endif

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-from-bracket"></i>
                                        Cerrar sesión
                                    </a>  
                                    <a href="{{ url('/password') }}"  class="dropdown-item"><i class="fa-solid fa-file-pen "></i> Cambiar contraseña</a> 

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
 
        <main class="py-4" >
            @yield('content')
        </main>
      
    </div>
    @livewireScripts
    @yield('js')
    @stack('custom-scripts')

   
    <script type="module">
        const addModal = new bootstrap.Modal('#createDataModal');
        const editModal = new bootstrap.Modal('#updateDataModal');
        window.addEventListener('closeModal', () => {
           addModal.hide();
           editModal.hide();
        })
         
    </script>
<script>
    Livewire.on('bloqueado', () => {
     
        Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El partido ya inicio, no se puede pronosticar.',
            }).then((result) => {
                if (result.isConfirmed) {
                    
                }
            })
    } );
    
    </script>
</body>
</html>