<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <div class="max-w-5xl mx-auto rounded-xl p-4 sm:p-6 my-6 sm:my-10"
        x-data="{ otpSent: {{ session('success') ? 'true' : 'false' }} }">

        <div class="p-4">
            <h1 class="font-900 text-2xl sm:text-3xl font-bold text-gray-800">Immunization Schedule</h1>
            <p class="text-md text-gray-500 mt-2 md:p-4 text-center">
                No immunization schedule found.
            </p>
            <p class="text-md text-gray-500 mt-4">
                Note: This is only for viewing your immunization schedule and Vaccination Card, not for appointment schedules. <br>
                Please use the same email you gave to the clinic during your face-to-face visit.

            </p>

        </div>

        <div x-show="!otpSent" class="max-w-5xl mx-auto bg-white shadow-lg rounded-2xl p-6 sm:p-8 my-10 border border-gray-100">
            @if (session('success'))
            <div x-data="{ show: true }" x-show="show"
                class="w-full bg-green-100 border-2 rounded border-green-200 flex justify-between py-2 px-4 ">
                <h1 class="text-md font-bold text-green-600">{{ session('success') }}</h1>
                <button @click="show = false" class="text-lg font-bold text-green-600">
                    <i data-lucide="x"></i>
                </button>
            </div>
            @endif

            <h2 class="text-2xl font-bold text-gray-800 mb-2 text-center">Verify Your Email</h2>
            <p class="text-sm text-gray-500 mb-6 text-center">
                Please confirm your email address to receive your one-time verification code.<br>
                <span class="text-gray-400 text-xs">
                </span>
            </p>

            <form action="{{ route('patient.schedules.sendOtp') }}" method="POST" id="otpForm" class="space-y-5">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ $user->email }}"
                        readonly
                        class="w-full border border-gray-300 bg-gray-50 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-xs text-gray-500 mt-1">
                        Note: Use the email you provided at the clinic. If it wasn’t registered during the visit, this feature won’t show the desired information.
                    </p>
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        id="verifyBtn"
                        class="inline-flex items-center bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 text-white font-semibold px-5 py-3 rounded-lg transition-all duration-150 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12H8m8 0l-3 3m3-3l-3-3m7 3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Send Verification Code
                    </button>
                </div>
            </form>
        </div>

        <div x-show="otpSent" x-transition
            class="max-w-5xl mx-auto bg-white shadow-lg rounded-2xl p-4 sm:p-8 my-10 border border-gray-100">

            <h2 class="text-lg md:text-2xl font-bold text-gray-800 mb-2 text-center">Enter Your Verification Code</h2>
            <p class="text-sm text-gray-500 mb-6 text-center">
                We’ve sent a 6-digit verification code to your email address. Please enter it below to continue.
            </p>
            @if (session('success'))
            <div x-data="{ show: true }" x-show="show"
                class="w-full bg-green-100 border-2 rounded border-green-200 flex justify-between py-2 px-4 ">
                <h1 class="text-md font-bold text-green-600">{{ session('success') }}</h1>
                <button @click="show = false" class="text-lg font-bold text-green-600">
                    <i data-lucide="x"></i>
                </button>
            </div>
            @endif

            <form action="{{ route('patient.schedules.verifyOtp') }}" method="POST" class="space-y-6" id="VerifyotpForm">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <input type="hidden" name="email" value="{{ $user->email }}">

                <div class="text-center">
                    <label for="code" class="block text-md font-semibold text-gray-700 mb-2">
                        Verification Code
                    </label>
                    <x-input-error :messages="$errors->get('code')" class="bg-red-100 border border-red-300 text-red-700 px-4 py-2 mt-2 rounded-md font-medium inline-block" />
                </div>

                <div class="flex justify-center gap-2 sm:gap-3 mt-5">
                    @for ($i = 0; $i < 6; $i++)
                        <input
                        type="text"
                        maxlength="1"
                        name="code[]"
                        class="w-9 h-10 md:w-12 md:h-14 md:w-14 md:h-14 
                                text-center border-2 border-gray-300 
                                focus:border-blue-500 focus:ring-2 focus:ring-blue-200 
                                text-md sm:text-xl font-semibold text-gray-800 
                                rounded-lg transition-all duration-150 ease-in-out"
                        oninput="moveToNext(this)"
                        onkeydown="moveToPrev(event, this)">
                        @endfor
                </div>


                <input type="hidden" name="code" id="code">

                <div class="flex justify-center mt-8">
                    <button
                        type="submit"
                        id="verifyOTPBtn"
                        class="inline-flex items-center bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 text-white font-semibold px-6 py-3 rounded-lg shadow transition-all duration-150 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Verify Code
                    </button>
                </div>
            </form>

            <div class="text-center mt-6">
                <form action="{{ route('patient.schedules.sendOtp') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <p class="text-sm text-gray-500">
                        Didn’t receive the code?
                        <button type="submit" class="text-blue-600 hover:underline font-medium">
                            Resend Code
                        </button>
                    </p>
                </form>
            </div>
        </div>
    </div>


    <script>
        // OTP Input Auto Navigation
        function moveToNext(input) {
            if (input.value.length === 1) {
                const next = input.nextElementSibling;
                if (next) next.focus();
            }
        }

        function moveToPrev(event, input) {
            if (event.key === 'Backspace' && !input.value) {
                const prev = input.previousElementSibling;
                if (prev) prev.focus();
            }
        }

        function moveToNext(el) {
            if (el.value.length === 1 && el.nextElementSibling) {
                el.nextElementSibling.focus();
            }
            updateCode();
        }

        function moveToPrev(event, el) {
            if (event.key === "Backspace" && el.value === "" && el.previousElementSibling) {
                el.previousElementSibling.focus();
            }
            updateCode();
        }

        function updateCode() {
            let codeInputs = document.querySelectorAll("input[name='code[]']");
            let code = "";
            codeInputs.forEach(input => code += input.value);
            document.getElementById("code").value = code;
        }

        document.getElementById('otpForm').addEventListener('submit', function() {
            const btn = document.getElementById('verifyBtn');
            btn.disabled = true;
            btn.classList.add('opacity-70', 'cursor-not-allowed');

            btn.innerHTML = `
          <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
            </svg>
            <span>Loading...</span>
            `;
        });


        document.getElementById('VerifyotpForm').addEventListener('submit', function() {
            const btn = document.getElementById('verifyOTPBtn');
            btn.disabled = true;
            btn.classList.add('opacity-70', 'cursor-not-allowed');

            btn.innerHTML = `
          <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
            </svg>
            <span>Loading...</span>
            `;
        });
    </script>
</x-app-layout>