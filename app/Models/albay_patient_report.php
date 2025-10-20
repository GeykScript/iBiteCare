<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class albay_patient_report extends Model
{
    protected $table = 'albay_patient_report';
    protected $fillable = [
        'year',
        'quarter',
        'Localities',
        'patient_count',
        'male_count',
        'female_count',
        'age_0_17',
        'age_18_64',
        'age_65_plus',
        'dog_count',
        'dog_count',
        'others_count',
        'bite_cat_1',
        'bite_cat_2',
        'bite_cat_3'
    ];
}
