<div class="flex flex-col col-span-4 gap-2 relative pb-12">
    <div class="overflow-hidden">
        <div class="flex flex-row md:justify-between gap-2 p-2">
            <!-- per page dropdown -->
            <div class="flex ">
                <div class="flex gap-4 items-center">
                    <div
                        x-data="{ open: false, selected: @entangle('perPage') }"
                        class=" w-16">
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
                    <label class="text-sm font-medium text-gray-900 md:block hidden">
                        entries per page
                    </label>
                </div>
            </div>

            <!-- search bar -->
            <div class="flex  w-full md:w-1/4">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center px-2 py-4 pointer-events-none">
                        <img src="{{ asset('images/search.svg') }}" alt="Search Icon" class="w-5 h-5 " />
                    </div>
                    <input
                        wire:model.live.debounce.300ms="search"
                        type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full h-full pl-12 p-2 "
                        placeholder="Search" required="">
                </div>
            </div>
        </div>
    </div>
    <!-- table with overflow -->
    <div class="overflow-x-auto md:overflow-hidden">
        <!-- <div class="grid grid-cols-12 gap-2  text-white bg-gray-800 rounded text-sm">
            <div class="col-span-1 flex items-center justify-center" wire:click="setSortBy('id')">ID</div>
            <div class="col-span-1 flex items-center justify-center" wire:click="setSortBy('brand_name')">Brand Name</div>
            <div class="col-span-1 flex items-center justify-center" wire:click="setSortBy('category')">Category</div>
            <div class="col-span-2 p-2 flex flex-col gap-1" wire:click="setSortBy('item_type')">
                <div class="flex items-center justify-center ">Type</div>
                <div class="border-b-2 border-gray-100"></div>
                <div class="grid grid-cols-2">
                    <div class="col-span-1 flex items-center justify-center" wire:click="setSortBy('product_type')">Product</div>
                    <div class="col-span-1 flex items-center justify-center" wire:click="setSortBy('immunity_type')">Immunity</div>
                </div>
            </div>
            <div class="col-span-1 flex items-center justify-center" wire:click="setSortBy('unit')">Unit</div>
            <div class="col-span-3 p-2 flex flex-col gap-1 ">
                <div class="flex items-center justify-center">Per Unit</div>
                <div class="border-b-2 border-gray-100"></div>
                <div class="grid grid-cols-3">
                    <div class="col-span-1 flex items-center justify-center">Volume</div>
                    <div class="col-span-1 flex items-center justify-center">Used</div>
                    <div class="col-span-1 flex items-center justify-center">Remaining</div>
                </div>
            </div>
            <div class="col-span-1 flex items-center justify-center">Stock</div>
            <div class="col-span-1 flex items-center justify-center" wire:click="setSortBy('status')">Status</div>
            <div class="col-span-1 flex items-center justify-center">Details</div>
        </div>
    </div> -->

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
                        <th scope="col" class="px-6 md:px-2 py-4 text-center hidden md:table-cell">Restock Date</th>
                        <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer" wire:click="setSortBy('stock_status')">Status</th>
                        <th scope="col" class="px-6 md:px-2 py-4 text-center rounded-">Details</th>
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
                        <span class="text-green-500 font-bold p-2 rounded bg-green-100">{{ $supply->category }}</span>
                        @elseif (strtolower($supply->category) === 'rig')
                        <span class="text-red-500 font-bold p-2 rounded bg-red-100">{{ $supply->category }}</span>
                        @elseif (strtolower($supply->category) === 'equipment')
                        <span class="text-yellow-500 p-2 rounded bg-yellow-100">{{ $supply->category }}</span>
                        @endif
                        </td>
                        <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900">{{ $supply->brand_name }}</td>
                        <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900 ">{{ $supply->product_type }}</td>
                        <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900 hidden md:table-cell">{{ $supply->immunity_type ? :'n/a' }}</td>
                        <td class="text-center font-medium text-gray-900 hidden md:table-cell ">{{ $supply->total_units}}</td>
                        <td class="text-center font-medium text-gray-900 hidden md:table-cell ">{{ $supply->total_unit_remaining}}</td>
                        <td class="text-center font-medium text-gray-900 hidden md:table-cell ">{{ $supply->last_restocked_date}}</td>
                        <td class="px-6 md:px-2 py-4 text-center font-bold text-gray-900">
                        @if(strtolower($supply->stock_status) === 'in stock') <span class="text-green-500 p-2 rounded bg-green-100">{{ $supply->stock_status }}</span>
                        @else <span class="text-gray-700">{{ $supply->stock_status }}</span>
                        @endif
                        </td>
                        <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900">
                            <a href="#" class="text-blue-500 flex items-center  justify-center gap-1 font-semibold">
                                View <img src="{{asset('images/file-text.svg')}}" alt="Supply Details"></a>
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
    </div>