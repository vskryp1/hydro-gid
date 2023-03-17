<?php

use App\Helpers\FilterHelper;

Route::group(['as' => 'frontend.'], function() {
        Route::get('/currency/{currency}', 'Frontend\ShopController@switchCurrency')
            ->name('switch.currency');
    });


Route::group([
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'cache-control'],
    ], function() {

	    Auth::routes(['verify' => true]);

        Route::group(['as' => 'ajax.', 'prefix' => 'ajax', 'middleware' => ['ajax', 'shopMeta']], function() {
            Route::get(
                'catalog/more/{alias}/' . FilterHelper::getStartSeparator() . '{filters?}',
                'Frontend\PageController@catalogMore'
            )
                ->where('alias', FilterHelper::getAliasRegExp())
                ->where('filters', FilterHelper::getFiltersRegExp())
                ->name('catalog.more')
                ->middleware('page');
            Route::get('page/more/{alias}', 'Frontend\PageController@pageMore')
                ->name('page.more')
                ->middleware('page');
            Route::get(
                'catalog/filter/block/{alias}/' . FilterHelper::getStartSeparator() . '{filters?}',
                'Frontend\PageController@getFilterBlock'
            )
                ->where('alias', FilterHelper::getAliasRegExp())
                ->where('filters', FilterHelper::getFiltersRegExp())
                ->name('catalog.filter.block')
                ->middleware('page');
            Route::get('fastsearch', 'Frontend\ProductController@search')
                ->name('search');
            Route::get('groups/product/{product}', 'Frontend\ProductController@getProductCard')->name('product.card');
            Route::group(['as' => 'cart.', 'prefix' => 'cart'], function () {
                Route::post('add/{product}/{count?}/' . '{options?}', 'Frontend\CartController@addToCart')
                    ->where('count', '[0-9]*')
                    ->where('options', FilterHelper::getFiltersRegExp())
                    ->name('add');
                Route::put('update/{cart_id}/{count}', 'Frontend\CartController@updateCartItem')->name('update');
                Route::delete('remove/{cart_id}', 'Frontend\CartController@removeFromCart')->name('remove');
                Route::delete('destroy', 'Frontend\CartController@destroyCart')->name('destroy');
                Route::get('delivery/{delivery}/{rendered?}', 'Frontend\CartController@changeDelivery')->name('delivery');
                Route::get('delivery_place/{delivery}/{getOnlyDeliveryPlaceIds?}', 'Frontend\CartController@searchDeliveryPlace')
                    ->name('delivery_place');
                Route::get('payment/{payment}', 'Frontend\CartController@changePayment')
                    ->name('change_payment');
                Route::get('nova_poshta_warehouses/{city}', 'Frontend\CartController@novaPoshtaWarehouses')
                    ->name('nova_poshta_warehouses');
            });

            Route::post('/user/{user_id}/put/{product}/in/wishlist', 'Frontend\ProfileController@putInWishlist')
                ->name('user.put.in.wishlist');
            Route::post('/user/{user_id}/remove/{rowId}/from/wishlist', 'Frontend\ProfileController@removeFromWishlist')
                ->name('user.remove.from.wishlist');
            Route::post('/user/{user_id}/put/{product}/in/waitinglist', 'Frontend\ProfileController@putInWaitinglist')
                ->name('user.put.in.waitinglist');
            Route::post('/user/{user_id}/remove/{rowId}/from/waitinglist', 'Frontend\ProfileController@removeFromWaitinglist')
                ->name('user.remove.from.waitinglist');
            Route::post('/user/{user_id}/put/{product}/in/comparelist', 'Frontend\ProfileController@putInComparelist')
                ->name('user.put.in.comparelist');
            Route::post('/user/{user_id}/remove/{rowId}/from/comparelist', 'Frontend\ProfileController@removeFromComparelist')
                ->name('user.remove.from.comparelist');
        });

        Route::group(['as' => 'frontend.'], function() {
            Route::group(['as' => 'forms.'], function() {
                Route::post('checkout/step1', 'Frontend\CheckoutController@storeStep1')
                    ->name('checkout.step1');
                Route::post('checkout/step2', 'Frontend\CheckoutController@storeStep2')
                    ->name('checkout.step2');
                Route::post('callback', 'Frontend\ShopController@callback')
                    ->name('callback');
                Route::post('buy-per-click', 'Frontend\ShopController@buyPerClick')
                     ->name('buy_per_click');
                Route::post('feedback', 'Frontend\ShopController@feedback')
                    ->name('feedback');
                Route::post('subscribe', 'Frontend\ShopController@subscribe')
                    ->name('subscribe');
                Route::post('/user/{user_id}/remove/category/{categoryId}/from/comparelist', 'Frontend\ProfileController@clearComparelistByCategory')
                    ->name('user.remove.category.from.comparelist');
                Route::resource('user', 'Frontend\ProfileController')
                    ->only(['update']);
                Route::post('change-password', 'Frontend\ProfileController@changePassword')
                     ->name('change_password');
                Route::resource('address', 'Frontend\AddressController')
                    ->only(['store', 'update', 'destroy']);
                Route::resource('review', 'Frontend\ReviewController')
                    ->only(['store']);
//                Route::resource('service', 'Frontend\ServiceOrderController')
//                    ->only(['store']);
            });

            Route::group(['middleware' => ['lowercase', 'shopRedirect', 'shopMeta']], function() {
                // pages with filters
                Route::get('{alias}/' . FilterHelper::getStartSeparator() . '{filters}', 'Frontend\PageController@page')
                    ->where('alias', FilterHelper::getAliasRegExp())
                    ->where('filters', FilterHelper::getFiltersRegExp())
                    ->name('page.filters')
                    ->middleware('page');

                // product page
                Route::get('{alias}-item', 'Frontend\ProductController@page')
                    ->where('alias', '[A-Za-z0-9-]+')
                    ->name('product');

                Route::get('generate/pdf/{product}', 'Frontend\ProductController@generatePdf')
                    ->name('generate.pdf');

                Route::get('stocks/{stock}', 'Frontend\StockController@details')
                    ->name('stock');

                Route::get('unsubscribe/{subscriber}', 'Frontend\ShopController@unsubscribe')
                    ->name('unsubscribe');

                Route::get('payment/{payment}/{order}', 'Frontend\CheckoutController@paymentPage')
                    ->name('payment_page');

                Route::post('callback/liqpay', 'Frontend\CheckoutController@liqpay')
                    ->name('callback.liqpay');

                Route::post('callback/privat', 'Frontend\CheckoutController@privat')
                    ->name('callback.privat');

                Route::post('callback/payparts', 'Frontend\CheckoutController@payparts')
                    ->name('callback.payparts');

                // other pages
                Route::get('{alias?}', 'Frontend\PageController@page')
                    ->where('alias', '([' . config('app.alias_chars') . ']+)')
                    ->name('page')
                    ->middleware('page');

            });
        });
    });
