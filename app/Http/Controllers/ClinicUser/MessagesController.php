<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Auth;


class MessagesController extends Controller
{
    public function index()
    {
        $clinicUser = Auth::guard('clinic_user')->user();


        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to access the patients list.');
        }
        return view('ClinicUser.messages', compact('clinicUser'));
    }
}
