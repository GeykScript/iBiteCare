<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
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
        <div class="side-bar w-56 fixed inset-y-0 bg-white text-black flex flex-col border-r border-gray-300 h-screen z-50  " id="sidebar">
            <div class="absolute top-20 right-[-0.6rem]  md:hidden">
                <button id="closeSidebar" class="text-white text-2xl">
                    <i data-lucide="circle-chevron-right" class="w-6 h-6 stroke-white fill-[#FF000D]"></i>
                </button>
            </div>
            <!-- Logo -->
            <div class="flex items-center">
                <img src="{{ asset('images/nav-pic.png') }}" alt="Navigation Logo" class="hidden md:block w-full">
            </div>
            <!-- Navigation (scrollable) -->
            <nav class="flex-1 overflow-y-auto min-h-0 px-4 md:py-4 py-0 text-md scrollbar-hidden mt-20 md:mt-0">
                <ul class="space-y-3">

                    <li class="flex items-center px-2 mb-4 block md:hidden">
                        <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-14 h-14">
                        <a href="{{ route('clinic.dashboard') }}" class="block px-2 py-2 rounded text-2xl text-[#FF000D] font-900 flex items-center gap-3">Dr.Care </a>
                    </li>

                    <li><a href="{{ route('clinic.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="layout-dashboard" class="w-5 h-5"></i>Dashboard</a></li>
                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">Patient Management</p>
                    <li><a href="{{ route('clinic.patients') }}" class="block px-4 py-2 rounded  hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="users" class="w-5 h-5"></i>Patients</a></li>
                    <li><a href="{{ route('clinic.appointments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="notebook-pen" class="w-5 h-5"></i>Appointments</a></li>
                    <li><a href="{{ route('clinic.messages') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="message-square-text" class="w-5 h-5"></i>Messages</a></li>

                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">Clinic Management</p>
                    <li><a href="{{ route('clinic.supplies') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="package" class="w-5 h-5"></i>Inventory</a></li>
                    <li><a href="{{ route('clinic.transactions')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-text" class="w-5 h-5"></i>Transactions</a></li>
                    <li><a href="{{ route('clinic.payments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="philippine-peso" class="w-5 h-5"></i>Payments </a></li>
                    <li><a href="{{ route('clinic.services') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="briefcase-medical" class="w-5 h-5"></i>Services</a></li>
                    <li><a href="{{ route('clinic.reports')}}" class="block px-4 py-2 rounded  bg-gray-900 text-white flex items-center gap-3"><i data-lucide="chart-column-big" class="w-5 h-5"></i>Reports</a></li>
                    @if ($clinicUser && $clinicUser->UserRole && strtolower($clinicUser->UserRole->role_name) === 'admin')
                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">User Management</p>
                    <li><a href="{{route('clinic.user-accounts')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-user" class="w-5 h-5"></i>Accounts</a></li>
                    <li><a href="{{route('clinic.user-logs')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="logs" class="w-5 h-5"></i>Logs</a></li>
                    @endif
                </ul>
            </nav>
            <div class="flex flex-col p-4 gap-2">
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
                <div>
                    <!-- date and time -->
                    <div class="flex items-center justify-between gap-3 pr-5">
                        <i data-lucide="calendar-clock" class="text-white w-8 h-8"></i>
                        <div id="datetime" class="md:text-md text-sm text-white font-bold"></div>
                    </div>
                </div>
            </div>
            <!-- content container -->
            <div class="flex flex-col flex-1  pt-[60px]">
                <div class="flex flex-row items-center md:gap-5 gap-3 py-8 md:px-14 px-4">
                    <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-16 h-16">
                    <div>
                        <h1 class="text-lg md:text-3xl font-900">Clinic Reports</h1>
                        <h2 class="ml-3 md:text-xl text-xs font-bold items-center ">Summary of Patient and Operational Data</h2>
                    </div>
                </div>
                <!-- Header content -->
                <div class="md:pl-12 pl-6 flex items-center md:gap-2 ">
                    <h1 class="md:text-2xl font-900 text-[#FF000D]">Clinic Activity Reports</h1>
                    <!-- <i data-lucide="circle-question-mark" class="stroke-white font-900 md:w-6 md:h-6 w-4 h-4 fill-[#FF000D]"></i> -->
                </div>
                <!-- Main Content -->
                <div class="grid grid-cols-12 md:p-4 p-2 gap-2">
                    <div class="col-span-12 md:col-span-4  ">
                        <div class="flex flex-col gap-4 p-2 rounded-lg shadow-lg border border-gray-200">
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
                                                <span id="filterLabel">All Time</span>
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
                                    <div class="col-span-3 md:col-span-2">
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
                                    <div class="col-span-1 md:col-span-1">
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
                                                    <li><button data-value="all" class="age-option w-full text-left px-4 py-2 hover:bg-gray-100">All
                                                            Ages</button></li>
                                                    <li><button data-value="0-17" class="age-option w-full text-left px-4 py-2 hover:bg-gray-100">0-17</button></li>
                                                    <li><button data-value="18-64" class="age-option w-full text-left px-4 py-2 hover:bg-gray-100">18-64</button></li>
                                                    <li><button data-value="65+" class="age-option w-full text-left px-4 py-2 hover:bg-gray-100">65+</button></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center px-6 py-2 bg-gray-50 rounded-lg my-2">
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
                                <div class="grid grid-cols-4 border-t border-gray-200 gap-3 p-3">
                                    <!-- Label -->
                                    <div class="col-span-4 flex items-center">
                                        <label for="reportDropdowns" class="text-sm font-medium text-gray-700">
                                            Generate Report:
                                        </label>
                                    </div>

                                    <!-- Dropdown -->
                                    <div class="col-span-4 md:col-span-2">
                                        <!-- Custom Dropdown for Reports -->
                                        <div x-data="{ open: false }" class="relative inline-block w-full text-left">
                                            <input type="hidden" id="reportFilter" value="AlbayReports">
                                            <button
                                                @click="open = !open"
                                                class="w-full bg-white text-gray-700 text-sm font-medium px-2 py-2 rounded-md 
                                                    flex items-center justify-between border-none focus:ring-0 focus:outline-none 
                                                    whitespace-nowrap overflow-hidden text-ellipsis">
                                                <span id="reportLabel">Albay Report</span>
                                                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>

                                            <!-- Dropdown opens above the button -->
                                            <div x-show="open" @click.outside="open = false" @click="open = false"
                                                class="absolute z-10 w-full bg-white border border-gray-200 rounded-md shadow-lg bottom-full mb-1">
                                                <ul class="py-1 text-sm text-gray-700">
                                                    <li>
                                                        <button data-value="AlbayReports" class="report-option w-full text-left px-4 py-2 hover:bg-gray-100">
                                                            Albay Report
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button data-value="GuinobatanReports" class="report-option w-full text-left px-4 py-2 hover:bg-gray-100">
                                                            Guinobatan Report
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Guinobatan Buttons (hidden by default) -->
                                    <div class="col-span-4 md:col-span-2 flex items-center gap-2 hidden" id="GuinobatanReports">
                                        <a href="{{ route('clinic.reports.guinobatan.pdf') }}" target="_blank"
                                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-900 text-red-500 border border-transparent hover:border-red-500 rounded-lg transition">
                                            <i data-lucide="file-text" class="w-5 h-5 me-1" style="stroke-width: 3;"></i>
                                            PDF
                                        </a>
                                        <a href="{{ route('clinic.reports.guinobatan.excel') }}" target="_blank"
                                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-900 text-green-600 border border-transparent hover:border-green-500 rounded-lg transition">
                                            <i data-lucide="sheet" class="w-5 h-5 me-1" style="stroke-width: 3;"></i>
                                            Excel
                                        </a>
                                    </div>

                                    <!-- Albay Buttons (visible by default) -->
                                    <div class="col-span-4 md:col-span-2 flex items-center gap-2" id="AlbayReports">
                                        <a href="{{ route('clinic.reports.albay.pdf') }}" target="_blank"
                                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-900 text-red-500 border border-transparent hover:border-red-500 rounded-lg transition">
                                            <i data-lucide="file-text" class="w-5 h-5 me-1" style="stroke-width: 3;"></i>
                                            PDF
                                        </a>
                                        <a href="{{ route('clinic.reports.albay.excel') }}" target="_blank"
                                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-900 text-green-600 border border-transparent hover:border-green-500 rounded-lg transition">
                                            <i data-lucide="sheet" class="w-5 h-5 me-1" style="stroke-width: 3;"></i>
                                            Excel
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <div class="w-full bg-white rounded-lg shadow-lg border border-gray-200  p-4 md:p-6 h-full">
                            <div class="flex items-center gap-2 p-2 mb-6">
                                <div>
                                    <h5 class="leading-none md:text-xl font-900 text-gray-900  pb-1">Clinic Revenue Overview</h5>
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400"> A summary of all revenue generated by the clinic
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 rounded-full bg-[#1ac3daef] flex items-center justify-center me-3">
                                        <i data-lucide="philippine-peso" class="w-6 h-6 text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="leading-none text-2xl font-900 text-gray-900  pb-1" id="totalRevenue">₱ 5,020</h5>
                                        <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total Revenue</p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <dl class="flex items-center  justify-end ">
                                    <dd class="text-gray-900 text-sm font-semibold">Filter Value:</dd>
                                </dl>
                                <!-- Dropdown -->
                                <div x-data="{ open: false }" class="relative inline-block w-full text-left">
                                    <input type="hidden" id="filter2" value="all">
                                    <button
                                        @click="open = !open"
                                        class="w-full bg-white text-gray-700 text-sm font-medium px-2 py-2 rounded-md 
                                            flex items-center justify-between border border-gray-700 hover:border-sky-500 
                                            focus:ring-1 focus:ring-sky-500 focus:outline-none whitespace-nowrap overflow-hidden text-ellipsis">
                                        <span id="filterLabel2">All Time</span>
                                        <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <div x-show="open" @click.outside="open = false" @click="open = false"
                                        class="absolute z-10 mt-1 w-full bg-white border border-gray-200 rounded-md shadow-lg">
                                        <ul class="py-1 text-sm text-gray-700">
                                            <li><button data-value="all" class="filter2-option w-full text-left px-4 py-2 hover:bg-gray-100">All Time</button></li>
                                            <li><button data-value="today" class="filter2-option w-full text-left px-4 py-2 hover:bg-gray-100">Today</button></li>
                                            <li><button data-value="yesterday" class="filter2-option w-full text-left px-4 py-2 hover:bg-gray-100">Yesterday</button></li>
                                            <li><button data-value="weekly" class="filter2-option w-full text-left px-4 py-2 hover:bg-gray-100">Weekly</button></li>
                                            <li><button data-value="monthly" class="filter2-option w-full text-left px-4 py-2 hover:bg-gray-100">Monthly</button></li>
                                            <li><button data-value="thisYear" class="filter2-option w-full text-left px-4 py-2 hover:bg-gray-100">This Year</button></li>
                                            <li><button data-value="lastYear" class="filter2-option w-full text-left px-4 py-2 hover:bg-gray-100">Last Year</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div id="revenueChart"></div>
                            <div class="grid grid-cols-4 border-t border-gray-200 gap-2 mt-2">
                                <!-- Label -->
                                <div class="col-span-4 md:col-span-2 flex justify-center items-center mt-4">
                                    <p class="text-sm text-center font-medium text-gray-700">Generate Report:</p>
                                </div>
                                <!-- Buttons -->
                                <div class="col-span-4 md:col-span-2 flex items-center gap-2 mt-4">
                                    <a href="{{ route('clinic.reports.revenue-expense.pdf') }}" target="_blank"
                                        class="w-full flex items-center justify-center px-4 py-2 text-sm font-900 text-red-500 border border-transparent hover:border-red-500 rounded-lg transition">
                                        <i data-lucide="file-text" class="w-5 h-5 me-1" style="stroke-width: 3;"></i>
                                        PDF
                                    </a>

                                    <a href="{{ route('clinic.reports.revenue.excel') }}" target="_blank"
                                        class="w-full flex items-center justify-center px-4 py-2 text-sm font-900 text-green-600 border border-transparent hover:border-green-500 rounded-lg transition">
                                        <i data-lucide="sheet" class="w-5 h-5 me-1" style="stroke-width: 3;"></i>
                                        Excel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <div class="w-full bg-white rounded-lg shadow-lg border border-gray-200  p-4 md:p-6 h-full">
                            <h1 class="text-lg font-900 pb-8 px-2">Inventory Overview</h1>
                            <div class="flex justify-between pb-4 mb-3 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 rounded-full bg-green-500 flex items-center justify-center me-3">
                                        <i data-lucide="package" class="w-6 h-6 text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="leading-none text-xl font-900 text-gray-900  pb-1">Items Status</h5>
                                        <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Vaccines, Rigs, Supplies, Equipments</p>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-4 border-gray-200 gap-2 my-4">
                                <!-- Label -->
                                <div class="col-span-4 md:col-span-2 flex justify-center items-center mt-2">
                                    <p class="text-sm text-center font-medium text-gray-700">Generate Report:</p>
                                </div>
                                <!-- Buttons -->
                                <div class="col-span-4 md:col-span-2 flex items-center gap-2 mt-2">
                                    <a href="{{ route('clinic.reports.inventory.pdf') }}" target="_blank"
                                        class="w-full flex items-center justify-center px-4 py-2 text-sm font-900 text-red-500 border border-transparent hover:border-red-500 rounded-lg transition">
                                        <i data-lucide="file-text" class="w-5 h-5 me-1" style="stroke-width: 3;"></i>
                                        PDF
                                    </a>

                                    <a href="{{ route('clinic.reports.inventory.excel') }}" target="_blank"
                                        class="w-full flex items-center justify-center px-4 py-2 text-sm font-900 text-green-600 border border-transparent hover:border-green-500 rounded-lg transition">
                                        <i data-lucide="sheet" class="w-5 h-5 me-1" style="stroke-width: 3;"></i>
                                        Excel
                                    </a>
                                </div>
                            </div>
                            <div>
                                <livewire:inventory-table />
                            </div>

                        </div>
                    </div>


                </div>

            </div>
        </section>

        <!-- Modals For Logout -->
        <x-logout-modal />

</body>

<script>
    const reportFilter = document.getElementById('reportFilter');
    const reportLabel = document.getElementById('reportLabel');

    document.querySelectorAll('.report-option').forEach(option => {
        option.addEventListener('click', e => {
            e.preventDefault();
            const value = option.getAttribute('data-value');
            const text = option.textContent;

            // Update hidden input and label
            reportFilter.value = value;
            reportLabel.textContent = text;

            // Show/hide report sections
            document.querySelectorAll('#AlbayReports, #GuinobatanReports').forEach(div => div.classList.add('hidden'));
            document.getElementById(value).classList.remove('hidden');
        });
    });
</script>

</html>