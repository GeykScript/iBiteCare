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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/chart.js','resources/js/datetime.js', 'resources/js/alpine.js'])
    @endif
</head>

<body>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div id="sidebar"
            class="side-bar w-56 fixed inset-y-0 bg-white text-black flex flex-col border-r border-gray-300 h-screen z-50 transform -translate-x-full md:translate-x-0 ">
            <div class="absolute top-20 right-[-0.6rem] hidden md:hidden">
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
                    <li><a href="{{ route('clinic.appointments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="notebook-pen" class="w-5 h-5"></i>Appointments</a></li>
                    <li><a href="{{ route('clinic.messages') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="message-square-text" class="w-5 h-5"></i>Messages</a></li>

                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">Clinic Management</p>
                    <li><a href="{{ route('clinic.supplies') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="package" class="w-5 h-5"></i>Inventory</a></li>
                    <li><a href="{{ route('clinic.transactions') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-text" class="w-5 h-5"></i>Transactions</a></li>
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
                        <h1 class="text-xl md:text-3xl font-900">Patient Transaction</h1>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('clinic.patients.transactions', $patient) }}" class="font-bold hover:text-red-500 hover:underline underline-offset-4">Patient</a>
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            <p class="font-bold text-red-500">New Anti-Tetanus Immunization</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12">
                    <div class="col-span-3 md:col-span-1 flex items-center justify-center">
                    </div>
                </div>
                <!-- Main Content -->
                <div class="grid grid-cols-4  md:px-10 gap-2 ">
                    <div class="col-span-4 bg-white rounded-lg shadow-lg w-full  px-10 py-4  border border-gray-100">
                        <div class="flex flex-col gap-4 md:gap-0 ">
                            <a href="{{ route('clinic.patients.transactions', $patient) }}" class="text-blue-500 hover:underline flex items-center underline-offset-4 font-bold"><i data-lucide="chevron-left" class="w-5 h-5"></i>Back</a>
                            <div class="flex flex-col mb-6 ">
                                <h1 class="text-md  md:text-2xl font-900 text-center ">New Anti-Tetanus Transaction</h1>
                                <p class="text-gray-400 text-sm text-center">Service: {{ $service_fee->name }}</p>
                            </div>
                        </div>
                        <!-- Progress Bar -->
                        <div class="mb-8 overflow-x-auto  scrollbar-hidden ">
                            <div class="flex items-center justify-between md:px-32 ">
                                <!-- Step 1 -->
                                <div class="flex flex-col items-center ">
                                    <div id="step2-circle"
                                        class="step-indicator w-6 h-6 flex items-center justify-center rounded-full border-2 border-red-600 bg-red-600 text-white">
                                    </div>
                                    <span class="mt-2 text-xs md:text-sm font-bold text-gray-900 text-center">Immunization</span>
                                </div>
                                <!-- Line between step 1 & 2 -->
                                <div class=" bg-red-300 mx-2 border-2 h-1 w-full border-red-300" id="line2"></div>
                                <!-- Step 2 -->
                                <div class="flex flex-col items-center ">
                                    <div id="step3-circle"
                                        class="step-indicator w-6 h-6 flex items-center justify-center rounded-full border-2 border-red-300 bg-red-200 text-red-600">
                                    </div>
                                    <span class="mt-2 text-xs md:text-sm font-bold text-red-400 text-center">Payment</span>
                                </div>
                            </div>
                        </div>


                        <!-- Form Steps -->
                        <form id="multi-step-form" method="POST" action="{{ route('clinic.patients.new-transaction.antitetanus.add') }}">
                            @csrf
                            <input type="hidden" name="service_id" value="{{ $antiTetanuService }}">
                            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                            <input type="datetime-local" id="datetime_today" name="datetime_today" hidden>

                            <div class="flex flex-col w-full items-center justify-center">
                                <div class="md:w-1/2 grid grid-cols-6 gap-2 md:px-6 mb-2" id="vital-signs">
                                    <div class="col-span-6 ">
                                        <h2 class="md:text-lg text-gray-500 font-900">Vital Signs </h2>
                                    </div>
                                    <div class="col-span-6 md:col-span-2 ">
                                        <label for="heart_rate" class="block mb-2 text-sm font-bold text-gray-500">Weight (kg)</label>
                                        <input type="text" name="heart_rate" id="heart_rate" placeholder="e.g 70"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                                    </div>
                                    <div class="col-span-6 md:col-span-2 ">
                                        <label for="temperature" class="block mb-2 text-sm font-bold text-gray-500">Temperature</label>
                                        <input type="text" name="temperature" id="temperature" placeholder="e.g 37.5"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                                    </div>
                                    <div class="col-span-6 md:col-span-2 ">
                                        <label for="blood_pressure" class="block mb-2 text-sm font-bold text-gray-500">Blood Pressure</label>
                                        <input type="text" name="blood_pressure" id="blood_pressure" placeholder="e.g 120/80"
                                            oninput="this.value = this.value.replace(/[^0-9/]/g, '')"
                                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                                    </div>
                                </div>
                            </div>
                            <!-- Step 4:  Immunizations -->
                            <x-anti-tetanu-steps.step-2 :antiTetanusVaccines="$antiTetanusVaccines" :nurses="$nurses" />


                            <!-- Step 5: Payment -->
                            <x-anti-tetanu-steps.step-3 :staffs="$staffs" :service_fee="$service_fee" />
                            <!-- Navigation Buttons -->
                            <div class="flex justify-end mt-6 gap-4">
                                <button type="button" id="prevBtn" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200  focus:outline-none focus:shadow-outline hidden">Previous</button>
                                <button type="button" id="nextBtn" class="px-8 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 focus:outline-none focus:shadow-outline">Next</button>
                                <button type="submit" id="submitBtn" class="px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 focus:outline-none focus:shadow-outline hidden">Submit</button>
                            </div>
                        </form>

                        <!-- ANTI TETANU STAFF VERIFICATION Dialog -->
                        <dialog
                            id="verifyPaymentModal"
                            x-data="{
                                        staff_id: null,
                                        staff_name: null,
                                        open() { this.$refs.modal.showModal() },
                                        close() { this.$refs.modal.close() }
                                    }"
                            x-ref="modal"
                            @anti-tetanus-payment-modal.window="staff_id = $event.detail.staff_id; staff_name = $event.detail.staff_name; open()"
                            class="p-8 rounded-lg shadow-lg w-full max-w-xl backdrop:bg-black/30 focus:outline-none">

                            <!-- Modal content -->
                            <div class="flex justify-center items-center gap-2 mb-2">
                                <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-10 h-10">
                                <div class="flex flex-col items-center justify-center">
                                    <h2 class="text-xl font-bold ">Verification</h2>
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <p>Staff: <span x-text="staff_name"></span></p>
                            </div>
                            <form
                                x-data
                                @submit.prevent="
                                            fetch('{{ route('clinic.patients.verify-staff') }}', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                },
                                                body: JSON.stringify({
                                                    staff_id: staff_id,
                                                    staff_password: $el.querySelector('#staff_password').value
                                                })
                                            })
                                            .then(res => res.json())
                                            .then(data => {
                                                if (data.success) {
                                                    close(); // close modal
                                                    document.querySelector('#verifiedStaffLabel').classList.remove('hidden'); // show Verified
                                                    document.querySelector('#verifyButtonPayment').classList.add('hidden'); // hide Verify button
                                                    document.querySelector('#staffDropdownButton').disabled = true; // disable nurse dropdown button
                                                    document.querySelector('#verifyStaffSuccess').classList.remove('hidden');
                                                    document.querySelector('#NotVerifiedStaff').classList.add('hidden');
                                                    document.querySelector('#error_staff').classList.add('hidden');
                                                    document.querySelector('#staffDropdownButton').classList.remove('border-red-500');


                                                } else {
                                                    document.querySelector('#error_staff_password').classList.remove('hidden');
                                                    document.querySelector('#staff_password').classList.add('border-red-500');

                                                }
                                            })
                                            
                                            .catch(err => console.error(err));
                                        ">
                                <input type="hidden" name="staff_id" :value="staff_id">

                                <div class="flex flex-col gap-2">
                                    <label for="password" class="font-bold">Password</label>
                                    <div class="flex justify-between items-center">
                                        <p class="text-xs text-gray-500">Please enter your password to verify your identity.</p>
                                        <p id="error_staff_password" class="text-red-500 text-xs  text-end hidden">*Incorrect password.</p>
                                    </div>
                                    <input
                                        type="password"
                                        id="staff_password"
                                        name="staff_password"
                                        class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sky-200"
                                        required>
                                </div>
                                <div class="mt-4 flex justify-end gap-2">
                                    <button type="submit" class="px-8 py-2 bg-sky-500 text-white rounded hover:bg-sky-600">
                                        Verify
                                    </button>
                                    <!-- Close button -->
                                    <button
                                        class="px-4 py-2 bg-gray-200 rounded"
                                        @click="close()">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </dialog>
                        <!-- ANTI TETANU NURSE VERIFICATION Dialog -->
                        <dialog
                            id="verfiyNurseModal"
                            x-data="{
                                        nurse_id: null,
                                        nurse_name: null,
                                        open() { this.$refs.modal.showModal() },
                                        close() { this.$refs.modal.close() }
                                    }"
                            x-ref="modal"
                            @anti-tetanus-nurse-modal.window="nurse_id = $event.detail.nurse_id; nurse_name = $event.detail.nurse_name; open()"
                            class="p-8 rounded-lg shadow-lg w-full max-w-xl backdrop:bg-black/30 focus:outline-none">

                            <!-- Modal content -->
                            <div class="flex justify-center items-center gap-2 mb-2">
                                <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-10 h-10">
                                <div class="flex flex-col items-center justify-center">
                                    <h2 class="text-xl font-bold ">Nurse Verification</h2>
                                </div>
                            </div>
                            <div class="flex flex-col mb-4">
                                <p>Nurse: <span x-text="nurse_name"></span></p>
                            </div>
                            <form
                                x-data
                                @submit.prevent="
                                            fetch('{{ route('clinic.patients.verify-nurse') }}', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                },
                                                body: JSON.stringify({
                                                    nurse_id: nurse_id,
                                                    nurse_password: $el.querySelector('#nurse_password').value
                                                })
                                            })
                                            .then(res => res.json())
                                            .then(data => {
                                                if (data.success) {
                                                    close(); // close modal
                                                    document.querySelector('#verifiedLabel').classList.remove('hidden'); // show Verified
                                                    document.querySelector('#verifyButton').classList.add('hidden'); // hide Verify button
                                                    document.querySelector('#nurseDropdownButton').disabled = true; // disable nurse dropdown button
                                                    document.querySelector('#verifySuccess').classList.remove('hidden');
                                                    document.querySelector('#NotVerified').classList.add('hidden');
                                                    document.querySelector('#error_nurse').classList.add('hidden');
                                                    

                                                } else {
                                                    document.querySelector('#error_nurse_password').classList.remove('hidden');
                                                    document.querySelector('#nurse_password').classList.add('border-red-500');

                                                }
                                            })
                                            
                                            .catch(err => console.error(err));
                                        ">
                                <input type="hidden" name="nurse_id" :value="nurse_id">

                                <div class="flex flex-col gap-2">
                                    <label for="password" class="font-bold">Password</label>
                                    <div class="flex justify-between items-center">
                                        <p class="text-xs text-gray-500">Please enter your password to verify your identity.</p>
                                        <p id="error_nurse_password" class="text-red-500 text-xs  text-end hidden">*Incorrect password.</p>
                                    </div>
                                    <input
                                        type="password"
                                        id="nurse_password"
                                        name="nurse_password"
                                        class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sky-200"
                                        required>
                                </div>
                                <div class="mt-4 flex justify-end gap-2">
                                    <button type="submit" class="px-8 py-2 bg-sky-500 text-white rounded hover:bg-sky-600">
                                        Verify
                                    </button>
                                    <!-- Close button -->
                                    <button
                                        class="px-4 py-2 bg-gray-200 rounded"
                                        @click="close()">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </dialog>
                    </div>
                </div>
            </div>
        </section>
        <!-- Overlay -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="text-white flex items-center">
                <svg aria-hidden="true" role="status" class="inline w-6 h-6 mr-3 animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB" />
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor" />
                </svg>
                <span>Loading...</span>
            </div>
        </div>
        <!-- Modals For Logout -->
        <x-logout-modal />
