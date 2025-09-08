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
                    <label class="text-sm font-medium text-gray-900 md:block hidden">
                        entries per page
                    </label>
                </div>
            </div>
        </div>
    </div>
    <!-- success remove message  -->
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
    <!-- Success edit message  -->
    @if (session('edit-item-success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        class="w-full bg-green-100 border-2 rounded border-green-200 flex justify-between py-2 px-4 ">
        <h1 class="text-md font-bold text-green-600">{{ session('edit-item-success') }}</h1>
        <button @click="show = false" class="text-lg font-bold text-green-600">
            <i data-lucide="x"></i>
        </button>
    </div>
    @endif
    <table class="min-w-full  text-sm mt-2 border-none">
        <thead class="bg-sky-600 border-none">
            <tr>
                <th class="border-r  border-b  text-white rounded-tl-lg px-2 py-1 hover:cursor-pointer" wire:click="setSortBy('id')">ID</th>
                <th class="border  text-white  px-2 py-1">Name</th>
                <th class="border  text-white  px-2 py-1">Stock No.</th>
                <th class="border  text-white  px-2 py-1">Package No.</th>
                <th class="border  text-white  px-2 py-1 hover:cursor-pointer" wire:click="setSortBy('unit_number')">Unit No.</th>
                @php
                $category = $column->item->category ?? 'Other';
                @endphp
                @if($category === 'Supply' || $category === 'Equipment')
                <th class="border  text-white  px-2 py-1">Quantity</th>
                <th class="border  text-white  px-2 py-1">Remaining</th>
                @else
                <th class="border  text-white  px-2 py-1">Volume</th>
                <th class="border  text-white  px-2 py-1">Remaining</th>
                @endif
                <th class="border  text-white  px-2 py-1 hover:cursor-pointer" wire:click="setSortBy('status')">Status</th>
                @if($category === 'Supply' || $category === 'Equipment')
                <th class="border  text-white  px-2 py-1">Edit</th>
                @endif
                <th class="border-l border-b  text-white rounded-tr-lg px-2 py-1">Action </th>
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
                <td class="border-b px-2 py-2 text-gray-700">{{ $item->id }}</td>
                <td class="border px-2 py-2 text-gray-700">{{ $item->item->brand_name }}</td>
                <td class="border px-2 py-2 text-gray-700">{{ $item->stock_id }}</td>
                <td class="border px-2 py-2 text-gray-700">{{ $item->package_number}}</td>
                <td class="border px-2 py-2 text-gray-700">{{ 'Item No. ' }}{{ $item->unit_number}}</td>
                @if($column->item->category === 'Supply'|| $column->item->category === 'Equipment')
                <td class="border px-2 py-2 text-gray-700">{{ $item->unit_quantity }} {{ $item->measurement_unit }}</td>
                <td class="border px-2 py-2 text-gray-700">{{ $item->remaining_quantity }} {{ $item->measurement_unit }}</td>
                @else
                <td class="border px-2 py-2 text-gray-700">{{ $item->unit_volume }} {{ $item->measurement_unit }}</td>
                <td class="border px-2 py-2 text-gray-700">{{ $item->remaining_volume }} {{ $item->measurement_unit }}</td>
                @endif
                <td class="border px-2 py-2 text-gray-700">{{ $item->status }} </td>

                @if($column->item->category === 'Supply'|| $column->item->category === 'Equipment')
                <td class="border px-2 py-2 text-sky-500">
                    <!-- click modal in supplies-manage.blade #updateInventoryItemModal -->
                    <div class="flex items-center justify-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen">
                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                            <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                        </svg>
                        <button type="button"
                            @click="$dispatch('update-item-modal', { 
                                    id: {{ $item->id }},
                                    item_id: {{ $item->item_id }},
                                    stock_id: {{ $item->stock_id }},
                                    quantity: {{ $item->unit_quantity }},
                                    remaining: {{ $item->remaining_quantity }},
                                    status: '{{ $item->status }}'
                                })"
                            class="text-blue-500 hover:underline underline-offset-4">
                            Edit
                        </button>
                    </div>

                </td>
                @endif
                <!-- Remove button -->
                <td class="border-b px-2 py-2 text-red-500 ">
                    <div class="flex justify-center">
                        <button
                            type="button"
                            @click="$dispatch('open-remove-modal', { id: {{ $item->id }} })"
                            class="text-red-500 hover:underline flex items-center underline-offset-4 ">
                            <img src="{{ asset('images/trash.svg') }}" alt="Trash icon" class="w-4 h-4 inline">
                            Remove
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    <!-- Remove Confirmation Modal -->
    <dialog id="removeModal"
        x-data="{ removeId: null, open() { this.$refs.modal.showModal() }, close() { this.$refs.modal.close() } }"
        x-ref="modal"
        @open-remove-modal.window="removeId = $event.detail.id; open()"
        class="p-6 rounded-lg shadow-lg w-full max-w-md backdrop:bg-black/50 focus:outline-none">

        <div class="text-center">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/triangle-alert.svg') }}" alt="Trash icon" class="w-20 h-20">

            </div>
            <h2 class="text-lg font-semibold mb-4">Confirm Removal</h2>
            <p class="text-gray-600 mb-6">Are you sure you want to remove this item?</p>

            <div class="flex justify-center gap-5">
                <!-- Cancel -->
                <button type="button" @click="close()" class="px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">
                    Cancel
                </button>

                <!-- Confirm -->
                <button
                    type="button"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-500"
                    @click="$wire.removeItem(removeId); close()">
                    Yes, Remove
                </button>
            </div>
        </div>
    </dialog>
    
    <!-- table pagination -->
    <div class=" px-3 mt-5">
        {{ $inventoryItems->appends(['perPage' => $perPage])->links() }}

    </div>

</div>