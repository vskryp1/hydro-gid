<?php

    namespace App\Models\Order;

    use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
    use Astrotomic\Translatable\Translatable;
    use App\Enums\DeliveryType;
    use App\Helpers\ShopHelper;
    use App\Models\Currency\Currency;
    use App\Models\Region\Region;
    use App\Traits\UuidTrait;
    use BenSampo\Enum\Traits\CastsEnums;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Delivery extends Model implements TranslatableContract
    {
        use Translatable, UuidTrait, SoftDeletes, CastsEnums {
            Translatable::setAttribute insteadof CastsEnums;
            Translatable::setAttribute as public translatableSetAttribute;
            CastsEnums::setAttribute as public castsEnumsSetAttribute;
        }

        public $enumCasts = [
            'type' => DeliveryType::class,
        ];

        public $casts = [
            'fields'          => 'array',
            'required_fields' => 'array',
        ];

        public $dates = [
            'deleted_at',
        ];

        public $fillable = [
            'is_active',
            'is_default',
            'type',
            'api_key',
            'currency_id',
            'original_price',
            'price',
            'fields',
            'required_fields',
            'position',
        ];

        public $translatedAttributes = [
            'name',
            'description',
        ];

        public $with = [
            'translations',
        ];

        public $useTranslationFallback = true;

        public function regions()
        {
            return $this->belongsToMany(Region::class);
        }

        public function delivery_places()
        {
            return $this->hasMany(DeliveryPlace::class);
        }

        public function currency()
        {
            return $this->belongsTo(Currency::class);
        }

        public function getFormatPriceAttribute()
        {
            return ShopHelper::price_format($this->converted_price);
        }

        public function getConvertedPriceAttribute()
        {
            return ShopHelper::price_convert($this->original_price, $this->currency);
        }

        public function scopeByPosition(Builder $query)
        {
            return $query->orderBy('position');
        }

        public function scopeOnlyActive(Builder $query)
        {
            return $query->where('is_active', true);
        }
    }
