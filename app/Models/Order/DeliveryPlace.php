<?php

    namespace App\Models\Order;

    use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
    use Astrotomic\Translatable\Translatable;
    use App\Traits\UuidTrait;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class DeliveryPlace extends Model implements TranslatableContract
    {
        use UuidTrait, Translatable, SoftDeletes;

        public $dates = [
            'deleted_at',
        ];

        public $fillable = [
            'is_active',
            'is_default',
            'delivery_id',
            'original_price',
            'price',
            'position',
            'api_id',
        ];

        public $translatedAttributes = [
            'name',
            'description',
        ];

        public $with = [
            'translations',
        ];

        public $useTranslationFallback = true;

        public function delivery()
        {
            return $this->belongsTo(Delivery::class);
        }

        public function scopeByPosition(Builder $query)
        {
            return $query->orderBy('position');
        }

        public function scopeOnlyActive(Builder $query)
        {
            return $query->where('is_active', true);
        }

        public function getDeliveryOptionAttribute()
        {
            return [$this->api_id => $this->name];
        }

        public function getDeliveryPlaceAttribute()
        {
            return [$this->id => $this->name];
        }
    }
