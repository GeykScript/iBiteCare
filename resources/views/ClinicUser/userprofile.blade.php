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

                    <li><a href="{{ route('clinic.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="layout-dashboard" class="w-5 h-5"></i>Dashboard</a></li>
                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">Patient Management</p>
                    <li><a href="{{ route('clinic.patients') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="users" class="w-5 h-5"></i>Patients</a></li>
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
            <div class="flex flex-col flex-1  pt-[60px]">
                <div class="flex flex-row items-center gap-5 py-6 md:py-8 md:px-14 px-4">
                    <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="md:w-16 md:h-16 w-14 h-14">
                    <div>
                        <h1 class="text-lg md:text-3xl font-900">Manage Clinic Account</h1>
                        <h2 class=",d:ml-3 text-sm md:text-lg font-bold">Clinic Personal Information</h2>

                    </div>
                </div>
                <!-- Header content -->
                <div class="flex items-center md:px-20 px-2">
                    <h2 class="md:ml-3 md:px-20 md:text-lg text-sm p-4">For your security, change your default password after your first login and set up security questions to help recover your account if needed.</h2>
                </div>
            </div>
            <!-- Main Content -->
            <div class="h-screen ">
                <div class="flex flex-col items-center justify-center px-4 gap-2 pb-10 ">
                    <div class="md:w-1/2 w-full">
                        <h1 class="p-4 text-xl font-900 text-[#FF000C]">Account Information</h1>
                    </div>
                    <div class="flex flex-col md:px-20 md:py-8 p-4 md:w-1/2 w-full bg-white border border-gray-200 shadow-lg rounded-lg">
                        <div class="flex grid grid-cols-12 ">
                            <div class="col-span-1 flex items-center justify-center">
                                <i class="md:w-8 md:h-8 stroke-[#FF000C]" data-lucide="square-user"></i>
                            </div>
                            <div class="col-span-11  px-3 md:px-5 py-1">
                                <h1 class="md:text-xl text-md font-bold">{{$clinicUser->first_name}} {{$clinicUser->middle_initial}} {{$clinicUser->last_name}} </h1>
                                <p class="md:text-sm text-xs text-gray-600">Name</p>
                            </div>
                        </div>
                        <div class="flex grid grid-cols-12 ">
                            <div class="col-span-1 flex items-center justify-center">
                                <i class="md:w-8 md:h-8 stroke-[#FF000C]" data-lucide="mail"></i>
                            </div>
                            <div class="col-span-11  px-3 md:px-5  py-1">
                                <h1 class="md:text-xl text-md font-bold">{{$clinicUser->email}} </h1>
                                <p class="md:text-sm text-xs  text-gray-600">Email</p>
                            </div>
                        </div>
                        <div class="flex grid grid-cols-12 ">
                            <div class="col-span-1 flex items-center justify-center">
                                <i class="md:w-8 md:h-8 stroke-[#FF000C]" data-lucide="phone-call"></i>
                            </div>
                            <div class="col-span-11  px-3 md:px-5  py-1">
                                <h1 class="md:text-xl text-md font-bold">{{$clinicUser->info->contact_number}} </h1>
                                <p class="md:text-sm text-xs  text-gray-600">Phone Number</p>
                            </div>
                        </div>
                        <div class="flex grid grid-cols-12 ">
                            <div class="col-span-1 flex items-center justify-center">
                                <i class="md:w-8 md:h-8 stroke-[#FF000C]" data-lucide="lock-keyhole"></i>
                            </div>
                            <div class="col-span-11 px-3 md:px-5  py-1 ">
                                <div class="flex justify-between">
                                    <input type="password" id="defaultPassword" class="w-full border-none rounded md:text-xl text-sm p-0 font-bold focus:outline-none focus:ring-0" value="{{$clinicUser->default_password}}" readonly>
                                    <button type="button" id="togglePassword" class="ml-2">
                                        <i data-lucide="eye" class="hidden md:w-6 md:h-6 w-4 h-4"></i>
                                        <i data-lucide="eye-off" class="md:w-6 md:h-6 w-4 h-4"></i>
                                    </button>
                                </div>
                                <div>
                                    <p class="text-xs md:text-sm text-gray-600">Default Password</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end">
                            <a href="#" class="flex gap-1  text-xs items-center text-sky-500 font-900">More Details <i data-lucide="info" class="w-4 h-4 fill-sky-500 stroke-white"></i></a>
                        </div>
                    </div>
                    <div class="md:w-1/2 w-full p-4">
                        <h1 class="text-xl font-900 text-[#FF000C]">Update Password</h1>
                        <p class="text-sm text-gray-600">
                            Ensure your account is using a long, random password to stay secure.
                        </p>
                    </div>
                    <div class="flex flex-col md:px-20 md:py-8 p-4 md:w-1/2 w-full bg-white border border-gray-200 shadow-lg rounded-lg">
                        @include('ClinicUser.profile.update-password-form')
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
    document.addEventListener("DOMContentLoaded", function() {
        const passwordField = document.getElementById("defaultPassword");
        const toggleBtn = document.getElementById("togglePassword");
        const eyeIcon = toggleBtn.querySelector('[data-lucide="eye"]');
        const eyeOffIcon = toggleBtn.querySelector('[data-lucide="eye-off"]');

        toggleBtn.addEventListener("click", function() {
            const isHidden = passwordField.type === "password";
            passwordField.type = isHidden ? "text" : "password";

            // Toggle which icon is shown
            eyeIcon.classList.toggle("hidden", !isHidden);
            eyeOffIcon.classList.toggle("hidden", isHidden);
        });

    });
</script>

</html>