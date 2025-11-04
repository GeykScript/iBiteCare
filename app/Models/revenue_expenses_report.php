<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class revenue_expenses_report extends Model
{
    // MAIN VIEW TABLE FOR REVENUE AND EXPENSES REPORT -- revenue_expense_summary
    // THIS IS SAMPLE TABLE ONLY - revenue_test_data_report
    protected $table = 'revenue_test_data_report';
    protected $fillable = [
        'month',
        'year',
        'total_revenue',
        'total_expenses',
        'income',
        'loss'
    ];
}
