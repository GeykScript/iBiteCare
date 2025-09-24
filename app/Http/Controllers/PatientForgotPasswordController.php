<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class PatientForgotPasswordController extends Controller
{
    //
    public function showLinkRequestForm(){

        $User = Auth::guard('patient')->user();
        return view('auth.forgot-password');
    }


}