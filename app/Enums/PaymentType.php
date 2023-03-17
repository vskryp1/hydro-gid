<?php

    namespace App\Enums;

    final class PaymentType extends CustomEnum
    {
        const CASHLESS         = 1;
        const CASH             = 2;
        const VISA             = 3;
        const PRIVAT24         = 4;
        const LIQPAY           = 5;
        const PRIVAT24_BY_PART = 6;
    }
