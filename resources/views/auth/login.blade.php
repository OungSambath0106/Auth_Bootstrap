@extends('layouts.app')

@section('content')
    <section style="">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center h-80">
                <div class="col-12 col-md-8 col-lg-6 col-xl-4">
                    <div class="card shadow-1-strong" style="border-radius: 8px; background-color: #ffffff; color:#687a8a;">
                        <div class="card-body p-4">
                            <h2 class="mb-4 text-center"> LOGIN </h2>
                            <h4 class="mb-0 "> Adventure starts here &#128640 </h4>
                            <p> Make your app management easy and fun! </p>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
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
                                {{-- <div class="form-check d-flex justify-content mb-4">
                                    <input type="checkbox" name="remember" class="form-check-input me-2" value=""
                                        id="form1Example3" />
                                    <label for="form1Example3" class="form-check-label">I agree to <span
                                            style="color: #0b5ed7">privacy policy & terms</span> </label>
                                </div> --}}
                                <div class="form-check d-flex justify-content mb-4">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember" style="margin-left: 7px;">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                <div class="d-grid col-12 mx-auto">
                                    <button class="btn btn-primary" id="registerButton" type="submit">Login</button>
                                </div>
                                <p class="text-center pt-3">I don't have account? <a href="{{ route('register') }}"
                                        style="text-decoration: none;"> Register </a> </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
