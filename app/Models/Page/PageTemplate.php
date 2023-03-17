<?php

    namespace App\Models\Page;

    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class PageTemplate extends Model
    {
        use UuidTrait, SoftDeletes;

        public $fillable = [
            'name',
            'folder',
            'active',
            'is_category',
        ];

        public $dates = [
            'deleted_at',
        ];

        public function page_additional_field()
        {
            return $this->hasMany(PageAdditionalField::class)
                ->orderByDesc('created_at');
        }

        public function scopeOnlyActive(Builder $builder)
        {
            return $builder->where('active', true);
        }

        public function scopeOnlyCategory(Builder $builder)
        {
            return $builder->where('is_category', true);
        }
    }
