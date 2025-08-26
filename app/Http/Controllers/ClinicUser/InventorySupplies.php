<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventorySupplies extends Controller
{
    //
    public function index(){

        $clinicUser = Auth::user();
        return view('ClinicUser.supplies', compact('clinicUser'));
    }
}
