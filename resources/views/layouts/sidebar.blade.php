<style>
    .dropdown-menu-right {
        position: absolute;
        inset: 0px auto auto 103px !important;
        margin: 0px;
        /* transform: translate3d(0px, 94px, 0px); */
    }
</style>

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
                <a href="#" class="nav-link py-4 mb-5 icon"><i class="fa-solid fa fa-users fa-3x"
                        style="color: #ffffff;"></i></a>
            </li>
            <li class="nav-item dropdown" onmouseover="showDropdownMenu()" onmouseout="hideDropdownMenu()">
                <a class="nav-link dropdown-toggle py-4 mb-5 icon" href="#" id="navbarDropdown" role="button"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-address-book fa-3x" style="color: #ffffff;"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" id="dropdownMenu">
                    @include('role-permission.nav-links')
                </div>
            </li>
        </ul>
        <a class="nav-link py-4 d-flex justify-content-center align-items-center logout" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-right-from-bracket fa-3x" style="color: #ffffff;"></i>
        </a>
        <!-- Form for logout -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>

<script>
    function showDropdownMenu() {
        document.getElementById('navbarDropdown').classList.add('show');
        document.getElementById('dropdownMenu').classList.add('show');
    }

    function hideDropdownMenu() {
        document.getElementById('navbarDropdown').classList.remove('show');
        document.getElementById('dropdownMenu').classList.remove('show');
    }
</script>
