<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ClinicUserLogs;


class ClinicUserLogsTable extends Component

{
    use WithPagination;
    public $perPage = 5;
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
        $query = ClinicUserLogs::query()
            ->select('user_logs.*')
            ->leftJoin('user_roles', 'user_roles.id', '=', 'user_logs.role_id')
            ->leftJoin('users', 'users.id', '=', 'user_logs.user_id');

        // Handle search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('user_roles.role_name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.last_name', 'like', '%' . $this->search . '%');
            });
        }

        // Handle sorting
        if ($this->sortBy === 'role_name') {
            $query->orderBy('user_roles.role_name', $this->sortDirection);
        } elseif ($this->sortBy === 'user_name') {
            $query->orderBy('users.first_name', $this->sortDirection);
        } else {
            $query->orderBy($this->sortBy, $this->sortDirection);
        }

        return view('livewire.clinic-user-logs-table', [
            'clinic_user_logs' => $query->paginate($this->perPage),
        ]);
    }
}


