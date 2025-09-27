<div id="step-4" class="step hidden ">
    <div class="flex flex-col gap-2">
        <div class="grid grid-cols-12 gap-2">
            <div class="col-span-12 md:col-span-6 md:px-4">
                <h2 class="md:text-lg text-gray-700 font-900 mb-2">Previous Anti-Tetanus Immunization</h2>
                <div class="grid grid-cols-6 ">
                    <div class="col-span-6 md:col-span-3 px-4">
                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Year last Dose Given <br> <span class="text-gray-500 text-xs font-normal">( Leave blank if unknown )</span></h2>
                        <input type="date" id="year_last_dose_given"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                    </div>
                    <div class="col-span-6 md:col-span-3">
                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">No. of Dose Given</h2>
                        <p id="error_dose_given" class="text-red-500 text-xs mt-1 hidden ">*This field is required</p>
                        <div class="flex  items-cente justify-center gap-4 p-2">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="dose_given" value="TT1" required
                                    class="text-red-500 focus:ring-red-500">
                                <span>TT1</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="dose_given" value="TT2"
                                    class="text-red-500 focus:ring-red-500">
                                <span>TT2</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="dose_given" value="TT3"
                                    class="text-red-500 focus:ring-red-500">
                                <span>TT3</span>
                            </label>
                        </div>
                    </div>
                    @props(['antiTetanusVaccines'])
                    <div class="col-span-6 md:col-span-3 mt-2 md:px-4">
                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Anti-Tetanus Vaccine</h2>
                        <div x-data="{ open: false, selected: null, selectedLabel: 'Select Vaccine' }" class="relative">
                            <!-- Hidden input to store the selected id -->
                            <input type="hidden" name="anti_tetanus_vaccine_id" x-model="selected">
                            <!-- Button / Display -->
                            <button type="button"
                                @click="open = !open"
                                class="w-full border-2   border-gray-300 text-gray-900 rounded-lg px-3 py-2 text-left bg-white flex justify-between items-center text-sm focus:ring-sky-500 focus:border-sky-500">
                                <span x-text="selectedLabel"></span>
                                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
                            </button>
                            <!-- Dropdown list -->
                            <div x-show="open"
                                @click.outside="open = false"
                                class="absolute z-10 mt-1 w-full bg-white border rounded shadow max-h-40 overflow-y-auto">
                                @foreach ($antiTetanusVaccines as $vaccine)
                                <div @click="selected = '{{ $vaccine->id }}'; selectedLabel = '  {{ $vaccine->item->category }} - #{{ $vaccine->package_number }}'; open = false"
                                    class="px-3 py-2 cursor-pointer hover:bg-gray-100 text-sm">
                                    {{ $vaccine->item->category }} - #{{ $vaccine->package_number }}
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <p id="error_anti_tetanus_vaccine" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                    </div>

                    <div class="col-span-6 md:col-span-3 mt-2 md:px-4">
                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Date Administered</h2>
                        <input type="date" id="date_dose_given"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 md:px-4">
                <h2 class="md:text-lg text-gray-700 font-900 mb-2">Previous Anti-Rabies Immunization <span class="text-gray-500 text-xs font-normal">( Leave blank if N/A )</span></h2>
                <div class="grid grid-cols-6 ">
                    <div class="col-span-6 md:col-span-3">
                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Immunization Type</h2>
                        <div class="flex  gap-4 p-2">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="immunization_type" value="Active"
                                    class="text-red-500 focus:ring-red-500">
                                <span>Active</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="immunization_type" value="Active"
                                    class="text-red-500 focus:ring-red-500">
                                <span>Passive</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-2">
                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Date Given</h2>
                        <p id="error_date_given" class="text-red-500 text-xs mt-1 hidden ">*This field is required</p>
                        <input type="date" id="date_dose_given"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                    </div>
                    <div class="col-span-6 mt-2">
                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Place Administered</h2>
                        <input type="text" id="place_of_immunization"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                    </div>
                </div>
            </div>

            <!-- divider border  -->
            <div class="col-span-12 border-2 border-gray-50 mt-4"></div>

            <div class="col-span-12  md:px-4">
                <h2 class="md:text-lg text-gray-700 font-900 mb-2">Current Anti-Rabies Immunization</h2>
                <div class="grid grid-cols-12 ">
                    <div class="col-span-12 md:col-span-6">
                        <h2 class="text-lg text-gray-500 font-900 ">Active</h2>
                        <div class="flex flex-col">
                            <h2>Post Exposure Prophylaxis (PEP)</h2>
                            <div class="flex flex-col">
                                <h2 class="text-xs md:text-md text-gray-500 font-900 ">Administration Route</h2>
                                <div class="flex  gap-4 p-2">
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="route_of_administration" value="Intradermal"
                                            class="text-red-500 focus:ring-red-500">
                                        <span>ID</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="route_of_administration" value="Intramuscular"
                                            class="text-red-500 focus:ring-red-500">
                                        <span>IM</span>
                                    </label>
                                </div>
                                <h2 class="text-xs md:text-md text-gray-500 font-900 ">Vaccine Type</h2>
                                <div class="flex  gap-4 p-2">
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="active_vaccine_category" value="PVRV" checked
                                            class="text-red-500 focus:ring-red-500">
                                        <span>PVRV</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="active_vaccine_category" value="PCEC"
                                            class="text-red-500 focus:ring-red-500">
                                        <span>PCEC</span>
                                    </label>

                                </div>
                                @props(['pvrvVaccines'])
                                <div class="col-span-6 md:col-span-3 mt-2 md:px-4 " id="pvrv_vaccine_section">
                                    <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">PVRV Vaccine</h2>
                                    <div x-data="{ open: false, selected: null, selectedLabel: 'Select Vaccine' }" class="relative">
                                        <!-- Hidden input to store the selected id -->
                                        <input type="hidden" name="pvrv_vaccine_id" x-model="selected">
                                        <!-- Button / Display -->
                                        <button type="button"
                                            @click="open = !open"
                                            class="w-full border-2   border-gray-300 text-gray-900 rounded-lg px-3 py-2 text-left bg-white flex justify-between items-center text-sm focus:ring-sky-500 focus:border-sky-500">
                                            <span x-text="selectedLabel"></span>
                                            <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
                                        </button>
                                        <!-- Dropdown list -->
                                        <div x-show="open"
                                            @click.outside="open = false"
                                            class="absolute z-10 mt-1 w-full bg-white border rounded shadow max-h-40 overflow-y-auto">
                                            @if (count($pvrvVaccines) === 0)
                                            <div class="px-3 py-2 text-sm text-gray-500">
                                                No PVRV vaccines available
                                            </div>
                                            @else
                                            @foreach ($pvrvVaccines as $vaccine)
                                            <div @click="selected = '{{ $vaccine->id }}'; selectedLabel = '{{ $vaccine->item->product_type }} - #{{ $vaccine->id }}'; open = false"
                                                class="px-3 py-2 cursor-pointer hover:bg-gray-100 text-sm">
                                                {{ $vaccine->item->product_type }} - #{{ $vaccine->id }}
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <p id="error_pvrv_vaccine" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                                </div>
                                @props(['pcecVaccines'])
                                <div class="col-span-6 md:col-span-3 mt-2 md:px-4 hidden" id="pcec_vaccine_section">
                                    <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">PCEC Vaccine</h2>
                                    <div x-data="{ open: false, selected: null, selectedLabel: 'Select Vaccine' }" class="relative">
                                        <!-- Hidden input to store the selected id -->
                                        <input type="hidden" name="pcec_vaccine_id" x-model="selected">
                                        <!-- Button / Display -->
                                        <button type="button"
                                            @click="open = !open"
                                            class="w-full border-2   border-gray-300 text-gray-900 rounded-lg px-3 py-2 text-left bg-white flex justify-between items-center text-sm focus:ring-sky-500 focus:border-sky-500">
                                            <span x-text="selectedLabel"></span>
                                            <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
                                        </button>
                                        <!-- Dropdown list -->
                                        <div x-show="open"
                                            @click.outside="open = false"
                                            class="absolute z-10 mt-1 w-full bg-white border rounded shadow max-h-40 overflow-y-auto">
                                            @if (count($pcecVaccines) === 0)
                                            <div class="px-3 py-2 text-sm text-gray-500">
                                                No PCEC vaccines available
                                            </div>
                                            @else
                                            @foreach ($pcecVaccines as $vaccine)
                                            <div @click="selected = '{{ $vaccine->id }}'; selectedLabel = '{{ $vaccine->item->product_type }} - #{{ $vaccine->id }}'; open = false"
                                                class="px-3 py-2 cursor-pointer hover:bg-gray-100 text-sm">
                                                {{ $vaccine->item->product_type }} - #{{ $vaccine->id }}
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <p id="error_pcec_vaccine" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6" id="passive_section">
                        <h2 class="text-lg  text-gray-500 font-900 mb-2">Passive </h2>
                        <div class="flex flex-col">
                            <h2 class="text-xs md:text-md text-gray-500 font-900 ">RIG Type</h2>
                            <div class="flex  gap-4 p-2">
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="passive_rig_category" value="ERIG" checked
                                        class="text-red-500 focus:ring-red-500">
                                    <span>ERIG</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="passive_rig_category" value="HRIG"
                                        class="text-red-500 focus:ring-red-500">
                                    <span>HRIG</span>
                                </label>
                            </div>
                            <div class="grid grid-cols-6 gap-2 ">
                                <div class="col-span-6 md:col-span-2 ">
                                    <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Dose:</h2>
                                    <input type="text" id="place_of_immunization"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                                </div>
                                <div class="col-span-6 md:col-span-2">
                                    <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Date Given:</h2>
                                    <p id="error_date_given" class="text-red-500 text-xs mt-1 hidden ">*This field is required</p>
                                    <input type="date" id="date_dose_given"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                                </div>
                            </div>
                            @props(['erigVaccines'])
                            <div class="col-span-6 md:col-span-3 mt-2 md:px-4 " id="erig_rig_section">
                                <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">ERIG Vaccine</h2>
                                <div x-data="{ open: false, selected: null, selectedLabel: 'Select Vaccine' }" class="relative">
                                    <!-- Hidden input to store the selected id -->
                                    <input type="hidden" name="erig_vaccine_id" x-model="selected">
                                    <!-- Button / Display -->
                                    <button type="button"
                                        @click="open = !open"
                                        class="w-full border-2   border-gray-300 text-gray-900 rounded-lg px-3 py-2 text-left bg-white flex justify-between items-center text-sm focus:ring-sky-500 focus:border-sky-500">
                                        <span x-text="selectedLabel"></span>
                                        <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
                                    </button>
                                    <!-- Dropdown list -->
                                    <div x-show="open"
                                        @click.outside="open = false"
                                        class="absolute z-10 mt-1 w-full bg-white border rounded shadow max-h-40 overflow-y-auto">
                                        @if (count($erigVaccines) === 0)
                                        <div class="px-3 py-2 text-sm text-gray-500">
                                            No ERIG vaccines available
                                        </div>
                                        @else
                                        @foreach ($erigVaccines as $vaccine)
                                        <div @click="selected = '{{ $vaccine->id }}'; selectedLabel = '{{ $vaccine->item->product_type }} - #{{ $vaccine->id }}'; open = false"
                                            class="px-3 py-2 cursor-pointer hover:bg-gray-100 text-sm">
                                            {{ $vaccine->item->product_type }} - #{{ $vaccine->id }}
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                <p id="error_erig_vaccine" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                            </div>
                            @props(['hrigVaccines'])
                            <div class="col-span-6 md:col-span-3 mt-2 md:px-4 hidden" id="hrig_rig_section">
                                <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">HRIG Vaccine</h2>
                                <div x-data="{ open: false, selected: null, selectedLabel: 'Select Vaccine' }" class="relative">
                                    <!-- Hidden input to store the selected id -->
                                    <input type="hidden" name="hrig_vaccine_id" x-model="selected">
                                    <!-- Button / Display -->
                                    <button type="button"
                                        @click="open = !open"
                                        class="w-full border-2   border-gray-300 text-gray-900 rounded-lg px-3 py-2 text-left bg-white flex justify-between items-center text-sm focus:ring-sky-500 focus:border-sky-500">
                                        <span x-text="selectedLabel"></span>
                                        <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
                                    </button>
                                    <!-- Dropdown list -->
                                    <div x-show="open"
                                        @click.outside="open = false"
                                        class="absolute z-10 mt-1 w-full bg-white border rounded shadow max-h-40 overflow-y-auto">
                                        @if (count($hrigVaccines) === 0)
                                        <div class="px-3 py-2 text-sm text-gray-500">
                                            No HRIG vaccines available
                                        </div>
                                        @else
                                        @foreach ($hrigVaccines as $vaccine)
                                        <div @click="selected = '{{ $vaccine->id }}'; selectedLabel = '{{ $vaccine->item->product_type }} - #{{ $vaccine->id }}'; open = false"
                                            class="px-3 py-2 cursor-pointer hover:bg-gray-100 text-sm">
                                            {{ $vaccine->item->product_type }} - #{{ $vaccine->id }}
                                        </div>
                                        @endforeach
                                        @endif

                                    </div>
                                </div>
                                <p id="error_hrig_vaccine" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    const radios = document.querySelectorAll('input[name="active_vaccine_category"]');
    const pvrvSection = document.getElementById("pvrv_vaccine_section");
    const pcecSection = document.getElementById("pcec_vaccine_section");

    radios.forEach(radio => {
        radio.addEventListener("change", function() {


            // show based on selected value
            if (this.value === "PVRV") {
                pcecSection.classList.add("hidden");
                pvrvSection.classList.remove("hidden");
            } else if (this.value === "PCEC") {
                pvrvSection.classList.add("hidden");
                pcecSection.classList.remove("hidden");
            }
        });
    });
    const radios2 = document.querySelectorAll('input[name="passive_rig_category"]');
    const erigSection = document.getElementById("erig_rig_section");
    const hrigSection = document.getElementById("hrig_rig_section");

    radios2.forEach(radio => {
        radio.addEventListener("change", function() {


            // show based on selected value
            if (this.value === "ERIG") {
                hrigSection.classList.add("hidden");
                erigSection.classList.remove("hidden");
            } else if (this.value === "HRIG") {
                hrigSection.classList.remove("hidden");
                erigSection.classList.add("hidden");
            }
        });
    });


    function checkCategory() {
        const passiveSection = document.getElementById("passive_section");
        const category = document.getElementById("biteCategoryInput").value;

        if (category === "2") {
            passiveSection.style.display = "none";
        } else if (category === "3") {
            passiveSection.style.display = "block";
        }
    }
</script>