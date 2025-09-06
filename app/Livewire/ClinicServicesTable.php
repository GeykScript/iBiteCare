<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ClinicServices;
use Livewire\WithPagination;

class ClinicServicesTable extends Component
{

    use WithPagination;

    public $search = '';
    public $perPage = 5;

    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';

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


    public function updatedPerPage()
    {
        $this->resetPage();
    }
    public function render()
    {
        $query = ClinicServices::search($this->search);
        return view('livewire.clinic-services-table', [
            'services' => $query->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }


}
