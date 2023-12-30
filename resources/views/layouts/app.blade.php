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
    <link rel="stylesheet" href="{{ asset("build/assets/custom.css") }}">


    @livewireStyles
</head>
<body>
    <div id="app">

        <div class="wrapper">
            {{-- sidebar --}}
           @include('layouts.includes.sideBar')
            {{-- main component --}}
            <div class="main">
                <nav class="navbar navbar-expand navbar-light px-3 border-bottom ">
                    {{-- toggle button --}}
                    <button class="btn sidebar-btn" type="button" data-bs-theme="dark">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <ul class="navbar-nav ms-auto">

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle mt-2 text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                    <img class="rounded ms-1" width="30" height="35"
                                    src='{{ asset("storage/" . Auth::user()->photo) }}' alt="Image Error">
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
                </nav>

                <main>
                    <div class="container-fluid ">
                        <div class="col-lg-12">
                            {{-- @include('layouts.includes.sideBar') --}}
                            <div class=" mt-3 p-3">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>



        @auth
            @include('layouts.includes.footer')
        @endauth


    </div>

    @yield('script') {{-- for print --}} {{-- for password input --}}
    @livewireScripts
    <script src="{{ asset('build/assets/custom.js') }}"></script>
</body>

</html>
