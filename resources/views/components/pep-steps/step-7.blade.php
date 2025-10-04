
    <div id="step-7" class="step hidden">
        <div class="flex flex-col gap-2">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 ">
                    <div class="flex flex-col items-center justify-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="180" height="180"
                            viewBox="0 0 24 24"
                            fill="#1AE820"
                            stroke="white"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-circle-check-icon lucide-circle-check">
                            <circle cx="12" cy="12" r="10" />
                            <path d="m9 12 2 2 4-4" />
                        </svg>
                        <h2 class="md:text-2xl font-900" style="color: #1AE820;">
                            Transaction Completed
                        </h2>

                        <p>You may proceed to view patient details or return to the home page.</p>
                        <div class="flex flex-col text-sky-400 font-semibold text-sm">
                            <a href="#" class="text-blue-500 hover:underline underline-offset-4 ">View Patient Details</a>
                            <a href="{{ route('clinic.dashboard') }}" class="text-blue-500 hover:underline underline-offset-4">Return to Home Page</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>