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
    public $dateFrom = '';
    public $dateTo = '';

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

    public function updatedDateFrom()
    {
        $this->resetPage();
    }

    public function updatedDateTo()
    {
        $this->resetPage();
    }
    public function clearDateFilter()
    {
        $this->dateFrom = '';
        $this->dateTo = '';
        $this->resetPage();
    }


    public function removeItem($itemId)
    {
        $item = Inventory_units::find($itemId);

        if ($item) {
            // update item status to 'Disposed'
            $item->status = 'Disposed';
            $item->save();
        
            //  success message
            session()->flash('remove-success', 'Item Removed Successfully!');
        }else{
            //  error message
            session()->flash('remove-error', 'Item not found.');
        }

        return redirect(request()->header('Referer'));
    }



    public function render()
    {
        // Base query
        $query = Inventory_units::where('item_id', $this->itemId);

        // Optional date range filtering
        if ($this->dateFrom) {
            $query->whereDate('expiration_date', '>=', $this->dateFrom);
        }

        if ($this->dateTo) {
            $query->whereDate('expiration_date', '<=', $this->dateTo);
        }

        return view('livewire.inventory-items', [
            'inventoryItems' => $query
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),

            'column' => $query->first() // no second unnecessary query
        ]);
    }
}
