@props([
'name',
'options' => [],
'placeholder' => 'Select an option',
])

<div x-data="{ open: false, selected: '' }" class="relative w-full  ">
    <!-- Hidden input for form submission -->
    <input type="hidden" name="{{ $name }}" :value="selected">

    <!-- Trigger -->
    <div
        @click="open = !open"
        class="flex justify-between items-center cursor-pointer rounded-lg border border-gray-300 bg-white px-3 py-2  text-md shadow-sm focus:border-sky-400 focus:ring focus:ring-sky-200">
        <span x-text="selected ? selected : '{{ $placeholder }}'" class="text-gray-700"></span>
        <i class="w-4 h-4 text-gray-500" data-lucide="chevron-down"></i>
    </div>

    <!-- Options -->
    <div
        x-show="open"
        @click.outside="open = false"
        x-transition
        class="absolute z-50 mt-2 w-full rounded-xl border border-gray-200 bg-white shadow-lg">
        <ul class="max-h-60 overflow-y-auto">
            @foreach ($options as $value => $label)
            <li
                @click="selected = '{{ $value }}'; open = false"
                class="cursor-pointer px-4 py-2 text-sm hover:bg-sky-100">
                {{ $label }}
            </li>
            @endforeach
        </ul>
    </div>
</div>