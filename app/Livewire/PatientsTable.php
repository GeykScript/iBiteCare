<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Patient;
use Livewire\WithPagination;

class PatientsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;

    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';

    public $genderFilter = null; // null = all, 'Male' = male only, 'Female' = female only
    public $gender = '';


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

        return view('livewire.patients-table', [
            'patients' => $query
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
}
