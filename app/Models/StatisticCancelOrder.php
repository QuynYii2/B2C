<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticCancelOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'numbers',
        'datetime',
        'country',
        'description',
        'status',
    ];
}
