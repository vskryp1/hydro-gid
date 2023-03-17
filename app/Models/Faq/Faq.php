<?php

    namespace App\Models\Faq;

    use App\Traits\UuidTrait;
    use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
    use Astrotomic\Translatable\Translatable;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Builder;

    class Faq extends Model implements TranslatableContract
    {
        use UuidTrait, Translatable;

        public $incrementing = false;

        public $fillable = [
            'id',
            'active',
            'position',
        ];

        public $translatedAttributes = [
            'answer',
            'question',
        ];

        public $with = [
            'translations',
        ];

        public $useTranslationFallback = true;

        public function scopeByPosition(Builder $query)
        {
            return $query->orderBy('position');
        }

        public function scopeOnlyActive(Builder $query)
        {
            return $query->where('active', true);
        }
    }
