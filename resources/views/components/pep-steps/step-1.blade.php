@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
@vite([ 'resources/js/address.js'])
@endif
<!-- Step 1: Personal Information -->
<div id="step-1" class="step">
    <div class="flex flex-col gap-2">
        <div class="grid grid-cols-12 gap-2">
            <div class="col-span-12">
                <h2 class="md:text-lg text-gray-700 font-900 mb-2">Patient Information</h2>
            </div>
            <div class="col-span-12 md:col-span-4 ">
                <label for="first_name" class="block mb-2 text-sm font-bold text-gray-900">First Name</label>
                <input type="text" name="first_name" id="first_name" required placeholder="e.g Juan" autocomplete="given-name"
                    class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500 ">
                <p id="error_first_name" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
            </div>
            <div class="col-span-12 md:col-span-4 ">
                <label for="last_name" class="block mb-2 text-sm font-bold text-gray-900">Last Name</label>
                <input type="text" name="last_name" id="last_name" required placeholder="e.g Dela Cruz"
                    class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                <p id="error_last_name" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
            </div>
            <div class="col-span-12 md:col-span-2 ">
                <div class="grid grid-cols-2 gap-1 flex">
                    <div>
                        <label for="middleInitial" class="block mb-2 text-sm font-bold text-gray-900">M.I.</label>
                        <input type="text" name="middle_initial" id="middleInitial" required maxlength="2" placeholder="e.g R."

                            class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                        <p id="error_middleInitial" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                    </div>
                    <div>
                        <label for="suffix" class="block mb-2 text-sm font-bold text-gray-900">Suffix</label>
                        <input type="text" name="suffix" id="suffix" placeholder="e.g Jr."
                            maxlength="4"
                            class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5  focus:ring-sky-500 focus:border-sky-500">
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-2 md:ml-6 ">
                <label for="dateOfRegistration" class="block mb-2 text-sm font-bold text-gray-900">Date of Registration</label>
                <input type="date" name="date_of_registration" id="dateOfRegistration" required
                    class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5  focus:ring-sky-500 focus:border-sky-500">
                <p id="error_dateOfRegistration" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
            </div>

            <!-- divider border  -->
            <div class="col-span-12 border-2 border-gray-50 mt-4"></div>

            <!-- address  -->
            <div class="col-span-12 grid grid-cols-12 gap-2 ">
                <div class="col-span-12">
                    <h2 class="text-lg text-gray-700 font-900 ">Address</h2>
                </div>
                <div class="col-span-12 md:col-span-4">
                    <div class="mb-3 relative">
                        <label for="region_btn" class="text-sm mb-2 font-semibold">Region</label>
                        <!-- wrapper that gets the red border -->
                        <div class="w-full  flex items-center border rounded-lg px-2  " id="region_wrapper">
                            <div class="flex-1">
                                <button id="region_btn" type="button"
                                    class="w-full px-3 py-2 text-left bg-white flex justify-between items-center">
                                    <span id="region_selected">Select Region</span>
                                    <i data-lucide="chevron-down"></i>
                                </button>
                                <ul id="region"
                                    class="absolute w-full bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                            </div>
                        </div>
                        <input type="hidden" id="region_input" name="region">
                        <p id="error_region" class="text-end text-red-500 text-xs mt-1 hidden">*This field is required</p>
                    </div>
                </div>

                <!-- province  -->
                <div class="col-span-12 md:col-span-4">
                    <div class="mb-3 relative">
                        <label for="province_btn" class="text-sm mb-2 font-semibold">Province</label>
                        <div class="w-full  flex items-center border rounded-lg px-2  " id="province_wrapper">
                            <div class="flex-1">
                                <button id="province_btn" type="button"
                                    class="w-full  px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                    <span id="province_selected">Select Province</span>
                                    <i data-lucide="chevron-down"></i>
                                </button>
                                <ul id="province" class="absolute w-full   bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                            </div>
                            <!-- hidden input -->
                            <input type="hidden" name="province" id="province_input">
                        </div>
                        <p id="error_province" class="text-end text-red-500 text-xs mt-1 hidden">*This field is required</p>
                    </div>
                </div>
                <!-- city  -->
                <div class="col-span-12 md:col-span-4">
                    <div class="mb-3 relative">
                        <label for="city_btn" class="text-sm mb-2 font-semibold">City / Municipality </label>
                        <div class="w-full  flex items-center border rounded-lg px-2" id="city_wrapper">
                            <div class="flex-1">
                                <button id="city_btn" type="button"
                                    class="w-full  px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                    <span id="city_selected">Select City</span>
                                    <i data-lucide="chevron-down"></i>
                                </button>
                                <ul id="city" class="absolute w-full  bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                            </div>
                            <!-- hidden input -->
                            <input type="hidden" name="city" id="city_input">
                        </div>
                        <p id="error_city" class="text-end text-red-500 text-xs mt-1 hidden">*This field is required</p>
                    </div>
                </div>
                <!-- barangay and purok  -->
                <div class="col-span-12 md:col-span-12">
                    <div class="grid grid-cols-4 gap-4">
                        <!-- barangay  -->
                        <div class="col-span-4 md:col-span-2 mb-3 relative">
                            <label for="barangay_btn" class="text-sm mb-2 font-semibold">Barangay</label>
                            <div class="w-full  flex items-center border rounded-lg px-2 " id="barangay_wrapper">
                                <div class="flex-1">
                                    <button id="barangay_btn" type="button"
                                        class="w-full  px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                        <span id="barangay_selected">Select Barangay</span>
                                        <i data-lucide="chevron-down"></i>
                                    </button>
                                    <ul id="barangay" class="absolute w-full  bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                </div>
                                <!-- hidden input -->
                                <input type="hidden" name="barangay" id="barangay_input">
                            </div>
                            <p id="error_barangay" class="text-end text-red-500 text-xs mt-1 hidden">*This field is required</p>
                        </div>
                        <!-- purok  -->
                        <div class="col-span-4 md:col-span-2 ">
                            <label for="description" class="text-sm mb-2 font-semibold">Purok / Bldng No. </label>
                            <input type="text" name="description" id="description" required placeholder="e.g Purok-2" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                            <p id="error_description" class="text-end text-red-500 text-xs mt-1 hidden">*This field is required</p>
                        </div>
                    </div>
                </div>
                <!-- divider border  -->
                <div class="col-span-12 border-2 border-gray-50"></div>
            </div>
            <!-- contact & demographics  -->
            <div class="col-span-12 grid grid-cols-12 gap-2 ">
                <div class="col-span-12 md:col-span-6">
                    <h2 class="md:text-lg text-gray-700 font-900 ">Contact & Demographics</h2>
                </div>
                <div class="col-span-5 hidden md:block">
                    <h2 class="md:text-lg text-gray-700 font-900 mb-2">Vital Signs</h2>
                </div>
                <div class="col-span-12 md:col-span-6 grid grid-cols-6 gap-2 ">
                    <div class="col-span-6 md:col-span-2 ">
                        <label for="contact_number" class="block mb-2 text-sm font-bold text-gray-900">Phone Number</label>
                        <input type="text" name="contact_number" id="contact_number" required placeholder="e.g 09xx xxx xxxx" maxlength="13"
                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                        <p id="error_contact_number" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                    </div>
                    <div class="col-span-6 md:col-span-3 ">
                        @props(['emails'])
                        <input type="hidden" id="existing-emails" value="{{ json_encode($emails) }}">

                        <label for="email" class="block mb-2 text-sm font-bold text-gray-900">Email Address <span class="font-normal">( Optional )</span></label>
                        <input type="email" name="email" id="email" placeholder="example@gmail.com" autocomplete="email"
                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-0 focus:border-sky-500">
                        <p id="error_email" class="text-red-500 text-xs mt-1 hidden"></p>

                    </div>
                    <div class="col-span-6 md:col-span-1">
                        <p class="block mb-2 text-sm font-bold text-gray-900">Sex</p>
                        <x-select-dropdown
                            name="sex"
                            id="sex"
                            placeholder="Select"
                            :options="[
                                        'Male' => 'Male',
                                        'Female' => 'Female',
                                     ]" />
                        <p id="error_sex" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                    </div>
                    <div class="col-span-6 md:col-span-2 ">
                        <label for="date_of_birth" class="block mb-2 text-sm font-bold text-gray-900">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" required
                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                        <p id="error_date_of_birth" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                    </div>
                    <div class="col-span-6 md:col-span-1 ">
                        <label for="age" class="block mb-2 text-sm font-bold text-gray-900">Age</label>
                        <input type="text" name="age" id="age" required readonly
                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                        <p id="error_age" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 grid grid-cols-6 gap-2 md:px-10 ">
                    <div class="col-span-6 block md:hidden">
                        <h2 class="md:text-lg text-gray-700 font-900 mb-2">Vital Signs</h2>
                    </div>
                    <div class="col-span-6 md:col-span-2 ">
                        <label for="heart_rate" class="block mb-2 text-sm font-bold text-gray-900">Weight (kg)</label>
                        <input type="text" name="heart_rate" id="heart_rate" placeholder="e.g 70"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                    </div>
                    <div class="col-span-6 md:col-span-2 ">
                        <label for="temperature" class="block mb-2 text-sm font-bold text-gray-900">Temperature</label>
                        <input type="text" name="temperature" id="temperature" placeholder="e.g 37.5"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                    </div>
                    <div class="col-span-6 md:col-span-2 ">
                        <label for="blood_pressure" class="block mb-2 text-sm font-bold text-gray-900">Blood Pressure</label>
                        <input type="text" name="blood_pressure" id="blood_pressure" placeholder="e.g 120/80"
                            oninput="this.value = this.value.replace(/[^0-9/]/g, '')"
                            class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // ----------------------------------------------------------------------------VALIDATE STEP 1----------------------------------------------------------------------------//
    function validateStep1() {
        let isValid = true;

        // Hide all pre-defined error <p> tags first
        document.querySelectorAll("#step-1 p[id^='error_']").forEach(el => {
            el.classList.add("hidden");
        });

        // Validate inputs (text, date, time, hidden, select)
        const inputs = document.querySelectorAll("#step-1 input[required], #step-1 select[required]");
        inputs.forEach(input => {
            // Reset borders
            if (input.type !== "hidden") {
                input.classList.remove("border-red-500", "border-gray-300");
                input.classList.add("border-gray-300");
            } else {
                // reset container border for dropdowns
                const container = document.getElementById(`${input.id}-container`);
                if (container) {
                    container.classList.remove("border-red-500", "border-gray-300");
                    container.classList.add("border-gray-300");
                }
            }

            if (!input.value.trim()) {
                if (input.type !== "hidden") {
                    input.classList.remove("border-gray-300");
                    input.classList.add("border-red-500");
                } else {
                    // highlight the dropdown container
                    const container = document.getElementById(`${input.id}-container`);
                    if (container) {
                        container.classList.remove("border-gray-300");
                        container.classList.add("border-red-500");
                    }
                }

                // show <p> error
                const errorP = document.getElementById(`error_${input.id}`);
                if (errorP) {
                    errorP.classList.remove("hidden");
                }

                isValid = false;
            }
        });

        // Validate location fields (region, province, city, barangay)
        ["region", "province", "city", "barangay"].forEach(field => {
            const hiddenInput = document.getElementById(`${field}_input`);
            const wrapperDiv = document.getElementById(`${field}_wrapper`);
            const errorP = document.getElementById(`error_${field}`);

            if (hiddenInput && wrapperDiv) {
                wrapperDiv.classList.remove("border-red-500", "border-gray-300");
                wrapperDiv.classList.add("border-gray-300");

                if (!hiddenInput.value.trim()) {
                    wrapperDiv.classList.remove("border-gray-300");
                    wrapperDiv.classList.add("border-red-500");

                    if (errorP) {
                        errorP.classList.remove("hidden");
                    }

                    isValid = false;
                }
            }
        });

        return isValid;
    }


    // ----------------------------------------------------------------------------VALIDOATE INPUTS----------------------------------------------------------------------------//
    //FIRST NAME & LAST NAME VALIDATOR
    // NAME VALIDATOR (First / Last / etc.)
    function nameValidator(id) {
        document.getElementById(id).addEventListener("input", function() {
            // Allow only letters and spaces
            this.value = this.value.replace(/[^A-Za-z\s]/g, "");

            // Capitalize first letter of each word
            this.value = this.value
                .toLowerCase()
                .replace(/\b\w/g, char => char.toUpperCase());
        });
    }

    // Apply to your fields
    nameValidator("first_name");
    nameValidator("last_name");

    //MIDDLE INITIAL VALIDATOR
    document.getElementById("middleInitial").addEventListener("input", function() {
        // Force uppercase
        this.value = this.value.toUpperCase();

        // Allow only: single uppercase letter + optional dot
        this.value = this.value.replace(/[^A-Z.]/g, "");

        // Ensure it matches "A." format
        if (!/^[A-Z]\.?$/.test(this.value)) {
            if (this.value.length === 2 && this.value[1] !== ".") {
                this.value = this.value[0] + ".";
            }
        }
    });
    //SUFFIX VALIDATOR
    document.getElementById("suffix").addEventListener("input", function() {
        // Allow only letters, numbers, and dot
        this.value = this.value.replace(/[^A-Za-z0-9.]/g, "").toUpperCase();
    });

    // EMAIL VALIDATOR & EXIST CHECKER
    document.getElementById("email").addEventListener("input", function() {

        const existingEmails = JSON.parse(document.getElementById('existing-emails').value);
        const errorEl = document.getElementById("error_email");

        // Only valid characters & lowercase
        this.value = this.value.replace(/[^a-zA-Z0-9@._+-]/g, "").toLowerCase();
        const emailValue = this.value.trim();

        // Email regex
        const emailPattern = /^[a-zA-Z0-9._+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,}$/;

        // If empty, optional → reset
        if (emailValue.length === 0) {
            errorEl.classList.add("hidden");
            this.classList.remove("border-red-500", "focus:border-red-500");
            this.classList.add("border-gray-300", "focus:border-sky-500");
            return;
        }

        // Invalid format
        if (!emailPattern.test(emailValue)) {
            errorEl.textContent = "Invalid email format";
            errorEl.classList.remove("hidden");
            this.classList.add("border-red-500", "focus:border-red-500");
            this.classList.remove("border-gray-300", "focus:border-sky-500");
            return;
        }

        // Check if email exists
        if (existingEmails.includes(emailValue)) {
            errorEl.textContent = "Email already exists";
            errorEl.classList.remove("hidden");
            this.classList.add("border-red-500", "focus:border-red-500");
            this.classList.remove("border-gray-300", "focus:border-sky-500");
        } else {
            // Valid & not exists
            errorEl.classList.add("hidden");
            this.classList.remove("border-red-500", "focus:border-red-500");
            this.classList.add("border-gray-300", "focus:border-sky-500");
        }
    });





    //AGE CALCULATOR
    document.addEventListener("DOMContentLoaded", function() {
        const date_of_birth = document.getElementById("date_of_birth");
        const age = document.getElementById("age");

        date_of_birth.addEventListener("change", function() {
            const birthdate = new Date(date_of_birth.value);
            const today = new Date();
            let calculatedAge = today.getFullYear() - birthdate.getFullYear();
            const monthDifference = today.getMonth() - birthdate.getMonth();

            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthdate.getDate())) {
                calculatedAge--;
            }

            age.value = calculatedAge;
        });
    });
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

    function dateOfRegistrationToday() {
        const dateInput = document.getElementById("dateOfRegistration");
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, "0");
        const day = String(today.getDate()).padStart(2, "0");
        dateInput.value = `${year}-${month}-${day}`;
    }
    dateOfRegistrationToday();
</script>