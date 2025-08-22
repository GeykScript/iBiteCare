<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClinicUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Mail\TwofactorCodeMail;


class TwoFactorAuthenticationController extends Controller
{
    // Show the two-factor authentication form
    public function index($id){
        try {
            $decryptedId = Crypt::decryptString($id);
            $clinicUser = ClinicUser::where('id', $decryptedId)->firstOrFail(); 
            
            return view('auth.ClinicUser.two-factor',compact('clinicUser'));

        } catch (\Exception $e) {
            abort(404, 'Invalid or expired link.');
        }
    }

       
    // function to send the verification code
    public function send_code(Request $request){

        $request->validate([
            'account_id' => 'required|string',
        ]);

        $clinicUser = ClinicUser::where('account_id', $request->input('account_id'))->first();

        if ($clinicUser) {
            $verificationCode = rand(100000, 999999);

            ClinicUser::where('id', $clinicUser->id)
                ->update(['two_factor_code' => Crypt::encryptString($verificationCode)]);


            Mail::to($clinicUser->email)->send(new TwofactorCodeMail($verificationCode));

            // Mail::raw("Your verification code is: $verificationCode", function ($message) use ($clinicUser) {
            //     $message->to($clinicUser->email);
            //     $message->subject('Two-Factor Authentication Code');
            // });

            $encryptedId = Crypt::encryptString($clinicUser->id);

            return redirect()->route('clinic.two-factor', ['id' => $encryptedId]);
        }

        return back()->withErrors(['account_id' => 'This account ID is not registered.']);
    }

    // function to verify the code
    public function verify(Request $request){
        $request->validate([
            'account_id' => 'required|string',
            'code' => 'required|integer|digits:6',
        ]);

        $clinicUser = ClinicUser::where('account_id', $request->input('account_id'))->first();

        if ($clinicUser) {
            try {
                $decryptedCode = Crypt::decryptString($clinicUser->two_factor_code);

                if ($decryptedCode == $request->input('code')) {
                    $encryptedId = Crypt::encryptString($clinicUser->id);

                    return redirect()->route('clinic.update-password', ['id' => $encryptedId]);
                }
            } catch (\Exception $e) {
                return back()->withErrors(['code' => 'Verification code error.']);
            }
        }
        // Code is invalid
        return back()->withErrors(['code' => 'Invalid verification code.']);
    }

    
}
