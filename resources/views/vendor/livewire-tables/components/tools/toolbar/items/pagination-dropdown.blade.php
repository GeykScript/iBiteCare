@aware([ 'tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5', 'localisationPath'])

<div
    x-data="{ open: false, selected: @entangle('perPage') }"
    @class([ 'ml-0 ml-md-2'=> $isBootstrap4,
    'ms-0 ms-md-2' => $isBootstrap5,
    'relative w-32' => true
    ])
    >
    <!-- Button -->
    <button
        @click="open = !open"
        type="button"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
               focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 
               flex justify-between items-center">
        <span x-text="selected === -1 ? '{{ __($localisationPath . 'All') }}' : selected"></span>
        <img src="{{ asset('images/chevron-down.svg') }}" alt="chevron-down" class="w-4 h-4">
    </button>

    <!-- Dropdown -->
    <ul
        x-show="open"
        @click.outside="open = false"
        class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg">
        @foreach ($this->getPerPageAccepted() as $item)
        <li
            @click="selected = {{ $item }}; $wire.set('perPage', {{ $item }}); open = false"
            class="cursor-pointer px-4 py-2 text-sm text-gray-700 hover:bg-sky-500 hover:text-white transition"
            :class="{ 'bg-sky-500 text-white': selected == {{ $item }} }">
            {{ $item === -1 ? __($localisationPath.'All') : $item }}
        </li>
        @endforeach
    </ul>
</div>