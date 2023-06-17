<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderItemStatus extends Enum
{
    const CREATED_ORDER =   'CREATED ORDER';
    const UN_CREATED_ORDER =   'UN CREATED ORDER';
    const ALREADY_PAID = 'ALREADY PAID';
    const DELETED = 'DELETED';
}
