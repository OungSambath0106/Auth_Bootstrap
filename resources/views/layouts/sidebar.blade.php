<style>
    .dropdown-menu-right {
        position: absolute;
        inset: 0px auto auto 75px !important;
        margin: 0px;
        /* transform: translate3d(0px, 94px, 0px); */
    }

    .dropdown-toggle::after {
        content: none !important;
    }
</style>

<div class="sidebar p-0">
    <div class="d-flex flex-column flex-shrink-0 text-white sidebar-container">
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
            <li>
                <a href="{{ route('dashboard') }}" title="@lang('Dashboard')"
                    class="nav-link py-3 mb-2 mt-2 icon{{ Request::is('dashboard') ? ' active' : '' }}">
                    <i class="fa-solid fas fa-tachometer-alt fa-3x" style="color: #ffffff;"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('order') }}" title="@lang('Order')"
                    class="nav-link py-3 mb-2 icon{{ Request::is('some_other_page') ? ' active' : '' }}">
                    <i class="fa-solid fas fa-shopping-cart fa-3x" style="color: #ffffff;"></i>
                </a>
            </li>
            <li>
                <a href="#" title="@lang('All Sale')"
                    class="nav-link py-3 mb-2 mt-2 icon{{ Request::is('sale') ? ' active' : '' }}">
                    <i class="fa-solid fas fa-chart-line fa-3x" style="color: #ffffff;"></i>
                </a>
            </li>
            @can('view menu')
                <li>
                    <a href="{{ url('menus') }}" title="@lang('Menu')"
                        class="nav-link py-3 mb-2 icon{{ Request::is('menus') ? ' active' : '' }}">
                        <i class="fa-solid fas fa-book-open fa-3x" style="color: #ffffff;"></i>
                    </a>
                </li>
            @endcan
            @can('view customer')
                <li>
                    <a href="{{ url('customers') }}" title="@lang('Customer')"
                        class="nav-link py-3 mb-2 icon{{ Request::is('customers') ? ' active' : '' }}">
                        <i class="fa-solid fa fa-users fa-3x" style="color: #ffffff;"></i>
                    </a>
                </li>
            @endcan
            @canany(['view role', 'view permission', 'view user'])
                <li class="nav-item dropdown" onmouseover="showDropdownMenu()" onmouseout="hideDropdownMenu()">
                    <a class="nav-link dropdown-toggle py-4 icon" href="#" id="navbarDropdown" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fas fa-address-book fa-3x" style="color: #ffffff;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" id="dropdownMenu">
                        @include('role-permission.nav-links')
                    </div>
                </li>
            @endcanany
        </ul>
        <ul class="nav nav-pills nav-flush flex-column mb-auto mt-5 text-center">
            <li>
                <a href="{{ url('settings') }}" title="@lang('Setting')"
                    class="nav-link py-2 mb-2 mt-4 icon{{ Request::is('settings') ? ' active' : '' }}">
                    <i class="fa-solid fas fa-cog fa-3x" style="color: #ffffff;"></i>
                </a>
            </li>
            <li>
                <a class="nav-link pt-3 d-flex justify-content-center align-items-center logout"
                    href="{{ route('logout') }}" onclick="event.preventDefault(); confirmLogout();">
                    <i class="fa-solid fas fa-sign-out-alt fa-3x" style="color: #ffffff;"></i>
                </a>
            </li>
        </ul>
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

<!-- Include SweetAlert script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- JavaScript to show confirmation dialog -->
<script>
    function confirmLogout() {
        Swal.fire({
            title: "Are you sure?",
            text: "You will be logged out!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3559E0",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, log out"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>
