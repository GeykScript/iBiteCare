<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use App\Models\ClinicTransactions;
use App\Models\ClinicUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Patient;
use App\Models\PatientPrevAntiTetanus;
use App\Models\PatientPrevAntiRabies;
use App\Models\PatientImmunizations;
use App\Models\PatientImmunizationsSchedule;
use App\Models\PaymentRecords;
use App\Models\ClinicServices;
use App\Mail\VaccinationCardMail;
use COM;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;

class PatientsController extends Controller
{
    public function index(){

        $clinicUser = Auth::guard('clinic_user')->user();

        $services = ClinicServices::all();

        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to access the patients list.');
        }

        return view('ClinicUser.patients', compact('clinicUser', 'services'));
    }



    public function viewProfile($id){
        $id = Crypt::decrypt($id);
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
        $currentImmunization = PatientImmunizations::where('patient_id', $id)->get();
        $schedules = PatientImmunizationsSchedule::where('patient_id', $id)->get();

        $groupedSchedules = $schedules
            ->sortByDesc(fn($schedule) => $schedule->transaction->transaction_date) 
            ->groupBy('transaction_id');


        $paymentRecords =  PaymentRecords::where('patient_id', $id )->get();

        $transactions = ClinicTransactions::with(['patient', 'service', 'paymentRecords', 'immunizations','patientExposures', 'patientSchedules'])
            ->where('patient_id', $id)
            ->get();

            $transactions2 = ClinicTransactions::with(['patient', 'service', 'paymentRecords', 'immunizations', 'patientExposures', 'patientSchedules'])
            ->where('patient_id', $id)
            ->orderBy('transaction_date', 'asc')
            ->get()
            ->groupBy('grouping')
            ->map(function ($group) {
                $first = $group->first();
                // merge all schedules from this grouping
                $first->allSchedules = $group->flatMap->patientSchedules;
                return $first;
            })
            ->sortByDesc('transaction_date');

        return view('ClinicUser.patients-profile', compact('clinicUser', 'patient', 'previousAntiTetanus', 'previousAntiRabies', 'currentImmunization', 'schedules','paymentRecords', 'transactions2','transactions', 'groupedSchedules'));
    }


    public function pdfVaccinationCard($id,$grouping){
        $id = Crypt::decrypt($id);
        $grouping = Crypt::decrypt($grouping);
        $patient = Patient::find($id);
        $transactions2 = ClinicTransactions::with(['patient', 'service', 'paymentRecords', 'immunizations', 'patientExposures', 'patientSchedules'])
            ->where('patient_id', $id)
            ->where('id', $grouping)
            ->orderBy('transaction_date', 'asc')
            ->get()
            ->groupBy('grouping')
            ->map(function ($group) {   
                $first = $group->first();
                // merge all schedules from this grouping
                $first->allSchedules = $group->flatMap->patientSchedules;
                return $first;
            })
            ->sortByDesc('transaction_date');

        $pdf = Pdf::loadView('ClinicUser.pdf.pdf-vaccination-card', compact('transactions2'))
            ->setPaper([0, 0, 612, 936], 'portrait');

        $fileName = 'Vaccination_Card_' . $patient->first_name . '_' . $patient->last_name . '.pdf';
        return $pdf->stream($fileName);
    }




    public function updateProfile(Request $request)
    {
        $request->validate([
            'id'             => 'required|integer',
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'middle_initial' => 'nullable|string|max:10',
            'suffix'         => 'nullable|string|max:50',
            'sex'            => 'nullable|string|max:10',
            'contact_number' => 'required|string|max:20',
            'email'          => 'required|email|max:255|unique:registered_patients,email,' . $request->id,
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
            empty($request->province) &&
            empty($request->city) &&
            empty($request->barangay) &&
            empty($request->description)
        ) {
            $address = $patient_user->address; // keep old address
        } else {
            $parts = array_filter([
                $request->province,
                $request->city,
                $request->barangay,
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
            'email'          => $request->email,
            'sex'            => $request->sex,
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


    public function viewImmunizationDetails($id, $transaction_id){
        $id = Crypt::decrypt($id);
        $transaction_id = Crypt::decrypt($transaction_id);
        $clinicUser = Auth::guard('clinic_user')->user();

        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to view patient profiles.');
        }

        $immunization = PatientImmunizations::find($id);

        if (!$immunization) {
            return redirect()->route('clinic.patients')->with('error', 'Immunization record not found.');
        }

        $patient = Patient::find($immunization->patient_id);

        

        return view('ClinicUser.patient-immune-info', compact('clinicUser', 'immunization', 'patient'));
    }
}



