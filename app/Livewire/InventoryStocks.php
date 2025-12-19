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
    public $dateFrom = '';
    public $dateTo = '';

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

    public $itemId;


    public function mount($itemId)
    {
        $this->itemId = $itemId;
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
    public function render()
    {
        $query = Inventory_stock::where('item_id', $this->itemId);

       
        // Apply date filtering
        if ($this->dateFrom) {
            $query->whereDate('restock_date', '>=', $this->dateFrom);
        }

        if ($this->dateTo) {
            $query->whereDate('restock_date', '<=', $this->dateTo);
        }

        return view('livewire.inventory-stocks', [
            'inventoryStocks' => $query
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}
