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
    
    .dropdown-item.active{
        background: none !important;
        color: #000000;
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
                <a href="{{ route('invoice.index') }}" title="@lang('All Sale')"
                    class="nav-link py-3 mb-2 mt-2 icon{{ Request::is('sale') ? ' active' : '' }}">
                    <i class="fa-solid fas fa-chart-line fa-3x" style="color: #ffffff;"></i>
                </a>
            </li>
            @canany(['view menu', 'view menutype'])
                <li class="nav-item dropdown" onmouseover="showDropdownMenu('menuDropdown', 'menuDropdownMenu')"
                    onmouseout="hideDropdownMenu('menuDropdown', 'menuDropdownMenu')">
                    <a class="nav-link dropdown-toggle py-4 icon" href="#" id="menuDropdown" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fas fa-book-open fa-3x" style="color: #ffffff;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="menuDropdown" id="menuDropdownMenu">
                        <div class="container">
                            @can('view menu')
                                <a href="{{ url('menus') }}" class="dropdown-item{{ Request::is('menus') ? ' active' : '' }}">
                                    <i class="fas fa-plus-square"></i> Menu
                                </a>
                            @endcan
                            @can('view menutype')
                                <a href="{{ url('menutypes') }}"
                                    class="dropdown-item{{ Request::is('menutypes') ? ' active' : '' }}">
                                    <i class="fas fa-plus-square"></i> MenuType
                                </a>
                            @endcan
                        </div>
                    </div>
                </li>
            @endcanany
            @can('view customer')
                <li>
                    <a href="{{ url('customers') }}" title="@lang('Customer')"
                        class="nav-link py-3 mb-2 icon{{ Request::is('customers') ? ' active' : '' }}">
                        <i class="fa-solid fa fa-users fa-3x" style="color: #ffffff;"></i>
                    </a>
                </li>
            @endcan
            @canany(['view role', 'view permission', 'view user'])
                <li class="nav-item dropdown" onmouseover="showDropdownMenu('roleDropdown', 'roleDropdownMenu')"
                    onmouseout="hideDropdownMenu('roleDropdown', 'roleDropdownMenu')">
                    <a class="nav-link dropdown-toggle py-4 icon" href="#" id="roleDropdown" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fas fa-address-book fa-3x" style="color: #ffffff;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="roleDropdown" id="roleDropdownMenu">
                        <div class="container">
                            @can('view role')
                                <a href="{{ url('roles') }}"
                                    class="dropdown-item{{ Request::is('roles') ? ' active' : '' }}">
                                    <i class="fas fa-user-cog"></i> Roles
                                </a>
                            @endcan
                            @can('view permission')
                                <a href="{{ url('permissions') }}"
                                    class="dropdown-item{{ Request::is('permissions') ? ' active' : '' }}">
                                    <i class="fas fa-tasks"></i> Permissions
                                </a>
                            @endcan
                            @can('view user')
                                <a href="{{ url('users') }}"
                                    class="dropdown-item{{ Request::is('users') ? ' active' : '' }}">
                                    <i class="fas fa-user-circle"></i> Users
                                </a>
                            @endcan
                        </div>
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
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', () => {
            document.querySelectorAll('.dropdown-item').forEach(link => {
                link.classList.remove('active');
            });
            item.classList.add('active');
        });
    });

    function showDropdownMenu(dropdownId, menuId) {
        document.getElementById(dropdownId).classList.add('show');
        document.getElementById(menuId).classList.add('show');
    }

    function hideDropdownMenu(dropdownId, menuId) {
        document.getElementById(dropdownId).classList.remove('show');
        document.getElementById(menuId).classList.remove('show');
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
