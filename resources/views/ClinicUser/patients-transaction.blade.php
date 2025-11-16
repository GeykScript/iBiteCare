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

                    <li><a href="{{ route('clinic.dashboard') }}" class="mt-3 block px-4 py-2 rounded hover:bg-gray-900 hover:text-white  flex items-center gap-3"><i data-lucide="layout-dashboard" class="w-5 h-5"></i>Dashboard</a></li>
                    <p class="text-xs font-bold text-gray-400 my-1 uppercase">Patient Management</p>
                    <li><a href="{{ route('clinic.patients')}}" class="block px-4 py-2 rounded bg-gray-900 text-white flex items-center gap-3"><i data-lucide="users" class="w-5 h-5"></i>Patients</a></li>
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
                            <h1 class="text-lg md:text-3xl font-900">Patient Transactions</h1>
                            <div class="flex justify-center items-center">
                                <a href="{{ route('clinic.user-manual') }}" target="_blank" class="text-[#FF000D]"> <i data-lucide="circle-question-mark" class="w-5 h-5"></i>
                                </a>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('clinic.patients') }}" class="font-bold hover:text-red-500 hover:underline underline-offset-4">Patient</a>
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            <p class="font-bold text-red-500">{{ $patient->first_name }} {{ $patient->last_name }} </p>
                        </div>

                    </div>
                </div>

                <div class="grid grid-cols-12">
                    <div class="col-span-3 md:col-span-1 flex items-center justify-center">
                        <a href="{{ route('clinic.patients') }}" class="text-blue-500 hover:underline flex items-center underline-offset-4 font-bold"><i data-lucide="chevron-left" class="w-5 h-5"></i>Back</a>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="grid grid-cols-4 p-4  md:px-10 ">
                    <div class="col-span-4 md:col-span-4 flex flex-col md:flex-row gap-5 md:gap-10 items-end md:items-center justify-end  px-2">
                        <a href="{{ route('clinic.patients.profile', Crypt::encrypt($patient->id)) }}" class="text-blue-500 flex items-center  justify-center gap-1 font-semibold hover:text-blue-600 ">
                            View Information <i data-lucide="file-text" class="w-4 h-4"></i></a>
                        <button
                            onclick="document.getElementById('patientTransactionModal').showModal()"
                            class="bg-red-600 text-white px-7 py-2 rounded-lg flex items-center gap-3 focus:outline-none"><i data-lucide="plus" class="w-5 h-5"></i>Add Transaction</button>
                    </div>
                    <dialog id="patientTransactionModal" class="p-8 rounded-lg shadow-lg w-full max-w-4xl backdrop:bg-black/30 focus:outline-none ">
                        <!-- close modal button  -->
                        <div class="w-full flex justify-end mb-5">
                            <button onclick="document.getElementById('patientTransactionModal').close()" class="focus:outline-none"><i data-lucide="x" class="w-5 h-5"></i></button>
                        </div>


                        <div class="grid grid-cols-12 md:px-8 gap-2 flex flex-col items-center justify-center ">
                            <div class="col-span-12 flex flex-col items-center justify-center">
                                <h1 class="font-900 md:text-2xl text-xl">Patient Transactions</h1>
                            </div>
                            <div class="col-span-12 flex flex-col items-start">
                                <h1 class="font-bold md:text-sm">Complete Immunization: <span class="font-normal text-center"> {{ $schedules->first()->service->name ?? ' ' }}</span>
                                </h1>
                                @if ($schedules->isEmpty())
                                <div class="w-full flex items-center justify-center p-4">
                                    <p class=" text-center text-sm">No pending immunization schedules.</p>
                                </div>
                                @endif
                                <div class="grid grid-cols-4">
                                    @foreach ($schedules as $schedule)
                                    <a href="{{ route('clinic.patients.complete-immunization', 
                                    ['schedule_id' => Crypt::encrypt($schedule->id), 
                                    'service_id' => Crypt::encrypt($schedule->service_id), 
                                    'grouping' => Crypt::encrypt($schedule->grouping), 
                                    'patient_id' => Crypt::encrypt($patient->id)]
                                    ) }}"
                                        class="text-sm col-span-4 md:col-span-1 p-2 flex flex-col items-center justify-center border border-gray-300 rounded-lg m-2 font-bold hover:bg-gray-100 hover:cursor-pointer">{{ $schedule->Day }} <br><span class="text-xs font-normal"> {{ $schedule->scheduled_date}}</span> </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-span-12 flex flex-col items-start">
                                <h1 class="font-bold md:text-sm">New Transaction: </h1>
                                <div class="grid grid-cols-4">
                                    @foreach ($services as $service)
                                    <a href="{{ route('clinic.patients.new-transaction', 
                                    ['service_id' => Crypt::encrypt($service->id), 
                                    'patient_id' => Crypt::encrypt($patient->id)]
                                    ) }}"
                                        class="text-sm col-span-4 md:col-span-1 p-2 flex items-center justify-center border border-gray-300 rounded-lg m-2 hover:bg-sky-300 hover:cursor-pointer">{{ $service->name }}</a>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-span-12 flex items-center justify-end gap-2">
                                <button type="button" onclick="document.getElementById('patientTransactionModal').close()"
                                    class="px-6 py-2 bg-gray-100 text-gray-500 rounded-lg text-md ">
                                    Back
                                </button>
                            </div>
                        </div>
                    </dialog>

                    <div class="col-span-4 md:col-span-4 flex justify-end  px-2">
                        <!-- livewire/patient-table.php -->
                        <livewire:patients-transaction-table :patientId="$patient->id" />
                    </div>
                </div>
        </section>

        <!-- Modals For Logout -->
        <x-logout-modal />


</body>


</html>