<?php

namespace App\Filter;

class OrderItemFilter extends QueryFilter
{
    protected $filterable = [
        'id',
        'product_name',
        'quantity',
        'price',
        'total_price',
        'status',
        'order_id',
    ];

    public function filterName($name)
    {
        return $this->builder->where('name', 'like', '%' . $name . '%');
    }

}
