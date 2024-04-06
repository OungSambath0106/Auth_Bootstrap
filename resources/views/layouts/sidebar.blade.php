<div class="sidebar p-0">
    <div class="d-flex flex-column flex-shrink-0 text-white sidebar-container">
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
            <li>
                <a href="#" class="nav-link py-4 mb-5 icon"><i class="fa-solid fa-shop fa-3x"
                        style="color: #ffffff;"></i></a>
            </li>
            <li>
                <a href="#" class="nav-link py-4 mb-5 icon"><i class="fa-solid fa-pen-to-square fa-3x"
                        style="color: #ffffff;"></i></a>
            </li>
            <li>
                <a href="" class="nav-link py-4 mb-5 icon"><i class="fa-solid fa fa-users fa-3x"
                        style="color: #ffffff;"></i></a>
            </li>
            <li>
                <a href="{{ url('users') }}" class="nav-link py-4 mb-5 icon"><i class="fa-solid fa-address-book fa-3x"
                        style="color: #ffffff;"></i></a>
            </li>
        </ul>
        {{-- <a href="{{ route('login') }}" class="nav-link py-4 d-flex justify-content-center align-items-center logout"><i
                class="fa-solid fa-right-from-bracket fa-3x" style="color: #ffffff;"></i></a> --}}
        <a class="nav-link py-4 d-flex justify-content-center align-items-center logout" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-right-from-bracket fa-3x" style="color: #ffffff;"></i>
        </a>
        <!-- Form for logout -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>
