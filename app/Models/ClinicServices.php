<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicServices extends Model
{
    protected $table = 'services';
    protected $fillable = [
        'name',
        'description',
        'service_fee',
        'discount',
        'rig_fee',
        'rig_discounted_fee',
        'discounted_service_fee',
        'created_at',
        'updated_at'
    ];

    public function schedules()
    {
        return $this->hasMany(ClinicServicesSchedules::class, 'service_id', 'id');
    }



    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function ($query) use ($searchTerm) {
            $query->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
        });
    }
}
