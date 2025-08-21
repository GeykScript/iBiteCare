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

                    <form method="POST" action="{{ route('clinic.two-factor.verify') }}" class="mt-5">
                        @csrf

                        <!-- Email Address -->
                        <input type="hidden" name="account_id" value="{{ $clinicUser->account_id }}">

                        <h1 class="text-center text-xl font-bold text-black">Two-Factor Authentication</h1>
                        <p class="text-sm mt-6">We’ve sent a 6-digit verification code to your registered email. Enter the code below to confirm your identity.</p>

                        <div class="mt-4">
                            <x-input-label for="code" :value="__('Verification Code')" />
                            <x-input-error :messages="$errors->get('code')" class="bg-red-200 px-4 py-2 mt-5 rounded-sm" />

                            <div class="flex justify-center gap-2 mt-5">
                                @for ($i = 0; $i < 6; $i++)
                                    <input
                                    type="text"
                                    maxlength="1"
                                    name="code[]"
                                    class="w-12 h-14 text-center border-b-2 border-gray-400 focus:border-sky-500 focus:outline-none text-2xl rounded"
                                    oninput="moveToNext(this)"
                                    onkeydown="moveToPrev(event, this)">
                                    @endfor
                            </div>

                            <input type="hidden" name="code" id="code">
                        </div>

                        <div class="mt-5">
                            <x-primary-button class="w-full justify-center bg-red-600 hover:bg-red-700 focus:bg-red-700">
                                {{ __('Verify') }}
                            </x-primary-button>
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
<script>
    function moveToNext(el) {
        if (el.value.length === 1 && el.nextElementSibling) {
            el.nextElementSibling.focus();
        }
        updateCode();
    }

    function moveToPrev(event, el) {
        if (event.key === "Backspace" && el.value === "" && el.previousElementSibling) {
            el.previousElementSibling.focus();
        }
        updateCode();
    }

    function updateCode() {
        let codeInputs = document.querySelectorAll("input[name='code[]']");
        let code = "";
        codeInputs.forEach(input => code += input.value);
        document.getElementById("code").value = code;
    }

    function updateDateTime() {
        const now = new Date();

        // Format date
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const month = months[now.getMonth()];
        const day = now.getDate();
        const year = now.getFullYear();

        // Format time
        let hours = now.getHours();
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';

        hours = hours % 12;
        hours = hours ? hours : 12; // Convert 0 to 12

        // Create formatted strings
        const dateString = `${month} ${day}, ${year}`;
        const timeString = `${hours}:${minutes} ${ampm}`;

        // Update DOM
        document.getElementById('datetime').innerHTML = `${dateString} <br> ${timeString}`;
    }

    // Update immediately and then every second
    updateDateTime();
    setInterval(updateDateTime, 1000);
</script>
<!-- Footer -->

</html>