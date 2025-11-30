<div class="flex flex-col col-span-4 gap-2 relative pb-12">
    <div class="overflow-hidden">
        <div class="grid grid-cols-12 gap-6 p-2 ">
            <!-- per page dropdown -->
            <div class="col-span-12 md:col-span-9 flex items-center justify-between  gap-4">
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
                <div class="l:col-span-4 col-span-12 flex flex-col gap-2">
                    <!-- filter  -->
                    <div class="flex items-center  gap-2   ">
                        <h1 class="font-bold text-gray-700 flex text-sm">Filter:</h1>
                        <div class="w-48" x-data="{ open:false }">
                            <!-- Button -->
                            <button
                                @click="open = !open"
                                type="button"
                                class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg px-4 py-2 w-full flex justify-between items-center">
                                <span>
                                    {{ $filter === 'all' ? 'All' : ($filter === 'arrived' ? 'Arrived' : ($filter === 'cancelled' ? 'Cancelled' : ($filter === 'pending' ? 'Pending' : 'All'))) }}
                                </span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div
                                x-show="open"
                                @click.outside="open = false"
                                x-cloak
                                class="absolute mt-1 w-48 bg-white border border-gray-300 rounded-lg shadow-md">

                                <button
                                    wire:click="$set('filter', 'all')"
                                    @click="open=false"
                                    class="block w-full text-left px-4 py-2 text-sm 
                                    {{ $filter === 'all' ? 'bg-gray-800 text-white' : 'hover:bg-gray-100' }}">
                                    All
                                </button>
                                <button
                                    wire:click="$set('filter', 'pending')"
                                    @click="open=false"
                                    class="block w-full text-left px-4 py-2 text-sm 
                                    {{ $filter === 'pending' ? 'bg-gray-800 text-white' : 'hover:bg-gray-100' }}">
                                    Pending
                                </button>
                                <button
                                    wire:click="$set('filter', 'arrived')"
                                    @click="open=false"
                                    class="block w-full text-left px-4 py-2 text-sm 
                                    {{ $filter === 'arrived' ? 'bg-gray-800 text-white' : 'hover:bg-gray-100' }}">
                                    Arrived
                                </button>

                                <button
                                    wire:click="$set('filter', 'cancelled')"
                                    @click="open=false"
                                    class="block w-full text-left px-4 py-2 text-sm 
                                     {{ $filter === 'cancelled' ? 'bg-gray-800 text-white' : 'hover:bg-gray-100' }}">
                                    Cancelled
                                </button>
                            </div>
                        </div>

                    </div>
                    <div class="flex flex-wrap items-center justify-start l:justify-center  gap-2 px-2 ">
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
                <div class="col-span-7 flex items-end ">
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

    <div class="overflow-x-auto md:overflow-hidden">
        <table class="min-w-full  text-sm mt-2 ">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border-r border-b bg-gray-800 text-white px-2 py-1 hover:cursor-pointer rounded-tl-lg" wire:click="setSortBy('id')">ID</th>
                    <th class="border bg-gray-800 text-white px-2 py-2 hover:cursor-pointer" wire:click="setSortBy('name')">Name</th>
                    <th class="border bg-gray-800 text-white px-2 py-2 hover:cursor-pointer" wire:click="setSortBy('treatment_type')">Treatment</th>
                    <th class="border bg-gray-800 text-white px-2 py-2">Contact</th>
                    <th class="border bg-gray-800 text-white px-2 py-2 hover:cursor-pointer" wire:click="setSortBy('booking_channel')">Booking Channel</th>
                    <th class="border bg-gray-800 text-white px-2 py-2 hover:cursor-pointer" wire:click="setSortBy('appointment_date')">Date</th>
                    <th class="border bg-gray-800 text-white px-2 py-2 hover:cursor-pointer" wire:click="setSortBy('appointment_time')">Time</th>
                    <th class="border bg-gray-800 text-white px-2 py-2 hover:cursor-pointer" wire:click="setSortBy('status')">Status</th>
                    <th class="border bg-gray-800 text-white px-2 py-2 rounded-tr-lg border-l border-b " colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($appointments->isEmpty())
                <tr class="table-row sm:hidden">
                    <td colspan="4" class="text-center py-4">No appointment Records found.</td>
                </tr>
                <tr class="hidden sm:table-row">
                    <td colspan="13" class="text-center py-4">No appointment Records found.</td>
                </tr>
                @else
                @foreach($appointments as $appointment)
                <tr>
                    <td class="border-b px-2 py-2 text-gray-700">{{ $appointment->id }}</td>
                    <td class="border px-2 py-2 text-gray-700">{{ $appointment->name }}</td>
                    <td class="border px-2 py-2 text-gray-700">{{ $appointment->treatment_type }}</td>
                    <td class="border px-2 py-2 text-gray-700">{{ $appointment->contact_number }}</td>
                    <td class="border px-2 py-2 text-gray-700">{{ $appointment->booking_channel }}</td>
                    <td class="border px-2 py-2 text-gray-700">
                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M, d, Y') }}
                    </td>
                    <td class="border px-2 py-2 text-gray-700">
                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                    </td>

                    <td class="border px-2 py-3 text-gray-700 text-center"> @if ($appointment->status == 'Arrived')
                        <span class="text-green-500 font-bold p-2 px-5 rounded bg-green-200">{{ $appointment->status }}</span>
                        @elseif ($appointment->status == 'Pending' || $appointment->status == 'Rescheduled')
                        <span class="text-orange-400 font-bold p-2 rounded bg-orange-100">{{ $appointment->status }}</span>
                        @else
                        <span class="text-red-500 font-bold p-2 rounded bg-red-200">{{ $appointment->status }}</span>
                        @endif
                    </td>
                    <td class="border px-2 py-2 text-gray-700 text-center align-middle">
                        @if ($appointment->status != 'Arrived' && $appointment->status != 'Cancelled')
                        <div class="flex justify-center">
                            <button
                                @click="$dispatch('reschedule-modal', {
                                    id: {{ $appointment->id }},
                                    date: '{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}',
                                    time: '{{ $appointment->appointment_time }}',
                                    email: '{{ $appointment->email }}'
                                })"
                                class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg focus:outline-none">
                                Reschedule
                            </button>
                        </div>
                        @else
                        <span>--</span>
                        @endif
                    </td>

                    <td class="border px-2 py-2 text-gray-700 text-center align-middle">
                        @if ($appointment->status == 'Arrived' || $appointment->status == 'Cancelled')
                        <span>--</span>
                        @else
                        <div class="flex justify-center">
                            <button
                                @click="$dispatch('status-modal', {
                                            id: {{ $appointment->id }},
                                        })"
                                class="text-sky-500 font-bold hover:text-sky-600 px-4 py-2 rounded-lg focus:outline-none">
                                Update Status
                            </button>
                        </div>
                        @endif
                    </td>

                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!-- table pagination -->
    <div class="px-3 mt-5">
        {{ $appointments->appends(['perPage' => $perPage])->links() }}
    </div>

    <!-- Reschedule Modal -->
    <dialog
        id="rescheduleModal"
        x-data="{
                appointmentId: null,
                appointmentDate: '',
                appointmentTime: '',
                email: '',
                open() { this.$refs.modal.showModal() },
                close() { this.$refs.modal.close() }
            }"
        x-ref="modal"
        @reschedule-modal.window="
                appointmentId = $event.detail.id;
                appointmentDate = $event.detail.date;
                appointmentTime = $event.detail.time;
                email = $event.detail.email;
                open();
            "
        class="p-8 rounded-lg shadow-lg w-full max-w-lg backdrop:bg-black/30 focus:outline-none">
        <div class="w-full flex justify-end mb-2">
            <button @click="close()" class="focus:outline-none">
                <img src="{{ asset('images/x.svg') }}" alt="Cancel" class="w-6 h-6">
            </button>
        </div>

        <div class="flex flex-col gap-4">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Reschedule Appointment</h2>

            <form action="{{ route('clinic.appointments.reschedule') }}" method="POST" class="flex flex-col gap-4"
                x-data="{ loading: false }"
                x-on:submit="loading = true">
                @csrf
                <input type="hidden" name="appointment_id" x-model="appointmentId">
                <input type="hidden" name="email" x-model="email">

                <p class="text-sm text-gray-500">Please select a new date and time for the appointment.</p>

                <div class="grid grid-cols-2 gap-2">
                    <div class="col-span-2 md:col-span-1 flex flex-col">
                        <label for="appointment_date" class="text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input
                            type="date"
                            id="appointment_date"
                            name="appointment_date"
                            x-model="appointmentDate"
                            class="border border-gray-300 rounded-lg p-2.5 focus:ring-sky-500 focus:border-sky-500">
                    </div>

                    <div class="col-span-2 md:col-span-1 flex flex-col">
                        <label for="appointment_time" class="text-sm font-medium text-gray-700 mb-1">Time</label>
                        <input
                            type="time"
                            id="appointment_time"
                            name="appointment_time"
                            x-model="appointmentTime"
                            class="border border-gray-300 rounded-lg p-2.5 focus:ring-sky-500 focus:border-sky-500">
                    </div>
                </div>


                <div class="flex justify-end gap-2 mt-4">
                    <button
                        type="submit"
                        :disabled="loading"
                        class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-2 rounded-lg flex items-center justify-center">
                        <!-- Spinner -->
                        <svg x-show="loading" x-cloak aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB" />
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor" />
                        </svg>
                        <span x-show="!loading" x-cloak>Submit</span>
                        <span x-show="loading" x-cloak>Loading...</span>
                    </button>
                    <button
                        type="button"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-600 rounded-lg"
                        @click="close()">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </dialog>


    <!-- Status Modal -->
    <dialog
        id="statusModal"
        x-data="{
                appointmentId: null,
                open() { this.$refs.modal.showModal() },
                close() { this.$refs.modal.close() }
            }"
        x-ref="modal"
        @status-modal.window="
                appointmentId = $event.detail.id;
                open();
            "
        class="p-8 rounded-lg shadow-lg w-full max-w-lg backdrop:bg-black/30 focus:outline-none">
        <div class="w-full flex justify-end mb-2">
            <button @click="close()" class="focus:outline-none">
                <img src="{{ asset('images/x.svg') }}" alt="Cancel" class="w-6 h-6">
            </button>
        </div>

        <div class="flex flex-col gap-4">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Update Appointment Status</h2>

            <form action="{{ route('clinic.appointments.change-status') }}" method="POST" class="flex flex-col gap-2"
                x-data="{ loading: false }"
                x-on:submit="loading = true">

                @csrf
                <input type="hidden" name="appointment_id" x-model="appointmentId">

                <p class="text-sm text-gray-500">Please select the new status for the appointment.</p>
                <p class="text-xs text-gray-500">If the patient has arrived, please select "Arrived". If the appointment is cancelled, select "Cancelled".</p>
                <!-- Status Radio Buttons -->
                <div class="flex flex-col items-center justify-center">

                    <div class="flex items-center space-x-4">
                        <label class="flex items-center space-x-2">
                            <input
                                type="radio"
                                name="status"
                                value="Arrived"
                                x-model="status"
                                class="text-sky-600 focus:ring-sky-500">
                            <span>Arrived</span>
                        </label>

                        <label class="flex items-center space-x-2">
                            <input
                                type="radio"
                                name="status"
                                value="Cancelled"
                                x-model="status"
                                class="text-sky-600 focus:ring-sky-500">
                            <span>Cancel</span>
                        </label>
                    </div>
                </div>



                <div class="flex justify-end gap-2 mt-4">
                    <button
                        type="submit"
                        :disabled="loading"
                        class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-2 rounded-lg flex items-center justify-center">
                        <!-- Spinner -->
                        <svg x-show="loading" x-cloak aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB" />
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor" />
                        </svg>
                        <span x-show="!loading" x-cloak>Submit</span>
                        <span x-show="loading" x-cloak>Loading...</span>
                    </button>
                    <button
                        type="button"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-600 rounded-lg"
                        @click="close()">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </dialog>


</div>