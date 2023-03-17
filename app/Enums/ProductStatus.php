<?php

    namespace App\Enums;

    final class ProductStatus extends CustomEnum
    {
        const TOP   = 1;
        const NEW   = 2;
        const STOCK = 3;
        const SALE  = 4;
        const HIT   = 5;
    }
