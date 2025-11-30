<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Patient;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // get email to link patient record
        $inputEmail = $request->input('email');
        // Link patient record to user account if email matches 

        $patient = Patient::where('email', $inputEmail)->first();
        $user = User::where('email', $inputEmail)->first();

        if ($patient && $user && $patient->email === $user->email && empty($patient->account_id)) {
            $patient->update(['account_id' => $user->id]);
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

       // $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