</body>
<script>
    let currentStep = 2;
    const totalSteps = 3;

    const form = document.getElementById("multi-step-form");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const submitBtn = document.getElementById("submitBtn");
    const vitalSigns = document.getElementById("vital-signs"); // reference to vital signs div


    function showStep(step) {
        // Hide all steps
        document.querySelectorAll(".step").forEach(s => s.classList.add("hidden"));
        document.getElementById(`step-${step}`).classList.remove("hidden");

        if (step === 2) {
            vitalSigns.classList.remove("hidden");
        } else {
            vitalSigns.classList.add("hidden");
        }

        // Update step circles + labels
        for (let i = 2; i <= totalSteps; i++) {
            const circle = document.getElementById(`step${i}-circle`);
            const label = circle.parentElement.querySelector("span");

            if (i < step) {
                circle.className = "w-6 h-6 flex items-center justify-center rounded-full border-2 border-red-600 bg-red-600 text-white";
                label.className = "mt-2 text-xs md:text-sm font-bold text-gray-900 text-center";
            } else if (i === step) {
                circle.className = "w-6 h-6 flex items-center justify-center rounded-full border-2 border-red-600 bg-red-600 text-white";
                label.className = "mt-2 text-xs md:text-sm font-bold text-gray-900 text-center";
            } else {
                circle.className = "w-6 h-6 flex items-center justify-center rounded-full border-2 border-red-300 bg-red-200 text-red-600";
                label.className = "mt-2 text-xs md:text-sm font-bold text-red-400 text-center";
            }
        }

        // Update connecting lines
        for (let i = 2; i < totalSteps; i++) {
            const line = document.getElementById(`line${i}`);
            if (i < step) {
                line.className = "bg-red-600 mx-2 border-2 h-1 w-full border-red-600";
            } else {
                line.className = "bg-red-300 mx-2 border-2 h-1 w-full border-red-300";
            }
        }

        // Toggle buttons
        prevBtn.classList.toggle("hidden", step === 2);
        nextBtn.classList.toggle("hidden", step === totalSteps);
        submitBtn.classList.toggle("hidden", step !== totalSteps);
    }

    function validateStep(step) {
        switch (step) {
            case 2:
                return validateStep2();
            case 3:
                return validateStep3();
            default:
                return true;
        }
    }

    // Handle "Next" button
    nextBtn.addEventListener("click", () => {
        if (validateStep(currentStep)) {
            currentStep++;
            showStep(currentStep);
        }
    });

    // Handle "Previous" button
    prevBtn.addEventListener("click", () => {
        currentStep--;
        showStep(currentStep);
    });

    // Handle form submission
    form.addEventListener("submit", (e) => {
        e.preventDefault();

        // Always validate final step before actual submit
        if (validateStep(3)) {


            submitBtn.disabled = true;

            // Show overlay
            document.getElementById("overlay").classList.remove("hidden");

            // Optional: change button text too
            submitBtn.innerHTML = `
            <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
            </svg>
            <span>Loading...</span>
        `;
            form.submit();
        }
    });

    // Initialize wizard
    showStep(currentStep);
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('datetime_today');
        if (input) {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            // Format: YYYY-MM-DDTHH:MM
            const formatted = `${year}-${month}-${day}T${hours}:${minutes}`;
            input.value = formatted;
        }
    });
</script>



</html>