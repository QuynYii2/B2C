<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_from',
        'address_to',
        'distance',
        'weight',
        'description',
        'price_percent',
        'shipping_fee',
        'tax_percent',
        'status',
    ];
}
