<?php

namespace App\Exports;

use App\Models\albay_patient_report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AlbayReportExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $year;

    public function __construct($year)
    {
        $this->year = $year;
    }

    public function view(): View
    {
        // Fetch data for the given year
        $datas = albay_patient_report::where('year', $this->year)
            ->orderBy('Localities', 'asc')
            ->get();

        // Group by quarter
        $grouped = $datas->groupBy('quarter');

        // Ensure all 4 quarters exist
        $quarters = collect([1, 2, 3, 4])->mapWithKeys(function ($q) use ($grouped) {
            return [$q => $grouped->get($q, collect())];
        });

        return view('ClinicUser.exports.albay-reports', [
            'quarters' => $quarters,
            'year' => $this->year
        ]);
    }
}
