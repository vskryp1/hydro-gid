<?php

namespace App\Helpers;

use App\Models\Product\Product;
use App\Models\Product\ProductWarranty;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CartHelper
{

    public static function getResponsePopup(array $attributes = []): array
    {
        return [
            'content' => view('frontend.elements.modules.cart.content', $attributes)->render(),
            'title'   => view('frontend.elements.modules.cart.title', $attributes)->render(),
            'footer'  => view('frontend.elements.modules.cart.footer', $attributes)->render(),
            //                'reditect' => Cart::instance('default')->count() <= 0 ? route(config('app.')),
        ];
    }

    public static function refreshCartBD()
    {
        if (auth('web')->user()) {
            DB::table('carts')
              ->whereIdentifier(auth('web')->id())
              ->delete();

            Cart::store(auth('web')->id());
        }
    }

    public static function totalProductsPrice($allowApplyDiscount = false)
    {
        $sum                      = self::content()->reduce(
            function ($totalPrice, CartItemWrapper $cartItem) use ($allowApplyDiscount) {
                $totalPrice += $cartItem->getSumPriceByPosition($allowApplyDiscount);
                return $totalPrice;
            },
            0
        );

        return $sum;
    }

    public static function totalProductsPriceFormatted($allowApplyDiscount = false)
    {
        return ShopHelper::price_format(self::totalProductsPrice($allowApplyDiscount));
    }

    public static function getDiscount()
    {
        return self::total() - self::total(true) ? : 0;
    }

    public static function total($allowApplyDiscount = false)
    {
        return self::totalProductsPrice($allowApplyDiscount) + self::getDeliveryPrice();
    }

    public static function getTotalFormatted()
    {
        return ShopHelper::price_format(self::total(true));
    }

    public static function getPaymentTotalFormatted()
    {
        return ShopHelper::price_format(self::total(true), true);
    }

    public static function getDeliveryPrice()
    {
        return ShopHelper::current_delivery()->converted_price;
    }

    public static function content()
    {
        $cartContent = Cart::instance('default')->content();

        $products = Cache::tags('products')
                         ->remember(
                             'cart_products.' . md5($cartContent),
                             config('app.cache_minutes'),
                             function () use ($cartContent) {
                                 return Product::onlyActive()
                                               ->with(
                                                   ['images.translations', 'option_filters.translations', 'currency']
                                               )
                                               ->whereIn('id', $cartContent->pluck('id'))
                                               ->get();
                             }
                         );
        $warranties = Cache::tags('warranties')
                         ->remember(
                             'warranties.' . md5($cartContent),
                             config('app.cache_minutes'),
                             function () use ($cartContent) {
                                 return ProductWarranty::onlyActive()
                                               ->whereIn('id', $cartContent->pluck('options.warranty_id'))
                                               ->get();
                             }
                         );


        $content = $cartContent->map(
            function (CartItem $cartItem) use ($products, $warranties) {
                $cartItem->model    = $products->where('id', $cartItem->id)->first();
                $cartItem->warranty = $warranties->firstWhere(
                    'id', $cartItem->options->warranty_id
                );

                return new CartItemWrapper($cartItem);
            }
        );

        return $content;
    }

    public static function getProductsForOrder()
    {
        $items = [];
        foreach (self::content() as $item) {
            $items[] = [
                'product_id' => $item->id,
                'qty'        => $item->qty,
                'price'      => $item->model->converted_price,
                'options'    => $item->getOptionsForOrder(),
            ];
        }

        return $items;
    }
}
