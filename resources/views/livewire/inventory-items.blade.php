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
        </div>
    </div>
    @if (session('remove-success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        class="w-full bg-green-100 border-2 rounded border-green-200 flex justify-between py-2 px-4 ">
        <h1 class="text-md font-bold text-green-600">{{ session('remove-success') }}</h1>
        <button @click="show = false" class="text-lg font-bold text-green-600">
            <i data-lucide="x"></i>
        </button>
    </div>
    @endif
    <table class="min-w-full border border-gray-300 text-sm mt-2">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-2 py-1 hover:cursor-pointer" wire:click="setSortBy('id')">ID</th>
                <th class="border px-2 py-1">Name</th>
                <th class="border px-2 py-1">Stock No.</th>
                <th class="border px-2 py-1">Package No.</th>
                <th class="border px-2 py-1 hover:cursor-pointer" wire:click="setSortBy('unit_number')">Unit No.</th>
                @php
                $category = $column->item->category ?? 'Other';
                @endphp
                @if($category === 'Supply' || $category === 'Equipment')
                <th class="border px-2 py-1">Quantity</th>
                <th class="border px-2 py-1">Remaining</th>
                @else
                <th class="border px-2 py-1">Volume</th>
                <th class="border px-2 py-1">Remaining</th>
                @endif
                <th class="border px-2 py-1 hover:cursor-pointer" wire:click="setSortBy('unit_price')">Price</th>
                <th class="border px-2 py-1 hover:cursor-pointer" wire:click="setSortBy('status')">Status</th>
                <th class="border px-2 py-1">Action </th>

            </tr>
        </thead>
        <tbody>
            @if($inventoryItems->isEmpty())
            <tr class="table-row sm:hidden">
                <td colspan="5" class="text-center py-4">No Supply Records found.</td>
            </tr>
            <tr class="hidden sm:table-row">
                <td colspan="13" class="text-center py-4">No Supply Records found.</td>
            </tr>
            @else
            @foreach($inventoryItems as $item)
            <tr wire:key="{{ $item->id }}">
                <td class="border px-2 py-1 text-gray-700">{{ $item->id }}</td>
                <td class="border px-2 py-1 text-gray-700">{{ $item->item->brand_name }}</td>
                <td class="border px-2 py-1 text-gray-700">{{ $item->stock_id }}</td>
                <td class="border px-2 py-1 text-gray-700">{{ $item->package_number}}</td>
                <td class="border px-2 py-1 text-gray-700">{{ 'Item No. ' }}{{ $item->unit_number}}</td>
                @if($column->item->category === 'Supply'|| $column->item->category === 'Equipment')
                <td class="border px-2 py-1 text-gray-700">{{ $item->unit_quantity }} {{ $item->measurement_unit }}</td>
                <td class="border px-2 py-1 text-gray-700">{{ $item->remaining_quantity }} {{ $item->measurement_unit }}</td>
                @else
                <td class="border px-2 py-1 text-gray-700">{{ $item->unit_volume }} {{ $item->measurement_unit }}</td>
                <td class="border px-2 py-1 text-gray-700">{{ $item->remaining_volume }} {{ $item->measurement_unit }}</td>
                @endif
                <td class="border px-2 py-1 text-gray-700 "><span class="flex items-center gap-2"><img src="{{asset('images/philippine-peso.svg')}}" alt="Peso logo"
                            class="w-3 h-3">{{ $item->unit_price}}</span> </td>
                <td class="border px-2 py-1 text-gray-700">{{ $item->status }} </td>
                <td class="border px-2 py-1 text-red-500"><button wire:click="removeItem({{ $item->id }})" type="button">Remove</button> </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <!-- table pagination -->
    <div class=" px-3 mt-5">
        {{ $inventoryItems->appends(['perPage' => $perPage])->links() }}

    </div>

</div>