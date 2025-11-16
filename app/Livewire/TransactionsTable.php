<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ClinicTransactions;

class TransactionsTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortBy = 'transaction_date';
    public $sortDirection = 'ASC';
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDirection = $this->sortDirection === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->sortBy = $sortByField;
            $this->sortDirection = 'DESC';
        }
    }


    public function render()
    {
        $transactions = ClinicTransactions::with([
            'patient',
            'service',
            'paymentRecords.receivedBy',
            'immunizations.administeredBy',
            'immunizations.vaccineUsed.item',
            'immunizations.rigUsed.item',
            'immunizations.antiTetanusUsed.item'
        ])
            ->where(function ($query) {
                $query->whereHas('patient', function ($q) {
                    $q->where('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%');
                })
                    ->orWhereHas('service', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('immunizations', function ($q) {
                        $q->whereHas('patient', function ($sub) {
                            $sub->where('first_name', 'like', '%' . $this->search . '%')
                                ->orWhere('last_name', 'like', '%' . $this->search . '%');
                        })
                            ->orWhereHas('administeredBy', function ($sub) {
                                $sub->where('first_name', 'like', '%' . $this->search . '%')
                                    ->orWhere('last_name', 'like', '%' . $this->search . '%');
                            })
                            ->orWhereHas('vaccineUsed.item', function ($sub) {
                                $sub->where('brand_name', 'like', '%' . $this->search . '%')
                                    ->orWhere('product_type', 'like', '%' . $this->search . '%');
                            })
                            ->orWhereHas('rigUsed.item', function ($sub) {
                                $sub->where('brand_name', 'like', '%' . $this->search . '%')
                                    ->orWhere('product_type', 'like', '%' . $this->search . '%');
                            })
                            ->orWhereHas('antiTetanusUsed.item', function ($sub) {
                                $sub->where('brand_name', 'like', '%' . $this->search . '%')
                                    ->orWhere('product_type', 'like', '%' . $this->search . '%');
                            });
                    })
                    ->orWhereHas('paymentRecords', function ($q) {
                        $q->whereHas('receivedBy', function ($sub) {
                            $sub->where('first_name', 'like', '%' . $this->search . '%')
                                ->orWhere('last_name', 'like', '%' . $this->search . '%');
                        });
                    });
            });

        if ($this->sortBy === 'patient') {
            $transactions = $transactions
                ->join('registered_patients', 'patient_transactions.patient_id', '=', 'registered_patients.id')
                ->select('patient_transactions.*')
                ->orderBy('registered_patients.last_name', $this->sortDirection)
                ->orderBy('registered_patients.first_name', $this->sortDirection);
        } elseif ($this->sortBy === 'service') {
            $transactions = $transactions
                ->join('services', 'patient_transactions.service_id', '=', 'services.id')
                ->select('patient_transactions.*')
                ->orderBy('services.name', $this->sortDirection);
        } else {
            $transactions = $transactions
                ->orderBy($this->sortBy, $this->sortDirection);
        }

        $transactions = $transactions->paginate($this->perPage);

        return view('livewire.transactions-table', compact('transactions'));
    }
}
