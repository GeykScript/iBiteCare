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
        position: relative;
        height: 100vh;
        width: 100%;
        overflow: hidden;
    }

    .bg-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('/images/bg-image.jpg');
        /* background-size: 100% 95%; */
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        filter: brightness(0.3);
        /* ↓ makes image darker (0 = black, 1 = normal) */
        transform: scale(1);
        /* Slight enlarge to avoid edges showing */
        z-index: 0;
    }

    .bg-section>* {
        position: relative;
        z-index: 1;
    }

    html {
        scroll-behavior: smooth;
    }
</style>

<nav class="bg-white border-gray-200 shadow-lg relative">
    <div class="w-full flex flex-wrap items-center justify-between lg:px-12  p-4">

        <!-- Logo & Brand -->
        <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse hover:outline-none focus:outline-none">
            <img src="{{ asset('drcare_logo.png') }}" class="h-10 w-10" alt="Dr.Care Logo" />
            <span class="font-900 text-2xl text-[#FF000D] whitespace-nowrap">Dr.Care</span>
        </a>

        <!-- Login/Register & Toggle -->
        <div class="flex lg:order-2 space-x-2 rtl:space-x-reverse">
            @if (Route::has('login'))
            @auth
            <a href="{{ url('/dashboard') }}" class="hidden lg:inline-block bg-gray-800 text-white text-sm px-4 py-2 rounded-lg hover:bg-gray-700">
                Dashboard
            </a>
            @else
            <a href="{{ route('login') }}" class="bg-red-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-red-500">
                Log in
            </a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="bg-gray-800 text-white text-sm px-4 py-2 rounded-lg hover:bg-gray-700 hidden lg:inline-block">
                Sign up
            </a>
            @endif
            @endauth
            @endif

            <!-- Hamburger Toggle Button -->
            <button id="menu-toggle" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
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
            class="hidden absolute top-full left-0 z-50 w-full  flex-col items-start rounded-b-lg bg-white border-t lg:static lg:flex lg:flex-row lg:items-center  lg:w-auto lg:border-0">
            <ul
                class="flex flex-col w-full font-medium  p-4 lg:p-0 lg:flex-row lg:space-x-14 lg:text-lg">
                <li><a href="#home" class="block py-2 px-4 text-black hover:text-[#EB1C26] hover:underline underline-offset-8 decoration-[#EB1C26]">Home</a></li>
                <li><a href="#about" class="block py-2 px-4 text-black hover:text-[#EB1C26] hover:underline underline-offset-8 decoration-[#EB1C26]">About</a></li>
                <li><a href="#services" class="block py-2 px-4 text-black hover:text-[#EB1C26] hover:underline underline-offset-8 decoration-[#EB1C26]">Services</a></li>
                <li><a href="#contact" class="block py-2 px-4 text-black hover:text-[#EB1C26] hover:underline underline-offset-8 decoration-[#EB1C26]">Contact</a></li>
            </ul>
        </div>

    </div>
</nav>

