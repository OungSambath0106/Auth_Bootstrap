@extends('layouts.master')

@section('content')
    <div class="list-group w-auto p-3 mt-5" style="border-radius: 10px">
        <div class="list-group-item" style="background-color: #3559E0" aria-current="true">
            <h4 style="color: #FFFFFF;" class="mt-2"><b>Update Role</b></h4>
        </div>
        <div class="list-group-item">
            <div class="p-2 mt-3">
                <div class="card-body">
                    <form action="{{ url('roles/' . $role->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-5">
                            <label for="" class="form-label"> Role Name </label>
                            <input type="text" name="name" value="{{ $role->name }}" class="form-control" placeholder="Enter Role" style="color: #3559E0;">
                        </div>
                        <div class="d-grid gap-1 d-md-flex justify-content-md-end" style="padding:0 25px 25px 0">
                            <button style="border-radius: 20px; width:110px;" type="submit"
                                class="btn btn-primary">Update</button>
                            <a href="{{ url('roles') }}" style="border-radius: 20px; width:110px;" class="btn btn-primary"
                                type="button">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
