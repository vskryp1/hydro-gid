<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\Client\Client;
use App\Models\Currency\Currency;
use App\Models\Order\Delivery;
use App\Models\Order\OrderStatus;
use App\Models\Order\Payment;
use App\Models\Region\Region;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class OrdersTest extends DuskTestCase
{

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testOrderCreate()
    {

        $selectUser = User::where('name', 'Саша')->first();
        $selectOrderStatus = OrderStatus::whereTranslation('name', 'In process')->first();
        $selectRegion = Region::whereTranslation('name', 'Other regions')->first();
        $selectDelivery = Delivery::whereTranslation('name', 'Delivery company')->first();
        $selectPayment = Payment::whereTranslation('name', 'LiqPay')->first();
        $selectCurrency = Currency::where('name', 'UAH')->first();
        $client = Client::onlyActive()->first(); // для выбора первого активного клиента
//        $testClient = Client::where('email', 'tester007@mail.com')->first();


        $this->browse(function (Browser $browser) use ($selectUser, $selectOrderStatus, $selectRegion, $selectDelivery, $selectPayment, $selectCurrency, $client) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(5) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(1000);
            $browser->select('select[name="user_id"]', $selectUser->id);
            $browser->select('select[name="order_status_id"]', $selectOrderStatus->id);
            $browser->select('select[name="region_id"]', $selectRegion->id);
            $browser->select('select[name="delivery_id"]', $selectDelivery->id);
            $browser->select('select[name="payment_id"]', $selectPayment->id);
            $browser->select('select[name="locale"]', 'ru');
            $browser->type('textarea[name="comment"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
            $browser->pause(500);
            $browser->clickLink('Clients');
            $browser->pause(800);
            $browser->click('#client > div > div > div:nth-child(1) > span > span.selection > span');
            $browser->click('.select2-search--dropdown > input');
            $browser->type('.select2-search--dropdown > input', $client->name);
            $browser->pause(500);
            $browser->keys('.select2-search--dropdown > input', ['{ENTER}']);
            $browser->pause(200);
            $browser->click('#products-tab');
            $browser->pause(800);
            $browser->click('#products > table > tfoot > tr:nth-child(1) > td > div > span');
            $browser->click('.select2-search--dropdown > input');
            $browser->type('.select2-search--dropdown > input', 'Тестовый товар 1'); // TODO enter first 3 letters of product sku existing in database (previously select from list)
            $browser->pause(2000);
            $browser->keys('.select2-search--dropdown > input', ['{ENTER}']);
            $browser->pause(500);
            $browser->click('#products > table > tfoot > tr:nth-child(1) > td > div > span');
            $browser->type('.select2-search.select2-search--dropdown > input', 'Тестовый товар 2');  // TODO enter first 3 letters of product sku existing in database (previously select from list)
            $browser->pause(2000);
            $browser->keys('.select2-search--dropdown > input', ['{ENTER}']);
            $browser->pause(500);
            $browser->select('select[name="currency_id"]', $selectCurrency->id);
            $browser->scrollTo(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(1000);
            $browser->assertSelected('select[name="user_id"]', $selectUser->id);
            $browser->assertSelected('select[name="order_status_id"]', $selectOrderStatus->id);
            $browser->assertSelected('select[name="region_id"]', $selectRegion->id);
            $browser->assertSelected('select[name="delivery_id"]', $selectDelivery->id);
            $browser->assertSelected('select[name="payment_id"]', $selectPayment->id);
            $browser->assertSelected('select[name="locale"]', 'ru');
            $browser->assertSeeIn('textarea[name="comment"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
            $browser->clickLink('Clients');
            $browser->pause(800);
            $browser->assertSeeIn('select[name="client_id"]', $client->name);
            $browser->click('#products-tab');
            $browser->pause(800);
            $browser->assertSeeIn('tr:nth-child(1) > td:nth-child(3) > span', 'Тестовый товар 1 (TOV1)');
            $browser->assertSeeIn('tr:nth-child(2) > td:nth-child(3) > span', 'Тестовый товар 2 (TOV2)');
            $browser->assertSelected('select[name="currency_id"]', $selectCurrency->id);
        });
    }

    public function testOrdersEdit()
    {
        $selectUser2 = User::where('name', 'Паша')->first();
        $selectOrderStatus2 = OrderStatus::whereTranslation('name', 'Payed')->first();
        $selectRegion2 = Region::whereTranslation('name', 'USA')->first();
        $selectDelivery2 = Delivery::whereTranslation('name', 'Nova poshta')->first();
        $selectPayment2 = Payment::whereTranslation('name', 'Cash')->first();
        $client = Client::onlyActive()->orderByDesc('id')->first(); // для выбора последнего активного клиента
        $client2 = Client::onlyActive()->first(); // для выбора первого активного клиента

        $this->browse(function (Browser $browser) use ($selectUser2, $selectOrderStatus2, $selectRegion2, $selectDelivery2, $selectPayment2, $client, $client2) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(5) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[3]).find(cell => cell.innerText === "' .  $client2->format_name . '").closest(\'tr\').children[8].querySelectorAll(\'a\')[1].click()');
            $browser->pause(1000);
            $browser->select('select[name="user_id"]', $selectUser2->id);
            $browser->select('select[name="order_status_id"]', $selectOrderStatus2->id);
            $browser->select('select[name="region_id"]', $selectRegion2->id);
            $browser->select('select[name="payment_id"]', $selectPayment2->id);
            $browser->select('select[name="locale"]', 'en');
            $browser->select('select[name="delivery_id"]', $selectDelivery2->id);
//            $browser->click('div:nth-child(6) > span > span.selection > span');   // todo разкомментить после фикса (#652)
//            $browser->pause(200);
//            $browser->type('.select2-search--dropdown > input', 'хар');
//            $browser->pause(1500);
//            $browser->keys('.select2-search--dropdown > input', ['{ENTER}']);
//            $browser->pause(1000);
//            $browser->click('#base > div > div > div:nth-child(7) > span > span.selection > span');
//            $browser->click('.select2-search--dropdown > input');
//            $browser->type('.select2-search--dropdown > input', '68');
//            $browser->pause(1500);
//            $browser->keys('.select2-search--dropdown > input', ['{ENTER}']);
//            $browser->pause(500);
//            $browser->click('textarea[name="comment"]');
            $browser->type('textarea[name="comment"]', 'New Lorem ipsum dolor sit amet, consectetur adipiscing elit.');
            $browser->pause(500);

            $browser->clickLink('Clients');
            $browser->pause(800);
            $browser->click('#client > div > div > div:nth-child(1) > span > span.selection > span');
            $browser->click('.select2-search--dropdown > input');
            $browser->type('.select2-search--dropdown > input', $client->name);
            $browser->pause(500);
            $browser->keys('.select2-search--dropdown > input', ['{ENTER}']);
            $browser->pause(200);
//            $browser->type('#name', 'Смазоров Роджер Валерьевич');  // todo раскомментить на тот случай если можно будет редактировать клиента в заказе
//            $browser->type('#email', 'smazo@mail.com');
//            $browser->type('#contact-number', '0997774411');
            $browser->select('#country', $selectRegion2->id);
            $browser->type('#city', 'Гагры');
            $browser->type('#address', 'пр. Тестирования 666');
            $browser->pause(200);
            $browser->scrollTo('button.btn.btn-info.text-uppercase.pull-right');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->assertSelected('select[name="user_id"]', $selectUser2->id);
            $browser->assertSelected('select[name="order_status_id"]', $selectOrderStatus2->id);
            $browser->assertSelected('select[name="region_id"]', $selectRegion2->id);
//            $browser->assertSelected('select[name="delivery_id"]', $selectDelivery2->id);  // todo раскомментить после фикса (#652)
//            $browser->assertSeeIn('div:nth-child(6) > span > span.selection > span > span:nth-child(1)', 'Харьков');
//            $browser->assertSeeIn('div:nth-child(7) > span > span.selection > span > span:nth-child(1)', 'Відділення №68 (до 30 кг): просп. Науки (ран. Леніна), 39');
            $browser->assertSelected('select[name="payment_id"]', $selectPayment2->id);
            $browser->assertSelected('select[name="locale"]', 'en');
            $browser->assertSeeIn('textarea[name="comment"]', 'New Lorem ipsum dolor sit amet, consectetur adipiscing elit.');
            $browser->click('#client-tab');
            $browser->pause(800);
//            $browser->assertValue('#name', 'Смазоров Роджер Валерьевич');  // todo раскомментить после фикса (#653)
//            $browser->assertValue('#email', 'smazo@mail.com');
//            $browser->assertValue('#contact-number', '0997774411');
            $browser->assertSelected('#country', $selectRegion2);
            $browser->assertValue('#city', 'Гагры');
            $browser->assertValue('#address', 'пр. Тестирования 666');
            $browser->assertSeeIn('select[name="client_id"]', $client->name);
            $browser->click('#products-tab');
            $browser->pause(800);
            $browser->click('tr:nth-child(1) > td:nth-child(1) > button');
            $browser->pause(800);
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->driver->findElement(WebDriverBy::cssSelector('#confirmBtnYes'))
                    ->click();
            });
            $browser->pause(1000);
            $browser->click('#products > table > tfoot > tr:nth-child(1) > td > div > span');
            $browser->click('.select2-search--dropdown > input');
            $browser->type('.select2-search--dropdown > input', 'Тестовый товар 3'); // TODO enter first 3 numders of product existing in database (previously select from list)
            $browser->pause(2000);
            $browser->keys('.select2-search--dropdown > input', ['{ENTER}']);
            $browser->pause(500);
            $browser->scrollTo('button.btn.btn-info.text-uppercase.pull-right');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(1500);
            $browser->assertSee('Success');
            $browser->pause(200);
            $browser->click('#products-tab');
            $browser->pause(800);
            $browser->assertSeeIn('tr:nth-child(1) > td:nth-child(3) > span', 'Тестовый товар 2 (TOV2)');
            $browser->assertSeeIn('tr:nth-child(2) > td:nth-child(3) > span', 'Тестовый товар 3 (TOV3)');

        });
    }

    public function testOrdersDelete()
    {

        $client = Client::onlyActive()->orderByDesc('id')->first(); // для выбора последнего активного клиента

        $this->browse(function (Browser $browser) use ($client){
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(5) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(2000);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[3]).find(cell => cell.innerText === "'.$client->format_name.'").closest(\'tr\').children[8].querySelectorAll(\'a\')[0].click()');
            $browser->pause(1000);
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->driver->findElement(WebDriverBy::cssSelector('#confirmBtnYes'))
                    ->click();
            });
            $browser->pause(200);
            $browser->assertSee('Success');
            $browser->pause(200);
        });
    }
}

