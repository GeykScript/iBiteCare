<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClinicUser;
use App\Models\ClinicTransactions;

class DashboardController extends Controller
{
    public function index(){

        $clinicUser = Auth::guard('clinic_user')->user();

        $clinic_transactions = ClinicTransactions::orderBy('transaction_date', 'desc')
            ->take(10)
            ->get();        
        
            $today_clinic_transactions = ClinicTransactions::whereDate('transaction_date', now()->toDateString())->count();

        return view('ClinicUser.dashboard', compact('clinicUser', 'clinic_transactions', 'today_clinic_transactions'));
    }
}
