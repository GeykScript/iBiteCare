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
      'stock_status',
      'total_units',
      'total_unit_remaining',
      'vol_qty_total',
      'vol_qty_remaining',
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
        ->orWhere('stock_status', 'like', "%{$searchTerm}%");
    });
  }
}
