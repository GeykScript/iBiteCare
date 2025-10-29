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

                    <li class="flex items-center px-2 mb-2 block md:hidden">
                        <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-14 h-14">
                        <a href="{{ route('clinic.dashboard') }}" class="block px-2 py-2 rounded text-2xl text-[#FF000D] font-900 flex items-center gap-3">Dr.Care </a>
                    </li>

                    <li><a href="{{ route('clinic.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="layout-dashboard" class="w-5 h-5"></i>Dashboard</a></li>
                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">Patient Management</p>
                    <li><a href="{{ route('clinic.patients') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="users" class="w-5 h-5"></i>Patients</a></li>
                    <li><a href="{{ route('clinic.appointments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="notebook-pen" class="w-5 h-5"></i>Appointments</a></li>
                    <li><a href="{{ route('clinic.messages') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="message-square-text" class="w-5 h-5"></i>Messages</a></li>

                    <p class="text-xs font-bold text-gray-600 mt-4 uppercase">Clinic Management</p>
                    <li><a href="{{ route('clinic.supplies') }}" class="block px-4 py-2 rounded bg-gray-900 text-white flex items-center gap-3"><i data-lucide="package" class="w-5 h-5"></i>Inventory</a></li>
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
                    <div>
                        <h1 class="text-xl md:text-3xl font-900">Inventory Supplies</h1>
                    </div>
                </div>
                <!-- Header content -->
                <div class="md:pl-12 pl-6 flex items-center md:gap-2 ">
                    <h1 class="md:text-2xl font-900 text-[#FF000D]">Clinic Inventory</h1>
                    <!-- <i data-lucide="circle-question-mark" class="stroke-white font-900 md:w-6 md:h-6 w-4 h-4 fill-[#FF000D]"></i> -->
                </div>
                <div class="md:pl-12 pl-6">
                    <h1 class="md:text-lg text-gray-800">All vaccines, rigs, supplies and equipment available at the clinic.</h1>
                </div>
                <!-- Main Content -->
                <div class="grid grid-cols-4 p-4  md:px-10 gap-4">
                    <div class="col-span-7 md:col-span-4 flex flex-col md:flex-row items-end md:items-center justify-end gap-4 md:gap-10">
                        <div class="col-span-7 md:col-span-4 flex items-center justify-end gap-2 text-blue-500 hover:text-blue-600">
                            <i data-lucide="file-text" class="w-5 h-5"></i>
                            <a href="{{ route('clinic.supplies.view_usage') }}" class="font-bold underline underline-offset-8">View Usage History</a>
                        </div>
                        <div>
                            <button
                                onclick="document.getElementById('AddNewSupplies').showModal()"
                                class="bg-red-600 hover:bg-red-500 text-white px-7 py-2 rounded-lg flex items-center gap-3 focus:outline-none">
                                <i data-lucide="plus" class="w-5 h-5"></i>Add New Supplies</button>
                        </div>
                    </div>

                    <!-- add new supplies modal  -->
                    <dialog id="AddNewSupplies" class="p-8 rounded-lg shadow-lg w-full max-w-5xl backdrop:bg-black/30 focus:outline-none h-full">
                        <!-- close modal button  -->
                        <div class="w-full flex justify-end mb-5">
                            <button onclick="document.getElementById('AddNewSupplies').close()" class="focus:outline-none"><i data-lucide="x" class="w-5 h-5"></i></button>
                        </div>

                        <!-- create new user form  -->
                        <form action="{{route('clinic.supplies.add_new_supplies')}}" method="POST" id="addSuppliesForm">
                            @csrf
                            <div class="grid grid-cols-12 md:px-8 gap-2 flex flex-col items-center justify-center ">

                                <div class="col-span-12 flex flex-col items-center justify-center">
                                    <h1 class="font-900 md:text-2xl text-xl">Add New Supplies</h1>
                                    <p>Fill out the form below to add new supplies. All fields are required.</p>
                                </div>
                                <!-- divider border  -->
                                <div class="col-span-12 border-2 border-gray-100 mt-2 mb-2"></div>
                                <div class="col-span-12">
                                    <h1 class="font-900 text-md">Product Information</h1>
                                    <p class="text-gray-600 px-2">Please provide the following information about the product.</p>

                                    <div class="grid grid-cols-12 gap-2 py-2">
                                        <div class="md:col-span-4 col-span-12">
                                            <p class="text-sm font-semibold mb-1">Category</p>
                                            <x-select-dropdown
                                                name="category"
                                                id="category_id"
                                                placeholder="Choose Category"
                                                :options="[
                                                        'Vaccine' => 'Vaccine',
                                                        'RIG' => 'RIG',
                                                        'Anti-Tetanus' => 'Anti-Tetanus',
                                                        'Booster' => 'Booster',
                                                        'Supply' => 'Supply',
                                                        'Equipment' => 'Equipment',
                                                    ]" />
                                        </div>
                                        <div class="md:col-span-4 col-span-12">
                                            <label for="product_type" class="text-sm font-semibold">Product Type</label>
                                            <input type="text" name="product_type" id="product_type" placeholder="e.g PVRV, ERIG, syringe, etc."
                                                pattern="[A-Za-z0-9 ]+"
                                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none hover:border-sky-400 focus:ring-0 focus:border-sky-400" required />
                                        </div>
                                        <div class="md:col-span-4 col-span-12">
                                            <p class="text-sm font-semibold mb-1">Service Usage: <span class="font-normal">( Skip if n/a)</span> </p>
                                            <div x-data="{ open: false, selected: null, selectedLabel: 'Select Service' }" class="relative">
                                                <!-- Hidden input to store the selected ID -->
                                                <input type="hidden" name="service_id"  x-model="selected" >

                                                <!-- Button / Display -->
                                                <button type="button"
                                                    @click="open = !open"
                                                    id="service_dropdown_button"
                                                    class="w-full border border-gray-300 text-gray-900 rounded-lg px-3 py-2 text-left bg-white flex justify-between items-center text-md focus:ring-sky-500 focus:border-sky-500">
                                                    <span x-text="selectedLabel"></span>
                                                    <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
                                                </button>

                                                <!-- Dropdown list -->
                                                <div x-show="open" @click.outside="open = false"
                                                    class="absolute z-10 mt-1 w-full bg-white border rounded shadow max-h-48 overflow-y-auto">
                                                    @foreach ($services as $service)
                                                    <div
                                                        @click="selected = '{{ $service->id }}'; selectedLabel = '{{ $service->name }}'; open = false"
                                                        class="px-3 py-2 cursor-pointer hover:bg-gray-100 text-sm">
                                                        {{ $service->name }}
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="grid grid-cols-12 gap-4 py-2">
                                        <div class="md:col-span-6 col-span-12 flex flex-col justify-end gap-2">
                                            <label for="brand_name" class="text-sm font-semibold">Product Name</label>
                                            <input type="text" name="brand_name" id="brand_name" placeholder="Brand Name"
                                                pattern="[A-Za-z ]+"
                                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none hover:border-sky-400 focus:ring-0 focus:border-sky-400 h-12" required />
                                        </div>
                                        <div class="md:col-span-6 col-span-12 gap-2">
                                            <h1 class="text-sm font-semibold">Immunity Type</h1>
                                            <p class="text-xs italic my-2 text-gray-600">Select the immunity type if this is a vaccine or RIG. Choose "None" for other items.</p>
                                            <div class="flex items-center gap-4">
                                                <!-- none -->
                                                <label class="flex items-center space-x-2">
                                                    <input type="radio" name="immunity_type" value="" class="text-red-500 focus:ring-red-500" required>
                                                    <span>None</span>
                                                </label>
                                                <!-- active immunity  -->
                                                <label class="flex items-center space-x-2">
                                                    <input type="radio" name="immunity_type" value="Active" class="text-green-600 focus:ring-green-600">
                                                    <span>Active</span>
                                                </label>
                                                <!-- passive immunity  -->
                                                <label class="flex items-center space-x-2">
                                                    <input type="radio" name="immunity_type" value="Passive" class="text-sky-600 focus:ring-sky-600">
                                                    <span>Passive</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- divider border  -->
                                <div class="col-span-12 border-2 border-gray-100 mt-2 mb-2"></div>
                                <div class="col-span-12 ">
                                    <h1 class="font-900 text-md">Stock Information</h1>
                                    <div class="grid grid-cols-12 gap-2 py-2">
                                        <div class="md:col-span-6 col-span-12">
                                            <p class="text-sm font-semibold mb-1">Package Type</p>
                                            <x-select-dropdown
                                                name="package_type"
                                                id="package_type_id"
                                                placeholder="Choose Package Type"
                                                :options="['Vial','Box','Piece','Pack']" />
                                        </div>
                                        <div class="md:col-span-6 col-span-12">
                                            <label for="volume_per_item_id" class="text-sm font-semibold">Volume (ml) per item <span class="text-gray-500 font-normal text-xs italic">(Leave blank if not a vaccine or rig)</span></label>
                                            <input type="number" name="volume_per_item" id="volume_per_item_id" placeholder="e.g 5 ml"
                                                min="0" step="any"
                                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none hover:border-sky-400 focus:ring-0 focus:border-sky-400" />
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-12 gap-2 py-2">
                                        <div class="md:col-span-4 col-span-12">
                                            <label for="package_received_id" class="text-sm font-semibold">Package Quantity</label>
                                            <p class="text-xs italic text-gray-500 mt-2"> No. of packages of the product</p>
                                            <input type="number" name="packages_received" id="package_received_id" placeholder="e.g 10 vial, 2 box" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none hover:border-sky-400 focus:ring-0 focus:border-sky-400" required />
                                        </div>
                                        <div class="md:col-span-4 col-span-12">
                                            <label for="items_per_package_id" class="text-sm font-semibold">Items Per Package</label>
                                            <p class="text-xs italic text-gray-500 mt-2">No. of items per package. (If vial/pcs it should be 1)</p>
                                            <input type="number" name="items_per_package" id="items_per_package_id" placeholder="e.g 10 pcs in box" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none hover:border-sky-400 focus:ring-0 focus:border-sky-400" required />
                                        </div>
                                        <div class="md:col-span-4 col-span-12">
                                            <p class="text-sm font-semibold">Total Items :</p>
                                            <p class="text-xs italic text-gray-500">This is the total number of items across all packages.</p>
                                            <div class="flex items-center justify-center w-full p-4 gap-2">
                                                <h1 class="font-bold" id="total_items_id">0</h1>
                                                <p>Items</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-12 gap-2 py-2">
                                        <div class="md:col-span-6 col-span-12">
                                            <label for="price_per_item_id" class="text-sm font-semibold">Price per Item</label>
                                            <input type="number" name="price_per_item" id="price_per_item_id" placeholder="e.g 100" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none hover:border-sky-400 focus:ring-0 focus:border-sky-400" required />

                                        </div>
                                        <div class="md:col-span-6 col-span-12">
                                            <label for="total_price_id" class="text-sm font-semibold">Total Amount</label>
                                            <div class="flex items-center ">
                                                <i data-lucide="philippine-peso" class="w-5 h-5 "></i>
                                                <input type="text" name="total_price" id="total_price_id" value="0.0" class="w-full p-2 border-none focus:ring-0 focus:border-none focus:outline-none" readonly />

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-12">
                                        <label for="supplier" class="text-sm font-semibold">Supplier</label>
                                        <input type="text" name="supplier" id="supplier" placeholder="e.g ABC Supplies" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none hover:border-sky-400 focus:ring-0 focus:border-sky-400" />
                                    </div>
                                </div>
                                <div class="col-span-12 flex items-center justify-end gap-2">
                                    <button type="submit" id="submitSuppliesBtn" class="bg-sky-500 text-white px-4 py-2 rounded-lg">Add New Supplies</button>
                                    <button type="button" onclick="document.getElementById('AddNewSupplies').close()"
                                        class="px-6 py-2 bg-gray-100 text-gray-500 rounded-lg text-md ">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </dialog>

                    <!-- livewire/patient-table.php -->
                    <livewire:inventory-records-table />
                </div>
            </div>
        </section>


        <!-- Modals For Logout -->
        <x-logout-modal />
