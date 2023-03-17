<?php

    namespace App\Enums;

    final class DeliveryType extends CustomEnum
    {
        const PICKUP           = 1;
        const PICKUP_NP        = 2;
        const COURIER_NP       = 3;
        const DELIVERY_COMPANY = 5;
    }
