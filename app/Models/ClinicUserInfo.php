<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicUserInfo extends Model
{
    //
    protected $table = 'user_informations';
    protected $fillable = [
        'user_id',
        'role_id',
        'first_name',
        'last_name',
        'personal_email',
        'contact_number',
        'address',
        'gender',
        'birthdate',
    ];

    public function UserRole()
    {
        return $this->belongsTo(ClinicUserRole::class, 'role', 'id');
    }

    public function ClinicUser()
    {
        return $this->belongsTo(ClinicUser::class, 'user_id', 'id');
    }

}
