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
        <div class="flex flex-col md:flex-row justify-center items-center md:mt-12 mt-6 mb-10">
            <div class="md:h-[640px] md:w-[22rem] h-[16rem] w-[20rem] shadow-lg bg-[#EB1C26] md:rounded-l-[15px]  p-2 md:py-12 rounded-t-[15px] md:rounded-r-none md:overflow-none overflow-hidden">
                <a href="{{  url('/') }}" class="hover:outline-none focus:outline-none md:overflow-none overflow-hidden">
                    <img src="{{asset('Frame 3.png')}}" alt="" class="w-50 h-50 md:mt-0 mt-[-5rem]" />
                </a>
            </div>

            <div class="md:h-[40rem] bg-white md:w-[38rem]  w-[20rem] h-[36rem] md:rounded-r-[15px] rounded-b-[10px] md:rounded-b-[0px] shadow-lg items-center justify-center p-5 md:px-20">


                <div class="flex flex-col justify-center md:mt-5 ">

                    <div class="flex  justify-between mb-5">
                        <a href="{{url('/')}}" class="flex items-center justify-center gap-2 hover:underline text-red-500  underline-offset-4">
                            <i data-lucide="circle-chevron-left" class="text-red-500"></i>
                            <span class="text-sm  ">Return to menu</span>
                        </a>
                        <div class="flex items-center justify-between gap-3">
                            <div id="datetime" class="md:text-md text-sm text-black font-bold"></div>
                        </div>
                    </div>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h1 class="items-center justify-center gap-2 text-xl font-bold text-black flex"><img src="{{asset('drcare_logo.png')}}" alt="Dr.Care logo" class="w-8 h-8">Create Account</h1>
                        <div class="mt-6">
                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Password')" />

                                <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="flex items-center flex-col mt-4">

                                <x-primary-button class=" w-full text-center items-center justify-center bg-red-600 hover:bg-red-700 focus:bg-red-700">
                                    {{ __('Register') }}
                                </x-primary-button>
                                <div class="mt-3 flex items-center justify-center hover:underline underline-offset-4 text-sm text-gray-700">
                                    <a href="{{route('login')}}"> Already registered?</a>
                                </div>

                            </div>
                    </form>

                    <div class="flex items-end justify-end mt-4 text-sm text-gray-400 ">
                        <p>iBiteCare<sup>+</sup></p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

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