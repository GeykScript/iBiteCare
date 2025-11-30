<div>
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


    <div class="overflow-x-auto md:overflow-hidden">
        <table class="min-w-full  text-sm mt-2 ">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border-r border-b bg-gray-800 text-white px-2 py-3 hover:cursor-pointer rounded-tl-lg" wire:click="setSortBy('id')">ID</th>
                    <th class="border bg-gray-800 text-white px-2 py-3 hover:cursor-pointer" wire:click="setSortBy('patient')">Patient Name</th>
                    <th class="border bg-gray-800 text-white px-2 py-3 hover:cursor-pointer" wire:click="setSortBy('transaction')">Service Received</th>
                    <th class="border bg-gray-800 text-white px-2 py-3">Receipt No#</th>
                    <th class="border bg-gray-800 text-white px-2 py-3 hover:cursor-pointer" wire:click="setSortBy('amount_paid')">Paid Amount</th>
                    <th class="border bg-gray-800 text-white px-2 py-3 hover:cursor-pointer" wire:click="setSortBy('payment_date')">Payment Date</th>
                    <!-- <th class="border-l border-b bg-gray-800 text-white px-2 py-3">Status</th> -->
                    <th colspan="2" class="px-2 py-3 border bg-gray-800 text-white rounded-tr-lg hover:cursor-pointer" wire:click="setSortBy('in_charge')"> In Charge</th>
                </tr>
            </thead>
            <tbody>
                @if($paymentRecords->isEmpty())
                <tr class="table-row sm:hidden">
                    <td colspan="4" class="text-center py-4">No Payment Records found.</td>
                </tr>
                <tr class="hidden sm:table-row">
                    <td colspan="13" class="text-center py-4">No Payment Records found.</td>
                </tr>
                @else
                @foreach($paymentRecords as $paymentRecord)
                <tr>
                    <td class="border-b px-2 py-2 text-gray-700">{{ $paymentRecord->id }}</td>
                    <td class="border px-2 py-2 text-gray-700">{{ $paymentRecord->patient->first_name }} {{ $paymentRecord->patient->middle_initial }} {{ $paymentRecord->patient->last_name }}</td>
                    <td class="border px-2 py-2 text-gray-700">{{ $paymentRecord->transaction->service->name }}</td>
                    <td class="border px-2 py-2 text-gray-700">{{ $paymentRecord->receipt_number }}</td>
                    <td class="border px-2 py-2 text-gray-700 "><span class="flex items-center"><img src="{{asset('images/philippine-peso.svg')}}" alt="Peso logo" class="w-3 h-3">{{ number_format($paymentRecord->amount_paid, 2) }}</span> </td>
                    <td class="border px-2 py-2 text-gray-700"> {{ \Carbon\Carbon::parse($paymentRecord->payment_date)->format('M, d, Y - g:i A') }}
                    </td>

                    <!-- <td class="border px-2 py-2 text-gray-700 flex item-center justify-center"><span class="bg-green-200 px-4 p-1 text-green-500 font-bold rounded-md">Paid </span></td> -->
                    <td class="border-b px-2 py-2 text-gray-700">{{ $paymentRecord->receivedBy->first_name }} {{ $paymentRecord->receivedBy->last_name }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!-- table pagination -->
    <div class="px-3 mt-5">
        {{ $paymentRecords->appends(['perPage' => $perPage])->links() }}
    </div>
</div>