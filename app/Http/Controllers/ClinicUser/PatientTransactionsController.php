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
            ->where('status', 'Pending')
            ->get();

        return view('ClinicUser.patients-transaction', compact('clinicUser', 'patient', 'services', 'schedules'));
    }

    public function newTransaction($service_id, $patient_id)
    {
        $clinicUser = auth()->guard('clinic_user')->user();

        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to access patient transactions.');
        }

        $patient = Patient::find($patient_id);
        $service = ClinicServices::find($service_id);

        if (!$patient || !$service) {
            return redirect()->back()->with('error', 'Invalid patient or service.');
        }

        $serviceName = strtolower($service->name);

        // 🔹 Match by service name or keyword
        if (str_contains($serviceName, 'post') || str_contains($serviceName, 'pep')) {
            return redirect()->route('clinic.patients.new-transaction.pep', compact('service_id', 'patient_id'));
        } elseif (str_contains($serviceName, 'pre') || str_contains($serviceName, 'prep')) {
            return redirect()->route('clinic.patients.new-transaction.prep', compact('service_id', 'patient_id'));
        } elseif (str_contains($serviceName, 'tetanus')) {
            return redirect()->route('clinic.patients.new-transaction.antitetanus', compact('service_id', 'patient_id'));
        } elseif (str_contains($serviceName, 'booster')) {
            return redirect()->route('clinic.patients.new-transaction.booster', compact('service_id', 'patient_id'));
        } else {
            return redirect()->route('clinic.patients.new-transaction.other', compact('service_id', 'patient_id'));
          
        }
    }
}
