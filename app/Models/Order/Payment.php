<?php

    namespace App\Models\Order;

    use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
    use Astrotomic\Translatable\Translatable;
    use App\Enums\PaymentType;
    use App\Models\Region\Region;
    use App\Traits\UuidTrait;
    use BenSampo\Enum\Traits\CastsEnums;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Payment extends Model implements TranslatableContract
    {
        use UuidTrait, Translatable, SoftDeletes, CastsEnums {
            Translatable::setAttribute insteadof CastsEnums;
            Translatable::setAttribute as public translatableSetAttribute;
            CastsEnums::setAttribute as public castsEnumsSetAttribute;
        }

        public $enumCasts = [
            'type' => PaymentType::class,
        ];

        public $dates = [
            'deleted_at',
        ];

        public $fillable = [
            'is_active',
            'is_default',
            'type',
            'api_key_public',
            'api_key_private',
            'api_key_sandbox',
            'position',
        ];

        public $translatedAttributes = [
            'name',
        ];

        public $with = [
            'translations',
        ];

        public $useTranslationFallback = true;

        public function regions()
        {
            return $this->belongsToMany(Region::class);
        }

        public function getApiKeyPublicAttribute($value)
        {
            return $value != '' ? $value : config('app.lp_api_public');
        }

        public function getApiKeyPrivateAttribute($value)
        {
            return $value != '' ? $value : config('app.lp_api_private');
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
