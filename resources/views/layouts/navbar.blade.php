<div class="container-fluid p-0 nav-bar">
    <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
        <a href="index.html" class="navbar-brand px-lg-4 m-0">
            <h3 class="m-0 display-4 text-uppercase text-white">HELLO <sup> COFFEE </sup></h3>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav p-4" style="margin-left: 30vw;">
                <a href="{{ url('/home') }}"
                    class="nav-item nav-link {{ request()->is('/home') ? 'active' : '' }}">Home</a>
                <a href="{{ url('/about') }}"
                    class="nav-item nav-link {{ request()->is('/about') ? 'active' : '' }}">About</a>
                <a href="{{ url('/service') }}"
                    class="nav-item nav-link {{ request()->is('/service') ? 'active' : '' }}">Service</a>
                <a href="{{ url('/menu') }}"
                    class="nav-item nav-link {{ request()->is('/menu') ? 'active' : '' }}">Menu</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu text-capitalize">
                        <a href="{{ url('/reservation') }}" class="dropdown-item">Reservation</a>
                        <a href="{{ url('/testimonial') }}" class="dropdown-item">Testimonial</a>
                    </div>
                </div>
                <a href="{{ url('/contact') }}"
                    class="nav-item nav-link {{ request()->is('/contact') ? 'active' : '' }}">Contact</a>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">User</a>
                    <div class="dropdown-menu text-capitalize">
                        <a class="dropdown-item">
                            {{ Auth::user()->name }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </nav>
</div>
