<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ClinicUser;
use Livewire\WithPagination;


class ClinicUsersTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $sortBy = 'created_at';
    public $sortDirection = 'ASC';

    public $selectedUser = null;

    public function showUser($id)
    {
        $this->selectedUser = ClinicUser::find($id);
        $this->dispatch('show-profile-modal')->self(); // fires immediately, no wait
        $this->dispatch('update-profile-modal')->self(); // fires immediately, no wait
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
        $query = ClinicUser::search($this->search);
        return view('livewire.clinic-users-table',[
            'clinic_users' => $query
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
}
