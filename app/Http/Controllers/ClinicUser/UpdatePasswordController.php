<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClinicUser;
use Illuminate\Support\Facades\Crypt;


// Update Password Controller for forgot password
class UpdatePasswordController extends Controller
{
    // Show the update password form
    public function updatePasswordForm($id)
    {
        try {
            // Decrypt the ID
            $decryptedId = Crypt::decryptString($id);

            $clinicUser = ClinicUser::where('id', $decryptedId)->firstOrFail();

            return view('auth.ClinicUser.update-password', compact('clinicUser'));
        } catch (\Exception $e) {
            abort(404, 'Invalid or expired link.');
        }
    }

    // Update the password
    public function updatePassword(Request $request){
        $request->validate([
            'account_id' => 'required|string',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[!@#$%^&*(),.?":{}|<>]/', // requires at least one symbol
                'regex:/[0-9]/',                   // requires at least one number
            ],
        ], [
            'password.regex' => 'The password must contain at least one number and one special character.',
        ]);


        $clinicUser = ClinicUser::where('account_id', $request->input('account_id'))->first();

        if ($clinicUser) {
            $clinicUser->password = bcrypt($request->input('password'));
            $clinicUser->save();

            return redirect()->route('clinic.login')->with('status', 'Password updated successfully.');
        }

        return back()->withErrors(['account_id' => 'Invalid account ID.']);
    }

}   
