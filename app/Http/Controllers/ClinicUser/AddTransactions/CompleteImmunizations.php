<?php

namespace App\Http\Controllers\ClinicUser\AddTransactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompleteImmunization;
use Illuminate\Http\Request;
use App\Models\Inventory_units;
use App\Models\ClinicUser;
use App\Models\ClinicServices;
use App\Models\Patient;
use App\Models\PatientImmunizations;
use App\Models\PatientImmunizationsSchedule;
use App\Models\ClinicTransactions;
use App\Models\PatientVitalSigns;
use App\Models\PaymentRecords;
use App\Models\ClinicUserLogs;
use App\Models\Inventory_usage;

class CompleteImmunizations extends Controller
{
    public function index($schedule_id, $service_id, $grouping, $patient_id){
        $clinicUser = auth()->guard('clinic_user')->user();

        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to access patient transactions.');
        }

        $pvrvVaccines = Inventory_units::whereHas('item', function ($query) {
            $query->where('product_type', 'PVRV');
        })->where('status', '!=', 'Used')->where('status', '!=', 'Disposed')->get();
        $pcecVaccines = Inventory_units::whereHas('item', function ($query) {
            $query->where('product_type', 'PCEC');
        })->where('status', '!=', 'Used')->where('status', '!=', 'Disposed')->get();


        $nurses = ClinicUser::where('role', 2)
            ->where('is_disabled', '!=', 1)
            ->get();
        $staffs = ClinicUser::where('role', '=', 3)
            ->where('is_disabled', '!=', 1)
            ->get();

        $service_fee = ClinicServices::where('id', $service_id)->first();
        $patient = Patient::find($patient_id);

        $old_immunization = PatientImmunizations::where('patient_id', $patient_id)
            ->where('service_id', $service_id)
            ->where('transaction_id', $grouping)
            ->first();
        
        $schedules = PatientImmunizationsSchedule::where('id', $schedule_id)
            ->where('patient_id', $patient_id)
            ->where('date_completed', Null )
            ->first();

        return view('ClinicUser.Transactions.complete-immunization', compact('clinicUser', 'schedule_id', 'service_id', 'grouping', 'pvrvVaccines', 'pcecVaccines', 'nurses', 'staffs', 'service_fee', 'patient', 'old_immunization', 'schedules'));
    }




    public function completeImmunization (CompleteImmunization $request)
    {
        $request->validated();

        $date = str_replace('T', ' ', $request->datetime_today);

        $patient = Patient::find($request->patient_id);

        $transaction = ClinicTransactions::create([
            'patient_id'       => $request->patient_id,
            'service_id'       => $request->service_id,
            'transaction_date' => $date,
        ]);
        ClinicTransactions::where('id', $transaction->id)
            ->update(['grouping' => $request->grouping]);

        $patientVitalSigns = PatientVitalSigns::create([
            'patient_id' => $request->patient_id,
            'transaction_id' => $transaction->id,
            'recorded_date' => $request->dateOfTransaction,
            'temperature' => $request->temperature,
            'weight' => $request->weight,
            'blood_pressure' => $request->blood_pressure,
        ]);

        $patientImmunizationSchedule = PatientImmunizationsSchedule::find($request->schedule_id);

        $dayLabel = $patientImmunizationSchedule->Day; // safe now

        $patientImmunizationSchedule->update([
            'date_completed' => $request->dateOfTransaction,
            'dose' => $request->vaccine_dose_given,
            'administered_by' => $request->nurse_id,
            'status' => 'Completed',
        ]);

        $paymentRecord = PaymentRecords::create([
            'patient_id' => $request->patient_id,
            'transaction_id' => $transaction->id,
            'receipt_number' => date('Y') . '-' . str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT),
            'payment_date' => $request->dateOfTransaction,
            'amount_paid' => $request->total_amount,
            'received_by_id' => $request->staff_id,
        ]);


        //immunization record
        PatientImmunizations::create([
            'patient_id' => $request->patient_id,
            'transaction_id' => $transaction->id,
            'service_id' => $request->service_id,
            'exposure_id' => $request->exposure_id ?? null,
            'vital_signs_id' => $patientVitalSigns->id,
            'immunization_type' => $request->immunization_type,
            'date_given' => $request->dateOfTransaction,
            'day_label' => $dayLabel,
            'vaccine_used_id' => $request->active_vaccine_category == 'PVRV'
                ? ($request->pvrv_vaccine_id ?? null)
                : ($request->pcec_vaccine_id ?? null),
            'rig_used_id' => null,
            'anti_tetanus_id' => null,
            'route_of_administration' => $request->route_of_administration,
            'administered_by_id' => $request->nurse_id,
            'payment_id' => $paymentRecord->id,
            'schedule_id' => $request->schedule_id, 
            'status' => 'Completed',
        ]);

        $nurseClinicRole = ClinicUser::find($request->nurse_id);
        $staffClinicRole = ClinicUser::find($request->staff_id);


        ClinicUserLogs::insert([
            [
                'user_id' => $request->nurse_id,
                'role_id' => $nurseClinicRole->role,
                'action' => 'Administered PEP to patient',
                'details' => 'Administered PEP to patient ' . $patient->first_name . ' ' . $patient->last_name,
                'date_and_time' => now(),
                'created_at' => now(),
            ],
            [
                'user_id' => $request->staff_id,
                'role_id' => $staffClinicRole->role,
                'action' => 'Handled payment for PEP patient',
                'details' => 'Handled payment for PEP patient ' . $patient->first_name . ' ' . $patient->last_name,
                'date_and_time' => now(),
                'created_at' => now(),
            ],
        ]);

        Inventory_usage::insert([
            [
                'unit_id' => $request->active_vaccine_category == 'PVRV'
                    ? ($request->pvrv_vaccine_id ?? null)
                    : ($request->pcec_vaccine_id ?? null),
                'used' => $request->vaccine_dose_given,
                'measurement_unit' => 'ml',
                'usage_date' => $date,
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
                'reduce' => $request->vaccine_dose_given, // default ml to reduce
            ];
        } elseif ($request->active_vaccine_category === 'PCEC' && $request->pcec_vaccine_id) {
            $vaccines[] = [
                'id' => $request->pcec_vaccine_id,
                'reduce' => $request->vaccine_dose_given, // default ml to reduce
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


        return redirect()->route('clinic.patients.transactions', ['id' => $patient->id])->with('success', 'Immunization completed successfully.');
    }
}
