<?php

namespace App\Helpers;

use App\Enums\DeliveryType;
use App\Models\Currency\Currency;
use App\Models\Order\Delivery;
use App\Models\Order\Payment;
use App\Models\Page\Page;
use App\Models\Product\Product;
use App\Models\SettingModel;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Setting;
use App\Enums\PaymentType;

class ShopHelper
{
    public static function setting($key, $default = '', $lang = '')
    {
        $locale = app()->getLocale();

        return Cache::tags(['settings'])
                    ->remember(
                        'settings.' . md5($key . serialize($default) . $lang . $locale),
                        config('app.cache_minutes'),
                        function () use ($key, $default, $lang, $locale) {
                            if ($lang === false) {
                                return Setting::get($key, $default);
                            } elseif ($lang !== '') {
                                return Setting::lang($lang)->get($key, $default);
                            } else {
                                $setting = SettingModel::where('key', $key)
	                                ->settingByLocale($locale)
	                                ->first();

                                return $setting->value ?? $default;
                            }
                        }
                    );
    }

    public static function languages($name = false, $all = false)
    {
        return Cache::tags(['settings'])
            ->remember(
                'languages',
                config('app.cache_minutes'),
                function() use ($name, $all) {
                    $locales = self::setting('locales', [], false);

                    if (!$all) {
                        unset($locales[app()->getLocale()]);
                    }

                    foreach ($locales as $key => $locale) {
                        if ($name) {
                            $locales[$key] = $locale[$name];
                        } else {
                            $locales[$key]['id'] = strtoupper($locale['id']);
                        }
                    }

                    return $locales;
                }
            );
    }

    public static function buyble_price($price)
    {
        return self::price_format(self::price_convert($price), true);
    }

    public static function price_format($price, $clear = false)
    {
        $price = number_format(
            $price,
            config('app.price_format.decimals'),
            config('app.price_format.decimal_point'),
            config('app.price_format.thousand_seperator')
        );

        $price = rtrim(rtrim($price, '0'), config('app.price_format.decimal_point'));

        return $clear ? str_replace([config('app.price_format.thousand_seperator'), ' '], '', $price) : $price;
    }

    public static function getAmount($money)
    {

        switch(mb_substr_count($money,',')):
            case 1: $money = mb_substr_count($money,'.') > 0 ? str_ireplace(',', '', $money) : str_ireplace(',', '.', $money);
                break;
            case 2: $money = mb_substr_count($money,'.') > 0 ? preg_replace('/,/','', $money, 2) : str_replace(',','.', preg_replace('/,/','', $money, 1));
                break;
            case 3: $money = mb_substr_count($money,'.') > 0 ? preg_replace('/,/','', $money, 3) :  str_replace(',','.', preg_replace('/,/','', $money, 2));
                break;
            case 4: $money = mb_substr_count($money,'.') > 0 ? preg_replace('/,/','', $money, 4) :  str_replace(',','.', preg_replace('/,/','', $money, 3));
                break;
        endswitch;
        return round((float)$money,2);
    }

    public static function total_price($price, $qty)
    {
    	$total_price = $price * $qty;

    	return self::price_format($total_price);
    }

    public static function price_convert($price, $from = null, $to = null)
    {
        $from = $from ?? self::default_currency();

        $to   = $to ?? self::current_currency();

        if ($to->default) {

            /** convert to default currency */
            $price = $price / $from->course->course;
        } elseif ($from->default) {
            /** convert from default currency */

            $price = $price * $to->course->course;
        } else {
            /** convert if currency to and currency from isn`t default currency */
            $price = $price / $from->course->course * $to->course->course;
        }

        return $price;
    }

    public static function feedback_emails()
    {
        return Cache::tags(['users'])
                    ->remember(
                        'feedback_emails',
                        config('app.cache_minutes'),
                        function () {
                            return User::whereNotification(true)
                                       ->onlyActive()
                                       ->get();
                        }
                    );
    }

    public static function currencies()
    {
        return Cache::tags(['currencies'])
                    ->remember(
                        'currencies.list',
                        config('app.cache_minutes'),
                        function () {
                            return Currency::with('course')
                                           ->onlyActive()
                                           ->byPosition()
                                           ->get();
                        }
                   );
    }

    public static function current_currency()
    {
        $currency = session()->get('currency', 'default');

        $currency = Cache::tags(['currencies'])
                         ->remember(
                             'current_currency.' . $currency,
                             config('app.cache_minutes'),
                             function () use ($currency) {
                                 return Currency::where('code','UAH')
                                                ->with('course')
                                                ->onlyActive()
                                                ->byDefault()
                                                ->byPosition()
                                                ->first();
                             }
                         );

        if (!is_null($currency)) {
            session()->put('currency', $currency->id);
        }

        return $currency;
    }

    public static function default_currency()
    {
        $currency = Cache::tags(['currencies'])
                         ->remember(
                             'default_currency.default',
                             config('app.cache_minutes'),
                             function () {
                                 return Currency::with('course')
                                                ->byDefault()
                                                ->byPosition()
                                                ->first();
                             }
                         );
        return $currency;
    }

    public static function current_delivery()
    {
        $delivery = session()->get('delivery', 'default');

        $delivery = Cache::tags(['deliveries'])
                         ->remember(
                             'deliveries.' . $delivery,
                             config('app.cache_minutes'),
                             function () use ($delivery) {
                                 return Delivery::onlyActive()
                                                ->orderByRaw('FIELD(id , "' . $delivery . '") DESC')
                                                ->orderByDesc('is_default')
                                                ->byPosition()
                                                ->first();
                             }
                         );

        if (!is_null($delivery)) {
            session()->put('delivery', $delivery->id);
        }

        return $delivery;
    }

