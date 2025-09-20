<div> <!-- 👈 SINGLE root wrapper -->

    <!-- Progress Bar -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            @for ($step = 1; $step <= $totalSteps; $step++)
                <!-- Step -->
                <div class="flex flex-col items-center">
                    <div
                        class="w-8 h-8 flex items-center justify-center rounded-full border-2 
                            {{ $currentStep >= $step ? 'bg-red-600 border-red-600 text-white' : 'bg-red-300 border-red-300 text-red-600' }}">
                    </div>
                    <span class="mt-2 text-sm font-bold text-center 
                        {{ $currentStep >= $step ? 'text-gray-900' : 'text-red-400' }}">
                        @switch($step)
                        @case(1) Personal Details @break
                        @case(2) History Exposure @break
                        @case(3) Animal Profile @break
                        @case(4) Past Immunizations @break
                        @case(5) Immunization @break
                        @case(6) Payment @break
                        @case(7) Finalizing @break
                        @endswitch
                    </span>
                </div>

                <!-- Line (not after last step) -->
                @if ($step < $totalSteps)
                    <div class="h-1 w-full mx-2 border-2 
                        {{ $currentStep > $step ? 'bg-red-300 border-red-300' : 'bg-red-300 border-red-300' }}">
        </div>
        @endif
        @endfor
    </div>
</div>

