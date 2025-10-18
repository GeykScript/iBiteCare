<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Inventory_units;
use Livewire\WithPagination;
use App\Models\Inventory_stock;

class InventoryItems extends Component
{
    use WithPagination;

    public $itemId;
    public $perPage = 5;
    public $sortBy = 'created_at';
    public $sortDirection = 'ASC';

    public function mount($itemId)
    {
        $this->itemId = $itemId;
    }

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
        $this->sortDirection = 'DESC';
    }


    public function removeItem($itemId)
    {
        $item = Inventory_units::find($itemId);

        if ($item) {
            // update item status to 'Disposed'
            $item->status = 'Disposed';
            $item->save();
        
            //  success message
            session()->flash('remove-success', 'Item removed successfully.');
        }else{
            //  error message
            session()->flash('remove-error', 'Item not found.');
        }

        return redirect(request()->header('Referer'));
    }



    public function render()
    {
        return view('livewire.inventory-items', [
            'inventoryItems' => Inventory_units::where('item_id', $this->itemId)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage),
            'column' => Inventory_units::where('item_id', $this->itemId)->first()
        ]);
    }


    
}
