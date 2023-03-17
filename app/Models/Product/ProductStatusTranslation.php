<?php

    namespace App\Models\Product;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class ProductStatusTranslation extends Model
    {
        use UuidTrait;

        public $timestamps = false;

        public $fillable = [
            'name',
        ];
    }
