<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin - {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('drcare_logo.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/chart.js','resources/js/datetime.js', 'resources/js/address.js', 'resources/js/alpine.js'])
    @endif
</head>

<body>
    <div class="flex h-screen">

        <!-- Sidebar -->
        <div id="sidebar"
            class="side-bar w-56 fixed inset-y-0 bg-white text-black flex flex-col border-r border-gray-300 z-50 transform -translate-x-full md:translate-x-0"
            style="height: calc(var(--vh, 1vh) * 100);">

            <div class="absolute top-20 right-[-0.6rem] ">
                <button id="closeSidebar" class="text-white text-2xl hidden md:hidden">
                    <i data-lucide="circle-chevron-right" class="w-6 h-6 stroke-white fill-[#FF000D]"></i>
                </button>
            </div>
            <!-- Logo -->
            <div class="flex items-center">
                <img src="{{ asset('images/nav-pic.png') }}" alt="Navigation Logo" class="hidden md:block w-full">
            </div>
            <!-- Navigation (scrollable) -->
            <nav class="flex-1 overflow-y-auto min-h-0 px-4 py-0 text-md scrollbar-hidden mt-20 md:mt-0">
                <ul class="space-y-0.5">
                    <li class="flex items-center px-2 mb-4 block md:hidden">
                        <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-14 h-14">
                        <a href="{{ route('clinic.dashboard') }}" class="block px-2 py-2 rounded text-2xl text-[#FF000D] font-900 flex items-center gap-3">Dr.Care </a>
                    </li>

                    <li><a href="{{ route('clinic.dashboard') }}" class="mt-3 block px-4 py-2 rounded hover:bg-gray-900 hover:text-white  flex items-center gap-3"><i data-lucide="layout-dashboard" class="w-5 h-5"></i>Dashboard</a></li>
                    <p class="text-xs font-bold text-gray-400 my-1 uppercase">Patient Management</p>
                    <li><a href="{{ route('clinic.patients')}}" class="block px-4 py-2 rounded bg-gray-900 text-white flex items-center gap-3"><i data-lucide="users" class="w-5 h-5"></i>Patients</a></li>
                    <li><a href="{{ route('clinic.appointments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="notebook-pen" class="w-5 h-5"></i>Appointments</a></li>
                    <li><a href="{{ route('clinic.messages') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="message-square-text" class="w-5 h-5"></i>Messages</a></li>

                    <p class="text-xs font-bold text-gray-400 my-1 uppercase">Clinic Management</p>
                    <li><a href="{{route('clinic.supplies')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="package" class="w-5 h-5"></i>Inventory</a></li>
                    <li><a href="{{ route('clinic.transactions')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-text" class="w-5 h-5"></i>Transactions</a></li>
                    <li><a href="{{ route('clinic.payments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="philippine-peso" class="w-5 h-5"></i>Payments </a></li>
                    @if ($clinicUser && $clinicUser->UserRole && strtolower($clinicUser->UserRole->role_name) === 'admin')

                    <li><a href="{{ route('clinic.services') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="briefcase-medical" class="w-5 h-5"></i>Services</a></li>
                    <li><a href="{{ route('clinic.reports')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="chart-column-big" class="w-5 h-5"></i>Reports</a></li>
                    <p class="text-xs font-bold text-gray-400 my-1 uppercase">User Management</p>
                    <li><a href="{{route('clinic.user-accounts')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-user" class="w-5 h-5"></i>Accounts</a></li>
                    <li><a href="{{route('clinic.user-logs')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="logs" class="w-5 h-5"></i>Logs</a></li>
                    @endif
                </ul>
            </nav>
            <div class="flex flex-col px-4 py-2 gap-2">
                <a href="{{ route('clinic.profile') }}" class="flex flex-row items-center justify-between text-center w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-500">
                    <i data-lucide="circle-user" class="w-6 h-6"></i>
                    <div class="flex flex-col items-center">
                        <h1 class="text-sm font-bold">{{ $clinicUser->first_name }}</h1>
                        <p class="text-xs">{{$clinicUser->UserRole->role_name}}</p>
                    </div>
                    <i data-lucide="sliders-horizontal" class="w-4 h-4"></i>
                </a>
                <div>
                    <button onclick="document.getElementById('logoutModal').classList.remove('hidden')" class="w-full bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-900 flex items-center justify-center gap-2"><i data-lucide="log-out" class="w-4 h-4"></i>
                        Logout
                    </button>
                </div>

            </div>
        </div>
        <!-- Main Content -->
        <section id="mainContent" class="flex-1 ml-0 md:ml-56 h-full  ">
            <div class="fixed top-0 w-full z-50  bg-gray-900 p-3 flex items-center gap-10 justify-between md:justify-start shadow-lg">
                <button id="toggleSidebar" class="text-white block ml-2 focus:outline-none ">
                    ☰ </button>
                <div class="flex items-center gap-5">
                    <!-- date and time -->
                    <div class="flex items-center justify-between gap-3 pr-5">
                        <i data-lucide="calendar-clock" class="text-white w-8 h-8"></i>
                        <div id="datetime" class="md:text-md text-sm text-white font-bold"></div>
                    </div>
                    <!-- Notification Component -->
                    <x-notification />
                </div>
            </div>
            <!-- content container -->
            <div class="flex flex-col flex-1  pt-[60px]">
                <div class="flex flex-row items-center md:gap-5 gap-3 py-8 md:px-14 px-4">
                    <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-16 h-16">
                    <div class="flex flex-col gap-2">
                        <div class="flex item-center gap-2">
                            <h1 class="text-xl md:text-3xl font-900">Registered Patient</h1>
                            <div class="flex justify-center items-center">
                                <a href="{{ route('clinic.user-manual') }}#patient-view" target="_blank" class="text-[#FF000D]"> <i data-lucide="circle-question-mark" class="w-5 h-5"></i>
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('clinic.patients') }}" class="font-bold hover:text-red-500 hover:underline underline-offset-4">Patient</a>
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            <p class="font-bold text-red-500">{{ $patient->first_name }} {{ $patient->last_name }} Information</p>
                        </div>

                    </div>
                </div>

                <div class="grid grid-cols-12">
                    <div class="col-span-3 md:col-span-1 flex items-center justify-center">
                        <a href="{{ route('clinic.patients') }}" class="text-blue-500 hover:underline flex items-center underline-offset-4 font-bold"><i data-lucide="chevron-left" class="w-5 h-5"></i>Back</a>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="grid grid-cols-4 p-4  md:px-10 gap-2 ">
                    <div class="col-span-4  ">
                        <div class="flex border-b border-gray-200 rounded overflow-x-auto gap-2">
                            <button class="tab-btn w-full px-4 py-2 text-red-500 border-b-4 border-red-500 hover:text-red-500 hover:border-red-500 font-bold" data-tab="tab1">
                                Profile Details
                            </button>

                            <button class="tab-btn w-full px-4 py-2 text-gray-600 border-b-4 border-transparent hover:text-red-500 hover:border-red-500 font-bold" data-tab="tab2">
                                Immunizations <span class="text-sm">(Previous)</span>
                            </button>
                            <button class="tab-btn w-full px-4 py-2 text-gray-600 border-b-4 border-transparent hover:text-red-500 hover:border-red-500 font-bold" data-tab="tab3">
                                Immunizations <span class="text-sm">(Current)</span>
                            </button>
                            <button class="tab-btn w-full px-4 py-2 text-gray-600 border-b-4 border-transparent hover:text-red-500 hover:border-red-500 font-bold" data-tab="tab7">
                                Vaccination Card
                            </button>
                            <button class="tab-btn w-full px-4 py-2 text-gray-600 border-b-4 border-transparent hover:text-red-500 hover:border-red-500 font-bold" data-tab="tab4">
                                Schedules </button>
                            <button class="tab-btn w-full px-4 py-2 text-gray-600 border-b-4 border-transparent hover:text-red-500 hover:border-red-500 font-bold" data-tab="tab5">
                                Transactions
                            </button>
                            <button class="tab-btn w-full px-4 py-2 text-gray-600 border-b-4 border-transparent hover:text-red-500 hover:border-red-500 font-bold" data-tab="tab6">
                                Payments
                            </button>

                        </div>

                        <!-- Tab contents -->
                        <div class=" mt-4">
                            <!-- profile -content  -->
                            <div id="tab1" class="tab-content p-8 shadow-lg rounded-lg">
                                <div class="flex flex-col justify-center items-center p-2 gap-6 ">
                                    <div class="w-full text-center">
                                        <h1 class="font-900 text-red-500 text-2xl">Profile Information</h1>
                                    </div>
                                    <div class="flex flex-col">
                                        <!-- success div  -->
                                        @if (session('profile-success'))
                                        <div
                                            x-data="{ show: true }"
                                            x-show="show"
                                            class="w-full bg-green-100 border-2 rounded border-green-200 flex justify-between py-2 px-4 ">
                                            <h1 class="text-md font-bold text-green-600">{{ session('profile-success') }}</h1>
                                            <button @click="show = false" class="text-lg font-bold text-green-600">
                                                <i data-lucide="x"></i>
                                            </button>
                                        </div>
                                        @endif
                                        <!-- end of success div  -->

                                        <div class="flex flex-col md:flex-row gap-20 justify-center items-center text-lg">
                                            <div class="flex items-center justify-center rounded-full bg-red-500 p-4 md:w-52 md:h-52 w-28 h-28">
                                                <i data-lucide="user"
                                                    class="w-full h-full text-gray-100 [stroke-width:1.55]"></i>
                                            </div>
                                            <div class="flex flex-col  gap-4">
                                                <div class="flex gap-2 italic text-xs md:text-sm items-end justify-end">
                                                    <p>Registration Date:</p>
                                                    <p>{{ date('F d, Y', strtotime($patient->registration_date)) }}</p>
                                                </div>
                                                <div class="border-2 border-gray-50"></div>
                                                <div class="flex gap-4 justify-start items-start">
                                                    <div class="flex flex-col items-start gap-2 font-normal">
                                                        <p><span class="font-semibold">Name:</span> {{ $patient->first_name }} {{ $patient->middle_initial }} {{ $patient->last_name }} {{$patient->suffix}} </p>
                                                        <p><span class="font-semibold">Birthdate:</span> {{ date('F d, Y', strtotime($patient->birthdate)) }}</p>
                                                        <p><span class="font-semibold">Gender:</span> {{ $patient->sex }}</p>
                                                        <p><span class="font-semibold">Age:</span> {{ $patient->age }} yrs old</p>
                                                    </div>
                                                </div>
                                                <div class="border-2 border-gray-50"></div>
                                                <div class="flex gap-4 justify-start items-start">
                                                    <div class="flex flex-col gap-2 items-start font-normal">
                                                        <p><span class="font-semibold">Phone:</span> {{ preg_replace('/(\d{4})(\d{3})(\d{4})/', '$1 $2 $3', $patient->contact_number) }}</p>
                                                        @if ($patient->email)
                                                        <p><span class="font-semibold">Email:</span> {{ $patient->email}}</p>
                                                        @endif
                                                        <p><span class="font-semibold">Address:</span> {{ $patient->address }}</p>
                                                    </div>
                                                </div>

                                                <div>
                                                    <button
                                                        onclick="document.getElementById('EditPatientProfile').showModal()"
                                                        class="text-white bg-blue-600 px-4 py-2 rounded-lg flex items-center gap-1 text-sm focus:outline-none font-900 hover:bg-blue-500">
                                                        <i data-lucide="square-pen" class="w-5 h-5" stroke-width="3"></i>Edit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end of profile content  -->

                            <!-- previous immunization content  -->
                            <div id="tab2" class="tab-content hidden  p-8 shadow-lg rounded-lg">
                                <!-- Anti-Tetanus Table -->
                                <div class="flex flex-col gap-3">
                                    <div>
                                        <h1 class="font-bold text-xl">Previous Anti-Tetanus Immunizations</h1>
                                    </div>
                                    <div class="overflow-x-auto mb-6">
                                        <table class="min-w-full  text-sm text-center">
                                            <thead class="bg-gray-800 text-white">
                                                <tr>
                                                    <th class="px-4 py-2 border rounded-tl-lg">Dose Brand</th>
                                                    <th class="px-4 py-2 border">Dose Given</th>
                                                    <th class="px-4 py-2 border">RN In-Charge</th>
                                                    <th class="px-4 py-2 border rounded-tr-lg">Date Given</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($previousAntiTetanus->isEmpty())
                                                <tr>
                                                    <td colspan="4" class="px-4 py-4 border text-center text-gray-500">
                                                        No previous immunizations found
                                                    </td>
                                                </tr>
                                                @else
                                                @foreach ($previousAntiTetanus as $antitetanus)
                                                <tr>
                                                    <td class="px-4 py-2 border">{{ $antitetanus->dose_brand }}</td>
                                                    <td class="px-4 py-2 border">{{ $antitetanus->dose_given }}</td>
                                                    <td class="px-4 py-2 border">{{ $antitetanus->nurse->first_name }} {{ $antitetanus->nurse->middle_initial }} {{ $antitetanus->nurse->last_name }} </td>
                                                    <td class="px-4 py-2 border">{{ $antitetanus->date_dose_given }}</td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <!-- Anti-Rabies Table -->
                                <div class="flex flex-col gap-3 mt-4">
                                    <div>
                                        <h1 class="font-bold text-xl">Previous Anti-Rabies Immunizations</h1>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full  text-sm text-center">
                                            <thead class="bg-gray-800 text-white">
                                                <tr>
                                                    <th class="px-4 py-2 border rounded-tl-lg">Immunization Type</th>
                                                    <th class="px-4 py-2 border">Place of Immunization</th>
                                                    <th class="px-4 py-2 border rounded-tr-lg">Date Given</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($previousAntiRabies->isEmpty())
                                                <tr>
                                                    <td colspan="4" class="px-4 py-4 border text-center text-gray-500">
                                                        No previous immunizations found
                                                    </td>
                                                </tr>
                                                @else
                                                @foreach ($previousAntiRabies as $antirabies)
                                                <tr>
                                                    <td class="px-4 py-2 border">{{ $antirabies->immunization_type }}</td>
                                                    <td class="px-4 py-2 border">{{ $antirabies->place_of_immunization }}</td>
                                                    <td class="px-4 py-2 border">{{ $antirabies->date_dose_given }}</td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <!-- end of previous immunization content   -->

                            <!-- current immunization content  -->
                            <div id="tab3" class="tab-content hidden  p-8 shadow-lg rounded-lg">
                                <div class="flex flex-col gap-3">
                                    <div>
                                        <h1 class="font-bold text-xl">Current Immunizations</h1>
                                    </div>
                                    <div class="overflow-x-auto mb-6">
                                        <table class="min-w-full  text-sm text-center">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th class="px-4 py-2 border-r border-b  bg-gray-800 text-white rounded-tl-lg">Service Provided</th>
                                                    <th class="px-4 py-2 border  bg-gray-800 text-white" colspan="3">Immunizations Used </th>
                                                    <th class="px-4 py-2 border  bg-gray-800 text-white">Day</th>
                                                    <th class="px-4 py-2 border  bg-gray-800 text-white">Date Administered</th>
                                                    <th class="px-4 py-2 border  bg-gray-800 text-white">In Charge</th>
                                                    <th class="px-4 py-2 border  bg-gray-800 text-white rounded-tr-lg">Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($currentImmunization->isEmpty())
                                                <tr>
                                                    <td colspan="9" class="px-4 py-4 border text-center text-gray-500">
                                                        No immunizations found
                                                    </td>
                                                </tr>
                                                @else
                                                @foreach ($currentImmunization as $immunization)
                                                <tr>
                                                    <td class="px-4 py-2 border-b">{{ $immunization->service->name }}</td>
                                                    @php
                                                    $vaccine = optional(optional($immunization->vaccineUsed)->item);
                                                    $rig = optional(optional($immunization->rigUsed)->item);
                                                    $antiTetanus = optional(optional($immunization->antiTetanusUsed)->item);

                                                    $items = [];

                                                    if ($vaccine->brand_name) {
                                                    $items[] = $vaccine->brand_name . ($vaccine->product_type ? ' (' . $vaccine->product_type . ')' : '');
                                                    }
                                                    if ($rig->brand_name) {
                                                    $items[] = $rig->brand_name . ($rig->product_type ? ' (' . $rig->product_type . ')' : '');
                                                    }
                                                    if ($antiTetanus->brand_name) {
                                                    $items[] = $antiTetanus->brand_name;
                                                    }
                                                    @endphp

                                                    <td class="px-4 py-2 border" colspan="3">
                                                        {{ implode(' - ', $items) }}
                                                    </td>

                                                    <td class="px-4 py-2 border">{{ $immunization->day_label ?? 'N/A' }} </td>
                                                    <td class="px-4 py-2 border">{{ $immunization->date_given}} </td>
                                                    <td class="px-4 py-2 border">{{ $immunization->administeredBy->last_name }}, {{ $immunization->administeredBy->first_name }} </td>

                                                    @php
                                                    $serviceName = strtolower($immunization->service->name);
                                                    @endphp

                                                    @if (str_contains($serviceName, 'post'))
                                                    <td class="px-4 py-2 border">
                                                        <a href="{{ route('clinic.patients.profile.immunization_info', [
                                                            Crypt::encrypt($immunization->id), Crypt::encrypt($immunization->transaction_id)
                                                        ]) }}"
                                                            target="_blank"
                                                            class="bg-sky-500 px-4 p-1 text-white font-bold rounded-lg hover:bg-sky-600">
                                                            View
                                                        </a>
                                                    </td>
                                                    @else
                                                    <td class="px-4 py-2 border">
                                                        <p class="italic">N/A</p>
                                                    </td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end of immunization content  -->

                            <!-- immunization schedule content  -->
                            <div id="tab4" class="tab-content hidden  p-8 shadow-lg rounded-lg">
                                <div class="flex flex-col gap-3">
                                    <div>
                                        <h1 class="font-bold text-xl">Immunization Schedules</h1>
                                    </div>

                                    @if($schedules->isEmpty())
                                    <p class="text-gray-500 text-center">No immunization schedules found.</p>
                                    @endif

                                    <div class="space-y-2">
                                        @foreach ($groupedSchedules as $transactionId => $transactionSchedules)
                                        <div x-data="{ open: false }">
                                            <!-- Clickable header -->
                                            <button @click="open = !open" class="border-2 border-gray-100  w-full flex justify-between items-center px-3 py-2 bg-white text-gray-800 rounded-lg font-semibold hover:bg-gray-50 focus:outline-none">
                                                <p>{{ $transactionSchedules->first()->service->name }} - <span class="text-xs">
                                                        {{ date('F d, Y g:i A', strtotime($transactionSchedules->first()->transaction->transaction_date)) }}
                                                    </span></p>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down">
                                                    <path d="m6 9 6 6 6-6" />
                                                </svg>
                                            </button>
                                            <!-- Collapsible table -->
                                            <div x-show="open" x-collapse class="overflow-x-auto shadow-lg">
                                                <table class="min-w-full text-sm text-center">
                                                    <thead class="bg-gray-800  text-white">
                                                        <tr>
                                                            <th class="px-4 py-2 border rounded-tl-lg">Day</th>
                                                            <th class="px-4 py-2 border ">Scheduled Date</th>
                                                            <th class="px-4 py-2 border ">Date Completed</th>
                                                            <th class="px-4 py-2 border rounded-tr-lg">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($transactionSchedules as $schedule)
                                                        <tr>
                                                            <td class="px-4 py-2 border-b ">{{ $schedule->Day }} </td>
                                                            <td class="px-4 py-2 border">{{ $schedule->scheduled_date }}</td>
                                                            <td class="px-4 py-2 border">{{ $schedule->date_completed ? $schedule->date_completed : 'N/A' }}</td>
                                                            <td class="px-4 py-2 border-b">
                                                                <span class="px-2 py-1 rounded-full text-white font-bold
                                                                    {{ $schedule->status === 'Completed' ? 'bg-green-400' : 'bg-gray-300' }}">
                                                                    {{ $schedule->status }}
                                                                </span>
                                                            </td>

                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- end of immunization schedule content  -->

                            <!-- transactions content  -->
                            <div id="tab5" class="tab-content hidden  p-8 shadow-lg rounded-lg">
                                <div class="flex flex-col gap-3">
                                    <div>
                                        <h1 class="font-bold text-xl">Transaction History</h1>
                                    </div>
                                    <div class="overflow-x-auto mb-6">
                                        <table class="min-w-full  text-sm text-center">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th class="px-4 py-2 border-r border-b  bg-gray-800 text-white rounded-tl-lg">ID</th>
                                                    <th class="px-4 py-2 border  bg-gray-800 text-white ">Date of Transaction</th>
                                                    <th class="px-4 py-2 border  bg-gray-800 text-white">Service Received</th>
                                                    <th class="px-4 py-2 border  bg-gray-800 text-white">Administration Date</th>
                                                    <th colspan="2" class="px-4 py-2 border  bg-gray-800 text-white">Vaccines Used</th>
                                                    <th colspan="2" class="px-4 py-2 border  bg-gray-800 text-white rounded-tr-lg flex flex-col"> In Charge <span class="text-xs">(Administration & Payment)</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($transactions->isEmpty())
                                                <tr>
                                                    <td colspan="9" class="px-4 py-4 border text-center text-gray-500">
                                                        No Transactions found
                                                    </td>
                                                </tr>
                                                @else
                                                @foreach ($transactions as $transaction)
                                                <tr>
                                                    <td class="px-4 py-2 border-b">{{ $transaction->id }}</td>
                                                    <td class="px-4 py-2 border">{{ date('F d, Y - g:i A', strtotime($transaction->transaction_date)) }}</td>
                                                    <td class="px-4 py-2 border">{{ $transaction->Service->name }}</td>
                                                    <td class="px-4 py-2 border">{{ date('F d, Y', strtotime($transaction->immunizations->date_given))}} </td>
                                                    @php
                                                    $vaccine = optional(optional($transaction->immunizations->vaccineUsed)->item);
                                                    $rig = optional(optional($transaction->immunizations->rigUsed)->item);
                                                    $antiTetanus = optional(optional($transaction->immunizations->antiTetanusUsed)->item);

                                                    $items = [];

                                                    if ($vaccine->brand_name) {
                                                    $items[] = $vaccine->brand_name . ' (' . $vaccine->product_type . ')';
                                                    }
                                                    if ($rig->brand_name) {
                                                    $items[] = $rig->brand_name . ' (' . $rig->product_type . ')';
                                                    }
                                                    if ($antiTetanus->brand_name) {
                                                    $items[] = $antiTetanus->brand_name;
                                                    }
                                                    @endphp

                                                    <td class="border px-2 py-2 text-gray-700" colspan="2">
                                                        {{ implode(' - ', $items) }}
                                                    </td>

                                                    <td class="px-4 py-2 border-b">{{ $transaction->immunizations->administeredBy->first_name }} {{ $transaction->immunizations->administeredBy->last_name }},
                                                        {{ $transaction->paymentRecords->receivedBy->first_name }} {{ $transaction->paymentRecords->receivedBy->last_name }}
                                                    </td>
                                                    @endforeach
                                                    @endif
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end of transactions content  -->

                            <!-- payments content  -->
                            <div id="tab6" class="tab-content hidden  p-8 shadow-lg rounded-lg">
                                <div class="flex flex-col gap-3">
                                    <div>
                                        <h1 class="font-bold text-xl">Payment Records</h1>
                                    </div>
                                    <div class="overflow-x-auto mb-6">
                                        <table class="min-w-full  text-sm text-center">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th class="px-4 py-2 border-r border-b  bg-gray-800 text-white rounded-tl-lg">Date of Transaction</th>
                                                    <th class="px-4 py-2 border  bg-gray-800 text-white">Service Received</th>
                                                    <th class="px-4 py-2 border  bg-gray-800 text-white">Receipt Number</th>
                                                    <th class="px-4 py-2 border  bg-gray-800 text-white">Paid Amount</th>
                                                    <th class="px-4 py-2 border  bg-gray-800 text-white">In Charge</th>
                                                    <th class="px-4 py-2 border-l border-b  bg-gray-800 text-white rounded-tr-lg">Payment Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($paymentRecords->isEmpty())
                                                <tr>
                                                    <td colspan="9" class="px-4 py-4 border text-center text-gray-500">
                                                        No payment records found
                                                    </td>
                                                </tr>
                                                @else
                                                @foreach ($paymentRecords as $payment)
                                                <tr>
                                                    <td class="px-4 py-2 border">{{ date('F d, Y - g:i A', strtotime($payment->transaction->transaction_date)) }}</td>
                                                    <td class="px-4 py-2 border">{{ $payment->transaction->service->name }}</td>
                                                    <td class="px-4 py-2 border">{{ $payment->receipt_number }}</td>
                                                    <td class="px-4 py-2 border"><span class="flex items-center"><i data-lucide="philippine-peso" class="w-4 h-4 text-gray-700"></i> {{ number_format($payment->amount_paid, 2) }}
                                                        </span></td>
                                                    <td class="px-4 py-2 border">{{ $payment->receivedBy->UserRole->role_name }}. {{ $payment->receivedBy->first_name }} {{ $payment->receivedBy->middle_initial }} {{ $payment->receivedBy->last_name }} </td>
                                                    <td class="px-4 py-2 border">{{ date('F d, Y - g:i A', strtotime($payment->payment_date)) }}</td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end of payments content  -->

                            <!-- vaccination card content  -->
                            <div id="tab7" class="tab-content hidden shadow-lg px-8 pt-2 pb-4 rounded-lg flex flex-col gap-2">

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

                                                <span class="text-sm font-bold ml-2
                                                        @if($transaction->overall_status === 'Completed') text-green-600
                                                        @elseif($transaction->overall_status === 'Ongoing') text-sky-500
                                                        @elseif($transaction->overall_status === 'Cancelled') text-red-600
                                                        @endif">
                                                    ( {{ $transaction->overall_status }} )
                                                </span>
                                            </span></p> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down">
                                            <path d="m6 9 6 6 6-6" />
                                        </svg>
                                    </button>
                                    <div>
                                        <div x-show="open" x-collapse class="overflow-x-auto shadow-lg px-20 flex flex-col gap-4 p-4">
                                            <a href="{{ route('clinic.patients.profile.vaccination_card', 
                                            ['id' => Crypt::encrypt($transaction->patient_id), 'grouping' => Crypt::encrypt($transaction->id)]) }}"
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
                    </div>


                    <!-- update  profile modal -->
                    <dialog id="EditPatientProfile" class="p-8 rounded-lg shadow-lg w-full max-w-5xl backdrop:bg-black/30 focus:outline-none ">
                        <!-- close modal button  -->
                        <div class="w-full flex justify-end mb-5 md:mb-2">
                            <button onclick="document.getElementById('EditPatientProfile').close()" class="focus:outline-none"><i data-lucide="x" class="w-5 h-5"></i></button>
                        </div>
                        <!-- update profile info  form  -->
                        <form action="{{ route('clinic.patients.profile.update')  }}" method="POST" id="EditPatientProfileForm">
                            @csrf
                            @method('PUT')

                            <input type="hidden" id="existing-emails" value="{{ json_encode($emails) }}">

                            <input type="text" name="id" value="{{ $patient->id }}" hidden>

                            <div class="grid grid-cols-12 md:px-8 gap-2 flex flex-col items-center justify-center">
                                <div class="col-span-12 flex items-center justify-center">
                                    <div class="flex items-center justify-center gap-4 ">
                                        <i data-lucide="circle-user" class="w-12 h-12 text-sky-500"></i>
                                        <div>
                                            <h1 class="font-900 md:text-2xl text-xl">Patient Profile</h1>
                                            <p>Update Patient Information</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- divider border  -->
                                <div class="col-span-12 border-2 border-gray-100 my-2"></div>
                                <div class="col-span-12">
                                    <h1 class="font-semibold text-xl">Personal Information</h1>
                                </div>
                                <!-- fname. lname , initial div  -->
                                <div class="col-span-12 grid grid-cols-12 gap-2">
                                    <!-- FIRST NAME -->
                                    <div class="col-span-12 md:col-span-5">
                                        @if ($errors->has('first_name'))
                                        <label for="first_name" class="text-sm font-semibold flex justify-between items-center w-full">First Name:
                                            <span class="text-red-500 text-xs" id="first-name-error">
                                                {{ $errors->first('first_name') }}
                                                *</span>
                                        </label>
                                        @else
                                        <label for="first_name" class="text-sm font-semibold ">First Name:
                                            <span class="text-red-500 text-xs" id="first-name-error">*</span>
                                        </label>
                                        @endif
                                        <input type="text" id="first_name" name="first_name"
                                            placeholder="First Name"
                                            value="{{ ( $patient->first_name) }}"
                                            class="w-full p-2 border border-gray-300 rounded-lg bg-gray-50 focus:bg-white focus:outline-none focus:ring-1 focus:border-sky-300 uppercase">
                                    </div>

                                    <!-- LAST NAME -->
                                    <div class="col-span-12 md:col-span-5">
                                        @if ($errors->has('last_name'))
                                        <label for="last_name" class="text-sm font-semibold flex justify-between items-center w-full">Last Name:
                                            <span class="text-red-500 text-xs" id="last-name-error">
                                                {{ $errors->first('last_name') }}
                                                *</span>
                                        </label>
                                        @else
                                        <label for="last_name" class="text-sm font-semibold ">Last Name:
                                            <span class="text-red-500 text-xs" id="last-name-error">*</span>
                                        </label>
                                        @endif

                                        <input type="text" id="last_name" name="last_name" placeholder="Last Name"
                                            value="{{ ( $patient->last_name) }}"
                                            class="w-full p-2 border border-gray-300 rounded-lg  bg-gray-50 focus:bg-white  focus:outline-none focus:ring-1 focus:border-sky-300 uppercase ">
                                    </div>

                                    <!-- MIDDLE INITIAL -->
                                    <div class="col-span-6 md:col-span-1">
                                        @if ($errors->has('middle_initial'))
                                        <label for="middle_initial" class="text-sm font-semibold flex justify-between items-center w-full">M.I:
                                            <span class="text-red-500 text-xs" id="middle-initial-error">
                                                {{ $errors->first('middle_initial') }}
                                                *</span>
                                        </label>
                                        @else
                                        <label for="middle_initial" class="text-sm font-semibold ">M.I:
                                            <span class="text-red-500 text-xs" id="middle-initial-error">*</span>
                                        </label>
                                        @endif

                                        <input type="text" id="middle_initial" name="middle_initial" placeholder="M.I" maxlength="3"
                                            pattern="[A-Z]\."
                                            oninput="this.value = this.value.toUpperCase()"
                                            title="Only one letter followed by a period is allowed (e.g., M.)"
                                            value="{{ old('middle_initial', $patient->middle_initial) }}"
                                            class="w-full p-2 border border-gray-300 bg-gray-50 focus:bg-white  rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300 uppercase ">
                                    </div>

                                    <!-- SUFFIX -->
                                    <div class="col-span-6 md:col-span-1">
                                        <label for="suffix" class="text-sm font-semibold">Suffix: </label>
                                        <input type="text" id="suffix" name="suffix" placeholder="E.g., Jr."
                                            pattern="[A-Za-z]{1,5}"
                                            maxlength="5"
                                            title="Only letters are allowed, max 5 characters (e.g., Jr, Sr, III)"
                                            value="{{ old('suffix', $patient->suffix) }}"
                                            class="w-full p-2 border border-gray-300 bg-gray-50 focus:bg-white  rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                    </div>
                                </div>


                                <!-- date of birth, age , gender div  -->
                                <div class="col-span-12 grid grid-cols-6 gap-4 mt-2">
                                    <!-- date of birth  -->
                                    <div class="col-span-6 md:col-span-2 flex flex-col gap-1">
                                        @if ($errors->has('date_of_birth'))
                                        <label for="date_of_birth" class="text-sm font-semibold flex justify-between items-center w-full">Date of Birth:
                                            <span class="text-red-500 text-xs" id="date-of-birth-error">
                                                {{ $errors->first('date_of_birth') }}*</span>
                                        </label>
                                        @else
                                        <label for="date_of_birth" class="text-sm font-semibold ">Date of Birth:
                                            <span class="text-red-500 text-xs" id="date-of-birth-error">*</span>
                                        </label>
                                        @endif
                                        <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $patient->birthdate) }}"
                                            class="w-full p-2 border border-gray-300 bg-gray-50 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                    </div>
                                    <!-- age  -->
                                    <div class="col-span-6 md:col-span-1 flex flex-col gap-1">
                                        @if ($errors->has('age'))
                                        <label for="age" class="text-sm font-semibold flex justify-between items-center w-full">Age:
                                            <span class="text-red-500 text-xs" id="age-error">
                                                {{ $errors->first('age') }}*</span>
                                        </label>
                                        @else
                                        <label for="age" class="text-sm font-semibold ">Age:
                                            <span class="text-red-500 text-xs" id="age-error">*</span>
                                        </label>
                                        @endif <input type="number" name="age" placeholder="Age" id="age" value="{{ old('age', $patient->age) }}"
                                            class="w-full p-2 border border-gray-300 bg-gray-50 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                    </div>
                                    <!-- gender  -->
                                    <div class="col-span-6 md:col-span-3 flex flex-col gap-3">
                                        <label class=" text-sm font-bold text-gray-800">Gender <span class="text-red-500" id="gender-error">*</span></label>
                                        <div class="flex gap-5 items-center">
                                            <label class="flex items-center space-x-2">
                                                <input type="radio" name="sex" value="Male"
                                                    class="text-sky-500 focus:ring-sky-500"
                                                    {{ $patient->sex == 'Male' ? 'checked' : '' }}>
                                                <span>Male</span>
                                            </label>

                                            <label class="flex items-center space-x-2">
                                                <input type="radio" name="sex" value="Female"
                                                    class="text-pink-500 focus:ring-pink-500"
                                                    {{ $patient->sex == 'Female' ? 'checked' : '' }}>
                                                <span>Female</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- contact number  -->
                                <div class="col-span-12 grid grid-cols-4 gap-4 mt-2">
                                    <!-- phone number  -->
                                    <div class="col-span-4 md:col-span-2 flex flex-col items-center gap-2">
                                        <div class="w-full flex items-center">
                                            @if ($errors->has('contact_number'))
                                            <label for="contact_number" class="text-sm font-semibold flex justify-between items-center w-full">Contact Number:
                                                <span class="text-red-500 text-xs" id="contact-number-error">
                                                    {{ $errors->first('contact_number') }}
                                                    *</span>
                                            </label>
                                            @else
                                            <label for="contact_number" class="text-sm font-semibold ">Contact Number:
                                                <span class="text-red-500 text-xs" id="contact-number-error">*</span>
                                            </label>
                                            @endif

                                        </div>
                                        <div class="w-full flex items-center gap-4">
                                            <i data-lucide="phone-call"></i>
                                            <input type="tel" id="contact_number" name="contact_number"
                                                placeholder="e.g. 09xx xxx xxxx"
                                                maxlength="13"
                                                value="{{  $patient->contact_number }}"
                                                class="w-full p-2 border border-gray-300 bg-gray-50 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                        </div>
                                    </div>
                                    <div class="col-span-4 md:col-span-2 flex flex-col  gap-2">
                                        @if ($errors->has('email'))
                                        <label for="email" class="text-sm font-semibold flex justify-between items-center w-full">Personal Email:
                                            <span class="text-red-500 text-xs" id="email-error">
                                                {{ $errors->first('email') }}*</span>
                                        </label>
                                        @else
                                        <label for="email" class="text-sm font-semibold ">Personal Email:
                                            <span class="text-red-500 text-xs" id="email-error">*</span>
                                        </label>
                                        @endif
                                        <div class="w-full flex items-center gap-4">
                                            <i data-lucide="mail"></i>
                                            <input type="email" name="email" id="email" placeholder="example@gmail.com" value="{{ old('email', $patient->email) }}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                class="w-full p-2 border border-gray-300 bg-gray-50 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                            <input type="hidden" name="email-checker" id="email-checker-id" value="{{$patient->email}}">
                                        </div>
                                    </div>
                                </div>
                                <!-- divider border  -->
                                <div class="col-span-12 border-2 border-gray-100 mt-5"></div>

                                <!-- address label  -->
                                <div class="col-span-12 p-2 ">
                                    <label for="address" class="text-xl font-bold text-gray-800">Address</label>
                                </div>

                                <div class="col-span-12 flex items-center gap-2 p-2">
                                    <i data-lucide="map-pin"></i>
                                    <div>{{ $patient->address }} (Current)</div>
                                </div>
                                <!-- divider border  -->
                                <div class="col-span-12 border-2 border-gray-100 mt-5"></div>
                                <div class="col-span-12 mt-2 p-2">
                                    <p class="font-semibold">Update Address</p>
                                </div>

                                <!-- region, province, city, barangay, purok div  -->
                                <div class="col-span-12 grid grid-cols-12 gap-2">
                                    <!-- region  -->
                                    <div class="col-span-12 md:col-span-4">
                                        <div class="mb-3 relative">
                                            <label for="region_btn" class="text-sm mb-2 font-semibold">Region <span class="text-red-500" id="region-error">*</span></label>
                                            <button id="region_btn" type="button"
                                                class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center">
                                                <span id="region_selected">Select Region</span>
                                                <i data-lucide="chevron-down"></i>
                                            </button>
                                            <ul id="region" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                            <!-- hidden input -->
                                            <input type="hidden" name="region" id="region_input">
                                        </div>
                                    </div>
                                    <!-- province  -->
                                    <div class="col-span-12 md:col-span-4">
                                        <div class="mb-3 relative">
                                            <label for="province_btn" class="text-sm mb-2 font-semibold">Province <span class="text-red-500" id="province-error">*</span></label>
                                            <button id="province_btn" type="button"
                                                class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                                <span id="province_selected">Select Province</span>
                                                <i data-lucide="chevron-down"></i>
                                            </button>
                                            <ul id="province" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                            <!-- hidden input -->
                                            <input type="hidden" name="province" id="province_input">
                                        </div>
                                    </div>
                                    <!-- city  -->
                                    <div class="col-span-12 md:col-span-4">
                                        <div class="mb-3 relative">
                                            <label for="city_btn" class="text-sm mb-2 font-semibold">City / Municipality <span class="text-red-500" id="city-error">*</span></label>
                                            <button id="city_btn" type="button"
                                                class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                                <span id="city_selected">Select City</span>
                                                <i data-lucide="chevron-down"></i>
                                            </button>
                                            <ul id="city" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                            <!-- hidden input -->
                                            <input type="hidden" name="city" id="city_input">
                                        </div>
                                    </div>
                                    <!-- barangay and purok  -->
                                    <div class="col-span-12 md:col-span-12">
                                        <div class="grid grid-cols-4 gap-4">
                                            <!-- barangay  -->
                                            <div class="col-span-4 md:col-span-2 mb-3 relative">
                                                <label for="barangay_btn" class="text-sm mb-2 font-semibold">Barangay <span class="text-red-500" id="barangay-error">*</span></label>
                                                <button id="barangay_btn" type="button"
                                                    class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                                    <span id="barangay_selected">Select Barangay</span>
                                                    <i data-lucide="chevron-down"></i>
                                                </button>
                                                <ul id="barangay" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                                <!-- hidden input -->
                                                <input type="hidden" name="barangay" id="barangay_input">
                                            </div>
                                            <!-- purok  -->
                                            <div class="col-span-4 md:col-span-2 ">
                                                <label for="description" class="text-sm mb-2 font-semibold">Purok / Bldng No. <span class="text-red-500" id="description-error">*</span></label>
                                                <button id="description_btn" type="button" class="hidden"> </button>
                                                <input type="text" name="description" placeholder="e.g Purok-2" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- divider border  -->
                                    <div class="col-span-12 border-2 border-gray-100"></div>
                                </div>

                                <!-- submit and cancel button   -->
                                <div class="col-span-12 flex items-end justify-end gap-2 mt-5">
                                    <button type="submit" id="edit-submit-btn" class="md:px-8 px-4 py-2 bg-sky-500 text-white rounded-lg text-md hover:bg-sky-400">
                                        Save Changes
                                    </button>
                                    <button type="button" onclick="document.getElementById('EditPatientProfile').close()"
                                        class="px-6 py-2 bg-gray-100 text-gray-500 rounded-lg text-md hover:bg-gray-200">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </dialog>
                    <!-- end of dialog  -->


        </section>

        <!-- Modals For Logout -->
        <x-logout-modal />
