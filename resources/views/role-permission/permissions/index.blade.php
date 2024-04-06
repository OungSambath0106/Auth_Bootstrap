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
                            Permission
                            <a href="{{ url('permissions/create') }}" class="btn btn-primary float-end"> Add Permission
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
                                @foreach ($permissions as $per)
                                    <tr>
                                        <td> {{ $per->id }} </td>
                                        <td> {{ $per->name }} </td>
                                        <td>
                                            @can('update permission')
                                                <a href="{{ url('permissions/' . $per->id . '/edit') }}"
                                                    class="btn btn-success"> Edit </a>
                                            @endcan
                                            @can('delete permission')
                                                <a href="{{ url('permissions/' . $per->id . '/delete') }}"
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
