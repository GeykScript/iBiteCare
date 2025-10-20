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
            <nav class="flex-1 overflow-y-auto min-h-0 px-4 md:py-4 py-0 text-md scrollbar-hidden mt-20 md:mt-0">
                <ul class="space-y-3">

                    <li class="flex items-center px-2 mb-4 block md:hidden">
                        <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-14 h-14">
                        <a href="{{ route('clinic.dashboard') }}" class="block px-2 py-2 rounded text-2xl text-[#FF000D] font-900 flex items-center gap-3">Dr.Care </a>
                    </li>

                    <li><a href="{{ route('clinic.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="layout-dashboard" class="w-5 h-5"></i>Dashboard</a></li>
                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">Patient Management</p>
                    <li><a href="{{ route('clinic.patients') }}" class="block px-4 py-2 rounded  hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="users" class="w-5 h-5"></i>Patients</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="notebook-pen" class="w-5 h-5"></i>Appointments</a></li>
                    <li><a href="{{ route('clinic.messages') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="message-square-text" class="w-5 h-5"></i>Messages</a></li>

                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">Clinic Management</p>
                    <li><a href="{{ route('clinic.supplies') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="package" class="w-5 h-5"></i>Inventory</a></li>
                    <li><a href="{{ route('clinic.transactions')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-text" class="w-5 h-5"></i>Transactions</a></li>
                    <li><a href="{{ route('clinic.payments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="philippine-peso" class="w-5 h-5"></i>Payments </a></li>
                    <li><a href="{{ route('clinic.services') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="briefcase-medical" class="w-5 h-5"></i>Services</a></li>
                    <li><a href="{{ route('clinic.reports')}}" class="block px-4 py-2 rounded  bg-gray-900 text-white flex items-center gap-3"><i data-lucide="chart-column-big" class="w-5 h-5"></i>Reports</a></li>

                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">User Management</p>
                    <li><a href="{{route('clinic.user-accounts')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-user" class="w-5 h-5"></i>Accounts</a></li>
                    <li><a href="{{route('clinic.user-logs')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="logs" class="w-5 h-5"></i>Logs</a></li>
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
                    <i data-lucide="circle-question-mark" class="stroke-white font-900 md:w-6 md:h-6 w-4 h-4 fill-[#FF000D]"></i>
                </div>
                <!-- Main Content -->
                <div class="grid grid-cols-12 md:p-4 p-2 gap-2">
                    <div class="col-span-12 md:col-span-4 shadow-lg border-2 border-gray-200 ">
                        <div class="w-full bg-white rounded-lg  p-2 md:p-6">
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
                    <div class="col-span-12 md:col-span-4">
                        <div class="w-full bg-white rounded-lg shadow-lg border border-gray-200  p-4 md:p-6 h-full">
                            <h1 class="text-lg font-900 pb-8 px-2"> Clinic Revenue Overview</h1>
                            <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 rounded-full bg-[#1ac3daef] flex items-center justify-center me-3">
                                        <i data-lucide="philippine-peso" class="w-6 h-6 text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="leading-none text-2xl font-900 text-gray-900  pb-1">₱ 5,020</h5>
                                        <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Total Revenue</p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2">
                                <dl class="flex items-center">
                                    <dt class="text-gray-500 text-sm font-normal me-1">Sales:</dt>
                                    <dd class="text-gray-900 text-sm font-semibold">₱ 3,232</dd>
                                </dl>
                                <select id="timeFilter" class="border rounded w-full p-1 text-sm ">
                                    <option value="today">Today</option>
                                    <option value="yesterday">Yesterday</option>
                                    <option value="lastWeek">Last Week</option>
                                    <option value="lastMonth">Last Month</option>
                                    <option value="lastYear">Last Year</option>
                                </select>
                            </div>

                            <div id="column-chart"></div>
                            <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                                <div class="flex justify-between items-center pt-5">
                                    <a href="#" class="px-5 py-2.5 text-sm font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <i data-lucide="file-text" class="w-4 h-4 me-2"></i>
                                        View Details
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
                            <div>
                                <livewire:inventory-table />
                            </div>



                            <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                                <div class="flex justify-between items-center pt-5">
                                    <a href="{{ route('clinic.supplies') }}" class="px-5 py-2.5 text-sm font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <i data-lucide="file-text" class="w-4 h-4 me-2"></i>
                                        View Details
                                    </a>
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