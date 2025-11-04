@props(['name' => null, 'show' => false])

<div
    x-data="{ show: @js($show) }"
    x-show="show"
    x-transition
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg">
        {{ $slot }}
    </div>
</div>