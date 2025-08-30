<?php

namespace App\Livewire;
use App\Models\Inventory_stock;
use Carbon\Traits\Week;
use Livewire\Component;
use Livewire\WithPagination;

class InventoryStocks extends Component
{
    
    use WithPagination;
    public $perPage = 5;

    public $sortBy = 'created_at';
    public $sortDirection = 'ASC';

    public function updatedPerPage()    
    {
        $this->resetPage();
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDirection = $this->sortDirection === 'ASC' ? 'DESC' : 'ASC';
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDirection = 'ASC';
    }   

    public $itemId;


    public function mount($itemId)
    {
        $this->itemId = $itemId;
    }

    public function render()
    {
        return view('livewire.inventory-stocks', [
            'inventoryStocks' => Inventory_stock::where('item_id', $this->itemId)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}
