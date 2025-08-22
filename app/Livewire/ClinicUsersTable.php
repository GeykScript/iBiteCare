<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ClinicUser;
use Livewire\WithPagination;


class ClinicUsersTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 2;
    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';



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
        $query = ClinicUser::search($this->search);
        return view('livewire.clinic-users-table',[
            'clinic_users' => $query
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
}
