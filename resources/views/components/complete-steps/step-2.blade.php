<div id="step-2" class="step hidden">
    <div class="flex flex-col gap-2">
        <div class="grid grid-cols-12 gap-2">
            <div class="col-span-12 grid grid-cols-12 md:px-4 gap-4 md:gap-12">
                <div class="col-span-12 md:col-span-6 flex flex-col justify-end items-end ">
                    <div class="flex flex-col gap-4">
                        <h2 class="md:text-lg text-gray-700 font-900 ">Payment Transaction</h2>
                        <div>
                            <h2 class="text-xs md:text-md text-gray-500 font-900 ">Date of Transaction</h2>
                            <input type="date" id="dateOfTransaction" name="dateOfTransaction" required
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                            <p id="error_dateOfTransaction" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                        </div>
                        <div>
                            <h2 class="text-xs md:text-md text-gray-500 font-900 ">Service Received: </h2>
                            @props(['schedules'])
                            @props(['service_fee'])
                            <p>{{ $service_fee->name }} ({{ $schedules->Day }})</p>
                        </div>
                        <div class="flex gap-2  justify-between"
                            x-data="{ open: false, staff_id: null, staff_name: 'Select Staff', modalOpen: false}">
                            <!-- Nurse Dropdown -->
                            <div>
                                <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">In-Charge in Payment: </h2>
                                <p id="verifyStaffSuccess" class="text-green-500 text-sm mt-1 hidden mb-2">Verified successfully.</p>


                                @props(['staffs'])
                                <div class="relative">
                                    <!-- Hidden input to store the selected id -->
                                    <input type="hidden" name="staff_id" x-model="staff_id" required>
                                    <!-- Button / Display -->
                                    <button type="button"
                                        @click="open = !open"
                                        id="staffDropdownButton"
                                        class="w-full border border-gray-300 text-gray-900 rounded-lg px-4 py-2 text-left bg-white flex justify-between items-center text-sm focus:ring-sky-500 focus:border-sky-500">
                                        <span x-text="staff_name"></span>
                                        <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
                                    </button>
                                    <!-- Dropdown list -->
                                    <div x-show="open"
                                        @click.outside="open = false"
                                        class="absolute z-10 mt-1 w-full bg-white border rounded shadow max-h-40 overflow-y-auto scrollbar-hidden">
                                        @if (count($staffs) === 0)
                                        <div class="px-3 py-2 text-sm text-gray-500">
                                            No staffs available
                                        </div>
                                        @else
                                        @foreach ($staffs as $staff)
                                        <div @click="staff_id = '{{ $staff->id }}'; staff_name = '{{ $staff->first_name }} {{ $staff->last_name }}'; open = false"
                                            class="px-3 py-2 cursor-pointer hover:bg-gray-100 text-sm">
                                            {{ $staff->first_name }} {{ $staff->last_name }}
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Verify Button -->
                            <div class="flex flex-col ">
                                <h2 class="text-xs md:text-md text-gray-500 font-900 mb-3">Verification</h2>
                                <!-- Original Verify Button -->
                                <button
                                    id="verifyButtonPayment"
                                    type="button"
                                    :disabled="!staff_id"
                                    @click="$dispatch('complete-payment-modal', { staff_id: staff_id, staff_name: staff_name })"
                                    class="text-blue-500 flex items-center justify-center font-bold hover:underline underline-offset-4 hover:cursor-pointer ">
                                    Verify
                                </button>
                                <h2 id="verifiedStaffLabel" class="text-green-500 text-center hidden">Verified</h2>

                            </div>
                        </div>
                        <p id="error_staff" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                        <p id="NotVerifiedStaff" class="text-red-500 text-xs mt-1 hidden">*Please verify to continue</p>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-2 flex flex-col gap-2">
                    <div class="flex flex-col mt-6">
                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Service Fee: </h2>
                        <input type="text" id="service_fee" name="service_fee" disabled value="{{ $service_fee->service_fee }}" required
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                        <p id="error_service_fee" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                    </div>
                    <div class="flex flex-col">
                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Additional Fee:</h2>
                        <input type="text" id="additional_fee" name="additional_fee" placeholder="Leave blank if N/A"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                        <p id="error_additional_fee" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                    </div>
                    <div class="flex flex-col">
                        <h2 class="text-xs md:text-md text-gray-500 font-900 ">Total Amount:</h2>
                        <div class="flex items-center gap-2">
                            <i data-lucide="philippine-peso" class="text-red-500 "></i>
                            <h1 id="total_amount_display" class="text-2xl text-red-500 font-bold">500.00</h1>
                        </div>
                        <input type="hidden" id="total_amount" name="total_amount" required
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                        <p id="error_total_amount" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const servicePrice = document.getElementById('service_fee');
    const additionalPrice = document.getElementById('additional_fee');
    const totalAmountDisplay = document.getElementById('total_amount_display');
    const totalAmountInput = document.getElementById('total_amount');

    function allowOnlyNumbersAndDot(input) {
        // Remove invalid characters (anything not a digit or dot)
        input.value = input.value.replace(/[^0-9.]/g, '');

        // Allow only one dot
        const parts = input.value.split('.');
        if (parts.length > 2) {
            input.value = parts[0] + '.' + parts.slice(1).join('');
        }
    }

    function calculateTotal() {
        const servicePriceValue = parseFloat(servicePrice.value) || 0;
        const additionalPriceValue = parseFloat(additionalPrice.value) || 0;
        const total = servicePriceValue + additionalPriceValue;
        totalAmountDisplay.textContent = total.toFixed(2);
        totalAmountInput.value = total.toFixed(2);
    }

    function handleInput(e) {
        allowOnlyNumbersAndDot(e.target);
        calculateTotal();
    }

    // 🔹 Listen for typing (input event)
    servicePrice.addEventListener('input', handleInput);
    additionalPrice.addEventListener('input', handleInput);

    // 🔹 Run once on page load
    calculateTotal();


    function dateOfTransactionToday() {
        const dateInput = document.getElementById("dateOfTransaction");
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, "0");
        const day = String(today.getDate()).padStart(2, "0");
        dateInput.value = `${year}-${month}-${day}`;
    }
    dateOfTransactionToday();


    function validateStep2() {
        let isValid = true;
        // Special: Staff dropdown validation
        const staffInput = document.querySelector("#step-2 input[name='staff_id']");
        if (staffInput && !staffInput.value.trim()) {
            const staffBtn = document.getElementById("staffDropdownButton");
            if (staffBtn) {
                staffBtn.classList.remove("border-gray-300");
                staffBtn.classList.add("border-red-500");
            }
            const staffError = document.getElementById("error_staff");
            if (staffError) staffError.classList.remove("hidden");
            isValid = false;
        }
        // Verification check 
        const verifiedStaffLabel = document.getElementById("verifiedStaffLabel");
        const notVerifiedStaff = document.getElementById("NotVerifiedStaff");

        if (verifiedStaffLabel.classList.contains("hidden")) {
            // Not verified → block progression
            if (notVerifiedStaff) notVerifiedStaff.classList.remove("hidden");
            isValid = false;
        } else {
            // Verified → hide the red warning if shown
            if (notVerifiedStaff) notVerifiedStaff.classList.add("hidden");
        }
        return isValid;

    }
