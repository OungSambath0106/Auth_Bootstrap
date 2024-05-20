<div class="container">
    @can('view role')
        <a href="{{ url('roles') }}" class="dropdown-item{{ Request::is('roles') ? ' active' : '' }}">
            <i class="fas fa-user-cog"></i> Roles
        </a>
    @endcan

    @can('view permission')
        <a href="{{ url('permissions') }}" class="dropdown-item{{ Request::is('permissions') ? ' active' : '' }}">
            <i class="fas fa-tasks"></i> Permissions
        </a>
    @endcan

    @can('view user')
        <a href="{{ url('users') }}" class="dropdown-item{{ Request::is('users') ? ' active' : '' }}">
            <i class="fas fa-user-circle"></i> Users
        </a>
    @endcan
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
</script>
