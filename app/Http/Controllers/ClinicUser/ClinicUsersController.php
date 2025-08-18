<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClinicUser;
use Illuminate\Support\Facades\Auth;



class ClinicUsersController extends Controller
{
    public function index(){

        $clinicUser = Auth::guard('clinic_user')->user();

        return view('ClinicUser.user-accounts',compact('clinicUser'));
    }
}
