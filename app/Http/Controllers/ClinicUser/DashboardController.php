<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use App\Models\ClinicServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClinicUser;
use App\Models\ClinicTransactions;
use App\Models\Messages;


class DashboardController extends Controller
{
    public function index(){

        $clinicUser = Auth::guard('clinic_user')->user();

        $admin = ClinicUser::with('UserRole')->where('account_id', 'admin');

        $clinic_transactions = ClinicTransactions::orderBy('transaction_date', 'desc')
            ->take(10)
            ->get();        
        
        $today_clinic_transactions = ClinicTransactions::whereDate('transaction_date', now()->toDateString())->count();
        $clinic_expected_patients = Messages::where('schedule', now()->toDateString())
            ->count();
        $services = ClinicServices::all();

        return view('ClinicUser.dashboard', compact('clinicUser', 'clinic_transactions', 'today_clinic_transactions', 'clinic_expected_patients', 'services'));
    }

    public function getChartData(Request $request)
    {
        $filter = $request->filter ?? 'all';
        $serviceFilter = $request->serviceFilter ?? null;
        $ageFilter = $request->ageFilter ?? null;

        $query = ClinicTransactions::query()
            ->join('registered_patients', 'registered_patients.id', '=', 'patient_transactions.patient_id')
        ->selectRaw('MONTH(transaction_date) as month, registered_patients.sex, COUNT(DISTINCT CONCAT(patient_id, "-", service_id, "-", grouping)) as total');


        // Apply filters
        if ($serviceFilter && $serviceFilter != 'all') {
            $query->where('service_id', $serviceFilter);
        }

        if ($ageFilter && $ageFilter != 'all') {
            if ($ageFilter === '0-17') $query->whereBetween('registered_patients.age', [0, 17]);
            if ($ageFilter === '18-64') $query->whereBetween('registered_patients.age', [18, 64]);
            if ($ageFilter === '65+') $query->where('registered_patients.age', '>=', 65);
        }

        // Apply date filter
        switch ($filter) {
            case 'today':
                $query->whereDate('transaction_date', now());
                break;
            case 'yesterday':
                $query->whereDate('transaction_date', now()->subDay());
                break;
            case 'lastWeek':
                $query->whereBetween('transaction_date', [now()->subWeek(), now()]);
                break;
            case 'lastMonth':
                $query->whereBetween('transaction_date', [now()->subMonth(), now()]);
                break;
            case 'thisYear':
                $query->whereBetween('transaction_date', [now()->startOfYear(), now()->endOfYear()]);
                break;
            case 'lastYear':
                $query->whereBetween('transaction_date', [now()->subYear()->startOfYear(), now()->subYear()->endOfYear()]);
                break;
        }

        // Group and order
        $results = $query->groupBy('month', 'registered_patients.sex')
            ->orderBy('month')
            ->get();


        // Prepare monthly arrays
        $months = range(1, 12);
        $maleData = array_fill(0, 12, 0);
        $femaleData = array_fill(0, 12, 0);
        $totalMale = 0;
        $totalFemale = 0;
 
        foreach ($results as $row) {
            $index = $row->month - 1;
            if (strtolower($row->sex) === 'male') {
                $maleData[$index] = $row->total;
                $totalMale += $row->total;
            }
            if (strtolower($row->sex) === 'female') {
                $femaleData[$index] = $row->total;
                $totalFemale += $row->total;
            }
        }

        $totalPatients = $totalMale + $totalFemale;

        return response()->json([
            'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'series' => [
                ['name' => 'Male', 'data' => $maleData, 'color' => '#0ac4fdff'],
                ['name' => 'Female', 'data' => $femaleData, 'color' => '#ff0a70ec'],
            ],
            'totalMale' => $totalMale,
            'totalFemale' => $totalFemale,
            'totalPatients' => $totalPatients
        ]);
    }





}
    