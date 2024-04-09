@extends('layouts.master')

@section('content')

    <div class="list-group w-auto p-3 mt-5" style="border-radius: 10px">
        <div class="list-group-item" style="background-color: #3559E0" aria-current="true">
            <h4 style="color: #FFFFFF;" class="mt-2"><b>Create User List</b></h4>
        </div>
        <div class="list-group-item">
            <div class="p-2 mt-3">
                <div class="card-body">
                    <form action="{{ url('users') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-6">
                                <fieldset>
                                    <div class="mb-3">
                                        <label for="disabledTextInput" class="form-label"> User Name </label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Enter UserName">
                                        @error('name')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="disabledTextInput" class="form-label"> Email </label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="Enter Email">
                                        @error('email')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="disabledTextInput" class="form-label"> Password </label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Enter Password">
                                        @error('password')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="disabledTextInput" class="form-label"> Role </label>
                                    <select name="roles[]" class="form-control" multiple>
                                        <option value=""> Select Role </option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}"> {{ $role }} </option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input name="ishidden" class="form-check-input" type="checkbox" role="switch"
                                        id="ishidden">
                                    <label class="form-check-label form-label" for="flexSwitchCheckDefault"> Hidding</label>
                                </div>
                                <div class="d-grid gap-1 d-md-flex justify-content-md-end position-absolute bottom-0 end-0"
                                    style="padding:0 25px 25px 0">
                                    <button style="border-radius: 20px; width:110px;" type="submit"
                                        class="btn btn-primary">Create</button>
                                    <a href="{{ url('users') }}" style="border-radius: 20px; width:110px;"
                                        class="btn btn-primary" type="button">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
