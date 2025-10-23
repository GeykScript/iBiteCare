<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Inventory Report - {{ $year }}</title>
    <style>
           @page {
            margin: 20px;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        h3 {
            margin: 2px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            page-break-inside: avoid;
        }

        th,
        td {
            border: 0.7px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #91f4b0;
        }


        .header-table {
            width: auto;
            margin: 0 auto 10px auto;
            /* center table and add space below */
            border-collapse: collapse;
            text-align: center;
            margin-bottom: 50px;

        }

        .header-table td {
            border: none;
            vertical-align: middle;
            padding: 2px 4px;
            font-family: Arial, sans-serif;

        }


        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    @php $first = true; @endphp

    @foreach ($quarters as $quarter => $records)
    @if (!$records->isEmpty())
    @if (!$first)
    <div class="page-break"></div>
    @endif
    @php $first = false; @endphp

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

    <table class="header-table">
        <tr>
            <td class="header-logo" style="width: 80px; text-align: right;">
                <img src="{{ public_path('drcare_logo.png') }}" width="70">
            </td>

            <td style="text-align: center; padding: 0 10px;">
                <h3 style="margin: 0; font-weight: normal;">Region V Albay</h3>
                <h3 style="margin: 0; font-weight: normal;">Municipality of Guinobatan</h3>
                <h3 style="margin: 0; font-weight: 600;">Dr. Care Guinobatan Animal Bite Center</h3>
                <h3 style="margin: 4px 0; font-weight: normal;">Inventory Report - {{ $year }}</h3>
                <h3 style="margin: 2px 0; font-weight: 600;">
                    {{ $quarterLabels[$quarter] }} {{ $year }}
                </h3>
            </td>

            <td class="header-logo" style="width: 80px; text-align: left;">
                <img src="{{ public_path('images/rabies-free.jpg') }}" width="70">
            </td>
        </tr>
    </table>

    <table style="width: 100%; font-weight: normal; border: none;">
        <tr>
            <td style="text-align: right; border: none;">Months: ({{ $quarterMonths[$quarter] }})</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Item Name</th>
                <th>Package Type</th>
                <th>Packages Received</th>
                <th>Items per Package</th>
                <th>Total Units</th>
                <th>Remaining Units</th>
                <th>Package Amount</th>
                <th>Supplier</th>
                <th>Restock Date</th>
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
            <tr>
                <td>{{ $i++ }}</td>
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

            <tr style="font-weight: bold; background-color: #ffa9a9;">
                <td colspan="3">TOTAL</td>
                <td>{{ $totalPackages }}</td>
                <td></td>
                <td>{{ $totalUnits }}</td>
                <td>{{ $totalRemaining }}</td>
                <td>₱{{ number_format($totalAmount, 2) }}</td>
                <td colspan="2"></td>
            </tr>

            <tr>
                <td colspan="10" style="text-align:right; border:none; font-size:10px; font-style:italic;">
                    Generated by iBiteCare+ System on {{ \Carbon\Carbon::now()->format('F d, Y h:i A') }}
                </td>
            </tr>
        </tbody>
    </table>
    @endif
    @endforeach
</body>

</html>