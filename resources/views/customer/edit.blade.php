@extends('layouts.master')
@section('content')
    <div class="list-group w-auto p-3 mt-2" style="border-radius: 10px">
        <div class="list-group-item" style="background-color: #3559E0" aria-current="true">
            <h4 style="color: #FFFFFF;" class=" mt-2"><b>Update CustomerList</b></h4>
        </div>
        <div class="list-group-item">
            <div class="p-2 mt-3">
                <div class="card-body">
                    <form action="{{ url('customers/' . $customers->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <fieldset>
                                    <div class="mb-3">
                                        <label for="disabledTextInput" class="form-label">Customer Name</label>
                                        <input type="text" name="customername" id="customername"
                                            value="{{ ($customers->customername) }}"class="form-control"
                                            placeholder="Disabled input" style=" color: #3559E0;">
                                        @error('customername')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="disabledTextInput" class="form-label">Company Name</label>
                                        <input type="text" name="companyname" id="companyname"
                                            value="{{ ($customers->companyname) }}"class="form-control"
                                            placeholder="Disabled input" style=" color: #3559E0;">
                                    </div>
                                    <div class="mb-3">
                                        <label for="disabledTextInput" class="form-label">Email</label>
                                        <input type="text" name="email" id="email"
                                            value="{{ ($customers->email) }}"class="form-control"
                                            placeholder="Disabled input" style=" color: #3559E0;">
                                        @error('email')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="disabledTextInput" class="form-label">Phone Number</label>
                                        <input type="text" name="phone" id="phone"
                                            value="{{ ($customers->phone) }}"class="form-control"
                                            placeholder="Disabled input" style=" color: #3559E0;">
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="disabledTextInput" class="form-label">Address</label>
                                    <textarea name="address" style="height: 150px; vertical-align: top; color: #3559E0;" id="address" class="form-control"
                                        placeholder="">{{ ($customers->address) }}</textarea>
                                </div>
                                <div class="d-grid gap-1 d-md-flex justify-content-md-end position-absolute bottom-0 end-0"
                                    style="padding:0 25px 25px 0">
                                    <button style="border-radius: 20px; width:110px;" type="submit"
                                        class="btn btn-primary">Update</button>
                                    <a href="{{ url('customers') }}" style="border-radius: 20px; width:110px;"
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
