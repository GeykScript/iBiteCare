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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/datetime.js'])



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
                    <li><a href="{{ route('clinic.appointments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="notebook-pen" class="w-5 h-5"></i>Appointments</a></li>
                    <li><a href="{{ route('clinic.messages') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="message-square-text" class="w-5 h-5"></i>Messages</a></li>

                    <p class="text-xs font-bold text-gray-400 my-1 uppercase">Clinic Management</p>
                    <li><a href="{{route('clinic.supplies')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="package" class="w-5 h-5"></i>Inventory</a></li>
                    <li><a href="{{ route('clinic.transactions')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-text" class="w-5 h-5"></i>Transactions</a></li>
                    <li><a href="{{ route('clinic.payments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="philippine-peso" class="w-5 h-5"></i>Payments </a></li>
                    <li><a href="{{ route('clinic.services') }}" class="block px-4 py-2 rounded bg-gray-900 text-white flex items-center gap-3"><i data-lucide="briefcase-medical" class="w-5 h-5"></i>Services</a></li>

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
                        <div class="flex items-center gap-2">
                            <h1 class="text-xl md:text-3xl font-900">Clinic Services</h1>
                            <a href="{{ route('clinic.user-manual') }}" target="_blank" class="text-[#FF000D]"> <i data-lucide="circle-question-mark" class="w-5 h-5"></i></a>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('clinic.services') }}" class="font-bold hover:text-red-500 hover:underline underline-offset-4">Services </a>
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            <p class="font-bold text-red-500">Update Details</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12">
                    <div class="col-span-3 md:col-span-1 flex items-center justify-center">
                        <a href="{{ route('clinic.services') }}" class="text-blue-500 hover:underline flex items-center underline-offset-4 font-bold"><i data-lucide="chevron-left" class="w-5 h-5"></i>Back</a>
                    </div>
                </div>



                <!-- Main Content -->
                <div class="grid grid-cols-4 p-4  md:px-10 gap-2 ">
                    <div class="col-span-4 md:col-span-4 px-2 ">
                        <h1 class="text-xl font-bold">
                            Update Service Details
                        </h1>
                        <p class="text-sm text-gray-500">Update the information for the service.</p>
                    </div>
                    <div class="col-span-4  px-2">
                        <form action="{{ route('clinic.services.update.details') }}" method="POST" class="flex flex-col " id="UpdateServiceForm">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="service_id" value="{{ $service->id }}">

                            <div class="grid grid-cols-2 gap-10">
                                <div class="md:col-span-1 col-span-2">
                                    <h1 class="text-lg font-bold">Service Details</h1>
                                    <div class="mt-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Service Name</label>
                                        <input type="text" name="name" id="name" autocomplete="name" value="{{ old('name', $service->name) }}"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                                        @error('name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-4">
                                        <label for="description" class="block text-sm font-medium text-gray-700">Service Description</label>
                                        <textarea name="description" id="description" rows="4"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>{{ old('description', $service->description) }}</textarea>
                                        @error('description')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-4">
                                        <label for="fee" class="block text-sm font-medium text-gray-700">Service Fee</label>
                                        <input type="text" name="service_fee" id="fee" value="{{ old('service_fee', $service->service_fee) }}"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                                        @error('service_fee')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="md:col-span-1 col-span-2">
                                    <h1 class="text-lg font-bold">Service Schedule <span class="text-gray-400 text-sm">(Optional)</span></h1>
                                    <div class="mt-2">
                                        <div class="mb-2">
                                            <p class="text-sm text-gray-500">Day Offset - Label</p>
                                        </div>
                                        <p class="text-center text-gray-500 font-bold" id="no-schedule" hidden>No Schedule</p>
                                        <div id="schedule-container">
                                            @forelse ($service->schedules as $index => $schedule)
                                            <div class="grid grid-cols-5 gap-2 mb-2">
                                                <input type="hidden" name="schedules[{{ $index }}][id]" value="{{ $schedule->id }}" class="border border-gray-300 rounded-md shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 sm:text-sm">

                                                <input type="number" name="day[{{ $index }}]" value="{{ $schedule->day_offset }}" class="col-span-1 border border-gray-300 rounded-md shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                                                <input type="text" name="label[{{ $index }}]" value="{{ $schedule->label }}" class="col-span-3 border border-gray-300 rounded-md shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 sm:text-sm">

                                                {{-- Remove button --}}
                                                <button type="button"
                                                    class="p-3 rounded-md text-sm flex items-start justify-start text-red-500 hover:text-red-600"
                                                    onclick="removeSchedule(this, '{{ $schedule->id }}')">

                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        width="20" height="20"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="lucide lucide-trash2-icon lucide-trash-2">
                                                        <path d="M10 11v6" />
                                                        <path d="M14 11v6" />
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                                        <path d="M3 6h18" />
                                                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                    </svg>
                                                </button>
                                            </div>
                                            @empty
                                            <p class="text-center text-gray-500 font-bold">No Schedule</p>
                                            @endforelse
                                        </div>

                                    </div>
                                    <!-- Container for deleted schedule IDs -->
                                    <div id="deleted-schedules"></div>
                                    <!--------end of deleted schedule container----->


                                    <div class="flex justify-between items-center pr-10 p-2">
                                        <!-- Add button -->
                                        <button type="button" id="add-schedule" class="mt-2 text-blue-500 font-bold  py-1 rounded flex items-center gap-2 hover:text-blue-600"><i data-lucide="plus" class="w-4 h-4 "></i>Add New Schedule</button>
                                    </div>
                                    <!-- Container for new schedules -->
                                    <div id="Newschedule" class="space-y-2">
                                        <!-- Default input -->
                                        <div class="grid grid-cols-5 gap-2">
                                            <input type="number" name="newDay[]" placeholder="Day Offset"
                                                class="border border-gray-300 rounded-md shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                                            <input type="text" name="newLabel[]" placeholder="New label"
                                                class="col-span-3 border border-gray-300 rounded-md shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                                            <button type="button" class="remove-btn p-3 rounded-md text-sm flex items-start justify-start text-red-500 hover:text-red-600"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="20" height="20"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="lucide lucide-trash2-icon lucide-trash-2">
                                                    <path d="M10 11v6" />
                                                    <path d="M14 11v6" />
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                                    <path d="M3 6h18" />
                                                    <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                </svg></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end p-4 items-center gap-4 md:pr-24">
                                <a href="{{ route('clinic.services') }}" class="text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg">Cancel</a>
                                <button type="submit" id="submitUpdateBtn" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-500">
                                    Update Service
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Modals For Logout -->
    <x-logout-modal />

</body>

<script>
    const submitUpdateBtn = document.getElementById("submitUpdateBtn");
    document.getElementById('UpdateServiceForm').addEventListener('submit', function() {
        submitUpdateBtn.disabled = true;
        submitUpdateBtn.innerHTML = `
            <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
            </svg>
            <span>Loading...</span>
        `;

    });

    function removeSchedule(button, id) {
        // Add hidden input with deleted ID (so it submits)
        const deletedContainer = document.getElementById('deleted-schedules');
        const hiddenInput = document.createElement('input');
        const noScheduleMsg = document.getElementById('no-schedule');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'deleted_schedules[]';
        hiddenInput.value = id;
        deletedContainer.appendChild(hiddenInput);

        // Remove the input row
        button.closest('.grid').remove();
        // Check if no schedule rows remain
        if (document.querySelectorAll('#schedule-container .grid').length === 0) {
            noScheduleMsg.removeAttribute('hidden');
        }
    }


    const container = document.getElementById('Newschedule');
    const addBtn = document.getElementById('add-schedule');

    addBtn.addEventListener('click', () => {
        // Create wrapper div
        const div = document.createElement('div');
        div.classList.add('grid', 'grid-cols-5', 'gap-2');

        // Create Day input
        const dayInput = document.createElement('input');
        dayInput.type = 'number';
        dayInput.name = 'newDay[]';
        dayInput.placeholder = 'Day Offset';
        dayInput.className =
            'border border-gray-300 rounded-md shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 sm:text-sm';

        // Create Label input
        const labelInput = document.createElement('input');
        labelInput.type = 'text';
        labelInput.name = 'newLabel[]';
        labelInput.placeholder = 'New label';
        labelInput.className =
            'col-span-3 border border-gray-300 rounded-md shadow-sm p-2 focus:ring-sky-500 focus:border-sky-500 sm:text-sm';

        // Create remove button with SVG
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className =
            'remove-btn p-3 rounded-md text-sm flex items-start justify-start text-red-500 hover:text-red-600';
        removeBtn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="20" height="20"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 class="lucide lucide-trash-2">
                <path d="M10 11v6" />
                <path d="M14 11v6" />
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                <path d="M3 6h18" />
                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
            </svg>
        `;

        // Append inputs + button to div
        div.appendChild(dayInput);
        div.appendChild(labelInput);
        div.appendChild(removeBtn);

        // Append div to container
        container.appendChild(div);
    });

    // Event delegation for all remove buttons (existing + future)
    container.addEventListener('click', (e) => {
        if (e.target.closest('.remove-btn')) {
            e.target.closest('.grid').remove();
        }
    });
</script>

</html>