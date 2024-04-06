@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Update Permission
                            <a href="{{ url('permissions') }}" class="btn btn-danger float-end"> Back
                            </a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('permissions/' . $permission->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for=""> Permission Name </label>
                                <input type="text" name="name" value="{{ $permission->name }}" class="form-control">
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
