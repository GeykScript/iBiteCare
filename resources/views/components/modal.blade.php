@props(['id' => 'modal', 'title' => ''])

<div id="{{ $id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg md:w-full md:max-w-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">{{ $title }}</h2>
            <button type="button" onclick="document.getElementById('{{ $id }}').classList.add('hidden')"
                class="text-gray-600 text-2xl font-bold">&times;</button>
        </div>

        <div>
            {{ $slot }}
        </div>
    </div>
</div> 