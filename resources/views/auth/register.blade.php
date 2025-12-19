<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('drcare_logo.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/datetime.js'])

    @endif
</head>


<body class="bg-gray-200">
    <section class="flex items-center justify-center md:h-screen mb-5 mt-5 md:mb-0 md:mt-0">
        <div class="flex flex-col md:flex-row justify-center items-center ">
            <div class="md:h-[640px] md:w-[25rem] h-[16rem] w-[20rem] shadow-2xl bg-[#EB1C26] md:rounded-l-[10px]  p-2 rounded-t-[15px] md:rounded-r-none md:overflow-none overflow-hidden">
                <a href="{{url('/')}}" class="hover:outline-none focus:outline-none md:overflow-none overflow-hidden">
                    <img src="{{asset('Frame 3.png')}}" alt="" class="w-50 h-50 md:mt-0 mt-[-5rem]" />
                </a>
            </div>
            <div class="md:h-[40rem] bg-white md:w-[35rem] border border-gray-200 w-[20rem] h-[40rem] md:rounded-r-[10px] rounded-b-[5px] md:rounded-b-[0px] shadow-xl items-center justify-center p-8 ">
                <div class="flex flex-col justify-between h-full  overflow-y-auto scrollbar-hidden">

                    <div class="flex  justify-between mb-5">
                        <a href="{{url('/')}}" class="flex items-center justify-center gap-2 hover:underline text-red-500  underline-offset-4">
                            <i data-lucide="circle-chevron-left" class="text-red-500"></i>
                            <span class="text-sm  ">Return</span>
                        </a>
                        <div class="flex items-center justify-between gap-3">
                            <div id="datetime" class="md:text-md text-sm text-gray-700 font-bold"></div>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center gap-4">
                        <h1 class="items-center justify-center gap-2 md:text-xl font-900 text-gray-700 flex mt-4 "><img src="{{asset('drcare_logo.png')}}" alt="Dr.Care logo" class="w-10 h-10">Register Account</h1>
                        <div class="flex flex-col justify-between md:px-12">
                            <div class="w-full flex flex-col items-center  ">
                                <x-auth-session-status class="bg-green-100 text-green-500 px-4 py-2 rounded-sm  mt-2   w-full" :status="session('status')" />
                            </div>
                            <div class="flex flex-col">
                                <form method="POST" action="{{ route('register') }}" id="registerForm">
                                    @csrf
                                    <div>
                                        <!-- Name -->
                                        <div>
                                            <x-input-label for="name" :value="__('Name')" />
                                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                            <x-input-error :messages="$errors->get('name')" class="bg-red-200 px-4 py-2 mt-2 rounded-sm font-bold text-red-500" />
                                        </div>

                                        <!-- Email Address -->
                                        <div class="mt-4">
                                            <x-input-label for="email" :value="__('Email')" />
                                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                            <x-input-error :messages="$errors->get('email')" class="bg-red-200 px-4 py-2 mt-2 rounded-sm font-bold text-red-500" />
                                        </div>

                                        <!-- Password -->
                                        <div class="mt-4">
                                            <x-input-label for="password" :value="__('Password')" />

                                            <x-password-input id="password" name="password" required class="mt-1" />

                                            <x-input-error :messages="$errors->get('password')" class="bg-red-200 px-4 py-2 mt-2 rounded-sm font-bold text-red-500" />
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="mt-4">
                                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                            <x-password-input id="password_confirmation" name="password_confirmation" required class="mt-1" />
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="bg-red-200 px-4 py-2 mt-2 rounded-sm font-bold text-red-500" />
                                        </div>

                                        <!-- Terms & Conditions -->
                                        <div class="mt-4 flex items-center gap-2">
                                            <input
                                                id="terms"
                                                type="checkbox"
                                                name="terms"
                                                class="h-4 w-4 rounded border-gray-300 text-sky-600 focus:ring-sky-500"
                                                required>

                                            <label for="terms" class="text-xs md:text-sm text-gray-700">
                                                I agree to the
                                                <button onclick="document.getElementById('terms_and_conditions').showModal()"
                                                    class="text-sky-500 font-semibold hover:underline">
                                                    Terms & Conditions and Privacy Policy
                                                </button>
                                            </label>
                                        </div>

                                        <div class="flex items-center flex-col mt-4">
                                            <x-primary-button id="submitBtn" class=" w-full text-center items-center justify-center bg-red-600 hover:bg-red-700 focus:bg-red-700">
                                                {{ __('Register') }}
                                            </x-primary-button>
                                            <div class="mt-3 flex items-center justify-center hover:underline underline-offset-4 text-sm text-gray-700">
                                                <a href="{{route('login')}}"> Already registered?</a>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-end justify-end  mt-2 text-sm text-gray-400 ">
                        <p class="hover:text-red-500 font-900">iBiteCare<sup>+</sup></p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <dialog id="terms_and_conditions" class="p-8 rounded-lg shadow-lg w-full max-w-4xl backdrop:bg-black/30 focus:outline-none ">
        <!-- close modal button  -->
        <div class="w-full flex flex-col justify-end mb-5">
            <button onclick="document.getElementById('terms_and_conditions').close()" class="focus:outline-none flex justify-end"><i data-lucide="x" class="w-5 h-5"></i></button>
            <h2 class="text-xl sm:text-2xl font-bold mb-4 text-red-600 text-center">Terms and Conditions</h2>
            <p class="text-sm leading-relaxed text-gray-700 mt-2">

                <strong>1. Acceptance of Terms</strong><br>
                By accessing or using Dr.Care services, you agree to be bound by these Terms and Conditions.
                If you do not agree with any part of the terms, you must not use our services.
                <br><br>

                <strong>2. Services</strong><br>
                Dr.Care provides animal bite consultations, vaccinations, and other services.
                We reserve the right to modify or discontinue any service without prior notice.
                <br><br>

                <strong>3. User Responsibilities</strong><br>
                Users must provide accurate information when booking appointments and follow all instructions
                provided by Dr.Care staff. Misuse of services may result in termination of access.
                <br><br>

                <strong>4. Privacy</strong><br>
                We respect your privacy and handle personal information in accordance with our Privacy Policy.
                By using our services, you consent to the collection and use of your data as described in the policy.
                <br><br>

                <strong>5. Limitation of Liability</strong><br>
                Dr.Care is not liable for any damages arising from the use of our services, including direct, indirect,
                incidental, or consequential damages. Our liability is limited to the maximum extent permitted by law.
                <br><br>

                <strong>6. Changes to Terms</strong><br>
                We may update these Terms and Conditions periodically. Changes will be effective immediately upon posting.
                Continued use of our services constitutes acceptance of the revised terms.
                <br><br>

                <strong>7. Governing Law</strong><br>
                These Terms are governed by the laws of the Philippines. Any disputes arising from these terms
                shall be subject to the exclusive jurisdiction of Philippine courts.
                <br><br>

            </p>
            <h2 class="text-xl sm:text-2xl font-bold  text-red-600 text-center">Privacy Policy</h2>
            <p class="text-sm leading-relaxed text-gray-700 mt-4">
                This Privacy Policy explains how we collect, use, store, and protect your personal information when you book an appointment for anti-rabies vaccination through our system.
                <br><br>
                <strong>1. Information We Collect:</strong> Name, contact details, email address, appointment details, and any additional notes you provide.
                <br>
                <strong>2. How We Use Your Information:</strong> For booking, confirming, rescheduling, and maintaining proper clinic records.
                <br>
                <strong>3. Data Protection:</strong> Your information is secured and only accessible to authorized personnel.
                <br>
                <strong>4. Data Sharing:</strong> We do not sell your data. Information is only shared when required by law or for service delivery.
                <br>
                <strong>5. Your Rights:</strong> You have the right to access, correct, or request deletion of your personal data.
                <br>
                <strong>6. Contact Us:</strong> For concerns regarding this policy, please contact our office.
            </p>
        </div>
        <div class="flex justify-end ">
            <button onclick="document.getElementById('terms_and_conditions').close()" class="focus:outline-none flex justify-end bg-gray-800 text-white px-4 py-1 hover:bg-gray-700 rounded">Close</button>

        </div>

    </dialog>

</body>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const checkbox = document.getElementById('terms');
        const submitBtn = document.getElementById('submitBtn');

        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-70', 'cursor-not-allowed');

        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-70', 'cursor-not-allowed');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-70', 'cursor-not-allowed');
            }
        });
    });
</script>

<script>
    const submitBtn = document.getElementById("submitBtn");
    document.getElementById('registerForm').addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
            </svg>
            <span>Loading...</span>
        `;

    });
</script>

</html>