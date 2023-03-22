<?php

    namespace App\Models\Product;

    use App\Helpers\ProductHelper;
    use App\Models\Stock\Stock;
    use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
    use Astrotomic\Translatable\Translatable;
    use App\Collections\ProductCollection;
    use App\Enums\ProductAvailability;
    use App\Enums\ProductSaleType;
    use App\Helpers\ShopHelper;
    use App\Jobs\ChunkFollowPriceJob;
    use App\Models\Client\Client;
    use App\Models\Currency\Currency;
    use App\Models\Filters\Filter;
    use App\Models\Filters\FilterValue;
    use App\Models\Page\Page;
    use App\Models\Reviews\Review;
    use App\Traits\AliasTrait;
    use App\Traits\UuidTrait;
    use BenSampo\Enum\Traits\CastsEnums;
    use Carbon\Carbon;
    use Gloudemans\Shoppingcart\Contracts\Buyable;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
    use App\Enums\ProductStatus as ProductStatusEnum;

    class Product extends Model implements Buyable, TranslatableContract
    {
        use UuidTrait, AliasTrait, Translatable, SoftDeletes, CastsEnums {
            Translatable::setAttribute insteadof CastsEnums;
            Translatable::setAttribute as public translatableSetAttribute;
            CastsEnums::setAttribute as public castsEnumsSetAttribute;
        }

        const GALLERY_PATH = 'products' . DIRECTORY_SEPARATOR;

        public $appends = [
            'format_name',
            'cover',
            'full_name',
            'modification_name',
        ];

        public $casts = [
            'expected_at' => Carbon::class,
        ];

        public $enumCasts = [
            'availability' => ProductAvailability::class,
            'sale_type'    => ProductSaleType::class,
        ];

        public $dates = [
            'deleted_at',
        ];

        public $fillable = [
            'alias',
            'product_status_id',
            'position',
            'availability',
            'is_disable_price',
            'sale_type',
            'active',
            'original_price',
            'price',
            'original_price_old',
            'price_old',
            'sku',
            'currency_id',
            'parent_id',
            'group_position',
            'rating',
            'rating_calculate',
            'video',
            'expected_at',
            'technical_doc',
            'under_order_weeks',
            'allow_default_warranty',
        ];

        public $translatedAttributes = [
            'name',
            'introtext',
            'description',
            'seo_title',
            'seo_keywords',
            'seo_description',
            'seo_canonical',
            'seo_robots',
            'seo_content',
        ];

        public $with = [
            'translations',
            'warranties'
        ];

        public function __construct(array $attributes = [])
        {
            if (! $this->getKey()) {
                $this->{$this->getKeyName()} = (string)Str::uuid();
            }
            parent::__construct($attributes);
        }

        public $useTranslationFallback = true;

        public function newCollection(array $models = [])
        {
            return new ProductCollection($models);
        }

        public function setAttribute($key, $value)
        {
            $this->translatableSetAttribute($key, $value);
            $this->castsEnumsSetAttribute($key, $value);
        }

        public function getBuyableIdentifier($options = null)
        {
            return $this->id;
        }

        public function getBuyableDescription($options = null)
        {
            return $this->name;
        }

        public function warranties()
        {
            return $this->hasMany(ProductWarranty::class);
        }

        public function pages()
        {
            return $this->belongsToMany(Page::class)->withPivot(['is_main'])->orderByDesc('is_main')->byPosition();
        }

        public function children()
        {
            return $this->hasMany(Product::class, 'parent_id', 'id')
                ->whereRaw('parent_id <> id');
        }

        public function group()
        {
            return $this->all_group()->onlyActive();
        }

        public function all_group()
        {
            return $this->hasMany(Product::class, 'parent_id', 'parent_id')
                ->orderBy('group_position');
        }

        public function reviews()
        {
            return $this->morphMany(Review::class, 'reviewable');
        }

        public function page_reviews()
        {
            return $this->reviews()->onlyAboutPage()->onlyActive();
        }

        public function product_reviews()
        {
            return $this->reviews()->onlyAboutSpecificProduct($this)->onlyActive();
        }

        public function parent()
        {
            return $this->belongsTo(Product::class);
        }

        public function images()
        {
            return $this->hasMany(ProductImage::class)->orderBy('position');
        }

        public function currency()
        {
            return $this->belongsTo(Currency::class);
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function product_status()
        {
            return $this->belongsTo(ProductStatus::class);
        }

        /**
         * This method need to use on front to get current status of product
         *
         * @return ProductStatus
         */
        public function getStatusAttribute()
        {
            return $this->frontStock->isNotEmpty()
                ?  ProductHelper::getProductStatus(ProductStatusEnum::STOCK)
                : $this->product_status;
        }

        public function filter_values()
        {
            return $this->belongsToMany(FilterValue::class);
        }

        public function option_filters()
        {
            return $this->filter_values()
                ->orderBy('position')
                ->with('filter')
                ->whereHas(
                    'filter',
                    function(Builder $query) {
                        return $query->where('is_option', true)
                            ->orderBy('position');
                    }
                );
        }

        public function clients()
        {
            return $this->belongsToMany(Client::class, 'wishlist', 'product_id', 'client_id')
                ->withTimestamps()
                ->withPivot(['follow_price']);
        }

        public function follow_price()
        {
            return $this->clients()->where('follow_price', true);
        }

        public function setSkuAttribute($value)
        {
            return $this->attributes['sku'] = $value ?? uniqid();
        }

        public function setOriginalPriceAttribute($value)
        {
            if (isset($this->attributes['original_price']) && $value != $this->attributes['original_price']) {
                dispatch(
                    new ChunkFollowPriceJob(
                        $this,
                        $this->currency()->first() ?? ShopHelper::default_currency(),
                        $this->attributes['original_price']
                    ));
            }

            return $this->attributes['original_price'] = $value;
        }

        public function setParentIdAttribute($value)
        {
            return $this->attributes['parent_id'] = is_null($value) ? $this->id : $value;
        }

        public function getMainCategoryAttribute()
        {
            return $this->pages->first();
        }

        public function getTechnicalDocUrlAttribute()
        {
            $url = null;

            if ($this->technical_doc) {
                $path = Product::GALLERY_PATH . $this->id . DIRECTORY_SEPARATOR . $this->technical_doc;

                if (Storage::disk('public')->exists($path)) {
                    $url = Storage::disk('public')->url($path);
                }
            }

            return $url;
        }

        public function getFormatNameAttribute()
        {
            return $this->name . ' (' . $this->sku . ')';
        }

        public function getFullNameAttribute()
        {
            $modification_name = '';

            if (config('app.group_products', false)) {
                $modification_name = $this->modification_name;
            }

            return $this->name . ' (' . $this->sku . ')' . ($modification_name != '' ? ' - ' . $modification_name : '');
        }

        public function getCoverAttribute()
        {
            return $this->images->count() > 0
                ? $this->images->sortByDesc('cover')->first()
                : new ProductImage(
                    [
                        'image'      => '',
                        'alt'        => '',
                        'title'      => '',
	                    'product_id' => $this->id,
                    ]
                );
        }

        public function getAliasAttribute($value)
        {
            return route('frontend.product', ['alias' => $value]);
        }

        public function getModificationNameAttribute()
        {
            $result = '';

            if (config('app.group_products', false)) {
                $result = $this->option_filters->pluck('name')->implode(DIRECTORY_SEPARATOR);
            }

            return $result;
        }

        public function getOptionsAttribute()
        {
            $product_id = $this->id;

            if (config('app.group_products', false)) {
                return collect([]);
            } else {
                // TODO optimize it (c) adminko
                return Filter::onlyActive()
                    ->whereIsOption(true)
                    ->with([
                               'filter_values' => function($filter_values) use ($product_id) {
                                   return $filter_values->onlyActive()->whereHas('products',
                                       function($product) use ($product_id) {
                                           return $product->whereId($product_id);
                                       });
                               },
                               'filter_values.translations',
                           ])
                    ->whereHas('filter_values', function($filter_values) use ($product_id) {
                        return $filter_values->onlyActive()->whereHas('products',
                            function($product) use ($product_id) {
                                return $product->whereId($product_id);
                            });
                    })->get();
            }
        }

        public function scopeProductsSort(Builder $query, $sort = 'position', $order = 'desc')
        {
            return $query->orderBy($sort, $order);
        }

        public function scopeByPosition(Builder $query)
        {
            return $query->orderBy('position');
        }

        public function scopeRandomNotSelfLimited(Builder $query, Product $product, $limit)
        {
            return $query->inRandomOrder()
                ->notSelf($product)
                ->limit($limit);
        }

        public function scopeNotSelf(Builder $query, Product $product)
        {
            return $query->where('id', '<>', $product->id);
        }

        public function scopeOnlyActive(Builder $query)
        {
            return $query->where('active', true);
        }

        public function productRelations()
        {
            return $this->belongsToMany(Product::class, 'product_relations', 'product_id', 'relation_product_id');
        }

        public function similarProducts()
        {
            return $this->belongsToMany(Product::class, 'product_similar', 'product_id', 'similar_product_id');
        }

        public function scopeFilter($query, $filter)
        {
            return $filter->apply($query);
        }

        public function stock()
        {
            return $this->belongsToMany(Stock::class);
        }

        public function frontStock()
        {
            return $this->belongsToMany(Stock::class)->goinOn()->onlyActive();
        }

        /**
         * Current price formatted and converted for view (with stock calculation)
         *
         * @return string
         */
        public function getFormatPriceAttribute()
        {
            return ShopHelper::price_format(ceil($this->converted_price));
        }

        /**
         * Total price formatted and converted for view (with stock calculation)
         *
         * @return string
         */
        public function getFormatTotalUnitPriceAttribute()
        {
            $options       = json_decode($this->pivot->options, true);
            $warrantyPrice = isset($options['warranty']) ? $options['warranty']['price'] : 0;

            return ShopHelper::price_format(($this->pivot->price * $this->pivot->qty) + $warrantyPrice);
        }

        /**
         * Current price converted (with stock calculation)
         *
         * @return string
         */
        public function getConvertedPriceAttribute()
        {
            return ShopHelper::price_convert($this->price);
        }

        /*
         *  Original price (not converted) which add to the cart
         */
        public function getBuyablePrice($options = null)
        {
            return $this->price;
        }

        /**
         * Old price(without stock) formatted and converted for view
         *
         * @return string
         */
        public function getFormatPriceOldAttribute()
        {
            return ShopHelper::price_format(ceil($this->converted_price_old));
        }

        /**
         * Old price(without stock) converted
         *
         * @return string
         */
        public function getConvertedPriceOldAttribute()
        {
            return ShopHelper::price_convert($this->price_old);
        }

        /**
         */
        public function hasDiscount()
        {
            return $this->inStock() && $this->original_price_old !== $this->original_price;
        }

        /**
         */
        public function inStock()
        {
            return $this->frontStock->isNotEmpty();
        }

        /**
         * @return string
         */
        public function getWarrantyText(): string
        {
            $options = json_decode($this->pivot->options, true);

            return isset($options['warranty'])
                ? implode(
                    ' ',
                    [
                        '(',
                        mb_strtolower(__('frontend/product/index.garanty_on')),
                        $options['warranty']['amount'],
                        __(trans_choice('frontend/product/index.month',
                            ($options['warranty']['amount'] < 20 ?
                                $options['warranty']['amount'] :
                                $options['warranty']['amount'] % 10))) . ($options['warranty']['price'] == 0 ? '' : ':'),
                        ($options['warranty']['price'] > 0 ? ShopHelper::price_format($options['warranty']['price']) : ''),
                        ($options['warranty']['price'] > 0 ? __('frontend/product/index.uah') : ''),
                        ')',
                    ]
                )
                : '';
        }

    }
