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
                    <td class="md:px-2 px-4 py-4 text-center font-medium text-gray-900 hidden md:table-cell">{{ $clinic_user->info?->contact_number }}</td>
                    <td class="md:px-2 px-4 py-4 text-center font-medium text-gray-900 flex items-center gap-2 justify-center">
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
                            class="text-blue-500 flex items-center justify-center gap-1 font-semibold">
                            <img src="{{ asset('images/view.svg') }}" alt="Profile Details">
                        </button>

                        <button
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
                            class="text-red-500 flex items-center justify-center gap-1 font-semibold">
                            <img src="{{asset('images/square-pen.svg')}}" alt="Manage Transactions"></button>
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
            <div class=" w-full flex justify-end mb-5 md:mb-2">
                <button @click="open = false">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <!-- content  -->
            <div class="grid grid-cols-12 md:px-8 gap-2 flex flex-col items-center justify-center">

                <div class="col-span-12 flex items-center justify-center">
                    <div class="flex items-center justify-center gap-4 ">
                        <i data-lucide="circle-user" class="w-12 h-12 text-sky-500"></i>
                        <div>
                            <h1 class="font-900 md:text-2xl text-xl text-sky-500">View User Profile</h1>
                            <p>View clinic user's account details</p>
                        </div>
                    </div>
                </div>
                <!-- divider border  -->
                <div class="col-span-12 border-2 border-gray-100 my-2"></div>

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
                        <div class="w-full flex items-center gap-4">
                            <i data-lucide="mail"></i>
                            <h1 x-text="user.email" class="w-full p-2 border border-gray-200 rounded-lg bg-gray-50  "></h1>
                        </div>
                    </div>

                    <!-- phone number  -->
                    <div class="col-span-4 md:col-span-2 flex flex-col items-center gap-2">
                        <div class="w-full flex items-center">
                            <p class="text-sm font-bold text-gray-800">Phone Number</p>
                        </div>
                        <div class="w-full flex items-center gap-4">
                            <i data-lucide="phone-call"></i>
                            <h1 x-text="user.phone" class="w-full p-2 border border-gray-200 rounded-lg bg-gray-50  "></h1>
                        </div>
                    </div>
                </div>

                <!-- divider border  -->
                <div class="col-span-12 border-2 border-gray-100 mt-5"></div>

                <!-- address label  -->
                <div class="col-span-12  ">
                    <label for="address" class="text-xl font-bold text-gray-800">Address</label>
                </div>
                <div class="col-span-12 flex items-center gap-2 p-2">
                    <i data-lucide="map-pinned"></i>
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

    <!-- Modal -->
    <div x-data="{ open: {{ session('update_errors') ? 'true' : 'false' }}, user: {} }"
        x-on:update-profile-modal.window="user = $event.detail; open = true"
        x-show="open"
        class="fixed inset-0 z-50 flex items-center justify-center h-screen"
        style="display: none">
        <div class="absolute inset-0 bg-black/60"></div>

        <div class="relative bg-white p-8 rounded-lg shadow-lg w-full max-w-5xl z-10 max-h-[90vh] overflow-y-auto bg-black/60">
            <div class="w-full flex justify-end mb-5 md:mb-2">
                <button @click="open = false">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form action="{{ route('clinic.users.update') }}" method="POST" id="updateProfileForm">
                @csrf
                @method('PUT')

                <input type="text" name="id" :value="user.id" hidden>

                <div class="grid grid-cols-12 md:px-8 gap-2 flex flex-col items-center justify-center ">

                    <div class="col-span-12 flex items-center justify-center">
                        <div class="flex items-center justify-center gap-4 ">
                            <i data-lucide="circle-user" class="w-12 h-12 text-red-500"></i>
                            <div>
                                <h1 class="font-900 md:text-2xl text-xl text-red-500">Update User Profile</h1>
                                <p>Manage your clinic account details</p>
                            </div>
                        </div>
                    </div>
                    <!-- divider border  -->
                    <div class="col-span-12 border-2 border-gray-100 my-2"></div>

                    <div class="col-span-12">
                        <h1 class="font-semibold text-xl">Account Details</h1>
                    </div>
                    <div class="col-span-12 flex gap-2 items-center px-2">
                        <p class="text-md font-bold">Account ID:</p>
                        <h1 x-text="user.account_id"></h1>
                    </div>
                    <div class="col-span-12 flex gap-2 items-center px-2">
                        <p class="text-md font-bold">Role:</p>
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
                            <label for="first_name" class="text-sm font-semibold">First Name:
                                <span class="text-red-500" id="update-first-name-error">
                                    @if (session('update_errors') && session('update_errors')->has('first_name'))
                                    {{ session('update_errors')->first('first_name') }}
                                    @endif
                                    *</span>
                            </label>
                            <input type="text"  name="update_first_name"
                                placeholder="First Name"
                                :value="user.first_name"
                                class="w-full p-2 border border-gray-300 rounded-lg bg-gray-100 focus:bg-white focus:outline-none focus:ring-1 focus:border-sky-300 uppercase">
                        </div>

                        <!-- LAST NAME -->
                        <div class="col-span-12 md:col-span-5">
                            <label for="last_name" class="text-sm font-semibold">Last Name:
                                <span class="text-red-500" id="update-last-name-error">
                                    @if (session('update_errors') && session('update_errors')->has('last_name'))
                                    {{ session('update_errors')->first('last_name') }}
                                    @endif
                                    *</span>
                            </label>
                            <input type="text"  name="update_last_name" placeholder="Last Name"
                                class="w-full p-2 border border-gray-300 rounded-lg  bg-gray-100 focus:bg-white  focus:outline-none focus:ring-1 focus:border-sky-300 uppercase "
                                :value="user.last_name">
                        </div>

                        <!-- MIDDLE INITIAL -->
                        <div class="col-span-6 md:col-span-1">
                            <label for="middle_initial" class="text-sm font-semibold">M.I
                                <span class="text-red-500" id="update-middle-initial-error">
                                    @if (session('update_errors') && session('update_errors')->has('middle_initial'))
                                    {{ session('update_errors')->first('middle_initial') }}
                                    @endif
                                    *</span>
                            </label>
                            <input type="text"  name="update_middle_initial" placeholder="M.I" maxlength="3"
                                pattern="[A-Z]\."
                                oninput="this.value = this.value.toUpperCase()"
                                title="Only one letter followed by a period is allowed (e.g., M.)"
                                :value="user.middle_initial"
                                class="w-full p-2 border border-gray-300 bg-gray-100 focus:bg-white  rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300 uppercase ">
                        </div>

                        <!-- SUFFIX -->
                        <div class="col-span-6 md:col-span-1">
                            <label for="suffix" class="text-sm font-semibold">Suffix: </label>
                            <input type="text" id="suffix" name="update_suffix" placeholder="E.g., Jr."
                                pattern="[A-Za-z]{1,5}"
                                maxlength="5"
                                title="Only letters are allowed, max 5 characters (e.g., Jr, Sr, III)"
                                :value="user.suffix"
                                class="w-full p-2 border border-gray-300 bg-gray-100 focus:bg-white  rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                        </div>
                    </div>


                    <!-- date of birth, age , gender div  -->
                    <div class="col-span-12 grid grid-cols-6 gap-4 mt-2">
                        <!-- date of birth  -->
                        <div class="col-span-6 md:col-span-2 flex flex-col gap-1">
                            <label for="date_of_birth" class=" text-sm font-bold text-gray-800">Date of Birth
                                <span class="text-red-500" id="date-of-birth-error">
                                    @if (session('update_errors') && session('update_errors')->has('date_of_birth'))
                                    {{ session('update_errors')->first('date_of_birth') }}
                                    @endif
                                    *</span>
                            </label>
                            <input type="date" name="update_date_of_birth" id="date_of_birth" :value="user.date_of_birth" readonly
                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                        </div>
                        <!-- age  -->
                        <div class="col-span-6 md:col-span-1 flex flex-col gap-1">
                            <label for="age" class=" text-sm font-bold text-gray-800">Age</label>
                            <input type="number" name="update_age" placeholder="Age" id="age" :value="user.age"
                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300" readonly>
                        </div>
                        <!-- gender  -->
                        <div class="col-span-6 md:col-span-3 flex flex-col gap-3">
                            <label class=" text-sm font-bold text-gray-800">Gender <span class="text-red-500" id="gender-error">*</span></label>
                            <div class="flex gap-5 items-center">

                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="update_gender" checked disabled class="text-sky-500 focus:ring-sky-500">
                                    <span x-text="user.gender"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- email div and contact number  -->
                    <div class="col-span-12 grid grid-cols-4 gap-4 mt-2">
                        <!-- email  -->
                        <div class="col-span-4 md:col-span-2 flex flex-col items-center gap-2">
                            <div class="w-full flex items-center">
                                <label for="email" class=" text-sm font-bold text-gray-800">Personal Email
                                    <span class="text-red-500" id="update-email-error">
                                        @if (session('update_errors') && session('update_errors')->has('email'))
                                        {{ session('update_errors')->first('email') }}
                                        @endif
                                        *</span>
                                </label>
                            </div>
                            <div class="w-full flex items-center gap-4">
                                <i data-lucide="mail"></i>
                                <input type="email" name="update_email" placeholder="example@gmail.com" :value="user.email" id="update-email"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                            </div>
                        </div>

                        <!-- phone number  -->
                        <div class="col-span-4 md:col-span-2 flex flex-col items-center gap-2">
                            <div class="w-full flex items-center">
                                <label for="contact_number" class=" text-sm font-bold text-gray-800"> Phone Number
                                    <span class="text-red-500" id="update-contact-number-error">
                                        @if (session('update_errors') && session('update_errors')->has('contact_number'))
                                        {{ session('update_errors')->first('contact_number') }}
                                        @endif
                                        *</span>
                                </label>
                            </div>
                            <div class="w-full flex items-center gap-4">
                                <i data-lucide="phone-call"></i>
                                <input type="tel" id="update-contact_number" name="update_contact_number"
                                    placeholder="e.g. 09xx xxx xxxx"
                                    maxlength="13"
                                    :value="user.phone"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                            </div>
                        </div>
                    </div>

                    <!-- divider border  -->
                    <div class="col-span-12 border-2 border-gray-100 mt-5"></div>

                    <!-- address label  -->
                    <div class="col-span-12 p-2 ">
                        <label for="address" class="text-xl font-bold text-gray-800">Address</label>
                    </div>

                    <div class="col-span-12 flex items-center gap-2 p-2">
                        <i data-lucide="map-pin"></i>
                        <h1 x-text="user.address"></h1>
                    </div>

                    <!-- divider border  -->
                    <div class="col-span-12 border-2 border-gray-100 mt-5"></div>

                    <div class="col-span-12 mt-2 p-2">
                        <p class="font-semibold">Update Address</p>
                    </div>

                    <!-- region, province, city, barangay, purok div  -->
                    <div class="col-span-12 grid grid-cols-12 gap-2">
                        <!-- region  -->
                        <div class="col-span-12 md:col-span-4">
                            <div class="mb-3 relative">
                                <label for="update-region_btn" class="text-sm mb-2 font-semibold">Region <span class="text-red-500" id="update-region-error">*</span></label>
                                <button id="update-region_btn" type="button"
                                    class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center">
                                    <span id="update-region_selected">Select Region</span>
                                    <i data-lucide="chevron-down"></i>
                                </button>
                                <ul id="update-region" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                <!-- hidden input -->
                                <input type="hidden" name="update_region" id="update_region_input">
                            </div>
                        </div>
                        <!-- province  -->
                        <div class="col-span-12 md:col-span-4">
                            <div class="mb-3 relative">
                                <label for="update-province_btn" class="text-sm mb-2 font-semibold">Province <span class="text-red-500" id="update-province-error">*</span></label>
                                <button id="update-province_btn" type="button"
                                    class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                    <span id="update-province_selected">Select Province</span>
                                    <i data-lucide="chevron-down"></i>
                                </button>
                                <ul id="update-province" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                <!-- hidden input -->
                                <input type="hidden" name="update_province" id="update_province_input">
                            </div>
                        </div>
                        <!-- city  -->
                        <div class="col-span-12 md:col-span-4">
                            <div class="mb-3 relative">
                                <label for="update-city_btn" class="text-sm mb-2 font-semibold">City / Municipality <span class="text-red-500" id="update-city-error">*</span></label>
                                <button id="update-city_btn" type="button"
                                    class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                    <span id="update-city_selected">Select City</span>
                                    <i data-lucide="chevron-down"></i>
                                </button>
                                <ul id="update-city" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                <!-- hidden input -->
                                <input type="hidden" name="update_city" id="update_city_input">
                            </div>
                        </div>
                        <!-- barangay and purok  -->
                        <div class="col-span-12 md:col-span-12">
                            <div class="grid grid-cols-4 gap-4">
                                <!-- barangay  -->
                                <div class="col-span-4 md:col-span-2 mb-3 relative">
                                    <label for="update-barangay_btn" class="text-sm mb-2 font-semibold">Barangay <span class="text-red-500" id="update-barangay-error">*</span></label>
                                    <button id="update-barangay_btn" type="button"
                                        class="w-full border rounded px-3 py-2 text-left bg-white flex justify-between items-center opacity-50 cursor-not-allowed">
                                        <span id="update-barangay_selected">Select Barangay</span>
                                        <i data-lucide="chevron-down"></i>
                                    </button>
                                    <ul id="update-barangay" class="absolute w-full border rounded bg-white mt-1 hidden max-h-60 overflow-y-auto z-10"></ul>
                                    <!-- hidden input -->
                                    <input type="hidden" name="update_barangay" id="update_barangay_input">
                                </div>
                                <!-- purok  --> 
                                <div class="col-span-4 md:col-span-2 ">
                                    <label for="update-description" class="text-sm mb-2 font-semibold">Purok / Bldng No. <span class="text-red-500" id="update-description-error">*</span></label>
                                    <input type="text" name="update_barangay" id="update-description" placeholder="e.g Purok-2" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:border-sky-300">
                                </div>
                            </div>
                        </div>

                        <!-- divider border  -->
                        <div class="col-span-12 border-2 border-gray-100"></div>
                    </div>

                    <!-- submit and cancel button   -->
                    <div class="col-span-12 flex items-end justify-end gap-2 mt-5">
                        <button type="submit" class="md:px-8 px-4 py-2 bg-sky-500 text-white rounded-lg text-md">
                            Save Changes
                        </button>
                        <button type="button" @click="open = false"
                            class="px-6 py-2 bg-gray-100 text-gray-500 rounded-lg text-md">
                            Cancel
                        </button>

                    </div>
                </div>
            </form>

        </div>

    </div>


    <!-- table pagination -->
    <div class=" px-3">
        {{ $clinic_users->appends(['perPage' => $perPage])->links() }}
    </div>
</div>