<?php

namespace App\Http\Controllers\ClinicUser\RegisterPatient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory_items;
use App\Models\Inventory_stock;
use App\Models\Inventory_units;

class PepRegistration extends Controller
{
    public function showForm()
    {
        $clinicUser = Auth::guard('clinic_user')->user();

        $antiTetanusVaccines = Inventory_units::whereHas('item', function ($query) {
            $query->where('category', 'Anti-Tetanus');  
        })->where('status', '!=', 'used')->get();

        $pvrvVaccines = Inventory_units::whereHas('item', function ($query) {
            $query->where('product_type', 'PVRV');  
        })->where('status', '!=', 'used')->get();
        $pcecVaccines = Inventory_units::whereHas('item', function ($query) {
            $query->where('product_type', 'PCEC');  
        })->where('status', '!=', 'used')->get();
        $erigVaccines = Inventory_units::whereHas('item', function ($query) {
            $query->where('product_type', 'ERIG');  
        })->where('status', '!=', 'used')->get();
        $hrigVaccines = Inventory_units::whereHas('item', function ($query) {
            $query->where('product_type', 'HRIG');  
        })->where('status', '!=', 'used')->get();


        return view('ClinicUser.RegisterPatient.register-pep', compact('clinicUser', 'antiTetanusVaccines', 'pvrvVaccines', 'pcecVaccines', 'erigVaccines', 'hrigVaccines'));
    }
}
