<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
   
    @endif
</head>

<body>
    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">

        @if (Route::has('login'))
        <nav class="-mx-3 flex flex-1 justify-end">
            @auth
            <a
                href="{{ url('/dashboard') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-dark dark:hover:text-white/80 dark:focus-visible:ring-white">
                Dashboard
            </a>
            @else
            <a
                href="{{ route('login') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-dark dark:hover:text-white/80 dark:focus-visible:ring-white">
                Log in
            </a>

            @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-dark dark:hover:text-white/80 dark:focus-visible:ring-white">
                Register
            </a>
            @endif
            @endauth
        </nav>
        @endif
    </header>

</body>

</html>