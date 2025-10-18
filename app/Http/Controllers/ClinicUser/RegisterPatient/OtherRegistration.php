<?php

namespace App\Http\Controllers\ClinicUser\RegisterPatient;

use App\Http\Controllers\Controller;
use App\Models\ClinicServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClinicUser;
use App\Models\Inventory_units;
use App\Models\Patient;
use App\Models\ClinicTransactions;
use App\Models\PatientVitalSigns;
use App\Models\PatientImmunizations;
use App\Models\PaymentRecords;
use App\Models\ClinicUserLogs;
use App\Models\Inventory_usage;

use App\Http\Requests\RegisterOtherRequest;

class OtherRegistration extends Controller
{
    public function showForm($id)
    {
        $clinicUser = Auth::guard('clinic_user')->user();
        $service_id = $id;

        $services = ClinicServices::where('id', $service_id)->first();

        $vaccines = Inventory_units::whereHas('item', function ($query) use ($service_id) {
            $query->where('service', '=', $service_id);
        })
            ->where('status', '!=', 'Used')
            ->where('status', '!=', 'Disposed')
            ->get();

        $nurses = ClinicUser::where('role', 2)
            ->where('is_disabled', '!=', 1)
            ->get();
        $staffs = ClinicUser::where('role', '=', 3)
            ->where('is_disabled', '!=', 1)
            ->get();
        $recentlyAddedPatients = Patient::orderBy('created_at', 'desc')->first();



        return view('ClinicUser.RegisterPatient.register-other', compact('clinicUser', 'services', 'vaccines', 'nurses', 'staffs', 'recentlyAddedPatients'));
    }

    public function registerPatientOther(RegisterOtherRequest $request){
        $request->validated();

        $date = str_replace('T', ' ', $request->datetime_today);

        $services = ClinicServices::where('id', $request->service_id)->first();

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
            'transaction_date' => $date,
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
            'immunization_type' => $request->immunization_type,
            'date_given' => $request->date_of_registration,
            'day_label' =>  null,
            'vaccine_used_id' => $request->vaccine_id ?? null,
            'rig_used_id' => null,
            'anti_tetanus_id' => null,
            'route_of_administration' => $request->route_of_administration,
            'administered_by_id' => $request->nurse_id,
            'payment_id' => $paymentRecord->id,
            'schedule_id' => null, // <-- links to the first schedule
            'status' => 'Completed',
        ]);

        $nurseClinicRole = ClinicUser::find($request->nurse_id);
        $staffClinicRole = ClinicUser::find($request->staff_id);

        ClinicUserLogs::insert([
            [
                'user_id' => $request->nurse_id,
                'role_id' => $nurseClinicRole->role,
                'action' => 'Administered ' . $services->name . ' to patient',
                'details' => 'Administered ' . $services->name . ' to patient ' . $patient->first_name . ' ' . $patient->last_name,
                'date_and_time' => now(),
                'created_at' => now(),
            ],
            [
                'user_id' => $request->staff_id,
                'role_id' => $staffClinicRole->role,
                'action' => 'Handled payment for ' . $services->name . ' patient',
                'details' => 'Handled payment for ' . $services->name . ' patient ' . $patient->first_name . ' ' . $patient->last_name,
                'date_and_time' => now(),
                'created_at' => now(),
            ],
        ]);

        Inventory_usage::insert([
            [
                'unit_id' => $request->vaccine_id,
                'used' => $request->dose_given,
                'measurement_unit' => 'ml',
                'usage_date' => $date,
                'used_by' => $request->nurse_id,
                'details' => 'Used for ' . $services->name . ' vaccination for patient ' . $patient->first_name . ' ' . $patient->last_name,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Define vaccine IDs with their respective subtraction amounts
        $vaccines = [];

        //  Anti-Tetanus
        if ($request->vaccine_id) {
            $vaccines[] = [
                'id' => $request->vaccine_id,
                'reduce' => $request->dose_given ?? 0, // default ml to reduce
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

        return redirect()->route('clinic.patients.register.other', ['id' => $services->id])->with('success', 'Patient registered successfully.');
    }
}
