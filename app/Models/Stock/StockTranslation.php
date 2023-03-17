<?php

    namespace App\Models\Stock;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class StockTranslation extends Model
    {
        use UuidTrait;

        public $timestamps = false;

        protected $fillable = [
            'name',
            'description',
            'seo_title',
            'seo_keywords',
            'seo_description',
        ];
    }
