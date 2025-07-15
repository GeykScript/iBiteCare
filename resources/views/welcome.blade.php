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

    .bg-section {
        background-image: url('/images/bg.png');
        background-size: cover;
        background-repeat: no-repeat;
        height: 100vh;
        /* Full screen height */
        width: 100%;
    }
</style>

<nav class="bg-white border-gray-200 shadow-md relative">
    <div class="w-full flex flex-wrap items-center justify-between md:px-12  p-4">

        <!-- Logo & Brand -->
        <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse hover:outline-none focus:outline-none">
            <img src="{{ asset('drcare_logo.png') }}" class="h-10 w-10" alt="Dr.Care Logo" />
            <span class="font-900 text-2xl font-bold text-[#FF000D] whitespace-nowrap">Dr.Care</span>
        </a>

        <!-- Login/Register & Toggle -->
        <div class="flex md:order-2 space-x-2 rtl:space-x-reverse">
            @if (Route::has('login'))
            @auth
            <a href="{{ url('/dashboard') }}" class="hidden md:inline-block bg-gray-800 text-white text-sm px-4 py-2 rounded-md hover:bg-gray-700">
                Dashboard
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

            <!-- Hamburger Toggle Button -->
            <button id="menu-toggle" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="navbar-dr-care" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <div id="navbar-dr-care"
            class="hidden absolute top-full left-0 z-50 w-full  flex-col items-start rounded-b-lg bg-red-50 md:bg-white border-t md:static md:flex md:flex-row md:items-center  md:w-auto md:border-0">
            <ul
                class="flex flex-col w-full font-medium  p-4 md:p-0 md:flex-row md:space-x-14 lg:text-lg">
                <li><a href="{{ url('/') }}" class="block py-2 px-4 text-black hover:text-[#EB1C26] hover:underline underline-offset-8 decoration-[#EB1C26]">Home</a></li>
                <li><a href="{{ url('/') }}" class="block py-2 px-4 text-black hover:text-[#EB1C26] hover:underline underline-offset-8 decoration-[#EB1C26]">About</a></li>
                <li><a href="{{ url('/') }}" class="block py-2 px-4 text-black hover:text-[#EB1C26] hover:underline underline-offset-8 decoration-[#EB1C26]">Services</a></li>
                <li><a href="{{ url('/') }}" class="block py-2 px-4 text-black hover:text-[#EB1C26] hover:underline underline-offset-8 decoration-[#EB1C26]">Contact</a></li>
            </ul>
        </div>

    </div>
</nav>

