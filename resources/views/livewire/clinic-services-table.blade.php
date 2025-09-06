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

    @if (session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        class="w-full bg-green-100 border-2 rounded border-green-200 flex justify-between py-2 px-4 ">
        <h1 class="text-md font-bold text-green-600">{{ session('success') }}</h1>
        <button @click="show = false" class="text-lg font-bold text-green-600">
            <i data-lucide="x"></i>
        </button>
    </div>
    @endif
    <div class="overflow-x-auto md:overflow-hidden">
        <table class="min-w-full  text-sm mt-2 ">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border-r border-b bg-gray-800 text-white px-2 py-3 hover:cursor-pointer rounded-tl-lg" wire:click="setSortBy('id')">ID</th>
                    <th class="border bg-gray-800 text-white px-2 py-3 hover:cursor-pointer" wire:click="setSortBy('name')">Service Name</th>
                    <th class="border bg-gray-800 text-white px-2 py-3 hover:cursor-pointer">Description</th>
                    <th class="border bg-gray-800 text-white px-2 py-3 hover:cursor-pointer">Service Fee</th>
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
                    <td class="border-b px-2 py-2 text-gray-700 text-center"><span class="flex items-center justify-center"><i data-lucide="philippine-peso" class="w-4 h-4 text-gray-700"></i> {{ $service->service_fee }}</span></td>
                    <td class="border-b px-2 py-2 text-gray-700 text-center">
                        @forelse ($service->schedules as $schedule)
                        <div>
                            {{ $schedule->day_offset }} - {{ $schedule->label }}
                        </div>
                        @empty
                        <span class="text-gray-400">No Schedule</span>
                        @endforelse
                    </td>
                    <td class="border-b px-2 py-2 text-gray-700 text-center">
                        <div class="flex items-center justify-center">
                            <a href="{{ route('clinic.services.update', $service->id) }}"
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