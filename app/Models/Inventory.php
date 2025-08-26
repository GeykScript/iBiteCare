<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $table = 'inventory_records';

    protected $fillable = [
      'category',  
      'item_type',
      'brand_name',
      'product_type',
      'immunity_type',
      'packaging_unit',
      'total_unit',
      'unit_values_with_count',
      'total_capacity',
      'total_remaining',
      'stock_status',
      'last_restocked_date',
      'created_at',
      'updated_at'

    ];

  public function scopeSearch($query, $searchTerm)
  {   
    return $query->where(function ($query) use ($searchTerm) {
      $query->where('category', 'like', "%{$searchTerm}%")
        ->orWhere('brand_name', 'like', "%{$searchTerm}%")
        ->orWhere('product_type', 'like', "%{$searchTerm}%")
        ->orWhere('immunity_type', 'like', "%{$searchTerm}%")
        ->orWhere('packaging_unit', 'like', "%{$searchTerm}%")
        // ->orWhere('volumne_per_unit', 'like', "%{$searchTerm}%")
        // ->orWhere('measurement_unit', 'like', "%{$searchTerm}%")
        // ->orWhere('used_per_unit', 'like', "%{$searchTerm}%")
        // ->orWhere('remaining_volume_per_unit', 'like', "%{$searchTerm}%")
        // ->orWhere('quantity_in_stock', 'like', "%{$searchTerm}%")
        // ->orWhere('used_unit_count', 'like', "%{$searchTerm}%")
        ->orWhere('stock_status', 'like', "%{$searchTerm}%");
    });
  }
}
