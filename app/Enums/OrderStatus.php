<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
final class OrderStatus extends Enum
{
    const PROCESSING =   'PROCESSING';
    const PAYMENT_SUCCESS =   'PAYMENT SUCCESS';
    const WAIT_PAYMENT =   'WAITING FOR PAYMENT';
    const ARRIVED_WAREHOUSE =   'ARRIVED AT THE WAREHOUSE';
    const SHIPPING = 'SHIPPING';
    const DELIVERED = 'DELIVERED';
    const CANCELED = 'CANCELED';
    const DELETED = 'DELETED';
}
