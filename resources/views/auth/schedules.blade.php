<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <div class="bg-gradient-to-r from-red-600 to-red-400 py-10  md:px-20">
        <h1 class="text-white font-900 text-sm sm:text-lg font-bold text-center md:text-start uppercase tracking-wide">Immunization Schedule</h1>
    </div>

    <div class="max-w-7xl mx-auto rounded-xl p-4 sm:p-6  ">
        @if (session('success'))
        <div x-data="{ show: true }" x-show="show"
            class="w-full bg-green-100 border-2 rounded border-green-200 flex justify-between py-2 px-4 ">
            <h1 class="text-md font-bold text-green-600">{{ session('success') }}</h1>
            <button @click="show = false" class="text-lg font-bold text-green-600">
                <i data-lucide="x"></i>
            </button>
        </div>
        @endif
        <div class="p-4">
            <h1 class="font-900 text-2xl sm:text-3xl font-bold text-gray-800">Clinic Schedules</h1>
            <p class="text-md text-gray-500">View upcoming immunizations and vaccination history</p>
        </div>
        <div class=" bg-white  shadow-lg px-8 pt-4 pb-4 rounded-lg flex flex-col gap-2">
            @if($transactions2->isEmpty())
            <p class="text-gray-500 text-center p-4">No Vaccination Card found.</p>
            @endif

            @php $hasVaccine = false; @endphp

            @foreach ($transactions2 as $transaction)

            @php
            $serviceName = strtolower($transaction->service->name);
            @endphp

            @if (str_contains($serviceName, 'booster') || str_contains($serviceName, 'pre') || str_contains($serviceName, 'post') || str_contains($serviceName, 'prophylaxis'))
            @php $hasVaccine = true; @endphp
            <div class="flex flex-col justify-center " x-data="{ open: false }">

                <button @click="open = !open" class="border-2 border-gray-100  w-full flex justify-between items-center px-3 py-2 bg-white text-gray-800 rounded-lg font-semibold hover:bg-gray-50 focus:outline-none">
                    <p>{{ $transaction->service->name }} - <span class="text-xs">
                            {{ date('F d, Y g:i A', strtotime($transaction->transaction_date)) }}
                        </span></p> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>
                <div>
                    <div x-show="open" x-collapse class="overflow-x-auto  px-20 flex flex-col gap-4 p-4">
                        <a href="{{ route('schedule.vaccination_card', ['id' => $transaction->patient_id, 'grouping' => $transaction->id]) }}"
                            target="_blank" class="flex items-center justify-end gap-1  text-blue-500 text-end hover:text-blue-600 font-semibold">
                            <span>Download</span>
                            <i data-lucide="download" class="w-5 h-5" style="stroke-width: 2.5;"></i>
                        </a>

                        <div class="hidden md:block" x-data="{ showFirst: true }">
                            <div x-show="showFirst" class="grid grid-cols-10 gap-2 border-2 border-gray-700 ">
                                <div class="col-span-5 bg-[#EB1C26] flex flex-col p-4">
                                    <h1 class="text-center font-900 text-xl text-white">MGA DAPAT TANDAAN</h1>
                                    <ul class="list-disc text-white p-4 px-10 space-y-2">
                                        <li>BAWAL uminom ng alak ng 30 days.</li>
                                        <li>BAWAL kumain ng manok, itlog, hipon, bagoong, patis at malansang pagkain.</li>
                                        <li>Kung tuturukan ng ERIG, iwasan ang Frozen Foods, fishy-smelling foods, canned foods, noodles, chocolate, peanut at junk foods.</li>
                                        <li>Panatilihing tuyo at iwasang galawin ang sugat sa loob ng 8 oras. Pagkatapos hugasan ang sugat ng sabon at tubig at lagyan ng betadine pagkatapos itong patuyuin. Takpan ang sugat gamit ang gasa sa loob ng 24–48 oras.</li>
                                        <li>Magpacheck-up kung lumalala ang pamamaga, pamumula o kirot, pagkakaroon ng nana ang sugat o may mabahong amoy ang sugat.</li>
                                        <li>Maaaring mamaga ang lugar na pinagturukan, i-warm compress ito. Kapag inilagnat, maaaring uminom ng paracetamol kung walang allergy sa paracetamol.</li>
                                    </ul>
                                    <div class="flex justify-evenly items-center mt-auto">
                                        <img src="{{ asset('images/vaccine-card-title.png') }}" alt="Title Logo" class="w-80 h-16">
                                        <img src="{{ asset('drcare_logo.png') }}" alt="Title Logo" class="w-20 h-20">

                                    </div>
                                </div>
                                <div class="col-span-5 flex flex-col items-center gap-4 mt-2 ">
                                    <div class="w-full ">
                                        <img src="{{ asset('images/vaccine-card-title.png') }}" alt="Title Logo">
                                    </div>
                                    <h1 class="font-900 text-xl text-red-500">VACCINATION CARD</h1>
                                    <div class="w-full flex flex-col gap-2 px-2">
                                        <h2 class="text-lg font-bold">Name: <span class="ml-2 font-normal">{{$transaction->Patient->first_name }} {{$transaction->Patient->last_name }}</span></h2>
                                        <h2 class="text-lg font-bold">Age/Gender: <span class="ml-2 font-normal">{{$transaction->Patient->age }} / {{$transaction->Patient->sex }}</span></h2>
                                        <h2 class="text-lg font-bold">ABC Center Branch: <span class="ml-2 font-normal">Dr. Care ABC Guinobatan</span></h2>
                                        <h2 class="text-lg font-bold">Address: <span class="ml-2 font-normal">{{ $transaction->Patient->address }}</span></h2>
                                    </div>
                                    <div class="w-full border-2 border-red-500"></div>
                                    <div class="w-full flex flex-col gap-2 px-2">
                                        <h1 class="font-bold text-md ">For more Information. Kindly call or message us</h1>
                                        <div class="flex gap-4 items-center">
                                            <div class="p-2 rounded-full bg-red-600">
                                                <i data-lucide="phone" class="w-5 h-5 text-white"></i>
                                            </div>
                                            <div>
                                                <p class="font-bold">Clinic Contact Number</p>
                                                <p>09123456789</p>
                                            </div>
                                        </div>
                                        <div class="flex gap-4 items-center">
                                            <div class="rounded-full">
                                                <img src="{{ asset('socials/facebook.svg') }}" alt="Facebook Logo" class="w-8 h-8 ">
                                            </div>
                                            <div>
                                                <p class="font-bold">Facebook Page</p>
                                                <p>DR. CARE ANIMAL BITE CENTER - GUINOBATAN, ALBAY</p>
                                            </div>
                                        </div>
                                        <div class="flex gap-4 items-center">
                                            <div class="p-2 rounded-full bg-green-500">
                                                <i data-lucide="map-pinned" class="w-5 h-5 text-white"></i>
                                            </div>
                                            <div>
                                                <p>2nd Floor, CPD Building, 164 Rizal St.,Ilawod, Guinobatan, Albay</p>
                                            </div>
                                        </div>
                                        <div class="w-full flex items-end justify-end mb-2">
                                            <img src="{{ asset('images/Logo-DOH.webp') }}" alt="DOH Logo" class="w-28 h-20">
                                            <img src="{{ asset('images/rabies-free.jpg') }}" alt="Rabies Free Logo" class="w-28 h-28">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div x-show="!showFirst" class="grid grid-cols-10 gap-2 border-2 border-gray-700 ">
                                <div class="col-span-5 flex flex-col items-center gap-4 mt-2 px-8 py-2">
                                    <div class="p-2 rounded-2xl border-4 border-red-500 w-64 text-center">
                                        <h1 class="font-900 text-red-500 ">HISTORY OF EXPOSURE</h1>
                                    </div>
                                    <div class="w-full flex flex-col gap-2 ">
                                        @if ($transaction->patientExposures === null)
                                        <h2 class="text-lg font-bold">Date: <span class="ml-2 font-normal"></span></h2>
                                        <h2 class="text-lg font-bold">Place: <span class="ml-2 font-normal"></span></h2>
                                        <h2 class="text-lg font-bold">Type of Animal: <span class="ml-2 font-normal"></span></h2>
                                        @else
                                        <h2 class="text-lg font-bold">Date: <span class="ml-2 font-normal">{{ date('F d, Y', strtotime($transaction->patientExposures->date_time))  }}</span></h2>
                                        <h2 class="text-lg font-bold">Place: <span class="ml-2 font-normal">{{ $transaction->patientExposures->place_of_bite}}</span></h2>
                                        <h2 class="text-lg font-bold">Type of Animal: <span class="ml-2 font-normal">{{ $transaction->patientExposures->animalProfile->species }}</span></h2>
                                        @endif

                                        <!-- Type of Exposure -->
                                        <div class="w-full flex  gap-2 ">
                                            <h2 class="text-lg font-bold">Type of Exposure:</h2>
                                            <label>
                                                <input type="radio"
                                                    disabled
                                                    class="text-red-500"
                                                    @if ($transaction->patientExposures !== null)
                                                {{ strtolower($transaction->patientExposures->type_of_exposure) === 'bite' ? 'checked' : '' }}

                                                @endif
                                                >
                                                Bite
                                            </label>

                                            <label>
                                                <input type="radio"
                                                    disabled
                                                    class="text-red-500"
                                                    @if ($transaction->patientExposures !== null)
                                                {{ strtolower($transaction->patientExposures->type_of_exposure) === 'non-bite' ? 'checked' : '' }}
                                                @endif>
                                                Non-Bite
                                            </label>
                                        </div>
                                    </div>
                                    <div class="p-2 rounded-2xl border-4 border-red-500 w-64 text-center">
                                        <h1 class="font-900 text-red-500">CONDITION OF ANIMAL</h1>
                                    </div>
                                    <div class="w-full flex items-center justify-center gap-4 ">
                                        @if ($transaction->patientExposures === null)
                                        @php
                                        $status = '';
                                        @endphp
                                        @else
                                        @php
                                        $status = strtolower($transaction->patientExposures->animalProfile->clinical_status);
                                        @endphp
                                        @endif

                                        <label>
                                            <input type="radio" disabled class="text-red-500"
                                                {{ $status === 'healthy' ? 'checked' : '' }}>
                                            Healthy
                                        </label>

                                        <label>
                                            <input type="radio" disabled class="text-red-500"
                                                {{ $status === 'lost' ? 'checked' : '' }}>
                                            Lost
                                        </label>

                                        <label>
                                            <input type="radio" disabled class="text-red-500"
                                                {{ $status === 'sick' ? 'checked' : '' }}>
                                            Sick
                                        </label>

                                        <label>
                                            <input type="radio" disabled class="text-red-500"
                                                {{ $status === 'died' ? 'checked' : '' }}>
                                            Died
                                        </label>

                                    </div>
                                    <div class="p-2 rounded-2xl border-4 border-red-500 w-64 text-center">
                                        <h1 class="font-900 text-red-500">CATEGORY</h1>
                                    </div>
                                    <div class="w-full flex items-center justify-center gap-4  text-lg">
                                        @if ($transaction->patientExposures === null)
                                        @php
                                        $biteCategory = '';
                                        @endphp
                                        @else
                                        @php
                                        $biteCategory = strtoupper($transaction->patientExposures->bite_category);
                                        @endphp
                                        @endif
                                        <h1 class="font-bold px-2 py-1 rounded {{ $biteCategory === '1' ? 'bg-red-500 text-white' : 'text-gray-600' }}">
                                            I
                                        </h1>
                                        <h1 class="font-bold px-2 py-1 rounded {{ $biteCategory === '2' ? 'bg-red-500 text-white' : 'text-gray-600' }}">
                                            II
                                        </h1>
                                        <h1 class="font-bold px-2 py-1 rounded {{ $biteCategory === '3' ? 'bg-red-500 text-white' : 'text-gray-600' }}">
                                            III
                                        </h1>
                                    </div>
                                    <div class="p-2 rounded-2xl border-4 border-red-500 w-64 text-center">
                                        <h1 class="font-900 text-red-500">VACCINE USED</h1>
                                    </div>
                                    <div class="w-full flex items-start justify-start gap-2 ">
                                        <h2 class="text-lg font-bold">Anti-Rabies: </h2>
                                        @php
                                        $productType = strtoupper( $transaction->immunizations->vaccineUsed->item->product_type ?? '');
                                        @endphp
                                        <label>
                                            <input type="radio" disabled class="text-red-500"
                                                {{ $productType === 'PVRV' ? 'checked' : '' }}>
                                            PVRV
                                        </label>
                                        <label>
                                            <input type="radio" disabled class="text-red-500"
                                                {{ $productType === 'PCEC' ? 'checked' : '' }}>
                                            PCEC
                                        </label>
                                    </div>
                                    <div class="w-full flex flex-col gap-2 ">
                                        <h2 class="text-lg font-bold">Brand Name: <span class="ml-2 font-normal">{{ $transaction->immunizations->vaccineUsed->item->brand_name ?? '' }}</span></h2>
                                        @php
                                        $route = strtolower($transaction->immunizations->route_of_administration ?? '');
                                        @endphp
                                        <h2 class="text-lg font-bold">Route: <span class="ml-2 font-normal"></span></h2>
                                        <div class="flex gap-2">
                                            <label>
                                                <input type="checkbox" disabled class="text-red-500 rounded-lg"
                                                    {{ $route === 'intradermal' ? 'checked' : '' }}>
                                                ID
                                            </label>
                                            <label>
                                                <input type="checkbox" disabled class="text-red-500 rounded-lg"
                                                    {{ $route === 'intramuscular' ? 'checked' : '' }}>
                                                IM
                                            </label>
                                        </div>
                                        <h2 class="text-lg font-bold">
                                            Tetanus Toxoid:
                                            <span class="ml-2 font-normal">
                                                @if(!empty($transaction->immunizations->antiTetanusUsed->item->brand_name) && !empty($transaction->immunizations->date_given))
                                                {{ date('F d, Y', strtotime($transaction->immunizations->date_given)) }}
                                                @else
                                                N/A
                                                @endif
                                            </span>
                                        </h2>

                                        <h2 class="text-lg font-bold">
                                            RIG:
                                            <span class="ml-2 font-normal">
                                                @if(!empty($transaction->immunizations->rigUsed->item->brand_name) && !empty($transaction->immunizations->date_given))
                                                {{ $transaction->immunizations->rigUsed->item->brand_name }} -
                                                {{ date('F d, Y', strtotime($transaction->immunizations->date_given)) }}
                                                @else
                                                N/A
                                                @endif
                                            </span>
                                        </h2>

                                    </div>

                                </div>
                                @php
                                // Get all schedules for this transaction's grouping
                                $schedules = $transaction->allSchedules;
                                @endphp

                                <div class="col-span-5 flex flex-col items-center gap-4 mt-2 py-2 ">

                                    {{-- PRE EXPOSURE --}}
                                    <div class="p-2 px-6 rounded-lg bg-red-500 text-center ">
                                        <h1 class="font-900 text-white ">PRE EXPOSURE PROPHYLAXIS</h1>
                                    </div>
                                    <div class="w-full flex flex-col gap-2 px-4">
                                        <table class="w-full text-sm text-center border-2 border-gray-700 text-gray-700">
                                            <thead>
                                                <tr class="font-900">
                                                    <th class="px-4 py-2 border">DAY</th>
                                                    <th class="px-4 py-2 border">DATE</th>
                                                    <th class="px-4 py-2 border">DOSE</th>
                                                    <th class="px-4 py-2 border">NURSE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($schedules->where('service_id', 2) as $schedule)
                                                <tr>
                                                    <td class="px-4 py-2 border">{{ $schedule->Day }}</td>
                                                    <td class="px-4 py-2 border">
                                                        @if ($schedule->date_completed)
                                                        {{$schedule->date_completed}}
                                                        @else
                                                        {{ $schedule->scheduled_date }}
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-2 border"> @if (!is_null($schedule->dose))
                                                        {{ rtrim(rtrim(number_format($schedule->dose, 2, '.', ''), '0'), '.') }} ml
                                                        @endif
                                                    </td>
                                                    @if ($schedule->nurse === null)
                                                    <td class="px-4 py-2 border"></td>
                                                    @else
                                                    <td class="px-4 py-2 border">{{ $schedule->nurse->first_name}} {{ $schedule->nurse->last_name}}</td>
                                                    @endif
                                                </tr>
                                                @empty
                                                {{-- fallback rows --}}
                                                <tr>
                                                    <td class="px-4 py-2 border">D0</td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                </tr>
                                                <tr>
                                                    <td class="px-4 py-2 border">D7</td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                </tr>
                                                <tr>
                                                    <td class="px-4 py-2 border">D28</td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- POST EXPOSURE --}}
                                    <div class="p-2 px-6 rounded-lg bg-red-500 text-center ">
                                        <h1 class="font-900 text-white ">POST EXPOSURE PROPHYLAXIS</h1>
                                    </div>
                                    <div class="w-full flex flex-col gap-2 px-4">
                                        <table class="w-full text-sm text-center border-2 border-gray-700 text-gray-700">
                                            <thead>
                                                <tr class="font-900">
                                                    <th class="px-4 py-2 border">DAY</th>
                                                    <th class="px-4 py-2 border">DATE</th>
                                                    <th class="px-4 py-2 border">DOSE</th>
                                                    <th class="px-4 py-2 border">NURSE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($schedules->where('service_id', 1) as $schedule)
                                                <tr>
                                                    <td class="px-4 py-2 border">{{ $schedule->Day }}</td>
                                                    <td class="px-4 py-2 border">
                                                        @if ($schedule->date_completed)
                                                        {{$schedule->date_completed}}
                                                        @else
                                                        {{ $schedule->scheduled_date }}
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-2 border"> @if (!is_null($schedule->dose))
                                                        {{ rtrim(rtrim(number_format($schedule->dose, 2, '.', ''), '0'), '.') }} ml
                                                        @endif
                                                    </td>
                                                    @if ($schedule->nurse === null)
                                                    <td class="px-4 py-2 border"></td>
                                                    @else
                                                    <td class="px-4 py-2 border">{{ $schedule->nurse->first_name}} {{ $schedule->nurse->last_name}}</td>
                                                    @endif
                                                </tr>
                                                @empty
                                                {{-- fallback rows --}}
                                                <tr>
                                                    <td class="px-4 py-2 border">D0</td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                </tr>
                                                <tr>
                                                    <td class="px-4 py-2 border">D3</td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                </tr>
                                                <tr>
                                                    <td class="px-4 py-2 border">D7</td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                </tr>
                                                <tr>
                                                    <td class="px-4 py-2 border">D14</td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                </tr>
                                                <tr>
                                                    <td class="px-4 py-2 border">D28</td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- BOOSTER --}}
                                    <div class="p-2 px-6 rounded-lg bg-red-500 text-center ">
                                        <h1 class="font-900 text-white ">BOOSTER</h1>
                                    </div>
                                    <div class="w-full flex flex-col gap-2 px-4">
                                        <table class="w-full text-sm text-center border-2 border-gray-700 text-gray-700">
                                            <thead>
                                                <tr class="font-900">
                                                    <th class="px-4 py-2 border">DAY</th>
                                                    <th class="px-4 py-2 border">DATE</th>
                                                    <th class="px-4 py-2 border">DOSE</th>
                                                    <th class="px-4 py-2 border">NURSE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($schedules->where('service_id', 3) as $schedule)
                                                <tr>
                                                    <td class="px-4 py-2 border">{{ $schedule->Day }}</td>
                                                    <td class="px-4 py-2 border">
                                                        @if ($schedule->date_completed)
                                                        {{$schedule->date_completed}}
                                                        @else
                                                        {{ $schedule->scheduled_date }}
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-2 border"> @if (!is_null($schedule->dose))
                                                        {{ rtrim(rtrim(number_format($schedule->dose, 2, '.', ''), '0'), '.') }} ml
                                                        @endif
                                                    </td>
                                                    @if ($schedule->nurse === null)
                                                    <td class="px-4 py-2 border"></td>
                                                    @else
                                                    <td class="px-4 py-2 border">{{ $schedule->nurse->first_name}} {{ $schedule->nurse->last_name}}</td>
                                                    @endif
                                                </tr>
                                                @empty
                                                {{-- fallback rows --}}
                                                <tr>
                                                    <td class="px-4 py-2 border">D0</td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                </tr>
                                                <tr>
                                                    <td class="px-4 py-2 border">D2</td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                    <td class="px-4 py-2 border"></td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                            <div class="col-span-5 flex  items-center justify-center gap-4 mt-2">
                                <!-- content ... -->
                                <button
                                    @click="showFirst = true"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                    <i data-lucide="chevron-left"></i>
                                </button>
                                <button
                                    @click="showFirst = false"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                    <i data-lucide="chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            @endif
            @endforeach
            @if (!$hasVaccine)
            <p class="text-gray-500 text-center p-4">No Vaccination Card found.</p>
            @endif

        </div>
    </div>

</x-app-layout>