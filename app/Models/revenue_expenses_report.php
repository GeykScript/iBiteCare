<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class revenue_expenses_report extends Model
{
    
    protected $table = 'revenue_expense_summary';
    protected $fillable = [
        'month',
        'year',
        'total_revenue',
        'total_expenses',
        'income',
        'loss'
    ];
}
