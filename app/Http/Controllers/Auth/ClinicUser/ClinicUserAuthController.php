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

        return redirect()->intended(route('clinic.dashboard', absolute: false));
    }


}
