<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, Filterable;
    protected $fillable = ['user_id', 'customer_name', 'customer_address', 'customer_phone', 'customer_email', 'payment_method', 'warehouse_id', 'status'];
}
