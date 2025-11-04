<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Vaccination Card</title>
</head>

<body style="margin:0; padding:0; font-family:Arial, sans-serif;">
    @foreach ($transactions2 as $transaction)
    <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center"
        style="max-width:800px; border:1px solid #000; background-color:#fff;">
        <tr>
            <!-- LEFT RED PANEL -->
            <td width="45%" valign="top"
                style="background-color:#E31E24; color:#fff; padding:25px; vertical-align:top;">
                <h2 style="margin-top:0; font-size:16px; text-align:center;">MGA DAPAT TANDAAN</h2>
                <ul style="padding-left:20px; line-height:1.6; margin-top:15px; font-size:12px;">
                    <li>BAWAL uminom ng alak ng 30 days.</li>
                    <li>BAWAL kumain ng manok, itlog, hipon, bagoong, patis at malansang pagkain.</li>
                    <li>Kung tuturukan ng ERIG, iwasan ang Frozen Foods, fishy-smelling foods, canned foods, noodles,
                        chocolate, peanut at junk foods.</li>
                    <li>Panatilihing tuyo at iwasang galawin ang sugat sa loob ng 8 oras. Pagkatapos hugasan ang sugat ng
                        sabon at tubig at lagyan ng betadine pagkatapos itong patuyuin. Takpan ang sugat gamit ang gasa
                        sa loob ng 24–48 oras.</li>
                    <li>Magpa-check-up kung lumalala ang pamamaga, pamumula o kirot, pagkakaroon ng nana ang sugat o may
                        mabahong amoy ang sugat.</li>
                    <li>Maaaring mamaga ang lugar na pinag-turukan, i-warm compress ito. Kapag nilagnat, maaaring uminom
                        ng paracetamol kung walang allergy sa paracetamol.</li>
                </ul>

                <!-- Logos bottom-left -->
                <table width="100%" cellpadding="5" cellspacing="0" border="0"
                    style="margin-top:40px; text-align:center;">
                    <tr>
                        <td align="center">
                            <img src="{{ public_path('images/vaccine-card-title.png') }}" alt="Vaccine Card Title"
                                style="width:200px; height:auto; display:block; margin:0 auto;">
                        </td>
                        <td align="center">
                            <img src="{{ public_path('drcare_logo.png') }}" alt="ABC Logo"
                                style="width:50px; height:auto; display:block; margin:0 auto;">
                        </td>
                    </tr>
                </table>
            </td>

            <!-- RIGHT WHITE PANEL -->
            <td width="55%" valign="top" style="padding:25px; color:#333;">
                <!-- Top Logo -->
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td align="left">
                            <img src="{{ public_path('images/vaccine-card-title.png') }}" alt="Vaccine Card Title"
                                style="width:350px; height:auto;">
                        </td>
                    </tr>
                </table>

                <h2 style="color:#E31E24; margin-top:15px; font-size:20px; font-weight: 800; font-family:Arial, sans-serif; text-align:center;"> VACCINATION CARD</h2>

                <p style="font-size:13px;"><strong>Name:</strong> {{ $transaction->Patient->first_name }} {{ $transaction->Patient->last_name }}</p>
                <p style="font-size:13px;"><strong>Age/Gender:</strong> {{ $transaction->Patient->age }} / {{ $transaction->Patient->sex }}</p>
                <p style="font-size:13px;"><strong>ABC Center Branch:</strong> Dr. Care ABC Guinobatan</p>
                <p style="font-size:13px;"><strong>Address:</strong> {{ $transaction->Patient->address }}</p>

                <hr style="border:0; border-top:2px solid #E31E24; margin:18px 0;">

                <p style="font-weight:bold; font-size:14px;">For more Information. Kindly call or message us</p>
                <p style="font-size:12px;">
                    <img src="{{ public_path('socials/phone.svg') }}" alt="Phone Logo"
                        style="width:14px; height:auto; display:block; margin:0 auto;">
                    <strong>Clinic Contact Number:</strong><br>09123456789
                </p>
                <p style="font-size:12px;">
                    <img src="{{ public_path('socials/facebook.svg') }}" alt="Facebook Logo"
                        style="width:14px; height:auto; display:block; margin:0 auto;">
                    <strong>Facebook Page:</strong><br>DR. CARE ANIMAL BITE CENTER - GUINOBATAN, ALBAY
                </p>
                <p style="font-size:12px;">
                    <img src="{{ public_path('socials/map-pinned.svg') }}" alt="Map Pinned Logo"
                        style="width:14px; height:auto; display:block; margin:0 auto;">
                    <strong>Address:</strong><br>2nd Floor, CPD Building, 164 Rizal St., Ilawod, Guinobatan, Albay
                </p>

                <div style="margin-top:20px;">
                    <img src="{{ public_path('images/Logo-DOH.webp') }}" alt="DOH Logo"
                        style="width:50px; height:auto; margin-right:20px;">
                    <img src="{{ public_path('images/rabies-free.jpg') }}" alt="Rabies Free Logo"
                        style="width:60px; height:auto;">
                </div>
            </td>
        </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="6" style="font-size:13px;  border:1px solid #000;">
        <tr>
            <td width="50%" valign="top" style="border-right:1px solid #777; padding:10px;">
                <div style="border:3px solid #E31E24; border-radius:12px; padding:4px; text-align:center; width:200px; margin:0 auto 10px;">
                    <strong style="color:#E31E24;">HISTORY OF EXPOSURE</strong>
                </div>
                <p>
                    <strong>Date:</strong>
                    @if($transaction->patientExposures?->date_time)
                    {{ date('F d, Y', strtotime($transaction->patientExposures->date_time)) }}
                    @else
                    N/A
                    @endif
                </p>
                <p><strong>Place:</strong> {{ $transaction->patientExposures->place_of_bite ?? 'N/A' }}</p>
                <p><strong>Type of Animal:</strong> {{ $transaction->patientExposures?->animalProfile?->species ?? 'N/A' }}</p>
                <p><strong>Type of Exposure:</strong>
                    {{ ucfirst($transaction->patientExposures->type_of_exposure ?? 'N/A') }}
                </p>

                <div style="border:3px solid #E31E24; border-radius:12px; padding:4px; text-align:center; width:200px; margin:10px auto;">
                    <strong style="color:#E31E24;">CONDITION OF ANIMAL</strong>
                </div>
                <p style="text-align: center;">{{ $transaction->patientExposures->animalProfile->clinical_status ?? 'N/A' }}</p>

                <div style="border:3px solid #E31E24; border-radius:12px; padding:4px; text-align:center; width:200px; margin:10px auto;">
                    <strong style="color:#E31E24;">CATEGORY</strong>
                </div>
                @php
                $bite = $transaction->patientExposures->bite_category ?? 'N/A';
                @endphp
                <div style="text-align:center; font-weight:bold; font-size:14px;">
                    @if ($bite == 1)
                    <span style="padding:4px; background:#E31E24; color:white; border-radius:4px;">I</span>
                    @elseif ($bite == 2)
                    <span style="padding:4px; background:#E31E24; color:white; border-radius:4px;">II</span>
                    @elseif ($bite == 3)
                    <span style="padding:4px; background:#E31E24; color:white; border-radius:4px;">III</span>
                    @else
                    <span style="font-weight: normal;">N/A</span>
                    @endif
                </div>

                <div style="border:3px solid #E31E24; border-radius:12px; padding:4px; text-align:center; width:200px; margin:10px auto;">
                    <strong style="color:#E31E24;">VACCINE USED</strong>
                </div>
                <p><strong>Anti-Rabies:</strong> {{ strtoupper($transaction->immunizations->vaccineUsed->item->product_type ?? '') }}</p>
                <p><strong>Brand Name:</strong> {{ $transaction->immunizations->vaccineUsed->item->brand_name ?? '' }}</p>
                <p><strong>Route:</strong> {{ strtoupper($transaction->immunizations->route_of_administration ?? '') }}</p>
                <p>
                    <strong>Tetanus Toxoid:</strong>
                    @if(!empty($transaction->immunizations?->antiTetanusUsed?->item?->brand_name) && !empty($transaction->immunizations?->date_given))
                    {{ date('F d, Y', strtotime($transaction->immunizations->date_given)) }}
                    @else
                    N/A
                    @endif
                </p>

                <p>
                    <strong>RIG:</strong>
                    @if(!empty($transaction->immunizations?->rigUsed?->item?->brand_name) && !empty($transaction->immunizations?->date_given))
                    {{ $transaction->immunizations->rigUsed->item->brand_name }} -
                    {{ date('F d, Y', strtotime($transaction->immunizations->date_given)) }}
                    @else
                    N/A
                    @endif
                </p>


            </td>

            <!-- RIGHT TABLES -->
            <td width="50%" valign="top" style="padding-left:10px;">
                @php $schedules = $transaction->allSchedules; @endphp

                <!-- PRE EXPOSURE -->
                <div style="background:#E31E24; color:white; text-align:center; padding:4px; font-weight:bold; margin-top:4px; margin-bottom:5px; border-radius:5px;">PRE EXPOSURE PROPHYLAXIS</div>
                <table width="100%" border="1" cellspacing="0" cellpadding="4" style="font-size:12px; border-collapse:collapse; text-align:center;">
                    <thead>
                        <tr>
                            <th>DAY</th>
                            <th>DATE</th>
                            <th>DOSE</th>
                            <th>NURSE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules->where('service_id', 2) as $schedule)
                        <tr>
                            <td>{{ $schedule->Day }}</td>
                            <td>
                                @if ($schedule->date_completed)
                                {{$schedule->date_completed}}
                                @else
                                {{ $schedule->scheduled_date }}
                                @endif
                            </td>
                            <td> @if (!is_null($schedule->dose))
                                {{ rtrim(rtrim(number_format($schedule->dose, 2, '.', ''), '0'), '.') }} ml
                                @endif
                            </td>
                            @if ($schedule->nurse === null)
                            <td></td>
                            @else
                            <td>{{ $schedule->nurse->first_name}} {{ $schedule->nurse->last_name}}</td>
                            @endif
                        </tr>
                        @empty
                        {{-- fallback rows --}}
                        <tr>
                            <td>D0</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>D7</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>D28</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- POST EXPOSURE -->
                <div style="background:#E31E24; color:white; text-align:center; padding:4px; font-weight:bold; margin-top:4px; margin-bottom:5px; border-radius:5px;">POST EXPOSURE PROPHYLAXIS</div>
                <table width="100%" border="1" cellspacing="0" cellpadding="4" style="font-size:12px; border-collapse:collapse; text-align:center;">
                    <thead>
                        <tr>
                            <th>DAY</th>
                            <th>DATE</th>
                            <th>DOSE</th>
                            <th>NURSE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules->where('service_id', 1) as $schedule)
                        <tr>
                            <td>{{ $schedule->Day }}</td>
                            <td>
                                @if ($schedule->date_completed)
                                {{$schedule->date_completed}}
                                @else
                                {{ $schedule->scheduled_date }}
                                @endif
                            </td>
                            <td> @if (!is_null($schedule->dose))
                                {{ rtrim(rtrim(number_format($schedule->dose, 2, '.', ''), '0'), '.') }} ml
                                @endif
                            </td>
                            @if ($schedule->nurse === null)
                            <td></td>
                            @else
                            <td>{{ $schedule->nurse->first_name}} {{ $schedule->nurse->last_name}}</td>
                            @endif
                        </tr>
                        @empty
                        {{-- fallback rows --}}
                        <tr>
                            <td>D0</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>D3</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>D7</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>D14</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>D28</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- BOOSTER -->
                <div style="background:#E31E24; color:white; text-align:center; padding:4px; font-weight:bold; margin-top:4px; margin-bottom:5px; border-radius:5px;">BOOSTER</div>
                <table width="100%" border="1" cellspacing="0" cellpadding="4" style="font-size:12px; border-collapse:collapse; text-align:center;">
                    <thead>
                        <tr>
                            <th>DAY</th>
                            <th>DATE</th>
                            <th>DOSE</th>
                            <th>NURSE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules->where('service_id', 3) as $schedule)
                        <tr>
                            <td>{{ $schedule->Day }}</td>
                            <td>
                                @if ($schedule->date_completed)
                                {{$schedule->date_completed}}
                                @else
                                {{ $schedule->scheduled_date }}
                                @endif
                            </td>
                            <td> @if (!is_null($schedule->dose))
                                {{ rtrim(rtrim(number_format($schedule->dose, 2, '.', ''), '0'), '.') }} ml
                                @endif
                            </td>
                            @if ($schedule->nurse === null)
                            <td></td>
                            @else
                            <td>{{ $schedule->nurse->first_name}} {{ $schedule->nurse->last_name}}</td>
                            @endif
                        </tr>
                        @empty
                        {{-- fallback rows --}}
                        <tr>
                            <td>D0</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>D2</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    @endforeach
</body>

</html>