<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClinicTransactions;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwofactorCodeMail;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf;

class PatientSchedules extends Controller
{

    public function index(){

        $user = Auth::user();
        $patient = Patient::where('account_id', $user->id)->first();

        if (!$patient) {
            return redirect()->route('schedules.verifyForm')->with('error', 'No patient record found. Please verify your account.');
        }

        $transactions2 = ClinicTransactions::with(['patient', 'service', 'paymentRecords', 'immunizations', 'patientExposures', 'patientSchedules'])
            ->where('patient_id', $patient->id)
            ->orderBy('transaction_date', 'asc')
            ->get()
            ->groupBy('grouping')
            ->map(function ($group) {
                $first = $group->first();
                // merge all schedules from this grouping
                $first->allSchedules = $group->flatMap->patientSchedules;
                return $first;
            })
            ->sortByDesc('transaction_date');

        return view('auth.schedules', compact('user', 'transactions2'));
    }

    public function showVerificationForm(){
        $user = Auth::user();
        return view('auth.schedules-verify', compact('user'));
    } 

    public function pdfVaccinationCard($id, $grouping)
    {
        $patient = Patient::find($id);
        $transactions2 = ClinicTransactions::with(['patient', 'service', 'paymentRecords', 'immunizations', 'patientExposures', 'patientSchedules'])
            ->where('patient_id', $id)
            ->where('id', $grouping)
            ->orderBy('transaction_date', 'asc')
            ->get()
            ->groupBy('grouping')
            ->map(function ($group) {
                $first = $group->first();
                // merge all schedules from this grouping
                $first->allSchedules = $group->flatMap->patientSchedules;
                return $first;
            })
            ->sortByDesc('transaction_date');

        $pdf = Pdf::loadView('ClinicUser.pdf.pdf-vaccination-card', compact('transactions2'))
            ->setPaper([0, 0, 612, 936], 'portrait');

        $fileName = 'Vaccination_Card_' . $patient->first_name . '_' . $patient->last_name . '.pdf';
        return $pdf->stream($fileName);
    }


    public function sendOtpEmail(Request $request){
        $request->validate([
            'id' => 'required|integer',
            'email' => 'required|email',
        ]);


        $verificationCode = rand(100000, 999999);

        User::where('id', $request->input('id'))
        ->where('email', $request->input('email'))
            ->update(['two_factor_code' => Crypt::encryptString($verificationCode)]);


        $patient = Patient::where('email', $request->input('email'))->first();
        if ($patient) {
            $patient->update(['two_factor_code' => Crypt::encryptString($verificationCode)]);
        }else
        {
            return back()->withErrors(['email' => 'This email is not registered in our system. Please use the email from last transaction.']);
        }


        Mail::to($request->input('email'))->send(new TwofactorCodeMail($verificationCode));


        return back()->with('success', 'OTP has been sent to your email.');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'email' => 'required|email',
            'code' => 'required|integer',
        ]);

        $patient = Patient::where('email', $request->input('email'))->first();
        $user = User::where('id', $request->input('id'))->first();

        if (!$patient || !$user) {
            return back()->withErrors(['error' => 'Invalid user or patient.']);
        }

        try {
            $patientCode = Crypt::decryptString($patient->two_factor_code);
            $userCode = Crypt::decryptString($user->two_factor_code);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Invalid or expired OTP.']);
        }

        if ($patientCode == $userCode && $userCode == $request->input('code')) {
            $patient->update(['account_id' => $user->id]);
            return redirect()->route('schedules.index')->with('success', 'Account verified successfully.');
        }

        return back()->withErrors(['error' => 'Incorrect OTP.']);
    }
}
