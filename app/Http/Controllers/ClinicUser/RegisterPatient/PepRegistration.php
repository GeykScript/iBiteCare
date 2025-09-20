<?php

namespace App\Http\Controllers\ClinicUser\RegisterPatient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PepRegistration extends Controller
{
    public function showForm()
    {
        $clinicUser = Auth::guard('clinic_user')->user();

        return view('ClinicUser.RegisterPatient.register-pep', compact('clinicUser'));
    }
}
