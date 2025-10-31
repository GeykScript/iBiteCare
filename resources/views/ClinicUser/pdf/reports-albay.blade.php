<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Albay Report - {{ $year }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .header-table {
            width: auto;
            margin: 0 auto 10px auto;
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

        .header-logo {
            width: 90px;
        }

        h3 {
            margin: 2px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;

            /* ✅ allow proper breaking in PDF */
            page-break-inside: auto;
        }

        thead {
            /* ✅ ensures header repeats on next page */
            display: table-header-group;
        }

        tfoot {
            /* optional — repeats footer if you have one */
            display: table-footer-group;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        th,
        .content td {
            border: 0.7px solid #000;
            padding: 7px;
            text-align: center;
        }

        th {
            background-color: #91f4b0;
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
                <h3 style="margin: 0; font-weight: normal;">Region of Albay</h3>
                <h3 style="margin: 0; font-weight: 600;">Dr. Care Guinobatan Animal Bite Center</h3>
                <h3 style="margin: 4px 0; font-weight: normal;">Albay Localities Report - {{ $year }}</h3>
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
            <td style="text-align: left;">Post Exposure Prophylaxis (PEP)</td>
            <td style="text-align: right;">({{ $quarterMonths[$quarter] }})</td>
        </tr>
    </table>

    {{-- Data Table --}}
    <table class="content">
        <thead>
            <tr>
                <th rowspan="2">Localities</th>
                <th rowspan="2">Total Patients</th>
                <th colspan="2">Sex</th>
                <th colspan="3">Age</th>
                <th colspan="3">Biting Animal</th>
                <th colspan="3">Bite Category</th>
            </tr>
            <tr>
                <th>Male</th>
                <th>Female</th>
                <th>&lt;17</th>
                <th>18–64</th>
                <th>65+</th>
                <th>Dog</th>
                <th>Cat</th>
                <th>Other</th>
                <th>I</th>
                <th>II</th>
                <th>III</th>
            </tr>
        </thead>
        <tbody>
            @php
            $totalPatients = $totalMale = $totalFemale = 0;
            $totalAge_0_17 = $totalAge_18_64 = $totalAge_65_plus = 0;
            $totalDog = $totalCat = $totalOthers = 0;
            $totalBite1 = $totalBite2 = $totalBite3 = 0;
            @endphp

            @foreach ($records as $data)
            @php
            $totalPatients += $data->patient_count;
            $totalMale += $data->male_count;
            $totalFemale += $data->female_count;
            $totalAge_0_17 += $data->age_0_17;
            $totalAge_18_64 += $data->age_18_64;
            $totalAge_65_plus += $data->age_65_plus;
            $totalDog += $data->dog_count;
            $totalCat += $data->cat_count;
            $totalOthers += $data->others_count;
            $totalBite1 += $data->bite_cat_1;
            $totalBite2 += $data->bite_cat_2;
            $totalBite3 += $data->bite_cat_3;
            @endphp
            <tr>
                <td>{{ $data->Localities }}</td>
                <td>{{ $data->patient_count }}</td>
                <td>{{ $data->male_count }}</td>
                <td>{{ $data->female_count }}</td>
                <td>{{ $data->age_0_17 }}</td>
                <td>{{ $data->age_18_64 }}</td>
                <td>{{ $data->age_65_plus }}</td>
                <td>{{ $data->dog_count }}</td>
                <td>{{ $data->cat_count }}</td>
                <td>{{ $data->others_count }}</td>
                <td>{{ $data->bite_cat_1 }}</td>
                <td>{{ $data->bite_cat_2 }}</td>
                <td>{{ $data->bite_cat_3 }}</td>
            </tr>
            @endforeach

            <tr style="background-color: #ffffffff; height: 260px;">
                <td colspan="13"></td>
            </tr>

            <tr style="font-weight: bold; background-color: #ffa9a9;">
                <td>Total</td>
                <td>{{ $totalPatients }}</td>
                <td>{{ $totalMale }}</td>
                <td>{{ $totalFemale }}</td>
                <td>{{ $totalAge_0_17 }}</td>
                <td>{{ $totalAge_18_64 }}</td>
                <td>{{ $totalAge_65_plus }}</td>
                <td>{{ $totalDog }}</td>
                <td>{{ $totalCat }}</td>
                <td>{{ $totalOthers }}</td>
                <td>{{ $totalBite1 }}</td>
                <td>{{ $totalBite2 }}</td>
                <td>{{ $totalBite3 }}</td>
            </tr>
            <tr style="background-color: #ffffff; height: 240px; border:none;">
                <td colspan="13" style="border:none;"></td>
            </tr>
            <tr style="background-color: #ffffff; height: 240px; border:none;">
                <td colspan="13" style="border:none;"></td>
            </tr>
            <tr>
                <td colspan="13" style="text-align:right; border:none; font-size:10px; font-style:italic;">
                    Generated by iBiteCare+ System
                    on {{ \Carbon\Carbon::now()->format('F d, Y h:i A') }}
                </td>
            </tr>
        </tbody>
    </table>
    @endif
    @endforeach
</body>

</html>