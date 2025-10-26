<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-xl p-4 sm:p-6 my-6 sm:my-10">
        <h2 class="text-xl sm:text-2xl font-bold text-center text-gray-800 mb-4 sm:mb-6">Your Appointments</h2>

        @if($appointments->count() > 0)
            <div class="text-center mb-6 px-2">
                <label for="appointment_dropdown" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                    Select an appointment to view details:
                </label>
                <select id="appointment_dropdown"
                        class="block w-full md:w-3/4 lg:w-1/2 mx-auto px-2 sm:px-3 py-2 text-xs sm:text-sm md:text-base border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 transition">
                    <option value="">-- Select Appointment --</option>
                    @foreach($appointments as $appointment)
                        @if($appointment->status === 'Pending' || $appointment->status === 'Completed')
                            <option value="{{ $appointment->id }}" 
                                    data-status="{{ $appointment->status }}"
                                    class="appointment-option"
                                    style="
                                        @if($appointment->status === 'Completed')
                                            color: #065f46; 
                                            background-color: #d1fae5;
                                            font-weight: 600;
                                        @else
                                            color: #000000;
                                        @endif
                                    ">
                                {{ ucfirst($appointment->treatment_type) }} on {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}
                                
                            </option>
                        @endif
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


    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-xl p-6 sm:p-10 my-6 sm:my-10">
        <h1 class="text-2xl sm:text-3xl font-bold text-center text-red-600 mb-6 sm:mb-8">Book an Appointment</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6 text-center">
                {{ session('error') }}
            </div>
        @endif

        <form id="bookingForm" action="{{ route('booking.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            @csrf

            <!-- Left Column -->
            <div class="space-y-4 sm:space-y-6">
                <div>
                    <label for="name" class="block text-xs sm:text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                        class="mt-1 block w-full px-2 sm:px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 transition" required readonly >
                    @error('name') <p class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="contact_number" class="block text-xs sm:text-sm font-medium text-gray-700">Contact Number</label>
                    <input type="tel" id="contact_number" name="contact_number" value="{{ old('contact_number') }}"
                        class="mt-1 block w-full px-2 sm:px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 transition" required>
                    @error('contact_number') <p class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-xs sm:text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                        class="mt-1 block w-full px-2 sm:px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 transition" required readonly>
                    @error('email') <p class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="treatment_type" class="block text-xs sm:text-sm font-medium text-gray-700">Type of Treatment</label>
                    <select id="treatment_type" name="treatment_type"
                            class="mt-1 block w-full px-2 sm:px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 transition" required>
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
                        class="mt-1 block w-full px-2 sm:px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 transition" required>
                    @error('appointment_date') <p class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="appointment_time" class="block text-xs sm:text-sm font-medium text-gray-700">Preferred Time</label>
                    <select id="appointment_time" name="appointment_time"
                            class="mt-1 block w-full px-2 sm:px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 transition" required>
                        <option value="">Select a date first...</option>
                    </select>
                    @error('appointment_time') <p class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="additional_notes" class="block text-xs sm:text-sm font-medium text-gray-700">Additional Notes (if none, just leave it blank)</label>
                    <textarea id="additional_notes" name="additional_notes" rows="4" 
                        class="mt-1 block w-full px-2 sm:px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 transition">{{ old('additional_notes') }}</textarea>
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

    <script>
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
            return date.toLocaleDateString(undefined, { year: 'numeric', month: 'long', day: 'numeric' });
        }

        function formatTime(timeString) {
            if (!timeString) return '';
            const [hours, minutes] = timeString.split(':');
            const date = new Date();
            date.setHours(hours, minutes);
            return date.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit', hour12: true });
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
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
            btn.disabled = true;
        });

        const appointments = JSON.parse('@json($appointmentsJson ?? [])');
        const cancelBtn = document.getElementById('cancelBtn');
        const rescheduleBtn = document.getElementById('rescheduleBtn');

        document.getElementById('appointment_dropdown')?.addEventListener('change', function () {
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
            if (appointment.status === 'Completed') {
                statusCell.textContent = 'Completed';
                statusCell.className = 'py-2 font-bold text-m text-green-600';
            } else {
                statusCell.textContent = 'Pending';
                statusCell.className = 'py-2 font-bold text-m text-yellow-600';
            }
            
            detailsDiv.classList.remove('hidden');

            if (appointment.status === 'Pending') {
                cancelBtn.style.display = 'inline-block';
                rescheduleBtn.style.display = 'inline-block';
            } else {
                cancelBtn.style.display = 'none';
                rescheduleBtn.style.display = 'none';
            }
        });

        cancelBtn.addEventListener('click', function () {
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

        rescheduleBtn.addEventListener('click', function () {
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

            document.getElementById('closeModalBtn').onclick = function () {
                modal.classList.add('hidden');
            };

            document.getElementById('saveRescheduleBtn').onclick = function () {
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
                    body: JSON.stringify({ appointment_date: newDate, appointment_time: newTime })
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