<!-- Step 2: Account Details -->
<div id="step-2" class="step hidden">
    <div class="flex flex-col gap-2">
        <div class="grid grid-cols-12 gap-2">
            <div class="col-span-12 md:col-span-7 px-6 ">
                <h1 class="font-900 text-lg mb-2">Bite Incident Details</h1>
                <div class="grid grid-cols-8 gap-4">
                    <div class="col-span-4">
                        <div class="grid grid-cols-4 gap-2">
                            <div class="col-span-4 md:col-span-2">
                                <label for="date_of_bite" class=" mb-2 text-sm font-bold text-gray-900">Date of Bite</label>
                                <input type="date" id="date_of_bite" required
                                    class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5  focus:ring-sky-500 focus:border-sky-500">
                            </div>
                            <div class="col-span-4 md:col-span-2">
                                <label for="time_of_bite" class=" mb-2 text-sm font-bold text-gray-900">Time of Bite</label>
                                <input type="time" id="time_of_bite" required
                                    class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            </div>
                            <div class="col-span-4 md:col-span-4">
                                <label for="location_of_incident" class=" mb-2 text-sm font-bold text-gray-900">Location of Incident <span class="text-gray-500 text-xs">( Leave blank if N/A )</span></label>
                                <input type="text" id="location_of_incident"
                                    class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5  focus:ring-sky-500 focus:border-sky-500">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="grid grid-cols-4 gap-2">
                            <div class="col-span-4 md:col-span-4">
                                <label class="mb-2 text-sm font-bold text-gray-900 block">Type of Exposure</label>
                                <div class="flex items-center space-x-6 p-2 ">
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="exposure" value="Bite" required
                                            class="text-sky-500 focus:ring-sky-500">
                                        <span>Bite</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="exposure" value="Scratch" required
                                            class="text-sky-500 focus:ring-sky-500">
                                        <span>Scratch</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-span-4 md:col-span-4 ">
                                <label for="exposure_description" class=" mb-2 text-sm font-bold text-gray-900">Exposure Description <span class="text-gray-500 text-xs">( Leave blank if N/A )</span></label>
                                <input type="text" id="exposure_description"
                                    class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                            </div>
                        </div>
                    </div>
                </div>
                <h1 class="font-900 text-lg my-4">Bite Diagnosis</h1>
                <div class="grid grid-cols-8 gap-4">
                    <div class="col-span-8">
                        <div class="grid grid-cols-4 gap-2">
                            <div class="col-span-4 md:col-span-4">
                                <label class="mb-2 text-sm font-bold text-gray-900 block">Bite Category</label>
                                <div class="flex items-center space-x-6 p-2 ">
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="bite_category" value="1" required
                                            class="text-red-500 focus:ring-red-500">
                                        <span>Category 1</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="bite_category" value="2" required
                                            class="text-red-500 focus:ring-red-500">
                                        <span>Category 2</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="bite_category" value="3" required
                                            class="text-red-500 focus:ring-red-500">
                                        <span>Category 3</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-span-4 md:col-span-4 ">
                                <label for="exposure_description" class=" mb-2 text-sm font-bold text-gray-900">Exposure Description <span class="text-gray-500 text-xs">( Leave blank if N/A )</span></label>
                                <input type="text" id="exposure_description"
                                    class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-8">
                        <div class="grid grid-cols-4 gap-2">
                            <div class="col-span-4 md:col-span-4">
                                <label class="mb-2 text-sm font-bold text-gray-900 block">Bite Management</label>
                                <div class="flex items-center space-x-6 p-2 ">
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="bite_management" value="washed" required
                                            class="text-sky-500 focus:ring-sky-500">
                                        <span>Washed the Bite</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="bite_management" value="not_washed" required
                                            class="text-sky-500 focus:ring-sky-500">
                                        <span>Not Washed the Bite</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-span-4 md:col-span-4 ">
                                <label for="bite_management" class=" mb-2 text-sm font-bold text-gray-900">Others <span class="text-gray-500 text-xs">( Leave blank if N/A )</span></label>
                                <input type="text" id="bite_management" name="bite_management"
                                    class=" border border-gray-300  text-gray-900 text-sm rounded-lg block w-full p-2.5 focus:ring-sky-500 focus:border-sky-500">
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

</script>