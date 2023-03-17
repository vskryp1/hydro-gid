<?php

    namespace App\Models\Region;

    use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
    use Astrotomic\Translatable\Translatable;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Region extends Model implements TranslatableContract
    {
        use UuidTrait, Translatable, SoftDeletes;

        public $dates = [
            'deleted_at',
        ];

        public $fillable = [
            'is_active',
            'is_default',
            'position',
        ];

        public $translatedAttributes = [
            'name',
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
            return $query->where('is_active', true);
        }
    }
