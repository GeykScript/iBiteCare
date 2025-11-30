<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PaymentRecords;


class PaymentRecordsTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';
    public $search = '';
    public $dateFrom = '';
    public $dateTo = '';

    public function updatingSearch()
    {
        $this->resetPage();
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
        $query = PaymentRecords::with(['patient', 'transaction.service', 'receivedBy']);

        // Handle sorting
        if ($this->sortBy === 'patient') {
            $query->join('registered_patients', 'payment_records.patient_id', '=', 'registered_patients.id')
                ->select('payment_records.*')
                ->orderBy('registered_patients.last_name', $this->sortDirection)
                ->orderBy('registered_patients.first_name', $this->sortDirection);
        } elseif ($this->sortBy === 'transaction') {
            $query->join('patient_transactions', 'payment_records.transaction_id', '=', 'patient_transactions.id')
                ->join('services', 'patient_transactions.service_id', '=', 'services.id')
                ->select('payment_records.*')
                ->orderBy('services.name', $this->sortDirection);
        } elseif ($this->sortBy === 'in_charge') {
            $query->join('users', 'payment_records.received_by_id', '=', 'users.id')
                ->select('payment_records.*')
                ->orderBy('users.last_name', $this->sortDirection)
                ->orderBy('users.first_name', $this->sortDirection);
        } else {
            $query->orderBy($this->sortBy, $this->sortDirection);
        }

        if($this->dateFrom) {
            $query->whereDate('payment_date', '>=', $this->dateFrom);
        }
        if($this->dateTo) {
            $query->whereDate('payment_date', '<=', $this->dateTo);
        }

        // Handle searching
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->whereHas('patient', function ($q2) {
                    $q2->where('first_name', 'like', "%{$this->search}%")
                        ->orWhere('last_name', 'like', "%{$this->search}%");
                })
                    ->orWhereHas('transaction.service', function ($q2) {
                        $q2->where('name', 'like', "%{$this->search}%");
                    })
                    ->orWhereHas('receivedBy', function ($q2) {
                        $q2->where('first_name', 'like', "%{$this->search}%")
                            ->orWhere('last_name', 'like', "%{$this->search}%");
                    })
                    ->orWhere('receipt_number', 'like', "%{$this->search}%")
                    ->orWhere('amount_paid', 'like', "%{$this->search}%");
            });
        }

        $paymentRecords = $query->paginate($this->perPage);

        return view('livewire.payment-records-table', [
            'paymentRecords' => $paymentRecords
        ]);
    }
}
