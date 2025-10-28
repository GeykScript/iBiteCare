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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/chart.js', 'resources/js/address.js', 'resources/js/address2.js', 'resources/js/datetime.js'])

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
                    <li><a href="{{ route('clinic.patients') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="users" class="w-5 h-5"></i>Patients</a></li>
                    <li><a href="{{ route('clinic.appointments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="notebook-pen" class="w-5 h-5"></i>Appointments</a></li>
                    <li><a href="{{ route('clinic.messages') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="message-square-text" class="w-5 h-5"></i>Messages</a></li>

                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">Clinic Management</p>
                    <li><a href="{{ route('clinic.supplies') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="package" class="w-5 h-5"></i>Inventory</a></li>
                    <li><a href="{{ route('clinic.transactions')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-text" class="w-5 h-5"></i>Transactions</a></li>
                    <li><a href="{{ route('clinic.payments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="philippine-peso" class="w-5 h-5"></i>Payments </a></li>
                    <li><a href="{{ route('clinic.services') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="briefcase-medical" class="w-5 h-5"></i>Services</a></li>
                    @if ($clinicUser && $clinicUser->UserRole && strtolower($clinicUser->UserRole->role_name) === 'admin')
                    <li><a href="{{ route('clinic.reports')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="chart-column-big" class="w-5 h-5"></i>Reports</a></li>
                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">User Management</p>
                    <li><a href="{{route('clinic.user-accounts')}}" class="block px-4 py-2 rounded bg-gray-900 text-white flex items-center gap-3"><i data-lucide="file-user" class="w-5 h-5"></i>Accounts</a></li>
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
                            class=" bg-red-600 text-white px-7 py-2 rounded-lg flex items-center gap-3 focus:outline-none font-bold hover:bg-red-700"><i data-lucide="plus" class="w-5 h-5 stroke-[2]"></i>New User Account</button>
                    </div>

                    <!-- New Clinic User Modal -->
                    <dialog id="newClinicUserModal" class="p-8 rounded-lg shadow-lg w-full max-w-5xl backdrop:bg-black/30 focus:outline-none ">
                        <!-- close modal button  -->
                        <div class="w-full flex justify-end mb-5">
                            <button onclick="document.getElementById('newClinicUserModal').close()" class="focus:outline-none"><i data-lucide="x" class="w-5 h-5"></i></button>
                        </div>

                        <!-- create new user form  -->
                        <form action="{{route('clinic.users.create')}}" method="POST" id="create_account_form">
                            @csrf
                            <div class="grid grid-cols-12 md:px-8 gap-2 flex flex-col items-center justify-center">
                                <div class="col-span-12 flex flex-col items-center justify-center">
                                    <h1 class="font-900 md:text-2xl text-xl">Create User Account</h1>
                                    <p>Fill out the form below to add a new user. All fields are required.</p>
                                </div>

                                <!-- clinic role radio inputs  -->
                                <div class="col-span-12 flex flex-col gap-2 mt-3">
                                    <p>Select the role for the new user</p>
                                    <label for="address" class="text-md font-bold text-gray-800">Clinic Role: <span class="text-red-500" id="role-error">*</span></label>
                                    <div class="flex gap-7 md:px-6">
                                        <!-- admin role -->
                                        <label class="flex items-center space-x-2">
                                            <input type="radio" name="role" value="1" class="text-red-500 focus:ring-red-500" required {{ old('role') == '1' ? 'checked' : '' }}>
                                            <span>Admin</span>
                                        </label>
                                        <!-- nurse role  -->
                                        <label class="flex items-center space-x-2">
                                            <input type="radio" name="role" value="2" class="text-green-600 focus:ring-green-600" {{ old('role') == '2' ? 'checked' : '' }}>
                                            <span>Nurse</span>
                                        </label>
                                        <!-- staff role  -->
                                        <label class="flex items-center space-x-2">
                                            <input type="radio" name="role" value="3" class="text-sky-600 focus:ring-sky-600" {{ old('role') == '3' ? 'checked' : '' }}>
                                            <span>Staff</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- account id and default password -->
                                <div class="col-span-12 mt-4 ">
                                    <div class="grid grid-cols-5 gap-4">

                                        <!-- account id  -->
                                        <div class="col-span-5 md:col-span-2">
                                            <label for="account_id" class="text-sm font-semibold">Account ID: <span class="text-red-500" id="account-id-error">*</span></label>
                                            @php
                                            $generated_id = " ";
                                            @endphp
                                            <input type="text" id="account_id" name="account_id" value="{{ $generated_id }}" class=" w-full p-3 px-4 border border-gray-100 rounded-lg bg-gray-100 focus:outline-none focus:ring-0 focus:border-gray-100" readonly>
                                        </div>

                                        <!-- default password  -->
                                        <div class="col-span-5 md:col-span-2">
                                            <label for="default_password" class=" text-sm font-semibold">Default Password: <span class="text-red-500" id="default-password-error">*</span></label>
                                            @php
                                            $default_password = " ";
                                            @endphp
                                            <input type="text" name="default_password" id="default_password" placeholder="Default Password" value="{{ $default_password }}" class=" w-full p-3 px-4 border border-gray-100 rounded-lg bg-gray-100 focus:outline-none focus:ring-0 focus:border-gray-100" readonly>
                                            <!-- hidden password input  -->
                                            <input type="password" name="password" id="password" placeholder="Password" value="{{$default_password}}" class="w-full p-2 border border-gray-300 rounded-lg mt-4" hidden>
                                        </div>

                                        <!-- Generate button  -->
                                        <div class="col-span-5 md:col-span-1 flex items-end justify-start">
                                            <button type="button" onclick="regenerateAccountId()" class="w-full px-4 p-4 bg-sky-500 text-white rounded-lg text-sm"> Generate </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-12 flex items-end justify-end">
                                    <p class="text-sm italic">Generate a random Account ID for the new user.</p>
                                </div>

                                <!-- divider border  -->
                                <div class="col-span-12 border-2 border-gray-100 mt-2 mb-2"></div>

                                <div class="col-span-12">
                                    <h1 class="font-semibold text-xl">Personal Information</h1>
                                </div>

                                <!-- fname. lname , initial div  -->
                                <div class="col-span-12 grid grid-cols-12 gap-2">

                                    <!-- FIRST NAME -->
                                    <div class="col-span-12 md:col-span-5">
                                        @if ($errors->has('first_name'))
                                        <label for="first_name" class="text-sm font-semibold flex justify-between">First Name:
                                            <span class="text-red-500 text-xs" id="first-name-error">
                                                {{ $errors->first('first_name') }}
                                                required*</span>
                                        </label>
                                        @else
                                        <label for="first_name" class="text-sm font-semibold ">First Name:
                                            <span class="text-red-500 text-xs" id="first-name-error">*</span>
                                        </label>
                                        @endif

                                        <input type="text" id="first_name" name="first_name"
                                            placeholder="First Name"
                                            pattern="[A-Z\s]+"
                                            oninput="this.value = this.value.toUpperCase()"
                                            title="Only  letters are allowed"
                                            value="{{ old('first_name') }}"
                                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300 uppercase">
                                    </div>

                                    <!-- LAST NAME -->
                                    <div class="col-span-12 md:col-span-5">

                                        @if ($errors->has('last_name'))
                                        <label for="last_name" class="text-sm font-semibold flex justify-between items-center w-full">Last Name:
                                            <span class="text-red-500 text-xs" id="last-name-error">
                                                {{ $errors->first('last_name') }}*</span>
                                        </label>
                                        @else
                                        <label for="last_name" class="text-sm font-semibold ">Last Name:
                                            <span class="text-red-500 text-xs" id="last-name-error">*</span>
                                        </label>
                                        @endif
                                        <input type="text" id="last_name" name="last_name" placeholder="Last Name"
                                            pattern="[A-Z]+"
                                            oninput="this.value = this.value.toUpperCase()"
                                            title="Only letters are allowed"
                                            value="{{ old('last_name') }}"
                                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300 uppercase ">
                                    </div>

                                    <!-- MIDDLE INITIAL -->
                                    <div class="col-span-6 md:col-span-1">

                                        @if ($errors->has('middle_initial'))
                                        <label for="middle_initial" class="text-sm font-semibold flex justify-between items-center w-full">M.I:
                                            <span class="text-red-500 text-xs" id="middle-initial-error">
                                                {{ $errors->first('middle_initial') }}*</span>
                                        </label>
                                        @else
                                        <label for="middle_initial" class="text-sm font-semibold ">M.I:
                                            <span class="text-red-500 text-xs" id="middle-initial-error">*</span>
                                        </label>
                                        @endif
                                        <input type="text" id="middle_initial" name="middle_initial" placeholder="M.I" maxlength="3"
                                            pattern="[A-Z]\."
                                            oninput="this.value = this.value.toUpperCase()"
                                            title="Only one letter followed by a period is allowed (e.g., M.)"
                                            value="{{ old('middle_initial') }}"
                                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300 uppercase ">
                                    </div>

                                    <!-- SUFFIX -->
                                    <div class="col-span-6 md:col-span-1">
                                        <label for="suffix" class="text-sm font-semibold">Suffix: </label>
                                        <input type="text" id="suffix" name="suffix" placeholder="E.g., Jr."
                                            pattern="[A-Za-z]{1,5}"
                                            maxlength="5"
                                            title="Only letters are allowed, max 5 characters (e.g., Jr, Sr, III)"
                                            value="{{ old('suffix') }}"
                                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                    </div>
                                </div>

                                <!-- date of birth, age , gender div  -->
                                <div class="col-span-12 grid grid-cols-6 gap-4 mt-2">
                                    <!-- date of birth  -->
                                    <div class="col-span-6 md:col-span-2 flex flex-col gap-1">
                                        @if ($errors->has('date_of_birth'))
                                        <label for="date_of_birth" class="text-sm font-semibold flex justify-between items-center w-full">Date of Birth:
                                            <span class="text-red-500 text-xs" id="date-of-birth-error">
                                                {{ $errors->first('date_of_birth') }}*</span>
                                        </label>
                                        @else
                                        <label for="date_of_birth" class="text-sm font-semibold ">Date of Birth:
                                            <span class="text-red-500 text-xs" id="date-of-birth-error">*</span>
                                        </label>
                                        @endif

                                        <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}"
                                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                    </div>
                                    <!-- age  -->
                                    <div class="col-span-6 md:col-span-1 flex flex-col gap-1">
                                        <label for="age" class=" text-sm font-bold text-gray-800">Age</label>
                                        <input type="number" name="age" placeholder="Age" id="age" value="{{ old('age') }}"
                                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300" readonly>
                                    </div>
                                    <!-- gender  -->
                                    <div class="col-span-6 md:col-span-3 flex flex-col gap-3">
                                        <label class=" text-sm font-bold text-gray-800">Gender <span class="text-red-500" id="gender-error">*</span></label>
                                        <div class="flex gap-5 items-center">
                                            <label class="flex items-center space-x-2">
                                                <input type="radio" name="gender" value="male"
                                                    class="text-sky-500 focus:ring-sky-500"
                                                    required {{ old('gender') == 'male' ? 'checked' : '' }}>
                                                <span>Male</span>
                                            </label>
                                            <label class="flex items-center space-x-2">
                                                <input type="radio" name="gender" value="female"
                                                    class="text-pink-500 focus:ring-pink-500"
                                                    {{ old('gender') == 'female' ? 'checked' : '' }}>
                                                <span>Female</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- email div and contact number  -->
                                <div class="col-span-12 grid grid-cols-4 gap-4 mt-2">
                                    <!-- email  -->
                                    <div class="col-span-4 md:col-span-2 flex flex-col items-center gap-2">
                                        <div class="w-full flex items-center">
                                            @if ($errors->has('email'))
                                            <label for="email" class="text-sm font-semibold flex justify-between items-center w-full">Personal Email:
                                                <span class="text-red-500 text-xs" id="email-error">
                                                    {{ $errors->first('email') }}*</span>
                                            </label>
                                            @else
                                            <label for="email" class="text-sm font-semibold ">Personal Email:
                                                <span class="text-red-500 text-xs" id="email-error">*</span>
                                            </label>
                                            @endif

                                        </div>
                                        <div class="w-full flex items-center gap-4">
                                            <i data-lucide="mail"></i>
                                            <input type="email" name="email" placeholder="example@gmail.com" value="{{ old('email') }}"
                                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                        </div>
                                    </div>

                                    <!-- phone number  -->
                                    <div class="col-span-4 md:col-span-2 flex flex-col items-center gap-2">
                                        <div class="w-full flex items-center">
                                            @if ($errors->has('contact_number'))
                                            <label for="contact_number" class="text-sm font-semibold flex justify-between items-center w-full">Phone Number:
                                                <span class="text-red-500 text-xs" id="contact-number-error">
                                                    {{ $errors->first('contact_number') }}*</span>
                                            </label>
                                            @else
                                            <label for="contact_number" class="text-sm font-semibold ">Phone Number:
                                                <span class="text-red-500 text-xs" id="contact-number-error">*</span>
                                            </label>
                                            @endif
                                        </div>

                                        <div class="w-full flex items-center gap-4">
                                            <i data-lucide="phone-call"></i>
                                            <input type="tel" id="contact_number" name="contact_number"
                                                placeholder="e.g. 09xx xxx xxxx"
                                                maxlength="13"
                                                value="{{ old('contact_number') }}"
                                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                        </div>
                                    </div>
                                </div>

                                <!-- divider border  -->
                                <div class="col-span-12 border-2 border-gray-100 mt-5"></div>

                                <!-- address label  -->
                                <div class="col-span-12 p-2 ">
                                    <label for="address" class="text-xl font-bold text-gray-800">Address</label>
                                </div>

                                <!-- region, province, city, barangay, purok div  -->
                                <div class="col-span-12 grid grid-cols-12 gap-2">
                                    <!-- region  -->
                                    <div class="col-span-12 md:col-span-4">
                                        <div class="mb-3 relative">
                                            <label for="region_btn" class="text-sm mb-2 font-semibold">Region <span class="text-red-500" id="region-error">*</span></label>
                                            <button id="region_btn" type="button"
                                                class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center">
                                                <span id="region_selected">Select Region</span>
                                                <i data-lucide="chevron-down"></i>
                                            </button>
                                            <ul id="region" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                            <!-- hidden input -->
                                            <input type="hidden" name="region" id="region_input">
                                        </div>
                                    </div>
                                    <!-- province  -->
                                    <div class="col-span-12 md:col-span-4">
                                        <div class="mb-3 relative">
                                            <label for="province_btn" class="text-sm mb-2 font-semibold">Province <span class="text-red-500" id="province-error">*</span></label>
                                            <button id="province_btn" type="button"
                                                class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                                <span id="province_selected">Select Province</span>
                                                <i data-lucide="chevron-down"></i>
                                            </button>
                                            <ul id="province" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                            <!-- hidden input -->
                                            <input type="hidden" name="province" id="province_input">
                                        </div>
                                    </div>
                                    <!-- city  -->
                                    <div class="col-span-12 md:col-span-4">
                                        <div class="mb-3 relative">
                                            <label for="city_btn" class="text-sm mb-2 font-semibold">City / Municipality <span class="text-red-500" id="city-error">*</span></label>
                                            <button id="city_btn" type="button"
                                                class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                                <span id="city_selected">Select City</span>
                                                <i data-lucide="chevron-down"></i>
                                            </button>
                                            <ul id="city" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                            <!-- hidden input -->
                                            <input type="hidden" name="city" id="city_input">
                                        </div>
                                    </div>
                                    <!-- barangay and purok  -->
                                    <div class="col-span-12 md:col-span-12">
                                        <div class="grid grid-cols-4 gap-4">
                                            <!-- barangay  -->
                                            <div class="col-span-4 md:col-span-2 mb-3 relative">
                                                <label for="barangay_btn" class="text-sm mb-2 font-semibold">Barangay <span class="text-red-500" id="barangay-error">*</span></label>
                                                <button id="barangay_btn" type="button"
                                                    class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                                    <span id="barangay_selected">Select Barangay</span>
                                                    <i data-lucide="chevron-down"></i>
                                                </button>
                                                <ul id="barangay" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                                <!-- hidden input -->
                                                <input type="hidden" name="barangay" id="barangay_input">
                                            </div>
                                            <!-- purok  -->
                                            <div class="col-span-4 md:col-span-2 ">
                                                <label for="description" class="text-sm mb-2 font-semibold">Purok / Bldng No. <span class="text-red-500" id="description-error">*</span></label>
                                                <input type="text" name="description" placeholder="e.g Purok-2" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- divider border  -->
                                    <div class="col-span-12 border-2 border-gray-100"></div>
                                </div>

                                <!-- submit and cancel button   -->
                                <div class="col-span-12 flex items-end justify-end gap-2 mt-5">
                                    <button type="submit" id="submitBtn" class="md:px-8 px-4 py-2 bg-sky-500 text-white rounded-lg text-md hover:bg-sky-400">
                                        Create Account
                                    </button>
                                    <button type="button" onclick="document.getElementById('newClinicUserModal').close()"
                                        class="px-6 py-2 bg-gray-100 text-gray-500 rounded-lg text-md hover:bg-gray-200">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </dialog>

                    <!-- update clinic user modal  -->
                    <dialog id="updateClinicUserModal"
                        x-data="{
                                    user: {
                                        id: '', account_id: '', default_password: '', role: '',
                                        first_name: '', last_name: '', middle_initial: '', suffix: '',
                                        phone: '', email: '', date_of_birth: '', address: '', gender: '', age: '' , is_disabled: ''
                                    },
                                    open() { this.$refs.modal.showModal() },
                                    close() { this.$refs.modal.close() }
                                }"
                        x-ref="modal"
                        @update-profile-modal.window="user = $event.detail; open()"
                        class="p-8 rounded-lg shadow-lg w-full max-w-5xl backdrop:bg-black/30 focus:outline-none">
                        <!-- Close button -->

                        <div class="w-full flex justify-end ">
                            <button @click="close()" class="focus:outline-none">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>
                        </div>

                        <form action="{{ route('clinic.users.update') }}" method="POST" id="updateProfileForm">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="id" x-model="user.id">

                            <div class="grid grid-cols-12 md:px-8 gap-2 flex flex-col items-center justify-center ">
                                <div class="col-span-12 flex items-center justify-center">
                                    <div class="flex items-center justify-center gap-4 ">
                                        <i data-lucide="circle-user" class="w-12 h-12 text-red-500"></i>
                                        <div>
                                            <h1 class="font-900 md:text-2xl text-xl text-red-500">Update User Profile</h1>
                                            <p>Manage your clinic account details</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- divider border  -->
                                <div class="col-span-12 border-2 border-gray-100 my-2"></div>
                                <div class="col-span-12">
                                    <h1 class="font-semibold text-xl">Account Details</h1>
                                </div>
                                <div class="col-span-12 flex gap-2 items-center px-2">
                                    <p class="text-md font-bold">Account ID:</p>
                                    <h1 x-text="user.account_id"></h1>
                                </div>
                                <div class="col-span-12 flex gap-2 items-center px-2">
                                    <p class="text-md font-bold">Role:</p>
                                    <h1 x-text="user.role" :class="{
                                        'bg-sky-200 text-sky-600 py-1 px-4 font-bold rounded': user.role === 'Admin',
                                        'bg-green-200 text-green-600 py-1 px-4 font-bold rounded': user.role === 'Nurse',
                                        'bg-red-200 text-red-600 py-1 px-4 font-bold rounded': user.role === 'Staff' 
                                        }"></h1>
                                </div>
                                <!-- divider border  -->
                                <div class="col-span-12 border-2 border-gray-100 my-2"></div>
                                <div class="col-span-12">
                                    <h1 class="font-semibold text-xl">Personal Information</h1>
                                </div>

                                <!-- fname. lname , initial div  -->
                                <div class="col-span-12 grid grid-cols-12 gap-2">
                                    <!-- FIRST NAME -->
                                    <div class="col-span-12 md:col-span-5">
                                        @if (session('update_errors') && session('update_errors')->has('update_first_name'))
                                        <label for="update_first_name" class="text-sm font-semibold flex justify-between items-center w-full">First Name:
                                            <span class="text-red-500 text-xs" id="update-first-name-error">
                                                {{ session('update_errors')->first('update_first_name') }}
                                                *</span>
                                        </label>
                                        @else
                                        <label for="update_first_name" class="text-sm font-semibold ">First Name:
                                        </label>
                                        @endif
                                        <input type="text" name="update_first_name"
                                            placeholder="First Name"
                                            :value="user.first_name"
                                            :class="user.is_disabled == 1 ? 'opacity-50 pointer-events-none' : ''"
                                            pattern="[A-Za-z]+( [A-Za-z]+)*"

                                            class="w-full p-2 border border-gray-300 rounded-lg bg-gray-50 focus:bg-white focus:outline-none focus:ring-1 focus:border-sky-300 uppercase">
                                    </div>

                                    <!-- LAST NAME -->
                                    <div class="col-span-12 md:col-span-5">
                                        @if (session('update_errors') && session('update_errors')->has('update_last_name'))
                                        <label for="update_last_name" class="text-sm font-semibold flex justify-between items-center w-full">Last Name:
                                            <span class="text-red-500 text-xs" id="update-last-name-error">
                                                {{ session('update_errors')->first('update_last_name') }}
                                                *</span>
                                        </label>
                                        @else
                                        <label for="update_last_name" class="text-sm font-semibold ">Last Name:
                                        </label>
                                        @endif

                                        <input type="text" name="update_last_name" placeholder="Last Name"
                                            :class="user.is_disabled == 1 ? 'opacity-50 pointer-events-none' : ''"
                                            pattern="[A-Za-z]+( [A-Za-z]+)*"

                                            class="w-full p-2 border border-gray-300 rounded-lg  bg-gray-50 focus:bg-white  focus:outline-none focus:ring-1 focus:border-sky-300 uppercase "
                                            :value="user.last_name">
                                    </div>

                                    <!-- MIDDLE INITIAL -->
                                    <div class="col-span-6 md:col-span-1">
                                        @if (session('update_errors') && session('update_errors')->has('update_middle_initial'))
                                        <label for="update_middle_initial" class="text-sm font-semibold flex justify-between items-center w-full">M.I:
                                            <span class="text-red-500 text-xs" id="update-middle-initial-error">
                                                {{ session('update_errors')->first('update_middle_initial') }}
                                                *</span>
                                        </label>
                                        @else
                                        <label for="update_middle_initial" class="text-sm font-semibold ">M.I:
                                        </label>
                                        @endif

                                        <input type="text" name="update_middle_initial" placeholder="M.I" maxlength="3"
                                            pattern="[A-Z]\."
                                            oninput="this.value = this.value.toUpperCase()"
                                            title="Only one letter followed by a period is allowed (e.g., M.)"
                                            :value="user.middle_initial"
                                            :class="user.is_disabled == 1 ? 'opacity-50 pointer-events-none' : ''"
                                            class="w-full p-2 border border-gray-300 bg-gray-50 focus:bg-white  rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300 uppercase ">
                                    </div>

                                    <!-- SUFFIX -->
                                    <div class="col-span-6 md:col-span-1">
                                        <label for="update_suffix" class="text-sm font-semibold">Suffix: </label>
                                        <input type="text" id="update_suffix" name="update_suffix" placeholder="E.g., Jr."
                                            pattern="[A-Za-z]{1,5}"
                                            maxlength="5"
                                            title="Only letters are allowed, max 5 characters (e.g., Jr, Sr, III)"
                                            :value="user.suffix"
                                            :disabled="user.is_disabled == 1"
                                            :class="user.is_disabled == 1 ? 'opacity-50 pointer-events-none' : ''"
                                            class="w-full p-2 border border-gray-300 bg-gray-50 focus:bg-white  rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                    </div>
                                </div>
                                <!-- date of birth, age , gender div  -->
                                <div class="col-span-12 grid grid-cols-6 gap-4 mt-2">
                                    <!-- date of birth  -->
                                    <div class="col-span-6 md:col-span-2 flex flex-col gap-1">
                                        @if (session('update_errors') && session('update_errors')->has('update_date_of_birth'))
                                        <label for="update_date_of_birth" class="text-sm font-semibold flex justify-between items-center w-full">Date of Birth:
                                            <span class="text-red-500 text-xs" id="update-date-of-birth-error">
                                                {{ session('update_errors')->first('update_date_of_birth') }}
                                                *</span>
                                        </label>
                                        @else
                                        <label for="update_date_of_birth" class="text-sm font-semibold ">Date of Birth
                                            <span class="text-red-500 text-xs" id="update-date-of-birth-error"></span>
                                        </label>
                                        @endif


                                        <input type="date" name="update_date_of_birth" id="update_date_of_birth" :value="user.date_of_birth" readonly disabled
                                            :class="user.is_disabled == 1 ? 'opacity-50 pointer-events-none' : ''"
                                            class="w-full p-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:border-sky-300">
                                    </div>
                                    <!-- age  -->
                                    <div class="col-span-6 md:col-span-1 flex flex-col gap-1">
                                        <label for="age" class=" text-sm font-bold text-gray-800">Age</label>
                                        <input type="number" name="update_age" placeholder="Age" id="update_age" :value="user.age"
                                            :class="user.is_disabled == 1 ? 'opacity-50 pointer-events-none' : ''"
                                            class="w-full p-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:border-sky-300" readonly disabled>
                                    </div>
                                    <!-- gender  -->
                                    <div class="col-span-6 md:col-span-3 flex flex-col gap-3">
                                        <label class=" text-sm font-bold text-gray-800">Gender <span class="text-red-500" id="gender-error"></span></label>
                                        <div class="flex gap-5 items-center">

                                            <label class="flex items-center space-x-2">
                                                <input type="radio" name="update_gender" checked disabled
                                                    :class="user.is_disabled == 1 ? 'opacity-50 pointer-events-none text-gray-400' : ''"
                                                    class="text-sky-500 focus:ring-sky-500">
                                                <span x-text="user.gender"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- email div and contact number  -->
                                <div class="col-span-12 grid grid-cols-4 gap-4 mt-2 ">
                                    <!-- email  -->
                                    <div class="col-span-4 md:col-span-2 flex flex-col items-center gap-2">
                                        <div class="w-full flex items-center">
                                            @if (session('update_errors') && session('update_errors')->has('update_email'))
                                            <label for="update_email" class="text-sm font-semibold flex justify-between items-center w-full">Personal Email:
                                                <span class="text-red-500 text-xs" id="update-email-error">
                                                    {{ session('update_errors')->first('update_email') }}
                                                    *</span>
                                            </label>
                                            @else
                                            <label for="update_email" class="text-sm font-semibold ">Personal Email:
                                                <span class="text-red-500 text-xs" id="update-email-error"></span>
                                            </label>
                                            @endif
                                        </div>
                                        <div class="w-full flex items-center gap-4">
                                            <i data-lucide="mail"></i>
                                            <input type="email" name="update_email" placeholder="example@gmail.com" :value="user.email" id="update-email"
                                                :class="user.is_disabled == 1 ? 'opacity-50 pointer-events-none' : ''"
                                                class="w-full p-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-1 focus:border-sky-300">
                                        </div>
                                    </div>

                                    <!-- phone number  -->
                                    <div class="col-span-4 md:col-span-2 flex flex-col items-center gap-2">
                                        <div class="w-full flex items-center">
                                            @if (session('update_errors') && session('update_errors')->has('update_contact_number'))
                                            <label for="update_contact_number" class="text-sm font-semibold flex justify-between items-center w-full">Phone Number:
                                                <span class="text-red-500 text-xs" id="update-contact-number-error">
                                                    {{ session('update_errors')->first('update_contact_number') }}
                                                    *</span>
                                            </label>
                                            @else
                                            <label for="update_contact_number" class="text-sm font-semibold ">Phone Number:
                                                <span class="text-red-500 text-xs" id="update-contact-number-error">*</span>
                                            </label>
                                            @endif

                                        </div>
                                        <div class="w-full flex items-center gap-4">
                                            <i data-lucide="phone-call"></i>
                                            <input type="tel" id="update-contact_number" name="update_contact_number"
                                                placeholder="e.g. 09xx xxx xxxx"
                                                maxlength="13"
                                                :value="user.phone"
                                                :class="user.is_disabled == 1 ? 'opacity-50 pointer-events-none' : ''"
                                                class="w-full p-2 border border-gray-300 rounded-lg  bg-gray-50 focus:outline-none focus:ring-1 focus:border-sky-300">
                                        </div>
                                    </div>
                                </div>
                                <!-- divider border  -->
                                <div class="col-span-12 border-2 border-gray-100"></div>
                                <!-- address label  -->
                                <div class="col-span-12 p-2 ">
                                    <label for="address" class="text-xl font-bold text-gray-800">Address</label>
                                </div>
                                <div class="col-span-12 flex items-center gap-2 p-2">
                                    <i data-lucide="map-pin"></i>
                                    <h1 x-text="user.address"></h1>
                                </div>
                                <!-- divider border  -->
                                <div class="col-span-12 border-2 border-gray-100 mt-5"></div>

                                <div class="col-span-12 mt-2 p-2">
                                    <p class="font-semibold">Update Address</p>
                                </div>
                                <!-- region, province, city, barangay, purok div  -->
                                <div class="col-span-12 grid grid-cols-12 gap-2">
                                    <!-- region  -->
                                    <div class="col-span-12 md:col-span-4">
                                        <div class="mb-3 relative">
                                            <label for="update-region_btn" class="text-sm mb-2 font-semibold">Region <span class="text-red-500" id="update-region-error"></span></label>
                                            <button id="update-region_btn" type="button"
                                                :disabled="user.is_disabled == 1"
                                                :class="user.is_disabled == 1 ? 'opacity-50 pointer-events-none' : ''"
                                                class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center">
                                                <span id="update-region_selected">Select Region</span>
                                                <i data-lucide="chevron-down"></i>
                                            </button>
                                            <ul id="update-region" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                            <!-- hidden input -->
                                            <input type="hidden" name="update_region" id="update_region_input">
                                        </div>
                                    </div>
                                    <!-- province  -->
                                    <div class="col-span-12 md:col-span-4">
                                        <div class="mb-3 relative">
                                            <label for="update-province_btn" class="text-sm mb-2 font-semibold">Province <span class="text-red-500" id="update-province-error"></span></label>
                                            <button id="update-province_btn" type="button"
                                                class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                                <span id="update-province_selected">Select Province</span>
                                                <i data-lucide="chevron-down"></i>
                                            </button>
                                            <ul id="update-province" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                            <!-- hidden input -->
                                            <input type="hidden" name="update_province" id="update_province_input">
                                        </div>
                                    </div>
                                    <!-- city  -->
                                    <div class="col-span-12 md:col-span-4">
                                        <div class="mb-3 relative">
                                            <label for="update-city_btn" class="text-sm mb-2 font-semibold">City / Municipality <span class="text-red-500" id="update-city-error"></span></label>
                                            <button id="update-city_btn" type="button"
                                                class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                                <span id="update-city_selected">Select City</span>
                                                <i data-lucide="chevron-down"></i>
                                            </button>
                                            <ul id="update-city" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                            <!-- hidden input -->
                                            <input type="hidden" name="update_city" id="update_city_input">
                                        </div>
                                    </div>
                                    <!-- barangay and purok  -->
                                    <div class="col-span-12 md:col-span-12">
                                        <div class="grid grid-cols-4 gap-4">
                                            <!-- barangay  -->
                                            <div class="col-span-4 md:col-span-2 mb-3 relative">
                                                <label for="update-barangay_btn" class="text-sm mb-2 font-semibold">Barangay <span class="text-red-500" id="update-barangay-error"></span></label>
                                                <button id="update-barangay_btn" type="button"
                                                    class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                                    <span id="update-barangay_selected">Select Barangay</span>
                                                    <i data-lucide="chevron-down"></i>
                                                </button>
                                                <ul id="update-barangay" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                                <!-- hidden input -->
                                                <input type="hidden" name="update_barangay" id="update_barangay_input">
                                            </div>
                                            <!-- purok  -->
                                            <div class="col-span-4 md:col-span-2 ">
                                                <label for="update-description"
                                                    :disabled="user.is_disabled == 1"
                                                    :class="user.is_disabled == 1 ? 'opacity-50 pointer-events-none' : ''"
                                                    class="text-sm mb-2 font-semibold">Purok / Bldng No. <span class="text-red-500" id="update-description-error"></span></label>
                                                <button id="update-description_btn" type="button" class="hidden"> </button>
                                                <input type="text" name="update_description" id="update-description" placeholder="e.g Purok-2" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- divider border  -->
                                    <div class="col-span-12 border-2 border-gray-100"></div>
                                </div>

                                @if($clinicUser->UserRole->role_name === 'Admin')
                                <!-- disable account section  -->
                                <div class="col-span-12"
                                    x-show="user.id != {{ $clinicUser->id }}">
                                    <div class="flex items-center w-full gap-2">
                                        <i data-lucide="info" class="text-red-500"></i>
                                        <h4 class="text-sm text-gray-700">
                                            Check the box below if you want to disable this account.
                                        </h4>
                                    </div>
                                    <div class="flex items-center space-x-2 px-5">
                                        <input type="checkbox" id="is_disabled" name="is_disabled"
                                            :value="1"
                                            class="mt-1 text-red-500 focus:ring-red-500 border-red-500 rounded w-4 h-4 cursor-pointer "
                                            x-bind:checked="user.is_disabled == 1">
                                        <div>
                                            <label for="is_disabled" class="text-sm text-red-500 font-bold cursor-pointer">Disable Account</label>
                                            <p class="text-sm text-red-500 italic">
                                                Please note: if this option is checked, the user will not be able to log in until re-enabled.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- submit and cancel button   -->
                                <div class="col-span-12 flex items-end justify-end gap-2 mt-5">
                                    <button type="submit" id="submitUpdateBtn" class="md:px-8 px-4 py-2 bg-sky-500 text-white rounded-lg text-md hover:bg-sky-400">
                                        Save Changes
                                    </button>

                                    <button type="button" @click="close"
                                        class="px-6 py-2 bg-gray-100 text-gray-500 rounded-lg text-md hover:bg-gray-200">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </dialog>

                    <!-- clinic user table component  -->
                    <livewire:clinic-users-table />
                </div>
            </div>
        </section>


        <!-- successfull modal  -->
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
        <x-logout-modal />

