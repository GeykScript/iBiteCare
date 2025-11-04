<table>
    <thead>
        <tr>
            <th colspan="5" style="text-align:center; border:none;">
                <h3 style="margin: 0; ">Municipality of Guinobatan</h3>
            </th>
        </tr>
        <tr>
            <th colspan="5" style="text-align:center; font-weight:bold; border:none;">
                <h3 style="margin: 0; ">Dr. Care Guinobatan Animal Bite Center</h3>
            </th>
        </tr>
        <tr>
            <th colspan="5" style="text-align:center; border:none;">
                <h3 style="margin: 0; ">Municipality Barangay Report - {{ $year }}</h3>
            </th>
        </tr>
        <tr>
            <th colspan="5" style="text-align:center; font-weight:bold; border:none;">
                <h3 style="margin: 0; font-weight: bold;"> {{ $year }}</h3>
            </th>
        </tr>
        <tr>
            <th colspan="5" style="border:none;">&nbsp;</th>
        </tr>
        <tr>
            <th colspan="2" style="text-align:left; ">Financial Summary
            </th>
            <th colspan="3" style="text-align:right; ">
                Year: {{ $year }}
            </th>
        </tr>
        <tr>
            <th colspan="5" style="border:none;">&nbsp;</th>
        </tr>
        <tr>
            <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Month</th>
            <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Total Revenue (&#8369;)</th>
            <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Total Expenses (&#8369;)</th>
            <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Income (&#8369;)</th>
            <th style="text-align:center; font-weight:bold; background-color:#91f4b0; border:1px solid #000;">Loss (&#8369;)</th>
        </tr>

    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr style="background-color:#91f4b0; border:1px solid #000;">
            <td style="text-align:center;">{{ $data->month }}</td>
            <td style="text-align:center;">{{ number_format($data->total_revenue, 2) }}</td>
            <td style="text-align:center;">{{ number_format($data->total_expenses, 2) }}</td>
            <td style="text-align:center;">{{ number_format($data->income, 2) }}</td>
            <td style="text-align:center;">{{ number_format($data->loss, 2) }}</td>
        </tr>
        @endforeach
        <tr>
            <th colspan="5" style="border:none;">&nbsp;</th>
        </tr>
        <tr>
            <th style="text-align: center; font-weight:bold; background-color:#ffa9a9; border:1px solid #000;">Total</th>
            <th style="text-align: right; font-weight:bold; background-color:#ffa9a9; border:1px solid #000; ">
                &#8369;{{ number_format($datas->sum('total_revenue'), 2) }}
            </th>
            <th style="text-align: right; font-weight:bold; background-color:#ffa9a9; border:1px solid #000;">
                &#8369;{{ number_format($datas->sum('total_expenses'), 2) }}
            </th>
            <th style="text-align: right; font-weight:bold; background-color:#ffa9a9; border:1px solid #000;">
                &#8369;{{ number_format($datas->sum('income'), 2) }}
            </th>
            <th style="text-align: right; font-weight:bold; background-color:#ffa9a9; border:1px solid #000;">
                &#8369;{{ number_format($datas->sum('loss'), 2) }}
            </th>

    </tbody>
</table>