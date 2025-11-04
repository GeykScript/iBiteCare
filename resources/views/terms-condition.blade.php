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

        <!-- Logo & Brand -->
        <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse hover:outline-none focus:outline-none">
            <img src="{{ asset('drcare_logo.png') }}" class="h-10 w-10" alt="Dr.Care Logo" />
            <span class="font-900 text-2xl text-[#FF000D] whitespace-nowrap">Dr.Care</span>
        </a>

        <!-- Login/Register & Toggle -->
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

<body class="bg-gray-50 text-gray-800">

    <!-- Page Header -->
    <div class="max-w-5xl mx-auto px-6 py-12">
        <h1 class="text-4xl md:text-5xl font-900 text-[#FF000D] mb-6 text-center dr-care">Terms & Conditions</h1>
        <p class="text-center text-gray-600 mb-12">Please read these terms and conditions carefully before using our services.</p>

        <!-- Section 1 -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">1. Acceptance of Terms</h2>
            <p class="text-gray-700 leading-relaxed">
                By accessing or using Dr.Care services, you agree to be bound by these Terms and Conditions. If you do not agree with any part of the terms, you must not use our services.
            </p>
        </div>

        <!-- Section 2 -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">2. Services</h2>
            <p class="text-gray-700 leading-relaxed">
                Dr.Care provides animal bite consultations, vaccinations, and other services. We reserve the right to modify or discontinue any service without prior notice.
            </p>
        </div>

        <!-- Section 3 -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">3. User Responsibilities</h2>
            <p class="text-gray-700 leading-relaxed">
                Users must provide accurate information when booking appointments and follow all instructions provided by Dr.Care staff. Misuse of services may result in termination of access.
            </p>
        </div>

        <!-- Section 4 -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">4. Privacy</h2>
            <p class="text-gray-700 leading-relaxed">
                We respect your privacy and handle personal information in accordance with our Privacy Policy. By using our services, you consent to the collection and use of your data as described in the policy.
            </p>
        </div>

        <!-- Section 5 -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">5. Limitation of Liability</h2>
            <p class="text-gray-700 leading-relaxed">
                Dr.Care is not liable for any damages arising from the use of our services, including direct, indirect, incidental, or consequential damages. Our liability is limited to the maximum extent permitted by law.
            </p>
        </div>

        <!-- Section 6 -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">6. Changes to Terms</h2>
            <p class="text-gray-700 leading-relaxed">
                We may update these Terms and Conditions periodically. Changes will be effective immediately upon posting. Continued use of our services constitutes acceptance of the revised terms.
            </p>
        </div>

        <!-- Section 7 -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">7. Governing Law</h2>
            <p class="text-gray-700 leading-relaxed">
                These Terms are governed by the laws of the Philippines. Any disputes arising from these terms shall be subject to the exclusive jurisdiction of Philippine courts.
            </p>
        </div>

        <!-- Footer -->
        <p class="text-center text-gray-500 text-sm mt-12">
            © {{ date('Y') }} Dr.Care Guinobatan. All rights reserved.
        </p>
    </div>

</body>


</html>