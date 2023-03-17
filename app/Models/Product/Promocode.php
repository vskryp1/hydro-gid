<?php

    namespace App\Models\Product;

    use App\Helpers\ShopHelper;
    use App\Models\Currency\Currency;
    use App\Models\Order\Order;
    use App\Traits\UuidTrait;
    use Carbon\Carbon;
    use Gloudemans\Shoppingcart\Facades\Cart;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;

    class Promocode extends Model
    {
        use UuidTrait;

        const PERCENT = 'percent';
        const AMOUNT  = 'amount';

        public $fillable = [
            'alias',
            'currency_id',
            'active',
            'type',
            'original_discount_size',
            'discount_size',
            'use_count',
            'expiration_date',
            'type_of_use',
        ];

        public function orders()
        {
            return $this->hasMany(Order::class);
        }

        public function currency()
        {
            return $this->belongsTo(Currency::class);
        }

        public function getDiscountAttribute()
        {
            $discount = $this->discount_size;

            if ($this->type == self::PERCENT) {
                $discount = Cart::total() * $this->original_discount_size / 100;
            }

            if ($discount > Cart::total()) {
                $discount = Cart::total() - ShopHelper::setting(
                        'promocode_discount_min',
                        config('app.promocode_discount_min')
                    );
            }

            return $discount;
        }

        public function scopeOnlyActive(Builder $query)
        {
            return $query->where('active', true);
        }

        public function scopeActivePromocode(Builder $query, $promocode)
        {
            return $query->onlyActive()
                ->whereAlias($promocode)
                ->whereDate('expiration_date', '>=', Carbon::now()->format(config('app.formats.php.date')))
                ->where(function(Builder $where_query) {
                    return $where_query->where('type_of_use', true)
                        ->orWhereColumn('use_count', '>', 'used');
                });
        }
    }
