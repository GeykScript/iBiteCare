<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('drcare_logo.png') }}" type="image/png">
    <!-- Fonts -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @endif
</head>

<style>
    .dr-care {
        font-family: 'Geologica', sans-serif;
        font-weight: 900;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.4);
    }

    .font-900 {
        font-family: 'Geologica', sans-serif;
        font-weight: 900;
        text-shadow: 0px 0px 2px rgba(0, 0, 0, 0.4);

    }


    html {
        scroll-behavior: smooth;
    }
</style>

<nav class="bg-white border-gray-200 shadow-md relative">
    <div class="w-full flex flex-wrap items-center justify-between md:px-12  p-4">

        <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse hover:outline-none focus:outline-none">
            <img src="{{ asset('drcare_logo.png') }}" class="h-10 w-10" alt="Dr.Care Logo" />
            <span class="font-900 text-2xl text-[#FF000D] whitespace-nowrap">Dr.Care</span>
        </a>

        <div class="flex md:order-2 space-x-2 rtl:space-x-reverse">
            @if (Route::has('login'))
            @auth
            <a href="{{ url('/dashboard') }}" class="hidden md:inline-block bg-gray-800 text-white text-sm px-4 py-2 rounded-md hover:bg-gray-700">
                Return to Dashboard
            </a>
            @else
            <a href="{{ route('login') }}" class="bg-red-600 text-white text-sm px-4 py-2 rounded-md hover:bg-red-500">
                Log in
            </a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="bg-gray-800 text-white text-sm px-4 py-2 rounded-md hover:bg-gray-700 hidden md:inline-block">
                Sign up
            </a>
            @endif
            @endauth
            @endif
        </div>
    </div>
</nav>
<!-- <body class="bg-gradient-to-b from-red-950 to-red-700"> -->

