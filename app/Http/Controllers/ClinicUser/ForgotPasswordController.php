<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClinicUser;


class ForgotPasswordController extends Controller
{
    //
    public function showLinkRequestForm(){

        $clinicUser = Auth::guard('clinic_user')->user();
        return view('auth.ClinicUser.forgot-password');
    }

}