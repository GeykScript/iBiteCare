<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Patient;

class PatientsTable extends DataTableComponent
{
    protected $model = Patient::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("First name", "first_name")
                ->sortable(),
            Column::make("Last name", "last_name")
                ->sortable(),
            Column::make("Birthdate", "birthdate")
                ->sortable(),
            Column::make("Age", "age")
                ->sortable(),
            Column::make("Sex", "sex")
                ->sortable(),
            Column::make("Contact number", "contact_number")
                ->sortable(),
            Column::make("Address", "address")
                ->sortable(),
            Column::make("Registration date", "registration_date")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
