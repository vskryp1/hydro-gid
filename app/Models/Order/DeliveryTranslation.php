<?php

    namespace App\Models\Order;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class DeliveryTranslation extends Model
    {
        use UuidTrait;

        public $timestamps = false;

        public $fillable = [
            'name',
            'description',
        ];
    }
