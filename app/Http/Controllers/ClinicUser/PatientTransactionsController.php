<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\ClinicServices;
use App\Models\PatientImmunizationsSchedule;
use Illuminate\Support\Facades\Crypt;

class PatientTransactionsController extends Controller
{
    //
    public function index($id){
        $id = Crypt::decrypt($id);
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
        $service_id = Crypt::decrypt($service_id);
        $patient_id = Crypt::decrypt($patient_id);

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

        $service_id = Crypt::encrypt($service_id);
        $patient_id = Crypt::encrypt($patient_id);

        // 🔹 Match by service name or keyword
        if (str_contains($serviceName, 'post') || str_contains($serviceName, 'pep') || str_contains($serviceName, 'post exposure prophylaxis')) {
            return redirect()->route('clinic.patients.new-transaction.pep', compact('service_id', 'patient_id'));
        } elseif (str_contains($serviceName, 'pre') || str_contains($serviceName, 'prep') || str_contains($serviceName, 'pre-exposure prophylaxis')) {
            return redirect()->route('clinic.patients.new-transaction.prep', compact('service_id', 'patient_id'));
        } elseif (str_contains($serviceName, 'tetanus') || str_contains($serviceName, 'anti-tetanus') || str_contains($serviceName, 'tetanus toxoid')) {
            return redirect()->route('clinic.patients.new-transaction.antitetanus', compact('service_id', 'patient_id'));
        } elseif (str_contains($serviceName, 'booster')) {
            return redirect()->route('clinic.patients.new-transaction.booster', compact('service_id', 'patient_id'));
        } else {
            return redirect()->route('clinic.patients.new-transaction.other', compact('service_id', 'patient_id'));
          
        }
    }
}
