<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Inventory_usage;
use Livewire\WithPagination;

class InventoryUsage extends Component
{
    use WithPagination;
    public $perPage = 5 ;
    public $search = '';

    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';

    public function updatedPerPage()
    {
        $this->resetPage();
    }


    public function updatingSearch()
    {
        $this->resetPage(); // reset pagination when search changes
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDirection = $this->sortDirection === 'DESC' ? 'ASC' : 'DESC';
        } else {
            $this->sortBy = $sortByField;
            $this->sortDirection = 'ASC';
        }
    }



    public function render()
    {
        $query = Inventory_usage::query()
            ->select('inventory_usage.*', 'inventory_items.brand_name', 'inventory_items.category', 'users.first_name', 'users.last_name')
            ->leftJoin('inventory_units', 'inventory_units.id', '=', 'inventory_usage.unit_id')
            ->leftJoin('inventory_items', 'inventory_items.id', '=', 'inventory_units.item_id')
            ->leftJoin('users', 'users.id', '=', 'inventory_usage.used_by');

        // 🔍 Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('inventory_items.brand_name', 'like', '%' . $this->search . '%')
                    ->orWhere('inventory_items.category', 'like', '%' . $this->search . '%')
                    ->orWhere('users.first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.last_name', 'like', '%' . $this->search . '%');
            });
        }

        // ↕ Sorting
        if ($this->sortBy === 'brand_name') {
            $query->orderBy('inventory_items.brand_name', $this->sortDirection);
        } elseif ($this->sortBy === 'category') {
            $query->orderBy('inventory_items.category', $this->sortDirection);
        } elseif ($this->sortBy === 'user_name') {
            $query->orderBy('users.first_name', $this->sortDirection);
        } else {
            $query->orderBy($this->sortBy, $this->sortDirection);
        }

        return view('livewire.inventory-usage', [
            'inventory_usage' => $query->paginate($this->perPage),
        ]);
    }
}
