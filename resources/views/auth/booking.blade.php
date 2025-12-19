<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



    <div class="pb-10">
        <div class="max-w-5xl mx-auto p-4 sm:p-6 flex flex-col items-start">
            <h2 class="mb-4 sm:my-6 font-900 text-2xl sm:text-3xl text-gray-800">
                Your Appointments
            </h2>
            <p class="text-md text-gray-500 mt-4">
                <strong>Note:</strong> This section is for viewing your appointment details and schedules. <br>
                Please select the appointment from the dropdown below to see all the relevant information.
            </p>
        </div>

        <div class="max-w-5xl mx-auto bg-white shadow-md rounded-xl p-4 sm:p-6 my-4 sm:my-4">
            @php
            $activeAppointments = $appointments->filter(fn($a) => $a->status !== 'Cancelled');
            @endphp

            @if($activeAppointments->count() > 0)
            <div class="text-center mb-6 px-2">
                <label for="appointment_dropdown" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                    Select an appointment to view details:
                </label>
                <select id="appointment_dropdown"
                    class="block w-full md:w-3/4 lg:w-1/2 mx-auto px-2 sm:px-3 py-2 text-xs sm:text-sm md:text-base border border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 transition">
                    <option value="">-- Select Appointment --</option>
                    @foreach($activeAppointments as $appointment)
                    <option
                        value="{{ $appointment->id }}"
                        data-status="{{ $appointment->status }}"
                        class="appointment-option {{ $appointment->status === 'Arrived' ? 'bg-green-100 text-green-800 font-semibold' : 'text-black' }}">
                        {{ ucfirst($appointment->treatment_type) }} on
                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div id="appointment_details" class="hidden border border-gray-200 rounded-lg shadow-sm bg-gray-50 p-4 sm:p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm sm:text-base">
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <th class="py-2 w-1/3 font-medium text-gray-700">Booking Reference</th>
                                <td id="detail_booking_reference" class="py-2 break-words"></td>
                            </tr>
                            <tr>
                                <th class="py-2 w-1/3 font-medium text-gray-700">Name</th>
                                <td id="detail_name" class="py-2 break-words"></td>
                            </tr>
                            <tr>
                                <th class="py-2 font-medium text-gray-700">Contact</th>
                                <td id="detail_contact" class="py-2 break-words"></td>
                            </tr>
                            <tr>
                                <th class="py-2 font-medium text-gray-700">Email</th>
                                <td id="detail_email" class="py-2 break-all"></td>
                            </tr>
                            <tr>
                                <th class="py-2 font-medium text-gray-700">Treatment</th>
                                <td id="detail_treatment" class="py-2 break-words"></td>
                            </tr>
                            <tr>
                                <th class="py-2 font-medium text-gray-700">Date</th>
                                <td id="detail_date" class="py-2"></td>
                            </tr>
                            <tr>
                                <th class="py-2 font-medium text-gray-700">Time</th>
                                <td id="detail_time" class="py-2"></td>
                            </tr>
                            <tr>
                                <th class="py-2 font-medium text-gray-700">Status</th>
                                <td id="detail_status" class="py-2 font-bold text-lg"></td>
                            </tr>
                            <tr>
                                <th class="py-2 font-medium text-gray-700">Notes</th>
                                <td id="detail_notes" class="py-2 break-words"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex flex-col sm:flex-row justify-end gap-2 sm:gap-3">
                    <button id="cancelBtn" class="w-full sm:w-auto bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">Cancel</button>
                    <button id="rescheduleBtn" class="w-full sm:w-auto bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition">Reschedule</button>
                </div>
            </div>
            @else
            <p class="text-center text-gray-500">No appointments found.</p>
            @endif
        </div>

        <div class="max-w-5xl mx-auto p-4 sm:p-6 flex flex-col items-start">
            <h2 class="mb-4 sm:my-6 font-900 text-2xl sm:text-3xl text-gray-800">
                Appointment Schedules
            </h2>
            <p class="text-md text-gray-500 mt-4 w-full">
                <strong>Note:</strong> This section displays all available appointment dates and times.
                You can review the schedule and check which slots are available for booking.
                Select a date to see the detailed time slots and the number of appointments already booked.
            </p>
        </div>

        <div class="max-w-5xl mx-auto bg-white shadow-md rounded-xl p-4 sm:p-6 my-4 sm:my-4 flex flex-col items-center justify-center ">
            <div>
                <h3 class="text-lg text-gray-900 font-semibold mb-2 text-center"> {{ \Carbon\Carbon::parse($datesInMonth[0])->format('F Y') }} </h3>
            </div>
            @php
            $firstDayOfMonth = \Carbon\Carbon::parse($datesInMonth[0])->startOfMonth();
            $lastDayOfMonth = \Carbon\Carbon::parse($datesInMonth[0])->endOfMonth();

            // Prepare weeks for the current month only
            $weeks = [];
            $week = [];

            // Fill empty cells at the start if month doesn't start on Monday
            $startWeekDay = $firstDayOfMonth->dayOfWeekIso; // 1 = Monday, 7 = Sunday
            for ($i = 1; $i < $startWeekDay; $i++) {
                $week[]=null; // empty cell
                }

                // Add all days of the month
                for ($day=$firstDayOfMonth->copy(); $day <= $lastDayOfMonth; $day->addDay()) {
                    $week[] = $day->copy();

                    if (count($week) === 7) {
                    $weeks[] = $week;
                    $week = [];
                    }
                    }

                    // Add last week if it has remaining days
                    if (count($week) > 0) {
                    while (count($week) < 7) {
                        $week[]=null; // empty cell at end
                        }
                        $weeks[]=$week;
                        }
                        @endphp

                        <div class="overflow-auto " style="max-height: 600px; max-width: 100%;">
                        <table class="min-w-max border-collapse border border-white">
                            <thead class="bg-gray-800 text-white sticky top-0">
                                <tr>
                                    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                    <th class="border border-gray-800 p-6">{{ $day }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($weeks as $week)
                                <tr>
                                    @foreach($week as $day)
                                    @if($day)
                                    @php
                                    $dateStr = $day->format('Y-m-d');
                                    $isSunday = $day->dayOfWeekIso === 7;

                                    // Filter appointments for this day
                                    $appointmentsForDate = $scheduledAppointments->filter(function($a) use ($dateStr) {
                                    return \Carbon\Carbon::parse($a->appointment_date)->format('Y-m-d') === $dateStr;
                                    });

                                    $appointmentsByTime = $appointmentsForDate->groupBy('appointment_time');
                                    @endphp
                                    <td class="border border-gray-800 p-2 align-top text-sm min-w-[120px] 
                                            @if($isSunday) bg-red-100 
                                            @elseif($appointmentsByTime->isEmpty()) bg-green-200
                                            @else bg-sky-200 
                                            @endif">
                                        <div class="w-10 h-10 mb-3 border border-gray-800 rounded-full flex items-center justify-center">
                                            <div class="font-bold">{{ $day->format('d') }}</div>
                                        </div>


                                        @if($isSunday)
                                        <div class="text-red-500 font-semibold">Not Available</div>
                                        @elseif($appointmentsByTime->isEmpty())
                                        <div class="text-gray-800 font-semibold">Available</div>
                                        @else
                                        @foreach($appointmentsByTime->sortKeys() as $time => $appointmentsAtTime)
                                        @php
                                        $count = $appointmentsAtTime->count();
                                        $max = 5;
                                        @endphp
                                        <div class="text-sky-600 font-semibold">
                                            {{ \Carbon\Carbon::parse($time)->format('g:i A') }} - {{ $count }}/{{ $max }}
                                        </div>
                                        @endforeach
                                        @endif
                                    </td>

                                    @else
                                    <td class="border border-gray-800 p-2 bg-gray-100"></td>
                                    @endif
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
        </div>
    </div>









    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-xl p-6 sm:p-10 my-6 sm:my-10">
        <h1 class="text-2xl sm:text-3xl font-900 font-bold text-center text-red-600 mb-6 sm:mb-8">Book an Appointment</h1>
        <p class="text-md text-gray-700 my-4 space-y-2">
            <strong>Note:</strong> This appointment is for prioritization purposes only and does <em>not</em> guarantee immediate service upon arrival.
            <br><br>
            If you do not show up for your scheduled appointment, your name will be removed from the appointment list and you will need to book again. We appreciate your understanding.
        </p>
        <p class="text-md text-gray-700 mt-6 mb-3 space-y-2 font-bold">
            Please fill out the form below to schedule your appointment.
        </p>

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
                <h2 class="text-md font-bold text-gray-700">{!! nl2br(e(session('success'))) !!}
                </h2>
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
        @if(session('error'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition.opacity.duration.300ms
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <!-- Modal content -->
            <div
                @click.outside="show = false"
                class="bg-white rounded-2xl shadow-lg w-full max-w-lg p-6 text-center relative">
                <!-- Close button -->
                <button
                    @click="show = false"
                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl leading-none">
                    &times;
                </button>
                <!-- Error Icon -->
                <div class="flex flex-col items-center justify-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="200" height="140"
                        viewBox="0 0 24 24" fill="#FF4B4B" stroke="white"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-alert-octagon">
                        <path d="M7.86 2h8.28l5.86 5.86v8.28L16.14 22H7.86L2 16.14V7.86z" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    <h2 class="text-2xl font-900 text-[#FF4B4B]">Booking Failed!</h2>
                    <p class="text-gray-800 font-bold text-sm mt-1">
                        {{ session('error') }}
                    </p>
                    <div class="flex justify-end items-end w-full">
                        <button
                            @click="show = false"
                            class="mt-4 text-white bg-gray-600 font-semibold py-2 px-4 rounded-lg">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <form id="bookingForm" action="{{ route('booking.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mt-2">
            @csrf

            <!-- Left Column -->
            <div class="space-y-4 sm:space-y-6">
                <div>
                    <label for="name" class="block text-xs sm:text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                        class="mt-1 block w-full px-2 sm:px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 transition" required readonly>
                    @error('name') <p class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="contact_number" class="block text-xs sm:text-sm font-medium text-gray-700">Contact Number</label>
                    <input type="tel" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" maxlength="13"
                        class="mt-1 block w-full px-2 sm:px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 transition" required>
                    @error('contact_number') <p class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs sm:text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                        class="mt-1 block w-full px-2 sm:px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 transition" required readonly>
                    @error('email') <p class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="treatment_type" class="block text-xs sm:text-sm font-medium text-gray-700">Type of Treatment</label>
                    <select id="treatment_type" name="treatment_type"
                        class="mt-1 block w-full px-2 sm:px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 transition" required>
                        <option value="">Select...</option>
                        @foreach($services as $service)
                        <option value="{{ $service->name }}">
                            {{ $service->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('treatment_type') <p class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-4 sm:space-y-6">
                <div>
                    <label for="appointment_date" class="block text-xs sm:text-sm font-medium text-gray-700">Date of Appointment</label>
                    <input type="text" id="appointment_date" name="appointment_date" value="{{ old('appointment_date') }}"
                        class="mt-1 block w-full px-2 sm:px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 transition" required>
                    @error('appointment_date') <p class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="appointment_time" class="block text-xs sm:text-sm font-medium text-gray-700">Preferred Time</label>
                    <select id="appointment_time" name="appointment_time"
                        class="mt-1 block w-full px-2 sm:px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 transition" required>
                        <option value="">Select a date first...</option>
                    </select>
                    @error('appointment_time') <p class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="additional_notes" class="block text-xs sm:text-sm font-medium text-gray-700">Additional Notes (if none, just leave it blank)</label>
                    <textarea id="additional_notes" name="additional_notes" rows="4"
                        class="mt-1 block w-full px-2 sm:px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 transition">{{ old('additional_notes') }}</textarea>
                    @error('additional_notes') <p class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-2 sm:pt-4">
                    <button type="submit" id="submitBtn"
                        class="w-full bg-red-600 text-white py-2 sm:py-3 px-4 text-sm sm:text-base rounded-md hover:bg-red-700 transition transform hover:scale-105 font-medium">
                        Submit Booking
                    </button>
                </div>
            </div>
        </form>

        <!-- Reschedule Modal -->
        <div id="rescheduleModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4 p-4 sm:p-6 max-h-[90vh] overflow-y-auto">
                <h3 class="text-lg sm:text-xl font-bold mb-4">Reschedule Appointment</h3>

                <label for="reschedule_date" class="block text-sm font-medium text-gray-700">New Date</label>
                <input type="text" id="reschedule_date" class="mt-1 block w-full px-3 py-2 border rounded-md text-sm sm:text-base">

                <label for="reschedule_time" class="block text-sm font-medium text-gray-700 mt-4">New Time</label>
                <select id="reschedule_time" class="mt-1 block w-full px-3 py-2 border rounded-md text-sm sm:text-base">
                    <option value="">Select date first...</option>
                </select>

                <div class="mt-6 flex flex-col sm:flex-row justify-end gap-2 sm:gap-3">
                    <button id="closeModalBtn" class="w-full sm:w-auto px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">Cancel</button>
                    <button id="saveRescheduleBtn" class="w-full sm:w-auto px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Save</button>
                </div>
            </div>
        </div>

        <!-- Confirmation Modal (Cancel Appointment) -->
        <div id="confirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4 p-4 sm:p-6">
                <h3 class="text-lg sm:text-xl font-bold mb-4">Confirm Cancellation</h3>
                <p id="confirmMessage" class="text-sm sm:text-base text-gray-700 mb-6"></p>
                <div class="flex flex-col sm:flex-row justify-end gap-2 sm:gap-3">
                    <button id="confirmCancelBtn" class="w-full sm:w-auto px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition">No</button>
                    <button id="confirmOkBtn" class="w-full sm:w-auto px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Yes</button>
                </div>
            </div>
        </div>

        <!-- Alert Modal (Success/Error Messages) -->
        <div id="alertModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4 p-4 sm:p-6">
                <div class="flex items-center mb-4">
                    <div id="alertIcon" class="mr-3 flex-shrink-0"></div>
                    <h3 id="alertTitle" class="text-lg sm:text-xl font-bold"></h3>
                </div>
                <p id="alertMessage" class="text-sm sm:text-base text-gray-700 mb-6"></p>
                <div class="flex justify-end">
                    <button id="alertOkBtn" class="w-full sm:w-auto px-6 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">OK</button>
                </div>
            </div>
        </div>
    </div>

    </div>






    <script>
        //PHONE NUMBER FORMATTER
        function formatContactNumber(input) {
            let value = input.value.replace(/\D/g, ""); // remove non-digits

            if (value.length > 4 && value.length <= 7) {
                value = value.replace(/(\d{4})(\d+)/, "$1 $2");
            } else if (value.length > 7) {
                value = value.replace(/(\d{4})(\d{3})(\d+)/, "$1 $2 $3");
            }

            input.value = value;
        }
        const contactInput = document.getElementById("contact_number");

        // Format while typing
        contactInput.addEventListener("input", function(e) {
            formatContactNumber(e.target);
        });
        // Format immediately on page load if value exists
        window.addEventListener("DOMContentLoaded", function() {
            if (contactInput.value) {
                formatContactNumber(contactInput);
            }
        });


        // Modal Helper Functions
        function showAlert(message, type = 'success') {
            const modal = document.getElementById('alertModal');
            const title = document.getElementById('alertTitle');
            const messageEl = document.getElementById('alertMessage');
            const icon = document.getElementById('alertIcon');

            messageEl.textContent = message;

            if (type === 'success') {
                title.textContent = 'Success';
                icon.innerHTML = '<svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
            } else {
                title.textContent = 'Error';
                icon.innerHTML = '<svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
            }

            modal.classList.remove('hidden');
        }

        function showConfirm(message, callback) {
            const modal = document.getElementById('confirmModal');
            const messageEl = document.getElementById('confirmMessage');
            const okBtn = document.getElementById('confirmOkBtn');
            const cancelBtn = document.getElementById('confirmCancelBtn');

            messageEl.textContent = message;
            modal.classList.remove('hidden');

            okBtn.onclick = function() {
                modal.classList.add('hidden');
                callback(true);
            };

            cancelBtn.onclick = function() {
                modal.classList.add('hidden');
                callback(false);
            };
        }

        document.getElementById('alertOkBtn').onclick = function() {
            document.getElementById('alertModal').classList.add('hidden');
            location.reload();
        };

        function formatDate(isoString) {
            if (!isoString) return '';
            const date = new Date(isoString);
            return date.toLocaleDateString(undefined, {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }

        function formatTime(timeString) {
            if (!timeString) return '';
            const [hours, minutes] = timeString.split(':');
            const date = new Date();
            date.setHours(hours, minutes);
            return date.toLocaleTimeString([], {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });
        }

        const datePicker = flatpickr("#appointment_date", {
            minDate: new Date().setDate(new Date().getDate() + 1),
            disable: [
                function(date) {
                    return (date.getDay() === 0 || date.getDay() === 7);
                }
            ],
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr) {
                if (dateStr) fetchAvailableSlots(dateStr);
                else document.getElementById('appointment_time').innerHTML = '<option value="">Select a date first...</option>';
            }
        });

        function fetchAvailableSlots(date) {
            fetch(`{{ route('booking.slots') }}?date=${date}`)
                .then(res => res.json())
                .then(slots => {
                    const select = document.getElementById('appointment_time');
                    select.innerHTML = '<option value="">Select a time slot...</option>';
                    slots.forEach(slot => {
                        const option = document.createElement('option');
                        option.value = slot;
                        option.textContent = formatTime(slot);
                        select.appendChild(option);
                    });
                })
                .catch(err => console.error('Error fetching slots:', err));
        }

        const statusCell = document.getElementById('detail_status');

        document.getElementById('bookingForm')?.addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.innerHTML = `
            <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
            </svg>
            <span>Processing...</span>
        `;
            btn.disabled = true;
        });

        const appointments = JSON.parse('@json($appointmentsJson ?? [])');
        const cancelBtn = document.getElementById('cancelBtn');
        const rescheduleBtn = document.getElementById('rescheduleBtn');

        document.getElementById('appointment_dropdown')?.addEventListener('change', function() {
            const selectedId = this.value;
            const detailsDiv = document.getElementById('appointment_details');

            if (!selectedId) {
                detailsDiv.classList.add('hidden');
                cancelBtn.style.display = 'none';
                rescheduleBtn.style.display = 'none';
                return;
            }

            const appointment = appointments.find(a => a.id == selectedId);
            if (!appointment) return;

            document.getElementById('detail_booking_reference').textContent = appointment.booking_reference;
            document.getElementById('detail_name').textContent = appointment.name;
            document.getElementById('detail_contact').textContent = appointment.contact_number;
            document.getElementById('detail_email').textContent = appointment.email;
            document.getElementById('detail_treatment').textContent = appointment.treatment_type.toUpperCase();
            document.getElementById('detail_date').textContent = formatDate(appointment.appointment_date);
            document.getElementById('detail_time').textContent = formatTime(appointment.appointment_time);
            document.getElementById('detail_notes').textContent = appointment.additional_notes || 'None';

            // Set status with color coding
            if (appointment.status === 'Arrived') {
                statusCell.textContent = 'Arrived';
                statusCell.className = 'py-2 font-bold text-m text-green-600';
            } else if (appointment.status === 'Rescheduled') {
                statusCell.textContent = 'Rescheduled';
                statusCell.className = 'py-2 font-bold text-m text-blue-600';
            } else {
                statusCell.textContent = 'Pending';
                statusCell.className = 'py-2 font-bold text-m text-yellow-600';
            }

            detailsDiv.classList.remove('hidden');

            if (appointment.status === 'Pending' || appointment.status === 'Rescheduled') {
                cancelBtn.style.display = 'inline-block';
                rescheduleBtn.style.display = 'inline-block';
            } else {
                cancelBtn.style.display = 'none';
                rescheduleBtn.style.display = 'none';
            }
        });

        cancelBtn.addEventListener('click', function() {
            const selectedId = document.getElementById('appointment_dropdown').value;
            if (!selectedId) return;

            showConfirm('Are you sure you want to cancel this appointment?', function(confirmed) {
                if (!confirmed) return;

                fetch(`/book/${selectedId}/cancel`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        showAlert(data.message || 'Appointment cancelled', 'success');
                    })
                    .catch(err => {
                        console.error(err);
                        showAlert('Failed to cancel appointment', 'error');
                    });
            });
        });

        rescheduleBtn.addEventListener('click', function() {
            const selectedId = document.getElementById('appointment_dropdown').value;
            const appointment = appointments.find(a => a.id == selectedId);
            if (!appointment) {
                showAlert('No appointment selected', 'error');
                return;
            }

            const modal = document.getElementById('rescheduleModal');
            const rescheduleDate = document.getElementById('reschedule_date');
            const rescheduleTime = document.getElementById('reschedule_time');

            modal.classList.remove('hidden');

            flatpickr(rescheduleDate, {
                defaultDate: appointment.appointment_date,
                minDate: new Date().setDate(new Date().getDate() + 1),
                disable: [
                    function(date) {
                        return (date.getDay() === 0 || date.getDay() === 6);
                    }
                ],
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr) {
                    if (dateStr) fetchAvailableRescheduleSlots(dateStr);
                    else rescheduleTime.innerHTML = '<option value="">Select date first...</option>';
                }
            });

            fetchAvailableRescheduleSlots(appointment.appointment_date, appointment.appointment_time);

            document.getElementById('closeModalBtn').onclick = function() {
                modal.classList.add('hidden');
            };

            document.getElementById('saveRescheduleBtn').onclick = function() {
                const newDate = rescheduleDate.value;
                const newTime = rescheduleTime.value;

                if (!newDate || !newTime) {
                    showAlert('Please select a new date and time', 'error');
                    return;
                }

                fetch(`/book/${selectedId}/reschedule`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            appointment_date: newDate,
                            appointment_time: newTime
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        modal.classList.add('hidden');
                        showAlert(data.message || 'Appointment rescheduled successfully', 'success');
                    })
                    .catch(err => {
                        console.error(err);
                        showAlert('Failed to reschedule appointment', 'error');
                    });
            };
        });

        function fetchAvailableRescheduleSlots(date, selectedTime = null) {
            fetch(`{{ route('booking.slots') }}?date=${date}`)
                .then(res => res.json())
                .then(slots => {
                    const select = document.getElementById('reschedule_time');
                    select.innerHTML = '<option value="">Select a time slot...</option>';

                    slots.forEach(slot => {
                        const option = document.createElement('option');
                        option.value = slot;
                        option.textContent = formatTime(slot);
                        if (slot === selectedTime) option.selected = true;
                        select.appendChild(option);
                    });
                })
                .catch(err => console.error('Error fetching slots:', err));
        }
    </script>
</x-app-layout>