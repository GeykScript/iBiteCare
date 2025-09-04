<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Patient;
use App\Models\PatientPrevAntiTetanus;
use App\Models\PatientPrevAntiRabies;

class PatientsController extends Controller
{
    public function index(){

        $clinicUser = Auth::guard('clinic_user')->user();

        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to access the patients list.');
        }

        return view('ClinicUser.patients', compact('clinicUser'));
    }



    public function viewProfile($id){
        $clinicUser = Auth::guard('clinic_user')->user();

        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to view patient profiles.');
        }

        $patient = Patient::find($id);

        if (!$patient) {
            return redirect()->route('clinic.patients')->with('error', 'Patient not found.');
        }

        $previousAntiTetanus = PatientPrevAntiTetanus::where('patient_id', $id)->get();
        $previousAntiRabies = PatientPrevAntiRabies::where('patient_id', $id)->get();

        return view('ClinicUser.patients-profile', compact('clinicUser', 'patient', 'previousAntiTetanus', 'previousAntiRabies'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'id'             => 'required|integer',
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'middle_initial' => 'nullable|string|max:10',
            'suffix'         => 'nullable|string|max:50',
            'contact_number' => 'required|string|max:20',
            'province'       => 'nullable|string|max:255',
            'city'           => 'nullable|string|max:255',
            'barangay'       => 'nullable|string|max:255',
            'description'    => 'nullable|string|max:500',
        ]);

        // Handle suffix formatting
        $suffix = null;
        if ($request->suffix) {
            $suffix = strtoupper($request->suffix);
            if (in_array($suffix, ['JR', 'SR'])) {
                $suffix = Str::ucfirst(Str::lower($suffix)) . '.'; // Jr. / Sr.
            } elseif (preg_match('/^[IVX]+$/', $suffix)) {
                $suffix = $suffix; // Roman numeral suffix
            } else {
                $suffix = Str::ucfirst(Str::lower($suffix));
            }
        }

        $patient_user = Patient::findOrFail($request->id);

        // Build address
        if (
            empty($request->barangay) &&
            empty($request->city) &&
            empty($request->province) &&
            empty($request->description)
        ) {
            $address = $patient_user->address; // keep old address
        } else {
            $parts = array_filter([
                $request->barangay,
                $request->city,
                $request->province,
                $request->description,
            ]);
            $address = implode(', ', $parts);
        }

        // Format new values
        $newUserData = [
            'first_name'     => Str::title(Str::lower($request->first_name)),
            'last_name'      => Str::title(Str::lower($request->last_name)),
            'middle_initial' => Str::upper($request->middle_initial),
            'suffix'         => $suffix,
            'contact_number' => $request->contact_number,
            'address'        => $address,
        ];

        // Old user data
        $oldUserData = $patient_user->only(array_keys($newUserData));

        // Check if any changes exist
        if ($oldUserData == $newUserData) {
            return redirect()
                ->route('clinic.patients.profile', ['id' => $patient_user->id])
                ->with('profile-success', 'No changes made.');
        }

        // Perform updates
        $patient_user->update($newUserData);

        return redirect()
            ->route('clinic.patients.profile', ['id' => $patient_user->id])
            ->with('profile-success', 'User account updated successfully!');
    }
}



