<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use App\Models\Inventory_stock;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromView;

class InventoryReport implements FromView
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
        $datas = Inventory_stock::whereYear('restock_date', $this->year)
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

        return view('ClinicUser.exports.inventory-reports', [
            'quarters' => $quarters,
            'year' => $this->year
        ]);
    }
}
