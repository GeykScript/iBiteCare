<div id="step-4" class="step hidden ">
    <div class="flex flex-col gap-2">
        <div class="grid grid-cols-12 gap-2">
            <div class="col-span-12 md:col-span-6 md:px-4" id="anti_tetanus_section">
                <h2 class="md:text-lg text-gray-700 font-900 mb-2"> Anti-Tetanus Immunization</h2>
                <div class="grid grid-cols-6 ">
                    <div class="col-span-6 md:col-span-3 px-4">
                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Year last Dose Given <br> <span class="text-gray-500 text-xs font-normal">( Leave blank if unknown )</span></h2>
                        <input type="date" id="year_last_dose_given" name="year_last_dose_given"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                    </div>
                    <div class="col-span-6 md:col-span-3">
                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">No. of Dose Given</h2>
                        <p id="error_anti_tetanus_dose_given" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                        <div class="flex  items-center justify-center gap-4 p-2">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="anti_tetanus_dose_given" id="anti_tetanus_dose_given" value="TT1" required
                                    class="text-red-500 focus:ring-red-500">
                                <span>TT1</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="anti_tetanus_dose_given" value="TT2"
                                    class="text-red-500 focus:ring-red-500">
                                <span>TT2</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="anti_tetanus_dose_given" value="TT3"
                                    class="text-red-500 focus:ring-red-500">
                                <span>TT3</span>
                            </label>
                        </div>
                    </div>
                    <!-- ANTI TETANUS VACCINE DROPDOWN  -->
                    @props(['antiTetanusVaccines'])
                    <div class="col-span-6 md:col-span-3 mt-2 md:px-4">
                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Anti-Tetanus Vaccine</h2>
                        <div x-data="{ open: false, selected: null, selectedLabel: 'Select Vaccine', volume: null }" class="relative">
                            <!-- Hidden input to store the selected id -->
                            <input type="hidden" name="anti_tetanus_vaccine_id" id="anti_tetanus_vaccine_id" required x-model="selected">
                            <!-- Button / Display -->
                            <button type="button"
                                @click="open = !open"
                                id="anti_tetanus_vaccine_dropdown_button"
                                class="w-full border   border-gray-300 text-gray-900 rounded-lg px-3 py-2 text-left bg-white flex justify-between items-center text-sm focus:ring-sky-500 focus:border-sky-500">
                                <span x-text="selectedLabel"></span>
                                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
                            </button>
                            <!-- Dropdown list -->
                            <div x-show="open"
                                @click.outside="open = false"
                                class="absolute z-10 mt-1 w-full bg-white border rounded shadow max-h-40 overflow-y-auto">
                                @foreach ($antiTetanusVaccines as $vaccine)
                                @php
                                $formattedVolume = rtrim(rtrim(number_format($vaccine->remaining_volume, 2, '.', ''), '0'), '.');
                                @endphp

                                <div
                                    @click="selected = '{{ $vaccine->id }}'; selectedLabel = '#{{ $vaccine->package_number }} ({{ $formattedVolume}} ml)'; volume = '{{ $formattedVolume }}'; open = false"
                                    class="px-3 py-2 cursor-pointer hover:bg-gray-100 text-sm">
                                    #{{ $vaccine->package_number }} ({{ $formattedVolume }} ml)
                                </div>
                                @endforeach

                            </div>
                        </div>
                        <p id="error_anti_tetanus_vaccine_id" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                    </div>
                    <div class="col-span-6 md:col-span-1 mt-2 ">
                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Dose <span class="font-normal">(ml)</span></h2>
                        <input type="number" id="anti_dose_given" name="anti_dose_given" min="0" step="any" required
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                        <p id="error_anti_dose_given" class="text-red-500 text-xs mt-1  hidden">*required</p>
                    </div>
                    <div class="col-span-6 md:col-span-2 mt-2 md:px-4">
                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Date Administered</h2>
                        <input type="date" id="anti_tetanus_date_dose_given" name="anti_tetanus_date_dose_given"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                        <p id="error_anti_tetanus_date_dose_given" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                    </div>
                </div>
            </div>
            <!-- PREVIOUS ANTI-RABIES IMMUNIZATION  -->
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
                        <input type="date" id="date_dose_given" name="date_dose_given"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                    </div>
                    <div class="col-span-6 mt-2">
                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Place Administered</h2>
                        <input type="text" id="place_of_immunization" name="place_of_immunization"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                    </div>
                </div>
            </div>

            <!-- divider border  -->
            <div class="col-span-12 border-2 border-gray-50 mt-4"></div>
            <div class="col-span-12  md:px-4">
                <h2 class="md:text-lg text-gray-700 font-900 mb-2">Current Anti-Rabies Immunization</h2>
                <div class="grid grid-cols-12 gap-2  ">
                    <!-- ACTIVE IMMUNIZATION SECTION  -->
                    <div class="col-span-12 md:col-span-4 items-center" id="active_section">
                        <h2 class="text-gray-500 font-900 ">Active Immunization</h2>
                        <div class="flex flex-col">
                            <h2>Post Exposure Prophylaxis (PEP)</h2>
                            <div class="flex flex-col">
                                <h2 class="text-xs md:text-md text-gray-500 font-900 mt-2">Administration Route</h2>
                                <p id="error_route_of_administration" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                                <div class="flex  gap-4 p-2">
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="route_of_administration" value="Intradermal" required
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
                                <p id="error_active_vaccine_category" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                                <div x-data="{ selectedCategory: 'PVRV' }" class="grid grid-cols-12">
                                    <div class="col-span-12 flex gap-4 p-2">
                                        <label class="flex items-center space-x-2">
                                            <input type="radio" name="active_vaccine_category" value="PVRV" x-model="selectedCategory" required
                                                class="text-red-500 focus:ring-red-500">
                                            <span>PVRV</span>
                                        </label>
                                        <label class="flex items-center space-x-2">
                                            <input type="radio" name="active_vaccine_category" value="PCEC" x-model="selectedCategory"
                                                class="text-red-500 focus:ring-red-500">
                                            <span>PCEC</span>
                                        </label>
                                    </div>
                                    <!-- PVRV DROPDOWN  -->
                                    @props(['pvrvVaccines'])
                                    <div class="col-span-12 md:col-span-8 mt-2 " x-show="selectedCategory === 'PVRV'">
                                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">PVRV Vaccine</h2>
                                        <div x-data="{ open: false, selected_pvrv: null, selectedLabelPvrv: 'Select Vaccine', volume: null }" class="relative">
                                            <!-- Hidden input to store the selected id -->
                                            <input type="hidden" name="pvrv_vaccine_id" x-model="selected_pvrv" :required="selectedCategory === 'PVRV'" :disabled="selectedCategory !== 'PVRV'">
                                            <!-- Button / Display -->
                                            <button type="button"
                                                @click="open = !open"
                                                id="pvrv_vaccine_dropdown_button"
                                                class="w-full border   border-gray-300 text-gray-900 rounded-lg px-3 py-2 text-left bg-white flex justify-between items-center text-sm focus:ring-sky-500 focus:border-sky-500">
                                                <span x-text="selectedLabelPvrv"></span>
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
                                                @php
                                                $formattedVolume = rtrim(rtrim(number_format($vaccine->remaining_volume, 2, '.', ''), '0'), '.');
                                                @endphp
                                                <div @click="selected_pvrv = '{{ $vaccine->id }}'; selectedLabelPvrv = '#{{ $vaccine->id }} - {{ $vaccine->item->product_type }} ({{ $formattedVolume }} ml)'; volume = '{{ $formattedVolume }}'; open = false"
                                                    class="px-3 py-2 cursor-pointer hover:bg-gray-100 text-sm">
                                                    #{{ $vaccine->id }} - {{ $vaccine->item->product_type }} ({{ $formattedVolume }} ml)
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <p id="error_pvrv_vaccine_id" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                                    </div>
                                    <!-- PCEC DROPDOWN  -->
                                    @props(['pcecVaccines'])
                                    <div class="col-span-12 md:col-span-8 mt-2" x-show="selectedCategory === 'PCEC'">
                                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">PCEC Vaccine</h2>
                                        <div x-data="{ open: false, selected_pcec: null, selectedLabelPcec: 'Select Vaccine', volume: null }" class="relative">
                                            <!-- Hidden input to store the selected id -->
                                            <input type="hidden" name="pcec_vaccine_id" x-model="selected_pcec" :required="selectedCategory === 'PCEC'" :disabled="selectedCategory !== 'PCEC'">
                                            <!-- Button / Display -->
                                            <button type="button"
                                                @click="open = !open"
                                                id="pcec_vaccine_dropdown_button"
                                                class="w-full border border-gray-300 text-gray-900 rounded-lg px-3 py-2 text-left bg-white flex justify-between items-center text-sm focus:ring-sky-500 focus:border-sky-500">
                                                <span x-text="selectedLabelPcec"></span>
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
                                                @php
                                                $formattedVolume = rtrim(rtrim(number_format($vaccine->remaining_volume, 2, '.', ''), '0'), '.');
                                                @endphp
                                                <div @click="selected_pcec = '{{ $vaccine->id }}'; selectedLabelPcec = '#{{ $vaccine->id }} - {{ $vaccine->item->product_type }} ({{ $formattedVolume }} ml)'; open = false"
                                                    class="px-3 py-2 cursor-pointer hover:bg-gray-100 text-sm">
                                                    #{{ $vaccine->id }} - {{ $vaccine->item->product_type }} ({{ $formattedVolume }} ml)
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <p id="error_pcec_vaccine_id" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                                    </div>
                                    <div class="col-span-12 md:col-span-4 mt-2 md:px-4 ">
                                        <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Dose <span class="font-normal">(ml)</span></h2>
                                        <input type="number" id="vaccine_dose_given" name="vaccine_dose_given" required min="0" step="any"
                                            class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2 focus:ring-sky-500 focus:border-sky-500">
                                        <p id="error_vaccine_dose_given" class="text-red-500 text-xs mt-1  hidden">*required</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- PASSIVE IMMUNIZATION SECTION  -->
                    <div class="col-span-12 md:col-span-4" id="passive_section">
                        <h2 class="text-sm md:text-md  text-gray-500 font-900 mb-2">Passive Immunization </h2>
                        <div class="grid grid-cols-12" x-data="{ PassiveCategory: 'ERIG' }">
                            <div class="col-span-12">
                                <h2 class=" text-xs md:text-md text-gray-500 font-900 ">RIG Type</h2>
                                <div class="flex  gap-4 p-2">
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="passive_rig_category" value="ERIG" x-model="PassiveCategory" required
                                            class="text-red-500 focus:ring-red-500">
                                        <span>ERIG</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="passive_rig_category" value="HRIG" x-model="PassiveCategory"
                                            class="text-red-500 focus:ring-red-500">
                                        <span>HRIG</span>
                                    </label>
                                </div>
                            </div>
                            <!-- ERIG DROPDOWN  -->
                            @props(['erigVaccines'])
                            <div class="col-span-12 md:col-span-6 mt-2 " x-show="PassiveCategory === 'ERIG'">
                                <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">ERIG Vaccine</h2>
                                <div x-data="{ open: false, selected_erig: null, selectedLabelErig: 'Select Vaccine', volume: null }" class="relative">
                                    <!-- Hidden input to store the selected id -->
                                    <input type="hidden" name="erig_vaccine_id" x-model="selected_erig" :required="PassiveCategory === 'ERIG'" :disabled="PassiveCategory !== 'ERIG'">
                                    <!-- Button / Display -->
                                    <button type="button"
                                        @click="open = !open"
                                        id="erig_vaccine_dropdown_button"
                                        class="w-full border border-gray-300 text-gray-900 rounded-lg px-3 py-2 text-left bg-white flex justify-between items-center text-sm focus:ring-sky-500 focus:border-sky-500">
                                        <span x-text="selectedLabelErig"></span>
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
                                        @php
                                        $formattedVolume = rtrim(rtrim(number_format($vaccine->remaining_volume, 2, '.', ''), '0'), '.');
                                        @endphp
                                        <div @click="selected_erig = '{{ $vaccine->id }}'; selectedLabelErig = ' #{{ $vaccine->id }} - {{ $vaccine->item->product_type }} ({{ $formattedVolume }} ml)'; volume = '{{ $formattedVolume }}'; open = false"
                                            class="px-3 py-2 cursor-pointer hover:bg-gray-100 text-sm">
                                            #{{ $vaccine->id }} - {{ $vaccine->item->product_type }} ({{ $formattedVolume }} ml)
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                <p id="error_erig_vaccine_id" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                            </div>
                            <!-- HRIG DROPDOWN  -->
                            @props(['hrigVaccines'])
                            <div class="col-span-12 md:col-span-6 mt-2 " x-show="PassiveCategory === 'HRIG'">
                                <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">HRIG Vaccine</h2>
                                <div x-data="{ open: false, selected_hrig: null, selectedLabelHrig: 'Select Vaccine' , volume: null }" class="relative">
                                    <!-- Hidden input to store the selected id -->
                                    <input type="hidden" name="hrig_vaccine_id" x-model="selected_hrig" :required="PassiveCategory === 'HRIG'" :disabled="PassiveCategory !== 'HRIG'">
                                    <!-- Button / Display -->
                                    <button type="button"
                                        @click="open = !open"
                                        id="hrig_vaccine_dropdown_button"
                                        class="w-full border border-gray-300 text-gray-900 rounded-lg px-3 py-2 text-left bg-white flex justify-between items-center text-sm focus:ring-sky-500 focus:border-sky-500">
                                        <span x-text="selectedLabelHrig"></span>
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
                                        @php
                                        $formattedVolume = rtrim(rtrim(number_format($vaccine->remaining_volume, 2, '.', ''), '0'), '.');
                                        @endphp
                                        <div @click="selected_hrig = '{{ $vaccine->id }}'; selectedLabelHrig = ' #{{ $vaccine->id }} - {{ $vaccine->item->product_type }} ({{ $formattedVolume }} ml)'; volume = '{{ $formattedVolume }}'; open = false"
                                            class="px-3 py-2 cursor-pointer hover:bg-gray-100 text-sm">
                                            #{{ $vaccine->id }} - {{ $vaccine->item->product_type }} ({{ $formattedVolume }} ml)
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                <p id="error_hrig_vaccine_id" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                            </div>
                            <div class="col-span-12 grid grid-cols-6 gap-2 mt-2">
                                <div class="col-span-6 md:col-span-2 ">
                                    <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Dose <span class="font-normal">(ml)</span></h2>
                                    <input type="number" id="passive_dose_given" name="passive_dose_given" required min="0" step="any"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                                    <p id="error_passive_dose_given" class="text-red-500 text-xs mt-1  hidden">*This field is required</p>

                                </div>
                                <div class="col-span-6 md:col-span-3">
                                    <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">Date Given:</h2>
                                    <input type="date" id="passive_date_given" name="passive_date_given" required
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                                    <p id="error_passive_date_given" class="text-red-500 text-xs mt-1  hidden">*This field is required</p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Nurse Verification Section -->
                    <div class="col-span-12 md:col-span-4 flex flex-col items-center justify-center">
                        <h2 class="md:text-lg text-gray-500 font-900 mb-2">Nurse In-charge</h2>
                        <p id="verifySuccess" class="text-green-500 text-sm mt-1 hidden mb-2">Nurse verified successfully.</p>
                        <div class="flex gap-2 "
                            x-data="{ open: false, nurse_id: null, nurse_name: 'Select Nurse', modalOpen: false, nursePassword: '' }">
                            <!-- Nurse Dropdown -->
                            <div>
                                <h2 class="text-xs md:text-md text-gray-500 font-900 mb-2">RN Name</h2>
                                @props(['nurses'])
                                <div class="relative">
                                    <!-- Hidden input to store the selected id -->
                                    <input type="hidden" name="nurse_id" x-model="nurse_id" required>
                                    <!-- Button / Display -->
                                    <button type="button"
                                        @click="open = !open"
                                        id="nurseDropdownButton"
                                        class="w-full border border-gray-300 text-gray-900 rounded-lg px-4 py-2 text-left bg-white flex justify-between items-center text-sm focus:ring-sky-500 focus:border-sky-500">
                                        <span x-text="nurse_name"></span>
                                        <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
                                    </button>
                                    <!-- Dropdown list -->
                                    <div x-show="open"
                                        @click.outside="open = false"
                                        class="absolute z-10 mt-1 w-full bg-white border rounded shadow max-h-40 overflow-y-auto">
                                        @if (count($nurses) === 0)
                                        <div class="px-3 py-2 text-sm text-gray-500">
                                            No nurses available
                                        </div>
                                        @else
                                        @foreach ($nurses as $nurse)
                                        <div @click="nurse_id = '{{ $nurse->id }}'; nurse_name = '{{ $nurse->first_name }} {{ $nurse->last_name }}'; open = false"
                                            class="px-3 py-2 cursor-pointer hover:bg-gray-100 text-sm">
                                            {{ $nurse->first_name }} {{ $nurse->last_name }}
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Verify Button -->
                            <div class="flex flex-col ">
                                <h2 class="text-xs md:text-md text-gray-500 font-900 mb-3">RN Verification</h2>
                                <!-- Original Verify Button -->
                                <button
                                    id="verifyButton"
                                    type="button"
                                    :disabled="!nurse_id"
                                    @click="$dispatch('nurse-modal', { nurse_id: nurse_id, nurse_name: nurse_name })"
                                    class="text-blue-500 flex items-center justify-center font-bold hover:underline underline-offset-4 hover:cursor-pointer ">
                                    Verify
                                </button>
                                <h2 id="verifiedLabel" class="text-green-500 text-center hidden">Verified</h2>
                            </div>
                        </div>
                        <p id="error_nurse" class="text-red-500 text-xs mt-1 hidden">*This field is required</p>
                        <p id="NotVerified" class="text-red-500 text-xs mt-1 hidden">*Please verify to continue</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function validateStep4() {
        console.log("Validating Step 4...");
        let isValid = true;

        // Hide all error messages first
        document.querySelectorAll("#step-4 p[id^='error_']").forEach(el => {
            el.classList.add("hidden");
        });

        // Reset borders
        document.querySelectorAll("#step-4 input, #step-4 button").forEach(el => {
            el.classList.remove("border-red-500");
            if (el.classList.contains("border-gray-300") || el.tagName === "BUTTON") {
                el.classList.add("border-gray-300");
            }
        });

        // Validate required inputs (text/date/hidden)
        const inputs = document.querySelectorAll("#step-4 input[required]");
        inputs.forEach(input => {
            if (!input.value.trim()) {
                if (input.type === "hidden") {
                    // Dropdown → highlight its button
                    const btnId = input.name.replace("_id", "") + "_dropdown_button";
                    const btn = document.getElementById(btnId);
                    if (btn) {
                        btn.classList.remove("border-gray-300");
                        btn.classList.add("border-red-500");
                    }
                } else {
                    input.classList.remove("border-gray-300");
                    input.classList.add("border-red-500");
                }

                // Show related error message if exists
                const errorP =
                    document.getElementById("error_" + input.id) ||
                    document.getElementById("error_" + input.name);
                if (errorP) errorP.classList.remove("hidden");

                isValid = false;
            }
        });

        // Validate radios → show <p> if none selected
        const radioGroups = [...new Set(
            Array.from(document.querySelectorAll("#step-4 input[type=radio][required]"))
            .map(r => r.name)
        )];

        radioGroups.forEach(name => {
            const checked = document.querySelector(`#step-4 input[name="${name}"]:checked`);
            const errorP = document.getElementById(`error_${name}`);
            if (!checked && errorP) {
                errorP.classList.remove("hidden");
                isValid = false;
            }
        });

        // Special: Nurse dropdown validation
        const nurseInput = document.querySelector("#step-4 input[name='nurse_id']");
        if (nurseInput && !nurseInput.value.trim()) {
            const nurseBtn = document.getElementById("nurseDropdownButton");
            if (nurseBtn) {
                nurseBtn.classList.remove("border-gray-300");
                nurseBtn.classList.add("border-red-500");
            }
            const nurseError = document.getElementById("error_nurse");
            if (nurseError) nurseError.classList.remove("hidden");
            isValid = false;
        }
        // Verification check 
        const verifiedLabel = document.getElementById("verifiedLabel");
        const notVerified = document.getElementById("NotVerified");

        if (verifiedLabel.classList.contains("hidden")) {
            // Not verified → block progression
            if (notVerified) notVerified.classList.remove("hidden");
            isValid = false;
        } else {
            // Verified → hide the red warning if shown
            if (notVerified) notVerified.classList.add("hidden");
        }
        console.log("Validation result:", isValid);

        return isValid;
    }



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
    document.querySelectorAll("#step-4 input:not([type=hidden]), #step-4 select, #step-4 button").forEach(el => {
        el.addEventListener("input", () => clearFieldError(el));
        el.addEventListener("change", () => clearFieldError(el));
        el.addEventListener("click", () => clearFieldError(el));
    });

    // Also attach directly to hidden inputs (in case x-model changes their value)
    document.querySelectorAll("#step-4 input[type=hidden]").forEach(el => {
        const observer = new MutationObserver(() => clearFieldError(el));
        observer.observe(el, {
            attributes: true,
            attributeFilter: ["value"]
        });
    });
