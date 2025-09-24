<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-xl p-6 my-10">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Your Appointments</h2>

        @if($appointments->count() > 0)
            <div class="text-center mb-6">
                <label for="appointment_dropdown" class="block text-sm font-medium text-gray-700 mb-2">
                    Select an appointment to view details:
                </label>
                <select id="appointment_dropdown"
                        class="block w-full md:w-1/2 mx-auto px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 transition">
                    <option value="">-- Select Appointment --</option>
                    @foreach($appointments as $appointment)
                        <option value="{{ $appointment->id }}">
                            {{ ucfirst($appointment->treatment_type) }} on {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}
                            ({{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="appointment_details" class="hidden border border-gray-200 rounded-lg shadow-sm bg-gray-50 p-6">
                <table class="w-full text-left">
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <th class="py-2 w-1/3 font-medium text-gray-700">Name</th>
                            <td id="detail_name" class="py-2"></td>
                        </tr>
                        <tr>
                            <th class="py-2 font-medium text-gray-700">Contact</th>
                            <td id="detail_contact" class="py-2"></td>
                        </tr>
                        <tr>
                            <th class="py-2 font-medium text-gray-700">Email</th>
                            <td id="detail_email" class="py-2"></td>
                        </tr>
                        <tr>
                            <th class="py-2 font-medium text-gray-700">Treatment</th>
                            <td id="detail_treatment" class="py-2"></td>
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
                            <td id="detail_status" class="py-2 font-semibold">
                                <span id="status_badge" class="px-2 py-1 rounded text-white text-sm"></span>
                            </td>
                        </tr>
                        <tr>
                            <th class="py-2 font-medium text-gray-700">Notes</th>
                            <td id="detail_notes" class="py-2"></td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-6 flex justify-end gap-3">
                    <button id="cancelBtn" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">Cancel</button>
                    <button id="rescheduleBtn" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition">Reschedule</button>
                </div>
            </div>
        @else
            <p class="text-center text-gray-500">No appointments found.</p>
        @endif
    </div>


    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-xl p-10 my-10">
        <h1 class="text-3xl font-bold text-center text-red-600 mb-8">Book an Appointment</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif

        <form id="bookingForm" action="{{ route('booking.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            <!-- Left Column -->
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 transition" required>
                    @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <input type="tel" id="contact_number" name="contact_number" value="{{ old('contact_number') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 transition" required>
                    @error('contact_number') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 transition" required>
                    @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="treatment_type" class="block text-sm font-medium text-gray-700">Type of Treatment</label>
                    <select id="treatment_type" name="treatment_type"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 transition" required>
                        <option value="">Select...</option>
                        <option value="pep" {{ old('treatment_type') == 'pep' ? 'selected' : '' }}>PEP (Post-Exposure Prophylaxis)</option>
                        <option value="prep" {{ old('treatment_type') == 'prep' ? 'selected' : '' }}>PrEP (Pre-Exposure Prophylaxis)</option>
                        <option value="boosters" {{ old('treatment_type') == 'boosters' ? 'selected' : '' }}>Boosters</option>
                    </select>
                    @error('treatment_type') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <div>
                    <label for="appointment_date" class="block text-sm font-medium text-gray-700">Date of Appointment</label>
                    <input type="text" id="appointment_date" name="appointment_date" value="{{ old('appointment_date') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 transition" required>
                    @error('appointment_date') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="appointment_time" class="block text-sm font-medium text-gray-700">Preferred Time</label>
                    <select id="appointment_time" name="appointment_time"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 transition" required>
                        <option value="">Select a date first...</option>
                    </select>
                    @error('appointment_time') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="additional_notes" class="block text-sm font-medium text-gray-700">Additional Notes (if none, just leave it black)</label>
                    <textarea id="additional_notes" name="additional_notes" rows="5"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 transition">{{ old('additional_notes') }}</textarea>
                    @error('additional_notes') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" id="submitBtn"
                            class="w-full bg-red-600 text-white py-3 px-4 rounded-md hover:bg-red-700 transition transform hover:scale-105">
                        Submit Booking
                    </button>
                </div>
            </div>
        </form>
        <!-- Reschedule Modal -->
        <div id="rescheduleModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h3 class="text-xl font-bold mb-4">Reschedule Appointment</h3>

                <label for="reschedule_date" class="block text-sm font-medium text-gray-700">New Date</label>
                <input type="text" id="reschedule_date" class="mt-1 block w-full px-3 py-2 border rounded-md">

                <label for="reschedule_time" class="block text-sm font-medium text-gray-700 mt-4">New Time</label>
                <select id="reschedule_time" class="mt-1 block w-full px-3 py-2 border rounded-md">
                    <option value="">Select date first...</option>
                </select>

                <div class="mt-6 flex justify-end gap-3">
                    <button id="closeModalBtn" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button id="saveRescheduleBtn" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Save</button>
                </div>
            </div>
        </div>
    </div>
    <script>
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
                    return (date.getDay() === 0 || date.getDay() === 6); // Disable the weekend (pwedeng mabago, if pwede sa clinic weekend)
                }
            ],
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr) {
                if (dateStr) fetchAvailableSlots(dateStr);
                else document.getElementById('appointment_time').innerHTML = '<option value="">Select a date first...</option>';
            }
        });

        // Fetch available time slots for a date
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

        const statusBadge = document.getElementById('status_badge');

        document.getElementById('appointment_dropdown')?.addEventListener('change', function() {
            const selectedId = this.value;
            const appointment = appointments.find(a => a.id == selectedId);
            if (!appointment) return;

            // Set badge color based on status
            if (appointment.status === 'Cancelled') {
                statusBadge.textContent = 'Cancelled';
                statusBadge.className = 'px-2 py-1 rounded text-white text-sm bg-red-600';
            } else {
                statusBadge.textContent = 'Pending';
                statusBadge.className = 'px-2 py-1 rounded text-white text-sm bg-green-600';
            }
        });


        // Disable submit button after clicking
        document.getElementById('bookingForm')?.addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
            btn.disabled = true;
        });

        
        const appointments = JSON.parse('@json($appointmentsJson ?? [])');
        const cancelBtn = document.getElementById('cancelBtn');
        const rescheduleBtn = document.getElementById('rescheduleBtn');

        // Show appointment details
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

            document.getElementById('detail_name').textContent = appointment.name;
            document.getElementById('detail_contact').textContent = appointment.contact_number;
            document.getElementById('detail_email').textContent = appointment.email;
            document.getElementById('detail_treatment').textContent = appointment.treatment_type.toUpperCase();
            document.getElementById('detail_date').textContent = formatDate(appointment.appointment_date);
            document.getElementById('detail_time').textContent = formatTime(appointment.appointment_time);
            document.getElementById('detail_status').textContent = appointment.status;
            document.getElementById('detail_notes').textContent = appointment.additional_notes || 'None';
            detailsDiv.classList.remove('hidden');

            // Show/hide buttons based on appointment status
            if (appointment.status === 'Pending') {
                cancelBtn.style.display = 'inline-block';
                rescheduleBtn.style.display = 'inline-block';
            } else {
                cancelBtn.style.display = 'none';
                rescheduleBtn.style.display = 'none';
            }
        });

        // Cancel appointment
        cancelBtn.addEventListener('click', function () {
            const selectedId = document.getElementById('appointment_dropdown').value;
            if (!selectedId || !confirm('Are you sure you want to cancel this appointment?')) return;

            fetch(`/book/${selectedId}/cancel`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message || 'Appointment cancelled');
                location.reload();
            })
            .catch(err => console.error(err));
        });

        // Reschedule appointment
        rescheduleBtn.addEventListener('click', function () {
            const selectedId = document.getElementById('appointment_dropdown').value;
            const appointment = appointments.find(a => a.id == selectedId);
            if (!appointment) return alert('No appointment selected');

            const modal = document.getElementById('rescheduleModal');
            const rescheduleDate = document.getElementById('reschedule_date');
            const rescheduleTime = document.getElementById('reschedule_time');

            // Show modal
            modal.classList.remove('hidden');

            // Initialize Flatpickr for reschedule date
            flatpickr(rescheduleDate, {
                defaultDate: appointment.appointment_date,
                minDate: new Date().setDate(new Date().getDate() + 1),
                disable: [
                    function(date) {
                        return (date.getDay() === 0 || date.getDay() === 6); // disable weekends
                    }
                ],
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr) {
                    if (dateStr) fetchAvailableRescheduleSlots(dateStr);
                    else rescheduleTime.innerHTML = '<option value="">Select date first...</option>';
                }
            });

            // Fetch available time slots for the current appointment date
            fetchAvailableRescheduleSlots(appointment.appointment_date, appointment.appointment_time);

            // Close modal button
            document.getElementById('closeModalBtn').onclick = function () {
                modal.classList.add('hidden');
            };

            // Save reschedule button
            document.getElementById('saveRescheduleBtn').onclick = function () {
                const newDate = rescheduleDate.value;
                const newTime = rescheduleTime.value;
                if (!newDate || !newTime) return alert('Please select a new date and time');

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
                    alert(data.message || 'Appointment rescheduled successfully');
                    modal.classList.add('hidden');
                    location.reload(); // refresh to show updated appointment
                })
                .catch(err => console.error(err));
            };
        });

        // Fetch available time slots for reschedule
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
                        if (slot === selectedTime) option.selected = true; // pre-select current time
                        select.appendChild(option);
                    });
                })
                .catch(err => console.error('Error fetching slots:', err));
        }

        // Helper function to format time
        function formatTime(timeString) {
            if (!timeString) return '';
            const [hours, minutes] = timeString.split(':');
            const date = new Date();
            date.setHours(hours, minutes);
            return date.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit', hour12: true });
        }
    </script>
</x-app-layout>