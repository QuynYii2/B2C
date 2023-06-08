<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'customer_name', 'customer_address', 'customer_phone', 'customer_email', 'payment_method', 'status'];
}
