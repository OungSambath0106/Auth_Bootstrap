@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Update User
                            <a href="{{ url('users') }}" class="btn btn-danger float-end"> Back
                            </a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('users/' . $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for=""> User Name </label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                @error('name')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for=""> Email </label>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for=""> Password </label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for=""> Role </label>
                                <select name="roles[]" class="form-control" multiple>
                                    <option value=""> Select Role </option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}"
                                            {{ in_array($role, $userRoles) ? 'selected' : '' }}> {{ $role }} </option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary"> Update </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
