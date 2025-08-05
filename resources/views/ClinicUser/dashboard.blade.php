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
</style>

<body>
    <div class="flex h-screen">

        <!-- Sidebar -->
        <div class="side-bar w-56 fixed inset-y-0 bg-white text-black flex flex-col border-r border-gray-300 h-screen z-50" id="sidebar">
            <div class="absolute top-20 right-[-0.6rem]  md:hidden">
                <button id="closeSidebar" class="text-white text-2xl">
                    <i data-lucide="circle-chevron-right" class="w-6 h-6 stroke-white fill-red-600"></i>
                </button>
            </div>
            <!-- Logo -->
            <div>
                <img src="{{ asset('images/nav-pic.png') }}" alt="Navigation Logo" class="w-full">
            </div>
            <!-- Navigation (scrollable) -->
            <nav class="flex-1 overflow-y-auto min-h-0 px-4 py-6 text-md scrollbar-hidden">
                <ul class="space-y-3">
                    <li><a href="#" class="block px-4 py-2 rounded bg-gray-800 text-white flex items-center gap-3"><i data-lucide="layout-dashboard" class="w-5 h-5"></i>Dashboard</a></li>

                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">Patient Management</p>
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="users" class="w-5 h-5"></i>Patients</a></li>
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
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="chart-column-big" class="w-5 h-5"></i>Reports</a></li>

                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">User Management</p>
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-user" class="w-5 h-5"></i>Accounts</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="logs" class="w-5 h-5"></i>Logs</a></li>
                </ul>
            </nav>
            <div class="flex flex-col p-4 gap-2">
                <a href="#" class="flex flex-row items-center justify-between text-center w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-500">
                    <i data-lucide="circle-user" class="w-6 h-6"></i>
                    <div class="flex flex-col items-center">
                        <h1 class="text-sm font-bold">{{ Auth::user()->first_name }}</h1>
                        <p class="text-xs">Administrator</p>
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
        <section id="mainContent" class="flex-1 ml-56 h-full  ">
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
                <div class="flex flex-row items-center gap-5 py-8 px-14">
                    <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-16 h-16">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-900">Dashboard</h1>
                        <h2 class="ml-3 text-lg font-bold">Hello, {{ Auth::user()->first_name }}!</h2>
                    </div>
                </div>
                <!-- Header content -->
                <div class="pl-12 flex items-center md:gap-2 ">
                    <h1 class="md:text-2xl font-900 text-[#FF000D]">Clinic Activity Overview</h1>
                    <i data-lucide="circle-question-mark" class="stroke-white font-900 w-6 h-6 fill-[#FF000D]"></i>
                </div>
                <!-- charts Contents -->
                <div class="grid grid-cols-7 p-4 ">
                    <!-- BAR CHART -->
                    <div class="col-span-7 md:col-span-2 w-full bg-white  p-2">
                        <div class="w-full rounded-lg shadow-xl border border-gray-200 p-4">
                            <h1 class="text-lg font-bold text-center p-2">Profit & Breakdown Cost</h1>
                            <div class="flex justify-between border-gray-200 border-b dark:border-gray-700 pb-3 px-2">
                                <div>
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Profit</dt>
                                    <dd class="leading-none text-2xl font-900 text-gray-900 ">₱ 5,405</dd>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 py-3">
                                <dl>
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Income</dt>
                                    <dd class="leading-none text-md font-bold text-green-500 dark:text-green-400">₱ 23,635</dd>
                                </dl>
                                <dl>
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Expense</dt>
                                    <dd class="leading-none text-md font-bold text-red-600 dark:text-red-500">₱ 18,230</dd>
                                </dl>
                            </div>
                            <!-- bar chart Div-->
                            <div id="bar-chart"></div>
                            <!-- chart options -->
                            <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                                <div class="flex justify-between items-center pt-2">
                                    <!-- Button -->
                                    <button
                                        id="dropdownDefaultButton"
                                        data-dropdown-toggle="lastDaysdropdown"
                                        data-dropdown-placement="bottom"
                                        class="text-sm font-medium text-gray-500 dark:text-gray-400 text-center inline-flex items-center "
                                        type="button">
                                        Last 6 months
                                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div id="lastDaysdropdown" class=" hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 6 months</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last year</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="#" class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600  px-3 py-2"> Revenue Report
                                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- div for Three CHART -->
                    <div class="col-span-7 md:col-span-5 flex flex-col p-2 gap-3 ">
                        <div class="grid grid-cols-4 bg-white rounded-lg shadow-md border border-gray-200 p-4 ">

                            <!-- donut chart div -->
                            <div class="col-span-4 md:col-span-2" id="donut-chart"></div>
                            <!-- chart options -->
                            <div class="col-span-4 md:col-span-2 flex flex-col gap-16 p-3">
                                <div class="flex flex-col gap-4">
                                    <h1 class="text-xl font-bold py-6">Patients Summary</h1>
                                    <div class="flex justify-start items-start">
                                        <h5 class="text-md font-bold leading-none text-black pe-1">Total Accomodated Patients</h5>
                                    </div>
                                    <div class="flex flex-col md:flex-row" id="devices">
                                        <div class="flex items-center me-4">
                                            <input id="anti-rabies" type="checkbox" value="anti-rabies" class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:border-gray-600">
                                            <label for="anti-rabies" class="ms-2 text-sm font-medium text-gray-900 ">Anti Rabies</label>
                                        </div>
                                        <div class="flex items-center me-4">
                                            <input id="booster" type="checkbox" value="booster" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:border-gray-600">
                                            <label for="booster" class="ms-2 text-sm font-medium text-gray-900 ">Booster</label>
                                        </div>
                                        <div class="flex items-center me-4">
                                            <input id="tetanus" type="checkbox" value="tetanus" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:border-gray-600">
                                            <label for="tetanus" class="ms-2 text-sm font-medium text-gray-900 ">Tetanus Toxoid</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 flex border-gray-400 border-t ">
                                    <div class="flex items-end justify-end">
                                        <a
                                            href="#"
                                            class="uppercase text-sm font-semibold inline-flex items-end rounded-lg text-blue-600  px-3 py-2">
                                            View Patient Reports
                                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- div for two chart -->
                        <div class="grid grid-cols-4 bg-white  rounded gap-2 ">

                            <!-- line chart -->
                            <div class="col-span-4 md:col-span-2  rounded-lg shadow-xl border border-gray-200 p-4">
                                <div class="w-full bg-white  shadow-sm md:px-4  ">
                                    <h1 class="text-lg font-bold  p-2">Patient Gender Demographics</h1>
                                    <div class="grid grid-cols-2 py-3">
                                        <dl>
                                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Total Male</dt>
                                            <dd class="leading-none text-md font-bold text-green-500 text-indigo-500">23,635</dd>
                                        </dl>
                                        <dl>
                                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Total Female</dt>
                                            <dd class="leading-none text-md font-bold text-red-600 text-pink-500">18,230</dd>
                                        </dl>
                                    </div>
                                    <!-- legend or line chart div -->
                                    <div id="legend-chart"></div>
                                    <!-- chart options -->
                                    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-5">
                                        <div class="flex justify-between items-center pt-4">
                                            <!-- Button -->
                                            <button
                                                id="dropdownDefaultButton"
                                                data-dropdown-toggle="lastDaysdropdown"
                                                data-dropdown-placement="bottom"
                                                class="text-sm font-medium text-gray-500 text-center inline-flex items-center "
                                                type="button">
                                                Last 7 days
                                                <i data-lucide="chevron-down" class="h-4 w-4"></i>
                                            </button>
                                            <!-- Dropdown menu -->
                                            <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                                    <li>
                                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <a
                                                href="#"
                                                class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600  px-3 py-2">
                                                More Details
                                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- pie chart -->
                            <div class="col-span-4 md:col-span-2 rounded-lg shadow-xl border border-gray-200 p-4">
                                <div class="w-full bg-white  ">
                                    <h1 class="text-lg font-bold p-2">Patient Gender Demographics</h1>
                                    <!-- pie chart div  -->
                                    <div class="py-3" id="pie-chart"></div>
                                    <!-- chart options -->
                                    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                                        <div class="flex justify-between items-center pt-4">
                                            <!-- Button -->
                                            <button
                                                id="dropdownDefaultButton"
                                                data-dropdown-toggle="lastDaysdropdown"
                                                data-dropdown-placement="bottom"
                                                class="text-sm font-medium text-gray-500  text-center inline-flex items-center"
                                                type="button">
                                                Last 7 days
                                                <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                                </svg>
                                            </button>
                                            <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                                    <li>
                                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <a
                                                href="#"
                                                class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700  px-3 py-2">
                                                More Details
                                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                            </a>
                                        </div>
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

