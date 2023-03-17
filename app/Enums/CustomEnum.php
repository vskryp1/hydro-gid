<?php

    namespace App\Enums;

    use BenSampo\Enum\Contracts\LocalizedEnum;
    use BenSampo\Enum\Enum;

    class CustomEnum extends Enum implements LocalizedEnum
    {
        public static function hasValue($value, bool $strict = true): bool
        {
            return parent::hasValue($value, $strict = false);
        }

        /**
         * Get the description for an enum value
         *
         * @return string
         */
        public function getDesc(): string
        {
            return
                static::getLocalizedDescription($this->value) ??
                static::getFriendlyKeyName(static::getKey($this->value));
        }
    }
