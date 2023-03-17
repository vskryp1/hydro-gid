<?php

    namespace App\Helpers;

    use App\Models\Product\Promocode;

    class PromocodeHelper
    {
        public static function getTypes()
        {
            return [
                Promocode::PERCENT => __('backend.percent'),
                Promocode::AMOUNT  => __('backend.amount'),
            ];
        }
    }
