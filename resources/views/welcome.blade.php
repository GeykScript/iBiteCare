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
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);


    }

    .bg-section {
        background-image: url('/images/bg.png');
        background-size: cover;
        background-repeat: no-repeat;
        height: 90vh;
        /* Full screen height */
        width: 100%;
    }
</style>

<nav class="bg-white px-8 py-2 shadow-md">
    <div class="grid grid-cols-2 items-center gap-2 lg:grid-cols-5 ">
        <div class="flex items-center justify-start gap-2 col-span-2 lg:col-span-1">
            <a href="{{ url('/') }}" class="focus:outline-none hover:outline-none">
                <img src="{{ asset('drcare_logo.png') }}" alt="" class="w-14 h-14" />
            </a>
            <p class="text-3xl dr-care text-[#ff000dff] ">Dr.Care</p>
        </div>
        <div class="col-span-3 lg:col-span-3 ">
            <nav>
                <ul class="flex justify-evenly text-lg font-semibold p-2">
                    <li>
                        <a href="{{ url('/') }}"
                            class="text-black hover:text-[#EB1C26] hover:underline underline-offset-8 decoration-[#EB1C26] p-2">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/') }}"
                            class="text-black hover:text-[#EB1C26] hover:underline underline-offset-8 decoration-[#EB1C26] p-2">
                            About</a>
                    </li>
                    <li>
                        <a href="{{ url('/') }}"
                            class="text-black hover:text-[#EB1C26] hover:underline underline-offset-8 decoration-[#EB1C26] p-2">
                            Services</a>
                    </li>
            </nav>
        </div>

        <div class="col-span-3 lg:col-span-1">

            @if (Route::has('login'))
            <nav class=" flex items-center justify-evenly text-md font-semibold p-3 gap-2">
                @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-dark dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Dashboard
                </a>
                @else
                <a
                    href="{{ route('login') }}"
                    class="bg-red-600 w-full text-white text-center p-2 rounded-md hover:bg-red-500">
                    Log in
                </a>

                @if (Route::has('register'))
                <a
                    href="{{ route('register') }}"
                    class="bg-gray-800 w-full text-white text-center p-2 rounded-md hover:bg-gray-700">
                    Sign up
                </a>
                @endif
                @endauth
            </nav>
            @endif

        </div>
    </div>

</nav>

<body>
    <div class="flex flex-col">
        <div class="bg-section flex flex-row items-center justify-center  ">
            <div class="grid grid-cols-1 md:grid-cols-2 w-full mt-20 ">
                <div class="col-span-1 gap-10  p-10">
                    <div class="flex gap-5 ml-10">
                        <a href="{{ url('/') }}" class="focus:outline-none hover:outline-none">
                            <img src="{{ asset('images/dark-logo.png') }}" alt="" class="w-50 h-50" />
                        </a>
                        <div class="mt-4">
                            <p class="text-8xl dr-care text-[#FF000C]">
                                Dr.Care
                            </p>
                            <p class="text-4xl dr-care text-white "><span class="text-red-600">A</span>nimal <span class="text-green-600">B</span>ite <span class="text-indigo-800">C</span>enter</p>

                        </div>
                    </div>
                    <div class="w-full flex flex-col ml-10 px-8 ">
                        <img src="{{asset('images/guinobatan.png')}}" alt="" class="w-full h-full " />
                        <div class="w-full items-end justify-start flex px-2">
                            <button class="w-[8rem]  text-white bg-red-600 p-3 rounded-md font-bold">Book Now!</button>
                        </div>
                    </div>
                </div>

                <div class="col-span-1 flex items-center justify-center"> <a href="{{ url('/') }}" class="focus:outline-none hover:outline-none">
                        <img src="{{asset('images/location.png')}}" alt="" class="w-[28rem] h-[28rem] " /></a>
                </div>
                <div class="col-span-2 bg-black bg-opacity-20 p-6 px-20 rounded-md shadow-lg text-white grid grid-cols-2 ">
                    <div class="col-span-1 flex flex-col gap-1">
                        <h1 class="flex gap-2"><i data-lucide="map-pin"></i> 2nd Floor, CPD Building, Ilawod, Guinobatan, Albay, Philippines</h1>
                        <h1 class="flex gap-2"><i data-lucide="phone-call"></i>0954 195 2374</h1>
                        <h1 class="flex gap-2"><img src="{{asset('socials/gmail.svg')}}" alt="Gmail-logo" class="w-6 h-6"> drcareguinobatan@gmail.com</h1>
                        <h1 class="flex gap-2"><img src="{{asset('socials/facebook.svg')}}" alt="Facebook-logo" class="w-6 h-6"> Dr. Care Animal Bite Center-Guinobatan</h1>
                    </div>
                    <div class="col-span-1 flex flex-col gap-1 opacity-80">
                      <h1 class="dr-care text-xl">Clinic Hours</h1>
                      <h1 class="dr-care text-3xl">Monday to Saturday</h1>
                      <h1 class="font-bold text-2xl">8 : 00 AM - 5 : 00 PM</h1>
                    </div>
                </div>
            </div>
        </div>


        
    </div>



</body>


</html>