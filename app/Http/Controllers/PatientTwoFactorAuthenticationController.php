<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Mail\TwofactorCodeMail;


class PatientTwoFactorAuthenticationController extends Controller
{
    // Show the two-factor authentication form
    public function index($id){
        try {
            $decryptedId = Crypt::decryptString($id);
            $User = User::where('id', $decryptedId)->firstOrFail(); 
            
            return view('auth.patient_two-factor',compact('User'));

        } catch (\Exception $e) {
            abort(404, 'Invalid or expired link.');
        }
    }

    
    // function to send the verification code
    public function send_code(Request $request){

        $request->validate([
            'email' => 'required|string',
        ]);

        $User = User::where('email', $request->input('email'))->first();

        if ($User) {
            $verificationCode = rand(100000, 999999);

            User::where('id', $User->id)
                ->update(['two_factor_code' => Crypt::encryptString($verificationCode)]);


            Mail::to($User->email)->send(new TwofactorCodeMail($verificationCode));

            // Mail::raw("Your verification code is: $verificationCode", function ($message) use ($clinicUser) {
            //     $message->to($clinicUser->email);
            //     $message->subject('Two-Factor Authentication Code');
            // });

            $encryptedId = Crypt::encryptString($User->id);

            return redirect()->route('patient.two-factor', ['id' => $encryptedId]);
        }

        return back()->withErrors(['email' => 'This email address is not registered.']);
    }

    // function to verify the code
    public function verify(Request $request){
        $request->validate([
            'email' => 'required|string',
            'code' => 'required|integer|digits:6',
        ]);

        $User = User::where('email', $request->input('email'))->first();

        if ($User) {
            try {
                $decryptedCode = Crypt::decryptString($User->two_factor_code);

                if ($decryptedCode == $request->input('code')) {
                    $encryptedId = Crypt::encryptString($User->id);

                    return redirect()->route('patient.update-password', ['id' => $encryptedId]);
                }
            } catch (\Exception $e) {
                return back()->withErrors(['code' => 'Verification code error.']);
            }
        }
        // Code is invalid
        return back()->withErrors(['code' => 'Invalid verification code.']);
    }

    
}
