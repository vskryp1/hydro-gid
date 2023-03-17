<?php

    namespace App\Models\Sliders;

    use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
    use Astrotomic\Translatable\Translatable;
    use App\Traits\AliasTrait;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Slider extends Model implements TranslatableContract
    {
        use Translatable, AliasTrait, UuidTrait, SoftDeletes;

        const GALLERY_PATH     = 'sliders' . DIRECTORY_SEPARATOR;
        const MAIN_PAGE_SLIDER = 'main-page';
        const ABOUT_US_SLIDER = 'our-partner';
        const ABOUT_US_GALLERY_SLIDER = 'gallery';
        const CERTIFICATE_SLIDER = 'certificate';

        public $dates = [
            'deleted_at',
        ];

        public $fillable = [
            'active',
            'alias',
            'position',
        ];

        public $translatedAttributes = [
            'name',
        ];

        public $with = [
            'translations',
        ];

        public $useTranslationFallback = true;

        public function scopeOnlyActive(Builder $query)
        {
            return $query->where('active', true);
        }

        public function scopeByPosition(Builder $query)
        {
            return $query->orderBy('position');
        }

	    public function scopeOnlyActiveWithItems(Builder $query)
	    {
		    return $query->where('active', true)
			    ->with([
			    	'slider_items' => function ($q) {
			    	    $q->where('active', true)->byPosition();
			        }
				]);
	    }

        public function slider_items()
        {
            return $this->hasMany(SliderItem::class);
        }

        public function slider_items_active()
        {
            return $this->slider_items()->onlyActive()->byPosition();
        }
    }
