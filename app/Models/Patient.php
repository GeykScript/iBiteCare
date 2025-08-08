<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Patient extends Model
{
    //
    
    protected $table = 'registered_patients';

    protected $fillable = [
        'first_name',
        'last_name',
        'birthdate',
        'age',
        'sex',
        'contact_number',
        'address',
        'registration_date',
    ];

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function ($query) use ($searchTerm) {
            $query->where('first_name', 'like', "%{$searchTerm}%")
                ->orWhere('last_name', 'like', "%{$searchTerm}%")
                ->orWhere('address', 'like', "%{$searchTerm}%");
        });
    }
}
