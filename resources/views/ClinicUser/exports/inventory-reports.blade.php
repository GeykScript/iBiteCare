    @php
    $quarterLabels = [
    1 => '1st Quarter',
    2 => '2nd Quarter',
    3 => '3rd Quarter',
    4 => '4th Quarter',
    ];

    $quarterMonths = [
    1 => 'January – March',
    2 => 'April – June',
    3 => 'July – September',
    4 => 'October – December',
    ];
    @endphp

    @foreach ($quarters as $quarter => $records)
    @if (!$records->isEmpty())
    <table border="1" style="border-collapse:collapse; width:90%;">
        <thead>
            <tr>
                <th colspan="9" style="text-align:center; border:none;">
                    <h3 style="margin: 0; ">Region V Albay</h3>
                </th>
            </tr>
            <tr>
                <th colspan="9" style="text-align:center; border:none;">
                    <h3 style="margin: 0; ">Municipality of Guinobatan</h3>
                </th>
            </tr>
            <tr>
                <th colspan="9" style="text-align:center; font-weight:bold; border:none;">
                    <h3 style="margin: 0; ">Dr. Care Guinobatan Animal Bite Center</h3>
                </th>
            </tr>
            <tr>
                <th colspan="9" style="text-align:center; border:none;">
                    <h3 style="margin: 0; ">Municipality Barangay Report - {{ $year }}</h3>
                </th>
            </tr>
            <tr>
                <th colspan="9" style="text-align:center; font-weight:bold; border:none;">
                    <h3 style="margin: 0; font-weight: bold;">{{ $quarterLabels[$quarter] }} {{ $year }}</h3>
                </th>
            </tr>
            <tr>
                <th colspan="9" style="border:none;">&nbsp;</th>
            </tr>
            <tr>

                <th colspan="9" style="text-align:right; font-weight:bold; border:none;">
                    Months: ({{ $quarterMonths[$quarter] }})
                </th>
            </tr>

            <tr>
                <th colspan="9" style="border:none;">&nbsp;</th>
            </tr>
            <tr style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">
                <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000; ">Item Name</th>
                <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Package Type</th>
                <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Packages Received</th>
                <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Items per Package</th>
                <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Total Units</th>
                <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Remaining Units</th>
                <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Package Amount</th>
                <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Supplier</th>
                <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Restock Date</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i = 1;
            $totalPackages = $totalUnits = $totalRemaining = $totalAmount = 0;
            @endphp

            @foreach ($records as $data)
            @php
            $totalPackages += $data->packages_received;
            $totalUnits += $data->total_units;
            $totalRemaining += $data->total_remaining_units;
            $totalAmount += $data->total_package_amount;
            @endphp
            <tr style="text-align:center; border:1px solid #000;">
                <td>{{ $data->item->brand_name ?? 'N/A' }}</td>
                <td>{{ $data->package_type }}</td>
                <td>{{ $data->packages_received }}</td>
                <td>{{ $data->items_per_package }} pcs</td>
                <td>{{ $data->total_units }} pcs</td>
                <td>{{ $data->total_remaining_units }} pcs</td>
                <td>₱{{ number_format($data->total_package_amount, 2) }}</td>
                <td>{{ $data->supplier }}</td>
                <td>{{ \Carbon\Carbon::parse($data->restock_date)->format('F d, Y') }}</td>
            </tr>
            @endforeach
            <tr>
                <th colspan="9" style="border:none;">&nbsp;</th>
            </tr>
            <tr style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000;">
                <td colspan="2" style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">TOTAL</td>
                <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">{{ $totalPackages }}</td>
                <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; "></td>
                <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">{{ $totalUnits }}</td>
                <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">{{ $totalRemaining }}</td>
                <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">₱{{ number_format($totalAmount, 2) }}</td>
                <td colspan="2" style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; "></td>
            </tr>
            <tr>
                <th colspan="9" style="border:none;">&nbsp;</th>
            </tr>

         
        </tbody>
    </table>
    @endif
    @endforeach