<body>
    <section id="home" class="bg-section bg-no-repeat bg-center w-full h-screen bg-contain sm:bg-cover flex flex-col items-center justify-between">
        <div class="flex lg:flex-row flex-col flex-col-reverse justify-center items-center lg:justify-evenly lg:items-center h-[90%]   w-full gap-2">
            <div class="flex flex-col lg:mt-5 mt-0">
                <div class="flex gap-5 ml-10">
                    <a href="{{ url('/') }}" class="focus:outline-none hover:outline-none ">
                        <img src="{{ asset('images/dark-logo.png') }}" alt="Dr-Care Dark Logo" class="lg:w-full lg:h-full  w-16 w-16" />
                    </a>
                    <div class="lg:mt-4">
                        <p class="lg:text-8xl text-5xl dr-care font-900 text-[#FF000C]"> Dr.Care</p>
                        <p class="lg:text-4xl text-lg dr-care text-white "><span class="text-red-600">A</span>nimal <span class="text-green-600">B</span>ite <span class="text-indigo-800">C</span>enter</p>
                    </div>
                </div>
                <div class="w-full flex flex-col lg:ml-10 px-8 ">
                    <img src="{{asset('images/guinobatan.png')}}" alt="Guinobatan-text" class="lg:w-full lg:h-full  w-50 w-50 " />
                    <div class="w-full items-end justify-start flex px-2 py-2">
                        @if (Route::has('login'))
                        @auth
                        <a href="{{ url('/dashboard') }}" class="text-white bg-red-600 lg:p-3 p-2 rounded-lg font-bold text-sm lg:text-lg">Book Now!</a>
                        @else
                        <a href="{{ route('login') }}" class="text-white bg-red-600 lg:p-3 p-2 rounded-lg font-bold text-sm lg:text-lg">Book Now!</a>
                        @endauth
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-5 lg:mt-5">
                <a href="{{ url('/') }}" class="focus:outline-none hover:outline-none">
                    <img src="{{asset('images/location.png')}}" alt="Dr-Care Buildings Images" class="lg:w-[29rem] lg:h-[32rem]  w-[16rem] h-[17rem]" />
                </a>
            </div>
        </div>


        <div class="lg:mt-0 bg-black lg:bg-opacity-30  bg-opacity-40 lg:p-6 p-3 lg:px-20  w-full shadow-lg text-white grid grid-cols-2 lg:gap-5">
            <div class="col-span-1 flex flex-col gap-1">
                <div class="flex flex-row gap-2 items-center ">
                    <i data-lucide="map-pin" class="w-8 h-8 lg:w-6 lg:h-6"></i>
                    <h1 class="lg:text-[16px] text-[10px] text-wrap">2nd Floor, CPD Building, Ilawod, Guinobatan, Albay, Philippines</h1>
                </div>
                <div class="flex flex-row gap-1 items-center ">
                    <i data-lucide="phone-call" class="w-4 h-4 lg:w-6 lg:h-6 "></i>
                    <h1 class="lg:text-[16px] text-[10px]">0954 195 2374</h1>
                </div>
                <div class="flex flex-row gap-1 items-center ">
                    <img src="{{asset('socials/gmail.svg')}}" alt="Gmail-logo" class="w-4 h-4 lg:w-6 lg:h-6">
                    <h1 class="lg:text-[16px] text-[10px]">drcareguinobatan@gmail.com</h1>
                </div>
                <div class="flex flex-row gap-1 items-center ">
                    <img src="{{asset('socials/facebook.svg')}}" alt="Facebook-logo" class="w-4 h-4 lg:w-6 lg:h-6">
                    <h1 class="lg:text-[16px] text-[10px]"> Dr. Care Animal Bite Center-Guinobatan</h1>
                </div>
            </div>

            <div class="col-span-1 flex flex-col gap-1 opacity-80 ml-5">
                <h1 class="font-bold lg:text-xl text-[14px]">Clinic Hours</h1>
                <h1 class="dr-care lg:text-3xl text-[17px]">Monday to Saturday</h1>
                <h1 class="font-bold lg:text-2xl text-[14px]">8:00 AM - 5:00 PM</h1>
            </div>
        </div>
    </section>

    <section class="bg-white" id="services">
        <div class="grid grid-cols-2 lg:gap-3 gap-1 lg:p-20  p-6">
            <div class="lg:col-span-1 col-span-2 flex flex-col justify-center items-center p-5 lg:px-20 lg:gap-10 gap-3">
                <div>
                    <h1 class="lg:text-5xl text-2xl font-900 text-[#FF000C]">Why Choose Us</h1>
                </div>
                <div class="text-start lg:px-16 lg:text-2xl text-lg ">
                    At our Animal Bite Center, we’re here to help you heal and feel better after an unexpected animal encounter. <br>
                    Our team of experts is ready to provide the best care for you.
                </div>
            </div>
            <div class="lg:col-span-1 col-span-2">
                @php
                    $colors = ['bg-red-600', 'bg-green-600', 'bg-indigo-600', 'bg-gray-600', 'bg-yellow-600', 'bg-purple-600'];
                @endphp
                <!-- Horizontal scroll container -->
                <div class="flex gap-4 overflow-x-auto p-2">
                    @foreach ($services->chunk(6) as $chunkIndex => $serviceChunk)
                    <div class="grid grid-cols-3 gap-2 flex-shrink-0 w-[500px] lg:w-[650px]">
                        @foreach ($serviceChunk as $index => $service)
                        <div class="bg-white flex flex-col items-center justify-center p-5 rounded-lg shadow-xl gap-3 border border-gray-100">
                            <!-- dynamic color -->
                            <div class="items-center justify-center gap-2 flex {{ $colors[($chunkIndex*4 + $index) % count($colors)] }} p-5 rounded-full">
                                <i data-lucide="syringe" class="lg:w-12 lg:h-12 w-6 h-6 text-white"></i>
                            </div>

                            <h1 class="text-sm lg:text-xl font-bold text-center">{{ $service->name }}</h1>
                            <h1 class="text-sm lg:text-xl">₱ {{ $service->service_fee }}</h1>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <section id="contact">
        <div class="grid grid-cols-4 lg:pl-4 gap-0 lg:gap-0 shadow-xl">
            <div class="col-span-4 sm:hidden lg:block block lg:col-span-1 lg:px-2 px-6">
                <img src="{{asset('images/banner.png')}}" alt="Dr-Care Sign"
                    class="w-full h-[15rem] lg:h-full rounded-t-xl lg:rounded-l-xl lg:rounded-r-none object-cover">
            </div>
            <div class="bg-white col-span-4 lg:col-span-3 flex flex-col gap-0 lg:gap-2">
                <div class="bg-red-600 h-2 lg:h-5 rounded-l-sm"></div>
                <div class="flex flex-col justify-center items-center py-6 px-4 lg:p-4 bg-gray-900 text-white h-full rounded-l-sm gap-6 lg:gap-5">
                    <h1 class="text-xl sm:text-4xl lg:text-5xl font-900 text-center text-gray-200">Book Online Appointment</h1>
                    <div class="bg-gray-800/60 p-5 rounded-lg shadow-inner text-start space-y-4">
                        <p>
                            📞 <span class="font-bold text-white">Call or text:</span>
                            <span class="text-red-400 font-semibold">0954 195 2374</span>
                        </p>
                        <p class="flex gap-2">
                            <img src="{{asset('socials/facebook.svg')}}" alt="Facebook-logo" class="w-4 h-4 lg:w-6 lg:h-6">
                            <span class="font-bold text-white">FB Page:</span>
                            <a href="https://www.facebook.com/profile.php?id=61572542114201"
                                target="_blank"
                                class="text-blue-400 hover:underline">
                                Dr. Care Animal Bite Center - Guinobatan
                            </a>
                        </p>
                        <p>
                            🌐 <span class="font-bold text-white">Or book directly using this website.</span>
                        </p>
                    </div>
                    <div class="bg-gray-800/60 p-6 sm:p-8 rounded-xl shadow-lg text-left space-y-5 text-gray-200 max-w-2xl w-full">
                        <h3 class="text-lg sm:text-xl font-semibold text-red-400">Important Notice</h3>
                        <p class="text-sm sm:text-base leading-relaxed">
                            This is your initial appointment. Failure to visit the clinic as scheduled may result in removal from our patient appointment list.
                            Thank you for your understanding.
                        </p>
                        <p class="text-sm sm:text-base italic text-gray-300">
                            To book an appointment, please click the button below.
                        </p>
                        <div>
                            @if (Route::has('login'))
                            @auth
                            <a href="{{ url('/dashboard') }}" class="text-white bg-red-600 lg:p-3 p-2 rounded-lg font-bold text-sm lg:text-lg">Book Now!</a>
                            @else
                            <a href="{{ route('login') }}" class="text-white bg-red-600 lg:p-3 p-2 rounded-lg font-bold text-sm lg:text-lg">Book Now!</a>
                            @endauth
                            @endif

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>



    <section class="bg-gray-100" id="about">
        <div class="grid grid-cols-2 items-center justify-center lg:gap-20 lg:p-12 p-6">
            <div class="col-span-2 lg:col-span-1 p-5 flex flex-col  gap-5">
                <h1 class="text-xl lg:text-2xl font-900  text-gray-500">Clinic Hours</h1>
                <div class="flex flex-row gap-2 lg:px-5 items-start justify-start">
                    <div class="flex items-center justify-center">
                        <i data-lucide="calendar-clock" class="w-10 h-10 lg:w-16 lg:h-16 text-[#FF000C] font-900"></i>
                    </div>
                    <div class="flex flex-col text-sm lg:text-3xl">
                        <h1 class="font-900 text-[#FF000C]">Monday - Saturday</h1>
                        <h1 class="font-bold text-sm lg:text-2xl  text-gray-800">8:00 AM - 5:00 PM</h1>
                    </div>
                </div>
            </div>
            <div class="col-span-2 lg:col-span-1 p-5 flex flex-col gap-5">
                <h1 class="text-xl lg:text-2xl font-900 text-gray-500">Clinic Location</h1>
                <div class="flex flex-row gap-2 lg:px-5  items-start justify-start">
                    <div class="flex items-center justify-center">
                        <i data-lucide="map-pinned" class="w-10 h-10 lg:w-16 lg:h-16 text-[#FF000C] font-900"></i>
                    </div>
                    <div class="flex flex-col text-sm lg:text-3xl text-gray-800 shadow-none">
                        <h1 class="font-900 text-[#FF000C]">Dr.Care Guinobatan</h1>
                        <h1 class="font-bold text-xs lg:text-xl">2nd Floor, CPD Building, Ilawod, Guinobatan, Albay, Philippines</h1>
                    </div>
                </div>
            </div>
            <div class="col-span-2 flex justify-center hidden lg:flex">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!4v1761314083261!6m8!1m7!1su92fSLmnrPRP7oG_CpWi4g!2m2!1d13.19259527591199!2d123.5984813759736!3f247.298179839878!4f8.970605024564918!5f0.7820865974627469" width="1500" height="600" style="border:0;" allow="accelerometer; gyroscope; magnetometer; fullscreen"
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-span-2 flex justify-center lg:hidden">
                <iframe src="https://www.google.com/maps/embed?pb=!4v1761314808558!6m8!1m7!1su92fSLmnrPRP7oG_CpWi4g!2m2!1d13.19259527591199!2d123.5984813759736!3f247.298179839878!4f8.970605024564918!5f0.7820865974627469" width="400" height="300" style="border:0;" allow="accelerometer; gyroscope; magnetometer; fullscreen"
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <div class="bg-[#5482B2] h-12 ">

    </div>

    <footer class="bg-gray-100 shadow-lg ">
        <div class="grid grid-cols-6 p-12">
            <div class="col-span-6 lg:col-span-2">
                <div class="flex flex-row gap-2  items-start justify-start">
                    <div class="flex items-center justify-center">
                        <img src="{{ asset('drcare_logo.png') }}" class="w-10 h-10 lg:w-16 lg:h-16 text-[#FF000C] font-900"></img>
                    </div>
                    <div class="flex flex-col text-sm lg:text-3xl">
                        <h1 class="font-900 text-[#FF000C]">Dr. Care</h1>
                        <h1 class="text-sm lg:text-2xl font-900 text-gray-800"><span class="text-red-600">A</span>nimal <span class="text-green-600">B</span>ite <span class="text-indigo-800">C</span>enter</h1>
                    </div>
                </div>
            </div>
            <div class="col-span-6 lg:col-span-1">
                <ul class="text-sm lg:text-lg text-gray-900 mt-2">
                    <li><a href="#home" class="block py-2 px-4 text-black hover:text-[#EB1C26] hover:underline underline-offset-8 decoration-[#EB1C26]">Home</a></li>
                    <li><a href="{{ route('faqs') }}" class="block py-2 px-4 text-black hover:text-[#EB1C26] hover:underline underline-offset-8 decoration-[#EB1C26]">FAQs</a></li>
                    <li><a href="{{ route('terms-and-conditions') }}" class="block py-2 px-4 text-black hover:text-[#EB1C26] hover:underline underline-offset-8 decoration-[#EB1C26]">Terms & Conditions</a></li>
                    <li><a href="{{ route('developers') }}" class="block py-2 px-4 text-black hover:text-[#EB1C26] hover:underline underline-offset-8 decoration-[#EB1C26]">Developers</a></li>


                </ul>
            </div>
            <div class="col-span-6 lg:col-span-3 flex flex-col gap-2 lg:gap-3 mt-5 text-gray-900">
                <div class="flex flex-row gap-2 items-center ">
                    <i data-lucide="map-pin" class="w-4 h-4 lg:w-auto lg:h-auto"></i>
                    <h1 class="lg:text-lg text-sm">2nd Floor, CPD Building, Ilawod, <br class="block lg:hidden"> Guinobatan, Albay, Philippines</h1>
                </div>
                <div class="flex flex-row gap-1 items-center ">
                    <i data-lucide="phone-call" class="w-4 h-4 lg:w-6 lg:h-6 "></i>
                    <h1 class="lg:text-lg text-sm">0954 195 2374</h1>
                </div>
                <div class="flex flex-row gap-1 items-center ">
                    <img src="{{asset('socials/gmail.svg')}}" alt="Gmail-logo" class="w-4 h-4 lg:w-6 lg:h-6">
                    <h1 class="lg:text-lg text-sm">drcareguinobatan@gmail.com</h1>
                </div>
                <div class="flex flex-row gap-1 items-center ">
                    <img src="{{asset('socials/facebook.svg')}}" alt="Facebook-logo" class="w-4 h-4 lg:w-6 lg:h-6">
                    <h1 class="lg:text-lg text-sm"> Dr. Care Animal Bite Center-Guinobatan</h1>
                </div>
            </div>
            <div class="col-span-6 mt-5 text-center text-gray-700 lg:mt-20 mt-16">
                <a href="{{ route('clinic.login') }}" class="text-lg text-gray-600 hover:text-red-600 font-bold">Admin Login</a>
                <p class="text-xs mt-4">© 2025 Dr.Care Guinobatan. All rights reserved.</p>
            </div>

        </div>
    </footer>






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