<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicServices extends Model
{
    protected $table = 'services';
    protected $fillable = [
        'name',
        'description',
    ];
}
