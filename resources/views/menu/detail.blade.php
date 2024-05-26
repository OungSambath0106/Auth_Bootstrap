@extends('layouts.master')
@section('content')
    <div class="list-group w-auto p-3 mt-1">
        <form action="{{ url('menus/' . $menus->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row d-flex">
                <div class="left-form col-7" style="border-radius: 10px;">
                    <div class="list-group-item" style="background-color: #3559E0" aria-current="true">
                        <h4 style="color: #FFFFFF;" class=" mt-2"><b>Detail MenuList</b></h4>
                    </div>
                    <div class="list-group-item">
                        <div class="p-2 mt-1">
                            <div class="col-12">
                                <fieldset>
                                    <div class="mb-3">
                                        <label for="disabledTextInput" class="form-label"> Menu Name </label>
                                        <input type="text" name="menuname" id="menuname" class="form-control"
                                            value="{{ $menus->menuname }}" style=" color: #3559E0;"
                                            placeholder="Enter UserName" readonly>
                                        @error('menuname')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="menutype" class="form-label"> Menu Type </label>
                                        <input type="text" name="menutype" id="menutype" class="form-control"
                                            value="{{ $menus->menutype->name }}" style="color: #3559E0;"
                                            placeholder="Enter UserName" readonly>
                                        @error('menutype')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>                                    
                                    {{-- <div class="mb-3">
                                        <label for="menutype" class="form-label">Menu Type</label>
                                        <select name="menutype_id" id="menutype" class="form-control"
                                            style="color: #3559E0;">
                                            <option value="">Select Menu Type</option>
                                            @foreach ($menutypes as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ $menus->menutype_id == $type->id ? 'selected' : '' }}>
                                                    {{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('menutype_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> --}}
                                    <div class="mb-3">
                                        <label for="disabledTextInput" class="form-label"> Sale Price </label>
                                        <input type="number" name="price" id="price" class="form-control"
                                            value="{{ $menus->price }}" style=" color: #3559E0;" placeholder="Enter Price" readonly>
                                        @error('price')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="desription" class="form-label"> Description </label>
                                        <textarea class="form-control" id="description" name="description" rows="3" style="color: #3559E0;" placeholder="Enter Description" readonly>{{ $menus->description }}</textarea>
                                        @error('description')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right-form col-5" style="border-radius: 10px;">
                    <div class="list-group-item" style="background-color: #3559E0" aria-current="true">
                        <h4 style="color: #FFFFFF;" class=" mt-2"><b>Detail Image</b></h4>
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
                                                        style="min-height: 48vh;">
                                                        <img id="profileImage" class=" m-3"
                                                            style="border-radius: 10px; width: auto; height: auto; max-width: 100%; max-height: 43vh;"
                                                            alt=""
                                                            src="{{ asset('storage/uploads/menus_photo/' . $menus->image) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-1 d-md-flex justify-content-md-end position-absolute bottom-0 end-0"
                                style="padding:0 25px 25px 0;">
                                <a href="{{ url('menus') }}" style="border-radius: 20px; width:110px;"
                                    class="btn btn-primary" type="button">Back</a>
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
@endsection
