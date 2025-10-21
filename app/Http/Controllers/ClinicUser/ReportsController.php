<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use App\Models\barangay_patient_report;
use App\Models\albay_patient_report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClinicTransactions;
use App\Models\ClinicServices;
use App\Models\PaymentRecords;
use Barryvdh\DomPDF\Facade\Pdf; 



use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\AlbayReportExport;
use App\Exports\GuinobatanReportExport;
use App\Exports\RevenueReport;

use App\Models\revenue_expenses_report;



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

        $datas = barangay_patient_report::where('year', $year)
        ->orderBy('barangay', 'asc')
        ->get();

        // Group by quarter
        $grouped = $datas->groupBy('quarter');
        $quarters = collect([1, 2, 3, 4])->mapWithKeys(function ($q) use ($grouped) {
            return [$q => $grouped->get($q, collect())];
        });

        // Loop through each quarter and generate a separate PDF
        foreach ($quarters as $quarter => $records) {
            if ($records->isNotEmpty()) {
                $pdf = Pdf::loadView('ClinicUser.pdf.reports-guinobatan', compact('quarters', 'year'))
                    ->setPaper('letter', 'landscape');

                $fileName = 'Guinobatan_Report_' . $year . '.pdf';

                // // Download directly
                // // return $pdf->download($fileName);
                return $pdf->stream($fileName);
            }
        }

    }

    public function reportAlbay()
    {

        $year = now()->year;

        $datas = albay_patient_report::where('year', $year)
            ->orderBy('Localities', 'asc')
            ->get();

        // Group by quarter
        $grouped = $datas->groupBy('quarter');
        $quarters = collect([1, 2, 3, 4])->mapWithKeys(function ($q) use ($grouped) {
            return [$q => $grouped->get($q, collect())];
        });

        // Loop through each quarter and generate a separate PDF
        foreach ($quarters as $quarter => $records) {
            if ($records->isNotEmpty()) {
                $pdf = Pdf::loadView('ClinicUser.pdf.reports-albay', compact('quarters', 'year'))
                    ->setPaper('letter', 'landscape');

                // Filename with year and quarter
                $fileName = 'Albay_Report_' . $year . '.pdf';

                // // Download directly
                // // return $pdf->download($fileName);
                return $pdf->stream($fileName);
            }
        }

      
    }

    public function exportAlbayExcel()
    {
        $year = now()->year;
        $fileName = 'Albay_Report_' . $year . '.xlsx';

        return Excel::download(new AlbayReportExport($year), $fileName);
    }

    public function exportGuinobatanExcel()
    {
        $year = now()->year;
        $fileName = 'Guinobatan_Report_' . $year . '.xlsx';

        return Excel::download(new GuinobatanReportExport($year), $fileName);
    }


    public function getRevenueChartData(Request $request)
    {
        $filter = $request->filter ?? 'all';
        $query = PaymentRecords::query();

        // Determine start and end dates based on filter
        $start = null;
        $end = now();

        switch ($filter) {
            case 'today':
                $start = now()->startOfDay();
                $end = now()->endOfDay();
                break;
            case 'yesterday':
                $start = now()->subDay()->startOfDay();
                $end = now()->subDay()->endOfDay();
                break;
            case 'lastWeek':
                $start = now()->subWeek()->startOfWeek();
                $end = now()->subWeek()->endOfWeek();
                break;
            case 'lastMonth':
                $start = now()->subMonth()->startOfMonth();
                $end = now()->subMonth()->endOfMonth();
                break;
            case 'thisYear':
                $start = now()->startOfYear();
                $end = now()->endOfYear();
                break;
            case 'lastYear':
                $start = now()->subYear()->startOfYear();
                $end = now()->subYear()->endOfYear();
                break;
            case 'all':
            default:
                $start = PaymentRecords::min('payment_date'); // optional, or leave null
                $end = now();
                break;
        }

        if ($start) {
            $query->whereBetween('payment_date', [$start, $end]);
        }

        // Group by month for chart (if filter is longer than a month)
        $results = $query->selectRaw('MONTH(payment_date) as month, SUM(amount_paid) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data = array_fill(0, 12, 0);

        foreach ($results as $row) {
            $data[$row->month - 1] = $row->total;
        }

        $totalRevenue = array_sum($data);


        return response()->json([
            'categories' => $months,
            'series' => [
                ['name' => 'Sales', 'data' => $data, 'color' => '#ff0808ef'],
            ],
            'totalRevenue' => $totalRevenue
        ]);
    }


    public function reportRevenueExpenses()
    {
        $year = now()->year;

        // Get all records for the selected year
        $datas = revenue_expenses_report::where('year', $year)
            ->orderByRaw("FIELD(month, 
            'January','February','March','April','May','June',
            'July','August','September','October','November','December')")
            ->get();

        if ($datas->isEmpty()) {
            return back()->with('error', 'No data available for ' . $year);
        }

        // Generate PDF
        $pdf = Pdf::loadView('ClinicUser.pdf.reports-revenue', compact('datas', 'year'))
            ->setPaper('letter', 'landscape');

        $fileName = 'Revenue_Report_' . $year . '.pdf';

        return $pdf->stream($fileName);
    }

    public function exportRevenueExcel()
    {
        $year = now()->year;
        $fileName = 'Revenue_Report_' . $year . '.xlsx';

        return Excel::download(new RevenueReport(), $fileName);
    }

    
}