</script>
<script>
    function clearFieldError(el) {
        if (el.type === "hidden") {
            // For hidden inputs, clear their related dropdown button + error message
            const btnId = el.name.replace("_id", "") + "_dropdown_button";
            const btn = document.getElementById(btnId);
            if (btn) {
                btn.classList.remove("border-red-500");
                btn.classList.add("border-gray-300");
            }

            const errorP =
                document.getElementById("error_" + el.id) ||
                document.getElementById("error_" + el.name);
            if (errorP) errorP.classList.add("hidden");

        } else {
            // Normal input/select/button cleanup
            el.classList.remove("border-red-500");
            if (el.tagName === "INPUT" || el.tagName === "SELECT" || el.tagName === "BUTTON") {
                el.classList.add("border-gray-300");
            }

            const errorP =
                document.getElementById("error_" + el.id) ||
                document.getElementById("error_" + el.name);
            if (errorP) errorP.classList.add("hidden");
        }
    }

    // Attach to visible UI controls (not hidden inputs)
    document.querySelectorAll("#step-2 input:not([type=hidden]), #step-2 select, #step-2 button").forEach(el => {
        el.addEventListener("input", () => clearFieldError(el));
        el.addEventListener("change", () => clearFieldError(el));
        el.addEventListener("click", () => clearFieldError(el));
    });

    // Also attach directly to hidden inputs (in case x-model changes their value)
    document.querySelectorAll("#step-2 input[type=hidden]").forEach(el => {
        const observer = new MutationObserver(() => clearFieldError(el));
        observer.observe(el, {
            attributes: true,
            attributeFilter: ["value"]
        });
    });
</script>