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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/chart.js','resources/js/datetime.js', 'resources/js/address.js', 'resources/js/alpine.js'])
    @endif
</head>

<body>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="side-bar w-56 fixed inset-y-0 bg-white text-black flex flex-col border-r border-gray-300 h-screen z-50 hidden " id="sidebar">
            <div class="absolute top-20 right-[-0.6rem]  md:hidden">
                <button id="closeSidebar" class="text-white text-2xl">
                    <i data-lucide="circle-chevron-right" class="w-8 h-8 stroke-white fill-[#FF000D]"></i>
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
                    <li><a href="{{ route('clinic.patients') }}" class="block px-4 py-2 rounded bg-gray-900 text-white flex items-center gap-3"><i data-lucide="users" class="w-5 h-5"></i>Patients</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="notebook-pen" class="w-5 h-5"></i>Appointments</a></li>
                    <li><a href="#" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="message-square-text" class="w-5 h-5"></i>Messages</a></li>

                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">Clinic Management</p>
                    <li><a href="{{ route('clinic.supplies') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="package" class="w-5 h-5"></i>Inventory</a></li>
                    <li><a href="{{ route('clinic.transactions') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-text" class="w-5 h-5"></i>Transactions</a></li>
                    <li><a href="{{ route('clinic.payments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="philippine-peso" class="w-5 h-5"></i>Payments </a></li>
                    <li><a href="{{ route('clinic.services') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="briefcase-medical" class="w-5 h-5"></i>Services</a></li>
                    <li><a href="{{ route('clinic.reports')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="chart-column-big" class="w-5 h-5"></i>Reports</a></li>

                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">User Management</p>
                    <li><a href="{{route('clinic.user-accounts')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-user" class="w-5 h-5"></i>Accounts</a></li>
                    <li><a href="{{route('clinic.user-logs')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="logs" class="w-5 h-5"></i>Logs</a></li>
                </ul>
            </nav>
            <div class="flex flex-col p-4 gap-2">
                <a href="{{ route('clinic.profile') }}" class="flex flex-row items-center justify-between text-center w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-500">
                    <i data-lucide="circle-user" class="w-8 h-8"></i>
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
                        <h1 class="text-xl md:text-3xl font-900">Patient Registration</h1>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('clinic.patients') }}" class="font-bold hover:text-red-500 hover:underline underline-offset-4">Patient</a>
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            <p class="font-bold text-red-500">Registry</p>
                        </div>

                    </div>
                </div>

                <div class="grid grid-cols-12">
                    <div class="col-span-3 md:col-span-1 flex items-center justify-center">
                    </div>
                </div>

                <!-- Main Content -->
                <div class="grid grid-cols-4 py-4  md:px-10 gap-2 ">
                    <div class="col-span-4 bg-white rounded-lg shadow-lg w-full p-8  border border-gray-100">
                        <div>
                            <a href="{{ route('clinic.patients') }}" class="text-blue-500 hover:underline flex items-center underline-offset-4 font-bold"><i data-lucide="chevron-left" class="w-5 h-5"></i>Back</a>
                            <div class="flex flex-col mb-6 gap-2">
                                <h1 class="text-2xl font-900 text-center ">New Patient Registration</h1>
                                <p class="text-gray-400 text-sm text-center">Service: Anti-Tetanus</p>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mb-8">
                            <div class="flex items-center justify-between ">

                                <!-- Step 1 -->
                                <div class="flex flex-col items-center ">
                                    <div id="step1-circle"
                                        class="w-8 h-8 flex items-center justify-center rounded-full border-2 border-red-600 bg-red-600 text-white">
                                    </div>
                                    <span class="mt-2 text-sm font-bold text-gray-900 text-center">Personal Details</span>
                                </div>

                                <!-- Line between step 1 & 2 -->
                                <div class=" bg-red-300 mx-2 border-2 h-1 w-full border-red-300" id="line1"></div>

                                <!-- Step 2 -->
                                <div class="flex flex-col items-center ">
                                    <div id="step2-circle"
                                        class="w-8 h-8 flex items-center justify-center rounded-full border-2 border-red-300 bg-red-200 text-red-600">
                                    </div>
                                    <span class="mt-2 text-sm font-bold text-red-400 text-center">History Exposure</span>
                                </div>

                                <!-- Line between step 2 & 3 -->
                                <div class=" bg-red-300 mx-2 border-2 h-1 w-full border-red-300" id="line2"></div>

                                <!-- Step 3 -->
                                <div class="flex flex-col items-center ">
                                    <div id="step3-circle"
                                        class="w-8 h-8 flex items-center justify-center rounded-full border-2 border-red-300 bg-red-200 text-red-600">
                                    </div>
                                    <span class="mt-2 text-sm font-bold text-red-400 text-center">Animal Profile</span>
                                </div>
                                <div class=" bg-red-300 mx-2 border-2 h-1 w-full border-red-300" id="line3"></div>

                                <div class="flex flex-col items-center ">
                                    <div id="step4-circle"
                                        class="w-8 h-8 flex items-center justify-center rounded-full border-2 border-red-300 bg-red-200 text-red-600">
                                    </div>
                                    <span class="mt-2 text-sm font-bold text-red-400 text-center">Past Immunizations</span>
                                </div>
                                <div class=" bg-red-300 mx-2 border-2 h-1 w-full border-red-300" id="line4"></div>
                                <div class="flex flex-col items-center ">
                                    <div id="step5-circle"
                                        class="w-8 h-8 flex items-center justify-center rounded-full border-2 border-red-300 bg-red-200 text-red-600">
                                    </div>
                                    <span class="mt-2 text-sm font-bold text-red-400">Immunization</span>
                                </div>
                                <div class=" bg-red-300 mx-2 border-2 h-1 w-full border-red-300" id="line5"></div>

                                <div class="flex flex-col items-center ">
                                    <div id="step6-circle"
                                        class="w-8 h-8 flex items-center justify-center rounded-full border-2 border-red-300 bg-red-200 text-red-600">
                                    </div>
                                    <span class="mt-2 text-sm font-bold text-red-400">Payment</span>
                                </div>
                                <div class=" bg-red-300 mx-2 border-2 h-1 w-full border-red-300" id="line6"></div>

                                <div class="flex flex-col items-center ">
                                    <div id="step7-circle"
                                        class="w-8 h-8 flex items-center justify-center rounded-full border-2 border-red-300 bg-red-200 text-red-600">
                                    </div>
                                    <span class="mt-2 text-sm font-bold text-red-400">Finalizing</span>
                                </div>
                            </div>
                        </div>
                        <!-- Form Steps -->
                        <form id="multi-step-form">
                            <!-- Step 1: Personal Information -->
                            <div id="step-1" class="step">
                                <div class="mb-6">
                                    <label for="fullName" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
                                    <input type="text" id="fullName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5" required>
                                </div>
                                <div class="mb-6">
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Address</label>
                                    <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5" required>
                                </div>
                                <div class="mb-6">
                                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone Number</label>
                                    <input type="tel" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5" required>
                                </div>
                            </div>

                            <!-- Step 2: Account Details -->
                            <div id="step-2" class="step hidden">
                                <div class="mb-6">
                                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                                    <input type="text" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5" required>
                                </div>
                                <div class="mb-6">
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                                    <input type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5" required>
                                </div>
                                <div class="mb-6">
                                    <label for="confirmPassword" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                                    <input type="password" id="confirmPassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5" required>
                                </div>
                            </div>

                            <!-- Step 3: Preferences -->
                            <div id="step-3" class="step hidden">
                                <div class="mb-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900">Preferred Contact Method</label>
                                    <div class="flex items-center mb-4">
                                        <input id="contact-email" type="radio" name="contact" value="email" class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-300 focus:ring-sky-500 focus:ring-2">
                                        <label for="contact-email" class="ml-2 text-sm font-medium text-gray-900">Email</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="contact-phone" type="radio" name="contact" value="phone" class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-300 focus:ring-sky-500 focus:ring-2">
                                        <label for="contact-phone" class="ml-2 text-sm font-medium text-gray-900">Phone</label>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label for="interests" class="block mb-2 text-sm font-medium text-gray-900">Interests (select all that apply)</label>
                                    <select id="interests" multiple class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5">
                                        <option value="technology">Technology</option>
                                        <option value="finance">Finance</option>
                                        <option value="health">Health & Wellness</option>
                                        <option value="travel">Travel</option>
                                        <option value="food">Food & Cooking</option>
                                    </select>
                                </div>
                                <div class="flex items-center mb-6">
                                    <input id="newsletter" type="checkbox" class="w-4 h-4 text-sky-600 bg-gray-100 border-gray-300 rounded focus:ring-sky-500">
                                    <label for="newsletter" class="ml-2 text-sm font-medium text-gray-900">Subscribe to newsletter</label>
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="flex justify-end mt-8 gap-4">
                                <button type="button" id="prevBtn" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200  focus:outline-none focus:shadow-outline hidden">Previous</button>
                                <button type="button" id="nextBtn" class="px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 focus:outline-none focus:shadow-outline">Next</button>
                                <button type="submit" id="submitBtn" class="px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 focus:outline-none focus:shadow-outline hidden">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>




        </section>

        <!-- Modals For Logout -->
        <x-logout-modal />
