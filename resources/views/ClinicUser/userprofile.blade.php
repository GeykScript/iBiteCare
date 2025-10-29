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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/chart.js', 'resources/js/address.js','resources/js/datetime.js', 'resources/js/alpine.js'])

    @endif
</head>



<body>
    <div class="flex h-screen">

        <!-- Sidebar -->
        <div id="sidebar"
            class="side-bar w-56 fixed inset-y-0 bg-white text-black flex flex-col border-r border-gray-300 h-screen z-50 transform -translate-x-full md:translate-x-0 ">
            <div class="absolute top-20 right-[-0.6rem] hidden md:hidden">
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

                    @if (session('profile-success'))
                    <div
                        x-data="{ show: true }"
                        x-show="show"
                        class="md:w-1/2 w-full bg-green-100 border-2 rounded border-green-200 flex justify-between">
                        <h1 class="p-4 text-md font-bold text-green-600">{{ session('profile-success') }}</h1>
                        <button @click="show = false" class="py-2 px-4 text-lg font-bold text-green-600">
                            <i data-lucide="x"></i>
                        </button>
                    </div>
                    @endif

                    <!-- card area  -->
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
                                <h1 class="md:text-xl text-md font-bold"> {{ preg_replace('/(\d{4})(\d{3})(\d{4})/', '$1 $2 $3', $clinicUser->info->contact_number) }}
                                </h1>
                                <p></p>

                                <p class="md:text-sm text-xs  text-gray-600">Phone Number</p>
                            </div>
                        </div>
                        <div class="flex grid grid-cols-12 ">
                            <div class="col-span-1 flex items-center justify-center">
                                <i class="md:w-8 md:h-8 stroke-[#FF000C]" data-lucide="id-card"></i>
                            </div>
                            <div class="col-span-11  px-3 md:px-5  py-1">
                                <h1 class="md:text-xl text-md font-bold">{{$clinicUser->account_id}} </h1>
                                <p class="md:text-sm text-xs  text-gray-600">Account ID</p>
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
                            <button
                                onclick="document.getElementById('user-profile-info').showModal()"
                                class="flex gap-1  text-xs items-center text-sky-500 font-900">More Details <i data-lucide="info" class="w-5 h-5 fill-sky-500 stroke-white"></i></button>
                        </div>
                    </div>

                    <!-- update user profile modal -->
                    <dialog id="user-profile-info" class="p-8 rounded-lg shadow-lg w-full max-w-5xl backdrop:bg-black/30 focus:outline-none ">
                        <!-- close modal button  -->
                        <div class="w-full flex justify-end mb-5 md:mb-2">
                            <button onclick="document.getElementById('user-profile-info').close()" class="focus:outline-none"><i data-lucide="x" class="w-5 h-5"></i></button>
                        </div>
                        <!-- update  user profile info  form  -->
                        <form action="{{ route('clinic.user-profile.update') }}" method="POST" id="update-user-profile-info">
                            @csrf
                            @method('PUT')

                            <input type="text" name="id" value="{{ $clinicUser->id }}" hidden>

                            <div class="grid grid-cols-12 md:px-8 gap-2 flex flex-col items-center justify-center">
                                <div class="col-span-12 flex items-center justify-center">
                                    <div class="flex items-center justify-center gap-4 ">
                                        <i data-lucide="circle-user" class="w-12 h-12 text-sky-500"></i>
                                        <div>
                                            <h1 class="font-900 md:text-2xl text-xl">Clinic User Profile</h1>
                                            <p>Manage your clinic account details</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 px-4 flex gap-2 items-center px-2 mt-5">
                                    <p class="text-md font-semibold">Account ID:</p>
                                    <h1 class="text-md font-medium text-gray-700">{{ $clinicUser->account_id }}</h1>
                                </div>
                                <div class="col-span-12 px-4 flex items-center gap-3">
                                    <h1 class="font-semibold text-md">Clinic Role: </h1>
                                    <div class="py-2 px-6 rounded 
                                            @if ($clinicUser->UserRole->role_name === 'Admin') bg-sky-200 
                                            @elseif ($clinicUser->UserRole->role_name === 'Doctor') bg-green-200 
                                            @elseif ($clinicUser->UserRole->role_name === 'Nurse') bg-red-200 
                                             @endif">

                                        <p class="font-bold 
                                                @if ($clinicUser->UserRole->role_name === 'Admin') text-sky-700 font-900
                                                @elseif ($clinicUser->UserRole->role_name === 'Doctor') text-green-700 font-900
                                                @elseif ($clinicUser->UserRole->role_name === 'Nurse') text-red-700 font-900
                                                @endif">
                                            {{ $clinicUser->UserRole->role_name }}
                                        </p>
                                    </div>

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
                                        @if ($errors->has('first_name'))
                                        <label for="first_name" class="text-sm font-semibold flex justify-between items-center w-full">First Name:
                                            <span class="text-red-500 text-xs" id="first-name-error">
                                                {{ $errors->first('first_name') }}
                                                *</span>
                                        </label>
                                        @else
                                        <label for="first_name" class="text-sm font-semibold ">First Name:
                                            <span class="text-red-500 text-xs" id="first-name-error">*</span>
                                        </label>
                                        @endif
                                        <input type="text" id="first_name" name="first_name"
                                            placeholder="First Name"
                                            value="{{ ( $clinicUser->first_name) }}"
                                            autocomplete="given-name"
                                            class="w-full p-2 border border-gray-300 rounded-lg bg-gray-50 focus:bg-white focus:outline-none focus:ring-1 focus:border-sky-300 uppercase">
                                    </div>

                                    <!-- LAST NAME -->
                                    <div class="col-span-12 md:col-span-5">
                                        @if ($errors->has('last_name'))
                                        <label for="last_name" class="text-sm font-semibold flex justify-between items-center w-full">Last Name:
                                            <span class="text-red-500 text-xs" id="last-name-error">
                                                {{ $errors->first('last_name') }}
                                                *</span>
                                        </label>
                                        @else
                                        <label for="last_name" class="text-sm font-semibold ">Last Name:
                                            <span class="text-red-500 text-xs" id="last-name-error">*</span>
                                        </label>
                                        @endif

                                        <input type="text" id="last_name" name="last_name" placeholder="Last Name"
                                            value="{{ ( $clinicUser->last_name) }}"
                                            class="w-full p-2 border border-gray-300 rounded-lg  bg-gray-50 focus:bg-white  focus:outline-none focus:ring-1 focus:border-sky-300 uppercase ">
                                    </div>

                                    <!-- MIDDLE INITIAL -->
                                    <div class="col-span-6 md:col-span-1">
                                        @if ($errors->has('middle_initial'))
                                        <label for="middle_initial" class="text-sm font-semibold flex justify-between items-center w-full">M.I:
                                            <span class="text-red-500 text-xs" id="middle-initial-error">
                                                {{ $errors->first('middle_initial') }}
                                                *</span>
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
                                            value="{{ old('middle_initial', $clinicUser->middle_initial) }}"
                                            class="w-full p-2 border border-gray-300 bg-gray-50 focus:bg-white  rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300 uppercase ">
                                    </div>

                                    <!-- SUFFIX -->
                                    <div class="col-span-6 md:col-span-1">
                                        <label for="suffix" class="text-sm font-semibold">Suffix: </label>
                                        <input type="text" id="suffix" name="suffix" placeholder="E.g., Jr."
                                            pattern="[A-Za-z]{1,5}"
                                            maxlength="5"
                                            title="Only letters are allowed, max 5 characters (e.g., Jr, Sr, III)"
                                            value="{{ old('suffix', $clinicUser->suffix) }}"
                                            class="w-full p-2 border border-gray-300 bg-gray-50 focus:bg-white  rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                    </div>
                                </div>


                                <!-- date of birth, age , gender div  -->
                                <div class="col-span-12 grid grid-cols-6 gap-4 mt-2">
                                    <!-- date of birth  -->
                                    <div class="col-span-6 md:col-span-2 flex flex-col gap-1">
                                        @if ($errors->has('date_of_birth'))
                                        <label for="date_of_birth" class="text-sm font-semibold flex justify-between items-center w-full">Date of Birth:
                                            <span class="text-red-500 text-xs" id="date-of-birth-error">
                                                {{ $errors->first('date_of_birth') }}
                                                *</span>
                                        </label>
                                        @else
                                        <label for="date_of_birth" class="text-sm font-semibold ">Date of Birth:
                                            <span class="text-red-500 text-xs" id="date-of-birth-error">*</span>
                                        </label>
                                        @endif
                                        <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $clinicUser->info->birthdate) }}" readonly disabled
                                            class="w-full p-2 border border-gray-300 bg-gray-50 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                    </div>
                                    <!-- age  -->
                                    <div class="col-span-6 md:col-span-1 flex flex-col gap-1">
                                        <label for="age" class=" text-sm font-bold text-gray-800">Age</label>
                                        <input type="number" name="age" placeholder="Age" id="age" value="{{ old('age', $clinicUser->info->age) }}"
                                            class="w-full p-2 border border-gray-300 bg-gray-50 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300" readonly disabled>
                                    </div>
                                    <!-- gender  -->
                                    <div class="col-span-6 md:col-span-3 flex flex-col gap-3">
                                        <p class=" text-sm font-bold text-gray-800">Gender <span class="text-red-500" id="gender-error">*</span></p>
                                        <div class="flex gap-5 items-center">
                                            @if ($clinicUser->info->gender == 'Male')
                                            <label class="flex items-center space-x-2">
                                                <input type="radio" name="gender" id="gender-male" value="male" checked disabled class="text-sky-500 focus:ring-sky-500">
                                                <span>Male</span>
                                            </label>
                                            @elseif ($clinicUser->info->gender == 'Female')
                                            <label class="flex items-center space-x-2">
                                                <input type="radio" name="gender" id="gender-female" value="female" checked disabled class="text-pink-500 focus:ring-pink-500">
                                                <span>Female</span>
                                            </label>
                                            @endif

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
                                                    {{ $errors->first('email') }}
                                                    *</span>
                                            </label>
                                            @else
                                            <label for="email" class="text-sm font-semibold ">Personal Email:
                                                <span class="text-red-500 text-xs" id="email-error">*</span>
                                            </label>
                                            @endif

                                        </div>
                                        <div class="w-full flex items-center gap-4">
                                            <i data-lucide="mail"></i>
                                            <input type="email" name="email" id="email" placeholder="example@gmail.com" value="{{ old('email', $clinicUser->email) }}" autocomplete="email"
                                                class="w-full p-2 border border-gray-300 bg-gray-50 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                        </div>
                                    </div>

                                    <!-- phone number  -->
                                    <div class="col-span-4 md:col-span-2 flex flex-col items-center gap-2">
                                        <div class="w-full flex items-center">
                                            @if ($errors->has('contact_number'))
                                            <label for="contact_number" class="text-sm font-semibold flex justify-between items-center w-full">Contact Number:
                                                <span class="text-red-500 text-xs" id="contact-number-error">
                                                    {{ $errors->first('contact_number') }}
                                                    *</span>
                                            </label>
                                            @else
                                            <label for="contact_number" class="text-sm font-semibold ">Contact Number:
                                                <span class="text-red-500 text-xs" id="contact-number-error">*</span>
                                            </label>
                                            @endif

                                        </div>
                                        <div class="w-full flex items-center gap-4">
                                            <i data-lucide="phone-call"></i>
                                            <input type="tel" id="contact_number" name="contact_number"
                                                placeholder="e.g. 09xx xxx xxxx"
                                                maxlength="13"
                                                value="{{  $clinicUser->info->contact_number }}"
                                                class="w-full p-2 border border-gray-300 bg-gray-50 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                        </div>
                                    </div>
                                </div>
                                <!-- divider border  -->
                                <div class="col-span-12 border-2 border-gray-100 mt-5"></div>

                                <!-- address label  -->
                                <div class="col-span-12 p-2 ">
                                    <p class="text-xl font-bold text-gray-800">Address</p>
                                </div>

                                <div class="col-span-12 flex items-center gap-2 p-2">
                                    <i data-lucide="map-pin"></i>
                                    <div>{{ $clinicUser->info->address }} (Current)</div>
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
                                                <button id="description_btn" type="button" class="hidden"> </button>
                                                <input type="text" name="description" id="description" placeholder="e.g Purok-2" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- divider border  -->
                                    <div class="col-span-12 border-2 border-gray-100"></div>
                                </div>

                                <!-- submit and cancel button   -->
                                <div class="col-span-12 flex items-end justify-end gap-2 mt-5">
                                    <button type="submit" class="md:px-8 px-4 py-2 bg-sky-500 text-white rounded-lg text-md hover:bg-sky-400">
                                        Save Changes
                                    </button>
                                    <button type="button" onclick="document.getElementById('user-profile-info').close()"
                                        class="px-6 py-2 bg-gray-100 text-gray-500 rounded-lg text-md hover:bg-gray-200">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </dialog>

                    <!-- update password card -->
                    <div class="md:w-1/2 w-full p-4">
                        <h1 class="text-xl font-900 text-[#FF000C]">Update Password</h1>
                        <p class="text-sm text-gray-600">
                            Ensure your account is using a long, random password to stay secure.
                        </p>
                    </div>

                    @if (session('status') === 'password-updated')
                    <div
                        x-data="{ show: true }"
                        x-show="show"
                        class="md:w-1/2 w-full bg-green-100 border-2 rounded border-green-200 flex justify-between">
                        <h1 class="p-4 text-md font-bold text-green-600">{{ __('Your password has been updated successfully.') }}</h1>
                        <button @click="show = false" class="py-2 px-4 text-lg font-bold text-green-600">
                            <i data-lucide="x"></i>
                        </button>
                    </div>
                    @endif
                    <div class="flex flex-col md:px-20 md:py-8 p-4 md:w-1/2 w-full bg-white border border-gray-200 shadow-lg rounded-lg">
                        @include('ClinicUser.profile.update-password-form')
                    </div>
                </div>
            </div>
        </section>

        <!-- Modals For Logout -->
        <x-logout-modal />

</body>

<!-- js code to auto open modal if there is error -->
@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('user-profile-info').showModal();
    });
</script>
@endif


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

    function formatContactNumber(input) {
        let value = input.value.replace(/\D/g, ""); // remove non-digits

        if (value.length > 4 && value.length <= 7) {
            value = value.replace(/(\d{4})(\d+)/, "$1 $2");
        } else if (value.length > 7) {
            value = value.replace(/(\d{4})(\d{3})(\d+)/, "$1 $2 $3");
        }

        input.value = value;
    }

    const contactInput = document.getElementById("contact_number");

    // Format while typing
    contactInput.addEventListener("input", function(e) {
        formatContactNumber(e.target);
    });

    // Format immediately on page load if value exists
    window.addEventListener("DOMContentLoaded", function() {
        if (contactInput.value) {
            formatContactNumber(contactInput);
        }
    });
    //error handling js
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
                label: "description-error",
                btn: "description_btn"
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
                label: "middle-initial-error"
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

        document.getElementById("update-user-profile-info").addEventListener("submit", function(e) {
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