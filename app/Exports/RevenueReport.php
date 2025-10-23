<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\revenue_expenses_report;

class RevenueReport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */


    public function view(): View
    {
        $year = now()->year;
        $datas = revenue_expenses_report::where('year', $year)
            ->orderByRaw("FIELD(month, 
            'January','February','March','April','May','June',
            'July','August','September','October','November','December')")
            ->get();

        return view('ClinicUser.exports.revenue-reports', compact('datas', 'year'));
    }
}