<!-- Form -->
<form wire:submit.prevent="submit" class="px-4" id="patient-registration-form">
    <!-- Step 1 -->
    @if ($currentStep === 1)
    <div class="flex flex-col gap-2">
        <div class="grid grid-cols-12 gap-2">

            <div class="col-span-12">
                <h2 class="text-lg text-gray-700 font-900 mb-2">Patient Information</h2>
            </div>
            <div class="col-span-12 md:col-span-4 ">
                <label for="first_name" class="block mb-2 text-sm font-bold text-gray-900">First Name</label>
                <input type="text" wire:model="first_name" id="first_name"
                    class=" border @error('first_name') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500 ">
                @error('first_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-12 md:col-span-4 ">
                <label for="last_name" class="block mb-2 text-sm font-bold text-gray-900">Last Name</label>
                <input type="text" wire:model="last_name" id="last_name"
                    class=" border @error('last_name') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                @error('last_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-12 md:col-span-1 ">
                <div class="grid grid-cols-2 gap-1 flex">
                    <div>
                        <label for="middleInitial" class="block mb-2 text-sm font-bold text-gray-900">M.I.</label>
                        <input type="text" wire:model="middleInitial" id="middleInitial"
                            class=" border @error('middleInitial') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                    </div>
                    <div>
                        <label for="suffix" class="block mb-2 text-sm font-bold text-gray-900">Suffix</label>
                        <input type="text" wire:model="suffix" id="suffix"
                            class=" border @error('suffix') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg block w-full p-2.5  focus:ring-sky-500 focus:border-sky-500">
                        @error('suffix') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-3 md:ml-10 ">
                <label for="dateOfRegistration" class="block mb-2 text-sm font-bold text-gray-900">Date of Registration</label>
                <input type="date" wire:model="dateOfRegistration" id="dateOfRegistration"
                    class=" border @error('dateOfRegistration') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg block w-full p-2.5">
                @error('dateOfRegistration') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                        <div class="w-full  flex items-center border rounded-lg px-2
                                @error('region') border-red-500  @else border-gray-200  @enderror">

                            <!-- Only the JS dropdown is ignored -->
                            <div class="flex-1" wire:ignore>
                                <button id="region_btn" type="button"
                                    class="w-full px-3 py-2 text-left bg-white flex justify-between items-center">
                                    <span id="region_selected">Select Region</span>
                                    <i data-lucide="chevron-down"></i>
                                </button>
                                <ul id="region"
                                    class="absolute w-full bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                            </div>
                        </div>
                        <!-- Hidden input bound to Livewire -->
                        <input type="hidden" wire:model="region" id="region_input">
                        <!-- Error message -->
                        @error('region')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- province  -->
                <div class="col-span-12 md:col-span-4">
                    <div class="mb-3 relative">
                        <label for="province_btn" class="text-sm mb-2 font-semibold">Province</label>
                        <div class="w-full  flex items-center border rounded-lg px-2
                                @error('province') border-red-500  @else border-gray-200  @enderror">
                            <div class="flex-1" wire:ignore>
                                <button id="province_btn" type="button"
                                    class="w-full  px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                    <span id="province_selected">Select Province</span>
                                    <i data-lucide="chevron-down"></i>
                                </button>
                                <ul id="province" class="absolute w-full   bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                            </div>

                            <!-- hidden input -->
                            <input type="hidden" name="province" wire:model="province" id="province_input">
                        </div>

                        @error('province')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- city  -->
                <div class="col-span-12 md:col-span-4">
                    <div class="mb-3 relative">
                        <label for="city_btn" class="text-sm mb-2 font-semibold">City / Municipality </label>
                        <div class="w-full  flex items-center border rounded-lg px-2
                                @error('city') border-red-500  @else border-gray-200  @enderror">
                            <div class="flex-1" wire:ignore>
                                <button id="city_btn" type="button"
                                    class="w-full  px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                    <span id="city_selected">Select City</span>
                                    <i data-lucide="chevron-down"></i>
                                </button>
                                <ul id="city" class="absolute w-full  bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                            </div>

                            <!-- hidden input -->
                            <input type="hidden" name="city" wire:model="city" id="city_input">
                        </div>
                        @error('city')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- barangay and purok  -->
                <div class="col-span-12 md:col-span-12">
                    <div class="grid grid-cols-4 gap-4">
                        <!-- barangay  -->
                        <div class="col-span-4 md:col-span-2 mb-3 relative">
                            <label for="barangay_btn" class="text-sm mb-2 font-semibold">Barangay</label>
                            <div class="w-full  flex items-center border rounded-lg px-2
                                @error('barangay') border-red-500  @else border-gray-200  @enderror">
                                <div class="flex-1" wire:ignore>
                                    <button id="barangay_btn" type="button"
                                        class="w-full  px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                        <span id="barangay_selected">Select Barangay</span>
                                        <i data-lucide="chevron-down"></i>
                                    </button>
                                    <ul id="barangay" class="absolute w-full  bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                </div>
                                <!-- hidden input -->
                                <input type="hidden" name="barangay" wire:model="barangay" id="barangay_input">
                            </div>
                            @error('barangay')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- purok  -->
                        <div class="col-span-4 md:col-span-2 ">
                            <label for="description" class="text-sm mb-2 font-semibold">Purok / Bldng No. </label>
                            <button id="description_btn" type="button" class="hidden"> </button>
                            <input type="text" name="description" placeholder="e.g Purok-2" class="w-full  @error('description') border-red-500  @else border-gray-200  @enderror p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                            @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- divider border  -->
                <div class="col-span-12 border-2 border-gray-50"></div>
            </div>

            <div class="col-span-12 grid grid-cols-12 gap-6 ">
                <div class="col-span-12 md:col-span-7 grid grid-cols-6 gap-2 ">
                    <div class="col-span-6">
                        <h2 class="text-lg text-gray-700 font-900 mb-2">Contact & Demographics</h2>
                    </div>

                    <div class="col-span-6 md:col-span-2 ">
                        <label for="phone" class="block mb-2 text-sm font-bold text-gray-900">Phone Number</label>
                        <input type="text" wire:model="phone" id="contact_number"
                            class=" border @error('phone') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                        @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-6 md:col-span-1">
                        <label for="sex" class="block mb-2 text-sm font-bold text-gray-900">Sex</label>
                        <select wire:model="sex" id="sex"
                            class="block w-full p-2.5 text-sm text-gray-900 border rounded-lg 
               @error('sex') border-red-500 @else border-gray-300 @enderror
               focus:ring-sky-500 focus:border-sky-500">
                            <option value="">-- Select --</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('sex')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-6 md:col-span-2 ">
                        <label for="phone" class="block mb-2 text-sm font-bold text-gray-900">Date of Birth</label>
                        <input type="date" wire:model="date_of_birth" id="date_of_birth"
                            class=" border @error('date_of_birth') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                        @error('date_of_birth') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-6 md:col-span-1 ">
                        <label for="age" class="block mb-2 text-sm font-bold text-gray-900">Age</label>
                        <input type="text" wire:model="age" id="age"
                            class=" border @error('age') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                        @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-span-12 md:col-span-5 grid grid-cols-6 gap-2 md:px-10 ">
                    <div class="col-span-6">
                        <h2 class="text-lg text-gray-700 font-900 mb-2">Vital Signs</h2>
                    </div>
                    <div class="col-span-6 md:col-span-2 ">
                        <label for="heart_rate" class="block mb-2 text-sm font-bold text-gray-900">Weight (kg)</label>
                        <input type="text" wire:model="heart_rate" id="heart_rate"
                            class=" border @error('heart_rate') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                        @error('heart_rate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-6 md:col-span-2 ">
                        <label for="temperature" class="block mb-2 text-sm font-bold text-gray-900">Temperature</label>
                        <input type="text" wire:model="temperature" id="temperature"
                            class=" border @error('temperature') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                        @error('temperature') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-6 md:col-span-2 ">
                        <label for="blood_pressure" class="block mb-2 text-sm font-bold text-gray-900">Blood Pressure</label>
                        <input type="text" wire:model="blood_pressure" id="blood_pressure"
                            class=" border @error('blood_pressure') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                        @error('blood_pressure') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Step 2 -->
    @if ($currentStep === 2)
    <div>
        <!-- step 2 content  -->
    </div>
    @endif

    <!-- Step 3 (sample only) -->
    @if ($currentStep === 3)
    <div>
        <!-- step 3 content  -->
    </div>
    @endif

    <!-- Buttons -->
    <div class="flex justify-end mt-8 gap-4">
        @if ($currentStep > 1)
        <button type="button" wire:click="previousStep"
            class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200">Previous</button>
        @endif

        @if ($currentStep < $totalSteps)
            <button type="button" wire:click="nextStep"
            class="px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600">Next</button>
            @else
            <button type="submit"
                class="px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600">Submit</button>
            @endif
    </div>
</form>

@if (session()->has('message'))
<div class="mt-4 text-green-600 font-bold">{{ session('message') }}</div>
@endif

</div> <!-- 👈 end of single root -->

<script>
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
</script>