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
            <div class="md:h-[40rem] bg-white md:w-[35rem] border border-gray-200 w-[20rem] h-[45rem] md:rounded-r-[10px] rounded-b-[5px] md:rounded-b-[0px] shadow-xl items-center justify-center p-8 ">
                <div class="flex flex-col justify-between h-full  overflow-y-auto scrollbar-hidden">

                    <div class="flex  justify-between mb-5">
                        <a href="{{ route('auth.provider', ['provider' => session('auth_provider')]) }}"
                            class="flex items-center justify-center gap-2 hover:underline text-red-500  underline-offset-4">
                            <i data-lucide="circle-chevron-left" class="text-red-500"></i>
                            <span class="text-sm  ">Return to {{ ucfirst(session('auth_provider')) }}</span>
                        </a>
                        <div class="flex items-center justify-between gap-3">
                            <div id="datetime" class="md:text-md text-sm text-gray-700 font-bold"></div>
                        </div>
                    </div>

                    <div class="flex flex-col justify-center gap-4">
                        <h1 class="items-center justify-center gap-2 md:text-xl font-900 text-gray-700 flex  "><img src="{{asset('drcare_logo.png')}}" alt="Dr.Care logo" class="w-10 h-10">Create Password</h1>
                        <div class="flex flex-col justify-between md:px-12">
                            <div class="w-full flex flex-col items-center  ">
                                <x-auth-session-status class="bg-green-100 text-green-500 px-4 py-2 rounded-sm  mt-2   w-full" :status="session('status')" />
                            </div>
                            <div class="flex flex-col">
                                <!-- Set Password Form -->
                                <form method="POST" action="{{ route('set.password.store') }}" class="mt-4">
                                    @csrf

                                    <p class="text-sm text-gray-600 mt-2">
                                        Please create a password so you can log in directly with your email next time.
                                    </p>

                                    <!-- Password -->
                                    <div class="mt-6">
                                        <x-input-label for="password" :value="__('Password')" />
                                        <x-text-input
                                            id="password"
                                            class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required
                                            autocomplete="new-password"
                                            minlength="8"
                                            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}"
                                            title="Password must be at least 8 characters, include an uppercase letter, a lowercase letter, a number, and a special character." />
                                        <p class="text-sm text-gray-500 mt-1">
                                            Must be at least 8 characters, include uppercase, lowercase, number, and special character.
                                        </p>
                                        <x-input-error :messages="$errors->get('password')" class="bg-red-200 px-4 py-2 mt-2 rounded-sm font-bold text-red-500" />
                                    </div>


                                    <!-- Confirm Password -->
                                    <div class=" mt-4">
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password" name="password_confirmation" required autocomplete="new-password" />
                                    </div>

                                    <!-- Submit -->
                                    <div class="mt-4">
                                        <x-primary-button class="w-full justify-center bg-red-600 hover:bg-red-700 focus:bg-red-700">
                                            {{ __('Save Password') }}
                                        </x-primary-button>
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
    </section>
</body>

</html>