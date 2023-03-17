<?php

    namespace App\Models\Product;

    use App\Helpers\ShopHelper;
    use App\Models\Page\Page;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;

    class ProductWarranty extends Model
    {
        use UuidTrait;

        public $fillable = [
            'active',
            'position',
            'amount',
            'price',
            'page_id',
        ];

        public function scopeByPosition(Builder $query)
        {
            return $query->orderBy('position');
        }

        public function scopeOnlyActive(Builder $query)
        {
            return $query->where('active', true);
        }

        public function getConvertedPriceAttribute()
        {
            return $this->price;
        }

        public function getPriceFormattedAttribute()
        {
            return ShopHelper::price_format($this->price);
        }

        public function scopeActiveByPosition($query)
        {
            return $query->onlyActive()->byPosition();
        }

        public function scopeCategoryWarranty($query)
        {
            return $query->whereNotNull('page_id');
        }

        public function category()
        {
            return $this->belongsTo(Page::class, 'page_id');
        }
    }
