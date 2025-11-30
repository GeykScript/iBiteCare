<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PatientAppointment;

class AppointmentTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';
    public $filter = 'pending'; // default filter
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
        $query = PatientAppointment::search($this->search)
            ->when($this->filter === 'all', function ($query) {
            $query->whereIn('status', ['Arrived', 'Cancelled', 'Pending']);
        })
            // Apply date filters
            ->when($this->dateFrom, function ($query) {
                $query->whereDate('appointment_date', '>=', $this->dateFrom);
            })
            ->when($this->dateTo, function ($query) {
                $query->whereDate('appointment_date', '<=', $this->dateTo);
            })
            ->when($this->filter === 'arrived', function ($query) {
                // only sent messages
                $query->where('status', 'Arrived');
            })
            ->when($this->filter === 'cancelled', function ($query) {
                // only sent messages
                $query->where('status', 'Cancelled');
            })
            ->when($this->filter === 'pending', function ($query) {
                // only sent messages
                $query->where('status', 'Pending');
            });

        return view('livewire.appointment-table', [
            'appointments' => $query->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}
