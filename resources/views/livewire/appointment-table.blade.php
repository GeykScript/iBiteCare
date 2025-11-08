<div class="w-full">
    <div>
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
                    <p class="text-sm font-medium text-gray-900 md:block hidden">
                        entries per page
                    </p>
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
                        name="search"
                        type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full h-full pl-12 p-2 "
                        placeholder="Search" required>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        class="w-full bg-green-100 border-2 rounded border-green-200 flex justify-between py-2 px-4 ">
        <h1 class="text-md font-bold text-green-600">{{ session('success') }}</h1>
        <button @click="show = false" class="text-lg font-bold text-green-600">
            <i data-lucide="x"></i>
        </button>
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
                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }}
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