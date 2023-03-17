<?php

    namespace App\Enums;

    final class ProductAvailability extends CustomEnum
    {
        const AVAILABLE         = 1;
        const UNDER_ORDER       = 2;
        const EXPECTED_DELIVERY = 3;
        const NOT_AVAILABLE     = 0;
    }
