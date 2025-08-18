<div class="flex flex-col col-span-4 gap-2 relative">
    <div class="overflow-hidden">
        <div class="flex flex-row md:justify-between gap-2 p-2">
            <!-- per page dropdown -->
            <div class="flex ">
                <div class="flex gap-4 items-center">
                    <div
                        x-data="{ open: false, selected: @entangle('perPage') }"
                        class=" w-16">
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
                    <label class="text-sm font-medium text-gray-900 md:block hidden">
                        entries per page
                    </label>
                </div>
            </div>

            <!-- search bar -->
            <div class="flex  w-full md:w-1/4">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center px-2 py-4 pointer-events-none">
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
    <div class="overflow-x-auto md:overflow-hidden ">
        <table class="w-full text-sm text-left text-gray-500  ">
            <thead class="text-md text-white  bg-gray-800 ">
                <tr class="px-4">
                    <th scope="col" class="md:px-2 px-4 py-4 text-center rounded-l-lg hover:cursor-pointer" wire:click="setSortBy('id')">ID</th>
                    <th scope="col" class="md:px-2 px-20 py-4 text-center hover:cursor-pointer" wire:click="setSortBy('account_id')">Account ID</th>
                    <th scope="col" class="md:px-2 px-4 py-4 text-center hover:cursor-pointer" wire:click="setSortBy('role')">Role</th>
                    <th scope="col" class="md:px-2 px-4 py-4 text-center hover:cursor-pointer" wire:click="setSortBy('last_name')">Last Name</th>
                    <th scope="col" class="md:px-2 px-4 py-4 text-center hover:cursor-pointer" wire:click="setSortBy('first_name')">First Name</th>
                    <th scope="col" class="md:px-2 px-4 py-4 text-center">M.I</th>
                    <th scope="col" class="md:px-2 px-4 py-4 text-center hidden md:table-cell hover:cursor-pointer" wire:click="setSortBy('email')">Email </th>
                    <th scope="col" class="md:px-2 px-4 py-4 text-center hidden md:table-cell ">Contact No.</th>
                    <th scope="col" class="md:px-2 px-4 py-4 text-center rounded-r-lg">Profile</th>
                </tr>
            </thead>
            <tbody>
                @if($clinic_users->isEmpty())
                <tr class="table-row sm:hidden">
                    <td colspan="5" class="text-center py-4">No User Records found.</td>
                </tr>
                <tr class="hidden sm:table-row">
                    <td colspan="13" class="text-center py-4">No User Records found.</td>
                </tr>
                @else
                @foreach ($clinic_users as $clinic_user)
                <tr wire:key="{{ $clinic_user->id }}" class="border-b dark:border-gray-700">
                    <td class="md:px-2 px-4 py-4 text-center font-medium text-gray-900">{{ $clinic_user->id }}</td>
                    <td class="md:px-2 px-0 py-4 text-center font-medium text-gray-900">{{ $clinic_user->account_id }}</td>
                    <td class="md:px-2 px-4 py-4 text-center font-medium text-gray-900">{{ $clinic_user->UserRole->role_name }}</td>
                    <td class="md:px-2 px-4 py-4 text-center font-medium text-gray-900">{{ $clinic_user->last_name }}</td>
                    <th class="md:px-2 px-4 py-4 text-center font-medium text-gray-900 whitespace-nowrap"> {{ $clinic_user->first_name }}</th>
                    <td class="md:px-2 px-4 py-4 text-center font-medium text-gray-900">{{ $clinic_user->middle_initial }}</td>
                    <td class="md:px-2 px-4 py-4 text-center font-medium text-gray-900 hidden md:table-cell">{{ $clinic_user->email }}</td>
                    <td class="md:px-2 px-4 py-4 text-center font-medium text-gray-900 hidden md:table-cell">{{ $clinic_user->info->contact_number }}</td>
                    <td class="md:px-2 px-4 py-4 text-center font-medium text-gray-900 flex items-center gap-2 justify-center">
                        <a href="#" class="text-blue-500 flex md:flex-col items-center  justify-center gap-1 font-semibold">
                            <img src="{{asset('images/view.svg')}}" alt="Profile Details"></a>
                        <a href="#" class="text-red-500 flex items-center justify-center gap-1 font-semibold">
                            <img src="{{asset('images/square-pen.svg')}}" alt="Manage Transactions"></a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <!-- table pagination -->
    <div class=" px-3">
        {{ $clinic_users->appends(['perPage' => $perPage])->links() }}

    </div>
</div>