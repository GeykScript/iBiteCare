<div class="flex flex-col col-span-4 gap-2 relative pb-12">
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
    <div class="overflow-x-auto md:overflow-hidden">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
            <thead class="text-md text-white  bg-gray-800 ">
                <tr class="px-4">
                    <th scope="col" class="px-6 md:px-2 py-4 text-center rounded-l-lg hover:cursor-pointer" wire:click="setSortBy('id')">ID</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer">Name</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer" wire:click="setSortBy('schedule')">Scheduled Date</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer" wire:click="setSortBy('day_label')">Day</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center ">
                        Message Reminder
                    </th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer" wire:click="setSortBy('status')">Status</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center rounded-r-lg">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($messages->isEmpty())
                <tr class="table-row sm:hidden">
                    <td colspan="7" class="text-center py-4">No messages found.</td>
                </tr>
                <tr class="hidden sm:table-row">
                    <td colspan="7" class="text-center py-4">No messages found.</td>
                </tr>
                @else
                @foreach ($messages as $message)
                <tr wire:key="{{ $message->id }}" class="border-b dark:border-gray-700">
                    <td class="px-6 md:px-2 py-3 text-center font-medium text-gray-900 ">{{ $message->id }}</td>
                    <td class="px-6 md:px-2 py-3 text-center font-medium text-gray-900 ">{{ $message->patient->last_name }} {{ $message->patient->first_name }}</td>
                    <th class="px-6 md:px-2 py-3 text-center font-medium text-gray-900"> {{ $message->schedule }}</th>
                    <td class="px-6 md:px-2 py-3 text-center font-medium text-gray-900">{{ $message->day_label }}</td>
                    <td class="px-6 md:px-2 py-3 text-center font-medium text-gray-900 w-80">
                        <div class="flex justify-start">
                            {{ $message->display_message }}
                        </div>
                    </td>

                    <td class="px-6 md:px-2 py-3 text-center font-medium text-gray-900 ">
                        @if ($message->status == 'Sent')
                        <span class="text-green-500 font-bold p-2 px-5 rounded bg-green-200">{{ $message->status }}</span>
                        @elseif ($message->status == 'Pending')
                        <span class="text-orange-400 font-bold p-2 rounded bg-orange-100">{{ $message->status }}</span>
                        @endif
                    </td>
                    <td class="px-6 md:px-2 py-3 text-center font-medium text-gray-900 ">Send </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <!-- table pagination -->
    <div class=" px-3 mt-5">
        {{ $messages->appends(['perPage' => $perPage])->links() }}

    </div>
</div>