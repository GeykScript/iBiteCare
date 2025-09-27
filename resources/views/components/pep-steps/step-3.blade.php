<div id="step-3" class="step hidden">
    <div class="flex flex-col gap-2">
        <div class="grid grid-cols-12 gap-2">
            <div class="col-span-12 md:col-span-6">
                <h2 class="md:text-lg text-gray-700 font-900 mb-2">Animal Information</h2>
                <div class="grid grid-cols-6 ">
                    <div class="col-span-6 md:col-span-3">
                        <h2 class="text-sm md:text-md text-gray-500 font-900 mb-2">Species</h2>
                        <p id="error_species" class="text-red-500 text-xs mt-1 hidden ">*This field is required</p>

                        <div class="flex flex-col gap-2 p-2">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="species" value="Cat" required
                                    class="text-red-500 focus:ring-red-500">
                                <span>Cat</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="species" value="Dog"
                                    class="text-red-500 focus:ring-red-500">
                                <span>Dog</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="species" value="Other"
                                    class="text-red-500 focus:ring-red-500" id="species_other_radio">
                                <span>Others</span>
                            </label>

                            <div class="flex flex-col">
                                <label for="species_other" class="mb-2 text-sm font-bold text-gray-900">
                                    Others <span class="text-gray-500 text-xs">( Please specify if applicable )</span>
                                </label>
                                <input type="text" id="species_other"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-3">
                        <h2 class="text-sm md:text-md text-gray-500 font-900 mb-2">Ownership Status</h2>
                        <p id="error_ownership_status" class="text-red-500 text-xs mt-1 hidden ">*This field is required</p>

                        <div class="flex flex-col p-2 ">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="ownership_status" value="Owned" required
                                    class="text-sky-500 focus:ring-sky-500">
                                <span>Owned (Pet)</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="ownership_status" value="Neighbor"
                                    class="text-sky-500 focus:ring-sky-500">
                                <span>Neighbor</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="ownership_status" value="Stray"
                                    class="text-sky-500 focus:ring-sky-500">
                                <span>Stray</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6">
                <h2 class="md:text-lg text-gray-700 font-900 mb-2"> Health Information</h2>
                <div class="grid grid-cols-6 ">
                    <div class="col-span-6 ">
                        <h2 class="text-sm md:text-md text-gray-500 font-900 mb-2">Clinical Status</h2>
                        <p id="error_clinical_status" class="text-red-500 text-xs mt-1 hidden ">*This field is required</p>

                        <div class="flex flex-col md:flex-row gap-4 md:items-center p-2 ">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="clinical_status" value="Healthy" required
                                    class="text-red-500 focus:ring-red-500">
                                <span>Healthy</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="clinical_status" value="Died"
                                    class="text-red-500 focus:ring-red-500">
                                <span>Died</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="clinical_status" value="Killed"
                                    class="text-red-500 focus:ring-red-500">
                                <span>Killed</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="clinical_status" value="Lost"
                                    class="text-red-500 focus:ring-red-500">
                                <span>Lost</span>
                            </label>

                        </div>
                    </div>
                    <div class="col-span-6">
                        <h2 class="text-sm md:text-md text-gray-500 font-900 mb-2">Brain Examination</h2>
                        <p id="error_brain_exam" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>

                        <div class="flex gap-4  p-2 ">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="brain_exam" value="Done" required
                                    class="text-sky-500 focus:ring-sky-500">
                                <span>Done</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="brain_exam" value="Not Done"
                                    class="text-sky-500 focus:ring-sky-500">
                                <span>Not Done</span>
                            </label>
                        </div>
                        <div class="flex flex-col mt-3">
                            <label class=" mb-2 text-sm font-bold text-gray-900">If Done <span class="text-gray-500 text-xs"> ( Please specify if applicable )</span></label>
                            <p id="error_brain_exam_location" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>

                            <div class="flex items-center gap-2 mb-2">
                                <label for="brain_exam_location" class=" mb-2 text-sm font-bold text-gray-900">Location:</label>
                                <input type="text" id="brain_exam_location"
                                    class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                            </div>
                            <div class="flex items-center gap-2">
                                <label for="brain_exam_results" class=" mb-2 text-sm font-bold text-gray-900">Results:</label>
                                <input type="text" id="brain_exam_results"
                                    class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const otherRadio = document.getElementById("species_other_radio");
    const otherInput = document.getElementById("species_other");

    // Keep radio + input synced
    otherInput.addEventListener("input", () => {
        if (otherInput.value.trim() !== "") {
            otherRadio.checked = true;
            // dynamically update the value of the radio so "Others" is replaced with typed value
            otherRadio.value = otherInput.value.trim();
        } else {
            otherRadio.value = "Other";
        }
    });


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
    nameValidator("species_other");




    function validateStep3() {
        let isValid = true;

        // Hide all pre-defined error <p> tags first
        document.querySelectorAll("#step-3 p[id^='error_']").forEach(el => {
            el.classList.add("hidden");
        });

        // Reset input borders
        document.querySelectorAll("#step-3 input, #step-3 select").forEach(input => {
            input.classList.remove("border-red-500");
            input.classList.add("border-gray-300");
        });

        // Validate required text/select inputs
        const inputs = document.querySelectorAll("#step-3 input[required]:not([type=radio]), #step-3 select[required]");
        inputs.forEach(input => {
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
            Array.from(document.querySelectorAll("#step-3 input[type=radio][required]"))
            .map(r => r.name)
        )];

        radioGroups.forEach(name => {
            const checked = document.querySelector(`#step-3 input[name="${name}"]:checked`);
            const errorP = document.getElementById(`error_${name}`);
            if (!checked && errorP) {
                errorP.classList.remove("hidden");
                isValid = false;
            }
        });

        // ✅ Conditional validation for Brain Exam
        const brainExam = document.querySelector('#step-3 input[name="brain_exam"]:checked');
        if (brainExam && brainExam.value === "Done") {
            const location = document.getElementById("brain_exam_location");
            const results = document.getElementById("brain_exam_results");

            if (!location.value.trim()) {
                location.classList.remove("border-gray-300");
                location.classList.add("border-red-500");
                document.getElementById("error_brain_exam_location").classList.remove("hidden");
                isValid = false;
            }

            if (!results.value.trim()) {
                results.classList.remove("border-gray-300");
                results.classList.add("border-red-500");
                // you may add a new error <p> for results if needed
                isValid = false;
            }
        }

        return isValid;
    }
</script>