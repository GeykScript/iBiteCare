<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\ClinicServices;
use App\Models\PatientImmunizationsSchedule;

class PatientTransactionsController extends Controller
{
    //
    public function index($id){
        $clinicUser = auth()->guard('clinic_user')->user();

        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to access patient transactions.');
        }

        $patient = Patient::find($id);
        $services = ClinicServices::all();

        $schedules = PatientImmunizationsSchedule::where('patient_id', $id)
            ->where('date_completed', Null )
            ->get();

        return view('ClinicUser.patients-transaction', compact('clinicUser', 'patient', 'services', 'schedules'));
    }

    public function newTransaction($service_id, $patient_id){
        $clinicUser = auth()->guard('clinic_user')->user();

        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to access patient transactions.');
        }

        $patient = Patient::find($patient_id);
        $service = ClinicServices::find($service_id);

        if (!$patient || !$service) {
            return redirect()->back()->with('error', 'Invalid patient or service.');
        }

        if ($service->id == $service_id) {
            return redirect()->route('clinic.patients.new-transaction.pep', ['service_id' => $service_id, 'patient_id' => $patient_id]);
        }

    }
}
