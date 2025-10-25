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
<!-- 
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
</nav> -->

<body class="bg-gray-900 flex items-center justify-center min-h-screen">

    <div class="text-center px-6">
        <h1 class="text-5xl md:text-7xl font-900 text-red-600 mb-4">🚧 Under Maintenance</h1>
        <p class="text-gray-300 text-lg md:text-xl mb-6">
            Our website is currently undergoing scheduled maintenance.<br>
            We’ll be back shortly. Thank you for your patience!
        </p>
        <a href="{{ url('/') }}" class="bg-red-600 hover:bg-red-500 text-white px-6 py-3 rounded-md font-semibold transition-colors">
            Go to Homepage
        </a>
    </div>

</body>



</html>