</body>

<script>
    let currentStep = 1;
    const totalSteps = 7;

    const form = document.getElementById("multi-step-form");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const submitBtn = document.getElementById("submitBtn");

    function showStep(step) {
        // Hide all steps
        document.querySelectorAll(".step").forEach(s => s.classList.add("hidden"));
        document.getElementById(`step-${step}`).classList.remove("hidden");

        // Update step circles + labels
        for (let i = 1; i <= totalSteps; i++) {
            const circle = document.getElementById(`step${i}-circle`);
            const label = circle.parentElement.querySelector("span");

            if (i < step) {
                // Completed step
                circle.className = "w-8 h-8 flex items-center justify-center rounded-full border-2 border-red-600 bg-red-600 text-white";
                label.className = "mt-2 text-sm font-bold text-gray-900 text-center";
            } else if (i === step) {
                // Active step
                circle.className = "w-8 h-8 flex items-center justify-center rounded-full border-2 border-red-600 bg-red-600 text-white";
                label.className = "mt-2 text-sm font-bold text-gray-900 text-center";
            } else {
                // Inactive step
                circle.className = "w-8 h-8 flex items-center justify-center rounded-full border-2 border-red-300 bg-red-200 text-red-600";
                label.className = "mt-2 text-sm font-bold text-red-400 text-center";
            }
        }

        // Update connecting lines
        for (let i = 1; i < totalSteps; i++) {
            const line = document.getElementById(`line${i}`);
            if (i < step) {
                line.className = "bg-red-600 mx-2 border-2 h-1 w-full border-red-600";
            } else {
                line.className = "bg-red-300 mx-2 border-2 h-1 w-full border-red-300";
            }
        }

        // Toggle buttons
        prevBtn.classList.toggle("hidden", step === 1);
        nextBtn.classList.toggle("hidden", step === totalSteps);
        submitBtn.classList.toggle("hidden", step !== totalSteps);
    }

    function validateStep(step) {
        const currentStepElement = document.getElementById(`step-${step}`);
        const inputs = currentStepElement.querySelectorAll("input[required], select[required]");
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value) {
                isValid = false;
                input.classList.add("border-red-500");
            } else {
                input.classList.remove("border-red-500");
            }
        });

        return isValid;
    }

    nextBtn.addEventListener("click", () => {
        if (validateStep(currentStep)) {
            currentStep++;
            showStep(currentStep);
        }
    });

    prevBtn.addEventListener("click", () => {
        currentStep--;
        showStep(currentStep);
    });

    form.addEventListener("submit", (e) => {
        e.preventDefault();
        if (validateStep(currentStep)) {
            alert("Form submitted successfully!");
            // Here you’d typically send form data via AJAX or submit
        }
    });

    // Initialize wizard
    showStep(currentStep);
</script>



</html>