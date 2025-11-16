<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'notifications';
    protected $fillable = [
        'id',
        'content',
        'is_read',
        'links_to',
        'created_at',
        'updated_at',
    ];
}
