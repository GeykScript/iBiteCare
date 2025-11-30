<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\ClinicServices;
use App\Models\PaymentRecords;
use App\Models\Inventory_stock;
use App\Models\revenue_expenses_report;
use App\Models\barangay_patient_report;
use App\Models\albay_patient_report;

use App\Exports\AlbayReportExport;
use App\Exports\GuinobatanReportExport;
use App\Exports\RevenueReport;
use App\Exports\InventoryReport;



class ReportsController extends Controller
{
    //
    public function index()
    {

        $clinicUser = Auth::guard('clinic_user')->user();
        $services = ClinicServices::all();


        if (!$clinicUser) {
            return redirect()->route('clinic.login')->with('error', 'You must be logged in to access the dashboard.');
        }

        return view('ClinicUser.reports', compact('clinicUser', 'services'));
    }

    public function reportGuinobatan()
    {

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

        // Apply date range and grouping
        switch ($filter) {
            case 'today':
                $query->selectRaw('HOUR(created_at) as hour, SUM(amount_paid) as total')
                    ->whereDate('payment_date', now())
                    ->groupBy('hour')
                    ->orderBy('hour');
                break;

            case 'yesterday':
                $query->selectRaw('HOUR(created_at) as hour, SUM(amount_paid) as total')
                    ->whereDate('payment_date', now()->subDay())
                    ->groupBy('hour')
                    ->orderBy('hour');
                break;

            case 'weekly':
                $query->selectRaw('DATE(payment_date) as date, SUM(amount_paid) as total')
                    ->whereBetween('payment_date', [now()->startOfWeek(), now()->endOfWeek()])
                    ->groupBy('date')
                    ->orderBy('date');
                break;

            case 'monthly':
            case 'thisYear':
                // Both show all 12 months of the current year
                $query->selectRaw('MONTH(payment_date) as month, SUM(amount_paid) as total')
                    ->whereBetween('payment_date', [now()->startOfYear(), now()->endOfYear()])
                    ->groupBy('month')
                    ->orderBy('month');
                break;

            case 'lastYear':
                $query->selectRaw('MONTH(payment_date) as month, SUM(amount_paid) as total')
                    ->whereYear('payment_date', now()->subYear()->year)
                    ->groupBy('month')
                    ->orderBy('month');
                break;

            default:
                $query->selectRaw('MONTH(payment_date) as month, SUM(amount_paid) as total')
                    ->whereBetween('payment_date', [now()->startOfYear(), now()->endOfYear()])
                    ->groupBy('month')
                    ->orderBy('month');
                break;
        }

        $results = $query->get();

        $categories = [];
        $data = [];

        if (in_array($filter, ['all','monthly', 'thisYear', 'lastYear'])) {
            // Always show all 12 months
            $categories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            $data = array_fill(0, 12, 0);

            foreach ($results as $row) {
                $index = $row->month - 1;
                $data[$index] = $row->total;
            }
        } elseif (in_array($filter, ['today', 'yesterday'])) {
            // Fixed hours 8AM–5PM
            $hourRange = range(8, 16);
            $categories = array_map(fn($h) => date('g A', mktime($h, 0)), $hourRange);
            $data = array_fill(0, count($hourRange), 0);

            foreach ($results as $row) {
                $hour = (int)$row->hour;
                if ($hour >= 8 && $hour <= 16) {
                    $index = $hour - 8;
                    $data[$index] = $row->total;
                }
            }
        } else {
            // Weekly or default daily data
            $dates = $results->pluck('date')->unique()->values();
            foreach ($dates as $date) {
                $categories[] = date('M d', strtotime($date));
                $row = $results->firstWhere('date', $date);
                $data[] = $row->total ?? 0;
            }
        }

        $totalRevenue = array_sum($data);

        return response()->json([
            'categories' => $categories,
            'series' => [
                ['name' => 'Revenue', 'data' => $data, 'color' => '#ff0808ef'],
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


    public function reportInventory()
    {
        $year = now()->year;

        // Fetch inventory records for this year
        $datas = Inventory_stock::whereYear('restock_date', $year)
            ->orderBy('restock_date', 'asc')
            ->get();

        // Add computed "quarter" column
        $datas->map(function ($item) {
            $item->quarter = ceil(Carbon::parse($item->restock_date)->month / 3);
            return $item;
        });

        // Group records by quarter
        $grouped = $datas->groupBy('quarter');

        // Ensure all 4 quarters exist even if empty
        $quarters = collect([1, 2, 3, 4])->mapWithKeys(function ($q) use ($grouped) {
            return [$q => $grouped->get($q, collect())];
        });

        // Generate the PDF (one PDF with multiple quarter sections)
        $pdf = Pdf::loadView('ClinicUser.pdf.reports-inventory', compact('quarters', 'year'))
            ->setPaper('letter', 'landscape');

        $fileName = 'Inventory_Report_' . $year . '.pdf';

        return $pdf->stream($fileName);
    }


    public function exportInventoryExcel()
    {
        $year = now()->year;
        $fileName = 'Inventory_Report_' . $year . '.xlsx';

        return Excel::download(new InventoryReport($year), $fileName);
    }
}
