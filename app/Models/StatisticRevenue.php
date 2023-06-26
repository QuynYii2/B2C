<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticRevenue extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'datetime',
        'country',
        'total_income',
        'description',
        'status',
    ];
}
