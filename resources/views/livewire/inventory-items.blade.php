<div class="overflow-x-auto">
    <div class="overflow-hidden">
        <div class="flex flex-row justify-between gap-2 p-2">
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
            <div class="flex flex-wrap items-center justify-start l:justify-center  gap-2 px-2 ">
                <span class="text-sm font-medium text-gray-700">Expiration Date:</span>

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
    <!-- success remove message  -->
    @if(session('remove-success'))
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
            <h2 class="text-xl font-bold text-gray-700">{{ session('remove-success') }}</h2>
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

    <!-- Success edit message  -->
    @if(session('edit-item-success'))
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
            <h2 class="text-xl font-bold text-gray-700">{{ session('edit-item-success') }}</h2>
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

    <table class="min-w-full  text-sm mt-2 border-none">
        <thead class="bg-sky-600 border-none">
            <tr>
                <th class="border-r  border-b  text-white rounded-tl-lg px-2 py-1 hover:cursor-pointer" wire:click="setSortBy('id')">ID</th>
                <th class="border  text-white  px-2 py-1 hover:cursor-pointer" wire:click="setSortBy('batch_no')">Batch No.</th>
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
                <th class="border  text-white  px-2 py-1 hover:cursor-pointer" wire:click="setSortBy('expiration_date')">Expires On</th>
                <th class="border  text-white  px-2 py-1 hover:cursor-pointer" wire:click="setSortBy('updated_at')">Last Usage</th>
                @if($category === 'Supply' || $category === 'Equipment')
                <th class="border  text-white  rounded-tr-lg px-2 py-1">Edit</th>
                @endif
                @if($category !== 'Supply' && $category !== 'Equipment')
                <th colspan="2" class="border-l border-b  text-white rounded-tr-lg px-2 py-1">Action </th>
                @endif
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
                <td class="border px-2 py-2 text-gray-700">{{ $item->batch_no ?? 'n/a' }} </td>
                <td class="border px-2 py-2 text-gray-700">{{ 'Item No. ' }}{{ $item->unit_number}}</td>
                @if($column->item->category === 'Supply'|| $column->item->category === 'Equipment')
                <td class="border px-2 py-2 text-gray-700">{{ $item->unit_quantity }} {{ $item->measurement_unit }}</td>
                <td class="border px-2 py-2 text-gray-700">{{ $item->remaining_quantity }} {{ $item->measurement_unit }}</td>
                @else

                @php

                $unitVolume = rtrim(rtrim(number_format($item->unit_volume, 2, '.', ''), '0'), '.');
                $remainingVolume = rtrim(rtrim(number_format($item->remaining_volume, 2, '.', ''), '0'), '.');

                @endphp

                <td class="border px-2 py-2 text-gray-700">{{ $unitVolume }} {{ $item->measurement_unit }}</td>
                <td class="border px-2 py-2 text-gray-700">{{ $remainingVolume }} {{ $item->measurement_unit }}</td>

                @endif
                <td class="border px-2 py-2 text-gray-700 flex ">
                    @if ($item->status == "Sealed")
                    <span class="text-[13px] text-green-500 bg-green-100 py-1 px-2 rounded-lg"> {{ $item->status }} </span>
                    @elseif ($item->status == "Opened")
                    <span class="text-[13px] text-orange-500 bg-orange-100 py-1 px-2 rounded-lg"> {{ $item->status }} </span>
                    @elseif ($item->status == "Used")
                    <span class="text-[13px] text-blue-500 bg-blue-100 py-1 px-2 rounded-lg"> {{ $item->status }} </span>
                    @elseif ($item->status == "Disposed" || $item->status == "Expired")
                    <span class="text-[13px] text-red-500 bg-red-100 py-1 px-2 rounded-lg"> {{ $item->status }} </span>
                    @endif
                </td>


                @if ($item->expiration_date)
                <td class="border px-2 py-2 text-gray-700">
                    {{ \Carbon\Carbon::parse($item->expiration_date)->format('M d, Y') }}
                </td>
                @else
                <td class="border px-2 py-2 text-center text-gray-700">
                    --
                </td>
                @endif
                <td class="border px-2 py-2 text-gray-700">
                    {{ $item->updated_at ? \Carbon\Carbon::parse($item->updated_at)->format('M d, Y h:i A') : '-' }}
                </td>

                <!-- show edit  button only if item is not used or disposed and category is supply or equipment -->
                @if($column->item->category === 'Supply'|| $column->item->category === 'Equipment')
                @if ($item->status == 'Used' || $item->status == 'Disposed' || $item->status == 'Expired')
                <td class="border-b px-2 py-2 text-blue-500 ">
                    <div class="flex justify-center">
                        <p> -- </p>
                    </div>
                </td>
               
                @else
                <td class="border px-2 py-2 text-sky-500">
                    <!-- click modal in supplies-manage.blade #updateInventoryItemModal -->
                    <div class="flex items-center justify-center gap-1">
                        <button type="button"
                            @click="$dispatch('update-item-modal', { 
                                    id: {{ $item->id }},
                                    item_id: {{ $item->item_id }},
                                    stock_id: {{ $item->stock_id }},
                                    quantity: {{ $item->unit_quantity }},
                                    remaining: {{ $item->remaining_quantity }},
                                    batch_no: '{{ $item->batch_no }}',
                                    expiration_date: '{{ $item->expiration_date }}'
                                })"
                            class="text-blue-500 hover:underline flex items-center gap-1 underline-offset-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen">
                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                            </svg>
                            Edit
                        </button>
                    </div>
                </td>
                @endif
                @endif
                <!-- end show edit button -->

                <!-- show edit and dispose button only if item is not used or disposed and category is not supply or equipment -->
                @if($column->item->category !== 'Supply' && $column->item->category !== 'Equipment')
                @if ($item->status == 'Used' || $item->status == 'Disposed' || $item->status == 'Expired')
                <td class="border-b px-2 py-2 text-blue-500 ">
                    <div class="flex justify-center">
                        <p> -- </p>
                    </div>
                </td>
                <td class="border-b px-2 py-2 text-red-500 ">
                    <div class="flex justify-center">
                        <p> -- </p>
                    </div>
                </td>
                @else
                <!-- edit vaccine item button  -->
                <td class="border px-2 py-2 text-sky-500">
                    <div class="flex items-center justify-center gap-1">

                        <button type="button"
                            @click="$dispatch('edit-vaccine-item-modal', { 
                                    id: {{ $item->id }},
                                    item_id: {{ $item->item_id }},
                                    stock_id: {{ $item->stock_id }},
                                    volume: {{ $unitVolume }},
                                    remaining: {{ $remainingVolume }},
                                    batch_no: '{{ $item->batch_no }}',
                                    expiration_date: '{{ $item->expiration_date }}'
                                })"
                            class="text-blue-500 hover:underline flex items-center gap-1 underline-offset-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen">
                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                            </svg>
                            Edit
                        </button>
                    </div>

                </td>
                <!-- Remove button -->
                <td class="border-b px-2 py-2 text-red-500 ">
                    <div class="flex justify-center">
                        <button
                            type="button"
                            @click="$dispatch('open-remove-modal', { id: {{ $item->id }} })"
                            class="text-red-500 hover:underline flex items-center underline-offset-4 ">
                            <img src="{{ asset('images/trash.svg') }}" alt="Trash icon" class="w-4 h-4 inline">
                            <span class="hidden md:block">
                                Dispose
                            </span>
                        </button>
                    </div>
                </td>
                @endif
                @endif
                <!-- end show edit and dispose button -->
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>


    <!-- update inventory item modal -->
    <dialog id="editInventoryItemModal"
        x-data="{
                                        item: {
                                            id: '', stock_id: '', item_id: '', volume: '', remaining: '', batch_no: '', expiration_date: ''
                                        },
                                        open() { this.$refs.modal.showModal() },
                                        close() { this.$refs.modal.close() }
                                    }"
        x-ref="modal"
        @edit-vaccine-item-modal.window="item = $event.detail; open()"
        class="p-8 rounded-lg shadow-lg w-full max-w-lg backdrop:bg-black/50 focus:outline-none">

        <!-- Close button -->
        <div class="w-full flex justify-end">
            <button @click="close()" class="focus:outline-none">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Form -->
        <form action="{{route('clinic.supplies.manage.edit.volume')}}" method="POST" id="editInventoryItemForm"
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
                <div class="col-span-12 grid grid-cols-12 gap-4 py-2">
                    <div class="md:col-span-6 col-span-12 flex flex-col justify-end gap-2">
                        <label for="batch_no" class="text-sm font-semibold">Batch Number</label>
                        <input type="text" name="batch_no" id="batch_no" placeholder="e.g ABH2025-0312" x-model="item.batch_no" required
                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none hover:border-sky-400 focus:ring-0 focus:border-sky-400 " />
                    </div>
                    <div class="md:col-span-6 col-span-12 flex flex-col justify-end gap-2">
                        <label for="expiration_date" class="text-sm font-semibold">Expiration Date</label>
                        <input type="date" name="expiration_date" id="expiration_date" x-model="item.expiration_date" required
                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none hover:border-sky-400 focus:ring-0 focus:border-sky-400 " />
                    </div>
                </div>
                <div class="col-span-12 flex flex-col">
                    <p class="block text-sm font-medium">Volume (ml)</p>
                    <p class="text-xs text-gray-500">(Leave unchanged if no update is needed)</p>

                    <input type="number" name="volume" x-model="item.volume" min="0" step="any"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none hover:border-sky-400 focus:ring-0 focus:border-sky-400">
                </div>

                <div class="col-span-12 flex flex-col">
                    <p class="block text-sm font-medium">Remaining Volume (ml)</p>
                    <p class="text-xs text-gray-500">(Leave unchanged if no update is needed)</p>
                    <input type="number" name="remaining_volume" x-model="item.remaining" min="0" step="any"
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
            <p class="text-gray-600 mb-6">Are you sure you want to dispose of this item?</p>

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