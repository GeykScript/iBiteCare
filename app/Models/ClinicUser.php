<?php

namespace App\Models;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;


class ClinicUser extends Model implements Authenticatable
{
    //
    use \Illuminate\Auth\Authenticatable;
    protected $table = 'users';
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_initial',
        'suffix',
        'role',
        'email',
        'account_id',
        'password',
        'default_password',
        'remember_token',
        'two_factor_code',
        'is_disabled',

    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function UserRole(){
        return $this->belongsTo(ClinicUserRole::class, 'role', 'id');
    }   
    public function info()
    {   
        return $this->hasOne(ClinicUserInfo::class, 'user_id', 'id');
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function ($query) use ($searchTerm) {
            $query->where('first_name', 'like', "%{$searchTerm}%")
                ->orWhere('last_name', 'like', "%{$searchTerm}%")
                ->orWhere('account_id', 'like', "%{$searchTerm}%");
        });
    }

}