    public static function current_payment()
    {
        $payment = session()->get('payment', 'default');

        $payment = Cache::tags(['payments'])
                        ->remember(
                            'payments.' . $payment,
                            config('app.cache_minutes'),
                            function () use ($payment) {
                                return Payment::onlyActive()
                                              ->orderByRaw('FIELD(id , "' . $payment . '") DESC')
                                              ->orderByDesc('is_default')
                                              ->byPosition()
                                              ->first();
                            }
                        );

        if (!is_null($payment)) {
            session()->put('payment', $payment->id);
        }

        return $payment;
    }

    public static function np_api_key()
    {
        $np_api_key = Cache::tags(['deliveries'])
                           ->remember(
                               'np_api_key',
                               config('app.cache_minutes'),
                               function () {
                                   return Delivery::onlyActive()
                                                  ->whereType(DeliveryType::PICKUP_NP)
                                                  ->first();
                               }
                           );

        return $np_api_key ? $np_api_key->api_key : config('app.np_api_key');
    }

    public static function lp_api_keys()
    {
        $lp_api_keys = Cache::tags(['payments'])
                            ->remember(
                                'lp_api_keys',
                                config('app.cache_minutes'),
                                function () {
                                    return Payment::onlyActive()
                                                  ->whereType(PaymentType::LIQPAY)
                                                  ->first();
                                }
                            );

        return $lp_api_keys
            ? [
                'lp_api_public'  => $lp_api_keys->api_key_public,
                'lp_api_private' => $lp_api_keys->api_key_private,
                'lp_api_sandbox' => $lp_api_keys->api_key_sandbox,
            ]
            : [
                'lp_api_public'  => config('app.lp_api_public'),
                'lp_api_private' => config('app.lp_api_private'),
                'lp_api_sandbox' => config('app.lp_api_sandbox'),
            ];
        }

        public static function getPayments()
        {
            return Cache::tags(['payments'])
                        ->remember(
                            'payments.' . md5(uniqid()),
                            config('app.cache_minutes'),
                            function() {
                                return Payment::onlyActive()
                                              ->byPosition()
                                              ->get();
                            }
                        );
        }

        public static function getDeliveries()
        {
            return Cache::tags(['deliveries'])
                        ->remember(
                            'deliveries.' . md5(uniqid()),
                            config('app.cache_minutes'),
                            function() {
                                return Delivery::onlyActive()
                                               ->byPosition()
                                               ->get();
                            }
                        );
        }

        public static function getPriceRange()
        {
            return Cache::tags(['products', 'currencies'])
                        ->remember(
                            'price_range',
                            config('app.cache_minutes'),
                            function() {
                                $default_currency = self::default_currency();
                                $products         = Product::onlyActive()->where('price', '>=', 0);

                                return collect(
                                    [
                                        self::price_format($products->min('price')) . $default_currency->sign,
                                        self::price_format($products->max('price')) . $default_currency->sign,
                                    ]
                                )->implode(' - ');
                            }
                        );
        }

    public static function getSchedule($short = false)
    {
        return Cache::tags(['settings'])
            ->remember(
                'schedule_' . $short,
                config('app.cache_minutes'),
                function() use ($short) {
                    $schedule = json_decode(self::setting('schedule'), true);
                    if ($short && $schedule && is_array($schedule)) {
                        array_pop($schedule);
                        foreach ($schedule as $key => $item) {
                            $schedule[$key] = $item['day'] . ' : ' . $item['time'];
                        }
                        $schedule = implode(' | ', $schedule);
                    }

                    return $schedule;
                }
            );
    }

    /**
     * @return Collection
     */
    public static function getServices()
    {
        return Cache::tags(['services'])
                    ->remember(
                        'services_' . App::getLocale(),
                        config('app.cache_minutes'),
                        function () {
                            return Page::byPosition()
                                       ->whereHas('page_template', function ($q) {
                                           $q->where('folder', 'service');
                                       })
                                       ->with('additional_field_values')
	                                   ->onlyActive()
                                       ->get();
                        }
                    );
    }

    /**
     * @return Collection
     */
    public static function getMainServices()
    {
        return Cache::tags(['services'])
                    ->remember(
                        'services_' . App::getLocale(),
                        config('app.cache_minutes'),
                        function () {
                            return Page::byPosition()
                                       ->whereHas('page_template', function ($q) {
                                           $q->where('folder', 'service');
                                       })
                                       ->whereHas('additional_field_values', function ($q) {
                                           $q->whereTranslation('value', 1, App::getLocale());
                                       })
                                       ->get();
                        }
                    );
    }

    public static function isJSON($string)
    {
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE)
            ? true
            : false;
    }

    public static function getTotalPrice($client, $order)
    {
        $discount = $client->discount;

        if ($client->is_percentage) {
            $discount = $client->discount / 100 * $order->total_price;
        }

        return self::price_format($order->total_price - $discount + $order->delivery_price);
    }

    public static function getLogoUrl($position)
    {
        $locale = App::getLocale();

        return asset("assets/frontend/images/$position-logo.svg");
    }

    public static function getFormatPhone($key)
    {
        return Cache::tags(['settings'])
            ->remember(
                $key,
                config('app.cache_minutes'),
                function() use ($key) {
                    return preg_replace('/[^0-9]/', '', self::setting($key));
                }
            );
    }
}
