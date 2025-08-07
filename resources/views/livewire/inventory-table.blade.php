<div class="overflow-x-auto">
    <!-- Header -->
    <div class="grid grid-cols-4 text-xs text-center font-bold text-gray-700  bg-gray-100 rounded-t-lg px-2 py-4">
        <div class="col-span-1 flex items-center justify-center">Brand Name</div>
        <div class="col-span-2 flex flex-col gap-1 border-l-2 border-r-2 border-gray-300 b">
            <p class="text-center">Per Unit</p>
            <div class="grid grid-cols-2 ">
                <p class="border-r-2 border-gray-300">Used</p>
                <p>Left</p>
            </div>
        </div>

        <div class="col-span-1 flex items-center justify-center">Status</div>
    </div>

    <!-- Body -->
    <div class="bg-white divide-y ">
        @foreach($inventory_Items as $item)
        <div class="grid grid-cols-4 px-2 py-4 text-sm text-gray-700 text-center">
            <div>{{ $item->brand_name }}</div>

            <div>
                {{ rtrim(rtrim($item->used_per_unit, '0'), '.') }} {{ $item->measurement_unit }}
            </div>

            <div>
                {{ rtrim(rtrim($item->remaining_volume_per_unit, '0'), '.') }} {{ $item->measurement_unit }}
            </div>

            <div class="font-semibold 
                        @if(strtolower($item->status) === 'in stock') text-green-500 
                        @else text-gray-600 
                        @endif">
                {{ $item->status }}
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-4 bg-white p-4 rounded-lg shadow">
        {{ $inventory_Items->links('vendor.pagination.tailwind') }}
    </div>
</div>