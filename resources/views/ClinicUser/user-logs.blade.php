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
                    <li><a href="{{ route('clinic.patients') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="users" class="w-5 h-5"></i>Patients</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="notebook-pen" class="w-5 h-5"></i>Appointments</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="message-square-text" class="w-5 h-5"></i>Messages</a></li>

                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">Clinic Management</p>
                    <li><a href="{{ route('clinic.supplies') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="package" class="w-5 h-5"></i>Inventory</a></li>
                    <li><a href="{{ route('clinic.transactions')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-text" class="w-5 h-5"></i>Transactions</a></li>
                    <li><a href="{{ route('clinic.payments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="philippine-peso" class="w-5 h-5"></i>Payments </a></li>
                    <li><a href="{{ route('clinic.services') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="briefcase-medical" class="w-5 h-5"></i>Services</a></li>
                    <li><a href="{{ route('clinic.reports')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="chart-column-big" class="w-5 h-5"></i>Reports</a></li>

                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">User Management</p>
                    <li><a href="{{route('clinic.user-accounts')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-user" class="w-5 h-5"></i>Accounts</a></li>
                    <li><a href="{{route('clinic.user-logs')}}" class="block px-4 py-2 rounded bg-gray-900 text-white flex items-center gap-3"><i data-lucide="logs" class="w-5 h-5"></i>Logs</a></li>
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
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xl md:text-3xl font-900">Clinic User Logs</h1>
                        <p class="text-gray-600">View the activity logs of clinic users.</p>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="grid grid-cols-4 p-4  md:px-10 gap-2 ">
                    <div class="col-span-4 md:col-span-4 px-2">

                        <div class="flex items-center justify-center gap-4">
                            <div class="flex items-center p-4 rounded-full bg-red-600">
                                <i data-lucide="logs" class="w-8 h-8 text-white"></i>
                            </div>
                            <div class="flex flex-col items-start justify-start">
                                <h1 class="font-900 text-lg text-red-600">Clinic Users Activity Logs</h1>
                                <p class="text-gray-600">View the details of each user's activity logs.</p>
                            </div>
                        </div>

                        <div class="col-span-4 border-2 border-gray-50 mt-2 mb-2"></div>

                        <livewire:clinic-user-logs-table />
                    </div>
                </div>
            </div>
        </section>


        <!-- Modals For Logout -->
        <x-logout-modal />
</body>




</html>