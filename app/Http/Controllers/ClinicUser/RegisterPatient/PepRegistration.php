<?php

namespace App\Http\Controllers\ClinicUser\RegisterPatient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory_items;
use App\Models\Inventory_stock;
use App\Models\Inventory_units;
use App\Models\ClinicUser;

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

        $nurses = ClinicUser::where('role', 2)
            ->where('is_disabled', '!=', 1)
            ->get();


        return view('ClinicUser.RegisterPatient.register-pep', compact('clinicUser', 'antiTetanusVaccines', 'pvrvVaccines', 'pcecVaccines', 'erigVaccines', 'hrigVaccines', 'nurses'));
    }


    public function verifyNurse(Request $request)
    {
        $request->validate([
            'nurse_id' => 'required|integer',
            'nurse_password' => 'required|string',
        ]);

        $nurse = ClinicUser::where('id', $request->nurse_id)
            ->where('role', 2)
            ->first();

        if (! $nurse) {
            return response()->json(['success' => false, 'message' => 'Nurse not found.'], 404);
        }

        if (password_verify($request->nurse_password, $nurse->password)) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Incorrect password.'], 422);
    }
}
