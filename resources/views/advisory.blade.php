<x-app-layout>
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
    <div class="bg-gradient-to-b from-red-950 to-red-700">
        <div class="grid grid-cols-12 h-screen">
            <div class="hidden md:flex col-span-6  justify-center items-center">
                <div class="flex flex-col md:mt-5 mt-0">
                    <div class="flex gap-5 ml-10">
                        <img src="{{ asset('images/dark-logo.png') }}" alt="Dr-Care Dark Logo" class="md:w-full md:h-full  w-16 w-16" />
                        <div class="md:mt-4">
                            <p class="md:text-8xl text-5xl dr-care font-900 text-[#FF000C]"> Dr.Care</p>
                            <p class="md:text-4xl text-md dr-care text-white "><span class="text-red-600">A</span>nimal <span class="text-green-600">B</span>ite <span class="text-indigo-800">C</span>enter</p>
                        </div>
                    </div>
                    <div class="w-full flex flex-col md:ml-10 px-8 ">
                        <img src="{{asset('images/guinobatan.png')}}" alt="Guinobatan-text" class="md:w-full md:h-full  w-50 w-50 " />
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 bg-white flex flex-col justify-center items-center">
                <div class="w-full max-w-2xl p-6 space-y-6">
                    <h2 class="text-3xl  mb-6 text-gray-800 text-center font-900">Frequently Asked Questions</h2>

                    <!-- FAQ 1 -->
                    <div x-data="{ open: false }" class="border-2 p-2 border-red-500 rounded-xl shadow-md">
                        <button
                            @click="open = !open"
                            class="w-full px-6 py-4 text-left bg-red-50 hover:bg-red-100 flex justify-between items-center text-lg font-semibold transition-all duration-300 rounded-xl">
                            What are the clinic hours?
                            <span x-show="!open" class="text-red-500 font-bold text-xl">+</span>
                            <span x-show="open" class="text-red-500 font-bold text-xl">-</span>
                        </button>
                        <div x-show="open" x-transition class="px-6 py-4 bg-white border-t border-red-500 text-gray-700 text-base">
                            Our clinic is open from 8:00 AM to 5:00 PM.
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div x-data="{ open: false }" class="border-2 p-2 border-sky-500 rounded-xl shadow-md">
                        <button
                            @click="open = !open"
                            class="w-full px-6 py-4 text-left bg-sky-50 hover:bg-sky-100 flex justify-between items-center text-lg font-semibold transition-all duration-300 rounded-xl">
                            What days are you open?
                            <span x-show="!open" class="text-sky-500 font-bold text-xl">+</span>
                            <span x-show="open" class="text-sky-500 font-bold text-xl">-</span>
                        </button>
                        <div x-show="open" x-transition class="px-6 py-4 bg-white border-t border-sky-500 text-gray-700 text-base">
                            We are open Monday to Saturday. Closed on Sundays.
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div x-data="{ open: false }" class="border-2 p-2 border-red-500 rounded-xl shadow-md">
                        <button
                            @click="open = !open"
                            class="w-full px-6 py-4 text-left bg-red-50 hover:bg-red-100 flex justify-between items-center text-lg font-semibold transition-all duration-300 rounded-xl">
                            Where are we located?
                            <span x-show="!open" class="text-red-500 font-bold text-xl">+</span>
                            <span x-show="open" class="text-red-500 font-bold text-xl">-</span>
                        </button>
                        <div x-show="open" x-transition class="px-6 py-4 bg-white border-t border-red-500 text-gray-700 text-base">
                            We are located at 2nd Floor, CPD Building, Ilawod, Guinobatan, Albay
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div x-data="{ open: false }" class="border-2 p-2 border-sky-500 rounded-xl shadow-md">
                        <button
                            @click="open = !open"
                            class="w-full px-6 py-4 text-left bg-sky-50 hover:bg-sky-100 flex justify-between items-center text-lg font-semibold transition-all duration-300 rounded-xl">
                            What are our services?
                            <span x-show="!open" class="text-sky-500 font-bold text-xl">+</span>
                            <span x-show="open" class="text-sky-500 font-bold text-xl">-</span>
                        </button>
                        <div x-show="open" x-transition class="px-6 py-4 bg-white border-t border-sky-500 text-gray-700 text-base">
                            We provide general consultations, vaccinations, and specialized medical services.
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script src="//unpkg.com/alpinejs" defer></script>
    </div>
</x-app-layout>