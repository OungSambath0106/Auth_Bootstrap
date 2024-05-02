<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Attempt to log in the user
        if ($this->attemptLogin($request)) {
            // Check if the user is active and not hidden
            if (Auth::user()->ishidden != 1) {
                // User is hidden or inactive
                Auth::logout(); // Log out the user
                return $this->sendFailedLoginResponse($request, 'Your account is inactive.');
            }

            return $this->sendLoginResponse($request);
        }

        // Failed login attempt
        return $this->sendFailedLoginResponse($request, 'These credentials do not match our records.');
    }

    protected function sendFailedLoginResponse(Request $request, $message = null)
    {
        throw ValidationException::withMessages([
            $this->username() => [$message ?: trans('auth.failed')],
        ]);
    }
}
