<?php

namespace App\Livewire;
use App\Models\Inventory;
use Livewire\Component;
use Livewire\WithPagination;


class InventoryRecordsTable extends Component
{


    use WithPagination;

    public $search = '';
    public $perPage = 5;

    public $sortBy = 'created_at';
    public $sortDirection = 'ASC';

    public function updatingSearch()
    {
        $this->resetPage(); // reset pagination when search changes
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

    public function render()
    {
        $query = Inventory::search($this->search);
        return view('livewire.inventory-records-table',[
            'supplies' => $query->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}

