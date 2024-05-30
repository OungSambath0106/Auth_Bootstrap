@extends('layouts.master')

@section('content')
    <div class="list-group w-auto p-3 mt-1">
        <form action="{{ url('users') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row d-flex">
                <div class="left-form col-7" style="border-radius: 10px;">
                    <div class="list-group-item" style="background-color: #3559E0" aria-current="true">
                        <h4 style="color: #FFFFFF;" class="mt-2"><b>Create User List</b></h4>
                    </div>
                    <div class="list-group-item">
                        <div class="p-2 mt-1">
                            <div class="card-body">
                                <div class="col-12">
                                    <fieldset>
                                        <div class="mb-2">
                                            <label for="disabledTextInput" class="form-label"> User Name </label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                style=" color: #3559E0;" placeholder="Enter UserName">
                                            @error('name')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="sex" class="form-label">Sex</label>
                                            <select class="form-control" name="sex" style=" color: #3559E0;">
                                                <option value="Male" style=" color: #3559E0;">{{__('Male')}}</option>
                                                <option value="Female" style=" color: #3559E0;">{{__('Female')}}</option>
                                            </select>
                                            @error('sex')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="disabledTextInput" class="form-label"> Email </label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                style=" color: #3559E0;" placeholder="Enter Email">
                                            @error('email')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="disabledTextInput" class="form-label"> Password </label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                style=" color: #3559E0;" placeholder="Enter Password">
                                            @error('password')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="text" name="phone" id="phone" class="form-control"
                                                placeholder="Enter Phone Number" style="color: #3559E0;">
                                            @error('phone')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-2">
                                            <label for="disabledTextInput" class="form-label"> Role </label>
                                            <select name="roles[]" class="form-control" style=" color: #3559E0;">
                                                <option value=""> Select Role </option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role }}" style=" color: #3559E0;">
                                                        {{ $role }} </option>
                                                @endforeach
                                            </select>
                                            @error('roles')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right-form col-5" style="border-radius: 10px;">
                    <div class="list-group-item" style="background-color: #3559E0" aria-current="true">
                        <h4 style="color: #FFFFFF;" class=" mt-2"><b>Upload Image</b></h4>
                    </div>
                    <div class="list-group-item">
                        <div class="p-2">
                            <div class="col-12 mb-3">
                                <div class="mb-5">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="col-sm-12">
                                                    <div class="card card-primary justify-content-center align-items-center mb-3"
                                                        style="min-height: 43vh;">
                                                        <img id="profileImage" class=" m-3"
                                                            style="border-radius: 10px; width: auto; height: auto; max-width: 100%; max-height: 38vh;"
                                                            alt="">
                                                    </div>
                                                    <input name="image" class="form-control me-2 mb-3"
                                                        style=" color: #3559E0;" type="file" id="formFile"
                                                        accept=".jpg, .jpeg, .png">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-1 d-md-flex justify-content-md-end position-absolute bottom-0 end-0"
                                style="padding:0 25px 25px 0;">
                                <button style="border-radius: 20px; width:110px;" type="submit"
                                    class="btn btn-primary">Create</button>
                                <a href="{{ url('users') }}" style="border-radius: 20px; width:110px;"
                                    class="btn btn-primary" type="button">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Get the file input element
        const fileInput = document.getElementById('formFile');

        // Get the image element
        const profileImage = document.getElementById('profileImage');

        // Add event listener to the file input element
        fileInput.addEventListener('change', function(event) {
            // Check if any file is selected
            if (event.target.files && event.target.files[0]) {
                // Read the selected file as URL
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Set the image source to the URL of the selected file
                    profileImage.src = e.target.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInput = document.getElementById('phone');

            phoneInput.addEventListener('input', function(e) {
                // Remove invalid characters
                this.value = this.value.replace(/[^0-9+ ]/g, '');
            });
        });
    </script>
@endsection
