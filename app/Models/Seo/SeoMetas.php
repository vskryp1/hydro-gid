<?php

    namespace App\Models\Seo;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class SeoMetas extends Model
    {
        use UuidTrait;

        public $fillable = [
            'seo_title',
            'seo_url',
            'seo_keywords',
            'seo_description',
            'seo_robots',
            'seo_canonical',
            'seo_content',
        ];

    }
