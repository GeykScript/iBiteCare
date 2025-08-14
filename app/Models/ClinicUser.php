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
        'name',
        'role',
        'email',
        'account_id',
        'password',

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

}
