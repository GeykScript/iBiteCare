<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

class PatientTransactionsController extends Controller
{
    //
    public function index($id){
        $clinicUser = auth()->guard('clinic_user')->user();

        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to access patient transactions.');
        }

        $patient = Patient::find($id);

        return view('ClinicUser.patients-transaction', compact('clinicUser', 'patient'));
    }
}
