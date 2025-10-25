<div class="flex flex-col col-span-4 gap-2 relative pb-12">
    <div class="overflow-hidden">
        <div class="grid grid-cols-12 gap-2 p-2 ">
            <!-- per page dropdown -->
            <div class="col-span-12 md:col-span-5 flex ">
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

            <div class="col-span-12 md:col-span-7 flex justify-end ">

                <div class="grid grid-cols-7 gap-4">
                    <!-- filter  -->
                    <div class="col-span-7 md:col-span-4 flex gap-2 items-center ">
                        <h1 class="font-bold">Filter:</h1>
                        <button
                            wire:click="$set('filter', 'today')"
                            class="px-4 py-2 rounded-lg text-sm font-semibold  focus:outline-none
                            {{ $filter === 'today' ? 'bg-sky-500 text-white' : 'bg-white border border-gray-800 text-gray-800 hover:border-sky-500 hover:text-sky-500' }}">
                            Scheduled for Today
                        </button>

                        <button
                            wire:click="$set('filter', 'sent')"
                            class="px-4 py-2 rounded-lg text-sm font-semibold focus:outline-none
                            {{ $filter === 'sent' ? 'bg-sky-500 text-white' : 'bg-white border border-gray-800 text-gray-800 hover:border-sky-500 hover:text-sky-500' }}">
                            Sent Messages
                        </button>
                    </div>
                    <!-- search bar -->
                    <div class="col-span-7 md:col-span-3 flex ">
                        <div class="w-full">
                            <div class="flex items-center  bg-gray-50 border border-gray-300 rounded-lg px-3  focus-within:ring-2 focus-within:ring-sky-500">
                                <img src="{{ asset('images/search.svg') }}" alt="Search Icon" class="w-5 h-5 text-gray-500" />
                                <input
                                    wire:model.live.debounce.300ms="search"
                                    type="text"
                                    class="flex-1 bg-transparent border-none focus:outline-none focus:ring-0  text-sm text-gray-900"
                                    placeholder="Search"
                                    required />
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

    @if (session('sent-success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        class="w-full bg-green-100 border-2 rounded border-green-200 flex justify-between py-2 px-4 ">
        <h1 class="text-md font-bold text-green-600">{{ session('sent-success') }}</h1>
        <button @click="show = false" class="text-lg font-bold text-green-600">
            <i data-lucide="x"></i>
        </button>
    </div>
    @endif
    <!-- table with overflow -->
    <div class="overflow-x-auto md:overflow-hidden">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
            <thead class="text-md text-white  bg-gray-800 ">
                <tr class="px-4">
                    <th scope="col" class="px-6 md:px-2 py-4 text-center rounded-l-lg hover:cursor-pointer" wire:click="setSortBy('id')">ID</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer" wire:click="setSortBy('name')">Name</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center ">Contact Number</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer" wire:click="setSortBy('schedule')">Scheduled Date</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer" wire:click="setSortBy('day_label')">Day</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center ">
                        Message Reminder
                    </th>
                    @if ($filter === 'sent')
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer rounded-r-lg" wire:click="setSortBy('status')">Status</th>
                    @else
                    <th scope="col" class="px-6 md:px-2 py-4 text-center hover:cursor-pointer " wire:click="setSortBy('status')">Status</th>
                    <th scope="col" class="px-6 md:px-2 py-4 text-center rounded-r-lg">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if($messages->isEmpty() && $filter === 'sent')
                <tr class="table-row sm:hidden">
                    <td colspan="8" class="text-center py-4">No messages sent.</td>
                </tr>
                <tr class="hidden sm:table-row">
                    <td colspan="8" class="text-center py-4"> No messages sent.</td>
                </tr>
                @else
                @if($messages->isEmpty() && $filter === 'today')
                <tr class="table-row sm:hidden">
                    <td colspan="8" class="text-center py-4">No messages scheduled for today.</td>
                </tr>
                <tr class="hidden sm:table-row">
                    <td colspan="8" class="text-center py-4"> No messages scheduled for today.</td>
                </tr>
                @endif

                @foreach ($messages as $message)
                <tr wire:key="{{ $message->id }}" class="border-b dark:border-gray-700">
                    <td class="px-6 md:px-2 py-3 text-center font-medium text-gray-900 ">{{ $message->id }}</td>
                    <td class="px-6 md:px-2 py-3 text-center font-medium text-gray-900 ">{{ $message->patient->first_name }} {{ $message->patient->last_name }}</td>
                    <th class="px-6 md:px-2 py-3 text-center font-medium text-gray-900"> {{ $message->patient->contact_number }}</th>
                    <th class="px-6 md:px-2 py-3 text-center font-medium text-gray-900"> {{ $message->schedule ?? 'N/A' }}</th>
                    <td class="px-6 md:px-2 py-3 text-center font-medium text-gray-900">{{ $message->day_label ?? 'N/A' }}</td>
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
                    @if ($message->status == 'Pending')
                    <td class="px-6 md:px-2 py-3 text-center font-medium text-gray-900 " x-data="{ open: false, messageId: null, messageContent: '', patientName: '', patientContact: '', displayContact: '' }">
                        <button
                            @click="$dispatch('send-message-modal', {
                                id: {{ $message->id }}, 
                                content: `{{ addslashes($message->message_text) }}`,
                                patientName: `{{ addslashes($message->patient->first_name . ' ' . $message->patient->last_name) }}`,
                                displayContact: `{{ $message->patient->contact_number }}`,
                                patientContact: `{{ str_replace(' ', '', $message->patient->contact_number) }}`,
                             })"
                            class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg  focus:outline-none">
                            Send
                        </button>
                    </td>
                    @else
                    @if ($filter !== 'sent')
                    <td class="px-6 md:px-2 py-3 text-center font-medium text-gray-900 ">--</td>
                    @endif
                    @endif


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

    <!-- SEND MESSAGE Dialog -->
    <dialog
        id="sendMessageModal"
        x-data="{
                messageId: null,
                messageContent: null,
                patientName: null,
                patientContact: null,
                displayContact: null,
                open() { this.$refs.modal.showModal() },
                close() { this.$refs.modal.close() }
                }"
        x-ref="modal"
        @send-message-modal.window="messageId = $event.detail.id; messageContent = $event.detail.content; patientName = $event.detail.patientName; patientContact = $event.detail.patientContact; displayContact = $event.detail.displayContact; open()"
        class="p-8 rounded-lg shadow-lg w-full max-w-2xl backdrop:bg-black/30 focus:outline-none">
        <div class="w-full flex justify-end mb-2">
            <button @click="close()" class="focus:outline-none">
                <img src="{{ asset('images/x.svg') }}" alt="Cancel" class="w-6 h-6">
            </button>
        </div>

        <div class="flex flex-col">
            <div class="flex items-center gap-4 mb-4">
                <img src="{{asset('drcare_logo.png')}}" alt="Dr-Care Logo" class="w-16 h-16">
                <div class="flex flex-col">
                    <h2 class="text-xl font-bold ">Send SMS message</h2>
                    <div class="text-gray-600">To: <span class="font-semibold" x-text="patientName"></span> (<span x-text="displayContact"></span>)</div>
                </div>
            </div>
            <form action="{{ route('clinic.messages.single.send') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <input type="number" :value="messageId" name="message_id" hidden>
                <input type="number" :value="patientContact" name="contact_number" hidden>
                <div class="flex flex-col">
                    <label for="message" class="mb-2 text-sm font-medium text-gray-900">Message Content</label>
                    <textarea id="message" name="message" :value="messageContent" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 h-32"></textarea>
                </div>
                <div class="flex justify-end items-center mt-4 gap-2">
                    <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-2 rounded-lg">Send</button>
                    <button type="button"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-600 rounded-lg"
                        @click="close()">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </dialog>
</div>