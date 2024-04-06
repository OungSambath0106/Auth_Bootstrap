@extends('layouts.master')

@section('content')
    @include('role-permission.nav-links')

    <div class="container mt-1">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div id="status-alert" class="alert alert-success"> {{ session('status') }} </div>
                @endif

                <div class="card mt-3">
                    <div class="card-header">
                        <form role="search" action="{{ url()->current() }}" method="GET">
                            @csrf
                            <div class="d-flex justify-content-between">
                                <h4>
                                    Users
                                </h4>
                                <input type="text" class="form-control search-bar-sm w-25" name="search"
                                    style="border-radius: 10px" placeholder="Search for something" aria-label="Search" />

                                @can('create user')
                                    <a href="{{ url('users/create') }}" class="btn btn-primary float-end"> Add User
                                    </a>
                                @endcan
                            </div>
                        </form>
                    </div>
                    <div class="card-body responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Role </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td> {{ $user->id }} </td>
                                        <td> {{ $user->name }} </td>
                                        <td> {{ $user->email }} </td>
                                        <td>
                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $rolename)
                                                    <label class="badge bg-primary mx-1"> {{ $rolename }}
                                                    </label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @can('update user')
                                                <a href="{{ url('users/' . $user->id . '/edit') }}" class="btn btn-success">
                                                    Edit </a>
                                            @endcan
                                            @can('delete user')
                                                <a href="{{ url('users/' . $user->id . '/delete') }}"
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
