    @extends('layouts.app')

    @section('content')
        @include('role-permission.nav-links')

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">

                    @if (session('status'))
                        <div class="alert alert-success"> {{ session('status') }} </div>
                    @endif

                    <div class="card mt-3">
                        <div class="card-header">
                            <h4>
                                Roles
                                <a href="{{ url('roles/create') }}" class="btn btn-primary float-end"> Add Role
                                </a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th> ID </th>
                                        <th> Name </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td> {{ $role->id }} </td>
                                            <td> {{ $role->name }} </td>
                                            <td>
                                                @role('super-admin')
                                                    <a href="{{ url('roles/' . $role->id . '/give-permissions') }}"
                                                        class="btn btn-warning">
                                                        Add / Edit Role Permission </a>
                                                @endrole
                                                {{-- @can('update role') --}}
                                                @role('super-admin')
                                                    <a href="{{ url('roles/' . $role->id . '/edit') }}" class="btn btn-success">
                                                        Edit </a>
                                                @endrole
                                                {{-- @endcan --}}
                                                @can('delete role')
                                                    <a href="{{ url('roles/' . $role->id . '/delete') }}"
                                                        class="btn btn-danger mx-2"> Delete </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
