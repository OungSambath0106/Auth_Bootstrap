@extends('layouts.master')
@section('title', 'Update Settings')
@section('content-header', 'Update Settings')

@section('content')

    @if (session('status'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1800,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
                customClass: {
                    popup: 'swal-toast'
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('status') }}"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1800,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
                customClass: {
                    popup: 'swal-toast'
                }
            });
            Toast.fire({
                icon: "error",
                title: "{{ session('error') }}"
            });
        </script>
    @endif

    <div class="list-group w-auto p-3 mt-1">
        <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row d-flex">
                <div class="left-form col-7" style="border-radius: 10px;">
                    <div class="list-group-item" style="background-color: #3559E0" aria-current="true">
                        <h4 style="color: #FFFFFF;" class="mt-2"><b>Update Setting</b></h4>
                    </div>
                    <div class="list-group-item">
                        <div class="p-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class=" form-label" for="app_name">App Name</label>
                                            <input type="text" name="app_name"
                                                class="form-control @error('app_name') is-invalid @enderror" id="app_name"
                                                placeholder="Enter App Name"
                                                value="{{ old('app_name', config('settings.app_name')) }}"
                                                style=" color: #3559E0;">
                                            @error('app_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="phone_number">Phone Number</label>
                                            <input type="text" name="phone_number"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                id="phone_number" placeholder="Enter Phone Number"
                                                value="{{ old('phone_number', config('settings.phone_number')) }}"
                                                style="color: #3559E0;"
                                                oninput="this.value = this.value.replace(/[^0-9+ ]/g, '');">
                                            @error('phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class=" form-label" for="copyright_text">Copyright Text</label>
                                            <input type="text" name="copyright_text"
                                                class="form-control @error('copyright_text') is-invalid @enderror"
                                                id="copyright_text" placeholder="Enter Copyright Text"
                                                value="{{ old('copyright_text', config('settings.copyright_text')) }}"
                                                style=" color: #3559E0;">
                                            @error('copyright_text')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class=" form-label" for="currency_symbol">Currency Symbol</label>
                                            <input type="text" name="currency_symbol"
                                                class="form-control @error('currency_symbol') is-invalid @enderror"
                                                id="currency_symbol" placeholder="Enter Currency Symbol"
                                                value="{{ old('currency_symbol', config('settings.currency_symbol')) }}"
                                                style=" color: #3559E0;">
                                            @error('currency_symbol')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class=" form-label" for="location">Location</label>
                                        <textarea name="location" class="form-control @error('location') is-invalid @enderror" id="location" rows="2"
                                            placeholder="Enter Location" style=" color: #3559E0;">{{ old('location', config('settings.location')) }}</textarea>
                                        @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class=" form-label" for="app_description">App Description</label>
                                        <textarea name="app_description" class="form-control @error('app_description') is-invalid @enderror"
                                            id="app_description" rows="2" placeholder="Enter App Description" style=" color: #3559E0;">{{ old('app_description', config('settings.app_description')) }}</textarea>
                                        @error('app_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="left-form col-5" style="border-radius: 10px;">
                    <div class="list-group-item" style="background-color: #3559E0" aria-current="true">
                        <h4 style="color: #FFFFFF;" class="mt-2"><b>Upload Web Icon</b></h4>
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
                                                        style="min-height: 31vh;">
                                                        {{-- <img src=" @if (config('settings.web_icon') && file_exists('storage/uploads/web_icon/' . config('settings.web_icon'))) {{ asset('storage/uploads/web_icon/' . config('settings.web_icon')) }} @else {{ asset('storage/uploads/default.png') }} @endif "
                                                            alt="" height="120px"> --}}
                                                        <img src="{{ config('settings.web_icon') && file_exists(public_path('storage/uploads/web_icon/' . config('settings.web_icon'))) ? asset('storage/uploads/web_icon/' . config('settings.web_icon')) : asset('storage/uploads/default.png') }}"
                                                            alt="" height="200px">
                                                    </div>
                                                    <input name="web_icon" class="form-control me-2 mb-3"
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
                                    class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