<body class="bg-gradient-to-r from-red-900 via-red-700 to-red-500">

    <div class="md:h-screen flex flex-col  justify-center max-w-6xl   max-sm:max-w-sm mx-auto py-4 px-4 md:px-0">
        <div class="text-center">
            <h2 class="text-white text-2xl md:text-4xl font-900">Meet Our Development team</h2>
            <p class="text-white text-[15px] mt-4">Get to know the aspiring professionals who built this platform.</p>
        </div>
        <div class="grid lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-2 gap-x-6 gap-y-20 text-center mt-24">
            <div class="bg-gray-100 relative rounded-md border border-transparent 
                hover:shadow-[0_20px_50px_rgba(239,68,68,0.4)] hover:-translate-y-2 
                hover:scale-105 transition-all duration-300 ease-in-out">
                <div class="w-36 h-36 rounded-full inline-block border-4 border-gray-200  overflow-hidden -mt-14">
                    <img src="{{ asset('images/developers/mark.jpg') }}"
                        class="w-full h-full" />
                </div>
                <div class="py-4">
                    <h4 class="text-slate-900 text-base font-semibold">Mark James Barreda</h4>
                    <p class="text-slate-600 text-[13px] mt-4">Project Manager</p>

                    <div class=" mt-4">
                        <a href="https://www.facebook.com/Mark.Barreda.25" target="_blank"
                            class="w-7 h-7 inline-flex items-center justify-center rounded-full border-0 outline-0 cursor-pointer bg-gray-100 hover:bg-gray-200">
                            <img src="{{asset('socials/fb.svg')}}" alt="Facebook-logo" class="w-4 h-4 md:w-6 md:h-6">
                        </a>
                        <a href="https://github.com/Mark-games" target="_blank"
                            class="w-7 h-7 inline-flex items-center justify-center rounded-full border-0 outline-0 cursor-pointer bg-gray-100 hover:bg-gray-200">
                            <img src="{{asset('socials/github-mark.svg')}}" alt="github-logo" class="w-4 h-4 md:w-6 md:h-6">
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 relative rounded-md border border-transparent 
                hover:shadow-[0_20px_50px_rgba(239,68,68,0.4)] hover:-translate-y-2 
                hover:scale-105 transition-all duration-300 ease-in-out">
                <div class="w-36 h-36 rounded-full inline-block border-4 border-gray-200  overflow-hidden -mt-14">
                    <img src="{{ asset('images/developers/jake.jpg') }}"
                        class="w-full h-full" />
                </div>
                <div class="py-4">
                    <h4 class="text-slate-900 text-base font-semibold">Jervy Jake Morales</h4>
                    <p class="text-slate-600 text-[13px] mt-1">Lead Web Developer</p>
                    <p class="text-slate-600 text-[13px]">UI/UX Designer</p>
                    <div class=" mt-4">
                        <a href="https://www.facebook.com/jervy.jake.morales" target="_blank"
                            class="w-7 h-7 inline-flex items-center justify-center rounded-full border-0 outline-0 cursor-pointer bg-gray-100 hover:bg-gray-200">
                            <img src="{{asset('socials/fb.svg')}}" alt="Facebook-logo" class="w-4 h-4 md:w-6 md:h-6">
                        </a>
                        <a href="https://github.com/GeykScript" target="_blank"
                            class="w-7 h-7 inline-flex items-center justify-center rounded-full border-0 outline-0 cursor-pointer bg-gray-100 hover:bg-gray-200">
                            <img src="{{asset('socials/github-mark.svg')}}" alt="github-logo" class="w-4 h-4 md:w-6 md:h-6">
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 relative rounded-md border border-transparent 
                hover:shadow-[0_20px_50px_rgba(239,68,68,0.4)] hover:-translate-y-2 
                hover:scale-105 transition-all duration-300 ease-in-out">
                <div class="w-36 h-36 rounded-full inline-block border-4 border-gray-200 bg-gray-200  overflow-hidden -mt-14">
                    <img src="{{ asset('images/developers/neco.jpg') }}"
                        class="w-full h-full" />
                </div>
                <div class="py-4">
                    <h4 class="text-slate-900 text-base font-semibold">Neco Clemente</h4>
                    <p class="text-slate-600 text-[13px] mt-4">Web Developer</p>
                    <div class=" mt-4">
                        <a href="https://www.facebook.com/kuneeeeeee" target="_blank"
                            class="w-7 h-7 inline-flex items-center justify-center rounded-full border-0 outline-0 cursor-pointer bg-gray-100 hover:bg-gray-200">
                            <img src="{{asset('socials/fb.svg')}}" alt="Facebook-logo" class="w-4 h-4 md:w-6 md:h-6">
                        </a>
                        <a href="https://github.com/kuuuu-knee" target="_blank"
                            class="w-7 h-7 inline-flex items-center justify-center rounded-full border-0 outline-0 cursor-pointer bg-gray-100 hover:bg-gray-200">
                            <img src="{{asset('socials/github-mark.svg')}}" alt="github-logo" class="w-4 h-4 md:w-6 md:h-6">
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 relative rounded-md border border-transparent 
                hover:shadow-[0_20px_50px_rgba(239,68,68,0.4)] hover:-translate-y-2 
                hover:scale-105 transition-all duration-300 ease-in-out">
                <div class="w-36 h-36 rounded-full inline-block border-4 border-gray-200  overflow-hidden -mt-14">
                    <img src="{{ asset('images/developers/francis.jpg') }}"
                        class="w-full h-full" />
                </div>
                <div class="py-4">
                    <h4 class="text-slate-900 text-base font-semibold">Francis Gerald Caisip</h4>
                    <p class="text-slate-600 text-[13px] mt-4">UI/UX Designer</p>

                    <div class=" mt-4">
                        <a href="https://www.facebook.com/frahahahancis" target="_blank"
                            class="w-7 h-7 inline-flex items-center justify-center rounded-full border-0 outline-0 cursor-pointer bg-gray-100 hover:bg-gray-200">
                            <img src="{{asset('socials/fb.svg')}}" alt="Facebook-logo" class="w-4 h-4 md:w-6 md:h-6">
                        </a>
                        <a href="https://github.com/frahahahancis" target="_blank"
                            class="w-7 h-7 inline-flex items-center justify-center rounded-full border-0 outline-0 cursor-pointer bg-gray-100 hover:bg-gray-200">
                            <img src="{{asset('socials/github-mark.svg')}}" alt="github-logo" class="w-4 h-4 md:w-6 md:h-6">
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 relative rounded-md border border-transparent 
                hover:shadow-[0_20px_50px_rgba(239,68,68,0.4)] hover:-translate-y-2 
                hover:scale-105 transition-all duration-300 ease-in-out">
                <div class="w-36 h-36 rounded-full inline-block border-4 border-gray-200  overflow-hidden -mt-14">
                    <img src="{{ asset('images/developers/michael.png') }}"
                        class="w-full h-full" />
                </div>

                <div class="py-4">
                    <h4 class="text-slate-900 text-base font-semibold">Michael Vargas</h4>
                    <p class="text-slate-600 text-[13px] mt-4">QA Tester</p>

                    <div class=" mt-4">
                        <a href="https://www.facebook.com/mchlvargas" target="_blank"
                            class="w-7 h-7 inline-flex items-center justify-center rounded-full border-0 outline-0 cursor-pointer bg-gray-100 hover:bg-gray-200">
                            <img src="{{asset('socials/fb.svg')}}" alt="Facebook-logo" class="w-4 h-4 md:w-6 md:h-6">
                        </a>
                        <a href="https://github.com" target="_blank"
                            class="w-7 h-7 inline-flex items-center justify-center rounded-full border-0 outline-0 cursor-pointer bg-gray-100 hover:bg-gray-200">
                            <img src="{{asset('socials/github-mark.svg')}}" alt="github-logo" class="w-4 h-4 md:w-6 md:h-6">
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>



</html>