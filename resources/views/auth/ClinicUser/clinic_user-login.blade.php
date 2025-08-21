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
                <a href="{{ route('clinic.login') }}" class="hover:outline-none focus:outline-none md:overflow-none overflow-hidden">
                    <img src="{{asset('Frame 3.png')}}" alt="" class="w-50 h-50 md:mt-0 mt-[-5rem]" />
                </a>
            </div>
            <div class="md:h-[37.5rem] bg-white md:w-[38rem]  w-[20rem] h-[32rem] md:rounded-r-[15px] rounded-b-[10px] md:rounded-b-[0px] shadow-lg items-center justify-center p-5 md:p-20">
                <div class="flex flex-col justify-center ">

                    <!--Form-->
                    <div class="flex items-end justify-end mb-5">
                        <div id="datetime" class="md:text-md text-sm text-black font-bold"></div>
                    </div>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4 bg-green-100 p-3 rounded-md" :status="session('status')" />


                    <form method="POST" action="{{ route('clinic.login') }}" class="mt-5">
                        @csrf

                        <!-- account-id -->
                        <h1 class="text-center text-xl font-bold text-black">Login Clinic Account</h1>
                        <div class="mt-6">
                            <x-input-label for="account_id" :value="__('Account ID')" />
                            <x-text-input id="account_id" class="block mt-1 w-full" type="text" name="account_id" :value="old('account_id')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('account_id')" class="bg-red-200 px-4 py-2 mt-2 rouned-sm" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full"   
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                            <x-input-error :messages="$errors->get('password')" class="bg-red-200 px-4 py-2 mt-2 rounded-sm" />
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500" name="remember">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none " href="{{ route('clinic.forgot-password') }}">
                                {{ __('Forgot your password?') }}
                            </a>

                        </div>
                        <div class="mt-4">
                            <x-primary-button class="w-full justify-center bg-red-600 hover:bg-red-700 focus:bg-red-700">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <div class="flex items-end justify-end md:mt-12 mt-2 text-sm text-gray-400 ">
                        <p>iBiteCare<sup>+</sup></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


</body>

<!-- Footer -->

</html>