<?php

namespace App\Filter;

class OrderItemFilter extends QueryFilter
{
    protected $filterable = [
        'status',
    ];

    public function filterName($name)
    {
        return $this->builder->where('name', 'like', '%' . $name . '%');
    }

}
