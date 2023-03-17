<?php

    namespace App\Models\Stock;

    use App\Helpers\ShopHelper;
    use App\Models\Currency\Currency;
    use App\Models\Page\Page;
    use App\Models\Product\Product;
    use App\Traits\UuidTrait;
    use Astrotomic\Translatable\Translatable;
    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Support\Facades\Storage;

    class Stock extends Model
    {
        use UuidTrait, SoftDeletes, Translatable;

        const GALLERY_PATH = 'stocks' . DIRECTORY_SEPARATOR;

        protected $fillable = [
            'active',
            'start_date',
            'expiration_date',
            'image',
            'position',
            'page_id',
            'uploaded_image',
            'discount',
            'is_percentage',
            'is_main',
        ];

        public $translatedAttributes = [
            'name',
            'description',
            'seo_title',
            'seo_keywords',
            'seo_description',
        ];

        protected $dates = [
            'deleted_at',
            'start_date',
            'expiration_date',
        ];

        public $with = [
            'translations',
        ];

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);

            $this->defaultLocale = app()->getLocale();
        }

        public function products()
        {
            return $this->belongsToMany(Product::class);
        }

        public function page()
        {
            return $this->belongsTo(Page::class);
        }

        public function getImageUrl($type = 'stocks', $is_webp = false)
        {
            return $is_webp
                ? $this->getWebpUrl($type)
                : asset("/storage/cache/$type/$this->id/$this->image");
        }

        private function getWebpUrl($filterType)
        {
            $fileName = explode('.', $this->image);
            $imageName = array_shift($fileName);
            $is_image_exist = Storage::disk('public')->exists("cache/$filterType/webp/$this->id/" . $imageName . '.webp');

            return $is_image_exist
                ? asset("/storage/cache/$filterType/webp/$this->id/$imageName.webp")
                : asset("/storage/cache/$filterType/$this->id/$this->image");
        }

        public function scopeGoinOn(Builder $builder)
        {
            $now = Carbon::now()->toDateString();

            return $builder->whereDate('start_date', '<=', $now)
                ->whereDate('expiration_date', '>=', $now);
        }

        public function scopeByPosition(Builder $builder)
        {
            return $builder->orderBy('position');
        }

        public function scopeOnlyActive(Builder $builder)
        {
            return $builder->where('active', 1);
        }

        public function scopeOnlyMain(Builder $builder)
        {
            return $builder->where('is_main', 1);
        }

    }
