<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cart extends Model
{
    use HasFactory;
    protected $casts = [
        'attribute' => 'json',
    ];
    protected $fillable = [
        'user_id',
        'product_name',
        'product_url',
        'attribute',
        'quantity',
        'image',
        'price',
        'total_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
