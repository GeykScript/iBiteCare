<div class="flex flex-col col-span-4 gap-2">
    <div class="relative  overflow-hidden">
        <div class="flex flex-row md:justify-between gap-2 p-2">
            <!-- per page -->
            <div class="flex ">
                <div class="flex gap-4 items-center ">
                    <select
                        wire:model.live="perPage"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-16 p-2.5 ">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                    <label class="text-sm font-medium text-gray-900 md:block hidden">entries per page</label>
                </div>
            </div>
            <!-- search bar -->
            <div class="flex  w-full md:w-1/4">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center p-3 pointer-events-none">
                        <img src="{{ asset('images/search.svg') }}" alt="Search Icon" class="w-5 h-5 " />
                    </div>
                    <input
                        wire:model.live.debounce.300ms="search"
                        type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full h-full pl-12 p-2 "
                        placeholder="Search" required="">
                </div>
            </div>
        </div>
    </div>
    <!-- table with overflow -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-md text-white  bg-gray-800 ">
                <tr class="px-4">
                    <th scope="col" class="px-4 py-3 rounded-l-lg hover:cursor-pointer" wire:click="setSortBy('id')">ID</th>
                    <th scope="col" class="px-4 py-3 hover:cursor-pointer" wire:click="setSortBy('first_name')">First Name</th>
                    <th scope="col" class="px-4 py-3 hover:cursor-pointer" wire:click="setSortBy('last_name')">Last Name</th>
                    <th scope="col" class="hidden md:block px-4 py-3 hover:cursor-pointer" wire:click="setSortBy('birthdate')">Birthdate</th>
                    <th scope="col" class="px-4 py-3 hover:cursor-pointer" wire:click="setSortBy('age')">Age</th>
                    <th scope="col" class="px-4 py-3 hover:cursor-pointer" wire:click="toggleGenderFilter">
                        Sex
                        @if($gender)
                        ({{ $gender }})
                        @endif
                    </th>
                    <th scope="col" class="px-4 py-3">Contact#</th>
                    <th scope="col" class="px-4 py-3 hover:cursor-pointer" wire:click="setSortBy('address')">Address</th>
                    <th scope="col" class="px-4 py-3 hover:cursor-pointer" wire:click="setSortBy('registration_date')">Registration Date</th>
                    <th scope="col" class="px-4 py-3">Profile</th>
                    <th scope="col" class="px-4 py-3 rounded-r-lg">Transactions</th>
                </tr>
            </thead>
            <tbody>
                @if($patients->isEmpty())
                <tr>
                    <td colspan="11" class="text-center py-8">No Patient Records found.</td>
                </tr>
                @else
                @foreach ($patients as $patient)
                <tr wire:key="{{ $patient->id }}" class="border-b dark:border-gray-700">
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $patient->id }}</td>
                    <th
                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                        {{ $patient->first_name }}
                    </th>
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $patient->last_name }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900 hidden md:block">{{ $patient->birthdate }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $patient->age }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $patient->sex }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $patient->contact_number }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $patient->address }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $patient->registration_date }}</td>
                    <td class="px-4 py-3  ">
                        <a href="#" class="text-blue-500 flex items-center  justify-center gap-1 font-semibold">
                            Details <img src="{{asset('images/file-text.svg')}}" alt="Profile Details"></a>
                    </td>
                    <td class="px-4 py-3">
                        <a href="#" class="text-red-500 flex items-center justify-center gap-1 font-semibold">
                            Manage <img src="{{asset('images/align-justify.svg')}}" alt="Manage Transactions"></a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <!-- table pagination -->
    <div class=" px-3">
        {{ $patients->appends(['perPage' => $perPage])->links() }}

    </div>
</div>