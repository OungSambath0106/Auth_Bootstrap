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
                <div class="left-login d-flex col-6 mt-0">
                    <img src="{{ asset('Image/pic1.png') }}" class="left-login-image" alt="" width="600"
                        height="600">
                </div>
                <div class="col-6 col-md-6 col-lg-6 col-xl-4 mt-1 mx-5">
                    <div class="card card-login shadow-1-strong"
                        style="border-radius: 8px; background-color: #ffffff; color:#687a8a; width: 24vw;">
                        <div class="card-body p-4">
                            <h2 class="mb-5 mt-3 text-center" style="font-weight: 700"> REGISTER </h2>
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="form-outline mb-4">
                                    <label for="username" class="mb-2">USERNAME</label>
                                    <input type="text" name="name" class="form-control form-control-lg"
                                        placeholder="Enter your username" />
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="email" class="mb-2">EMAIL</label>
                                    <input type="email" name="email" class="form-control form-control-lg"
                                        placeholder="Enter your email" />
                                    @error('email')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="password" class="mb-2">PASSWORD</label>
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        placeholder="Enter your password" />
                                    @error('password')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="form-check d-flex justify-content mb-4">
                                    <input type="checkbox" name="remember" class="form-check-input me-2" value=""
                                        id="form1Example3" />
                                    <label for="form1Example3" class="form-check-label">I agree to <span
                                            style="color: #0b5ed7">privacy policy & terms</span> </label>
                                </div>
                                <div class="d-grid col-12 mx-auto">
                                    <button class="btn btn-primary" id="registerButton" type="submit"
                                        disabled>Register</button>
                                </div>
                                <p class="text-center pt-3">Already have an account? 
                                    <a href="{{ route('login') }}" style="text-decoration: none;"> Sign in Instead </a> 
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Get references to the checkbox and submit button
        const checkbox = document.getElementById('form1Example3');
        const registerButton = document.getElementById('registerButton');

        // Add event listener to the checkbox
        checkbox.addEventListener('change', function() {
            // If checkbox is checked, enable the button; otherwise, disable it
            registerButton.disabled = !this.checked;
        });
    </script>
@endsection
