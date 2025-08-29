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
            
            // Log for debugging
            Log::info('OAuth callback hit', ['provider' => $provider]);
            
            $socialUser = Socialite::driver($provider)->user();

            
            Log::info('Social user data', [
                'provider' => $provider,
                'email' => $socialUser->email,
                'name' => $socialUser->name
            ]);

            // Check if user exists with this provider ID
            $user = User::where('auth_provider', $provider)
                    ->where('auth_provider_id', $socialUser->id)
                    ->first();

            if ($user) {
                Auth::login($user);
            } else {
                // Check by email
                $existingUser = User::where('email', $socialUser->email)->first();

                if ($existingUser) {
                    $existingUser->update([
                        'auth_provider'    => $provider,
                        'auth_provider_id' => $socialUser->id,
                    ]);
                    Auth::login($existingUser);
                } else {
                    $userData = User::create([
                        'name'             => $socialUser->name,
                        'email'            => $socialUser->email,
                        'password'         => Hash::make('Password1234'),
                        'auth_provider'    => $provider,
                        'auth_provider_id' => $socialUser->id,
                    ]);
                    Auth::login($userData);
                    Log::info('New user created and logged in', ['user_id' => $userData->id]);
                }
            }
            return redirect()->route('dashboard');

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