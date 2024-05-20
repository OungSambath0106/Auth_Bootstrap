<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title', 'Jib Poch Coffee Shop')</title>

    <link rel="icon" type="image/x-icon"
        href="{{ config('settings.web_icon') && file_exists(public_path('storage/uploads/web_icon/' . config('settings.web_icon'))) ? asset('storage/uploads/web_icon/' . config('settings.web_icon')) : asset('storage/uploads/default') }}">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('bootstrap') }}/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="{{ asset('css') }}/style.css" rel="stylesheet">
    {{-- Sidebar Template .css --}}
    <link href="{{ asset('bootstrap-assets/sidebars') }}/sidebars.css" rel="stylesheet" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- CDN Link Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])

    @stack('style')
</head>

<body>
    <div id="app">

        <div class="row m-0">
            <div class=" col-md-1 sidebar" style="padding: 0;">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-11" style="padding-right: 0;">
                @include('layouts.navbar')

                @yield('content')
            </div>
        </div>
    </div>


    <link href="{{ asset('js') }}/script.js" rel="stylesheet">
    <!-- Template Javascript -->
    <script src="{{ asset('bootstrap') }}/js/bootstrap.bundle.min.js"></script>
    {{-- Sidebar Template .js --}}
    <script src="{{ asset('bootstrap-assets/sidebars') }}/sidebars.js"></script>

    <script>
        // Delay in milliseconds (1100 ms = 1.1 second)
        const delayInMilliseconds = 2000;

        // Function to hide the alert after a delay
        setTimeout(function() {
            // Check if the alert exists before trying to hide it
            const statusAlert = document.getElementById('status-alert');
            if (statusAlert) {
                statusAlert.style.display = 'none';
            }
        }, delayInMilliseconds);
    </script>

    @stack('script')
</body>

</html>
