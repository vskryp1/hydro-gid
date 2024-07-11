<?php

namespace App\Models\Page;

use App\Enums\PageAlias;
use App\Helpers\CategoryHelper;
use App\Helpers\ProductHelper;
use App\Helpers\ShopHelper;
use App\Models\Filters\Filter;
use App\Models\Product\ProductWarranty;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Models\Product\Product;
use App\Models\Reviews\Review;
use App\Traits\AliasTrait;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Page extends Model implements TranslatableContract
{
    use UuidTrait, SoftDeletes, AliasTrait, Translatable;

    const GALLERY_PATH = 'pages' . DIRECTORY_SEPARATOR;
    const HOME_PATH = DIRECTORY_SEPARATOR;

    public $useSlashes = true;

    public $dates = [
        'deleted_at',
    ];

    public $fillable = [
        'page_template_id',
        'parent_page_id',
        'alias',
        'position',
        'active',
        'only_auth',
        'use_sitemap',
        'is_calculator_exclude',
    ];

    public $translatedAttributes = [
        'name',
        'introtext',
        'value',
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

    public $appends = [
        'format_name',
    ];

    public $useTranslationFallback = true;

    public function page_template()
    {
        return $this->belongsTo(PageTemplate::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['order_sort', 'is_main']);
    }

    public function warranty()
    {
        return $this->hasOne(ProductWarranty::class)->where('active', 1);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function children_active()
    {
        return $this->children()->onlyActive()->byPosition();
    }

    public function children()
    {
        return $this->hasMany(Page::class, 'parent_page_id', 'id');
    }

    public function parent_active()
    {
        return $this->parent()->onlyActive()->byPosition();
    }

    public function parent()
    {
        return $this->hasOne(Page::class, 'id', 'parent_page_id');
    }

    public function filters()
    {
        return $this->belongsToMany(Filter::class);
    }

    public function getImageUrl(string $type, string $key = 'image', bool $is_webp = false)
    {
        $pageAddFieldValue = Cache::tags('add_field_value')
            ->remember(
                'add_field_value.image' . $this->id,
                config('app.cache_minutes'),
                function () use ($key) {
                    return $pageAddFieldValue =
                        $this->additional_field_values()
                            ->whereHas('additional_field', function ($q) use ($key) {
                                $q->where('key', $key);
                            })->first();
                });
        return $pageAddFieldValue && $pageAddFieldValue->value
            ? $this->generateImageUrl($type, $pageAddFieldValue, $is_webp)
            : asset("/storage/cache/$type/" . basename(ShopHelper::setting('no_image', config('app.no_product_image'))));
    }

    private function generateImageUrl($type, $pageAddFieldValue, $is_webp = false)
    {
        return $is_webp
            ? $this->getWebpUrl($type, $pageAddFieldValue)
            : asset("/storage/cache/$type/$this->id/" . $pageAddFieldValue->value);
    }

    private function getWebpUrl($filterType, $pageAddFieldValue)
    {
        $fileName = explode('.', $pageAddFieldValue->value);
        $imageName = array_shift($fileName);
        $is_image_exist = Storage::disk('public')->exists("cache/$filterType/webp/$this->id/" . $imageName . '.webp');

        return $is_image_exist
            ? asset("/storage/cache/$filterType/webp/$this->id/" . $imageName . '.webp')
            : asset("/storage/cache/$filterType/$this->id/" . $pageAddFieldValue->value);
    }

    public function additional_field_values()
    {
        return $this->hasMany(PageAdditionalFieldValue::class);
    }

    public function getAliasAttribute(string $alias): string
    {
        return route('frontend.page', ['alias' => $alias]);
    }

    public function scopeCatalog(Builder $builder)
    {
        return $builder->where('alias', PageAlias::PAGE_CATALOG);
    }

    public function scopeOnlyBlog(Builder $builder)
    {
        return $builder->where('alias', PageAlias::PAGE_BLOG);
    }

    public function scopeByPosition(Builder $builder)
    {
        return $builder->orderBy('position');
    }

    public function scopeProductCategories(Builder $builder)
    {
        return $builder->where('active', true)
            ->whereHas('page_template', function (Builder $builder) {
                return $builder->where('is_category', true);
            })
            ->orderBy('position');
    }

    public function scopeOnlyActive(Builder $builder)
    {
        return $builder->where('active', true);
    }

    public function generateAlias(): string
    {
        $alias = '';

        if ($this->parent) {
            $alias = $this->parent->getOriginal('alias');
        }

        return $alias . DIRECTORY_SEPARATOR . (isset($this->getTranslation()->{$this->titleRowName}) ? Str::slug($this->getTranslation()->{$this->titleRowName}) : uniqid());
    }

    public function getParentsUrl($page): string
    {
        $aliases = $this->getParentUrl($page, []);

        return implode(DIRECTORY_SEPARATOR, array_reverse($aliases));
    }

    public function getParentUrl($page, $aliases = []): array
    {
        $aliases[] = $page->getOriginal('alias');

        if ($page->parent) {
            $aliases = $this->getParentUrl($page->parent, $aliases);
        }

        return $aliases;
    }

    public function getAdditionalFieldByKey($key, $default)
    {
        return '';
    }

    public function getFormatNameAttribute()
    {
        return $this->name;
    }

    public function scopeCalculatorCategories(Builder $builder)
    {
        return $builder->where('active', true)
            ->where('is_calculator_exclude', false)
            ->whereHas('filters', function (Builder $builder) {
                return $builder->where('is_calculator_volume', true)
                    ->orWhere('is_calculator_pressure', true);
            })
            ->with(['filters' => function ($q) {
                $q->where('filters.is_calculator_volume', true)
                    ->orWhere('is_calculator_pressure', true);
            }])
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->name,
                    'alias' => $item->alias,
                    'pressure_filters' => $item->filters->where('is_calculator_pressure', 1)->pluck('alias'),
                    'volume_filters' => $item->filters->where('is_calculator_volume', 1)->pluck('alias')
                ];
            });
    }

    public function getCountAndPricesForSeoCategoriesAttribute(): array
    {
        $categories = CategoryHelper::getPageCategories($this);
        $products = ProductHelper::prepareActiveProductsWithFilters()
            ->onlyActive()
            ->whereHas(
                'pages',
                function ($pages) use ($categories) {
                    return $pages->whereIn('page_id', $categories);
                }
            );

        if ($products->count() < 1){
            return [
                'offerCount' => '',
                'lowPrice' => '',
                'highPrice' => '',
            ];
        }

        $lowProd = ProductHelper::prepareActiveProductsWithFilters()
            ->onlyActive()
            ->whereHas(
                'pages',
                function ($pages) use ($categories) {
                    return $pages->whereIn('page_id', $categories);
                }
            )->orderBy('price')->first();

        $highProd = ProductHelper::prepareActiveProductsWithFilters()
            ->onlyActive()
            ->whereHas(
                'pages',
                function ($pages) use ($categories) {
                    return $pages->whereIn('page_id', $categories);
                }
            )->orderBy('price', 'desc')->first();

        return [
            'offerCount' => $products->count(),
            'lowPrice' => ($lowProd->price == 0) ? 1 : $lowProd->format_price,
            'highPrice' => $highProd->format_price,
        ];
    }

    public function getRatingCount()
    {
        return $this->belongsToMany(Product::class)->avg('rating');
    }

    public function getRatingValue()
    {
        $rating = $this->belongsToMany(Product::class)->avg('rating');

        return isset($rating) ? round($rating, 1, PHP_ROUND_HALF_UP) : 5;
    }
}
