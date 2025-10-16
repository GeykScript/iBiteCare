<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClinicUser;

class StaffNurseVerificationController extends Controller
{

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

    public function verifyStaff(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|integer',
            'staff_password' => 'required|string',
        ]);

        $staff = ClinicUser::where('id', $request->staff_id)
            ->where('role', '=', 3)
            ->first();

        if (! $staff) {
            return response()->json(['success' => false, 'message' => 'Staff not found.'], 404);
        }

        if (password_verify($request->staff_password, $staff->password)) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Incorrect password.'], 422);
    }
}
