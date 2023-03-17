<?php


    namespace App\Models\Order;


    use App\Models\Product\Product;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Str;

    class OneClickOrders extends Model
    {
        use UuidTrait;

        public $fillable = [
          'name',
          'phone',
          'product_id',
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

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function product()
        {
            return $this->belongsTo(Product::class);
        }
    }