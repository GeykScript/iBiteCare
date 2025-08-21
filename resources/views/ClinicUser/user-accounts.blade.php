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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/chart.js', 'resources/js/address.js','resources/js/datetime.js'])

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
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-user" class="w-5 h-5"></i>Accounts</a></li>
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
                        <h1 class="text-lg md:text-3xl font-900">Clinic Users Account</h1>
                        <h2 class=",d:ml-3 text-sm md:text-lg font-bold">Manage Clinic User Accounts </h2>

                    </div>
                </div>
                <!-- Header content -->
                <div class="grid grid-cols-4 p-4 md:px-20">
                    <div class="col-span-4 md:col-span-4 flex justify-end  px-2">
                        <button
                            onclick="document.getElementById('newClinicUserModal').showModal()"
                            class=" bg-red-600 text-white px-7 py-2 rounded-lg flex items-center gap-3 focus:outline-none font-bold"><i data-lucide="plus" class="w-5 h-5 stroke-[2]"></i>New User Account</button>
                    </div>

                    <!-- New Clinic User Modal -->
                    <dialog id="newClinicUserModal" class="p-8 rounded-lg shadow-lg w-full max-w-5xl backdrop:bg-black/30 focus:outline-none ">
                        <div class="w-full flex justify-end mb-5">
                            <button onclick="document.getElementById('newClinicUserModal').close()"><i data-lucide="x" class="w-5 h-5"></i></button>
                        </div>

                        <form action="{{route('clinic.users.create')}}" method="POST">
                            @csrf

                            <div class="grid grid-cols-12 md:px-8 gap-2 flex flex-col items-center justify-center">
                                <div class="col-span-12 flex flex-col items-center justify-center">
                                    <h1 class="font-900 text-xl">Create User Account</h1>
                                    <p>Fill out the form below to add a new user.</p>
                                </div>


                                <div class="col-span-12 flex flex-col gap-2 mt-3">
                                    <p>Select the role for the new user</p>
                                    <label for="address" class="text-md font-bold text-gray-800">Clinic Role:</label>
                                    <div class="flex gap-7 md:px-6">

                                        <label class="flex items-center space-x-2">
                                            <input type="radio" name="role" value="1" class=" text-red-500 focus:ring-red-500">
                                            <span>Admin</span>
                                        </label>
                                        <label class="flex items-center space-x-2">
                                            <input type="radio" name="role" value="2" class=" text-green-600 focus:ring-green-600">
                                            <span>Nurse</span>
                                        </label>
                                        <label class="flex items-center space-x-2">
                                            <input type="radio" name="role" value="3" class=" text-sky-600 focus:ring-sky-600">
                                            <span>Staff</span>
                                        </label>
                                    </div>
                                </div>


                                <div class="col-span-12 mt-4 ">
                                    <div class="grid grid-cols-5 gap-4">
                                        <div class="col-span-5 md:col-span-2">
                                            <label for="account_id" class="text-sm font-semibold">Account ID</label>
                                            @php
                                            $generated_id = " ";
                                            @endphp
                                            <input type="text" id="account_id" name="account_id" value="{{ $generated_id }}" class=" w-full p-3 px-4 border border-gray-100 rounded-lg bg-gray-100 focus:outline-none focus:ring-0 focus:border-gray-100" readonly required>
                                        </div>
                                        <div class="col-span-5 md:col-span-2">
                                            <label for="default_password" class=" text-sm font-semibold">Default Password</label>
                                            @php
                                            $default_password = " ";
                                            @endphp
                                            <input type="text" name="default_password" id="default_password" placeholder="Default Password" value="{{ $default_password }}" class=" w-full p-3 px-4 border border-gray-100 rounded-lg bg-gray-100 focus:outline-none focus:ring-0 focus:border-gray-100" readonly required>
                                            <input type="password" name="password" id="password" hidden placeholder="Password" value="{{$default_password}}" class="w-full p-2 border border-gray-300 rounded-lg mt-4" required>
                                        </div>
                                        <div class="col-span-5 md:col-span-1 flex items-end justify-start">
                                            <button type="button"
                                                onclick="regenerateAccountId()"
                                                class="w-full px-4 p-4 bg-sky-500 text-white rounded-lg text-sm">
                                                Generate
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-12 flex items-end justify-end">
                                    <p class="text-sm italic">Generate a random Account ID for the new user.</p>
                                </div>

                                <div class="col-span-12 border-2 border-gray-100 mt-2 mb-2"></div>

                                <div class="col-span-12">
                                    <h1 class="font-semibold text-xl">Personal Information</h1>
                                </div>

                                <div class="col-span-12 grid grid-cols-12 gap-2">
                                    <div class="col-span-12 md:col-span-5">
                                        <input type="text" name="first_name" placeholder="First Name" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300" required>
                                    </div>
                                    <div class="col-span-12 md:col-span-5">
                                        <input type="text" name="last_name" placeholder="Last Name" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300" required>

                                    </div>
                                    <div class="col-span-6 md:col-span-1">
                                        <input type="text" name="middle_initial" placeholder="M.I" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300" required>

                                    </div>
                                    <div class="col-span-6 md:col-span-1">
                                        <input type="text" name="suffix" placeholder="Suffix" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300" required>
                                    </div>
                                </div>

                                <div class="col-span-12 grid grid-cols-6 gap-4 mt-2">
                                    <div class="col-span-6 md:col-span-2 flex flex-col gap-1">
                                        <label for="date_of_birth" class=" text-sm font-bold text-gray-800">Date of Birth</label>
                                        <input type="date" name="date_of_birth" id="date_of_birth" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300" required>
                                    </div>
                                    <div class="col-span-6 md:col-span-1 flex flex-col gap-1">
                                        <label for="age" class=" text-sm font-bold text-gray-800">Age</label>
                                        <input type="number" name="age" placeholder="Age" id="age" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300" required>
                                    </div>
                                    <div class="col-span-6 md:col-span-3 flex flex-col gap-3">
                                        <label class=" text-sm font-bold text-gray-800">Gender</label>
                                        <div class="flex gap-5 items-center">
                                            <label class="flex items-center space-x-2">
                                                <input type="radio" name="gender" value="male" class=" text-sky-500 focus:ring-sky-500">
                                                <span>Male</span>
                                            </label>
                                            <label class="flex items-center space-x-2">
                                                <input type="radio" name="gender" value="female" class=" text-pink-500 focus:ring-pink-500">
                                                <span>Female</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-12 grid grid-cols-4 gap-4 mt-2">
                                    <div class="col-span-4 md:col-span-2 flex flex-col items-center gap-2">
                                        <div class="w-full flex items-center">
                                            <label for="email" class=" text-sm font-bold text-gray-800">Personal Email</label>
                                        </div>
                                        <div class="w-full flex items-center gap-4">
                                            <i data-lucide="mail"></i>
                                            <input type="email" name="email" placeholder="example@gmail.com" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300" required>
                                        </div>
                                    </div>
                                    <div class="col-span-4 md:col-span-2 flex flex-col items-center gap-2">
                                        <div class="w-full flex items-center">
                                            <label for="contact_number" class=" text-sm font-bold text-gray-800"> Phone Number</label>
                                        </div>
                                        <div class="w-full flex items-center gap-4">
                                            <i data-lucide="phone-call"></i>
                                            <input type="tel" name="contact_number" placeholder="e.g 09xxxxxxxxx" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 border-2 border-gray-100 mt-5"></div>


                                <div class="col-span-12 p-2 ">
                                    <label for="address" class="text-xl font-bold text-gray-800">Address</label>
                                </div>

                                <div class="col-span-12 grid grid-cols-12 gap-2">
                                    <div class="col-span-12 md:col-span-4">
                                        <div class="mb-3 relative">
                                            <label for="region_btn" class="text-sm mb-2 font-semibold">Region</label>
                                            <button id="region_btn" type="button"
                                                class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center">
                                                <span id="region_selected">Select Region</span>
                                                <i data-lucide="chevron-down"></i>
                                            </button>
                                            <ul id="region" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                            <input type="hidden" name="region" id="region_input">
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-4">
                                        <div class="mb-3 relative">
                                            <label for="province_btn" class="text-sm mb-2 font-semibold">Province</label>
                                            <button id="province_btn" type="button"
                                                class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                                <span id="province_selected">Select Province</span>
                                                <i data-lucide="chevron-down"></i>
                                            </button>
                                            <ul id="province" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                            <input type="hidden" name="province" id="province_input">
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-4">
                                        <div class="mb-3 relative">
                                            <label for="city_btn" class="text-sm mb-2 font-semibold">City / Municipality</label>
                                            <button id="city_btn" type="button"
                                                class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                                <span id="city_selected">Select City</span>
                                                <i data-lucide="chevron-down"></i>
                                            </button>
                                            <ul id="city" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                            <input type="hidden" name="city" id="city_input">
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-12">
                                        <div class="grid grid-cols-4 gap-4">
                                            <div class="col-span-4 md:col-span-2 mb-3 relative">
                                                <label for="barangay_btn" class="text-sm mb-2 font-semibold">Barangay</label>
                                                <button id="barangay_btn" type="button"
                                                    class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                                    <span id="barangay_selected">Select Barangay</span>
                                                    <i data-lucide="chevron-down"></i>
                                                </button>
                                                <ul id="barangay" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                                <input type="hidden" name="barangay" id="barangay_input">
                                            </div>
                                            <div class="col-span-4 md:col-span-2 ">
                                                <label for="description" class="text-sm mb-2 font-semibold">Purok / Bldng No.</label>
                                                <input type="text" name="description" placeholder="e.g Purok-2" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 border-2 border-gray-100"></div>
                                </div>

                                <div class="col-span-12 flex items-end justify-end gap-2 mt-5">
                                    <button type="submit" class="md:px-8 px-4 py-2 bg-sky-500 text-white rounded-lg text-md">
                                        Create Account
                                    </button>
                                    <button type="button" onclick="document.getElementById('newClinicUserModal').close()"
                                        class="px-6 py-2 bg-gray-100 text-gray-500 rounded-lg text-md ">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </dialog>

                    <livewire:clinic-users-table />
                </div>
            </div>

        </section>

        @if(session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 md:z-50">
            <div class="bg-white rounded-xl shadow-lg w-11/12 max-w-md p-6 flex flex-col items-center gap-4">
                <div class="p-2 rounded-full border-green-100 border-2 bg-green-100">
                    <div class="p-2 rounded-full border-green-300 border-2 bg-green-300">
                        <div class="p-4 rounded-full bg-green-500">
                            <i data-lucide="check" class="text-white w-14 h-14 "></i>
                        </div>
                    </div>
                </div>
                <h2 class="text-xl font-bold text-gray-700">{{ session('success') }}</h2>
                <button
                    @click="show = false"
                    class="mt-4 px-8 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600">
                    Okay
                </button>
            </div>
        </div>
        @endif



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

    async function regenerateAccountId() {
        let response = await fetch("/clinic-users/generate-id");
        let data = await response.json();
        document.getElementById("account_id").value = data.generated_id;
        document.getElementById("default_password").value = data.default_password;
        document.getElementById("password").value = data.default_password;
    }
</script>

</html>