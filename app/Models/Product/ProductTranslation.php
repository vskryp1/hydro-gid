<?php

    namespace App\Models\Product;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class ProductTranslation extends Model
    {
        use UuidTrait;

        public $timestamps = false;

        public $fillable = [
            'name',
            'introtext',
            'description',
            'seo_title',
            'seo_keywords',
            'seo_description',
            'seo_canonical',
            'seo_robots',
            'seo_content',
        ];
    }
