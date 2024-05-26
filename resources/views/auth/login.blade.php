@extends('layouts.app')

@section('main')
    <style>
        .card-login {
            box-shadow: 0px 10px 40px #00000056;
        }
    </style>

    <section style="">
        <div class="container py-5">
            <div class="row d-flex justify-content-between h-80">
                <div class="col-6 col-md-6 col-lg-6 col-xl-4 mt-5 p-4 px-5 mx-5">
                    <div class="card card-login shadow-1-strong"
                        style="border-radius: 8px; background-color: #ffffff; color:#687a8a; width: 24vw;">
                        <div class="card-body p-4">
                            <h2 class="mb-4 mt-3 text-center" style="font-weight: 700"> LOGIN </h2>
                            <form class="needs-validation" action="{{ route('login') }}" method="POST" novalidate>
                                @csrf
                                <div class="form-outline mb-3">
                                    <label for="validationEmail" class="mb-2 mt-3">EMAIL</label>
                                    <input type="email" name="email" class="form-control form-control-lg"
                                        id="validationEmail" placeholder="Enter your email" required />
                                    @error('email')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="form-outline mb-3">
                                    <label for="validationPassword" class="mb-2 mt-3">PASSWORD</label>
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        id="validationPassword" placeholder="Enter your password" required />
                                    @error('password')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="form-check d-flex justify-content mb-3 mt-3">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember" style="margin-left: 7px;">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                <div class="d-grid col-12 mt-5 mx-auto">
                                    <button class="btn btn-primary" id="registerButton" type="submit">Login</button>
                                </div>
                                {{-- <p class="text-center pt-3">I don't have account?
                                    <a href="{{ route('register') }}" style="text-decoration: none;"> Register </a>
                                </p> --}}
                            </form>
                        </div>
                    </div>
                </div>
                <div class="left-login d-flex col-6 mt-0">
                    <img src="{{ asset('Image/pic1.png') }}" class="left-login-image" alt="" width="600"
                        height="600">
                </div>
            </div>
        </div>
    </section>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endsection
