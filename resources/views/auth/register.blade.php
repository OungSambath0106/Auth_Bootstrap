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
                            <h2 class="mb-4 mt-3 text-center" style="font-weight: 700"> REGISTER </h2>
                            <form class="needs-validation" action="{{ route('register') }}" method="POST" novalidate>
                                @csrf
                                <div class="form-outline mb-3">
                                    <label for="validationUsername" class="mb-2">USERNAME</label>
                                    <input type="text" name="name" class="form-control form-control-lg"
                                        id="validationUsername" placeholder="Enter your username" required />
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Username must be between 4 and 25 characters.
                                    </div>
                                </div>
                                <div class="form-outline mb-3">
                                    <label for="validationEmail" class="mb-2">EMAIL</label>
                                    <input type="email" name="email" class="form-control form-control-lg"
                                        id="validationEmail" placeholder="Enter your email" required />
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter a valid email address.
                                    </div>
                                </div>
                                <div class="form-outline mb-3">
                                    <label for="validationPassword" class="mb-2">PASSWORD</label>
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        id="validationPassword" placeholder="Enter your password" required />
                                    <div class="valid-feedback">
                                        Your Password is Strong.
                                    </div>
                                    <div class="invalid-feedback">
                                        Password must be at least 4 characters.
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content mb-4">
                                    <input type="checkbox" name="remember" class="form-check-input me-2" value=""
                                        id="form1Example3" required />
                                    <label for="form1Example3" class="form-check-label">
                                        I agree to <span style="color: #0b5ed7">privacy policy & terms</span>
                                    </label>
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

    <!--Input Username-->
    <script>
        document.getElementById("validationUsername").addEventListener("input", function() {
            var usernameInput = document.getElementById("validationUsername");
            var errorFeedback = usernameInput.nextElementSibling;

            if (usernameInput.value.length < 4 || usernameInput.value.length > 25) {
                errorFeedback.innerText = "Username must be between 4 and 25 characters.";
                usernameInput.setCustomValidity("Invalid");
            } else {
                errorFeedback.innerText = "Looks good!";
                usernameInput.setCustomValidity("");
            }
        });
    </script>

    <!--Input Password-->
    <script>
        document.getElementById("validationPassword").addEventListener("input", function() {
            var passwordInput = document.getElementById("validationPassword");
            var errorFeedback = passwordInput.nextElementSibling;

            if (passwordInput.value.length < 4) {
                errorFeedback.innerText = "Password must be at least 4 characters.";
                passwordInput.setCustomValidity("Invalid");
            } else if (passwordInput.value.length < 6) {
                errorFeedback.innerText = "Your Password is too weak!";
                passwordInput.setCustomValidity("");
            } else if (passwordInput.value.length > 5) {
                errorFeedback.innerText = "Your Password is Strong.";
                passwordInput.setCustomValidity("");
            }
        });
    </script>
@endsection
