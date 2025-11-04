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
                <a href="{{ route('login') }}" class="hover:outline-none focus:outline-none md:overflow-none overflow-hidden">
                    <img src="{{asset('Frame 3.png')}}" alt="" class="w-50 h-50 md:mt-0 mt-[-5rem]" />
                </a>
            </div>
            <div class="md:h-[37.5rem] bg-white md:w-[35rem] border border-gray-200 w-[20rem] h-[32rem] md:rounded-r-[10px] rounded-b-[5px] md:rounded-b-[0px] shadow-xl items-center justify-center p-4 md:p-8  ">
                <div class="flex flex-col justify-start overflow-y-auto scrollbar-hidden h-full px-4">
                    <div class="flex items-end justify-between md:px-8">
                        <div class="flex items-center justify-end md:mt-6 mt-2 text-sm text-gray-400 ">
                            <p class="hover:text-red-500 font-900">iBiteCare<sup>+</sup></p>
                        </div>
                        <div id="datetime" class="md:text-md text-sm text-gray-700 font-bold"></div>
                    </div>
                    <div class="flex flex-col justify-center items-center gap-2  md:px-12">
                        <div class="w-full flex flex-col items-center  mt-4">
                            <x-auth-session-status class="bg-green-100 text-green-500 px-4 py-2 rounded-sm   w-full " :status="session('status')" />
                        </div>
                        <form method="POST" action="{{ route('patient.update-password.update') }}" class="flex flex-col gap-3" id="updatePasswordForm">
                            @csrf
                            <input type="text" name="email" value="{{ $User->email }}" hidden>
                            <h1 class="items-center justify-center gap-2 md:text-xl font-900 text-gray-700 flex mt-4 "><img src="{{asset('drcare_logo.png')}}" alt="Dr.Care logo" class="w-10 h-10">Update Password</h1>
                            <p class="text-sm">Set a new password for your account. Use a strong password with at least 8 characters, including letters, numbers, and symbols.</p>
                            <div>
                                <x-input-label for="update_patient_password" :value="__('New Password')" />
                                <x-text-input id="update_patient_password" name="password" type="password"
                                    class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="bg-red-200 px-4 py-2 mt-2" />
                            </div>

                            <div>
                                <x-input-label for="update_patient_password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="update_patient_password_confirmation" name="password_confirmation" type="password"
                                    class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="bg-red-200 px-4 py-2 mt-2" />
                            </div>


                            <div class="flex items-center justify-end gap-4">
                                <button type="submit" id="submitBtn" class="w-full bg-sky-500 shadow-lg px-6 py-2 rounded text-white font-bold hover:bg-sky-400">{{ __('Update Password') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    const submitBtn = document.getElementById("submitBtn");
    document.getElementById('updatePasswordForm').addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
            </svg>
            <span>Loading...</span>
        `;

    });
</script>

</html>