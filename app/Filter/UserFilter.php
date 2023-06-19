<?php

namespace App\Filter;
class UserFilter
{
    function __invoke($query, $name, $email, $phone)
    {
        return $query->whereHas('users', function ($query) use ($name, $email, $phone) {
            $query->where([
                'name' => $name,
                'email' => $email,
                'phone' => $phone
            ]);
        });
    }
}
