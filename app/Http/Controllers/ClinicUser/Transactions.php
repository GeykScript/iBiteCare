<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Transactions extends Controller
{
    //
    public function index (){

        $clinicUser = Auth::guard('clinic_user')->user();
        return view('ClinicUser.transactions', compact('clinicUser'));
    }
}
