<?php

    namespace App\Models\Order;

    use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
    use Astrotomic\Translatable\Translatable;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class OrderStatus extends Model implements TranslatableContract
    {
        use UuidTrait, SoftDeletes, Translatable;

        public $dates = [
            'deleted_at',
        ];

        public $fillable = [
            'position',
            'active',
            'default',
            'color',
            'processed',
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
            return $query->where('active', true);
        }
    }
