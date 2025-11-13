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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/chart.js','resources/js/datetime.js'])

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

                    <li><a href="{{ route('clinic.dashboard') }}" class="mt-3 block px-4 py-2 rounded bg-gray-900 text-white  flex items-center gap-3"><i data-lucide="layout-dashboard" class="w-5 h-5"></i>Dashboard</a></li>
                    <p class="text-xs font-bold text-gray-400 my-1 uppercase">Patient Management</p>
                    <li><a href="{{ route('clinic.patients')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="users" class="w-5 h-5"></i>Patients</a></li>
                    <li><a href="{{ route('clinic.appointments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="notebook-pen" class="w-5 h-5"></i>Appointments</a></li>
                    <li><a href="{{ route('clinic.messages') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="message-square-text" class="w-5 h-5"></i>Messages</a></li>

                    <p class="text-xs font-bold text-gray-400 my-1 uppercase">Clinic Management</p>
                    <li><a href="{{route('clinic.supplies')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="package" class="w-5 h-5"></i>Inventory</a></li>
                    <li><a href="{{ route('clinic.transactions')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-text" class="w-5 h-5"></i>Transactions</a></li>
                    <li><a href="{{ route('clinic.payments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="philippine-peso" class="w-5 h-5"></i>Payments </a></li>
                    <li><a href="{{ route('clinic.services') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="briefcase-medical" class="w-5 h-5"></i>Services</a></li>

                    @if ($clinicUser && $clinicUser->UserRole && strtolower($clinicUser->UserRole->role_name) === 'admin')
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
        <section id="mainContent" class="flex-1 ml-0 md:ml-56 h-full   ">
            <div class="fixed top-0 w-full z-50  bg-gray-900 p-3 flex items-center gap-10 justify-between md:justify-start shadow-lg">
                <button id="toggleSidebar" class="text-white block ml-2 focus:outline-none ">
                    ☰ </button>
                <div>
                    <!-- date and time -->
                    <div class="flex items-center justify-between gap-3 pr-5">
                        <i data-lucide="calendar-clock" class="text-white w-8 h-8"></i>
                        <div id="datetime" class="md:text-md text-sm text-white font-bold"></div>
                    </div>
                </div>
            </div>
            <!-- content container -->
            <div class="flex flex-col flex-1 overflow-y-auto pt-[60px]">
                <div class="flex flex-row items-center md:gap-5 gap-3 py-8 md:px-14 px-4">
                    <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-16 h-16">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-900">Dashboard</h1>
                        <h2 class="ml-3 text-xl font-bold">Hello, {{ $clinicUser->first_name }}!</h2>
                    </div>
                </div>
                <!-- Header content -->
                <div class="md:pl-12 pl-6 flex items-center gap-2 ">
                    <h1 class="md:text-2xl font-900 text-[#FF000D]">Clinic Activity Overview
                    </h1>
                    <a href="{{ route('clinic.user-manual') }}" target="_blank" class="text-[#FF000D]"> <i data-lucide="circle-question-mark" class="w-5 h-5"></i>
                    </a>
                </div>
                <div class="md:pl-12 pl-6">
                    <h1 class="md:text-lg text-gray-800"> Overview of patient records, clinic activities, and inventory status.
                    </h1>
                </div>
                <!-- Main content grid -->
                <div class="grid grid-cols-7 md:p-4 p-2 gap-4 md:gap-2 ">
                    <!-- div for First CHART -->
                    <div class="col-span-7 md:col-span-3 w-full bg-white rounded-lg shadow-lg border p-2 border-gray-200 ">
                        <div class="flex flex-col gap-4 ">
                            <div class="w-full bg-white  p-2 md:p-6">
                                <div class="flex items-center gap-2 p-2">
                                    <div>
                                        <h5 class="leading-none md:text-xl font-900 text-gray-900  pb-1"> Patient Summary</h5>
                                        <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Comprehensive view of patient records and activities</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-4 gap-2 ">
                                    <!-- Date Filter -->
                                    <div class="col-span-4 md:col-span-1">
                                        <div x-data="{ open: false }" class="relative inline-block w-full text-left">
                                            <input type="hidden" id="filter" value="all">
                                            <button
                                                @click="open = !open"
                                                class="w-full bg-white text-gray-700 text-sm font-medium px-2 py-2 rounded-md 
                                                    flex items-center justify-between border border-gray-700 hover:border-sky-500 
                                                    focus:ring-1 focus:ring-sky-500 focus:outline-none whitespace-nowrap overflow-hidden text-ellipsis">
                                                <span id="filterLabel">Time Range</span>
                                                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>

                                            <div x-show="open" @click.outside="open = false" @click="open = false"
                                                class="absolute z-10 mt-1 w-full bg-white border border-gray-200 rounded-md shadow-lg">
                                                <ul class="py-1 text-sm text-gray-700">
                                                    <li><button data-value="all" class="filter-option w-full text-left px-4 py-2 hover:bg-gray-100">All
                                                            Time</button></li>
                                                    <li><button data-value="today" class="filter-option w-full text-left px-4 py-2 hover:bg-gray-100">Today</button></li>
                                                    <li><button data-value="yesterday" class="filter-option w-full text-left px-4 py-2 hover:bg-gray-100">Yesterday</button></li>
                                                    <li><button data-value="weekly" class="filter-option w-full text-left px-4 py-2 hover:bg-gray-100">
                                                            Weekly</button></li>
                                                    <li><button data-value="monthly" class="filter-option w-full text-left px-4 py-2 hover:bg-gray-100">
                                                            Monthly</button></li>
                                                    <li><button data-value="thisYear" class="filter-option w-full text-left px-4 py-2 hover:bg-gray-100">This
                                                            Year</button></li>
                                                    <li><button data-value="lastYear" class="filter-option w-full text-left px-4 py-2 hover:bg-gray-100">Last
                                                            Year</button></li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Service Type Filter -->
                                    <div class="col-span-2 md:col-span-2">
                                        <div x-data="{ open: false }" class="relative inline-block w-full text-left">
                                            <input type="hidden" id="serviceFilter" value="all">
                                            <button
                                                @click="open = !open"
                                                class="w-full bg-white text-gray-700 text-sm font-medium px-4 py-2 rounded-md 
                                                    flex items-center justify-between border border-gray-700 hover:border-sky-500 
                                                    focus:ring-1 focus:ring-sky-500 focus:outline-none whitespace-nowrap overflow-hidden text-ellipsis">
                                                <span id="serviceFilterLabel">Service Type</span>
                                                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>

                                            <div x-show="open" @click.outside="open = false" @click="open = false"
                                                class="absolute z-10 mt-1 w-full bg-white border border-gray-200 rounded-md shadow-lg max-h-48 overflow-y-auto scrollbar-hidden">
                                                <ul class="py-1 text-sm text-gray-700 scrollbar-hidden">
                                                    <li><button data-value="all" class="service-option w-full text-left px-4 py-2 hover:bg-gray-100">All
                                                            Services</button></li>
                                                    @foreach ($services as $service)
                                                    <li><button data-value="{{ $service->id }}"
                                                            class="service-option w-full text-left px-4 py-2 hover:bg-gray-100">{{ $service->name }}</button></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Age Filter -->
                                    <div class="col-span-2 md:col-span-1">
                                        <div x-data="{ open: false }" class="relative inline-block w-full text-left">
                                            <input type="hidden" id="ageFilter" value="all">
                                            <button
                                                @click="open = !open"
                                                class="w-full bg-white text-gray-700 text-sm font-medium px-4 py-2 rounded-md 
                                                    flex items-center justify-between border border-gray-700 hover:border-sky-500 
                                                    focus:ring-1 focus:ring-sky-500 focus:outline-none whitespace-nowrap overflow-hidden text-ellipsis">
                                                <span id="ageFilterLabel">Age</span>
                                                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>

                                            <div x-show="open" @click.outside="open = false" @click="open = false"
                                                class="absolute z-10 mt-1 w-full bg-white border border-gray-200 rounded-md shadow-lg">
                                                <ul class="py-1 text-sm text-gray-700">
                                                    <li><button data-value="all" class="age-option w-full text-left px-4 py-2 hover:bg-gray-100">All Ages
                                                        </button></li>
                                                    <li><button data-value="0-17" class="age-option w-full text-left px-4 py-2 hover:bg-gray-100">0-17</button></li>
                                                    <li><button data-value="18-64" class="age-option w-full text-left px-4 py-2 hover:bg-gray-100">18-64</button></li>
                                                    <li><button data-value="65+" class="age-option w-full text-left px-4 py-2 hover:bg-gray-100">65+</button></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center px-6 py-2 bg-gray-50 rounded-lg my-3">
                                    <div class="w-12 h-12 rounded-full bg-red-600 flex items-center justify-center me-3">
                                        <i data-lucide="users" class="w-6 h-6 text-white"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 font-bold">Accommodated Patients</p>
                                        <h5 id="totalPatients" class="leading-none text-2xl font-900 text-gray-900 pb-1">0</h5>
                                        <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total Patients</p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-evenly">
                                    <div>
                                        <h1 class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Total Male</h1>
                                        <h1 id="totalMale" class="leading-none text-xl font-bold text-green-500 text-sky-500">0</h1>
                                    </div>
                                    <div>
                                        <h1 class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Total Female</h1>
                                        <h1 id="totalFemale" class="leading-none text-xl font-bold text-red-600 text-[#ff0a70ec]">0</h1>
                                    </div>
                                </div>
                                <div id="chart" class="mt-4"></div>
                                <div class="grid grid-cols-2  border-gray-200 border-t">
                                    <div class="col-span-2 mt-2 flex items-end justify-end">
                                        <a href="{{ route('clinic.transactions') }}" class="px-5 py-2.5 text-xs font-medium text-white inline-flex items-center bg-sky-500 hover:bg-sky-400 focus:ring-4 focus:outline-none focus:ring-sky-500 rounded-lg text-center">
                                            <i data-lucide="file-text" class="w-4 h-4 md:me-2"></i>
                                            View Details
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- div for Three CHART -->
                    <div class="col-span-7 md:col-span-4 flex flex-col  gap-3 ">

                        <!-- div for two chart -->
                        <div class="grid grid-cols-5 bg-white  rounded md:gap-2 gap-4 h-full ">
                            <div class="col-span-5 md:col-span-2 flex flex-col ">
                                <div class="flex flex-col rounded-lg border border-gray-100 gap-2">
                                    <div class="p-8">
                                        <h5 class="leading-none md:text-lg font-900 text-gray-900  pb-1">Daily Clinic Overview</h5>
                                        <p class="text-sm font-normal text-gray-500 dark:text-gray-400"> Summary of today’s transactions and appointments</p>
                                    </div>
                                    <div class="w-full bg-white px-2  rounded">
                                        <div class="flex justify-between gap-5 py-4 px-3 shadow-lg">
                                            <div class="flex gap-3">
                                                <div class="flex items-center justfy-center ">
                                                    <i data-lucide="file-text" class="w-8 h-8 md:me-2"></i>
                                                </div>
                                                <div class="flex flex-col">
                                                    <h1 class="font-bold">Transactions</h1>
                                                    <a href="{{ route('clinic.transactions') }}" class="text-xs text-sky-600 hover:text-sky-700 flex items-center gap-1">See Details <i data-lucide="info" class="w-3 h-3"></i></a>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center  bg-sky-400 rounded-full w-12 h-12">
                                                <h1 class="text-white font-bold">{{ $today_clinic_transactions }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full bg-white px-2 rounded mb-2 ">
                                        <div class="flex justify-between gap-5 py-4 px-3 shadow-lg">
                                            <div class="flex gap-3">
                                                <div class="flex items-center justfy-center ">
                                                    <i data-lucide="notebook-pen" class="w-8 h-8 md:me-2"></i>
                                                </div>
                                                <div class="flex flex-col">
                                                    <h1 class="font-bold">Expected Patients</h1>
                                                    <a href="{{ route('clinic.messages') }}" class="text-xs text-sky-600 hover:text-sky-700 flex items-center gap-1">See Details <i data-lucide="info" class="w-3 h-3"></i></a>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center  bg-gray-400 rounded-full w-12 h-12">
                                                <h1 class="text-white font-bold">{{ $clinic_expected_patients }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- recent patient div  -->
                                <div class="w-full h-full bg-white  mt-2 rounded-lg shadow-xl border border-gray-200 p-2 ">
                                    <div class="p-4 mt-2">
                                        <h5 class="leading-none md:text-lg font-900 text-gray-900  pb-1">Recent Clinic Patients</h5>
                                        <p class="text-sm font-normal text-gray-500 dark:text-gray-400"> See who recently visited and received care at the clinic
                                        </p>
                                    </div>
                                    <!-- Scrollable container -->
                                    <div class="overflow-y-auto max-h-[18.5rem]  mb-4 scrollbar-hidden px-2 ">

                                        @foreach ($clinic_transactions as $transaction)
                                        <div class="flex justify-between px-2 my-3">
                                            <div class="flex items-center">
                                                <div class="flex items-center justify-center">
                                                    <i data-lucide="circle-user" class="w-6 h-6 text-gray-500"></i>
                                                </div>
                                                <div class="ml-2 flex flex-col gap-1">
                                                    <h1 class="text-sm font-bold text-gray-900">{{ $transaction->Patient->first_name }} {{ $transaction->Patient->last_name }}</h1>
                                                    <p class="text-xs font-semibold text-gray-500">{{ $transaction->Service->name }}</p>
                                                    <p class="text-xs font-normal text-gray-500">Visited on: {{ $transaction->getDateOnlyAttribute() }}</p>
                                                </div>
                                            </div>
                                            <a href="{{ route('clinic.patients.profile', Crypt::encrypt($transaction->Patient->id)) }}" class="flex items-center justify-center text-sky-600">
                                                <i data-lucide="chevron-right" class="w-5 h-5 hover:text-sky-800"></i>
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- inventory -->
                            <div class="col-span-5 md:col-span-3 rounded-lg shadow-xl border border-gray-200 p-2 md:p-6">
                                <div class="w-full bg-white   p-0 md:p-2">
                                    <div class="flex justify-between pb-6  mt-5 mb:mt-0 mb-4 border-b border-gray-200 dark:border-gray-700">
                                        <div class="flex items-center gap-2">
                                            <div class="w-12 h-12 rounded-full bg-green-500 flex items-center justify-center ">
                                                <i data-lucide="package" class="w-6 h-6  text-white"></i>
                                            </div>
                                            <div>
                                                <h5 class="leading-none md:text-xl font-900 text-gray-900  pb-1">Inventory Items Status</h5>
                                                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Vaccines, Rigs, Supplies, Equipments</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <!-- inventory component livewire> -->
                                        <livewire:inventory-table />
                                    </div>
                                    <div class="grid grid-cols-1 items-center border-gray-200 border-t mt-2 dark:border-gray-700 justify-between">
                                        <div class="flex justify-between items-center pt-5">
                                            <a href="{{ route('clinic.supplies') }}" class="px-5 py-2.5 text-sm font-medium text-white inline-flex items-center bg-sky-500 hover:bg-sky-400 focus:ring-4 focus:outline-none focus:ring-sky-300 rounded-lg text-center">
                                                <i data-lucide="file-text" class="w-4 h-4 me-2"></i>
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </section>
        <!-- Modals For Logout -->
        <x-logout-modal />

</body>

</html>