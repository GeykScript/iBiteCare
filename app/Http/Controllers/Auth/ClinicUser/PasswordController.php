<?php

namespace App\Http\Controllers\Auth\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use App\Models\ClinicUser;


//clinic user update password controller
class PasswordController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $clinicUser = Auth::guard('clinic_user')->user();

        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password:clinic_user'],
            'password' => ['required', 'confirmed',
                Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
            ],
        ]);

        ClinicUser::where('id', $clinicUser->id)
            ->update([
                'password' => Hash::make($validated['password']),
            ]);

        return back()->with('status', 'password-updated');
    }
}
