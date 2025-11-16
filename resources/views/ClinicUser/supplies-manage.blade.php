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
                    <li><a href="{{ route('clinic.appointments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="notebook-pen" class="w-5 h-5"></i>Appointments</a></li>
                    <li><a href="{{ route('clinic.messages') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="message-square-text" class="w-5 h-5"></i>Messages</a></li>

                    <p class="text-xs font-bold text-gray-400 my-1 uppercase">Clinic Management</p>
                    <li><a href="{{route('clinic.supplies')}}" class="block px-4 py-2 rounded bg-gray-900 text-white flex items-center gap-3"><i data-lucide="package" class="w-5 h-5"></i>Inventory</a></li>
                    <li><a href="{{ route('clinic.transactions')}}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="file-text" class="w-5 h-5"></i>Transactions</a></li>
                    <li><a href="{{ route('clinic.payments') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="philippine-peso" class="w-5 h-5"></i>Payments </a></li>
                    <li><a href="{{ route('clinic.services') }}" class="block px-4 py-2 rounded hover:bg-gray-900 hover:text-white flex items-center gap-3"><i data-lucide="briefcase-medical" class="w-5 h-5"></i>Services</a></li>

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
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-2">
                            <h1 class="text-xl md:text-3xl font-900">Inventory Supplies</h1>
                            <a href="{{ route('clinic.user-manual') }}#view-supplies" target="_blank" class="text-[#FF000D]"> <i data-lucide="circle-question-mark" class="w-5 h-5"></i></a>

                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('clinic.supplies') }}" class="font-bold hover:text-red-500 hover:underline underline-offset-4">Inventory </a>
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            <p class="font-bold text-red-500">Details</p>
                        </div>

                    </div>
                </div>


                <div class="grid grid-cols-12">
                    <div class="col-span-3 md:col-span-1 flex items-center justify-center">
                        <a href="{{ route('clinic.supplies') }}" class="text-blue-500 hover:underline flex items-center underline-offset-4 font-bold"><i data-lucide="chevron-left" class="w-5 h-5"></i>Back</a>
                    </div>
                </div>



                <!-- Main Content -->
                <div class="grid grid-cols-4 p-4  md:px-10 gap-2 ">
                    <div class="col-span-4 md:col-span-4 px-2">
                        <div class="col-span-4 border-2 border-gray-50 mt-2 mb-2"></div>

                        <div class="flex items-center gap-2">
                            <h1 class="font-900 text-lg">Product Information</h1>
                            <button
                                onclick="document.getElementById('EditProduct').showModal()"
                                class="text-red-600 px-4 py-2 rounded-lg flex items-center gap-1 focus:outline-none font-900 hover:text-red-500">
                                <i data-lucide="square-pen" class="w-5 h-5" stroke-width="3"></i>Edit</button>
                        </div>
                        @if (session('edit-success'))
                        <div
                            x-data="{ show: true }"
                            x-show="show"
                            class="w-full bg-green-100 border-2 rounded border-green-200 flex justify-between py-2 px-4 ">
                            <h1 class="text-md font-bold text-green-600">{{ session('edit-success') }}</h1>
                            <button @click="show = false" class="text-lg font-bold text-green-600">
                                <i data-lucide="x"></i>
                            </button>
                        </div>
                        @endif
                        <div class="grid grid-cols-8 gap-2 py-2">
                            <div class="md:col-span-2 col-span-4">
                                <p class="text-sm font-semibold text-gray-600">Product Name</p>
                                <h1 class="text-gray-800 font-bold text-lg">{{ $inventoryItem->brand_name }}</h1>
                            </div>
                            <div class="md:col-span-2 col-span-4">
                                <p class="text-sm font-semibold text-gray-600">Category</p>
                                <h1 class="text-gray-800 font-bold text-lg">{{ $inventoryItem->category }}</h1>
                            </div>
                            <div class="md:col-span-2 col-span-4">
                                <p class="text-sm font-semibold text-gray-600">Product Type</p>
                                <h1 class="text-gray-800 font-bold text-lg">{{ $inventoryItem->product_type }}</h1>
                            </div>
                            <div class="md:col-span-2 col-span-4">
                                <p class="text-sm font-semibold text-gray-600">Immunity Type</p>
                                <h1 class="text-gray-800 font-bold text-lg">{{ $inventoryItem->immunity_type ?? 'N/A' }}</h1>
                            </div>
                        </div>
                        <div class="col-span-4 border-2 border-gray-50 mt-2 mb-2"></div>


                        <div class="flex items-center gap-2 ">
                            <h1 class="font-900 text-lg">Stocks Details</h1>
                        </div>
                        <div class="col-span-8 grid grid-cols-8 gap-2 mt-2">
                            <div class="md:col-span-1 col-span-4">
                                <p class="text-sm font-semibold text-gray-600">Total Stocks</p>
                                <p class="text-gray-800 font-bold text-lg">{{ $inventoryRecords->total_units ?? '0' }} </p>
                            </div>
                            <div class="md:col-span-1 col-span-4">
                                <p class="text-sm font-semibold text-gray-600">Remaining Stocks</p>
                                <p class="text-gray-800 font-bold text-lg">{{ $inventoryRecords->total_unit_remaining ?? '0' }} </p>
                            </div>
                            <div class="md:col-span-1 col-span-8">
                                <p class="text-sm font-semibold text-gray-600">Status</p>

                                @if(strtolower($inventoryRecords->stock_status) === 'in stock')
                                <p class="text-green-500 font-bold text-lg">{{ $inventoryRecords->stock_status }} </p>
                                @elseif(strtolower($inventoryRecords->stock_status) === 'out of stock')
                                <p class="text-red-500 font-bold text-lg">{{ $inventoryRecords->stock_status }} </p>
                                @elseif(strtolower($inventoryRecords->stock_status) === 'low stock')
                                <p class="text-yellow-500 font-bold text-lg">{{ $inventoryRecords->stock_status }} </p>
                                @endif
                            </div>
                            <div class="md:col-span-2 col-span-8">
                                <p class="text-sm font-semibold text-gray-600">Last Restocked Date</p>
                                <p class="text-gray-800 font-bold text-md pt-1 ">{{ \Carbon\Carbon::parse($inventoryRecords->last_restocked_date)->format('M d, Y h:i A') }} </p>
                            </div>
                            <div class="md:col-span-2 col-span-8 flex items-center ">
                                <button
                                    onclick="document.getElementById('AddNewStocks').showModal()"
                                    class="bg-red-600 text-white px-7 py-2 rounded-lg flex items-center gap-3 focus:outline-none hover:bg-red-500">
                                    <i data-lucide="plus" class="w-5 h-5"></i>Add New Stock</button>
                            </div>
                        </div>

                        <div class="col-span-4 border-2 border-gray-50 my-4"></div>

                        <div class="col-span-4 flex flex-col mt-2">
                            <div class="flex items-center justify-center gap-4 w-full">
                                <div class="flex items-center p-4 rounded-full bg-gray-800">
                                    <i data-lucide="file-box" class="w-6 h-6 text-white"></i>
                                </div>
                                <div class="flex flex-col items-start justify-start">
                                    <h1 class="font-900 text-md">Stocks History</h1>
                                    <p class="text-gray-600">View the history of stocks.</p>
                                </div>
                            </div>

                            <!-- LIVEWIRE INVENTORY STOCKS TABLE -->
                            <livewire:inventory-stocks :item-id=" $inventoryItem->id" />
                        </div>


                        <div class="col-span-4 border-2 border-gray-50 my-4"></div>

                        <div class="flex items-center justify-center gap-4">
                            <div class="flex items-center p-4 rounded-full bg-sky-600">
                                <i data-lucide="stretch-horizontal" class="w-6 h-6 text-white"></i>
                            </div>
                            <div class="flex flex-col items-start justify-start">
                                <h1 class="font-900 text-md">Items Details</h1>
                                <p class="text-gray-600">View the details each item.</p>
                            </div>
                        </div>

                        <div class="col-span-4 flex flex-col mt-2">

                            <!-- LIVEWIRE INVENTORY ITEMS TABLE  -->
                            <livewire:inventory-items :item-id="$inventoryItem->id" />
                        </div>

                        <!-- start of dialog/ modal codes  -->

                        <!-- edit product modal  -->
                        <dialog id="EditProduct" class="p-8 rounded-lg shadow-lg w-full max-w-5xl backdrop:bg-black/50 focus:outline-none ">
                            <!-- close modal button  -->
                            <div class="w-full flex justify-end mb-5">
                                <button onclick="document.getElementById('EditProduct').close()" class="focus:outline-none"><i data-lucide="x" class="w-5 h-5"></i></button>
                            </div>

                            <!-- create new user form  -->
                            <form action="{{route('clinic.supplies.manage.edit')}}" method="POST" id="editProductForm">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-12 md:px-8 gap-2 flex flex-col items-center justify-center ">

                                    <div class="col-span-12 flex flex-col items-center justify-center">
                                        <h1 class="font-900 md:text-2xl text-xl">Update Product Details</h1>
                                        <p>Fill out the form below to update product details. All fields are required.</p>
                                    </div>
                                    <!-- divider border  -->
                                    <div class="col-span-12 border-2 border-gray-100 mt-2 mb-2"></div>
                                    <div class="col-span-12">
                                        <h1 class="font-900 text-md">Product Information</h1>
                                        <p class="text-gray-600 px-2">Please provide the following information about the product.</p>

                                        <input type="hidden" name="item_id" value="{{ $inventoryItem->id }}">

                                        <div class="grid grid-cols-12 gap-2 py-2">
                                            <div class="md:col-span-6 col-span-12">
                                                <p class="text-sm font-semibold mb-1">Category</p>
                                                <p class="w-full p-2 border border-gray-50 rounded-lg focus:outline-none focus:border-none focus:ring-0   bg-gray-50">{{ $inventoryItem->category }}</p>
                                            </div>

                                            <div class="md:col-span-6 col-span-12">
                                                <label for="product_type" class="text-sm font-semibold">Product Type</label>
                                                <input type="text" name="product_type" id="product_type" placeholder="e.g PVRV, ERIG, syringe, etc."
                                                    pattern="[A-Za-z]+"
                                                    value="{{ $inventoryItem->product_type }}"
                                                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none hover:border-sky-400 focus:ring-0 focus:border-sky-400" required />
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-12 gap-4 py-2">
                                            <div class="md:col-span-6 col-span-12 flex flex-col justify-end gap-2">
                                                <label for="brand_name" class="text-sm font-semibold">Product Name</label>
                                                <input type="text" name="brand_name" id="brand_name" placeholder="Brand Name"
                                                    pattern="[A-Za-z0-9 ]+"
                                                    value="{{ $inventoryItem->brand_name }}"
                                                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none hover:border-sky-400 focus:ring-0 focus:border-sky-400 h-12" required />
                                            </div>
                                            <div class="md:col-span-6 col-span-12 gap-2">
                                                <h1 class="text-sm font-semibold">Immunity Type</h1>
                                                <p class="text-xs italic my-2 text-gray-600">Select the immunity type if this is a vaccine or RIG. Choose "None" for other items.</p>
                                                <div class="flex items-center gap-4">
                                                    <!-- none -->
                                                    <label class="flex items-center space-x-2">
                                                        <input type="radio"
                                                            name="immunity_type"
                                                            value=""
                                                            class="text-red-500 focus:ring-red-500"
                                                            required
                                                            {{ $inventoryItem->immunity_type == '' ? 'checked' : '' }}>
                                                        <span>None</span>
                                                    </label>

                                                    <!-- Active -->
                                                    <label class="flex items-center space-x-2">
                                                        <input type="radio"
                                                            name="immunity_type"
                                                            value="Active"
                                                            class="text-green-600 focus:ring-green-600"
                                                            {{ $inventoryItem->immunity_type == 'Active' ? 'checked' : '' }}>
                                                        <span>Active</span>
                                                    </label>

                                                    <!-- Passive -->
                                                    <label class="flex items-center space-x-2">
                                                        <input type="radio"
                                                            name="immunity_type"
                                                            value="Passive"
                                                            class="text-sky-600 focus:ring-sky-600"
                                                            {{ $inventoryItem->immunity_type == 'Passive' ? 'checked' : '' }}>
                                                        <span>Passive</span>
                                                    </label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- divider border  -->
                                    <div class="col-span-12 border-2 border-gray-100 mt-2 mb-2"></div>
                                    <div class="col-span-12 flex items-center justify-end gap-2">
                                        <button type="submit" id="submitEditBtn" class="bg-sky-500 text-white px-4 py-2 rounded-lg hover:bg-sky-600">Save Changes</button>
                                        <button type="button" onclick="document.getElementById('EditProduct').close()"
                                            class="px-6 py-2 bg-gray-100 text-gray-500 rounded-lg text-md hover:bg-gray-200">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </dialog>

                        <!-- add new stocks modal  -->
                        <dialog id="AddNewStocks" class="p-8 rounded-lg shadow-lg w-full max-w-5xl backdrop:bg-black/50 focus:outline-none ">
                            <!-- close modal button  -->
                            <div class="w-full flex justify-end mb-5">
                                <button onclick="document.getElementById('AddNewStocks').close()" class="focus:outline-none"><i data-lucide="x" class="w-5 h-5"></i></button>
                            </div>

                            <!-- create new user form  -->
                            <form action="{{ route('clinic.supplies.manage.add') }}" method="POST" id="addNewStocksForm">
                                @csrf
                                <div class="grid grid-cols-12 md:px-8 gap-2 flex flex-col items-center justify-center ">

                                    <div class="col-span-12 flex flex-col items-center justify-center">
                                        <h1 class="font-900 md:text-2xl text-xl">Add New Stock</h1>
                                        <p>Fill out the form below to add new stock. All fields are required.</p>
                                    </div>
                                    <input type="hidden" name="item_id" value="{{ $inventoryItem->id }}">
                                    <input type="hidden" name="category" value="{{ $inventoryItem->category }}">
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
                                        <button type="submit" id="submitStocksBtn" class="bg-sky-500 text-white px-4 py-2 rounded-lg hover:bg-sky-400">Add Supplies</button>
                                        <button type="button" onclick="document.getElementById('AddNewStocks').close()"
                                            class="px-6 py-2 bg-gray-100 text-gray-500 rounded-lg text-md hover:bg-gray-200">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </dialog>

                        <!-- update inventory item modal -->
                        <dialog id="updateInventoryItemModal"
                            x-data="{
                                        item: {
                                            id: '', stock_id: '', item_id: '', quantity: '', remaining: '', price: '', status: ''
                                        },
                                        open() { this.$refs.modal.showModal() },
                                        close() { this.$refs.modal.close() }
                                    }"
                            x-ref="modal"
                            @update-item-modal.window="item = $event.detail; open()"
                            class="p-8 rounded-lg shadow-lg w-full max-w-lg backdrop:bg-black/50 focus:outline-none">

                            <!-- Close button -->
                            <div class="w-full flex justify-end">
                                <button @click="close()" class="focus:outline-none">
                                    <i data-lucide="x" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <!-- Form -->
                            <form action="{{route('clinic.supplies.manage.edit.quantity')}}" method="POST" id="updateItemForm"
                                x-data="{ loading: false }"
                                x-on:submit="loading = true">
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-12 md:px-8 gap-2 flex flex-col items-center justify-center">
                                    <div class="col-span-12 flex flex-col items-center justify-center">
                                        <h1 class="font-900 md:text-2xl text-xl">Edit Item</h1>
                                        <p>Fill out the form below to edit item details. </p>
                                    </div>

                                    <div class="col-span-12 flex flex-col items-center justify-center">
                                        <input type="hidden" name="id" x-model="item.id">
                                        <input type="hidden" name="stock_id" x-model="item.stock_id">
                                        <input type="hidden" name="item_id" x-model="item.item_id">
                                    </div>
                                    <div class="col-span-12 flex flex-col">
                                        <p class="block text-sm font-medium">Quantity</p>
                                        <p class="text-xs text-gray-500">(Leave unchanged if no update is needed)</p>
                                        <input type="number" name="quantity" x-model="item.quantity"
                                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none hover:border-sky-400 focus:ring-0 focus:border-sky-400">
                                    </div>

                                    <div class="col-span-12 flex flex-col">
                                        <p class="block text-sm font-medium">Remaining Quantity</p>
                                        <p class="text-xs text-gray-500">(Leave unchanged if no update is needed)</p>
                                        <input type="number" name="remaining_quantity" x-model="item.remaining"
                                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none hover:border-sky-400 focus:ring-0 focus:border-sky-400">
                                    </div>



                                    <div class="col-span-12 flex justify-end space-x-2">
                                        <button type="button" @click="close()" class="px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">Cancel</button>
                                        <button
                                            type="submit"
                                            :disabled="loading"
                                            class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-2 rounded-lg flex items-center justify-center">
                                            <!-- Spinner -->
                                            <svg x-show="loading" x-cloak aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB" />
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor" />
                                            </svg>
                                            <span x-show="!loading" x-cloak>Save Changes</span>
                                            <span x-show="loading" x-cloak>Loading...</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </dialog>

                        <!-- end  of all modals code -->


                    </div>
                </div>
        </section>


        <!-- Modals For Logout -->
        <x-logout-modal />
</body>

<script>
    const submitEditBtn = document.getElementById("submitEditBtn");
    document.getElementById('editProductForm').addEventListener('submit', function() {
        submitEditBtn.disabled = true;
        submitEditBtn.innerHTML = `
            <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
            </svg>
            <span>Loading...</span>
        `;

    });
    const submitStocksBtn = document.getElementById("submitStocksBtn");
    document.getElementById('addNewStocksForm').addEventListener('submit', function() {
        submitStocksBtn.disabled = true;
        submitStocksBtn.innerHTML = `
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