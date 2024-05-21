@extends('layouts.master')

@section('content')
    <div class="list-group w-auto p-3 mt-1" style="border-radius: 10px">
        <div class="list-group-item" style="background-color: #3559E0" aria-current="true">
            <h4 style="color: #FFFFFF;" class="mt-2"><b>Role : {{ $role->name }}</b></h4>
        </div>
        <div class="list-group-item">
            <div class="p-2 mt-1">
                <div class="card-body">
                    <form action="{{ url('roles/' . $role->id . '/give-permissions') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            @error('permission')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <h4 class="form-label mx-5 mb-3">Permissions:</h4>
                            <div class="row table-permission gap__20 col-12 w-auto justify-content-evenly mx-5"
                                style="max-height: 300px; overflow-y: auto;">
                                @foreach ($permissions as $per)
                                    <div class="col-md-2 form-check form-switch">
                                        <h5 class="form-label" for="flexSwitchCheckDefault">
                                            <input type="checkbox" class="form-check-input" id="flexSwitchCheckDefault"
                                                name="permission[]" value="{{ $per->name }}"
                                                {{ in_array($per->id, $rolePermissions) ? 'checked' : '' }} />
                                            {{ $per->name }}
                                        </h5>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-grid gap-1 d-md-flex justify-content-md-end" style="padding:0 25px 25px 0">
                            <button style="border-radius: 20px; width:110px;" type="submit"
                                class="btn btn-primary">Create</button>
                            <a href="{{ url('roles') }}" style="border-radius: 20px; width:110px;" class="btn btn-primary"
                                type="button">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
