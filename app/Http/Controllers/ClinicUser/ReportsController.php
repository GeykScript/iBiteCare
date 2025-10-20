<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use App\Models\barangay_patient_report;
use App\Models\albay_patient_report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClinicTransactions;
use App\Models\PatientImmunizations;
use App\Models\ClinicServices;
use Barryvdh\DomPDF\Facade\Pdf; // ✅ Import this


class ReportsController extends Controller
{
    //
    public function index(){

        $clinicUser = Auth::guard('clinic_user')->user();
        $services = ClinicServices::all();


        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to access the dashboard.');
        }


        
        return view('ClinicUser.reports', compact('clinicUser', 'services'));
    }

    public function reportGuinobatan(){

        $year = now()->year;

        // Get only the current year’s data
        $datas = barangay_patient_report::where('year', $year)
        ->orderBy('barangay', 'asc')
        ->get();

        // Group by quarter
        $grouped = $datas->groupBy('quarter');
        // Always ensure quarters 1–4 exist (even if empty)
        $quarters = collect([1, 2, 3, 4])->mapWithKeys(function ($q) use ($grouped) {
            return [$q => $grouped->get($q, collect())];
        });
        // For testing (if you want to view it directly in browser)
        // return view('ClinicUser.pdf.reports-guinobatan', compact('quarters', 'year'));

        // Generate the PDF from a Blade view

    

    
        // Loop through each quarter and generate a separate PDF
        foreach ($quarters as $quarter => $records) {
            if ($records->isNotEmpty()) {
                $pdf = Pdf::loadView('ClinicUser.pdf.reports-guinobatan', compact('quarters', 'year'))
                    ->setPaper('letter', 'landscape');

                // Filename with year and quarter
                $fileName = 'Guinobatan_Report_Q' . $quarter . '_' . $year . '.pdf';

                // // Download directly
                // // return $pdf->download($fileName);
                return $pdf->stream($fileName);
            }
        }

    }

    public function reportAlbay()
    {

        $year = now()->year;

        // Get only the current year’s data
        $datas = albay_patient_report::where('year', $year)
            ->orderBy('Localities', 'asc')
            ->get();

        // Group by quarter
        $grouped = $datas->groupBy('quarter');
        // Always ensure quarters 1–4 exist (even if empty)
        $quarters = collect([1, 2, 3, 4])->mapWithKeys(function ($q) use ($grouped) {
            return [$q => $grouped->get($q, collect())];
        });
        // For testing (if you want to view it directly in browser)
        // return view('ClinicUser.pdf.reports-guinobatan', compact('quarters', 'year'));


        // Loop through each quarter and generate a separate PDF
        foreach ($quarters as $quarter => $records) {
            if ($records->isNotEmpty()) {
                $pdf = Pdf::loadView('ClinicUser.pdf.reports-albay', compact('quarters', 'year'))
                    ->setPaper('letter', 'landscape');

                // Filename with year and quarter
                $fileName = 'Albay_Report_Q' . $quarter . '_' . $year . '.pdf';

                // // Download directly
                // // return $pdf->download($fileName);
                return $pdf->stream($fileName);
            }
        }

      
    }
    
}
