<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class barangay_patient_report extends Model
{                       //MAIN VIEW TABLE FOR GUINOBATAN REPORT -- barangay_patient_report
                        //THIS IS SAMPLE TABLE ONLY - guinobatan_test_data_report
    protected $table = 'guinobatan_test_data_report';   
    protected $fillable = [
        'year',
        'quarter',
        'barangay',
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
