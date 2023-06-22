<?php

namespace App\Filter;

class OrderFilter extends QueryFilter
{
    protected $filterable = [
        'customer_name',
        'customer_address',
        'customer_phone',
        'customer_email',
        'warehouse_id',
        'status',
    ];

    public function filterName($name)
    {
        return $this->builder->where('name', 'like', '%' . $name . '%');
    }

}
