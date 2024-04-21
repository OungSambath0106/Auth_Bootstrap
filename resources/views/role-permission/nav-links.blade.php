<div class="container">
    @can('view role')
        <a href="{{ url('roles') }}" class="btn rounded-circle btn-primary mx-2"> Roles </a>
    @endcan
    
    @can('view permission')
        <a href="{{ url('permissions') }}" class="btn rounded-circle btn-info mx-2"> Permissions </a>
    @endcan
    
    @can('view user')
        <a href="{{ url('users') }}" class="btn rounded-circle btn-warning mx-2"> Users </a>
    @endcan
</div>
