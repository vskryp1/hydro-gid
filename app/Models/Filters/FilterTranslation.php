<?php

    namespace App\Models\Filters;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class FilterTranslation extends Model
    {
        use UuidTrait;

        public $timestamps = false;

        public $fillable = [
            'name',
            'description',
            'seo_title',
            'seo_keywords',
            'seo_description',
            'seo_robots',
            'seo_canonical',
            'seo_content',
        ];
    }
