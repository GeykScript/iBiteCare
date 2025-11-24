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

            Log::info('Social user data', [
                'provider' => $provider,
                'social_id' => $socialUser->id,
                'email' => $socialUser->email,
                'name' => $socialUser->name,
            ]);

            // First, check if user exists with the OAuth provider

            $user = User::where('auth_provider', $provider)
                        ->where('auth_provider_id', $socialUser->id)
                        ->first();

            if ($user) {
                Auth::login($user);
                session(['auth_provider' => $provider]);
                Log::info('Existing OAuth user logged in', ['user_id' => $user->id]);
                return redirect()->route('dashboard');
            }

            // Check if user exists with this email (signed up manually)
            $existingUser = User::where('email', strtolower($socialUser->email))->first();

            if ($existingUser) {
                // User exists with manual registration - link OAuth to existing account
                $existingUser->update([
                    'auth_provider' => $provider,
                    'auth_provider_id' => $socialUser->id,
                ]);

                Auth::login($existingUser);
                session(['auth_provider' => $provider]);
                
                Log::info('Linked OAuth to existing user', [
                    'user_id' => $existingUser->id,
                    'provider' => $provider
                ]);

                return redirect()->route('dashboard');
            }

            // New google sign in user
            session([
                'auth_provider'    => $provider,
                'auth_provider_id' => $socialUser->id,
                'social_name'      => $socialUser->name,
                'social_email'     => strtolower($socialUser->email),
            ]);

            Log::info('Redirecting to set.password for new user');
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