<script>
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const toggleSidebar = document.getElementById('toggleSidebar');
    const closeSidebar = document.getElementById('closeSidebar');

    // Overlay for mobile outside-click
    const overlay = document.createElement('div');
    overlay.id = 'sidebarOverlay';
    overlay.className = 'fixed inset-0 bg-black bg-opacity-50 z-40 hidden';
    document.body.appendChild(overlay);

    function openSidebar() {
        sidebar.classList.remove('hidden');
        overlay.classList.remove('hidden');

        // On mobile, remove left margin
        if (window.innerWidth < 768) {
            mainContent.classList.remove('ml-56');
        }
    }

    function closeSidebarFunc() {
        if (window.innerWidth < 768) {
            sidebar.classList.add('hidden');
            overlay.classList.add('hidden');
            mainContent.classList.remove('ml-56');
        } else {
            // Toggle on desktop: expand/shrink
            sidebar.classList.toggle('hidden');
            mainContent.classList.toggle('ml-56');
        }
    }

    toggleSidebar.addEventListener('click', () => {
        if (window.innerWidth < 768) {
            openSidebar();
        } else {
            closeSidebarFunc();
        }
    });

    closeSidebar.addEventListener('click', () => {
        closeSidebarFunc();
    });

    overlay.addEventListener('click', () => {
        closeSidebarFunc();
    });

    // Reset state on window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
            sidebar.classList.remove('hidden');
            overlay.classList.add('hidden');
            mainContent.classList.add('ml-56');
        } else {
            sidebar.classList.add('hidden');
            mainContent.classList.remove('ml-56');
        }
    });

    // Init
    if (window.innerWidth < 768) {
        sidebar.classList.add('hidden');
        mainContent.classList.remove('ml-56');
    }

    function updateDateTime() {
        const now = new Date();

        // Weekday and Month Names
        const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July',
            'August', 'September', 'October', 'November', 'December'
        ];

        const weekday = weekdays[now.getDay()];
        const month = months[now.getMonth()];
        const day = now.getDate();
        const year = now.getFullYear();

        // Format time
        let hours = now.getHours();
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';

        hours = hours % 12 || 12; // Convert 0 to 12

        // Create formatted strings
        const weekdayString = `${weekday}`;
        const dateString = `${month} ${day}, ${year}`;
        const timeString = `${hours}:${minutes} ${ampm}`;

        // Update DOM
        document.getElementById('datetime').innerHTML = `${dateString} <br> ${weekdayString}, ${timeString}`;
    }

    // Update immediately and then every second
    updateDateTime();
    setInterval(updateDateTime, 1000);
</script>



</html>