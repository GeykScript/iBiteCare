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
            <div class="md:h-[600px] md:w-[22rem] h-[16rem] w-[20rem] shadow-lg bg-[#EB1C26] md:rounded-l-[15px]  p-2 rounded-t-[15px] md:rounded-r-none md:overflow-none overflow-hidden">
                <a href="{{  url('/') }}" class="hover:outline-none focus:outline-none md:overflow-none overflow-hidden">
                    <img src="{{asset('Frame 3.png')}}" alt="" class="w-50 h-50 md:mt-0 mt-[-5rem]" />
                </a>
            </div>



            <div class="md:h-[37.5rem] bg-white md:w-[38rem]  w-[20rem] h-[34rem] md:rounded-r-[15px] rounded-b-[10px] md:rounded-b-[0px] shadow-lg items-center justify-center p-5 md:p-20">


                <div class="flex flex-col justify-center -mt-14">

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

                    <form method="POST" action="{{ route('login') }}" class="mt-4">
                        @csrf
                        <!-- Email Address -->
                        <h1 class="items-center justify-center gap-2 text-xl font-bold text-black flex"><img src="{{asset('drcare_logo.png')}}" alt="Dr.Care logo" class="w-8 h-8">Login Account</h1>
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
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500" name="remember">
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
                            <x-primary-button class="w-full justify-center bg-red-600 hover:bg-red-700 focus:bg-red-700">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                        <div class="mt-3 flex items-center justify-center hover:underline underline-offset-4 text-sm text-gray-700">
                            <a href="{{route('register')}}">Don't have an account?</a>
                        </div>
                        <!-- Social Login -->
                        <div class="mt-6">
                            <p class="text-center text-gray-500 text-sm mb-3">— Or sign in with —</p>
                            <div class="flex items-center justify-center gap-4">
                                
                                <!-- Google -->
                                <a title="Login with Google" href="{{ route('auth.provider', ['provider' => 'google']) }}"
                                class="flex items-center justify-center w-12 h-12 bg-white border border-gray-300 
                                        rounded-full shadow hover:bg-gray-200 transition">
                                    <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" class="w-6 h-6">
                                </a>

                                <!-- Facebook -->
                                <a title="Login with Facebook" href="{{ route('auth.provider', ['provider' => 'facebook']) }}"
                                class="flex items-center justify-center w-12 h-12 bg-white rounded-full 
                                        shadow hover:bg-gray-200 transition">
                                    <img src="{{asset('/socials/facebook.svg')}}" alt="Facebook" class="w-7 h-7 ">
                                </a>

                            </div>
                        </div>
                    </form>
                    <div class="flex items-end justify-end -mt-1 text-sm text-gray-400 ">
                        <p>iBiteCare<sup>+</sup></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<!-- Footer -->

</html>