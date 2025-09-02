<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;

class PatientsController extends Controller
{
    public function index(){

        $clinicUser = Auth::guard('clinic_user')->user();

        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to access the patients list.');
        }

        return view('ClinicUser.patients', compact('clinicUser'));
    }


    public function viewProfile($id){
        $clinicUser = Auth::guard('clinic_user')->user();

        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to view patient profiles.');
        }

        $patient = Patient::find($id);

        if (!$patient) {
            return redirect()->route('clinic.patients')->with('error', 'Patient not found.');
        }

        return view('ClinicUser.patients-profile', compact('clinicUser', 'patient'));
    }


}



