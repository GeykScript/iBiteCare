<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;


class PatientUpdatePasswordController extends Controller
{
    // Show the update password form
    public function updatePasswordForm($id)
    {
        try {
            // Decrypt the ID
            $decryptedId = Crypt::decryptString($id);

            $User = User::where('id', $decryptedId)->firstOrFail();

            return view('auth.patient_update-password', compact('User'));
        } catch (\Exception $e) {
            abort(404, 'Invalid or expired link.');
        }
    }

    // Update the password
    public function updatePassword(Request $request){
        $request->validate([
            'email' => 'required|string',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[0-9])(?=.*[^A-Za-z0-9]).+$/',
            ],
        ], [
            'password.regex' => 'The password must contain at least one number and one special character.',
        ]);


        $User = User::where('email', $request->input('email'))->first();

        if ($User) {
            $User->password = bcrypt($request->input('password'));
            $User->save();

            return redirect()->route('login')->with('status', 'Password updated successfully.');
        }

        return back()->withErrors(['email' => 'Invalid email address.']);
    }

}   
