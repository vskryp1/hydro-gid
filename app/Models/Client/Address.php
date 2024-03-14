<?php

namespace App\Models\Client;

use App\Helpers\ShopHelper;
use App\Models\Order\DeliveryPlace;
use App\Models\Region\Region;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use LisDev\Delivery\NovaPoshtaApi2;

class Address extends Model
{
    use UuidTrait;

    public $timestamps = false;

    public $fillable = [
        'client_id',
        'city',
        'place_id',
        'street',
        'house',
        'temp_client_id',
    ];

    public $appends = [
        'formatted',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function delivery_place()
    {
        return $this->belongsTo(DeliveryPlace::class, 'place_id');
    }

    public function getFormattedAttribute()
    {
        $formatAddress = [
            $this->house,
            $this->street,
            $this->city,
        ];

        if (!$this->city) {
            $formatAddress[] = $this->delivery_place->name;
        }

        if ($this->region) {
            $formatAddress[] = $this->region->name;
        }

        return collect($formatAddress)->filter()->reverse()->implode(', ');
    }

    public function setCityName()
    {
        $locale = App::getLocale();
        $np = new NovaPoshtaApi2(ShopHelper::np_api_key(), $locale);
        $cities = $np->getCities(0, '', $this->place_id);
        if ($cities) {
            foreach ($cities['data'] as $city) {
                $name = $locale == 'ru' && isset($city['DescriptionRu'])
                    ? $city['DescriptionRu']
                    : $city['Description'];
                if($city['Ref'] == $this->place_id){
                    $this->update(['city' => $name]);
                }
            }
        }
    }
}
