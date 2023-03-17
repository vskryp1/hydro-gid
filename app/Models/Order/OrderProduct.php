<?php

    namespace App\Models\Order;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class OrderProduct extends Model
    {
        use UuidTrait;

        public $fillable = [
            'order_id',
            'client_id',
            'qty',
            'price',
            'options',
        ];
    }
