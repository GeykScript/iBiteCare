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
}
