<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordSetupController extends Controller
{
    public function showForm()
    {
        return view('auth.set-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $providerData = session()->only([
            'auth_provider', 'auth_provider_id', 'social_name', 'social_email'
        ]);

        if (!$providerData['social_email']) {
            return redirect()->route('login')->with('error', 'Missing social login data.');
        }

        // Create user now
        $user = User::create([
            'name'             => $providerData['social_name'],
            'email'            => $providerData['social_email'],
            'password'         => Hash::make($request->password),
            'auth_provider'    => $providerData['auth_provider'],
            'auth_provider_id' => $providerData['auth_provider_id'],
        ]);

        Auth::login($user);

        // Clear session
        session()->forget(['auth_provider', 'auth_provider_id', 'social_name', 'social_email']);

        return redirect()->route('dashboard')->with('success', 'Password set successfully!');
    }

}
