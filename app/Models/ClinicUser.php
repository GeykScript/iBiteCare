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
        'email',
        'account_id',
        'password',

    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
