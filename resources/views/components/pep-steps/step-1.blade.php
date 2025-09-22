   <!-- Step 1: Personal Information -->
   <div id="step-1" class="step">
       <div class="flex flex-col gap-2">
           <div class="grid grid-cols-12 gap-2">
               <div class="col-span-12">
                   <h2 class="text-lg text-gray-700 font-900 mb-2">Patient Information</h2>
               </div>
               <div class="col-span-12 md:col-span-4 ">
                   <label for="first_name" class="block mb-2 text-sm font-bold text-gray-900">First Name</label>
                   <input type="text" id="first_name" required
                       class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500 ">
               </div>
               <div class="col-span-12 md:col-span-4 ">
                   <label for="last_name" class="block mb-2 text-sm font-bold text-gray-900">Last Name</label>
                   <input type="text" id="last_name" required
                       class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
               </div>
               <div class="col-span-12 md:col-span-1 ">
                   <div class="grid grid-cols-2 gap-1 flex">
                       <div>
                           <label for="middleInitial" class="block mb-2 text-sm font-bold text-gray-900">M.I.</label>
                           <input type="text" id="middleInitial" required
                               class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                       </div>
                       <div>
                           <label for="suffix" class="block mb-2 text-sm font-bold text-gray-900">Suffix</label>
                           <input type="text" id="suffix"
                               class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5  focus:ring-sky-500 focus:border-sky-500">
                       </div>
                   </div>
               </div>
               <div class="col-span-12 md:col-span-3 md:ml-10 ">
                   <label for="dateOfRegistration" class="block mb-2 text-sm font-bold text-gray-900">Date of Registration</label>
                   <input type="date" id="dateOfRegistration" required
                       class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5  focus:ring-sky-500 focus:border-sky-500">
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
                           <input type="hidden" id="region_input">
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
                           </div>
                           <!-- purok  -->
                           <div class="col-span-4 md:col-span-2 ">
                               <label for="description" class="text-sm mb-2 font-semibold">Purok / Bldng No. </label>
                               <input type="text" name="description" id="description_input" required placeholder="e.g Purok-2" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
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
                           <input type="text" wire:model="phone" id="contact_number" required
                               class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                       </div>
                       <div class="col-span-6 md:col-span-1">
                           <label for="sex" class="block mb-2 text-sm font-bold text-gray-900">Sex</label>
                           <select wire:model="sex" id="sex" required
                               class="block w-full p-2.5 text-sm text-gray-900 border rounded-lg border-gray-300
                                                            focus:ring-sky-500 focus:border-sky-500">
                               <option value="">-- Select --</option>
                               <option value="Male">Male</option>
                               <option value="Female">Female</option>
                           </select>
                       </div>

                       <div class="col-span-6 md:col-span-2 ">
                           <label for="phone" class="block mb-2 text-sm font-bold text-gray-900">Date of Birth</label>
                           <input type="date" wire:model="date_of_birth" id="date_of_birth" required
                               class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                       </div>
                       <div class="col-span-6 md:col-span-1 ">
                           <label for="age" class="block mb-2 text-sm font-bold text-gray-900">Age</label>
                           <input type="text" wire:model="age" id="age" required readonly
                               class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                       </div>
                   </div>
                   <div class="col-span-12 md:col-span-5 grid grid-cols-6 gap-2 md:px-10 ">
                       <div class="col-span-6">
                           <h2 class="text-lg text-gray-700 font-900 mb-2">Vital Signs</h2>
                       </div>
                       <div class="col-span-6 md:col-span-2 ">
                           <label for="heart_rate" class="block mb-2 text-sm font-bold text-gray-900">Weight (kg)</label>
                           <input type="text" wire:model="heart_rate" id="heart_rate"
                               class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                       </div>
                       <div class="col-span-6 md:col-span-2 ">
                           <label for="temperature" class="block mb-2 text-sm font-bold text-gray-900">Temperature</label>
                           <input type="text" wire:model="temperature" id="temperature"
                               class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                       </div>
                       <div class="col-span-6 md:col-span-2 ">
                           <label for="blood_pressure" class="block mb-2 text-sm font-bold text-gray-900">Blood Pressure</label>
                           <input type="text" wire:model="blood_pressure" id="blood_pressure"
                               class=" border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>

   <script>
       // validateStep1.js
       function validateStep1() {
           let isValid = true;

           const inputs = document.querySelectorAll("#step-1 input[required], #step-1 select[required]");
           inputs.forEach(input => {
               input.classList.remove("border-red-500", "border-gray-300");
               input.classList.add("border-gray-300");

               if (!input.value.trim()) {
                   input.classList.remove("border-gray-300");
                   input.classList.add("border-red-500");
                   isValid = false;
               }
           });

           // location fields
           ["region", "province", "city", "barangay"].forEach(field => {
               const hiddenInput = document.getElementById(`${field}_input`);
               const wrapperDiv = document.getElementById(`${field}_wrapper`);
               if (hiddenInput && wrapperDiv) {
                   wrapperDiv.classList.remove("border-red-500", "border-gray-300");
                   wrapperDiv.classList.add("border-gray-300");

                   if (!hiddenInput.value.trim()) {
                       wrapperDiv.classList.remove("border-gray-300");
                       wrapperDiv.classList.add("border-red-500");
                       isValid = false;
                   }
               }
           });

           return isValid;
       }

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