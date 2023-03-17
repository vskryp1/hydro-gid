<?php

    namespace App\Enums;

    final class ServiceType extends CustomEnum
    {
        const ORDER    = 1;
        const CALLBACK = 2;
        const QUESTION = 3;
        const CONTACT  = 4;
    }
