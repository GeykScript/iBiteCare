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
            <div class="md:h-[37.5rem] bg-white md:w-[38rem]  w-[20rem] h-[30rem] md:rounded-r-[15px] rounded-b-[10px] md:rounded-b-[0px] shadow-lg items-center justify-center p-5 md:p-20">


                <div class="flex flex-col justify-center ">

                    <!--Form-->
                    <div class="flex items-end justify-end mb-5">
                        <div id="datetime" class="md:text-md text-sm text-black font-bold"></div>
                    </div>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('patient.update-password.update') }}" class="mt-5 flex flex-col gap-3">
                        @csrf
                        <input type="text" name="email" value="{{ $User->email }}" hidden>
                        <!-- Email Address -->
                        <h1 class="text-center text-xl font-bold text-black">Update Account Password</h1>
                        <p class="text-sm mt-6">Set a new password for your account. Use a strong password with at least 8 characters, including letters, numbers, and symbols.</p>
                        <div>
                            <x-input-label for="update_patient_password" :value="__('New Password')" />
                            <x-text-input id="update_patient_password" name="password" type="password"
                                class="mt-1 block w-full" autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="bg-red-200 px-4 py-2 mt-2" />
                        </div>

                        <div>
                            <x-input-label for="update_patient_password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="update_patient_password_confirmation" name="password_confirmation" type="password"
                                class="mt-1 block w-full" autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="bg-red-200 px-4 py-2 mt-2" />
                        </div>


                        <div class="flex items-center justify-end gap-4">
                            <button class="bg-sky-500 shadow-lg px-6 py-2 rounded text-white font-bold hover:bg-sky-400">{{ __('Update Password') }}</button>
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


</html>