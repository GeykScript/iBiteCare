<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Redirect to OAuth provider
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle OAuth callback
     */
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            // Check if already exists
            $user = User::where('auth_provider', $provider)
                        ->where('auth_provider_id', $socialUser->id)
                        ->first();

            if ($user) {
                Auth::login($user);
                session(['auth_provider' => $provider]);
                return redirect()->route('dashboard');
            }

            // If not existing -> store social data in session
            session([
                'auth_provider'    => $provider,
                'auth_provider_id' => $socialUser->id,
                'social_name'      => $socialUser->name,
                'social_email'     => $socialUser->email,
            ]);

            // Redirect to password setup without saving user yet
            return redirect()->route('set.password');

        } catch (Exception $e) {
            Log::error('OAuth callback error', [
                'provider' => $provider,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('login')->with('error', 'Authentication failed. Please try again.');
        }
    }
}
