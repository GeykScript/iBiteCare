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
                    <li><a href="{{ route('clinic.patients')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="users" class="w-5 h-5"></i>Patients</a></li>
                    <li><a href="{{ route('clinic.appointments') }}" class="block px-4 py-2 rounded bg-gray-900 text-white flex items-center gap-3"><i data-lucide="notebook-pen" class="w-5 h-5"></i>Appointments</a></li>
                    <li><a href="{{ route('clinic.messages') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="message-square-text" class="w-5 h-5"></i>Messages</a></li>

                    <p class="text-xs font-bold text-gray-400 my-1 uppercase">Clinic Management</p>
                    <li><a href="{{route('clinic.supplies')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="package" class="w-5 h-5"></i>Inventory</a></li>
                    <li><a href="{{ route('clinic.transactions')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-text" class="w-5 h-5"></i>Transactions</a></li>
                    <li><a href="{{ route('clinic.payments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="philippine-peso" class="w-5 h-5"></i>Payments </a></li>
                    @if ($clinicUser && $clinicUser->UserRole && strtolower($clinicUser->UserRole->role_name) === 'admin')
                    <li><a href="{{ route('clinic.services') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="briefcase-medical" class="w-5 h-5"></i>Services</a></li>
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
                    <div>
                        <h1 class="text-xl md:text-3xl font-900">Booking Records</h1>
                    </div>
                </div>
                <!-- Header content -->
                <div class="md:pl-12 pl-6 flex items-center md:gap-2 ">
                    <h1 class="md:text-2xl font-900 text-[#FF000D]">Booked Patients Lists</h1>
                    <a href="{{ route('clinic.user-manual') }}#appointments" target="_blank" class="text-[#FF000D]"> <i data-lucide="circle-question-mark" class="w-5 h-5"></i>
                    </a>
                </div>

                <div class="md:pl-12 pl-6">
                    <h1 class="md:text-lg text-gray-800"> This list shows all patients who have made an appointment.
                    </h1>
                </div>

                <!-- Main Content -->
                <div class="grid grid-cols-4 p-4  md:px-10 ">
                    <div class="col-span-4 md:col-span-4 flex justify-end  px-2">
                        <button
                            onclick="document.getElementById('addAppointment').showModal()"
                            class="bg-red-600 text-white px-7 py-2 rounded-lg flex items-center gap-3 focus:outline-none"><i data-lucide="plus" class="w-5 h-5"></i>Add Appointment</button>
                    </div>

                    <!-- // Add Appointment Modal -->
                    <dialog id="addAppointment" class="p-8 rounded-lg shadow-lg w-full max-w-2xl backdrop:bg-black/30 focus:outline-none ">
                        <!-- close modal button  -->
                        <div class="w-full flex justify-end mb-5">
                            <button onclick="document.getElementById('addAppointment').close()" class="focus:outline-none"><i data-lucide="x" class="w-5 h-5"></i></button>
                        </div>
                        <!-- create  sms message all form  -->
                        <div>
                            <div class="grid grid-cols-12 md:px-8 gap-2 flex flex-col items-center justify-center ">
                                <div class="col-span-12 flex items-center gap-4 mb-4">
                                    <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-16 h-16">
                                    <div class="flex flex-col">
                                        <h2 class="text-xl font-bold ">Make Appointment</h2>
                                        <p class="text-gray-600 text-sm">Fill out the form below to schedule a new appointment.</p>
                                    </div>
                                </div>

                                <form action="{{ route('clinic.appointments.book') }}" id="appointmentForm" method="POST" class="col-span-12">
                                    @csrf
                                    <div class="grid grid-cols-12 gap-2 ">
                                        <div class="col-span-12 md:col-span-6">
                                            <label for="name" class="block mb-2 text-sm font-bold text-gray-900 mt-2">Name</label>
                                            <input type="text" name="name" id="name" placeholder="Name" autocomplete="given-name"
                                                class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-0 focus:border-sky-500"
                                                required>
                                            <label for="contact_number" class="block mb-2 text-sm font-bold text-gray-900 mt-2">Phone Number</label>
                                            <input type="text" name="contact_number" id="contact_number" required placeholder="e.g 09xx xxx xxxx" maxlength="13"
                                                class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-0 focus:border-sky-500">

                                            <label for="email" class="block mb-2 text-sm font-bold text-gray-900 mt-2">Email Address <span class="font-normal">( Optional )</span></label>
                                            <input type="email" name="email" id="email" autocomplete="email" placeholder="example@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-0 focus:border-sky-500">

                                        </div>
                                        <div class="col-span-12 md:col-span-6">
                                            <div class="grid grid-cols-2 gap-2 mt-2">
                                                <div class="col-span-2 md:col-span-1 flex flex-col">
                                                    <label for="appointment_date" class="text-sm font-medium text-gray-900 mb-2">Date</label>
                                                    <input
                                                        type="date"
                                                        id="appointment_date"
                                                        name="appointment_date" required
                                                        class="text-sm border border-gray-300 rounded-lg  p-2.5 focus:ring-sky-500 focus:border-sky-500">
                                                </div>

                                                <div class="col-span-2 md:col-span-1 flex flex-col">
                                                    <label for="appointment_time" class="text-sm font-medium text-gray-900 mb-2">Time</label>
                                                    <input
                                                        type="time"
                                                        id="appointment_time"
                                                        name="appointment_time" required
                                                        class="text-sm border border-gray-300 rounded-lg p-2.5 focus:ring-sky-500 focus:border-sky-500">
                                                </div>
                                            </div>
                                            <div x-data="{ open: false, selected: null, selectedLabel: 'Select...', }" class="relative mt-2">
                                                <p class="block text-sm font-medium text-gray-900">Type of Treatment</p>

                                                <!-- Hidden input for form submission -->
                                                <input type="hidden" name="treatment_type" required x-model="selected">

                                                <!-- Button / Display -->
                                                <button type="button"
                                                    @click="open = !open"
                                                    id="treatment_type_dropdown_button"
                                                    class="mt-2 w-full border border-gray-300 text-gray-900 rounded-md px-3 py-2 text-left bg-white flex justify-between items-center text-sm focus:ring-sky-500 focus:border-sky-500 transition">
                                                    <span x-text="selectedLabel"></span>
                                                    <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
                                                </button>

                                                <!-- Dropdown list -->
                                                <div x-show="open"
                                                    @click.outside="open = false"
                                                    class="absolute z-10 mt-1 w-full bg-white border rounded shadow max-h-40 overflow-y-auto scrollbar-hidden">
                                                    @foreach($services as $service)
                                                    <div
                                                        @click="selected = '{{ $service->name }}'; selectedLabel = '{{ $service->name }}'; open = false"
                                                        class="px-3 py-2 cursor-pointer hover:bg-gray-100 text-sm">
                                                        {{ $service->name }}
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="flex flex-col mt-3">
                                                <p class="text-sm font-medium text-gray-900 ">Booking Channel</p>
                                                <div class="flex flex-col mt-3 px-4">
                                                    <label class="flex items-center space-x-2">
                                                        <input
                                                            type="radio"
                                                            name="channel"
                                                            value="Phone Call" required
                                                            class="text-sky-600 focus:ring-sky-500">
                                                        <span>Phone Call</span>
                                                    </label>

                                                    <label class="flex items-center space-x-2">
                                                        <input
                                                            type="radio"
                                                            name="channel"
                                                            value="Text Message"
                                                            class="text-sky-600 focus:ring-sky-500">
                                                        <span>Text Message</span>
                                                    </label>
                                                    <label class="flex items-center space-x-2">
                                                        <input
                                                            type="radio"
                                                            name="channel"
                                                            value="Walk-In"
                                                            class="text-sky-600 focus:ring-sky-500">
                                                        <span>Walk-In</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-12">
                                            <label for="notes" class="block mb-2 text-sm font-bold text-gray-900 mt-2">Notes <span class="font-normal">( Optional )</span></label>
                                            <textarea name="notes" id="notes" rows="3" placeholder="Additional notes..."
                                                class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-0 focus:border-sky-500"></textarea>
                                        </div>
                                    </div>

                                    <div class="flex justify-end gap-2 mt-6">
                                        <button type="submit" id="submitAppointmentBtn" class="flex items-center gap-2 bg-sky-500 hover:bg-sky-600 text-white px-6 py-2 rounded-lg">
                                            Submit
                                        </button>
                                        <button type="button" onclick="document.getElementById('addAppointment').close()"
                                            class="px-6 py-2 bg-gray-100 text-gray-500 rounded-lg text-md">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </dialog>
                    <div class="col-span-4">
                        <livewire:appointment-table />
                    </div>

                </div>
            </div>
        </section>

        <!-- Modals For Logout -->
        <x-logout-modal />
        <script>
            const submitAppointmentBtn = document.getElementById("submitAppointmentBtn");
            document.getElementById('appointmentForm').addEventListener('submit', function() {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
            <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
            </svg>
            <span>Loading...</span>
        `;

            });
        </script>

</body>


</html>