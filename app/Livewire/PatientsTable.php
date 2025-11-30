<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Patient;
use Livewire\WithPagination;

class PatientsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';

    public $genderFilter = null; // null = all, 'Male' = male only, 'Female' = female only
    public $gender = '';
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

    public function toggleGenderFilter()
    {
        if ($this->genderFilter === null) {
            $this->genderFilter = 'Male';
            $this->gender = 'M';

        } elseif ($this->genderFilter === 'Male') { 
            $this->genderFilter = 'Female';
            $this->gender = 'F';
        } else {
            $this->genderFilter = null;
            $this->gender = '';
        }
        $this->resetPage();
    }


    public function render()
    {
        $query = Patient::search($this->search);

        if ($this->genderFilter) {
            $query->where('sex', $this->genderFilter);
        }
        if($this->dateFrom) {
            $query->whereDate('birthdate', '>=', $this->dateFrom);
        }
        if($this->dateTo) {
            $query->whereDate('birthdate', '<=', $this->dateTo);
        }

        return view('livewire.patients-table', [
            'patients' => $query
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
}