</body>
@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('EditPatientProfile').showModal();
    });
</script>
@endif


<script>
    document.getElementById('email').addEventListener('input', function() {
        const existingEmails = JSON.parse(document.getElementById('existing-emails').value);
        const originalEmail = document.getElementById('email-checker-id').value.trim();
        const emailInput = this.value.trim();
        const errorSpan = document.getElementById('email-error');
        const edit_submit_btn = document.getElementById('edit-submit-btn');

        // Basic email regex format check
        const emailFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Validate format first
        if (emailInput.length > 0 && !emailFormat.test(emailInput)) {
            errorSpan.textContent = "Invalid email format";
            errorSpan.classList.add('text-red-500');
            this.classList.add('border-red-500');
            edit_submit_btn.disabled = true;
            return;
        }

        // Exclude original email from duplicate check
        const emailsToCheck = existingEmails.filter(email => email !== originalEmail);

        // Check if email already exists
        if (emailsToCheck.includes(emailInput)) {
            errorSpan.textContent = "Email already exists";
            errorSpan.classList.add('text-red-500');
            this.classList.add('border-red-500');
            edit_submit_btn.disabled = true;
        } else {
            errorSpan.textContent = "*";
            this.classList.remove('border-red-500');
            edit_submit_btn.disabled = false;
        }
    });



    const tabButtons = document.querySelectorAll(".tab-btn");
    const tabContents = document.querySelectorAll(".tab-content");

    // Always default to tab1 on load
    let activeTab = "tab1";
    showTab(activeTab);

    tabButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
            const target = btn.getAttribute("data-tab");
            showTab(target);
        });
    });

    function showTab(target) {
        // Hide all contents
        tabContents.forEach((content) => content.classList.add("hidden"));

        // Reset all tabs
        tabButtons.forEach((b) =>
            b.classList.remove("text-red-500", "border-red-500")
        );
        tabButtons.forEach((b) =>
            b.classList.add("text-gray-600", "border-transparent")
        );

        // Show active content
        document.getElementById(target).classList.remove("hidden");

        // Highlight active tab button
        const activeBtn = document.querySelector(`[data-tab="${target}"]`);
        activeBtn.classList.remove("text-gray-600", "border-transparent");
        activeBtn.classList.add("text-red-500", "border-red-500");
    }


    function formatContactNumber(input) {
        let value = input.value.replace(/\D/g, ""); // remove non-digits

        if (value.length > 4 && value.length <= 7) {
            value = value.replace(/(\d{4})(\d+)/, "$1 $2");
        } else if (value.length > 7) {
            value = value.replace(/(\d{4})(\d{3})(\d+)/, "$1 $2 $3");
        }

        input.value = value;
    }

    const contactInput = document.getElementById("contact_number");

    // Format while typing
    contactInput.addEventListener("input", function(e) {
        formatContactNumber(e.target);
    });

    // Format immediately on page load if value exists
    window.addEventListener("DOMContentLoaded", function() {
        if (contactInput.value) {
            formatContactNumber(contactInput);
        }
    });



    // AGE CALCULATOR
    document.addEventListener("DOMContentLoaded", function() {
        const date_of_birth = document.getElementById("date_of_birth");
        const age = document.getElementById("age");

        date_of_birth.addEventListener("change", function() {
            const birthdate = new Date(date_of_birth.value);
            const today = new Date();

            // Check if the birthdate is valid and not in the future
            if (!date_of_birth.value || birthdate > today) {
                age.value = "";
                return;
            }

            let calculatedAge = today.getFullYear() - birthdate.getFullYear();
            const monthDifference = today.getMonth() - birthdate.getMonth();

            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthdate.getDate())) {
                calculatedAge--;
            }

            age.value = calculatedAge >= 0 ? calculatedAge : "";
        });
    });


    //error handling js
    document.addEventListener("DOMContentLoaded", function() {
        let fields = [{
                name: "region",
                label: "region-error",
                btn: "region_btn"
            },
            {
                name: "province",
                label: "province-error",
                btn: "province_btn"
            },
            {
                name: "city",
                label: "city-error",
                btn: "city_btn"
            },
            {
                name: "barangay",
                label: "barangay-error",
                btn: "barangay_btn"
            },
            {
                name: "description",
                label: "description-error",
                btn: "description_btn"
            },
            {
                name: "first_name",
                label: "first-name-error"
            },
            {
                name: "last_name",
                label: "last-name-error"
            },
            {
                name: "middle_initial",
                label: "middle-initial-error"
            },
            {
                name: "contact_number",
                label: "contact-number-error"
            },
            {
                name: "email",
                label: "email-error"
            },
            {
                name: "date_of_birth",
                label: "date-of-birth-error"
            },
            {
                name: "age",
                label: "age-error"
            }
        ];

        function markInvalid(input, label, btn) {
            if (label) label.style.color = "red";
            if (input) input.classList.add("border-red-500");
            if (btn) btn.classList.add("border-red-500");
        }

        function clearInvalid(input, label, btn) {
            if (label) label.style.color = "";
            if (input) input.classList.remove("border-red-500");
            if (btn) btn.classList.remove("border-red-500");
        }

        const editSubmitProfileBtn = document.getElementById("edit-submit-btn");

        document.getElementById("EditPatientProfileForm").addEventListener("submit", function(e) {
            let isValid = true;

            // Handle btn fields first
            let btnFields = fields.filter(f => f.btn);
            let anyBtnHasValue = btnFields.some(f => {
                let input = document.querySelector(`[name="${f.name}"]`);
                return input && input.value.trim() !== "";
            });

            btnFields.forEach(f => {
                let input = document.querySelector(`[name="${f.name}"]`);
                let label = document.getElementById(f.label);
                let btn = document.getElementById(f.btn);

                if (anyBtnHasValue && input && input.value.trim() === "") {
                    markInvalid(input, label, btn);
                    isValid = false;
                } else {
                    clearInvalid(input, label, btn);
                }
            });

            // Handle fields without btn
            fields.filter(f => !f.btn).forEach(f => {
                let input = document.querySelector(`[name="${f.name}"]`);
                let label = document.getElementById(f.label);
                if (input && input.value.trim() === "") {
                    markInvalid(input, label, null);
                    isValid = false;
                } else {
                    clearInvalid(input, label, null);
                }
            });

            if (!isValid) {
                e.preventDefault();
                e.stopPropagation();
                return;
            }

            editSubmitProfileBtn.disabled = true;
            editSubmitProfileBtn.innerHTML = `
            <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
            </svg>
            <span>Loading...</span>
        `;
        });
    });
</script>



</html>