<?php

    namespace App\Models\Product;

    use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
    use Astrotomic\Translatable\Translatable;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class ProductStatus extends Model implements TranslatableContract
    {
        use UuidTrait, Translatable, SoftDeletes;

        public $incrementing = false;

        public $dates = [
            'deleted_at',
        ];

        public $fillable = [
            'color',
            'class',
            'active',
            'in_stock',
            'default',
            'alias',
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

        public function scopeGetList(Builder $query)
        {
            return $query->onlyActive()->byPosition();
        }

        public function scopeAlias(Builder $query, $alias)
        {
            $query->where('alias', $alias);
        }
    }
