<?php

namespace App\Http\Controllers\ClinicUser\RegisterPatient;

use App\Http\Controllers\ClinicUser\Services;
use App\Http\Controllers\Controller;
use App\Models\AnimalProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory_items;
use App\Models\Inventory_stock;
use App\Models\Inventory_usage;
use App\Models\Inventory_units;
use App\Models\ClinicUser;
use App\Models\Patient;
use App\Models\ClinicServices;
use App\Models\ClinicServicesSchedules;
use App\Models\ClinicTransactions;
use App\Models\ClinicUserLogs;
use App\Models\PatientExposures;
use App\Models\PatientImmunizations;
use App\Models\PatientImmunizationsSchedule;
use App\Models\PatientPrevAntiRabies;
use App\Models\PatientPrevAntiTetanus;
use App\Models\PatientVitalSigns;
use App\Models\PaymentRecords;
use Carbon\Carbon;

use App\Http\Requests\RegisterPatientPEPRequest;
use App\Models\Inventory;

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

        $recentlyAddedPatients = Patient::orderBy('created_at', 'desc')->first();

        return view('ClinicUser.RegisterPatient.register-pep', compact('clinicUser', 'antiTetanusVaccines', 'pvrvVaccines', 'pcecVaccines', 'erigVaccines', 'hrigVaccines', 'nurses', 'staffs','service_fee', 'recentlyAddedPatients'));
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


    public function registerPatientPEP(RegisterPatientPEPRequest  $request)
    {
        $request->validated();

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
       $patientVitalSigns = PatientVitalSigns::create([
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

       $patientExposure = PatientExposures::create([
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

        PatientPrevAntiTetanus::create([
            'patient_id' => $patient->id,
            'dose_brand' => "Anti-Tetanus",
            'dose_given' => $request->anti_tetanus_dose_given,
            'date_dose_given' => $request->anti_tetanus_date_dose_given,
            'rn_in_charge' => $request->nurse_id,
            'year_last_dose_given' => $request->year_last_dose_given,
        ]);

        if ($request->immunization_type && $request->place_of_immunization && $request->date_dose_given != null){
            PatientPrevAntiRabies::create([
                'patient_id' => $patient->id,
                'immunization_type' => $request->immunization_type,
                'place_of_immunization' => $request->place_of_immunization,
                'date_dose_given' => $request->date_dose_given,
            ]);
        }
  
            // 1. Generate all schedules
            $serviceSchedules = ClinicServicesSchedules::where('service_id', 1)->get();
            $patientSchedules = collect(); // will hold all created schedules

            foreach ($serviceSchedules as $serviceSchedule) {
               $scheduledDate = Carbon::parse($request->date_of_registration)
                            ->addDays($serviceSchedule->day_offset)
                            ->format('Y-m-d');

            // Determine if this is the "Day 0" schedule
            $isDay0 = $serviceSchedule->day_offset == 0;

                $patientSchedules->push(
                    PatientImmunizationsSchedule::create([
                        'patient_id'       => $patient->id,
                        'transaction_id'   => $transaction->id,
                        'service_id'      =>  1,
                        'service_sched_id' => $serviceSchedule->id,
                        'Day'              => $serviceSchedule->label,
                        'grouping'         => $transaction->id,
                        'scheduled_date'   => $scheduledDate,
                        'date_completed'   => $isDay0 ? $scheduledDate : null, // initially not completed
                        'dose'             => $isDay0 ? 0.2 : null, // default dose
                        'status'           => $isDay0 ? 'Completed' : 'Pending',
                        'administered_by'  => $isDay0 ? $request->nurse_id : null,
                    ])
                );
            }

        // 2. Grab the first schedule (Day 0)
        $firstSchedule = $patientSchedules->first();


        $paymentRecord = PaymentRecords::create([
            'patient_id' => $patient->id,
            'transaction_id' => $transaction->id,
            'receipt_number' => date('Y') . '-' . str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT),
            'payment_date' => $request->dateOfTransaction,
            'amount_paid' => $request->total_amount,
            'received_by_id' => $request->staff_id,
        ]);

        //immunization record
        PatientImmunizations::create([
            'patient_id' => $patient->id,
            'transaction_id' => $transaction->id,
            'service_id' => 1,
            'exposure_id' => $patientExposure->id,
            'vital_signs_id' => $patientVitalSigns->id,
            'immunization_type' => $request->pep_immunization_type,
            'date_given' => $request->date_of_registration,
            'day_label' =>  'D0',
            'vaccine_used_id' => $request->active_vaccine_category == 'PVRV'
                ? ($request->pvrv_vaccine_id ?? null)
                : ($request->pcec_vaccine_id ?? null),
            'rig_used_id' => $request->passive_rig_category == 'ERIG'
                ? ($request->erig_vaccine_id ?? null)
                : ($request->hrig_vaccine_id ?? null),
            'anti_tetanus_id' => $request->anti_tetanus_vaccine_id ?? null,
            'route_of_administration' => $request->route_of_administration,
            'administered_by_id' => $request->nurse_id,
            'payment_id' => $paymentRecord->id,
            'schedule_id' => $firstSchedule?->id, // <-- links to the first schedule
            'status' => 'Completed',
        ]);

        ClinicUserLogs::insert([
            [
                'user_id' => $request->nurse_id,
                'role_id' => 2,
                'action' => 'Administered PEP to patient',
                'details' => 'Administered PEP to patient ' . $patient->first_name . ' ' . $patient->last_name,
                'date_and_time' => now(),
                'created_at' => now(),
            ],
            [
                'user_id' => $request->staff_id,
                'role_id' => 3,
                'action' => 'Handled payment for PEP patient',
                'details' => 'Handled payment for PEP patient ' . $patient->first_name . ' ' . $patient->last_name,
                'date_and_time' => now(),
                'created_at' => now(),
            ],
        ]);

        Inventory_usage::insert([
            [
            'unit_id' => $request->anti_tetanus_vaccine_id,
            'used' => 0.5,
            'measurement_unit' => 'ml',
            'usage_date' => now(),
            'used_by' => $request->nurse_id,
            'details' => 'Used for Anti-Tetanus vaccination for patient ' . $patient->first_name . ' ' . $patient->last_name,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'unit_id' => $request->active_vaccine_category == 'PVRV'
                    ? ($request->pvrv_vaccine_id ?? null)
                    : ($request->pcec_vaccine_id ?? null),
            'used' => 0.2,
            'measurement_unit' => 'ml',
            'usage_date' => now(),
            'used_by' => $request->nurse_id,
            'details' => 'Used for Rabies vaccination for patient ' . $patient->first_name . ' ' . $patient->last_name,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'unit_id' => $request->passive_rig_category == 'ERIG'
                    ? ($request->erig_vaccine_id ?? null)
                    : ($request->hrig_vaccine_id ?? null),
            'used' => $request->passive_dose_given ?? 0,
            'measurement_unit' => 'ml',
            'usage_date' => now(),
            'used_by' => $request->nurse_id,
            'details' => 'Used for RIG administration for patient ' . $patient->first_name . ' ' . $patient->last_name,
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);

    




        return redirect()->route('clinic.patients.register.pep')->with('success', 'Patient registered successfully.');

    }  






}
