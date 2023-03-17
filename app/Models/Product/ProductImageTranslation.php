<?php

    namespace App\Models\Product;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class ProductImageTranslation extends Model
    {
        use UuidTrait;

        public $timestamps = false;

        public $fillable = [
            'alt',
            'title',
        ];
    }
