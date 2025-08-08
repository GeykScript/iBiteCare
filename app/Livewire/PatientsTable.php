<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Patient;
use Livewire\WithPagination;

class PatientsTable extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 3;

    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';

    public function setSortBy($sortByField){
        if($this->sortBy === $sortByField) {
            $this->sortDirection = $this->sortDirection === 'ASC' ? 'DESC' : 'ASC';
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDirection = 'DESC';
    }

    public function render()
    {
        return view('livewire.patients-table',
         [
            'patients' => Patient::search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage)
        ]);

    }
}
