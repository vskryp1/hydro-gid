<?php

    namespace App\Models\Sliders;

    use App\Helpers\ShopHelper;
    use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
    use Astrotomic\Translatable\Translatable;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Support\Facades\Storage;

    class SliderItem extends Model implements TranslatableContract
    {
        use UuidTrait, Translatable, SoftDeletes;

        public $dates = [
            'deleted_at',
        ];

        public $fillable = [
            'slider_id',
            'active',
            'position',
        ];

        public $translatedAttributes = [
            'alt',
            'title',
            'name',
            'description',
            'image',
            'link',
        ];

        public $with = [
            'translations',
        ];

        public $useTranslationFallback = true;

        public function slider()
        {
            return $this->belongsTo(Slider::class);
        }

        public function scopeByPosition(Builder $query)
        {
            return $query->orderBy('position');
        }

        public function scopeOnlyActive(Builder $query)
        {
            return $query->where('active', true);
        }

        public function getUrl($filterType = '', $is_webp = false)
        {
	        $url = $this->image
		        ? $this->getImageUrl($filterType, $is_webp)
		        : asset(collect([
			        'storage',
			        'cache',
			        $filterType,
			        basename(ShopHelper::setting('no_image', config('app.no_product_image')))
		        ])
			        ->implode(DIRECTORY_SEPARATOR));

            return $url;
        }

        public function getLocaleUrl($lang = '')
        {
            return asset(collect(['storage', 'sliders', $this->slider_id, $this->{'image:'. $lang}])
                             ->implode(DIRECTORY_SEPARATOR));

        }

        private function getImageUrl($filterType = '', $is_webp) {
	        $data = $filterType
		        ? $this->getWebpUrl($filterType, $is_webp)
		        : ['storage', 'sliders', $this->slider_id, $this->image];

	        return asset(collect($data)->implode(DIRECTORY_SEPARATOR));
        }

        protected function getWebpUrl($filterType, $is_webp)
        {
            $fileName = explode('.', $this->image);
            $imageName = array_shift($fileName);
            $is_image_exist = Storage::disk('public')->exists("cache/$filterType/webp/$this->slider_id/" . $imageName . '.webp');

            return $is_image_exist && $is_webp
                ? ['storage', 'cache', $filterType, 'webp', $this->slider_id, $imageName . '.webp']
                : ['storage', 'cache', $filterType, $this->slider_id, $this->image];
        }
    }
