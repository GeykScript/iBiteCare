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
    <section class="flex flex-col items-center justify-center md:h-screen">
        <div class="flex flex-col md:flex-row justify-center items-center md:mt-20 mt-6 mb-10">
            
            <!-- Left red panel with logo -->
            <div class="md:h-[600px] md:w-[22rem] h-[16rem] w-[20rem] shadow-lg bg-[#EB1C26] 
                        md:rounded-l-[15px] p-2 rounded-t-[15px] md:rounded-r-none overflow-hidden">
                <a href="{{ url('/') }}" class="hover:outline-none focus:outline-none">
                    <img src="{{ asset('Frame 3.png') }}" alt="" class="w-50 h-50 md:mt-0 mt-[-5rem]" />
                </a>
            </div>

            <!-- Right white panel -->
            <div class="md:h-[37.5rem] bg-white md:w-[38rem] w-[20rem] h-[34rem] 
                        md:rounded-r-[15px] rounded-b-[10px] md:rounded-b-[0px] 
                        shadow-lg items-center justify-center p-5 md:p-20">

                <div class="flex flex-col justify-center ">

                    <!-- Header with back button + datetime -->
                    <div class="flex justify-between mb-5">
                        <a href="{{ route('auth.provider', ['provider' => session('auth_provider')]) }}" 
                            class="flex items-center justify-center gap-2 hover:underline text-red-500 underline-offset-4">
                                <i data-lucide="circle-chevron-left" class="text-red-500"></i>
                                <span class="text-sm">Return to {{ ucfirst(session('auth_provider')) }}</span>
                            </a>
                        <div class="flex items-center justify-between gap-3">
                            <div id="datetime" class="md:text-md text-sm text-black font-bold"></div>
                        </div>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Set Password Form -->
                    <form method="POST" action="{{ route('set.password.store') }}" class="mt-4">
                        @csrf

                        <h1 class="items-center justify-center gap-2 text-xl font-bold text-black flex">
                            <img src="{{ asset('drcare_logo.png') }}" alt="Dr.Care logo" class="w-8 h-8">
                            Set Your Password
                        </h1>

                        <p class="text-sm text-gray-600 mt-2">
                            Please create a password so you can log in directly with your email next time.
                        </p>

                        <!-- Password -->
                        <div class="mt-6">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full" 
                                type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password" name="password_confirmation" required autocomplete="new-password" />
                        </div>

                        <!-- Submit -->
                        <div class="mt-6">
                            <x-primary-button class="w-full justify-center bg-red-600 hover:bg-red-700 focus:bg-red-700">
                                {{ __('Save Password') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <div class="flex items-end justify-end mt-10 text-sm text-gray-400">
                        <p>iBiteCare<sup>+</sup></p>
                    </div>

                </div>
            </div>
        </div>
    </section>
</body>
</html>
