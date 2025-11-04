<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PatientAppointment;

class AppointmentTable extends Component
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

    public function updatedPerPage()
    {
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
        $query = PatientAppointment::search($this->search);
        return view('livewire.appointment-table',[
            'appointments' => $query->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}
