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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/chart.js'])

    @endif
</head>


<style>
    .scrollbar-hidden::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hidden {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }

    .font-900 {
        font-family: 'Geologica', sans-serif;
        font-weight: 800;

    }

    .js-hidden {
        display: none !important;
    }
</style>

<body>
    <div class="flex h-screen">

        <!-- Sidebar -->
        <div class="side-bar w-56 fixed inset-y-0 bg-white text-black flex flex-col border-r border-gray-300 h-screen z-50 hidden " id="sidebar">
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
            <nav class="flex-1 overflow-y-auto min-h-0 px-4 md:py-6 py-0 text-md scrollbar-hidden mt-20 md:mt-0">
                <ul class="space-y-3">

                    <li class="flex items-center px-2 mb-4 block md:hidden">
                        <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-14 h-14">
                        <a href="{{ route('clinic.dashboard') }}" class="block px-2 py-2 rounded text-2xl text-[#FF000D] font-900 flex items-center gap-3">Dr.Care </a>
                    </li>

                    <li><a href="{{ route('clinic.dashboard') }}" class="block px-4 py-2 rounded bg-gray-900 text-white flex items-center gap-3"><i data-lucide="layout-dashboard" class="w-5 h-5"></i>Dashboard</a></li>
                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">Patient Management</p>
                    <li><a href="{{ route('clinic.patients')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="users" class="w-5 h-5"></i>Patients</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="syringe" class="w-5 h-5"></i>Immunizations</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="notebook-pen" class="w-5 h-5"></i>Appointments</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="message-square-text" class="w-5 h-5"></i>Messages</a></li>

                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">Inventory Management</p>
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="package" class="w-5 h-5"></i>Supplies</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-box" class="w-5 h-5"></i>Supplies Logs</a></li>

                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">Clinic Management</p>
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-text" class="w-5 h-5"></i>Transactions</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="philippine-peso" class="w-5 h-5"></i>Payments </a></li>
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="briefcase-medical" class="w-5 h-5"></i>Services</a></li>
                    <li><a href="{{ route('clinic.reports')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="chart-column-big" class="w-5 h-5"></i>Reports</a></li>

                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">User Management</p>
                    <li><a href="{{route('clinic.user-accounts')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-user" class="w-5 h-5"></i>Accounts</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="logs" class="w-5 h-5"></i>Logs</a></li>
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
                <div class="md:pl-12 pl-6 flex items-center md:gap-2 ">
                    <h1 class="md:text-2xl font-900 text-[#FF000D]">Clinic Activity Overview</h1>
                </div>
                <div class="md:pl-12 pl-6">
                    <h1 class="md:text-lg text-gray-800"> Overview of patient records, clinic activities, and inventory status.
                    </h1>
                </div>
                <!-- Main content grid -->
                <div class="grid grid-cols-7 md:p-4 p-2 gap-4 md:gap-2 ">
                    <!-- div for First CHART -->
                    <div class="col-span-7 md:col-span-3 w-full bg-white ">
                        <div class="flex flex-col gap-4">
                            <div class="w-full bg-white rounded-lg shadow-lg border-2 border-gray-200 p-2 md:p-6">
                                <div class="flex items-center gap-2 p-2">
                                    <div>
                                        <h5 class="leading-none md:text-xl font-900 text-gray-900  pb-1"> Patient Summary</h5>
                                        <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Comprehensive view of patient records and activities</p>
                                    </div>
                                </div>
                                <div class="flex  justify-evenly items-center mb-4 mt-2 md:gap-4 gap-2 px-6">
                                    <select id="filter" class="border rounded w-full p-1 text-sm ">
                                        <option value="today">Today</option>
                                        <option value="yesterday">Yesterday</option>
                                        <option value="lastWeek">Last Week</option>
                                        <option value="lastMonth">Last Month</option>
                                        <option value="lastYear">Last Year</option>
                                    </select>
                                    <select id="serviceFilter" class="border rounded w-full  p-1 text-sm">
                                        <option value="">Service</option>
                                        <option value="">Anti-Rabies</option>
                                        <option value="">Booster</option>
                                        <option value="">Tetanus Toxiod</option>
                                    </select>
                                    <select id="ageFilter" class="border rounded p-1 w-full text-sm">
                                        <option value="all">Age</option>
                                        <option value="0-17">0-17</option>
                                        <option value="18-64">18-64</option>
                                        <option value="65+">65+</option>
                                    </select>
                                </div>
                                <div class="flex items-center px-4 py-2">
                                    <div class="w-12 h-12 rounded-full bg-red-600 flex items-center justify-center me-3">
                                        <i data-lucide="users" class="w-6 h-6 text-white"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 font-bold">Accomodated Patients</p>
                                        <h5 class="leading-none text-2xl font-900 text-gray-900  pb-1">5,020</h5>
                                        <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total Patients</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-evenly">
                                    <div>
                                        <h1 class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Total Male</h1>
                                        <h1 class="leading-none text-md font-bold text-green-500 text-sky-500">23,635</h1>
                                    </div>
                                    <div>
                                        <h1 class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Total Female</h1>
                                        <h1 class="leading-none text-md font-bold text-red-600 text-[#ff0a70ec]">18,230</h1>
                                    </div>
                                </div>
                                <div id="bar-chart"></div>
                                <div class="grid grid-cols-2  border-gray-200 border-t">
                                    <div class="col-span-2 mt-2 flex items-end justify-end">
                                        <a href="{{ route('clinic.patients') }}" class="px-5 py-2.5 text-xs font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
                        <div class="grid grid-cols-5 bg-white  rounded md:gap-2 gap-4 ">
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
                                                    <a href="#" class="text-xs text-sky-600 hover:text-sky-700 flex items-center gap-1">See Details <i data-lucide="info" class="w-3 h-3"></i></a>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center  bg-sky-400 rounded-full w-12 h-12">
                                                <h1 class="text-white font-bold">5</h1>
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
                                                    <h1 class="font-bold">Appointments</h1>
                                                    <a href="#" class="text-xs text-sky-600 hover:text-sky-700 flex items-center gap-1">See Details <i data-lucide="info" class="w-3 h-3"></i></a>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center  bg-gray-400 rounded-full w-12 h-12">
                                                <h1 class="text-white font-bold">5</h1>
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
                                    <div class="overflow-y-auto max-h-[14.5rem] pr-2 mb-4 scrollbar-hidden ">
                                        <div class="flex justify-between px-2 mt-2">
                                            <div class="flex items-center">
                                                <div class="flex items-center justify-center">
                                                    <i data-lucide="circle-user" class="w-5 h-5 text-gray-500"></i>
                                                </div>
                                                <div class="ml-2">
                                                    <h1 class="text-sm font-bold text-gray-900">John Doe</h1>
                                                    <p class="text-xs font-normal text-gray-500">Visited on: 2023-10-01</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center text-sky-600">
                                                <a href="#" class="text-xs flex hover:text-sky-800">Details <i data-lucide="chevron-right" class="w-4 h-4 "></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="flex justify-between px-2 mt-2">
                                            <div class="flex items-center">
                                                <div class="flex items-center justify-center">
                                                    <i data-lucide="circle-user" class="w-5 h-5 text-gray-500"></i>
                                                </div>
                                                <div class="ml-2">
                                                    <h1 class="text-sm font-bold text-gray-900">John Doe</h1>
                                                    <p class="text-xs font-normal text-gray-500">Visited on: 2023-10-01</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center text-sky-600">
                                                <a href="#" class="text-xs flex hover:text-sky-800">Details <i data-lucide="chevron-right" class="w-4 h-4 "></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="flex justify-between px-2 mt-2">
                                            <div class="flex items-center">
                                                <div class="flex items-center justify-center">
                                                    <i data-lucide="circle-user" class="w-5 h-5 text-gray-500"></i>
                                                </div>
                                                <div class="ml-2">
                                                    <h1 class="text-sm font-bold text-gray-900">John Doe</h1>
                                                    <p class="text-xs font-normal text-gray-500">Visited on: 2023-10-01</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center text-sky-600">
                                                <a href="#" class="text-xs flex hover:text-sky-800">Details <i data-lucide="chevron-right" class="w-4 h-4 "></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="flex justify-between px-2 mt-2">
                                            <div class="flex items-center">
                                                <div class="flex items-center justify-center">
                                                    <i data-lucide="circle-user" class="w-5 h-5 text-gray-500"></i>
                                                </div>
                                                <div class="ml-2">
                                                    <h1 class="text-sm font-bold text-gray-900">John Doe</h1>
                                                    <p class="text-xs font-normal text-gray-500">Visited on: 2023-10-01</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center text-sky-600">
                                                <a href="#" class="text-xs flex hover:text-sky-800">Details <i data-lucide="chevron-right" class="w-4 h-4 "></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="flex justify-between px-2 mt-2">
                                            <div class="flex items-center">
                                                <div class="flex items-center justify-center">
                                                    <i data-lucide="circle-user" class="w-5 h-5 text-gray-500"></i>
                                                </div>
                                                <div class="ml-2">
                                                    <h1 class="text-sm font-bold text-gray-900">John Doe</h1>
                                                    <p class="text-xs font-normal text-gray-500">Visited on: 2023-10-01</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center text-sky-600">
                                                <a href="#" class="text-xs flex hover:text-sky-800">Details <i data-lucide="chevron-right" class="w-4 h-4 "></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="flex justify-between px-2 mt-2">
                                            <div class="flex items-center">
                                                <div class="flex items-center justify-center">
                                                    <i data-lucide="circle-user" class="w-5 h-5 text-gray-500"></i>
                                                </div>
                                                <div class="ml-2">
                                                    <h1 class="text-sm font-bold text-gray-900">John Doe</h1>
                                                    <p class="text-xs font-normal text-gray-500">Visited on: 2023-10-01</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center text-sky-600">
                                                <a href="#" class="text-xs flex hover:text-sky-800">Details <i data-lucide="chevron-right" class="w-4 h-4 "></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="flex justify-between px-2 mt-2">
                                            <div class="flex items-center">
                                                <div class="flex items-center justify-center">
                                                    <i data-lucide="circle-user" class="w-5 h-5 text-gray-500"></i>
                                                </div>
                                                <div class="ml-2">
                                                    <h1 class="text-sm font-bold text-gray-900">John Doe</h1>
                                                    <p class="text-xs font-normal text-gray-500">Visited on: 2023-10-01</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center text-sky-600">
                                                <a href="#" class="text-xs flex hover:text-sky-800">Details <i data-lucide="chevron-right" class="w-4 h-4 "></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="flex justify-between px-2 mt-2">
                                            <div class="flex items-center">
                                                <div class="flex items-center justify-center">
                                                    <i data-lucide="circle-user" class="w-5 h-5 text-gray-500"></i>
                                                </div>
                                                <div class="ml-2">
                                                    <h1 class="text-sm font-bold text-gray-900">John Doe</h1>
                                                    <p class="text-xs font-normal text-gray-500">Visited on: 2023-10-01</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center text-sky-600">
                                                <a href="#" class="text-xs flex hover:text-sky-800">Details <i data-lucide="chevron-right" class="w-4 h-4 "></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="flex justify-between px-2 mt-2">
                                            <div class="flex items-center">
                                                <div class="flex items-center justify-center">
                                                    <i data-lucide="circle-user" class="w-5 h-5 text-gray-500"></i>
                                                </div>
                                                <div class="ml-2">
                                                    <h1 class="text-sm font-bold text-gray-900">John Doe</h1>
                                                    <p class="text-xs font-normal text-gray-500">Visited on: 2023-10-01</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center text-sky-600">
                                                <a href="#" class="text-xs flex hover:text-sky-800">Details <i data-lucide="chevron-right" class="w-4 h-4 "></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="flex justify-between px-2 mt-2">
                                            <div class="flex items-center">
                                                <div class="flex items-center justify-center">
                                                    <i data-lucide="circle-user" class="w-5 h-5 text-gray-500"></i>
                                                </div>
                                                <div class="ml-2">
                                                    <h1 class="text-sm font-bold text-gray-900">John Doe</h1>
                                                    <p class="text-xs font-normal text-gray-500">Visited on: 2023-10-01</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center text-sky-600">
                                                <a href="#" class="text-xs flex hover:text-sky-800">Details <i data-lucide="chevron-right" class="w-4 h-4 "></i>
                                                </a>
                                            </div>
                                        </div>
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
                                            <a href="#" class="px-5 py-2.5 text-sm font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
        <x-modal id="logoutModal" title="Confirm Logout">
            <form method="POST" action="{{ route('clinic.logout') }}">
                @csrf
                <p class="mb-4">Are you sure you want to log out?</p>

                <div class="flex justify-end gap-2">
                    <button type="button"
                        onclick="document.getElementById('logoutModal').classList.add('hidden')"
                        class="border-2 border-gray-200 px-4 py-2 rounded">
                        Cancel
                    </button>

                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">
                        Confirm
                    </button>
                </div>
            </form>
        </x-modal>
</body>

</html>