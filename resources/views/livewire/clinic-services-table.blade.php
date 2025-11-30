<div>
    <div>
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
            </div>

            <!-- search bar -->
            <div class="flex  w-full l:w-1/4">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center px-2 py-4 pointer-events-none">
                        <img src="{{ asset('images/search.svg') }}" alt="Search Icon" class="w-5 h-5 " />
                    </div>
                    <input
                        wire:model.live.debounce.300ms="search"
                        type="text"
                        name="search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full h-full pl-12 p-2 "
                        placeholder="Search" required="">
                </div>
            </div>
        </div>
    </div>


    @if(session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 md:z-50">
        <div class="bg-white rounded-xl shadow-lg w-11/12 max-w-md p-6 flex flex-col items-center gap-4" @click.outside="show = false">
            <div class="p-2 rounded-full border-green-100 border-2 bg-green-100">
                <div class="p-2 rounded-full border-green-300 border-2 bg-green-300">
                    <div class="p-4 rounded-full bg-green-500">
                        <i data-lucide="check" class="text-white w-14 h-14 "></i>
                    </div>
                </div>
            </div>
            <h2 class="text-xl font-bold text-gray-700">{{ session('success') }}</h2>
            <div class="flex justify-end items-end w-full">
                <button
                    @click="show = false"
                    class="mt-4 text-white text-sm bg-gray-700 font-semibold py-2 px-4 rounded-lg">
                    Close
                </button>
            </div>
        </div>
    </div>
    @endif


    <div class="overflow-x-auto md:overflow-hidden">
        <table class="min-w-full  text-sm mt-2 ">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border-r border-b bg-gray-800 text-white px-2 py-3 hover:cursor-pointer rounded-tl-lg" wire:click="setSortBy('id')">ID</th>
                    <th class="border bg-gray-800 text-white px-2 py-3 hover:cursor-pointer" wire:click="setSortBy('name')">Service Name</th>
                    <th class="border bg-gray-800 text-white px-2 py-3 hover:cursor-pointer">Description</th>
                    <th class="border bg-gray-800 text-white px-2 py-3 hover:cursor-pointer">Amount</th>
                    <th class="border bg-gray-800 text-white px-2 py-3 hover:cursor-pointer">Discount</th>
                    <th class="border bg-gray-800 text-white px-2 py-3 hover:cursor-pointer">Net Amount</th>
                    <th class="border bg-gray-800 text-white px-2 py-3 hover:cursor-pointer">Schedules</th>
                    <th class="px-2 py-3 border bg-gray-800 text-white rounded-tr-lg hover:cursor-pointer">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($services->isEmpty())
                <tr class="table-row sm:hidden">
                    <td colspan="4" class="text-center py-4">No Supply Records found.</td>
                </tr>
                <tr class="hidden sm:table-row">
                    <td colspan="13" class="text-center py-4">No Supply Records found.</td>
                </tr>
                @else
                @foreach($services as $service)
                <tr>
                    <td class="border-b px-2 py-2 text-gray-700 text-center">{{ $service->id }}</td>
                    <td class="border-b px-2 py-2 text-gray-700 text-center">{{ $service->name }} </td>
                    <td class="border-b px-2 py-2 text-gray-700">{{ $service->description }} </td>
                    <td class="border-b px-2 py-2 text-gray-700 text-center"><span class="flex items-center justify-center"><i data-lucide="philippine-peso" class="w-4 h-4 text-gray-700"></i> {{ number_format($service->service_fee, 2) }}</span></td>
                    <td class="border-b px-2 py-2 text-gray-700 text-center"><span class="flex items-center justify-center"> {{ number_format($service->discount) }}%</span></td>
                    <td class="border-b px-2 py-2 text-gray-700 text-center"><span class="flex items-center justify-center"><i data-lucide="philippine-peso" class="w-4 h-4 text-gray-700"></i> {{ number_format($service->discounted_service_fee, 2) }}</span></td>
                    <td class="border-b px-2 py-2 text-gray-700 text-center">
                        @forelse ($service->schedules as $schedule)
                        <div class="flex items-start justify-start">
                            Day - {{ $schedule->day_offset }}
                        </div>
                        @empty
                        <span class="text-gray-400">No Schedule</span>
                        @endforelse
                    </td>
                    <td class="border-b px-2 py-2 text-gray-700 text-center">
                        <div class="flex items-center justify-center">
                            <a href="{{ route('clinic.services.update', Crypt::encrypt($service->id)) }}"
                                class="text-red-500 flex items-center justify-center  font-semibold col-span-2 md:col-span-1 ">
                                <img src="{{ asset('images/square-pen.svg') }}" alt="Manage Transactions"> </a>
                        </div>
                    </td>

                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!-- table pagination -->
    <div class="px-3 mt-5">
        {{ $services->appends(['perPage' => $perPage])->links() }}
    </div>
</div>