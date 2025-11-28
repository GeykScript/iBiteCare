<div class="overflow-x-auto">
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
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md
                                    focus:ring-gray-500 focus:border-gray-800 block w-full px-2 py-1.5
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
                                class="cursor-pointer px-4 py-1.5 text-sm text-gray-700 hover:bg-gray-800 hover:text-white transition"
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

    
    <table class="min-w-full  text-sm mt-2 ">
        <thead class="bg-gray-100">
            <tr>
                <th class="border-r border-b bg-gray-800 text-white px-2 py-1 hover:cursor-pointer rounded-tl-lg" wire:click="setSortBy('id')">Stock #</th>
                <th class="border bg-gray-800 text-white px-2 py-1">Package</th>
                <th class="border bg-gray-800 text-white px-2 py-1">Items Per Package</th>
                <th class="border bg-gray-800 text-white px-2 py-1">Total Items</th>
                <th class="border bg-gray-800 text-white px-2 py-1">Remaining Items</th>
                <th class="border bg-gray-800 text-white px-2 py-1 hover:cursor-pointer" wire:click="setSortBy('total_package_amount')">Package Amount</th>
                <th class="border bg-gray-800 text-white px-2 py-1 hover:cursor-pointer" wire:click="setSortBy('restock_date')">Restock Date</th>
                <th class="border-l border-b bg-gray-800 text-white px-2 py-1 hover:cursor-pointer rounded-tr-lg" wire:click="setSortBy('supplier')">Supplier</th>
            </tr>
        </thead>
        <tbody>
            @if($inventoryStocks->isEmpty())
            <tr class="table-row sm:hidden">
                <td colspan="5" class="text-center py-4">No Supply Records found.</td>
            </tr>
            <tr class="hidden sm:table-row">
                <td colspan="13" class="text-center py-4">No Supply Records found.</td>
            </tr>
            @else
            @foreach($inventoryStocks as $stock)
            <tr>
                <td class="border-b px-2 py-2 text-gray-700">{{ $stock->id }}</td>
                <td class="border px-2 py-2 text-gray-700">{{ $stock->packages_received }} {{ $stock->package_type }}</td>
                <td class="border px-2 py-2 text-gray-700">{{ $stock->items_per_package }} {{$stock->unit_type}}</td>
                <td class="border px-2 py-2 text-gray-700">{{ $stock->total_units }} {{ $stock->unit_type }}</td>
                <td class="border px-2 py-2 text-gray-700">{{ $stock->total_remaining_units }} {{ $stock->unit_type }}</td>
                <td class="border px-2 py-2 text-gray-700 "><span class="flex items-center "><img src="{{asset('images/philippine-peso.svg')}}" alt="Peso logo" class="w-3 h-3">{{ $stock->total_package_amount }}</span> </td>
                <td class="border px-2 py-2 text-gray-700">{{ \Carbon\Carbon::parse($stock->restock_date)->format('M d, Y h:i A') }}</td>
                <td class="border-b px-2 py-2 text-gray-700">{{ $stock->supplier }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <!-- table pagination -->
    <div class="px-3 mt-5">
        {{ $inventoryStocks->appends(['perPage' => $perPage])->links() }}
    </div>
</div>