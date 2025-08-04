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
                <div class="items-center justify-center text-center">
                    <p class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-600">John Doe</p>
                </div>
                <div>
                    <form method="POST" action="{{ route('clinic.logout') }}">
                        @csrf
                        <button type="submit" class="w-full bg-gray-800 text-white px-4 py-2 rounded hover:bg-red-600">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <section id="mainContent" class="flex-1 ml-56 ">
            <div class="flex flex-col ">
                <div class="bg-gray-900 p-3 flex items-center gap-10 justify-between md:justify-start">
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

                <div class="flex flex-row items-center gap-5 p-8">
                    <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-16 h-16">
                    <div>
                        <h1 class="text-2xl font-bold">Dashboard</h1>
                        <h2 class="ml-3 text-lg font-medium">Hello, {{ Auth::user()->first_name }}</h2>
                    </div>
                </div>
                <div class="pl-7 flex items-center md:gap-2 ">
                    <h1 class="md:text-2xl font-900 text-red-600">Clinic Activity Overview</h1>
                    <i data-lucide="info" class="stroke-white font-900 w-6 h-6 fill-red-600"></i>
                </div>

                <!-- charts -->
                <div class="grid grid-cols-7 p-4 gap-2">
                    <!-- BAR CHART -->
                    <div class="col-span-7 md:col-span-2 max-w-sm w-full bg-white rounded-lg shadow-sm  p-4 md:p-6">
                        <h1 class="text-lg font-bold text-center p-2">Profit & Breakdown Cost</h1>
                        <div class="flex justify-between border-gray-200 border-b dark:border-gray-700 pb-3">
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

                        <div id="bar-chart"></div>
                        <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                            <div class="flex justify-between items-center pt-2">
                                <!-- Button -->
                                <button
                                    id="dropdownDefaultButton"
                                    data-dropdown-toggle="lastDaysdropdown"
                                    data-dropdown-placement="bottom"
                                    class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                                    type="button">
                                    Last 6 months
                                    <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
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
                                <a
                                    href="#"
                                    class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                                    Revenue Report
                                    <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-7 md:col-span-5 flex flex-col ">
                        <!-- donuet chart -->
                        <div class="grid grid-cols-4 bg-white p-4 rounded ">
                            <div class="col-span-4 md:col-span-2" id="donut-chart"></div>

                            <div class="col-span-4 md:col-span-2 flex flex-col gap-16 p-3">
                                <div class="flex flex-col gap-4">
                                    <h1 class="text-xl font-bold py-6">Patients Summary</h1>

                                    <div class="flex justify-start items-start">
                                        <h5 class="text-md font-bold leading-none text-black pe-1">Total Accomodated Patients</h5>
                                        <svg data-popover-target="chart-info" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                                        </svg>
                                        <div data-popover id="chart-info" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-xs opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                            <div class="p-3 space-y-2">
                                                <h3 class="font-semibold text-gray-900 dark:text-white">Activity growth - Incremental</h3>
                                                <p>Report helps navigate cumulative growth of community activities. Ideally, the chart should have a growing trend, as stagnating chart signifies a significant decrease of community activity.</p>
                                                <h3 class="font-semibold text-gray-900 dark:text-white">Calculation</h3>
                                                <p>For each date bucket, the all-time volume of activities is calculated. This means that activities in period n contain all activities up to period n, plus the activities generated by your community in period.</p>
                                                <a href="#" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                                    </svg></a>
                                            </div>
                                            <div data-popper-arrow></div>
                                        </div>
                                    </div>
                                    <div class="flex" id="devices">
                                        <div class="flex items-center me-4">
                                            <input id="desktop" type="checkbox" value="desktop" class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:border-gray-600">
                                            <label for="desktop" class="ms-2 text-sm font-medium text-gray-900 ">Desktop</label>
                                        </div>
                                        <div class="flex items-center me-4">
                                            <input id="tablet" type="checkbox" value="tablet" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:border-gray-600">
                                            <label for="tablet" class="ms-2 text-sm font-medium text-gray-900 ">Tablet</label>
                                        </div>
                                        <div class="flex items-center me-4">
                                            <input id="mobile" type="checkbox" value="mobile" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:border-gray-600">
                                            <label for="mobile" class="ms-2 text-sm font-medium text-gray-900 ">Mobile</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                                    <div class="flex items-center">
                                        <a
                                            href="#"
                                            class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                                            View Patient Reports
                                            <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- other charts -->
                    </div>







                </div>

            </div>
        </section>

</body>
<script>

</script>

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