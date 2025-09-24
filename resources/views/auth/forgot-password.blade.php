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


<body class="bg-gradient-to-r from-red-600 to-gray-800">
    <section class="flex items-center justify-center md:h-screen mb-5 mt-5 md:mb-0 md:mt-0">
        <div class="flex flex-col md:flex-row justify-center items-center ">
            <div class="md:h-[600px] md:w-[22rem] h-[16rem] w-[20rem] shadow-lg bg-[#EB1C26] md:rounded-l-[15px]  p-2 rounded-t-[15px] md:rounded-r-none md:overflow-none overflow-hidden">
                <a href="{{ route('login') }}" class="hover:outline-none focus:outline-none md:overflow-none overflow-hidden">
                    <img src="{{asset('Frame 3.png')}}" alt="" class="w-50 h-50 md:mt-0 mt-[-5rem]" />
                </a>
            </div>
            <div class="md:h-[37.5rem] bg-white md:w-[38rem]  w-[20rem] h-[30rem] md:rounded-r-[15px] rounded-b-[10px] md:rounded-b-[0px] shadow-lg items-center justify-center p-5 md:p-20">


                <div class="flex flex-col justify-center ">

                    <div class="flex  justify-between mb-5">
                        <a href="{{route('login')}}" class="flex items-center justify-center gap-2 hover:underline text-red-500  underline-offset-4">
                            <i data-lucide="circle-chevron-left" class="text-red-500"></i>
                            <span class="text-sm  ">Return to login</span>
                        </a>
                        <div class="flex items-center justify-between gap-3">
                            <div id="datetime" class="md:text-md text-sm text-black font-bold"></div>
                        </div>
                    </div>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('patient.two-factor.send_code') }}" class="mt-5">
                        @csrf

                        <!-- Email Address -->
                        <h1 class="text-center text-xl font-bold text-black">Account Verification</h1>
                        <h3 class="text-center text-xs font-bold text-black">(Two-Factor Authentication)</h3>

                        <p class="text-sm mt-6">Please enter your Email Accpount to reset your password. We’ll send a 2FAverification code to your registered personal email</p>

                        <div class="mt-6">
                            <x-input-label for="email" :value="__('Email Address')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="bg-red-200 px-4 py-2 mt-2 rounded-sm" />
                        </div>

                        <div class="mt-4">
                            <x-primary-button class="w-full justify-center bg-red-600 hover:bg-red-700 focus:bg-red-700">
                                {{ __('Send Verification Code') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <div class="flex items-end justify-end md:mt-[8rem] mt-2 text-sm text-gray-400 ">
                        <p>iBiteCare<sup>+</sup></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


</body>
<!-- Footer -->

</html>