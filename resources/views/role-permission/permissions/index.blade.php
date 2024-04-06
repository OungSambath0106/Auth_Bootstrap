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
                                    Permission
                                </h4>
                                <input type="text" class="form-control search-bar-sm w-25" name="search"
                                    style="border-radius: 10px" placeholder="Search for something" aria-label="Search" />
                                @can('create permission')
                                    <a href="{{ url('permissions/create') }}" class="btn btn-primary float-end"> Add Permission
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
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $per)
                                    <tr>
                                        <td> {{ $per->id }} </td>
                                        <td> {{ $per->name }} </td>
                                        <td>
                                            @can('update permission')
                                                <a href="{{ url('permissions/' . $per->id . '/edit') }}"
                                                    class="btn btn-success"> <i class="fas fa-edit" style="color: #ffffff;"></i>
                                                </a>
                                            @endcan
                                            @can('delete permission')
                                                <a href="{{ url('permissions/' . $per->id . '/delete') }}"
                                                    class="btn btn-danger mx-2"> <i class="fas fa-trash"
                                                        style="color: #ffffff;"></i> </a>
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