<body>
    <section class="bg-section bg-no-repeat bg-center w-full h-screen bg-contain sm:bg-cover">
        <div class="flex md:flex-row flex-col flex-col-reverse justify-center items-center md:justify-evenly md:items-center md:h-[80%]  w-full gap-2">
            <div class="flex flex-col md:mt-5 mt-0">
                <div class="flex gap-5 ml-10">
                    <a href="{{ url('/') }}" class="focus:outline-none hover:outline-none ">
                        <img src="{{ asset('images/dark-logo.png') }}" alt="" class="md:w-full md:h-full  w-16 w-16" />
                    </a>
                    <div class="md:mt-4">
                        <p class="md:text-8xl text-4xl dr-care text-[#FF000C]"> Dr.Care</p>
                        <p class="md:text-4xl text-md dr-care text-white "><span class="text-red-600">A</span>nimal <span class="text-green-600">B</span>ite <span class="text-indigo-800">C</span>enter</p>
                    </div>
                </div>
                <div class="w-full flex flex-col md:ml-10 px-8 ">
                    <img src="{{asset('images/guinobatan.png')}}" alt="" class="md:w-full md:h-full  w-50 w-50 " />
                    <div class="w-full items-end justify-start flex px-2 py-2">
                        <a href="" class="text-white bg-red-600 md:p-3 p-2 rounded-md font-bold text-sm md:text-md">Book Now!</a>
                    </div>
                </div>
            </div>
            <div class="mt-5 md:mt-5">
                <a href="{{ url('/') }}" class="focus:outline-none hover:outline-none">
                    <img src="{{asset('images/location.png')}}" alt="" class="md:w-[29rem] md:h-[32rem]  w-[16rem] h-[17rem]" />
                </a>
            </div>
        </div>
        <div class="mt-10 md:mt-0 bg-black md:bg-opacity-30  bg-opacity-40 md:p-6 p-3 md:px-20  shadow-lg text-white grid grid-cols-2 lg:gap-5">
            <div class="col-span-1 flex flex-col gap-1">
                <div class="flex flex-row gap-2 items-center ">
                    <i data-lucide="map-pin" class="w-8 h-8 md:w-6 md:h-6"></i>
                    <h1 class="md:text-[16px] text-[10px] text-wrap">2nd Floor, CPD Building, Ilawod, Guinobatan, Albay, Philippines</h1>
                </div>
                <div class="flex flex-row gap-1 items-center ">
                    <i data-lucide="phone-call" class="w-4 h-4 md:w-6 md:h-6 "></i>
                    <h1 class="md:text-[16px] text-[10px]">0954 195 2374</h1>
                </div>
                <div class="flex flex-row gap-1 items-center ">
                    <img src="{{asset('socials/gmail.svg')}}" alt="Gmail-logo" class="w-4 h-4 md:w-6 md:h-6">
                    <h1 class="md:text-[16px] text-[10px]">drcareguinobatan@gmail.com</h1>
                </div>
                <div class="flex flex-row gap-1 items-center ">
                    <img src="{{asset('socials/facebook.svg')}}" alt="Facebook-logo" class="w-4 h-4 md:w-6 md:h-6">
                    <h1 class="md:text-[16px] text-[10px]"> Dr. Care Animal Bite Center-Guinobatan</h1>
                </div>
            </div>

            <div class="col-span-1 flex flex-col gap-1 opacity-80 ml-5">
                <h1 class="font-bold md:text-xl text-[14px]">Clinic Hours</h1>
                <h1 class="dr-care md:text-3xl text-[17px]">Monday to Saturday</h1>
                <h1 class="font-bold md:text-2xl text-[14px]">8:00 AM - 5:00 PM</h1>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="grid grid-cols-2 gap-3 md:p-20 p-6">
            <div class="md:col-span-1 col-span-2 flex flex-col justify-center items-center p-5 md:px-20 gap-10">
                <div>
                    <h1 class="text-5xl font-900 text-[#FF000C]">Why Choose Us</h1>
                </div>
                <div class="text-start md:px-16 text-2xl ">
                    At our Animal Bite Center, we’re here to help you heal and feel better after an unexpected animal encounter. <br>
                    Our team of experts is ready to provide the best care for you.
                </div>
            </div>
            <div class="md:col-span-1 col-span-2">
                <div class="grid grid-cols-2 gap-4 ">
                    <div class="bg-white flex flex-col items-center justify-center p-5 rounded-lg shadow-xl gap-3 border border-gray-100">
                        <div class="items-center justify-center gap-2 flex bg-red-600 p-5 rounded-full ">
                            <i data-lucide="syringe" class="w-12 h-12 text-white"></i>
                        </div>
                        <h1 class="md:text-xl font-bold">Anti-Rabies Vaccine</h1>
                    </div>
                    <div class="bg-white flex flex-col items-center justify-center p-5 rounded-lg shadow-xl  gap-3 border border-gray-100">
                        <div class="items-center justify-center gap-2 flex bg-green-600 p-5 rounded-full ">
                            <i data-lucide="syringe" class="w-12 h-12 text-white"></i>
                        </div>
                        <h1 class="md:text-xl font-bold">Pre-Post Exposure Treatment</h1>
                    </div>
                    <div class="bg-white flex flex-col items-center justify-center p-5 rounded-lg shadow-xl  gap-3 border border-gray-100">
                        <div class="items-center justify-center gap-2 flex bg-indigo-600 p-5 rounded-full ">
                            <i data-lucide="syringe" class="w-12 h-12 text-white"></i>
                        </div>
                        <h1 class="md:text-xl font-bold">ERIG</h1>
                    </div>
                    <div class="bg-white flex flex-col items-center justify-center p-5 rounded-lg shadow-xl  gap-3 border border-gray-100">
                        <div class="items-center justify-center gap-2 flex bg-gray-600 p-5 rounded-full ">
                            <i data-lucide="syringe" class="w-12 h-12 text-white"></i>
                        </div>
                        <h1 class="md:text-xl font-bold">Tetanus Toxoid</h1>
                    </div>
                </div>

            </div>
        </div>
    </section>

</body>

<script>
    const toggleButton = document.getElementById('menu-toggle');
    const menu = document.getElementById('navbar-dr-care');

    toggleButton.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    document.querySelectorAll('#navbar-dr-care a').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 768) {
                menu.classList.add('hidden');
            }
        });
    });
</script>

</html>