<?php

    namespace App\Models\Currency;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Currency extends Model
    {
        use UuidTrait, SoftDeletes;

        public $incrementing = false;

        public $dates = [
            'deleted_at',
        ];

        public function courses()
        {
            return $this->hasMany(Course::class);
        }

        public function course()
        {
            return $this->hasOne(Course::class)->latest();
        }

        public function getFullNameAttribute()
        {
            return $this->name . ' (' . $this->sign . ')';
        }

        public function scopeOnlyActive(Builder $query)
        {
            return $query->where('active', true);
        }

        public function scopeByDefault(Builder $query)
        {
            return $query->orderByDesc('default');
        }

        public function scopeByPosition(Builder $query)
        {
            return $query->orderBy('position');
        }
    }
