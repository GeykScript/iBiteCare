<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Messages;
use Livewire\WithPagination;

class MessagePatientTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';
    public $filter = 'today'; // default filter

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function updatedFilter()
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
        $messages = Messages::with('patient')
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('message_text', 'like', '%' . $this->search . '%')
                        ->orWhere('day_label', 'like', '%' . $this->search . '%')
                        ->orWhere('status', 'like', '%' . $this->search . '%')
                        ->orWhereHas('patient', function ($q) {
                            $q->where('first_name', 'like', '%' . $this->search . '%')
                                ->orWhere('last_name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhere('scheduled_send_date', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filter === 'today', function ($query) {
                // only scheduled for today
                $query->whereDate('scheduled_send_date', now()->toDateString());
            })
            ->when($this->filter === 'sent', function ($query) {
                // only sent messages
                $query->where('status', 'Sent');
            })
            ->when($this->sortBy === 'name', function ($query) {
                $query->join('registered_patients', 'messages.patient_id', '=', 'registered_patients.id')
                    ->select('messages.*')
                    ->orderByRaw("CONCAT(registered_patients.last_name, ' ', registered_patients.first_name) {$this->sortDirection}");
            }, function ($query) {
                $query->orderBy($this->sortBy, $this->sortDirection);
            })
            ->paginate($this->perPage);

        return view('livewire.message-patient-table', [
            'messages' => $messages,
        ]);
    }
}
