<?php

namespace Tests\Browser;

use App\Models\Client\Client;
use App\Models\Filters\FilterValue;
use App\Models\Order\Order;
use App\Models\Product\ProductStatus;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Support\Facades\Mail;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Mail\Frontend\NewOrderMail;


class ProductOrderTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testProductOrder()
    {
        $productSort = ProductStatus::whereTranslation('name', 'Хит сезона')->first();
        $clientLogin = Client::where('email', 'moeller080@gmail.com')->first();

        //Client::where('email', 'moeller080@gmail.com')->update(['password'=>bcrypt{123456}]);

        //Client::where('email', 'moeller080@gmail.com')->delete();

        $this->browse(/**
         * @param Browser $browser
         */
            function (Browser $browser) use ($productSort, $clientLogin) {
                $browser->visit('/')
                    ->maximize()

//                                Логин
                    ->clickLink('Вход')
                    ->pause(1000)
                    ->type('email', $clientLogin->email)
                    ->type('password', '123456')
                    ->press('Вход')
                    ->pause(500)
//                           следующий выбор категории только для Inarima
                    ->mouseover('.desctop-products-btn')
                    ->mouseover('li.drop-down:nth-child(1)')
                    ->mouseover('li.category.has-child:nth-child(3)')
                    ->mouseover('ul > li:nth-child(1) > div > ul > li.category.has-child > div > ul > li:nth-child(1)')
                    ->clickLink('Масло для волос')
                    ->assertSee('Масло для волос')
//                          сортировка
//                    ->select('sort', $productSort->id)
//                    ->assertSeeIn('div.product-item:nth-child(3) > div > div.product-item__name > a', 'Тестовый товар "test-product" 100+55')
////                            фильтры
//                    ->type('#minCost', '100')
//                    ->type('#maxCost', '8000')
//                    ->press('Применить')
//                    ->check('#mCSB_1_container > ul > li:nth-child(1) > label')
//                    ->check('#mCSB_1_container > ul > li:nth-child(2) > label')
//                    ->scrollTo('.fieldset-btn')
//                    ->check('#mCSB_2_container > ul > li:nth-child(1) > label')
//                    ->assertSeeIn('div.product-item:nth-child(1) > div > div.product-item__name > a', 'Тестовый товар')
//                            оформление с доставкой Самовывоз с проверкой в корзине
//                    ->clickLink('Тестовый товар')
                    ->mouseover('div.product-item:nth-child(1) > div > div.product-item__name > a')
                    ->pause(1000)
                    ->press('Добавить в корзину')
                    ->pause(1000)
                    ->assertSeeIn('div.cart-list div.cart-list__item > div.product-name', 'Тестовый товар (1)')
                    ->clickLink('Оформить')
                    ->assertValue('div.cart-item__content > div.amount > input', '1')
                    ->scrollTo('.heading')
                    ->click('#deliveryList > div > div:nth-child(4) > div.form-check > label')
                    ->pause(1000)
                    ->press('Подтвердить заказ')
                    ->pause(1000)
                    ->assertSee('Спасибо за заказ');
//                    $order = Order::latest()->first();
//Mail::fake();
//Mail::send('frontend.mails.orders.index', compact('order'));

//Mail::assertSent(NewOrderMail::class, function ($mail) use ($order) {
//    dd($order);
//    return $mail->order->id === $order->id;
//});
//                              Л/К заказы
//                    ->clickLink('Профиль')
//                    ->clickLink('История заказов')
//                    ->pause(1000)
//                    ->clickLink('Тестовый товар')
////                                  добавление товара в корзину с изменением кол-ва, проверкой и удалением
//                    ->pause(1000)
//                    ->click('div.amount > span.js-plus.btn-count.btn-plus')
//                    ->press('Добавить в корзину')
//                    ->pause(1500)
//                    ->assertSeeIn('div.cart-list div.cart-list__item > div.product-name', 'Тестовый товар (2)')
//                    ->clickLink('Редактировать')
//                    ->pause(1000)
//                    ->clickLink('Удалить')
//                    ->pause(500)
//                    ->clickLink('Продолжить покупку')
//                    ->pause(500)
//                    ->click('div.product-details > ul > li:nth-child(2) > label')
//                    ->click('div.amount > span.js-plus.btn-count.btn-plus')
//                    ->click('div.amount > span.js-plus.btn-count.btn-plus')
//                    ->press('Добавить в корзину')
//                    ->pause(1000)
//                    ->assertSeeIn('div.cart-list div.cart-list__item > div.product-name', 'Тестовый товар (4)')
//                    ->pause(500)
//                    ->clickLink('Оформить')
//                    ->assertValue('div.cart-item__content > div.amount > input', '4')
//                    ->click('div.cart-list > div > div.cart-item__content > div.amount > span.js-minus.btn-count.btn-minus')
//                    ->click('div.cart-list > div > div.cart-item__content > div.amount > span.js-minus.btn-count.btn-minus')
//                    ->assertValue('div.cart-item__content > div.amount > input', '2')
////                                    оформление заказа с доставкой "Новая почта" и проверка цены за доствку
//                    ->scrollTo('.heading')
//                    ->click('#deliveryList > div > div:nth-child(3) > div.form-check > label')
//                    ->pause(500)
//                    ->assertSeeIn('#deliveryList > div > div:nth-child(3) > div.form-check > label > span > span', '20.00 $')
//                    ->assertSeeIn('div.total-list-wrap > ul > li:nth-child(2) > span', '20.00 $')
//                    ->click('div.js_places > div:nth-child(1) > div > span > span.selection > span')
//                    ->pause(500)
//                    ->type('span > span > span.select2-search.select2-search--dropdown > input', 'Харьков')
//                    ->pause(1000)
//                    ->keys('span > span > span.select2-search.select2-search--dropdown > input', ['{enter}'])
//                    ->pause(2000)
//                    ->click('div.js_places > div:nth-child(2) > div > span > span.selection > span')
//                    ->type('span.select2-search.select2-search--dropdown > input', '72')
//                    ->pause(500)
//                    ->keys('span.select2-search.select2-search--dropdown > input', ['{enter}'])
//                    ->press('Подтвердить заказ')
//                    ->assertSee('Спасибо за заказ')
////                            Л/К заказы проверка цены за доставку "Новая почта"
//                    ->clickLink('Профиль')
//                    ->clickLink('История заказов')
//                    ->pause(500)
//                    ->assertSeeIn('div.order-list > div:nth-child(1) > table > tbody > tr:nth-child(3) > td.count', 'Доставка')
//                    ->assertSeeIn('div.order-list > div:nth-child(1) > table > tbody > tr:nth-child(3) > td.price', '20.00 $')
////                                оформление с доставкой "Компания доставки" и проверка цены за доствку
//                    ->clickLink('Тестовый товар')
//                    ->pause(500)
//                    ->press('Добавить в корзину')
//                    ->pause(1000)
////                    ->assertSeeIn('div.cart-list div.cart-list__item > div.product-name', 'Тестовый товар (1)')
//                    ->clickLink('Оформить')
////                    ->assertValue('div.cart-item__content > div.amount > input', '1')
//                    ->scrollTo('.heading')
//                    ->click('#deliveryList > div > div:nth-child(2) > div.form-check > label')
//                    ->pause(500)
//                    ->assertSeeIn('#deliveryList > div > div:nth-child(2) > div.form-check > label > span > span', '10.00 $')
//                    ->assertSeeIn('div.total-list-wrap > ul > li:nth-child(2) > span', '10.00 $')
//                    ->pause(1000)
//                    ->press('Подтвердить заказ')
//                    ->pause(1000)
//                    ->assertSee('Спасибо за заказ')
////                                Л/К заказы проверка цены за доставку "Компания доставки"
//                    ->clickLink('Профиль')
//                    ->clickLink('История заказов')
//                    ->pause(500)
//                    ->assertSeeIn('div.order-list > div:nth-child(1) > table > tbody > tr:nth-child(3) > td.count', 'Доставка')
//                    ->assertSeeIn('div.order-list > div:nth-child(1) > table > tbody > tr:nth-child(3) > td.price', '10.00 $')
//                    ->clickLink('Выход')
//                    ->pause(4000);
            });

    }


}