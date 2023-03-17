<?php

    namespace App\Models\Filters;

    use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
    use Astrotomic\Translatable\Translatable;
    use App\Collections\FilterCollection;
    use App\Models\Product\Product;
    use App\Traits\AliasTrait;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class FilterValue extends Model implements TranslatableContract
    {
        use UuidTrait, AliasTrait, Translatable, SoftDeletes;

        public $incrementing = false;

        public $usePoint = true;

        public $dates = [
            'deleted_at',
        ];

        public $fillable = [
            'alias',
            'filter_id',
            'position',
            'active',
        ];

        public $translatedAttributes = [
            'name',
        ];

        public $with = [
            'translations',
        ];

        public $useTranslationFallback = true;

        public function newCollection(array $models = [])
        {
            return new FilterCollection($models);
        }

        public function products()
        {
            return $this->belongsToMany(Product::class);
        }

        public function filter()
        {
            return $this->belongsTo(Filter::class);
        }

        public function scopeOnlyActive(Builder $query)
        {
            return $query->where('active', true);
        }

        public function scopeFilterValuesSort(Builder $query, $params = ['position' => 'asc'])
        {
            foreach ($params as $sort => $order) {
                $query = $query->orderBy($sort, $order);
            }

            return $query;
        }

        public function scopeActiveByIds(Builder $query, $ids)
        {
            return $query->onlyActive()->whereIn('id', $ids);
        }

        public function scopeExistsAliases($query, $alias, $separated)
        {
            return $query->without($this->without)
                ->where($this->getKeyName(), '<>', $this->{$this->getKeyName()})
                ->where('filter_id', $this->filter_id)
                ->where(function ($query) use ($alias, $separated) {
                    $query->where($this->aliasRowName, $alias)->orWhere($this->aliasRowName, 'like', $separated . '%');
                });
        }

        public function generateAlias()
        {
            $isSetTranslation = method_exists($this, 'getTranslation') && isset($this->getTranslation()->{$this->titleRowName});
            if($this->filter->filter_type->file == Filter::SLIDER && $isSetTranslation) {
                $result = $this->transformAlias($this->getTranslation()->{$this->titleRowName});
            } else {
                $result = $isSetTranslation ? Str::slug($this->getTranslation()->{$this->titleRowName}) : uniqid();
            }

            return $result;
        }
    }
