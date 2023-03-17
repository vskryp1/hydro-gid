<?php

    namespace App\Models\Filters;

    use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
    use Astrotomic\Translatable\Translatable;
    use App\Models\Page\Page;
    use App\Traits\AliasTrait;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Filter extends Model implements TranslatableContract
    {
        use UuidTrait, AliasTrait, Translatable, SoftDeletes;

        const PRICE        = 'price';
        const LIMIT        = 'limit';
        const SORT         = 'sort';
        const CATEGORY     = 'category';
        const AVAILABILITY = 'availability';
        const SLIDER       = 'slider';

        public $incrementing = false;

        public $dates = [
            'deleted_at',
        ];

        public $fillable = [
            'alias',
            'filter_type_id',
            'position',
            'active',
            'is_option',
            'is_technical',
            'is_calculator_pressure',
            'is_calculator_volume',
        ];

        public $translatedAttributes = [
            'name',
            'description',
            'seo_title',
            'seo_keywords',
            'seo_description',
            'seo_robots',
            'seo_canonical',
            'seo_content',
        ];

        public $with = [
            'translations',
        ];

        public $useTranslationFallback = true;

        public function pages()
        {
            return $this->belongsToMany(Page::class);
        }

        public function filter_type()
        {
            return $this->belongsTo(FilterType::class);
        }

        public function filter_values()
        {
            return $this->hasMany(FilterValue::class);
        }

        public function filter_value()
        {
            return $this->hasOne(FilterValue::class);
        }

        public function scopeOnlyActive(Builder $query)
        {
            return $query->where('active', true);
        }

        public function scopeIsOption(Builder $query)
        {
            return $query->where('is_option', true);
        }

        public function scopebyFilterValuesIds($query, $ids)
        {
            return $query->onlyActive()
                ->filtersSort()
                ->whereIsOption(false)
                ->with([
                    'translations',
                    'filter_values' => function($filterValue) use ($ids) {
                        return $filterValue->with('translations')
                            ->activeByIds($ids)
                            ->filterValuesSort(['position' => 'asc']);
                    },
                ])
                ->whereHas(
                    'filter_value',
                    function($filterValue) use ($ids) {
                        return $filterValue->activeByIds($ids);
                    }
                );
        }

        public function scopeFiltersSort(Builder $query)
        {
            return $query->orderBy('position');
        }
    }
