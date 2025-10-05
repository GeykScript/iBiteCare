<?php

namespace App\Http\Controllers\ClinicUser\RegisterPatient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\ClinicUser;
use App\Models\Inventory_units;
use App\Models\ClinicServices;
use App\Models\Patient;
use App\Models\ClinicTransactions;
use App\Models\PatientVitalSigns;
use App\Models\ClinicServicesSchedules;
use App\Models\PatientImmunizationsSchedule;
use App\Models\PatientImmunizations;
use App\Models\PaymentRecords;
use App\Models\ClinicUserLogs;
use App\Models\Inventory_usage;
use App\Models\PatientPrevAntiRabies;
use App\Http\Requests\RegisterPatientBoosterRequest;


class BoosterRegistration extends Controller
{
    public function showForm($id)
    {
        $clinicUser = Auth::guard('clinic_user')->user();

        $pvrvVaccines = Inventory_units::whereHas('item', function ($query) {
            $query->where('product_type', 'PVRV');
        })->where('status', '!=', 'used')->get();
        $pcecVaccines = Inventory_units::whereHas('item', function ($query) {
            $query->where('product_type', 'PCEC');
        })->where('status', '!=', 'used')->get();


        $nurses = ClinicUser::where('role', 2)
            ->where('is_disabled', '!=', 1)
            ->get();
        $staffs = ClinicUser::where('role', '=', 3)
            ->where('is_disabled', '!=', 1)
            ->get();

        $service_fee = ClinicServices::where('id', $id)->first();

        $boosterService = $id;


        $recentlyAddedPatients = Patient::orderBy('created_at', 'desc')->first();

        return view('ClinicUser.RegisterPatient.register-booster', compact('clinicUser', 'pvrvVaccines', 'pcecVaccines', 'nurses', 'staffs', 'service_fee', 'boosterService', 'recentlyAddedPatients'));
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

    public function registerPatientBooster(RegisterPatientBoosterRequest $request){
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
            'service_id'       => $request->service_id,
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

        if ($request->immunization_type && $request->place_of_immunization && $request->date_dose_given != null) {
            PatientPrevAntiRabies::create([
                'patient_id' => $patient->id,
                'immunization_type' => $request->immunization_type,
                'place_of_immunization' => $request->place_of_immunization,
                'date_dose_given' => $request->date_dose_given,
            ]);
        }


        // 1. Generate all schedules
        $serviceSchedules = ClinicServicesSchedules::where('service_id', $request->service_id)->get();
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
                    'service_id'      =>  $request->service_id,
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
            'service_id' => $request->service_id,
            'exposure_id' => null,
            'vital_signs_id' => $patientVitalSigns->id,
            'immunization_type' => 'Active',
            'date_given' => $request->date_of_registration,
            'day_label' =>  'D0',
            'vaccine_used_id' => $request->active_vaccine_category == 'PVRV'
                ? ($request->pvrv_vaccine_id ?? null)
                : ($request->pcec_vaccine_id ?? null),
            'rig_used_id' => null,
            'anti_tetanus_id' => null,
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
                'action' => 'Administered PREP to patient',
                'details' => 'Administered PREP to patient ' . $patient->first_name . ' ' . $patient->last_name,
                'date_and_time' => now(),
                'created_at' => now(),
            ],
            [
                'user_id' => $request->staff_id,
                'role_id' => 3,
                'action' => 'Handled payment for PREP patient',
                'details' => 'Handled payment for PREP patient ' . $patient->first_name . ' ' . $patient->last_name,
                'date_and_time' => now(),
                'created_at' => now(),
            ],
        ]);

        Inventory_usage::insert([
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
        ]);

        // Define vaccine IDs with their respective subtraction amounts
        $vaccines = [];


        //  Active vaccine (PVRV or PCEC)
        if ($request->active_vaccine_category === 'PVRV' && $request->pvrv_vaccine_id) {
            $vaccines[] = [
                'id' => $request->pvrv_vaccine_id,
                'reduce' => 0.2, // default ml to reduce
            ];
        } elseif ($request->active_vaccine_category === 'PCEC' && $request->pcec_vaccine_id) {
            $vaccines[] = [
                'id' => $request->pcec_vaccine_id,
                'reduce' => 0.2, // default ml to reduce
            ];
        }

        //  Update each unit
        foreach ($vaccines as $vaccine) {
            $unit = Inventory_units::find($vaccine['id']);

            if ($unit) {
                $newVolume = max(0, $unit->remaining_volume - $vaccine['reduce']); // prevent negative
                $unit->update([
                    'status' => $newVolume == 0 ? 'Used' : 'Opened',
                    'remaining_volume' => $newVolume,
                ]);
            }
        }


        $id = $request->service_id;
        return redirect()->route('clinic.patients.register.booster', ['id' => $id])->with('success', 'Patient registered successfully!');

    }


}
