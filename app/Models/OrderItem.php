<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory, Filterable;
    protected $fillable = ['order_id', 'product_name', 'product_url', 'image', 'attribute', 'quantity', 'price', 'total_price'];
}
