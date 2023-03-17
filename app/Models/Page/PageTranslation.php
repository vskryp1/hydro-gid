<?php

    namespace App\Models\Page;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class PageTranslation extends Model
    {
        use UuidTrait;

        public $timestamps   = false;

        public $fillable = [
            'name',
            'introtext',
            'description',
            'seo_title',
            'seo_keywords',
            'seo_description',
            'seo_robots',
            'seo_canonical',
            'seo_content',
        ];
    }