</body>


<!-- js code to auto open modal if there is error -->
@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('newClinicUserModal').showModal();
    });
</script>
@endif


<!-- js code to auto open update modal if there is error -->
@if (session('update_errors') && session('update_error_id'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const failedId = "{{ session('update_error_id') }}";
        const btn = document.querySelector(`button[data-update-profile][data-id='${failedId}']`);
        if (btn) {
            btn.click();
        }
    });
</script>
@endif


<script>
    const submitBtn = document.getElementById("submitBtn");
    document.getElementById('create_account_form').addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
            </svg>
            <span>Loading...</span>
        `;

    });
    
    const submitUpdateBtn = document.getElementById("submitUpdateBtn");
    document.getElementById('updateProfileForm').addEventListener('submit', function() {
        submitUpdateBtn.disabled = true;
        submitUpdateBtn.innerHTML = `
            <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
            </svg>
            <span>Loading...</span>
        `;

    });

    async function regenerateAccountId() {
        let response = await fetch("/clinic-users/generate-id");
        let data = await response.json();
        document.getElementById("account_id").value = data.generated_id;
        document.getElementById("default_password").value = data.default_password;
        document.getElementById("password").value = data.default_password;
    }

    document.addEventListener("DOMContentLoaded", function() {
        const date_of_birth = document.getElementById("date_of_birth");
        const age = document.getElementById("age");

        date_of_birth.addEventListener("change", function() {
            const birthdate = new Date(date_of_birth.value);
            const today = new Date();
            let calculatedAge = today.getFullYear() - birthdate.getFullYear();
            const monthDifference = today.getMonth() - birthdate.getMonth();

            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthdate.getDate())) {
                calculatedAge--;
            }

            age.value = calculatedAge;
        });
    });

    document.getElementById("contact_number").addEventListener("input", function(e) {
        let value = e.target.value.replace(/\D/g, ""); // remove all non-digits
        if (value.length > 4 && value.length <= 7) {
            value = value.replace(/(\d{4})(\d+)/, "$1 $2");
        } else if (value.length > 7) {
            value = value.replace(/(\d{4})(\d{3})(\d+)/, "$1 $2 $3");
        }
        e.target.value = value;
    });

    // error handling for create modal
    document.addEventListener("DOMContentLoaded", function() {
        let fields = [{
                name: "region",
                label: "region-error",
                btn: "region_btn"
            },
            {
                name: "province",
                label: "province-error",
                btn: "province_btn"
            },
            {
                name: "city",
                label: "city-error",
                btn: "city_btn"
            },
            {
                name: "barangay",
                label: "barangay-error",
                btn: "barangay_btn"
            },
            {
                name: "description",
                label: "description-error"
            },
            {
                name: "account_id",
                label: "account-id-error"
            },
            {
                name: "default_password",
                label: "default-password-error"
            },
            {
                name: "first_name",
                label: "first-name-error"
            },
            {
                name: "last_name",
                label: "last-name-error"
            },
            {
                name: "middle_initial",
                label: "middle_initial-error"
            },
            {
                name: "date_of_birth",
                label: "date-of-birth-error"
            },
            {
                name: "email",
                label: "email-error"
            },
            {
                name: "contact_number",
                label: "contact-number-error"
            }
        ];

        function markInvalid(input, label, btn) {
            if (label) label.style.color = "red";
            if (input) input.classList.add("border-red-500");
            if (btn) btn.classList.add("border-red-500");
        }

        function clearInvalid(input, label, btn) {
            if (label) label.style.color = "";
            if (input) input.classList.remove("border-red-500");
            if (btn) btn.classList.remove("border-red-500");
        }

        // Run validation on submit
        document.getElementById("create_account_form").addEventListener("submit", function(e) {
            let isValid = true;

            fields.forEach(function(f) {
                let input = document.querySelector(`[name="${f.name}"]`);
                let label = document.getElementById(f.label);
                let btn = f.btn ? document.getElementById(f.btn) : null;

                if (input) {
                    clearInvalid(input, label, btn); // reset first

                    // If required field is empty, block submission
                    if (input.value.trim() === "") {
                        isValid = false;
                        markInvalid(input, label, btn);
                    }
                }
            });

            if (!isValid) {
                e.preventDefault(); // 🚫 stops submission
                e.stopPropagation();
            }
        });

        // Real-time validation
        fields.forEach(function(f) {
            let input = document.querySelector(`[name="${f.name}"]`);
            let label = document.getElementById(f.label);
            let btn = f.btn ? document.getElementById(f.btn) : null;

            if (input) {
                let checkAndClear = function() {
                    if (input.value.trim() !== "") {
                        clearInvalid(input, label, btn);
                    }
                };

                input.addEventListener("input", checkAndClear);
                input.addEventListener("blur", checkAndClear);

                // For hidden fields updated by JS (like region/province)
                let observer = new MutationObserver(checkAndClear);
                observer.observe(input, {
                    attributes: true,
                    attributeFilter: ["value"]
                });
            }
        });
    });

    // error handling for update modal
    document.addEventListener("DOMContentLoaded", function() {
        let fields = [{
                name: "update_region",
                label: "update-region-error",
                btn: "update-region_btn"
            },
            {
                name: "update_province",
                label: "update-province-error",
                btn: "update-province_btn"
            },
            {
                name: "update_city",
                label: "update-city-error",
                btn: "update-city_btn"
            },
            {
                name: "update_barangay",
                label: "update-barangay-error",
                btn: "update-barangay_btn"
            },
            {
                name: "update_description",
                label: "update-description-error",
                btn: "update-description_btn"
            },
            {
                name: "update_first_name",
                label: "update-first-name-error"
            },
            {
                name: "update_last_name",
                label: "update-last-name-error"
            },
            {
                name: "update_middle_name",
                label: "update-middle-name-error"
            },
            {
                name: "update-email",
                label: "update-email-error"
            },
            {
                name: "update_contact_number",
                label: "update-contact-number-error"
            }
        ];

        function markInvalid(input, label, btn) {
            if (label) label.style.color = "red";
            if (input) input.classList.add("border-red-500");
            if (btn) btn.classList.add("border-red-500");
        }

        function clearInvalid(input, label, btn) {
            if (label) label.style.color = "";
            if (input) input.classList.remove("border-red-500");
            if (btn) btn.classList.remove("border-red-500");
        }

        document.getElementById("updateProfileForm").addEventListener("submit", function(e) {
            let isValid = true;

            // Handle btn fields first
            let btnFields = fields.filter(f => f.btn);
            let anyBtnHasValue = btnFields.some(f => {
                let input = document.querySelector(`[name="${f.name}"]`);
                return input && input.value.trim() !== "";
            });

            btnFields.forEach(f => {
                let input = document.querySelector(`[name="${f.name}"]`);
                let label = document.getElementById(f.label);
                let btn = document.getElementById(f.btn);

                if (anyBtnHasValue && input && input.value.trim() === "") {
                    markInvalid(input, label, btn);
                    isValid = false;
                } else {
                    clearInvalid(input, label, btn);
                }
            });

            // Handle fields without btn
            fields.filter(f => !f.btn).forEach(f => {
                let input = document.querySelector(`[name="${f.name}"]`);
                let label = document.getElementById(f.label);
                if (input && input.value.trim() === "") {
                    markInvalid(input, label, null);
                    isValid = false;
                } else {
                    clearInvalid(input, label, null);
                }
            });

            if (!isValid) e.preventDefault();
        });
    });
</script>

</html>