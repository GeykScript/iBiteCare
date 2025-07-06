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
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @endif
</head>


<body class="bg-gradient-to-r from-red-500 to-gray-700">

    <div class="flex flex-col md:flex-row justify-center items-center md:mt-20 mt-6 mb-10">
        <div class="md:h-[600px] md:w-[23rem] h-[21rem] w-[20rem] shadow-lg bg-[#EB1C26] rounded-l-lg p-2 md:p-3  rounded-t-lg md:rounded-t-none ">
            <img src="{{asset('Frame 3.png')}}" alt="" class="w-50 h-50 " />
        </div>
        <div class="md:h-[37.5rem] bg-white md:w-[38rem]  w-[20rem] h-[30rem] md:rounded-r-[15px] rounded-b-[10px] md:rounded-b-[0px] shadow-lg items-center justify-center p-5 md:p-20">

            <!--Form-->
            <div class="flex items-end justify-end mb-5">
                <i data-lucide="calendar-clock" class=" w-16 h-16 pr-2 ml-4 text-white"></i>
                <div id="datetime" class="md:text-md text-sm text-black font-bold mr-6 ml-4"></div>
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('clinic.login') }}">
                @csrf

                <!-- Email Address -->
                <h1 class="text-center text-xl font-bold text-black">Login Clinic Account</h1>
                <div class="mt-6">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif

                </div>
                <div class="mt-4">
                    <x-primary-button class="w-full justify-center bg-[#EB1C26] hover:bg-red-600 focus:bg-red-700">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>
</body>
<script>
    function updateDateTime() {
        const now = new Date();

        // Format date
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const month = months[now.getMonth()];
        const day = now.getDate();
        const year = now.getFullYear();

        // Format time
        let hours = now.getHours();
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';

        hours = hours % 12;
        hours = hours ? hours : 12; // Convert 0 to 12

        // Create formatted strings
        const dateString = `${month} ${day}, ${year}`;
        const timeString = `${hours}:${minutes} ${ampm}`;

        // Update DOM
        document.getElementById('datetime').innerHTML = `${dateString} <br> ${timeString}`;
    }

    // Update immediately and then every second
    updateDateTime();
    setInterval(updateDateTime, 1000);
</script>
<!-- Footer -->

</html>