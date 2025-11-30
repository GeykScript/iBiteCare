<div class="flex flex-col col-span-4 gap-2 relative pb-12">
    <div class="overflow-hidden">
        <div class="grid grid-cols-12 gap-6 p-2 ">
            <!-- per page dropdown -->
            <div class="col-span-12 l:col-span-9 flex items-center justify-between  gap-4">
                <div class="flex gap-4 items-center">
                    <div
                        x-data="{ open: false, selected: @entangle('perPage') }"
                        class=" w-16 ">
                        <!-- Dropdown button -->
                        <button
                            @click="open = !open"
                            type="button"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                    focus:ring-gray-500 focus:border-gray-800 block w-full p-2.5 
                                    flex justify-between items-center">
                            <span x-text="selected"></span>
                            <img src="{{ asset('images/chevron-down.svg') }}" alt="chevron-down" class="w-4 h-4">
                        </button>
                        <!-- Dropdown menu -->
                        <ul
                            x-show="open"
                            @click.outside="open = false"
                            x-cloak
                            class="absolute w-16 mt-1  bg-white border border-gray-300 rounded-lg shadow-lg">
                            @foreach ([5, 10, 20, 50, 100] as $value)
                            <li
                                @click="selected = {{ $value }}; $wire.set('perPage', {{ $value }}); open = false"
                                class="cursor-pointer px-4 py-2 text-sm text-gray-700 hover:bg-gray-800 hover:text-white transition"
                                :class="{ 'bg-gray-800 text-white': selected == {{ $value }} }">
                                {{ $value }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Label -->
                    <p class="text-sm font-medium text-gray-900 md:block hidden">
                        entries per page
                    </p>
                </div>
                <div class="l:col-span-4 col-span-12 grid grid-cols-7 gap-2 h-full">
                    <!-- Date Filter Section -->
                    <div class="col-span-7 flex flex-wrap items-center justify-start l:justify-center  gap-2 px-2 ">
                        <span class="text-sm font-medium text-gray-700">Date:</span>

                        <input
                            wire:model.live="dateFrom"
                            type="date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-sky-500 focus:border-sky-500 px-2 py-1.5 w-auto">

                        <span class="text-xs text-gray-500">to</span>

                        <input
                            wire:model.live="dateTo"
                            type="date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-sky-500 focus:border-sky-500 px-2 py-1.5 w-auto">

                        @if($dateFrom || $dateTo)
                        <button
                            wire:click="clearDateFilter"
                            class="px-2 py-1 text-sm font-medium text-white bg-sky-500 hover:bg-sky-400 rounded-md transition">
                            Clear
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-span-12 l:col-span-3 grid grid-cols-7 gap-2 ">
                <div class="col-span-7 flex items-center ">
                    <div class="w-full">
                        <div class="flex items-center bg-gray-50 border border-gray-300 rounded-lg px-3 focus-within:ring-1 focus-within:ring-sky-500 focus-within:border-sky-500 transition">
                            <img src="{{ asset('images/search.svg') }}" alt="Search Icon" class="w-5 h-5 text-gray-500" />
                            <input
                                wire:model.live.debounce.300ms="search"
                                type="text"
                                name="search"
                                class="flex-1 bg-transparent border-none focus:outline-none focus:ring-0 text-sm text-gray-900"
                                placeholder="Search"
                                required />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- table with overflow -->
    <div class="overflow-x-auto md:overflow-hidden">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
            <thead class="text-md text-white  bg-gray-800 ">
                <tr class="px-4">
                    <th scope="col" class="px-6 md:px-2 py-4 text-center rounded-l-lg hover:cursor-pointer" wire:click="setSortBy('id')">ID</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer" wire:click="setSortBy('last_name')">Last Name</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer" wire:click="setSortBy('first_name')">First Name</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center ">M.I</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer hidden md:table-cell" wire:click="setSortBy('birthdate')">Birthdate</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer hidden md:table-cell" wire:click="setSortBy('age')">Age</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer hidden md:table-cell" wire:click="toggleGenderFilter">
                        Sex
                        @if($gender)
                        ({{ $gender }})
                        @endif
                    </th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hidden md:table-cell">Contact#</th>
                    <th scope="col" colspan="2" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer hidden md:table-cell" wire:click="setSortBy('address')">Address</th>
                    <!-- <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer hidden md:table-cell" wire:click="setSortBy('registration_date')">Registration Date</th> -->
                    <th scope="col" class="px-6 md:px-2 py-4 text-center">Profile</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center rounded-r-lg">Transactions</th>
                </tr>
            </thead>
            <tbody>
                @if($patients->isEmpty())
                <tr class="table-row sm:hidden">
                    <td colspan="5" class="text-center py-4">No Patient Records found.</td>
                </tr>
                <tr class="hidden sm:table-row">
                    <td colspan="13" class="text-center py-4">No Patient Records found.</td>
                </tr>
                @else
                @foreach ($patients as $patient)
                <tr wire:key="{{ $patient->id }}" class="border-b dark:border-gray-700">
                    <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900">{{ $patient->id }}</td>
                    <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900">{{ $patient->last_name }}</td>
                    <th class="px-6 md:px-2 py-4 text-center font-medium text-gray-900 whitespace-nowrap"> {{ $patient->first_name }}</th>
                    <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900">{{ $patient->middle_initial }}</td>
                    <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900 hidden md:table-cell">
                        {{ \Carbon\Carbon::parse($patient->birthdate)->format('M, d, Y') }}
                    </td>
                    <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900 hidden md:table-cell">{{ $patient->age }}</td>
                    <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900 hidden md:table-cell">
                        @if ($patient->sex == 'Male')
                        <span class="text-blue-500 font-bold">Male</span>
                        @else
                        <span class="text-pink-500 font-bold">Female</span>
                        @endif
                    </td>
                    <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900 hidden md:table-cell">{{ $patient->contact_number }}</td>
                    <td colspan="2" class="text-center md:text-start md:px-8 font-medium text-gray-900 hidden md:table-cell ">{{ $patient->address }}</td>
                    <!-- <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900 hidden md:table-cell">{{ $patient->registration_date }}</td> -->
                    <td class="px-6 md:px-2 py-4 text-center font-medium text-gray-900 ">
                        <a href="{{ route('clinic.patients.profile', Crypt::encrypt($patient->id)) }}" class="text-blue-500 flex items-center  justify-center gap-1 font-semibold hover:underline underline-offset-4">
                            View <img src="{{asset('images/file-text.svg')}}" alt="Profile Details"></a>
                    </td>
                    <td class="px-2 py-4 text-center font-medium text-gray-900">
                        <a href="{{ route('clinic.patients.transactions', Crypt::encrypt($patient->id)) }}" class="text-red-500 hover:underline underline-offset-4 flex items-center justify-center gap-1 font-semibold">
                            Manage <img src="{{asset('images/align-justify.svg')}}" alt="Manage Transactions"></a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <!-- table pagination -->
    <div class=" px-3 mt-5">
        {{ $patients->appends(['perPage' => $perPage])->links() }}

    </div>
</div>