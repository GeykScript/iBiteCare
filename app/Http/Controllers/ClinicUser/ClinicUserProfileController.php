<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClinicUserProfileController extends Controller
{
    //
    public function index()
    {
        $clinicUser = Auth::guard('clinic_user')->user();

        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to access your profile.');
        }

        return view('ClinicUser.userprofile', compact('clinicUser'));
    }
}
