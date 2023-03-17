<?php

    namespace App\Models\Seo;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;

    class Sitemap extends Model
    {
        use UuidTrait;

        const DEFAULT_FREQ = 'weekly';

        public $timestamps = false;

        public $table = 'sitemap';

        public $fillable = [
            'model_id',
            'alias',
            'model',
            'priority',
            'lastmod',
            'changefreq',
            'is_active',
            'position',
        ];

        public static $changefreq = [
            'weekly',
            'always',
            'hourly',
            'daily',
            'monthly',
            'yearly',
            'never',
        ];

        public function entity()
        {
            return $this->morphTo($this->model, 'model', 'model_id', 'id');
        }

        public function scopeOnlyActive(Builder $query)
        {
            return $query->where('is_active', true);
        }

        public function getChangefreqAttribute($value)
        {
            if (is_null($value)) {
                return self::DEFAULT_FREQ;
            }

            return in_array($value, self::$changefreq) ? $value : self::DEFAULT_FREQ;
        }

        public function getAliasAttribute($value)
        {
            $model = ($this->model)::without(['translations'])->find($this->model_id);

            return $model ? str_replace(env('APP_URL') . '/', '', $model->alias) : '';
        }

        public function scopeByPosition(Builder $query)
        {
            return $query->orderBy('position')
                ->orderBy('model')
                ->orderBy('alias');
        }
    }
