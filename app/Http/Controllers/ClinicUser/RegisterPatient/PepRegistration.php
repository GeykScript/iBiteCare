<?php

namespace App\Http\Controllers\ClinicUser\RegisterPatient;

use App\Http\Controllers\ClinicUser\Services;
use App\Http\Controllers\Controller;
use App\Models\AnimalProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory_items;
use App\Models\Inventory_stock;
use App\Models\Inventory_units;
use App\Models\ClinicUser;
use App\Models\Patient;
use App\Models\ClinicServices;
use App\Models\ClinicTransactions;
use App\Models\PatientExposures;
use App\Models\PatientVitalSigns;
use Carbon\Carbon;

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
        $staffs = ClinicUser::where('role', '=', 3)
            ->where('is_disabled', '!=', 1)
            ->get();

        $service_fee = ClinicServices::where('id', 1)->first();

        return view('ClinicUser.RegisterPatient.register-pep', compact('clinicUser', 'antiTetanusVaccines', 'pvrvVaccines', 'pcecVaccines', 'erigVaccines', 'hrigVaccines', 'nurses', 'staffs','service_fee'));
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


    public function registerPatientPEP(Request $request)
    {
        $request->validate([
            // Step 1: Personal Details
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_initial' => 'required|string|max:2',
            'suffix' => 'nullable|string|max:4',
            'date_of_registration' => 'required|date',

            'region' => 'string|max:255',
            'province' => 'string|max:255',
            'city' => 'string|max:255',
            'barangay' => 'string|max:255',
            'description' => 'string|max:255',
            
            'contact_number' => 'required|string|max:13',   
            'sex' => 'string|max:255',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer|min:0',

            'temperature' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'blood_pressure' => 'nullable|string|max:255',

           // Step 2: Exposure Details
            'date_of_bite' => 'required|date',
            'time_of_bite' => 'required|date_format:H:i',
            'location_of_incident' => 'nullable|string|max:255',
            'exposure' => 'required|in:Bite,Non-Bite',
            'selectedPart' => 'required|string|max:255',
            'bite_category' => 'required|integer',
            'bite_management' => 'nullable|string|max:255',

            // Step 3: Animal Profile
            'species' => 'required|string|max:255',
            'clinical_status' => 'required|in:Healthy,Sick,Died,Killed,Lost',
            'ownership_status' => 'required|in:Owned,Neighbor,Stray',
            'brain_exam' => 'nullable|string|max:255',
            'brain_exam_location' => 'nullable|string|max:255',
            'brain_exam_results' => 'nullable|string|max:255',

            // Step 4: A. Previous Anti-Tetanus Vaccination


        ]);

        // Combine address fields into a single address string
        $address = $request->province . ', ' . $request->city . ', ' . $request->barangay . ', ' . $request->description;

        // Create new Patient record
        $patient = Patient::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_initial' => $request->middle_initial,
            'suffix' => $request->suffix,
            'birthdate' => $request->date_of_birth,
            'age' => $request->age,
            'sex' => $request->sex,
            'registration_date' => $request->date_of_registration,
            'address' => $address,
            'contact_number' => $request->contact_number,
        ]);

        // Create new ClinicTransaction record
        $transaction = ClinicTransactions::create([
            'patient_id'       => $patient->id,
            'service_id'       => 1,
            'transaction_date' => $request->date_of_registration,
        ]);
        // Update the grouping field with the transaction's own ID
        ClinicTransactions::where('id', $transaction->id)
            ->update(['grouping' => $transaction->id]);

        // Create new PatientVitalSigns record
        PatientVitalSigns::create([
            'patient_id' => $patient->id,
            'transaction_id' => $transaction->id,
            'recorded_date' => $request->date_of_registration,
            'temperature' => $request->temperature,
            'weight' => $request->weight,
            'blood_pressure' => $request->blood_pressure,
        ]);

        // Create new AnimalProfile record
       $animalProfile = AnimalProfile::create([
            'species' => $request->species,
            'clinical_status' => $request->clinical_status,
            'ownership_status' => $request->ownership_status,
            'brain_exam' => $request->brain_exam,
            'brain_exam_location' => $request->brain_exam_location,
            'brain_exam_results' => $request->brain_exam_results,             
        ]);


        $dateTimeOfBite = Carbon::parse(
            $request->date_of_bite . ' ' . $request->time_of_bite
        );

        // Create new PatientExposures record
       PatientExposures::create([
            'patient_id' => $patient->id,
            'transaction_id' => $transaction->id,
            'date_time' =>  $dateTimeOfBite,
            'place_of_bite' => $request->location_of_incident,
            'type_of_exposure' => $request->exposure,
            'site_of_bite' => $request->selectedPart,
            'bite_category' => $request->bite_category,
            'bite_management' => $request->bite_management,
            'animal_profile_id' => $animalProfile->id
        ]);



        return redirect()->route('clinic.patients.register.pep')->with('success', 'Patient registered successfully.');

    }  






}
