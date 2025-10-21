@php
$quarterLabels = [1=>'1st Quarter',2=>'2nd Quarter',3=>'3rd Quarter',4=>'4th Quarter'];
$quarterMonths = [1=>'January – March',2=>'April – June',3=>'July – September',4=>'October – December'];
@endphp

@foreach ($quarters as $quarter => $records)
@if (!$records->isEmpty())

<table border="1" style="border-collapse:collapse; width:100%;">
    <thead>
        <tr>
            <th colspan="13" style="text-align:center; border:none;">
                <h3 style="margin: 0; ">Region of Albay</h3>
            </th>
        </tr>
        <tr>
            <th colspan="13" style="text-align:center; font-weight:bold; border:none;">
                <h3 style="margin: 0; ">Dr. Care Guinobatan Animal Bite Center</h3>
            </th>
        </tr>
        <tr>
            <th colspan="13" style="text-align:center; border:none;">
                <h3 style="margin: 0; ">Albay Localities Report - {{ $year }}</h3>
            </th>
        </tr>
        <tr>
            <th colspan="13" style="text-align:center; font-weight:bold; border:none;">
                <h3 style="margin: 0; font-weight: bold;">{{ $quarterLabels[$quarter] }} {{ $year }}</h3>
            </th>
        </tr>
        <tr>
            <th colspan="13" style="border:none;">&nbsp;</th>
        </tr>
        <tr>
            <th colspan="6" style="text-align:left; ">
                Post Exposure Prophylaxis (PEP) {{ $year }}
            </th>
            <th colspan="7" style="text-align:right; ">
                Months: ({{ $quarterMonths[$quarter] }})
            </th>
        </tr>

        <tr>
            <th colspan="13" style="border:none;">&nbsp;</th>
        </tr>
        <tr style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">
            <th rowspan="2" style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000; ">Localities</th>
            <th rowspan="2" style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Total Patients</th>
            <th colspan="2" style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Sex</th>
            <th colspan="3" style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Age</th>
            <th colspan="3" style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Biting Animal</th>
            <th colspan="3" style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Bite Category</th>
        </tr>
        <tr style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">
            <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Male</th>
            <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Female</th>
            <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">&lt;17</th>
            <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">18–64</th>
            <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">65+</th>
            <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Dog</th>
            <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Cat</th>
            <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Other</th>
            <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">I</th>
            <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">II</th>
            <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">III</th>
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
        <tr style="text-align:center; border:1px solid #000;">
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
        @endforeach
        <tr>
            <th colspan="13" style="border:none;">&nbsp;</th>
        </tr>
        <tr style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000;">
            <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">Total</td>
            <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">{{ $totalPatients }}</td>
            <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">{{ $totalMale }}</td>
            <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">{{ $totalFemale }}</td>
            <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">{{ $totalAge_0_17 }}</td>
            <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">{{ $totalAge_18_64 }}</td>
            <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">{{ $totalAge_65_plus }}</td>
            <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">{{ $totalDog }}</td>
            <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">{{ $totalCat }}</td>
            <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">{{ $totalOthers }}</td>
            <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">{{ $totalBite1 }}</td>
            <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">{{ $totalBite2 }}</td>
            <td style="font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">{{ $totalBite3 }}</td>
        </tr>
    </tbody>
</table>
<br><br>
@endif
@endforeach