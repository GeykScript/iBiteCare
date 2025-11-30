<div class="flex flex-col col-span-4 gap-2 relative pb-12">
    <div class="overflow-hidden">
        <div class="grid grid-cols-12 gap-6 p-2 ">
            <!-- per page dropdown -->
            <div class="col-span-12 l:col-span-9 flex items-center justify-between  gap-4">
                <div class="flex gap-4 items-center">
                    <div
                        x-data="{ open: false, selected: @entangle('perPage') }"
                        class=" w-16 ">
                        <!-- Dropdown button -->
                        <button
                            @click="open = !open"
                            type="button"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                    focus:ring-gray-500 focus:border-gray-800 block w-full p-2.5 
                                    flex justify-between items-center">
                            <span x-text="selected"></span>
                            <img src="{{ asset('images/chevron-down.svg') }}" alt="chevron-down" class="w-4 h-4">
                        </button>
                        <!-- Dropdown menu -->
                        <ul
                            x-show="open"
                            @click.outside="open = false"
                            x-cloak
                            class="absolute w-16 mt-1  bg-white border border-gray-300 rounded-lg shadow-lg">
                            @foreach ([5, 10, 20, 50, 100] as $value)
                            <li
                                @click="selected = {{ $value }}; $wire.set('perPage', {{ $value }}); open = false"
                                class="cursor-pointer px-4 py-2 text-sm text-gray-700 hover:bg-gray-800 hover:text-white transition"
                                :class="{ 'bg-gray-800 text-white': selected == {{ $value }} }">
                                {{ $value }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Label -->
                    <p class="text-sm font-medium text-gray-900 md:block hidden">
                        entries per page
                    </p>
                </div>
                <div class="l:col-span-4 col-span-12 grid grid-cols-7 gap-2 h-full">
                    <!-- Date Filter Section -->
                    <div class="col-span-7 flex flex-wrap items-center justify-start l:justify-center  gap-2 px-2 ">
                        <span class="text-sm font-medium text-gray-700">Date:</span>

                        <input
                            wire:model.live="dateFrom"
                            type="date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-sky-500 focus:border-sky-500 px-2 py-1.5 w-auto">

                        <span class="text-xs text-gray-500">to</span>

                        <input
                            wire:model.live="dateTo"
                            type="date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-sky-500 focus:border-sky-500 px-2 py-1.5 w-auto">

                        @if($dateFrom || $dateTo)
                        <button
                            wire:click="clearDateFilter"
                            class="px-2 py-1 text-sm font-medium text-white bg-sky-500 hover:bg-sky-400 rounded-md transition">
                            Clear
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-span-12 l:col-span-3 grid grid-cols-7 gap-2 ">
                <div class="col-span-7 flex items-center ">
                    <div class="w-full">
                        <div class="flex items-center bg-gray-50 border border-gray-300 rounded-lg px-3 focus-within:ring-1 focus-within:ring-sky-500 focus-within:border-sky-500 transition">
                            <img src="{{ asset('images/search.svg') }}" alt="Search Icon" class="w-5 h-5 text-gray-500" />
                            <input
                                wire:model.live.debounce.300ms="search"
                                type="text"
                                name="search"
                                class="flex-1 bg-transparent border-none focus:outline-none focus:ring-0 text-sm text-gray-900"
                                placeholder="Search"
                                required />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- successfull modal  -->
    @if(session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 md:z-50">
        <div class="bg-white rounded-xl shadow-lg w-11/12 max-w-md p-6 flex flex-col items-center gap-4" @click.outside="show = false">
            <div class="p-2 rounded-full border-green-100 border-2 bg-green-100">
                <div class="p-2 rounded-full border-green-300 border-2 bg-green-300">
                    <div class="p-4 rounded-full bg-green-500">
                        <i data-lucide="check" class="text-white w-14 h-14 "></i>
                    </div>
                </div>
            </div>
            <h2 class="text-xl font-bold text-gray-700">{{ session('success') }}</h2>
            <div class="flex justify-end items-end w-full">
                <button
                    @click="show = false"
                    class="mt-4 text-white text-sm bg-gray-700 font-semibold py-2 px-4 rounded-lg">
                    Close
                </button>
            </div>
        </div>
    </div>
    @endif



    <!-- table with overflow -->
    <div class="overflow-x-auto md:overflow-hidden">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
            <thead class="text-md text-white  bg-gray-800 ">
                <tr class="px-4">
                    <th scope="col" class="px-6 md:px-2 py-4 text-center rounded-l-lg hover:cursor-pointer hover:text-gray-200" wire:click="setSortBy('id')">ID</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer hover:text-gray-200" wire:click="setSortBy('category')">Category</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer hover:text-gray-200" wire:click="setSortBy('brand_name')">Brand Name</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer hover:text-gray-200" wire:click="setSortBy('product_type')">Product Type</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer hover:text-gray-200  hidden md:table-cell" wire:click="setSortBy('immunity_type')">Immunity Type</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center  hidden md:table-cell">Total Unit</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center  hidden md:table-cell">Remaining</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hidden md:table-cell hover:cursor-pointer" wire:click="setSortBy('last_restocked_date')">Restock Date</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer" wire:click="setSortBy('stock_status')">Status</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center rounded-r-lg">Details</th>
                </tr>
            </thead>
            <tbody>
                @if($supplies->isEmpty())
                <tr class="table-row sm:hidden">
                    <td colspan="5" class="text-center py-4">No Supply Records found.</td>
                </tr>
                <tr class="hidden sm:table-row">
                    <td colspan="13" class="text-center py-4">No Supply Records found.</td>
                </tr>
                @else
                @foreach ($supplies as $supply)
                <tr wire:key="{{ $supply->id }}" class="border-b dark:border-gray-700">
                    <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900">{{ $supply->id }}</td>
                    <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900">
                        @if (strtolower($supply->category) === 'vaccine')
                        <span class="text-blue-500 font-bold p-2 rounded bg-blue-100">{{ $supply->category }}</span>
                        @elseif (strtolower($supply->category) === 'supply')
                        <span class="text-orange-500 font-bold p-2 rounded bg-orange-100">{{ $supply->category }}</span>
                        @elseif (strtolower($supply->category) === 'anti-tetanus')
                        <span class="text-yellow-500 font-bold p-2 rounded bg-yellow-100">{{ $supply->category }}</span>
                        @elseif (strtolower($supply->category) === 'booster')
                        <span class="text-green-500 font-bold p-2 rounded bg-green-100">{{ $supply->category }}</span>
                        @elseif (strtolower($supply->category) === 'rig')
                        <span class="text-red-500 font-bold p-2 rounded bg-red-100">{{ $supply->category }}</span>
                        @elseif (strtolower($supply->category) === 'equipment')
                        <span class="text-stone-500 p-2 rounded bg-stone-100">{{ $supply->category }}</span>
                        @endif
                    </td>
                    <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900">{{ $supply->brand_name }}</td>
                    <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900 ">{{ $supply->product_type }}</td>
                    <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900 hidden md:table-cell">{{ $supply->immunity_type ? :'n/a' }}</td>
                    <td class="text-center font-medium text-gray-900 hidden md:table-cell ">{{ $supply->total_units}}</td>
                    <td class="text-center font-medium text-gray-900 hidden md:table-cell ">{{ $supply->total_unit_remaining}}</td>
                    <td class="text-center font-medium text-gray-900 hidden md:table-cell">
                        {{ \Carbon\Carbon::parse($supply->last_restocked_date)->format('M d, Y h:i A') }}
                    </td>
                    <td class="px-6 md:px-2 py-4 text-center font-bold text-gray-900">
                        @if(strtolower($supply->stock_status) === 'in stock') <span class="text-green-500 p-2 rounded bg-green-100">{{ $supply->stock_status }}</span>
                        @elseif(strtolower($supply->stock_status) === 'out of stock') <span class="text-red-500 p-2 rounded bg-red-100">{{ $supply->stock_status }}</span>
                        @elseif(strtolower($supply->stock_status) === 'low stock') <span class="text-yellow-500 p-2 rounded bg-yellow-100">{{ $supply->stock_status }}</span>
                        @endif
                    </td>
                    <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900">
                        <a href="{{ route('clinic.supplies.manage', Crypt::encrypt($supply->id)) }}" class="text-blue-500  hover:underline underline-offset-8 flex items-center  justify-center gap-1 font-semibold">
                            View <img src="{{asset('images/file-text.svg')}}" alt="Supply Details" class="w-4 h-4"></a>
                    </td>

                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <!-- table pagination -->
    <div class=" px-3 mt-5">
        {{ $supplies->appends(['perPage' => $perPage])->links() }}

    </div>