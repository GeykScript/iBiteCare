<?php

namespace App\Livewire;
use App\Models\Inventory;
use Livewire\Component;
use Livewire\WithPagination;


class InventoryRecordsTable extends Component
{


    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';
    public $dateFrom = '';
    public $dateTo = '';

    public function updatingSearch()
    {
        $this->resetPage(); // reset pagination when search changes
    }

    public function updatedPerPage()
    {
        $this->resetPage();
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
        $query = Inventory::search($this->search);

        if ($this->dateFrom) {
            $query->whereDate('last_restocked_date', '>=', $this->dateFrom);
        }
        if ($this->dateTo) {
            $query->whereDate('last_restocked_date', '<=', $this->dateTo);
        }
        return view('livewire.inventory-records-table',[
            'supplies' => $query->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}