</script>



<script>
    function checkCategory() {
        const pep_immunization_type = document.getElementById("pep_immunization_type");
        const passiveSection = document.getElementById("passive_section");
        const category = document.getElementById("biteCategoryInput").value;
        const inputs = passiveSection.querySelectorAll("input, select, textarea, button");
        const anti_tetanus_dose_given = document.getElementById("anti_tetanus_dose_given");
        const anti_tetanus_vaccine_id = document.getElementById("anti_tetanus_vaccine_id");
        const anti_tetanus_date_dose_given = document.getElementById("anti_tetanus_date_dose_given");
        const anti_dose_given = document.getElementById("anti_dose_given");

        if (category === "2") {
            // Hide and disable all inputs
            pep_immunization_type.value = "Active";
            passiveSection.style.display = "none";

            inputs.forEach(el => {
                el.disabled = true;
                el.required = false;
                el.value = ""; // optional: clear old values
            });
            anti_tetanus_dose_given.required = false;
            anti_tetanus_vaccine_id.required = false;
            anti_dose_given.required = false;
            anti_tetanus_date_dose_given.value = "";
            anti_tetanus_date_dose_given.required = false;



        } else if (category === "3") {
            // Show and enable all inputs
            pep_immunization_type.value = "Passive/Active";
            passiveSection.style.display = "block";

            inputs.forEach(el => {
                el.disabled = false;
                // optional: re-enable required only for specific inputs
                if (el.hasAttribute("data-required")) {
                    el.required = true;
                }
            });
            anti_tetanus_dose_given.required = true;
            anti_tetanus_vaccine_id.required = true;
            anti_dose_given.required = true;
            anti_tetanus_date_dose_given.required = true;

        }
    }





    function dateOfTransactionToday() {
        const anti_tetanuDate = document.getElementById("anti_tetanus_date_dose_given");
        const passiveDateInput = document.getElementById("passive_date_given");
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, "0");
        const day = String(today.getDate()).padStart(2, "0");
        anti_tetanuDate.value = `${year}-${month}-${day}`;
        passiveDateInput.value = `${year}-${month}-${day}`;
    }
    dateOfTransactionToday();
</script>