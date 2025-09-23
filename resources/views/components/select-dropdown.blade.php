@props([
'name',
'id',
'placeholder' => 'Select an option',
'options' => [],
])

<div x-data="{ open: false, selected: '' }" class="relative w-full">
    <!-- Hidden input for form submission -->
    <input type="hidden" name="{{ $name }}" x-model="selected" id="{{ $id }}" required>

    <!-- Trigger -->
    <div
        @click="open = !open"
        id="{{ $id }}-container"
        class="flex justify-between items-center cursor-pointer rounded-lg border border-gray-300 bg-white px-3 py-2 text-md shadow-sm hover:border-sky-400 focus:ring focus:ring-sky-200">
        <span x-text="selected ? selected : '{{ $placeholder }}'" class="text-gray-700"></span>
        <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
    </div>

    <!-- Options -->
    <div
        x-show="open"
        @click.outside="open = false"
        x-transition
        class="absolute z-50 mt-2 w-full rounded-xl border border-gray-200 bg-white shadow-lg">
        <ul class="max-h-60 overflow-y-auto">
            @foreach ($options as $option)
            <li
                @click="
                        selected = '{{ $option }}'; 
                        open = false; 
                      $dispatch('package-changed', selected)

                    "
                class="cursor-pointer px-4 py-2 text-sm hover:bg-sky-100">
                {{ $option }}
            </li>
            @endforeach
        </ul>
    </div>
</div>