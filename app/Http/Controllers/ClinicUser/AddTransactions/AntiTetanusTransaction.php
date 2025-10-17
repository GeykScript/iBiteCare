<?php

namespace App\Http\Controllers\ClinicUser\AddTransactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AntiTetanuTransactionRequest;
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
use App\Models\PatientPrevAntiTetanus;

class AntiTetanusTransaction extends Controller
{
    //

    public function showForm($service_id, $patient_id) {
        $clinicUser = Auth::guard('clinic_user')->user();

        $antiTetanusVaccines = Inventory_units::whereHas('item', function ($query) {
            $query->where('category', 'Anti-Tetanus');
        })->where('status', '!=', 'used')->where('status', '!=', 'discard')->get();


        $nurses = ClinicUser::where('role', 2)
            ->where('is_disabled', '!=', 1)
            ->get();
        $staffs = ClinicUser::where('role', '=', 3)
            ->where('is_disabled', '!=', 1)
            ->get();
        $patient = Patient::find($patient_id);
        $service_fee = ClinicServices::where('id', $service_id)->first();
        $antiTetanuService = $service_id;

        return view('ClinicUser.Transactions.new-anti-tetanu', compact('clinicUser', 'antiTetanusVaccines', 'nurses', 'staffs', 'patient', 'service_fee', 'antiTetanuService'));

    }

    public function addAntiTetanusTransaction(AntiTetanuTransactionRequest $request){
        $request->validated();

        $date = str_replace('T', ' ', $request->datetime_today);
        $patient = Patient::find($request->patient_id);
        // Create new ClinicTransaction record
        $transaction = ClinicTransactions::create([
            'patient_id'       => $request->patient_id,
            'service_id'       => $request->service_id,
            'transaction_date' => $date,
        ]);
        // Update the grouping field with the transaction's own ID
        ClinicTransactions::where('id', $transaction->id)
            ->update(['grouping' => $transaction->id]);

        // Create new PatientVitalSigns record
        $patientVitalSigns = PatientVitalSigns::create([
            'patient_id' => $request->patient_id,
            'transaction_id' => $transaction->id,
            'recorded_date' => $request->dateOfTransaction,
            'temperature' => $request->temperature,
            'weight' => $request->weight,
            'blood_pressure' => $request->blood_pressure,
        ]);

        PatientPrevAntiTetanus::create([
            'patient_id' => $patient->id,
            'dose_brand' => "Anti-Tetanus",
            'dose_given' => $request->anti_tetanus_dose_given,
            'date_dose_given' => $request->anti_tetanus_date_dose_given,
            'rn_in_charge' => $request->nurse_id,
            'year_last_dose_given' => $request->year_last_dose_given,
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
            'immunization_type' => 'None',
            'date_given' => $date,
            'day_label' =>  null,
            'vaccine_used_id' => null,
            'rig_used_id' => null,
            'anti_tetanus_id' => $request->anti_tetanus_vaccine_id ?? null,
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
                'action' => 'Administered Anti-Tetanus to patient',
                'details' => 'Administered Anti-Tetanus to patient ' . $patient->first_name . ' ' . $patient->last_name,
                'date_and_time' => now(),
                'created_at' => now(),
            ],
            [
                'user_id' => $request->staff_id,
                'role_id' => $staffClinicRole->role,
                'action' => 'Handled payment for Anti-Tetanus patient',
                'details' => 'Handled payment for Anti-Tetanus patient ' . $patient->first_name . ' ' . $patient->last_name,
                'date_and_time' => now(),
                'created_at' => now(),
            ],
        ]);

        Inventory_usage::insert([
            [
                'unit_id' => $request->anti_tetanus_vaccine_id,
                'used' => $request->anti_dose_given ?? 0,
                'measurement_unit' => 'ml',
                'usage_date' => $date,
                'used_by' => $request->nurse_id,
                'details' => 'Used for Anti-Tetanus vaccination for patient ' . $patient->first_name . ' ' . $patient->last_name,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Define vaccine IDs with their respective subtraction amounts
        $vaccines = [];

        //  Anti-Tetanus
        if ($request->anti_tetanus_vaccine_id) {
            $vaccines[] = [
                'id' => $request->anti_tetanus_vaccine_id,
                'reduce' => $request->anti_dose_given ?? 0,
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
        return redirect()->route('clinic.patients.transactions', ['id' => $request->patient_id])->with('success', 'Immunization completed successfully.');
    }
}
