<!-- Step 2: Account Details -->
<div id="step-2" class="step hidden">
    <div class="flex flex-col gap-2">
        <div class="grid grid-cols-12 gap-2">
            <div class="col-span-12 md:col-span-7 md:px-6 ">
                <h1 class="font-900  text-md md:text-lg mb-2">Bite Incident Details</h1>
                <div class="grid grid-cols-8 gap-4">
                    <div class="col-span-8 md:col-span-4">
                        <div class="grid grid-cols-4 gap-2">
                            <div class="col-span-4 md:col-span-2">
                                <label for="date_of_bite" class=" mb-2 text-sm font-bold text-gray-900">Date of Bite</label>
                                <input type="date" id="date_of_bite" name="date_of_bite" required
                                    class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5  focus:ring-sky-500 focus:border-sky-500">
                                <p id="error_date_of_bite" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>

                            </div>
                            <div class="col-span-4 md:col-span-2">
                                <label for="time_of_bite" class=" mb-2 text-sm font-bold text-gray-900">Time of Bite</label>
                                <input type="time" id="time_of_bite" name="time_of_bite" required
                                    class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                <p id="error_time_of_bite" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>

                            </div>
                            <div class="col-span-4 md:col-span-4">
                                <label for="location_of_incident" class=" mb-2 text-sm font-bold text-gray-900">Location of Incident <span class="text-gray-500 text-xs">( Leave blank if N/A )</span></label>
                                <input type="text" id="location_of_incident" name="location_of_incident"
                                    class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5  focus:ring-sky-500 focus:border-sky-500">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-8 md:col-span-4">
                        <div class="grid grid-cols-4 gap-2">
                            <div class="col-span-4 md:col-span-4">
                                <div class="flex justify-between items-center">
                                    <label class="mb-2 text-sm font-bold text-gray-900 block">Type of Exposure </label>
                                    <p id="error_exposure" class="text-red-500 text-xs mt-1 hidden ">*This field is required</p>
                                </div>
                                <div class="flex items-center space-x-6 p-2 ">
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="exposure" value="Bite" required
                                            class="text-sky-500 focus:ring-sky-500">
                                        <span>Bite</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="exposure" value="Non-Bite"
                                            class="text-sky-500 focus:ring-sky-500">
                                        <span>Non-Bite</span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <h1 class="font-900 text-lg my-4">Bite Diagnosis</h1>
                <div class="grid grid-cols-8 gap-4">
                    <div class="col-span-8">
                        <div class="grid grid-cols-4 gap-2">
                            <div class="col-span-4 md:col-span-4">
                                <div class="flex justify-between items-center">
                                    <label class="mb-2 text-sm font-bold text-gray-900 block">Bite Category</label>
                                    <p id="error_bite_category" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                                </div>
                                <div class="flex flex-col md:flex-row items-center justify-center md:space-x-6 p-2 ">

                                    <!-- In blade with radio -->
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="bite_category" value="1" required
                                            class="text-red-500 focus:ring-red-500"
                                            onchange="document.getElementById('biteCategoryInput').value=this.value; checkCategory();">
                                        <span>Category 1</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="bite_category" value="2"
                                            class="text-red-500 focus:ring-red-500"
                                            onchange="document.getElementById('biteCategoryInput').value=this.value; checkCategory();">
                                        <span>Category 2</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="bite_category" value="3"
                                            class="text-red-500 focus:ring-red-500"
                                            onchange="document.getElementById('biteCategoryInput').value=this.value; checkCategory();">
                                        <span>Category 3</span>
                                    </label>
                                    <input type="text" id="pep_immunization_type" name="pep_immunization_type" value="">
                                    <input type="hidden" id="biteCategoryInput" value="">

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-span-8">
                        <div class="grid grid-cols-4 gap-2">
                            <div class="col-span-4 md:col-span-4">
                                <div class="flex justify-between items-center">
                                    <label class="mb-2 text-sm font-bold text-gray-900 block">Bite Management</label>
                                    <p id="error_bite_management" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                                </div>
                                <div class="flex flex-col p-2 gap-2 ">
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="bite_management" value="washed" required
                                            class="text-sky-500 focus:ring-sky-500">
                                        <span>Washed the Bite</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="bite_management" value="not_washed"
                                            class="text-sky-500 focus:ring-sky-500">
                                        <span>Not Washed the Bite</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="bite_management" value="others" class="text-sky-500 focus:ring-sky-500">
                                        <span>Others <span class="text-gray-500 text-xs">( Please specify if applicable )</span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-span-4 md:col-span-4">
                                <input type="text" id="bite_management_other"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500 ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-5">
                <x-body-part-selector />
            </div>
        </div>
    </div>
</div>

<script>
    const radiosSpecies = document.querySelectorAll("input[name='bite_management']");
    const othersInputSpecies = document.getElementById("bite_management_other");

    radiosSpecies.forEach(radio => {
        radio.addEventListener("change", function() {
            if (this.value === "others") {
                othersInputSpecies.classList.remove("hidden");
                othersInputSpecies.setAttribute("required", "required");

                // Sync text input value into the radio whenever typed
                othersInputSpecies.addEventListener("input", () => {
                    radio.value = othersInputSpecies.value;
                });

            } else {
                othersInputSpecies.classList.add("hidden");
                othersInputSpecies.removeAttribute("required");
                othersInputSpecies.value = "";
            }
        });
    });
</script>
<script>
    function validateStep2() {
        let isValid = true;

        // Hide all pre-defined error <p> tags first
        document.querySelectorAll("#step-2 p[id^='error_']").forEach(el => {
            el.classList.add("hidden");
        });

        // Validate inputs (text, date, time, hidden, select) → show <p>
        const inputs = document.querySelectorAll("#step-2 input[required]:not([type=radio]), #step-2 select[required]");
        inputs.forEach(input => {
            input.classList.remove("border-red-500", "border-gray-300");
            input.classList.add("border-gray-300");

            if (!input.value.trim()) {
                input.classList.remove("border-gray-300");
                input.classList.add("border-red-500");

                const errorP = document.getElementById(`error_${input.id}`);
                if (errorP) {
                    errorP.classList.remove("hidden");
                }

                isValid = false;
            }
        });

        // Validate radios → show <p> if none selected
        const radioGroups = [...new Set(
            Array.from(document.querySelectorAll("#step-2 input[type=radio][required]"))
            .map(r => r.name)
        )];

        radioGroups.forEach(name => {
            const checked = document.querySelector(`#step-2 input[name="${name}"]:checked`);
            const errorP = document.getElementById(`error_${name}`);
            if (!checked && errorP) {
                errorP.classList.remove("hidden");
                isValid = false;
            }
        });

        return isValid;
    }
</script>