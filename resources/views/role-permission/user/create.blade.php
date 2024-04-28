@extends('layouts.master')

@section('content')
    <div class="list-group w-auto p-3 mt-2" style="border-radius: 10px">
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
                                        <input type="text" name="name" id="name" class="form-control" style=" color: #3559E0;"
                                            placeholder="Enter UserName">
                                        @error('name')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="disabledTextInput" class="form-label"> Email </label>
                                        <input type="email" name="email" id="email" class="form-control" style=" color: #3559E0;"
                                            placeholder="Enter Email">
                                        @error('email')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="disabledTextInput" class="form-label"> Password </label>
                                        <input type="password" name="password" id="password" class="form-control" style=" color: #3559E0;"
                                            placeholder="Enter Password">
                                        @error('password')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="disabledTextInput" class="form-label"> Role </label>
                                        <select name="roles[]" class="form-control" style=" color: #3559E0;" multiple>
                                            <option value=""> Select Role </option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}" style=" color: #3559E0;"> {{ $role }} </option>
                                            @endforeach
                                        </select>
                                        @error('roles')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="disabledTextInput" class="form-label"> Upload Profile </label>
                                    <div class="card card-primary">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <small for="formFile" style="color: #3559E0;"
                                                            class="col-sm-2 form-col-label"> click on
                                                            choose file for upload profile </small>
                                                        <div class="col-sm-12">
                                                            <input name="image" class="form-control me-2 mb-3" style=" color: #3559E0;"
                                                                type="file" id="formFile" accept=".jpg, .jpeg, .png">
                                                            <img id="profileImage" style="border-radius: 10px;"
                                                                class="mx-5" width="180" height="180" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input name="ishidden" class="form-check-input" type="checkbox" role="switch"
                                        id="ishidden flexSwitchCheckChecked" style=" border-color: #3559E0;" checked>
                                    <label class="form-check-label form-label" for="flexSwitchCheckChecked"> 
                                        Active or InActive 
                                    </label>
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
@endsection
