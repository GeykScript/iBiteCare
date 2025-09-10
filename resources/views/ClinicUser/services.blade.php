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
                    <li><a href="{{ route('clinic.transactions') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-text" class="w-5 h-5"></i>Transactions</a></li>
                    <li><a href="{{ route('clinic.payments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="philippine-peso" class="w-5 h-5"></i>Payments </a></li>
                    <li><a href="{{ route('clinic.services') }}" class="block px-4 py-2 rounded bg-gray-900 text-white flex items-center gap-3"><i data-lucide="briefcase-medical" class="w-5 h-5"></i>Services</a></li>
                    <li><a href="{{ route('clinic.reports')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="chart-column-big" class="w-5 h-5"></i>Reports</a></li>

                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">User Management</p>
                    <li><a href="{{route('clinic.user-accounts')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-user" class="w-5 h-5"></i>Accounts</a></li>
                    <li><a href="{{route('clinic.user-logs')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="logs" class="w-5 h-5"></i>Logs</a></li>
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
                        <h1 class="text-lg md:text-3xl font-900">Clinic Services</h1>
                        <h2 class=",d:ml-3 text-sm md:text-lg font-bold">Manage Clinic Services</h2>

                    </div>
                </div>
                <!-- Header content -->
                <div class="grid grid-cols-4 p-4 md:px-20 ">
                    <div class="col-span-4 md:col-span-4 flex justify-end  px-2">
                        <button
                            onclick="document.getElementById('newClinicServiceModal').showModal()"
                            class=" bg-red-600 text-white px-7 py-2 rounded-lg flex items-center gap-3 focus:outline-none font-bold hover:bg-red-700"><i data-lucide="plus" class="w-5 h-5 stroke-[2]"></i>New Service</button>
                    </div>

                    <!-- New Clinic Service Modal -->
                    <dialog id="newClinicServiceModal" class="p-8 rounded-lg shadow-lg w-full max-w-3xl backdrop:bg-black/30 focus:outline-none ">
                        <!-- close modal button  -->
                        <div class="w-full flex justify-end mb-5">
                            <button onclick="document.getElementById('newClinicServiceModal').close()" class="focus:outline-none"><i data-lucide="x" class="w-5 h-5"></i></button>
                        </div>

                        <!-- create new services form  -->
                        <form action="{{ route('clinic.services.add') }}" method="POST" id="newClinicServiceForm">
                            @csrf
                            <div class="grid grid-cols-12 md:px-8 gap-2 flex flex-col items-center justify-center">
                                <div class="col-span-12 flex flex-col items-center justify-center">
                                    <h1 class="font-900 md:text-2xl text-xl">New Clinic Services</h1>
                                    <p>Fill out the form below to add a new service. All fields are required.</p>
                                </div>

                                <div class="col-span-12  w-full  flex flex-col gap-3 mt-4">
                                    <div class="grid grid-cols-4 w-full gap-2 ">
                                        <div class="md:col-span-3 col-span-4">
                                            <label for="service_name" class="block mb-2 text-sm font-medium text-gray-900">Service Name</label>
                                            <input type="text" id="service_name" name="service_name" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5" placeholder="Enter Service Name" required>
                                        </div>
                                        <div class="md:col-span-1 col-span-4">
                                            <label for="service_fee" class="block mb-2 text-sm font-medium text-gray-900">Service Fee</label>
                                            <input type="number" id="service_fee" name="service_fee" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5" placeholder="Service Fee" required>

                                        </div>
                                    </div>
                                    <div class="flex flex-col w-full">
                                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                                        <textarea id="description" name="description" class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5" placeholder="Enter Description" required></textarea>
                                    </div>
                                    <div class="flex justify-between items-center pr-10 p-2">
                                        <!-- Add button -->
                                        <button type="button" id="add-schedule" class="mt-2 text-blue-500 font-bold  py-1 rounded flex items-center gap-2 hover:text-blue-600"><i data-lucide="plus" class="w-4 h-4 "></i>Add  Schedule <span class="text-gray-400 font-normal">(Optional)</span></button>
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


                                <!-- submit and cancel button   -->
                                <div class="col-span-12 flex items-end justify-end gap-2 mt-5">
                                    <button type="submit" class="md:px-8 px-4 py-2 bg-sky-500 text-white rounded-lg text-md hover:bg-sky-400">
                                        Create Service
                                    </button>
                                    <button type="button" onclick="document.getElementById('newClinicServiceModal').close()"
                                        class="px-6 py-2 bg-gray-100 text-gray-500 rounded-lg text-md hover:bg-gray-200">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </dialog>
                    <!-- services table  -->
                    <div class="col-span-4 md:col-span-4   px-2 shadow-lg rounded-lg mt-2">
                        <livewire:clinic-services-table />
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