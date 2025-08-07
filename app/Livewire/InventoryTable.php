<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inventory;

class InventoryTable extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.inventory-table', [
            'inventory_Items' => Inventory::paginate(6),
        ]);
    }
}