</body>

<script>
    const submitSuppliesBtn = document.getElementById("submitSuppliesBtn");
    document.getElementById('addSuppliesForm').addEventListener('submit', function() {
        submitSuppliesBtn.disabled = true;
        submitSuppliesBtn.innerHTML = `
            <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
            </svg>
            <span>Loading...</span>
        `;

    });

    document.addEventListener('DOMContentLoaded', function() {
        // Elements for item/package calculation
        const itemsPerPackage = document.getElementById('items_per_package_id');
        const packagesReceived = document.getElementById('package_received_id');
        const totalItemsEl = document.getElementById('total_items_id');

        // Elements for price calculation
        const pricePerItemEl = document.getElementById('price_per_item_id');
        const totalPriceEl = document.getElementById('total_price_id');

        // Calculate total items
        function updateTotalItems() {
            const items = Number(itemsPerPackage.value) || 0;
            const packages = Number(packagesReceived.value) || 0;
            totalItemsEl.textContent = items * packages;

            // Also update total price whenever total items changes
            updateTotalPrice();
        }

        // Calculate total price
        function updateTotalPrice() {
            const items = Number(totalItemsEl.textContent) || 0;
            const price = Number(pricePerItemEl.value) || 0;
            const total = items * price;

            totalPriceEl.value = total.toLocaleString();
        }

        // Listen for Alpine dropdown changes
        document.addEventListener('package-changed', function(e) {
            const selected = e.detail;

            if (selected === 'Vial' || selected === 'Piece') {
                itemsPerPackage.value = 1;
                itemsPerPackage.readOnly = true; // note the capital "O"
            } else {
                itemsPerPackage.value = '';
                itemsPerPackage.readOnly = false; // note the capital "O"

                packagesReceived.value = '';
                totalItemsEl.textContent = '0';
                pricePerItemEl.value = '';
            }

            updateTotalItems();
        });

        // Update total whenever inputs change
        itemsPerPackage.addEventListener('input', updateTotalItems);
        packagesReceived.addEventListener('input', updateTotalItems);
        pricePerItemEl.addEventListener('input', updateTotalPrice);

        // Initial calculation
        updateTotalItems();
        updateTotalPrice();
    });
</script>





</html>