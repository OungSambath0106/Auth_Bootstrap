@extends('layouts.master')

@section('content')
    @include('role-permission.nav-links')

    <div class="list-group w-auto p-3" style="border-radius: 10px">
        <div class="list-group-item" style="background-color: #3559E0" aria-current="true">
            <h4 style="color: #FFFFFF;" class="mt-2"><b>Users Hidden Lsit</b></h4>
        </div>
        <div class="list-group-item">
            <div class="p-2 mt-3">

                @if (session('status'))
                    <div id="status-alert" class="alert alert-success"> {{ session('status') }} </div>
                @endif

                <form role="search" action="{{ url()->current() }}" method="GET">
                    @csrf
                    <div class="input-group inline">
                        <input type="text" class="form-control search-bar" name="search" style="border-radius: 10px"
                            placeholder="Search for something" aria-label="Search" />

                        <div>
                            <!-- Add refresh button -->
                            <button type="submit" class="btn btn-primary" value="Refresh"
                                style="background-color: #3559E0; margin-left:1vw;">
                                <i class="fas fa-sync-alt"></i> Refresh
                            </button>
                        </div>

                        <div>
                            <a href="{{ route('users.index') }}" class="btn btn-primary "
                                style="background-color: #3559E0; margin-left: 28vw;"><i class="fas fa-eye-slash"
                                    style="color: #ffffff;"></i> UnHide</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">

                <table class="table">

                    <thead class="sticky">
                        <tr>
                            <th class="p-3 col-2" scope="col"> ID </th>
                            <th class="p-3 col-3" scope="col"> User Name </th>
                            <th class="p-3 col-3" scope="col"> Email </th>
                            <th class="p-3 col-2" scope="col"> Role </th>
                            <th class="p-3 col-auto" scope="col"> Action </th>
                        </tr>
                    </thead>

                    <tbody class="tbody">
                        @foreach ($users as $user)
                            <tr>
                                @if ($user->ishidden != 0)
                                    <td class="p-3" scope="row"> {{ $user->id }} </td>
                                    <td class="p-3" scope="row"> {{ $user->name }} </td>
                                    <td class="p-3" scope="row"> {{ $user->email }} </td>
                                    <td class="p-3" scope="row">
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $rolename)
                                                <label class="badge bg-primary mx-1"> {{ $rolename }}
                                                </label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="p-3" scope="row">
                                        @can('update user')
                                            <a href="{{ url('users/' . $user->id . '/edit') }}" type="button" class="btn edit"
                                                style="background-color: #3559E0;border: none;"><i class="fas fa-edit"
                                                    style="color: #ffffff;"></i></a>
                                        @endcan
                                        @can('delete user')
                                            <a class="btn trash" href="{{ url('users/' . $user->id . '/delete') }}"
                                                onclick="return confirm('ហែងលុបធ្វើអីហាអាប្រកាច់, អាណាអោយហែងលុប ?')"
                                                style="background-color: #FF0000;border: none;"><i class="fas fa-trash"
                                                    style="color: #ffffff;"></i></a>
                                        @endcan
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>
    </div>
@endsection
