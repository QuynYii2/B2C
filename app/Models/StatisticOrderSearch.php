<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticOrderSearch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'statistic_order',
        'statistic_search',
        'service',
        'status',
    ];
}
