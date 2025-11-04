<div class="overflow-x-auto">
    <!-- Header -->
    <div class="grid grid-cols-4 text-sm text-center font-bold text-white  bg-gray-800 rounded-lg px-2 py-4">
        <div class="col-span-1 flex items-center justify-center md:border-r-2"><p class="hover:cursor-pointer hover:text-gray-100" wire:click="setSortBy('category')">
                Brand
            </p></div>
        <div class="col-span-1 md:border-r-2"><p class="w-full text-center">Total</p></div>
        <div class="col-span-1 md:border-r-2"><p class="w-full text-center">Remaining</p></div>
        <div class="col-span-1 flex items-center justify-center">Status</div>
    </div>

    <!-- Body -->
    <div class="bg-white divide-y ">
        @foreach($inventory_Items as $item)
        <div class="grid grid-cols-4 px-2 py-4 text-sm text-gray-700 text-center">
            <div>{{ $item->brand_name }}</div>
            <div>
                {{ $item->total_units ?? 'N/A' }}
            </div>
            <div>
                {{ $item->total_unit_remaining ?? 'N/A' }}
            </div>
            <div class="font-semibold 
                        @if(strtolower($item->stock_status) === 'in stock') text-green-500 
                        @elseif(strtolower($item->stock_status) === 'out of stock') text-red-500 
                        @elseif(strtolower($item->stock_status) === 'low stock') text-orange-500
                        @else text-gray-600     
                        @endif">
                {{ $item->stock_status }}
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-4 bg-white p-4 rounded-lg shadow">
        {{ $inventory_Items->links() }}
        
    </div>
</div>