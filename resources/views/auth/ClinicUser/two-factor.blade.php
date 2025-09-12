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


<body class="bg-gray-200">
    <section class="flex items-center justify-center md:h-screen mb-5 mt-5 md:mb-0 md:mt-0">
        <div class="flex flex-col md:flex-row justify-center items-center ">
            <div class="md:h-[600px] md:w-[25rem] h-[16rem] w-[20rem] shadow-2xl bg-[#EB1C26] md:rounded-l-[10px]  p-2 rounded-t-[15px] md:rounded-r-none md:overflow-none overflow-hidden">
                <a href="{{ route('clinic.login') }}" class="hover:outline-none focus:outline-none md:overflow-none overflow-hidden">
                    <img src="{{asset('Frame 3.png')}}" alt="" class="w-50 h-50 md:mt-0 mt-[-5rem]" />
                </a>
            </div>
            <div class="md:h-[37.5rem] bg-white md:w-[35rem] border border-gray-200 w-[20rem] h-[32rem] md:rounded-r-[10px] rounded-b-[5px] md:rounded-b-[0px] shadow-xl items-center justify-center py-8 px-4 md:px-8 ">
                <div class="flex flex-col justify-between h-full overflow-y-auto scrollbar-hidden">
                    <div class="flex  justify-between mb-5">
                        <a href="{{route('clinic.login')}}" class="flex items-center justify-center gap-2 hover:underline text-red-500  underline-offset-4">
                            <i data-lucide="circle-chevron-left" class="text-red-500"></i>
                            <span class="text-sm  ">Back</span>
                        </a>
                        <div class="flex items-center justify-between gap-3">
                            <div id="datetime" class="md:text-md text-sm text-black font-bold"></div>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center  gap-4">
                        <div class="flex flex-col justify-between  md:px-12 ">
                            <div class="w-full flex flex-col items-center  ">
                                <x-auth-session-status class="bg-green-100 text-green-500 px-4 py-2 rounded-sm  mt-2   w-full" :status="session('status')" />
                            </div>
                            <form method="POST" action="{{ route('clinic.two-factor.verify') }}" class="mt-5">
                                @csrf
                                <!-- Email Address -->
                                <input type="hidden" name="account_id" value="{{ $clinicUser->account_id }}">
                                <h1 class="text-center text-xl font-900 text-gray-700">Two-Factor Authentication</h1>
                                <p class="text-md mt-6">We’ve sent a 6-digit verification code to your registered email. Enter the code below to confirm your identity.</p>
                                <div class="mt-4">
                                    <x-input-label for="code" :value="__('Verification Code')" class="font-900 text-md " />
                                    <x-input-error :messages="$errors->get('code')" class="bg-red-200 px-4 py-2 mt-5 rounded-sm font-bold" />

                                    <div class="flex justify-center gap-2 mt-5">
                                        @for ($i = 0; $i < 6; $i++)
                                            <input
                                            type="text"
                                            maxlength="1"
                                            name="code[]"
                                            class="md:w-12 w-10 h-12 md:h-14 text-center border-b-2 border-gray-400 focus:border-sky-500 focus:outline-none text-lg md:text-2xl rounded"
                                            oninput="moveToNext(this)"
                                            onkeydown="moveToPrev(event, this)">
                                            @endfor
                                    </div>

                                    <input type="hidden" name="code" id="code">
                                </div>

                                <div class="mt-5">
                                    <x-primary-button class="w-full justify-center bg-red-600 hover:bg-red-700 focus:bg-red-700 py-3">
                                        {{ __('Verify') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="flex items-end justify-end md:mt-6 mt-2 text-sm text-gray-400 ">
                        <p class="hover:text-red-500 font-900">iBiteCare<sup>+</sup></p>
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
</script>
<!-- Footer -->

</html>