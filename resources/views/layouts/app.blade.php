<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
        }

        .bg { 
            /* The image used */
            background-image: url("/img/background.jpg");

            /* Full height */
            height: 100%; 

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

    .footer-custom {
        background: black;
        color: white;
    }
    </style>
</head>
<body>
    <div id="app" class="bg">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <a class="navbar-brand" href="#">
                <img src="/img/logo-soho.png" width="30" height="30" alt="">
              </a>
            <div class="container">
                <a class="navbar-brand" href="{{ url('/view-projects') }}">
                    Proyectos
                </a>
                <a class="navbar-brand" href="{{ url('/admin-projects') }}">
                    Admin Proyectos
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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

        <main class="py-4">
            @yield('content')
        </main>
        <!-- Footer -->
        <footer class="page-footer font-small special-color-dark pt-4 footer-custom">
            <!-- Footer Links -->
            <div class="container-fluid text-center text-md-left">
                <!-- Grid row -->
                <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-4 mt-md-0 mt-4">
                        <!-- Content -->
                        <p>
                            <b>© 2017</b> SOHO internet + humana
                        </p>
                    </div>
                    <!-- Grid column -->
                    <hr class="clearfix w-100 d-md-none pb-3">
  
                    <!-- Grid column -->
                    <div class="col-md-4 mb-md-0 mb-4">
                        <ul class="list-unstyled list-inline text-center">
                            <li class="list-inline-item">
                                <a class="btn-floating btn-fb mx-1" style="color: green;">
                                    <b>Visítanos</b>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn-floating btn-tw mx-1" style="color: green;">
                                    <b>Escríbenos</b>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn-floating btn-li mx-1" style="color: green;">
                                    <b>Llámanos</b>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Grid column -->
  
                    <!-- Grid column -->
                    <div class="col-md-4 mb-md-0 mb-4">
            
                        <ul class="list-unstyled list-inline text-center">
                            <li class="list-inline-item">
                                <a class="btn-floating btn-fb mx-1">
                                    <img src="/img/facebook.jpg" style="border-radius: 50%;" width="40" height="30" alt="">
                                </a>
                                </li>
                                <li class="list-inline-item">
                                <a class="btn-floating btn-tw mx-1">
                                    <img src="/img/twitter.jpg" style="border-radius: 50%;" width="40" height="30" alt="">
                                </a>
                                </li>
                                <li class="list-inline-item">
                                <a class="btn-floating btn-gplus mx-1">
                                    <img src="/img/linkedin.jpg" style="border-radius: 50%;" width="40" height="30" alt="">
                                </a>
                                </li>
                                <li class="list-inline-item">
                                <a class="btn-floating btn-li mx-1">
                                    <img src="/img/youtube.jpg" style="border-radius: 50%;" width="40" height="30" alt="">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
            <!-- Footer Links -->
  
        </footer>
        <!-- Footer -->
    </div>
</body>
</html>
