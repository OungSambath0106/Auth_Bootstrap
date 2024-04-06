<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- CDN Link Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <div class="navbar-nav mr-auto"> <!-- Move navbar-nav to the left side -->
                            <a href="{{ url('/home') }}"
                                class="nav-item nav-link {{ request()->is('/home') ? 'active' : '' }}">Home</a>
                            <a href="{{ url('/about') }}"
                                class="nav-item nav-link {{ request()->is('/about') ? 'active' : '' }}">About</a>
                            <a href="{{ url('/service') }}"
                                class="nav-item nav-link {{ request()->is('/service') ? 'active' : '' }}">Service</a>
                            <a href="{{ url('/menu') }}"
                                class="nav-item nav-link {{ request()->is('/menu') ? 'active' : '' }}">Menu</a>
                            <a href="{{ url('/contact') }}"
                                class="nav-item nav-link {{ request()->is('/contact') ? 'active' : '' }}">Contact</a>
                        </div>
                    </ul>

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
                            <!-- Dropdown Menu -->
                            <div class="dropdown">
                                <button id="navbarDropdown" class="btn btn-secondary dropdown-toggle" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#" class="dropdown-item">Profile</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <!-- Form for logout -->
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>

                            </div>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container mt-5">
            @yield('main')
        </main>
    </div>

    <script>
        // Delay in milliseconds (1100 ms = 1.1 second)
        const delayInMilliseconds = 1100;

        // Function to hide the alert after a delay
        setTimeout(function() {
            // Check if the alert exists before trying to hide it
            const statusAlert = document.getElementById('status-alert');
            if (statusAlert) {
                statusAlert.style.display = 'none';
            }
        }, delayInMilliseconds);


        $(document).ready(function() {
            @if (Session::has('msg'))
                @if (Session::get('success') == true)
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.success("{{ Session::get('msg') }}");
                    success.play();
                @else
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.error("{{ Session::get('msg') }}");
                    error.play();
                @endif
            @endif

        });
    </script>
</body>

</html>
