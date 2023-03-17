<?php

    namespace App\Models\Order;

    use App\Enums\PaymentType;
    use App\Helpers\LiqPay;
    use App\Helpers\ShopHelper;
    use App\Models\Client\Address;
    use App\Models\Client\Client;
    use App\Models\Client\Temp_Client_Orders;
    use App\Models\Currency\Currency;
    use App\Models\Product\Product;
    use App\Models\Product\Promocode;
    use App\Models\User;
    use App\Traits\UuidTrait;
    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Support\Str;
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

    class Order extends Model
    {
        use UuidTrait, SoftDeletes;

        public $fillable = [
            'client_id',
            'user_id',
            'address_id',
            'order_status_id',
            'delivery_method_id',
            'region_id',
            'payment_id',
            'place_id',
            'warehouse_id',
            'delivery_id',
            'locale',
            'currency_id',
            'promocode_id',
            'discount',
	        'is_percentage',
            'total_price',
            'delivery_price',
            'unique_id',
            'comment',
            'ttn',
            'temp_client_id',
        ];

        public static function boot()
        {
            parent::boot();

            static::creating(function($model) {
                if (!$model->getKey()) {
                    $model->{$model->getKeyName()} = (string)Str::uuid();
                }

                if (!$model->unique_id) {
                    $model->unique_id = crc32($model->getKey());
                }

                return true;
            });
        }

        public function order_status()
        {
            return $this->belongsTo(OrderStatus::class);
        }

        public function promocode()
        {
            return $this->belongsTo(Promocode::class);
        }

        public function delivery()
        {
            return $this->belongsTo(Delivery::class);
        }

        public function payment()
        {
            return $this->belongsTo(Payment::class);
        }

        public function delivery_place()
        {
            return $this->belongsTo(DeliveryPlace::class, 'place_id');
        }

        public function currency()
        {
            return $this->belongsTo(Currency::class);
        }

        public function products()
        {
            return $this->belongsToMany(Product::class)
                        ->withPivot(['price', 'qty', 'options']);
        }

        public function client()
        {
            return $this->belongsTo(Client::class);
        }

        public function tempClients()
        {
            return $this->belongsTo(Temp_Client_Orders::class, 'temp_client_id', 'id');
        }

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function address()
        {
            return $this->belongsTo(Address::class);
        }

        public function getFormattedProductsPriceAttribute()
        {
            return ShopHelper::price_format($this->total_price);
        }

        public function getFormattedDiscountAttribute(){
            return ShopHelper::price_format($this->discount);
        }

        public function setTransactionIdAttribute($value)
        {
            return $this->attributes['transaction_id'] = $value;
        }

        public function getPayBtn()
        {
            $btn = '';

            if ($this->order_status->default) {
                if ($this->payment->type->is(PaymentType::LIQPAY)) {
                    $lp_api_keys = ShopHelper::lp_api_keys();
                    $liqpay      = new LiqPay($lp_api_keys['lp_api_public'], $lp_api_keys['lp_api_private']);
                    $btn         = $liqpay->cnb_form([
                        'version'     => '3',
                        'public_key'  => $lp_api_keys['lp_api_public'],
                        'action'      => 'pay',
                        'order_id'    => $this->unique_id,
                        'amount'      => $this->getTotalPrice(),
                        'sandbox'     => $lp_api_keys['lp_api_sandbox'],
                        'language'    => LaravelLocalization::getCurrentLocale(),
                        'currency'    => $this->currency->code,
                        'server_url'  => route('liqpay_feedback'),
                        'result_url'  => route('frontend.page', ['alias' => 'account']) . '#orders',
                        'description' => __('frontend.liqpay_description') . $this->unique_id,
                    ]);
                }
            }

            return $btn;
        }

        public function getTotalPrice()
        {
            return $this->total_price + $this->delivery_price - $this->discount;
        }

        public function getFormattedTotalPriceAttribute()
        {
            return ShopHelper::price_format($this->getTotalPrice());
        }

        public function applyDiscount()
        {
            $price = $this->total_price;
            $user  = auth('web')->user();

            if ($user->discount && $this->discount) {
                if ($user->is_percentage) {
                    $price = $this->total_price * (1 - $user->discount / 100);
                } else {
                    $price = $this->total_price - $user->discount;
                }
            }

            return ShopHelper::price_format($price);
        }

    }
