<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderItemStatus extends Enum
{
    const CREATED_ORDER =   'CREATED ORDER';
    const UN_CREATED_ORDER =   'UN CREATED ORDER';
    const WAIT_PAYMENT =   'WAITING FOR PAYMENT';
    const ARRIVED_WAREHOUSE =   'ARRIVED AT THE WAREHOUSE';
    const SUCCESS =   'SUCCESS';
    const FAIL =   'FAIL';
    const ALREADY_PAID = 'ALREADY PAID';
    const DELETED = 'DELETED';
}
