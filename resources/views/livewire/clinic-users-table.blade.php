<div class="flex flex-col col-span-4 gap-2 relative">
    <div class="overflow-hidden">
        <div class="flex flex-row md:justify-between gap-2 p-2">
            <!-- per page dropdown -->
            <div class="flex ">
                <div class="flex gap-4 items-center">
                    <div
                        x-data="{ open: false, selected: @entangle('perPage') }"
                        class="w-16"
                        wire:ignore>
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
                            class="absolute w-16 mt-1 bg-white border border-gray-300 rounded-lg shadow-lg">
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

    @if (session('update-success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        class="w-full bg-green-100 border-2 rounded border-green-200 flex justify-between py-2 px-4 ">
        <h1 class="text-md font-bold text-green-600">{{ session('update-success') }}</h1>
        <button @click="show = false" class="text-lg font-bold text-green-600">
            <i data-lucide="x"></i>
        </button>
    </div>
    @endif
    <!-- table with overflow -->
    <div class="overflow-x-auto md:overflow-hidden ">
        <table class="w-full text-sm text-left text-gray-500  ">
            <thead class="text-md text-white  bg-gray-800 ">
                <tr class="px-4">
                    <th scope="col" class="md:px-2 px-4 py-4 text-center rounded-l-lg hover:cursor-pointer hover:text-gray-300" wire:click="setSortBy('id')">ID</th>
                    <th scope="col" class="md:px-2 px-20 py-4 text-center hover:cursor-pointer hover:text-gray-300" wire:click="setSortBy('account_id')">Account ID</th>
                    <th scope="col" class="md:px-2 px-4 py-4 text-center hover:cursor-pointer hover:text-gray-300" wire:click="setSortBy('role')">Role</th>
                    <th scope="col" class="md:px-2 px-4 py-4 text-center hover:cursor-pointer hover:text-gray-300" wire:click="setSortBy('last_name')">Last Name</th>
                    <th scope="col" class="md:px-2 px-4 py-4 text-center hover:cursor-pointer hover:text-gray-300" wire:click="setSortBy('first_name')">First Name</th>
                    <th scope="col" class="md:px-2 px-4 py-4 text-center hover:text-gray-300">M.I</th>
                    <th scope="col" class="md:px-2 px-4 py-4 text-center hidden md:table-cell hover:cursor-pointer hover:text-gray-300" wire:click="setSortBy('email')">Email </th>
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
                    <td class="md:px-2 px-4 py-4 text-center font-medium text-gray-900 hidden md:table-cell">{{ $clinic_user->info?->contact_number }}</td>
                    <td class="grid grid-cols-2 p-2 gap-2 md:gap-0">
                        <button
                            @click="$dispatch('show-profile-modal', { 
                                id: '{{ $clinic_user->id }}',
                                account_id: '{{ $clinic_user->account_id }}',
                                default_password: '{{ $clinic_user->default_password }}',
                                role: '{{ $clinic_user->UserRole->role_name }}',

                                first_name: '{{ $clinic_user->first_name }}',
                                last_name: '{{ $clinic_user->last_name }}',
                                middle_initial: '{{ $clinic_user->middle_initial }}',
                                suffix: '{{ $clinic_user->suffix ?? 'N/A' }}',
                                phone: '{{ $clinic_user->info?->contact_number }}',
                                email: '{{ $clinic_user->email }}',

                                date_of_birth: '{{ $clinic_user->info?->birthdate }}',
                                address: '{{ $clinic_user->info?->address }}',
                                gender: '{{ $clinic_user->info?->gender }}',
                                age: '{{ $clinic_user->info?->age }}'
                            })"
                            class="text-blue-500 flex items-center justify-center font-semibold col-span-2 md:col-span-1">
                            <img src="{{ asset('images/view.svg') }}" alt="Profile Details"  >
                        </button>

                        <button
                            data-update-profile
                            data-id="{{ $clinic_user->id }}"
                            @click="$dispatch('update-profile-modal', { 
                                id: '{{ $clinic_user->id }}',
                                account_id: '{{ $clinic_user->account_id }}',
                                default_password: '{{ $clinic_user->default_password }}',
                                role: '{{ $clinic_user->UserRole->role_name }}',

                                first_name: '{{ $clinic_user->first_name }}',
                                last_name: '{{ $clinic_user->last_name }}',
                                middle_initial: '{{ $clinic_user->middle_initial }}',
                                suffix: '{{ $clinic_user->suffix ?? '' }}',
                                phone: '{{ $clinic_user->info?->contact_number }}',
                                email: '{{ $clinic_user->email }}',

                                date_of_birth: '{{ $clinic_user->info?->birthdate }}',
                                address: '{{ $clinic_user->info?->address }}',
                                gender: '{{ $clinic_user->info?->gender }}',
                                age: '{{ $clinic_user->info?->age }}'
                            })"
                            class="text-red-500 flex items-center justify-center  font-semibold col-span-2 md:col-span-1">
                            <img src="{{ asset('images/square-pen.svg') }}" alt="Manage Transactions"> </button>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!-- View Clinic User Profile Modal -->
    <div x-data="{ open: false, user: {} }"
        x-on:show-profile-modal.window="user = $event.detail; open = true"
        x-show="open"
        class="fixed inset-0 z-50 flex items-center justify-center h-screen"
        style="display: none">
        <div class="absolute inset-0 bg-black/60" @click="open = false"></div>

        <div class="relative bg-white p-8 rounded-lg shadow-lg w-full max-w-5xl z-10   max-h-[90vh] overflow-y-auto">
            <div class=" w-full flex justify-end mb-2">
                <button @click="open = false">
                    <img src="{{ asset('images/x.svg') }}" alt="Cancel" class="w-6 h-6">
                </button>
            </div>
            <!-- content  -->
            <div class="grid grid-cols-12 md:px-8 gap-2 flex flex-col items-center justify-center">

                <div class="col-span-12 flex items-center justify-center">
                    <div class="flex items-center justify-center gap-4 ">
                        <img src="{{ asset('images/circle-user.svg') }}" alt="User Avatar" class="w-12 h-12 rounded-full ">
                        <div>
                            <h1 class="font-900 md:text-2xl text-xl text-sky-500">View User Profile</h1>
                            <p>View clinic user's account details</p>
                        </div>
                    </div>
                </div>
                <!-- divider border  -->
                <div class="col-span-12 border-2 border-gray-100 "></div>

                <div class="col-span-12">
                    <h1 class="font-semibold text-xl">Account Details</h1>
                </div>

                <div class="col-span-12 flex gap-2 items-center px-2">
                    <p class="text-sm font-semibold">Account ID:</p>
                    <h1 x-text="user.account_id"></h1>
                </div>
                <div class="col-span-12 flex gap-2 items-center px-2">
                    <p class="text-sm font-semibold">Role:</p>
                    <h1 x-text="user.role"></h1>
                </div>
                <!-- divider border  -->
                <div class="col-span-12 border-2 border-gray-100 my-2"></div>

                <div class="col-span-12">
                    <h1 class="font-semibold text-xl">Personal Information</h1>
                </div>

                <!-- fname. lname , initial div  -->
                <div class="col-span-12 grid grid-cols-12 gap-2">

                    <!-- FIRST NAME -->
                    <div class="col-span-12 md:col-span-5">
                        <p for="first_name" class="text-sm font-semibold">First Name:</p>
                        <h1 name="first_name" x-text="user.first_name"
                            class="w-full p-2 border border-gray-200 rounded-lg bg-gray-50 uppercase "></h1>
                    </div>

                    <!-- LAST NAME -->
                    <div class="col-span-12 md:col-span-5">
                        <p for="last_name" class="text-sm font-semibold">Last Name:</p>
                        <h1 name="last_name" x-text="user.last_name"
                            class="w-full p-2 border border-gray-200 rounded-lg bg-gray-50 uppercase "></h1>
                    </div>

                    <!-- MIDDLE INITIAL -->
                    <div class="col-span-6 md:col-span-1">
                        <p for="middle_initial" class="text-sm font-semibold">M.I:</p>
                        <h1 name="middle_initial" x-text="user.middle_initial"
                            class="w-full p-2 border border-gray-200 rounded-lg bg-gray-50 uppercase "></h1>
                    </div>

                    <!-- SUFFIX -->
                    <div class="col-span-6 md:col-span-1">
                        <p for="suffix" class="text-sm font-semibold">Suffix:</p>
                        <h1 name="suffix" x-text="user.suffix"
                            class="w-full p-2 border border-gray-200 rounded-lg bg-gray-50 uppercase "></h1>
                    </div>
                </div>

                <!-- date of birth, age , gender div  -->
                <div class="col-span-12 grid grid-cols-6 gap-4 mt-2">
                    <!-- date of birth  -->
                    <div class="col-span-6 md:col-span-2 flex flex-col gap-1">
                        <p for="date_of_birth" class="text-sm font-semibold">Date of Birth:</p>
                        <h1 name="date_of_birth" x-text="user.date_of_birth"
                            class="w-full p-2 border border-gray-200 rounded-lg bg-gray-50 uppercase "></h1>
                    </div>
                    <!-- age  -->
                    <div class="col-span-6 md:col-span-1 flex flex-col gap-1">
                        <p for="age" class=" text-sm font-bold text-gray-800">Age</p>
                        <h1 name="age" x-text="user.age"
                            class="w-full p-2 border border-gray-200 rounded-lg bg-gray-50 uppercase "></h1>
                    </div>
                    <!-- gender  -->
                    <div class="col-span-6 md:col-span-3 flex flex-col gap-1">
                        <p class="text-sm font-bold text-gray-800">Gender </p>
                        <h1 name="gender" x-text="user.gender"
                            class="w-full p-2 border border-gray-200 rounded-lg bg-gray-50 uppercase "></h1>
                    </div>
                </div>

                <!-- email div and contact number  -->
                <div class="col-span-12 grid grid-cols-4 gap-4 mt-2">
                    <!-- email  -->
                    <div class="col-span-4 md:col-span-2 flex flex-col items-center gap-2">
                        <div class="w-full flex items-center">
                            <p class="text-sm font-bold text-gray-800">Personal Email</p>
                        </div>
                        <div class="w-full flex items-center md:gap-4 gap-2">
                            <img src="{{ asset('images/mail.svg') }}" alt="Mail" >
                            <h1 x-text="user.email" class="w-full p-2 border border-gray-200 rounded-lg bg-gray-50  "></h1>
                        </div>
                    </div>

                    <!-- phone number  -->
                    <div class="col-span-4 md:col-span-2 flex flex-col items-center gap-2">
                        <div class="w-full flex items-center">
                            <p class="text-sm font-bold text-gray-800">Phone Number</p>
                        </div>
                        <div class="w-full flex items-center gap-4">
                            <img src="{{ asset('images/phone-call.svg') }}" alt="Phone Call" >
                            <h1 x-text="user.phone" class="w-full p-2 border border-gray-200 rounded-lg bg-gray-50  "></h1>
                        </div>
                    </div>
                </div>

                <!-- divider border  -->
                <div class="col-span-12 border-2 border-gray-100 "></div>

                <!-- address label  -->
                <div class="col-span-12  ">
                    <label for="address" class="text-xl font-bold text-gray-800">Address</label>
                </div>
                <div class="col-span-12 flex items-center gap-2 ">
                    <img src="{{ asset('images/map-pinned.svg') }}" alt="Map Pinned" >
                    <h1 x-text="user.address" class="w-full p-2 border border-gray-200 rounded-lg bg-gray-50 "></h1>
                </div>

                <div class="col-span-12 flex items-end justify-end">
                    <button type="button" @click="open = false"
                        class="px-6 py-2 bg-gray-800 text-white rounded-lg text-md">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- table pagination -->
    <div class=" px-3">
        {{ $clinic_users->appends(['perPage' => $perPage])->links() }}
    </div>


</div>