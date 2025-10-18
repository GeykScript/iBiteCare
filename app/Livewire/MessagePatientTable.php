<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Messages;
use Livewire\WithPagination;

class MessagePatientTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';

    // Reset pagination when search or perPage changes
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    // Sorting logic
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
        $messages = Messages::with('patient')
            ->when($this->search, function ($query) {
                $query->where('message_text', 'like', '%' . $this->search . '%')
                    ->orWhere('day_label', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%')
                    ->orWhereHas('patient', function ($q) {
                        $q->where('first_name', 'like', '%' . $this->search . '%')
                            ->orWhere('last_name', 'like', '%' . $this->search . '%');
                    });
            })
            // ->where('scheduled_send_date', '<=', now()->toDateString())
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.message-patient-table', [
            'messages' => $messages,
        ]);
    }
}
