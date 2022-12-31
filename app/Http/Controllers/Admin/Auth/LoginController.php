<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.guest:admin')->except('logout');
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin.auth.login', [
            'title' => 'Admin Login',
            'loginRoute' => 'login',
            'forgotPasswordRoute' => 'password.request',
        ]);
    }

    /**
     * Login the admin.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $this->validator($request);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Authentication passed...

            // update login time
            // Admin::updateTime();

            return redirect()
                ->route('dashboard')
                ->with('status', 'You are Logged in as Admin!');
        } else {
            // Search using username
            if (Auth::guard('admin')->attempt(['username' => $request->email, 'password' => $request->password], $request->remember)) {
                session()->flash('success', 'Successully Logged in !');
                return redirect()->route('dashboard');
            }
            // update login time
            // Admin::updateTime();

            return redirect()
                ->route('dashboard')
                ->with('status', 'You are Logged in as Admin!');
        }

        // Authentication failed...
        return $this->loginFailed();
    }

    /**
     * Logout the admin.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()
            ->route('login')
            ->with('status', 'Admin has been logged out!');
    }

    /**
     * Validate the form data.
     */
    private function validator(Request $request)
    {
        // validation rules.
        $rules = [
            'email' => 'required|email|exists:admins|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        // custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];

        // validate the request.
        $request->validate($rules, $messages);
    }

    /**
     * Redirect back after a failed login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginFailed()
    {
        throw ValidationException::withMessages(['email' => [trans('auth.failed')]]);
    }
}
