<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/551bd3e2f2.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


    <!--Styles -->
    <link rel="stylesheet" href="{{ asset("build/assets/app-041e359a.css")}}">



    @livewireStyles
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Shop Logo" width="50" height="40">
                    {{ config('app.name', 'Laravel') }}
                </a>




                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->



                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle mt-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

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

        <main>
            @yield('content')
        </main>
        @auth
        <footer class="bg-dark text-light py-5">
            <div class="container">
                <div class="row text-start">
                    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                        <h4>Company Name</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                    <div class="col-lg col-md-6 mb-4 mb-lg-0">
                        <h4>Quick Links</h4>
                        <ul class="list-unstyled">
                            <li><a class="text-light" href="#">Home</a></li>
                            <li><a class="text-light" href="#">About Us</a></li>
                            <li><a class="text-light" href="#">Services</a></li>
                            <li><a class="text-light" href="#">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-lg col-md-12">
                        <h4>Follow Us</h4>
                        <ul class="list-unstyled">
                            <li><a class="text-light" href="#"><i class="fa fa-lg fa-facebook me-1"></i> Facebook</a></li>
                            <li><a class="text-light" href="#"><i class="fa fa-lg fa-twitter me-1"></i> Twitter</a></li>
                            <li><a class="text-light" href="#"><i class="fa fa-lg fa-linkedin me-1"></i> LinkedIn</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        @endauth

        <!--Styles -->
        <style>
            #sidenav {
                background-color:#f0f3f4;
                min-height: 100vh;
                position: sticky;
            }
            #sidenav a span{
                color: #5d6d7e;
            }
            #sidenav a  {
                color: #000000;
            }

            #sidenav li {
                width: 100%;
                border-radius: 10px;
            }
            #sidenav li:hover {
                background-color: #3498db;
                transform: scale(1.1); /* Change the scale factor as needed */
                transition: transform 0.2s;
            }
            #sidenav li:hover a, #sidenav li:hover span{
                color: #ffff;
            }
        </style>



    </div>

    @yield('script')
    @livewireScripts
</body>

</html>
