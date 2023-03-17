<?php

    namespace App\Models\Reviews;

    use App\Models\Page\Page;
    use App\Models\Product\Product;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;

    class Review extends Model
    {
        use UuidTrait;

        const PAGE    = 'page';
        const PRODUCT = 'product';

        const MODELS = [
            self::PAGE    => Page::class,
            self::PRODUCT => Product::class,
        ];

        public $fillable = [
            'rating',
            'username',
            'email',
            'comment',
            'answer',
            'is_active',
            'reviewable_id',
            'reviewable_type',
        ];

        public function reviewable()
        {
            return $this->morphTo();
        }

        public function scopeOnlyAboutPage(Builder $builder)
        {
            return $builder->where('reviewable_type', self::MODELS[self::PAGE]);
        }

        public function scopeOnlyAboutSpecificProduct(Builder $builder, Product $product)
        {
            return $builder->where('reviewable_type', self::MODELS[self::PRODUCT])
                ->where('reviewable_id', $product->id);
        }

        public function scopeOnlyActive(Builder $builder)
        {
            return $builder->where('is_active', true);
        }

        public static function drawStars(int $rating)
        {
            if (!$rating) {
                echo __('backend/review/index.missing');
            }

            $starCount = 1;

            while ($starCount <= $rating) {
                echo '<i class="fa fa-star"></i>' . PHP_EOL;

                $starCount++;
            }
        }

        public static function getTranslationType(?string $key = null)
        {
            if (is_null($key)) {
                return [
                    ''                          => __('backend.select_placeholder'),
                    self::MODELS[self::PAGE]    => __('backend/review/index.page'),
                    self::MODELS[self::PRODUCT] => __('backend/review/index.product'),
                ];
            }

            return __('backend/review/index.' . array_flip(self::MODELS)[$key]);
        }
    }
