<?php

namespace App\Http\Controllers\ClinicUser;

use App\Http\Controllers\Controller;
use App\Models\ClinicServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClinicUser;
use App\Models\ClinicTransactions;
use App\Models\Messages;
use App\Models\Notifications;


class DashboardController extends Controller
{
    public function index()
    {

        $clinicUser = Auth::guard('clinic_user')->user();

        $admin = ClinicUser::with('UserRole')->where('account_id', 'admin');

        $clinic_transactions = ClinicTransactions::orderBy('transaction_date', 'desc')
            ->take(10)
            ->get();

        $today_clinic_transactions = ClinicTransactions::whereDate('transaction_date', now()->toDateString())->count();

        $clinic_expected_patients = Messages::where('scheduled_send_date', now()->toDateString())
            ->count();

        // // Only insert a notification if there are pending messages AND no existing notification for today
        // if ($clinic_expected_patients > 0) {
        //     $existing = Notifications::whereDate('created_at', now()->toDateString())
        //         ->where('content', 'like', '%pending SMS messages%')
        //         ->first();

        //     if (!$existing) {
        //         Notifications::insert([
        //             'content' => 'You have ' . $clinic_expected_patients . ' pending SMS messages to send today.',
        //             'is_read' => 0,
        //             'links_to' => 2, // links to messages
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]);
        //     }
        // }
        // $notifications = Notifications::orderBy('created_at', 'desc')->get();


        $services = ClinicServices::all();


        return view('ClinicUser.dashboard', compact('clinicUser', 'clinic_transactions', 'today_clinic_transactions', 'clinic_expected_patients', 'services'));
    }

    public function getChartData(Request $request)
    {
        $filter = $request->filter ?? 'all';
        $serviceFilter = $request->serviceFilter ?? null;
        $ageFilter = $request->ageFilter ?? null;

        $query = ClinicTransactions::join('registered_patients', 'registered_patients.id', '=', 'patient_transactions.patient_id');

        switch ($filter) {
            case 'today':
                $query->selectRaw('HOUR(transaction_date) as hour, registered_patients.sex, COUNT(DISTINCT CONCAT(patient_id, "-", service_id, "-", grouping)) as total')
                    ->whereDate('transaction_date', now())
                    ->groupBy('hour', 'registered_patients.sex')
                    ->orderBy('hour');
                break;
            case 'yesterday':
                $query->selectRaw('HOUR(transaction_date) as hour, registered_patients.sex, COUNT(DISTINCT CONCAT(patient_id, "-", service_id, "-", grouping)) as total')
                    ->whereDate('transaction_date', now()->subDay())
                    ->groupBy('hour', 'registered_patients.sex')
                    ->orderBy('hour');
                break;

            case 'weekly':
                $query->selectRaw('DATE(transaction_date) as date, registered_patients.sex, COUNT(DISTINCT CONCAT(patient_id, "-", service_id, "-", grouping)) as total')
                    ->whereBetween('transaction_date', [now()->startOfWeek(), now()->endOfWeek()])
                    ->groupBy('date', 'registered_patients.sex')
                    ->orderBy('date');
                break;

            case 'monthly':
            case 'thisYear':
                $query->selectRaw('MONTH(transaction_date) as month, registered_patients.sex, COUNT(DISTINCT CONCAT(patient_id, "-", service_id, "-", grouping)) as total')
                    ->whereBetween('transaction_date', [now()->startOfYear(), now()->endOfYear()])
                    ->groupBy('month', 'registered_patients.sex')
                    ->orderBy('month');
                break;

            case 'lastYear':
                $query->selectRaw('MONTH(transaction_date) as month, registered_patients.sex, COUNT(DISTINCT CONCAT(patient_id, "-", service_id, "-", grouping)) as total')
                    ->whereYear('transaction_date', now()->subYear()->year)
                    ->groupBy('month', 'registered_patients.sex')
                    ->orderBy('month');
                break;

            default:
                $query->selectRaw('DATE(transaction_date) as date, registered_patients.sex, COUNT(DISTINCT CONCAT(patient_id, "-", service_id, "-", grouping)) as total')
                    ->groupBy('date', 'registered_patients.sex')
                    ->orderBy('date');
                break;
        }

        // Optional filters
        if ($serviceFilter && $serviceFilter != 'all') {
            $query->where('service_id', $serviceFilter);
        }

        if ($ageFilter && $ageFilter != 'all') {
            if ($ageFilter === '0-17') $query->whereBetween('registered_patients.age', [0, 17]);
            if ($ageFilter === '18-64') $query->whereBetween('registered_patients.age', [18, 64]);
            if ($ageFilter === '65+') $query->where('registered_patients.age', '>=', 65);
        }

        $results = $query->get();

        // Chart data
        $maleData = [];
        $femaleData = [];
        $categories = [];

        if (in_array($filter, ['monthly', 'thisYear', 'lastYear'])) {
            // Always show all 12 months
            $categories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            $maleData = array_fill(0, 12, 0);
            $femaleData = array_fill(0, 12, 0);

            foreach ($results as $row) {
                $index = $row->month - 1;
                if (strtolower($row->sex) === 'male') $maleData[$index] = $row->total;
                if (strtolower($row->sex) === 'female') $femaleData[$index] = $row->total;
            }
        } elseif ($filter === 'today') {
            // Always show 8AM–5PM regardless of data
            $hourRange = range(8, 16);
            $categories = array_map(fn($h) => date('g A', mktime($h, 0)), $hourRange);

            $maleData = array_fill(0, count($hourRange), 0);
            $femaleData = array_fill(0, count($hourRange), 0);

            foreach ($results as $row) {
                $hour = (int)$row->hour;
                if ($hour >= 8 && $hour <= 16) {
                    $index = $hour - 8;
                    if (strtolower($row->sex) === 'male') $maleData[$index] = $row->total;
                    if (strtolower($row->sex) === 'female') $femaleData[$index] = $row->total;
                }
            }
        } else {
            // Weekly or default daily
            $dates = $results->pluck('date')->unique()->values();
            foreach ($dates as $date) {
                $male = $results->firstWhere(fn($r) => $r->date == $date && strtolower($r->sex) === 'male');
                $female = $results->firstWhere(fn($r) => $r->date == $date && strtolower($r->sex) === 'female');
                $maleData[] = $male->total ?? 0;
                $femaleData[] = $female->total ?? 0;
                $categories[] = date('M d', strtotime($date));
            }
        }

        $totalMale = array_sum($maleData);
        $totalFemale = array_sum($femaleData);
        $totalPatients = $totalMale + $totalFemale;

        return response()->json([
            'categories' => $categories,
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
