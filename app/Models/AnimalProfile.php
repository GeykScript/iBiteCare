<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnimalProfile extends Model
{
    //
    protected $table = 'animal_profile';
    protected $fillable = [
        'species',
        'clinical_status',
        'ownership_status',
        'brain_exam',
        'brain_exam_location',
        'brain_exam_results',
        'created_at',
        'modified_at',
    ];
}
