<?php

    namespace App\Models\Order;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class PaymentTranslation extends Model
    {
        use UuidTrait;

        public $timestamps = false;

        public $fillable = [
            'name',
        ];
    }
