<?php

namespace App\Http\Controllers\Auth\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClinicUserLoginRequest;
use Illuminate\Http\RedirectResponse;

class ClinicUserAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.ClinicUser.clinic_user-login');
    }

    public function store(ClinicUserLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        //return redirect()->intended('/clinic/dashboard');
        return redirect()->intended(route('ClinicUser.dashboard', absolute: false));
    }
    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::guard('clinic_user')->attempt($credentials)) {
    //         $request->session()->regenerate();
    //         return redirect()->intended('/clinic/dashboard');
    //     }

    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ]);
    // }

}
