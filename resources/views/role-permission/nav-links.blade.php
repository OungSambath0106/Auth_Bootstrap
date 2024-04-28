<div class="container">
    @can('view role')
        <a href="{{ url('roles') }}" class="dropdown-item">
            <i class="fas fa-user-cog"></i> Roles
        </a>
    @endcan

    @can('view permission')
        <a href="{{ url('permissions') }}" class="dropdown-item">
            <i class="fas fa-tasks"></i> Permissions
        </a>
    @endcan

    @can('view user')
        <a href="{{ url('users') }}" class="dropdown-item">
            <i class="fas fa-user-circle"></i> Users
        </a>
    @endcan

    {{-- @can('view user')
        <a href="{{ route('hidding_user') }}" class="dropdown-item">
            <i class="fas fa-user-circle"></i> Users Hiiden
        </a>
    @endcan --}}
</div>