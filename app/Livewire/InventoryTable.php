<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inventory;

class InventoryTable extends Component
{
    use WithPagination;

    public $sortBy = 'created_at';
    public $sortDirection = 'ASC';
    public $perPage = 7;
    
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
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.inventory-table', [
            'inventory_Items' => Inventory::orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage),
        ]);
    }
}
