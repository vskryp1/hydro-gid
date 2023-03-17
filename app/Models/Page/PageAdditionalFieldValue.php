<?php

    namespace App\Models\Page;

    use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
    use Astrotomic\Translatable\Translatable;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;

    class PageAdditionalFieldValue extends Model implements TranslatableContract
    {
        use UuidTrait, Translatable;

        public $fillable = [
            'page_id',
            'page_additional_field_id',
        ];

        public $translatedAttributes = [
            'value',
        ];

        public $with = [
            'translations',
        ];

        public $useTranslationFallback = true;

        public function additional_field()
        {
            return $this->belongsTo(PageAdditionalField::class, 'page_additional_field_id');
        }
    }
