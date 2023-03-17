<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\Currency\Currency;
use App\Models\Filters\FilterValue;
use App\Models\Filters\FilterValueTranslation;
use App\Models\Product\Product;
use App\Models\Product\ProductStatus;
use App\Models\Seo\Sitemap;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testProductCreate()
    {

        $currency = Currency::where('name', 'USD')->first();
        $stat = ProductStatus::whereTranslation('name', 'Action')->first();
        $filterValue = FilterValue::whereTranslation('name', '100 Ml')->first();
        $filterValue3 = FilterValue::whereTranslation('name', 'Украина')->first();
        $filterValue4 = FilterValue::whereTranslation('name', 'Fiole')->first();
        $filterValue5 = FilterValue::whereTranslation('name', 'Без сульфатов')->first();

        $this->browse(function (Browser $browser) use ($currency, $stat, $filterValue, $filterValue3, $filterValue4, $filterValue5){
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(3) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(1000);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))  //кнопка Создать
            ->click();
            $browser->pause(500);
            $browser->type('input[name="alias"]', 'lipstick0');
            $browser->type('sku', '000111');
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div:nth-child(3) > div > label > span'))
                ->click();
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div:nth-child(4) > div > label > span'))
                ->click();
            $browser->type('position', '11');
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div:nth-child(5) > div > label > span'))
                ->click();
            $browser->type('original_price_old', '1500');
            $browser->type('original_price', '1000');
            $browser->type('rating', '4');
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div:nth-child(6) > div > label > span'))
                ->click();
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div:nth-child(7) > div > label > span'))
                ->click();
            $browser->scrollTo('#base > div > div > div > div:nth-child(7) > div > label > span');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div:nth-child(8) > div > label > span'))
                ->click();
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div:nth-child(9) > div > label > span'))
                ->click();
            $browser->click('#base > div > div > div > div:nth-child(11) > span');
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div:nth-child(11) > div > label > span'))
                ->click();
            $browser->select('select[name="currency_id"]',$currency->id);
            $browser->select('select[name="product_status_id"]',$stat->id);
            $browser->type("#base > div > div > div > div:nth-child(10) > span > span.selection > span > ul > li > input", 'Тестовый товар 1');
            $browser->pause(1500);
            $browser->keys('#base > div > div > div > div:nth-child(10) > span > span.selection > span > ul > li > input', ['{ENTER}']);
            $browser->pause(500);
            // todo раскомментировать после фикса (#634)
//            $browser->type("#base > div > div > div > div:nth-child(10) > span > span.selection > span > ul > li > input", 'Тестовый товар 2');
//            $browser->pause(1000);
//            $browser->keys('#base > div > div > div > div:nth-child(10) > span > span.selection > span > ul > li > input', ['{ENTER}']);
//            $browser->pause(500);

            $browser->clickLink('Categories');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('#categories > div > div > div > div:nth-child(1) > div > label > span'))
                ->click();
            $browser->pause(200);
            $browser->type('#categories > div > div > div > div:nth-child(1) > span > span.selection > span > ul > li > input', 'Indelible care');
            $browser->pause(500);
            $browser->keys('#categories > div > div > div > div:nth-child(1) > span > span.selection > span > ul > li > input', ['{ENTER}']);
            $browser->type('#categories > div > div > div > div:nth-child(1) > span > span.selection > span > ul > li > input', 'Hair shampoos');
            $browser->pause(500);
            $browser->keys('#categories > div > div > div > div:nth-child(1) > span > span.selection > span > ul > li > input', ['{ENTER}']);

            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#locales-ru > div:nth-child(1) > div > label > span'))
                ->click();
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'название товара');
            $browser->driver->findElement(WebDriverBy::cssSelector('#locales-ru > div:nth-child(2) > div > label > span'))
                ->click();
            $browser->pause(200);
            $browser->type('textarea[name="ru[introtext]"]', 'интротекст товара');
            $browser->driver->findElement(WebDriverBy::cssSelector('#locales-ru > div:nth-child(3) > div > label > span'))
                ->click();
            $browser->pause(200);
            $browser->type('textarea[name="ru[description]"]', 'описание товара');
            $browser->pause(500);
            $browser->click('#locale-en-tab');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#locales-en > div:nth-child(1) > div > label > span'))
                ->click();
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'product name');
            $browser->driver->findElement(WebDriverBy::cssSelector('#locales-en > div:nth-child(2) > div > label > span'))
                ->click();
            $browser->pause(200);
            $browser->type('textarea[name="en[introtext]"]', 'product introtext');
            $browser->driver->findElement(WebDriverBy::cssSelector('#locales-en > div:nth-child(3) > div > label > span'))
                ->click();
            $browser->pause(200);
            $browser->type('textarea[name="en[description]"]', 'product description');
            $browser->pause(500);

            $browser->click('#seo-tab');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#seo-locales-ru > div:nth-child(1) > div > label > span'))
                ->click();
            $browser->type('input[name="ru[seo_title]"]', 'сео загловок');
            $browser->driver->findElement(WebDriverBy::cssSelector('#seo-locales-ru > div:nth-child(2) > div > label > span'))
                ->click();
            $browser->type('input[name="ru[seo_keywords]"]', 'сео ключевые слова');
            $browser->driver->findElement(WebDriverBy::cssSelector('#seo-locales-ru > div:nth-child(3) > div > label > span'))
                ->click();
            $browser->type('input[name="ru[seo_description]"]', 'сео описаие');
            $browser->driver->findElement(WebDriverBy::cssSelector('#seo-locales-ru > div:nth-child(4) > div > label > span'))
                ->click();
            $browser->type('input[name="ru[seo_canonical]"]', 'сео каноникал');
            $browser->driver->findElement(WebDriverBy::cssSelector('#seo-locales-ru > div:nth-child(5) > div > label > span'))
                ->click();
            $browser->type('input[name="ru[seo_robots]"]', 'сео роботс');
            $browser->driver->findElement(WebDriverBy::cssSelector('#seo-locales-ru > div:nth-child(6) > div > label > span'))
                ->click();
            $browser->type('textarea[name="ru[seo_content]"]', 'сео контент');
            $browser->click('#seo-locales-en-tab');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#seo-locales-en > div:nth-child(1) > div > label > span'))
                ->click();
            $browser->type('input[name="en[seo_title]"]', 'seo title');
            $browser->driver->findElement(WebDriverBy::cssSelector('#seo-locales-en > div:nth-child(2) > div > label > span'))
                ->click();
            $browser->type('input[name="en[seo_keywords]"]', 'seo keywords');
            $browser->driver->findElement(WebDriverBy::cssSelector('#seo-locales-en > div:nth-child(3) > div > label > span'))
                ->click();
            $browser->type('input[name="en[seo_description]"]', 'seo description');
            $browser->driver->findElement(WebDriverBy::cssSelector('#seo-locales-en > div:nth-child(4) > div > label > span'))
                ->click();
            $browser->type('input[name="en[seo_canonical]"]', 'seo canonical');
            $browser->driver->findElement(WebDriverBy::cssSelector('#seo-locales-en > div:nth-child(5) > div > label > span'))
                ->click();
            $browser->type('input[name="en[seo_robots]"]', 'seo robots');
            $browser->driver->findElement(WebDriverBy::cssSelector('#seo-locales-en > div:nth-child(6) > div > label > span'))
                ->click();
            $browser->type('textarea[name="en[seo_content]"]', 'seo content');

            $browser->clickLink('Filters');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#filters > div.pull-right > label > span'))
                ->click();
            $browser->pause(200);
            $browser->select('#filters > div.js_filters > div:nth-child(1) > select', $filterValue->id);
            $browser->pause(500);
            $browser->select('#filters > div.js_filters > div:nth-child(2) > select', $filterValue3->id);
            $browser->type('#filters > div.js_filters > div:nth-child(2) > span > span.selection > span > ul > li > input', 'Япония');
            $browser->pause(500);
            $browser->keys('#filters > div.js_filters > div:nth-child(2) > span > span.selection > span > ul > li > input', ['{ENTER}']);
            $browser->select('#filters > div.js_filters > div:nth-child(3) > select', $filterValue4->id);
            $browser->type('#filters > div.js_filters > div:nth-child(3) > span > span.selection > span > ul > li > input', 'Arimino');
            $browser->pause(500);
            $browser->keys('#filters > div.js_filters > div:nth-child(3) > span > span.selection > span > ul > li > input', ['{ENTER}']);
            $browser->select('#filters > div.js_filters > div:nth-child(4) > select', $filterValue5->id);
            $browser->type('#filters > div.js_filters > div:nth-child(4) > span > span.selection > span > ul > li > input', 'Не содержит этанол');
            $browser->pause(500);
            $browser->keys('#filters > div.js_filters > div:nth-child(4) > span > span.selection > span > ul > li > input', ['{ENTER}']);
            $browser->pause(200);

            $browser->clickLink('Video');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#video > div > div > div > div > div > label > span'))
                ->click();
            $browser->pause(200);
            $browser->type('input[name="video"]', 'https://www.m.youtube.com/watch?v=dEMLYbtsmkM');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(200);

            $browser->clickLink('Product group');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#group > div > div > div.row.text-center > a'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('All non-saved item data will be lost. Do you really want to move on to managing the group?')
                ->click('#confirmBtnYes');
            $browser->pause(200);
            $browser->click('#group > div.form-group > span');
            $browser->pause(200);
            $browser->type('.select2-search.select2-search--dropdown > input', 'TOV1'); // TODO enter 3 numbers of product sku previously selected from product list
            $browser->pause(1500);
            $browser->keys('.select2-search.select2-search--dropdown > input', ['{ENTER}']);
            $browser->pause(1000);
            $browser->click('#group > div.form-group > span');
            $browser->pause(200);
            $browser->type('.select2-search.select2-search--dropdown > input', 'TOV3'); // TODO enter 3 numbers of product sku previously selected from product list
            $browser->pause(1000);
            $browser->keys('.select2-search.select2-search--dropdown > input', ['{ENTER}']);
            $browser->pause(1500);
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(2) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(500);

//  проверка после сохранения

            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[2]).find(cell => cell.innerText === "product name").closest(\'tr\').children[7].querySelectorAll(\'a\')[1].click()');
            $browser->pause(1000);
            $browser->assertValue('input[name="alias"]', 'lipstick0');
            $browser->assertValue('input[name="sku"]', '000111');
            $browser->assertNotChecked('#base > div > div > div > div:nth-child(3) > div > label > input');
            $browser->assertNotChecked('#base > div > div > div > div:nth-child(4) > div > label > input');
            $browser->assertValue('input[name="position"]', '11');
            $browser->assertNotChecked('#base > div > div > div > div:nth-child(5) > div > label > input');
            $browser->assertValue('input[name="original_price_old"]', '1500');
            $browser->assertValue('input[name="original_price"]', '1000');
            $browser->assertNotChecked('#base > div > div > div > div:nth-child(6) > div > label > input');
            $browser->assertNotChecked('#base > div > div > div > div:nth-child(7) > div > label > input');
            $browser->scrollTo('#base > div > div > div > div:nth-child(7) > div > label > span');
            $browser->pause(200);
            $browser->assertValue('input[name="rating"]', '4');
            $browser->assertNotChecked('#base > div > div > div > div:nth-child(8) > div > label > input');
            $browser->assertNotChecked('#base > div > div > div > div:nth-child(9) > div > label > input');
            $browser->assertChecked('#base > div > div > div > div:nth-child(11) > input');
            $browser->assertNotChecked('#base > div > div > div > div:nth-child(11) > div > label > input');
            $browser->assertSeeIn('select[name="currency_id"] > option[selected="selected"]', 'USD');
            $browser->assertSeeIn('select[name="product_status_id"] > option[selected="selected"]', 'Action');
            $browser->assertPresent('#base > div > div > div > div:nth-child(10) > span > span.selection > span > ul > li[title="Тестовый товар 1"]');
//            $browser->assertPresent('#base > div > div > div > div:nth-child(10) > span > span.selection > span > ul > li[title="Тестовый товар 2"]');  // todo раскомментировать после фикса (#634)

            $browser->clickLink('Categories');
            $browser->pause(500);
            $browser->assertNotChecked('#categories > div > div > div > div:nth-child(1) > div > label > input');
            $browser->pause(200);
            $browser->assertPresent('#categories > div > div > div > div:nth-child(1) > span > span.selection > span > ul > li[title="Hair shampoos"] + [title="Indelible care"]');

            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->assertNotChecked('#locales-ru > div:nth-child(1) > div > label > input');
            $browser->assertValue('input[name="ru[name]"]', 'название товара');
            $browser->assertNotChecked('#locales-ru > div:nth-child(2) > div > label > input');
            $browser->assertValue('textarea[name="ru[introtext]"]', 'интротекст товара');
            $browser->assertNotChecked('#locales-ru > div:nth-child(3) > div > label > input');
            $browser->assertValue('textarea[name="ru[description]"]', 'описание товара');
            $browser->click('#locale-en-tab');
            $browser->pause(200);
            $browser->assertNotChecked('#locales-en > div:nth-child(1) > div > label > input');
            $browser->assertValue('input[name="en[name]"]', 'product name');
            $browser->assertNotChecked('#locales-en > div:nth-child(2) > div > label > input');
            $browser->assertValue('textarea[name="en[introtext]"]', 'product introtext');
            $browser->assertNotChecked('#locales-en > div:nth-child(3) > div > label > input');
            $browser->assertValue('textarea[name="en[description]"]', 'product description');
            $browser->click('#seo-tab');
            $browser->pause(200);
            $browser->assertNotChecked('#seo-locales-ru > div:nth-child(1) > div > label > input');
            $browser->assertValue('input[name="ru[seo_title]"]', 'сео загловок');
            $browser->assertNotChecked('#seo-locales-ru > div:nth-child(2) > div > label > input');
            $browser->assertValue('input[name="ru[seo_keywords]"]', 'сео ключевые слова');
            $browser->assertNotChecked('#seo-locales-ru > div:nth-child(3) > div > label > input');
            $browser->assertValue('input[name="ru[seo_description]"]', 'сео описаие');
            $browser->assertNotChecked('#seo-locales-ru > div:nth-child(4) > div > label > input');
            $browser->assertValue('input[name="ru[seo_canonical]"]', 'сео каноникал');
            $browser->assertNotChecked('#seo-locales-ru > div:nth-child(5) > div > label > input');
            $browser->assertValue('input[name="ru[seo_robots]"]', 'сео роботс');
            $browser->assertNotChecked('#seo-locales-ru > div:nth-child(6) > div > label > input');
            $browser->assertValue('textarea[name="ru[seo_content]"]', 'сео контент');
            $browser->click('#seo-locales-en-tab');
            $browser->pause(200);
            $browser->assertNotChecked('#seo-locales-en > div:nth-child(1) > div > label > input');
            $browser->assertValue('input[name="en[seo_title]"]', 'seo title');
            $browser->assertNotChecked('#seo-locales-en > div:nth-child(2) > div > label > input');
            $browser->assertValue('input[name="en[seo_keywords]"]', 'seo keywords');
            $browser->assertNotChecked('#seo-locales-en > div:nth-child(3) > div > label > input');
            $browser->assertValue('input[name="en[seo_description]"]', 'seo description');
            $browser->assertNotChecked('#seo-locales-en > div:nth-child(4) > div > label > input');
            $browser->assertValue('input[name="en[seo_canonical]"]', 'seo canonical');
            $browser->assertNotChecked('#seo-locales-en > div:nth-child(5) > div > label > input');
            $browser->assertValue('input[name="en[seo_robots]"]', 'seo robots');
            $browser->assertNotChecked('#seo-locales-en > div:nth-child(6) > div > label > input');
            $browser->assertValue('textarea[name="en[seo_content]"]', 'seo content');

            $browser->clickLink('Filters');
            $browser->pause(200);
            $browser->assertNotChecked('#filters > div.pull-right > label > span');
            $browser->assertPresent('#filters > div.js_filters > div:nth-child(1) > span > span.selection > span > span[title="100 Ml"]');
            $browser->assertPresent('#filters > div.js_filters > div:nth-child(2) > span > span.selection > span > ul > li[title="Украина"]');
            $browser->assertPresent('#filters > div.js_filters > div:nth-child(2) > span > span.selection > span > ul > li[title="Япония"]');
            $browser->assertPresent('#filters > div.js_filters > div:nth-child(3) > span > span.selection > span > ul > li[title="Fiole"]');
            $browser->assertPresent('#filters > div.js_filters > div:nth-child(3) > span > span.selection > span > ul > li[title="Arimino"]');
            $browser->assertPresent('#filters > div.js_filters > div:nth-child(4) > span > span.selection > span > ul > li[title="Не содержит этанол"]');
            $browser->assertPresent('#filters > div.js_filters > div:nth-child(4) > span > span.selection > span > ul > li[title="Без сульфатов"]');
            $browser->clickLink('Video');
            $browser->pause(200);
            $browser->assertNotChecked('#video > div > div > div > div:nth-child(1) > div > label > input');
            $browser->assertValue('input[name="video"]', 'https://www.m.youtube.com/watch?v=dEMLYbtsmkM');

            $browser->clickLink('Product group');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#group > div > div > div.row.text-center > a'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('All non-saved item data will be lost. Do you really want to move on to managing the group?')
                ->click('#confirmBtnYes');
            $browser->pause(200);
            $browser->assertSeeIn('#group_products > tr:nth-child(1) > td.js_name', 'product name (000111) - 100 Ml');
            $browser->assertSeeIn('#group_products > tr:nth-child(2) > td.js_name', 'Тестовый товар 1 (TOV1) - 100 Ml');
            $browser->assertSeeIn('#group_products > tr:nth-child(3) > td.js_name', 'Тестовый товар 3 (TOV3) - 40 Ml');
            $browser->assertChecked('#group_products > tr:nth-child(1) > td:nth-child(5) > input');
            $browser->assertNotChecked('#group_products > tr:nth-child(2) > td:nth-child(5) > input');
            $browser->assertNotChecked('#group_products > tr:nth-child(3) > td:nth-child(5) > input');
            $browser->clickLink('Back');
            $browser->pause(500);
            $browser->press('#confirmBtnYes');
            $browser->pause(1000);
        });
    }

    public function testProductEdit()
    {

        $currency2 = Currency::where('name', 'UAH')->first();
        $stat2 = ProductStatus::whereTranslation('name', 'New')->first();
        $filterValue2 = FilterValue::whereTranslation('name', '80 Ml')->first();

        $this->browse(function (Browser $browser) use($currency2, $stat2, $filterValue2) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(3) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[2]).find(cell => cell.innerText === "product name").closest(\'tr\').children[7].querySelectorAll(\'a\')[1].click()');
            $browser->pause(1000);
            $browser->type('input[name="alias"]', 'lipstick1');
            $browser->pause(500);
            $browser->type('input[name="sku"]', '000011');
            $browser->pause(200);
            $browser->type('input[name="position"]', '12');
            $browser->pause(200);
            $browser->type('input[name="original_price_old"]', '2500');
            $browser->pause(200);
            $browser->type('input[name="original_price"]', '2000');
            $browser->pause(200);
            $browser->type('input[name="rating"]', '5');
            $browser->scrollTo('#base > div > div > div > div:nth-child(7) > div > label > span');
            $browser->pause(200);
            $browser->click('#base > div > div > div > div:nth-child(7) > span');
            $browser->pause(500);
            $browser->click('#base > div > div > div > div:nth-child(11) > span');
            $browser->select('select[name="currency_id"]',$currency2->id);
            $browser->select('select[name="product_status_id"]',$stat2->id);
            $browser->pause(500);
            // todo раскомментировать после фикса (#634)
//            $browser->click('#base > div > div > div > div:nth-child(10) > span > span.selection > span > ul > li:nth-child(2) > span');
//            $browser->pause(200);
//            $browser->type("#base > div > div > div > div:nth-child(10) > span > span.selection > span > ul > li > input", 'Тестовый товар 3');
//            $browser->pause(10000);
//            $browser->keys('#base > div > div > div > div:nth-child(10) > span > span.selection > span > ul > li > input', ['{ENTER}']);
//            $browser->click('input[name="rating"]');
            $browser->pause(1000);

            $browser->clickLink('Categories');
            $browser->pause(500);
            $browser->pause(200);
            $browser->click('#categories > div > div > div > div:nth-child(1) > span > span.selection > span > ul > li:nth-child(2) > span');
            $browser->pause(200);
            $browser->type('#categories > div > div > div > div:nth-child(1) > span > span.selection > span > ul > li > input', 'Hair oil');
            $browser->pause(500);
            $browser->keys('#categories > div > div > div > div:nth-child(1) > span > span.selection > span > ul > li > input', ['{ENTER}']);
            $browser->click('div:nth-child(2) > label > div.iradio_flat-green');

            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'название товара 2');
            $browser->type('textarea[name="ru[introtext]"]', 'интротекст товара 2');
            $browser->type('textarea[name="ru[description]"]', 'описание товара 2');
            $browser->click('#locale-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'product name 2');
            $browser->type('textarea[name="en[introtext]"]', 'product introtext 2');
            $browser->type('textarea[name="en[description]"]', 'product description 2');

            $browser->click('#seo-tab');
            $browser->pause(200);
            $browser->type('input[name="ru[seo_title]"]', 'сео загловок 2');
            $browser->type('input[name="ru[seo_keywords]"]', 'сео ключевые слова 2');
            $browser->type('input[name="ru[seo_description]"]', 'сео описаие 2');
            $browser->type('input[name="ru[seo_canonical]"]', 'сео каноникал 2');
            $browser->type('input[name="ru[seo_robots]"]', 'сео роботс 2');
            $browser->type('textarea[name="ru[seo_content]"]', 'сео контент 2');
            $browser->click('#seo-locales-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[seo_title]"]', 'seo title 2');
            $browser->type('input[name="en[seo_keywords]"]', 'seo keywords 2');
            $browser->type('input[name="en[seo_description]"]', 'seo description 2');
            $browser->type('input[name="en[seo_canonical]"]', 'seo canonical 2');
            $browser->type('input[name="en[seo_robots]"]', 'seo robots 2');
            $browser->type('textarea[name="en[seo_content]"]', 'seo content 2');

            $browser->clickLink('Filters');
            $browser->pause(200);
            $browser->select('#filters > div.js_filters > div:nth-child(1) > select', $filterValue2->id);
            $browser->pause(500);
            $browser->click('#filters > div.js_filters > div:nth-child(2) > span > span.selection > span > ul > li:nth-child(2) > span');
            $browser->type('#filters > div.js_filters > div:nth-child(2) > span > span.selection > span > ul > li > input', 'США');
            $browser->pause(500);
            $browser->keys('#filters > div.js_filters > div:nth-child(2) > span > span.selection > span > ul > li > input', ['{ENTER}']);
            $browser->click('#filters > div.js_filters > div:nth-child(3) > span > span.selection > span > ul > li:nth-child(2) > span');
            $browser->type('#filters > div.js_filters > div:nth-child(3) > span > span.selection > span > ul > li > input', 'Cefine');
            $browser->pause(500);
            $browser->keys('#filters > div.js_filters > div:nth-child(3) > span > span.selection > span > ul > li > input', ['{ENTER}']);
            $browser->click('#filters > div.js_filters > div:nth-child(4) > span > span.selection > span > ul > li:nth-child(2) > span');
            $browser->type('#filters > div.js_filters > div:nth-child(4) > span > span.selection > span > ul > li > input', 'Чувствительная кожа');
            $browser->pause(500);
            $browser->keys('#filters > div.js_filters > div:nth-child(4) > span > span.selection > span > ul > li > input', ['{ENTER}']);
            $browser->pause(200);

            $browser->clickLink('Video');
            $browser->pause(200);
            $browser->type('#video > div > div > div > div > input', 'https://www.youtube.com/watch?v=dEMLYbtsmkM');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(2) > button.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(200);

            $browser->clickLink('Product group');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#group > div > div > div.row.text-center > a'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('All non-saved item data will be lost. Do you really want to move on to managing the group?')
                ->click('#confirmBtnYes');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[3]).find(cell => cell.innerText === "TOV1").closest(\'tr\').children[6].querySelectorAll(\'button\')[0].click()');
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->driver->findElement(WebDriverBy::cssSelector('#confirmBtnYes'))
                    ->click();
            });
            $browser->pause(500);
            $browser->click('#group > div.form-group > span');
            $browser->pause(200);
            $browser->type('.select2-search.select2-search--dropdown > input', 'Тестовый товар 2'); // TODO enter 3 numbers of product sku previously selected from product list
            $browser->pause(1000);
            $browser->keys('.select2-search.select2-search--dropdown > input', ['{ENTER}']);
            $browser->pause(1000);
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(2) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(500);

//  проверка после редактирования

            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[2]).find(cell => cell.innerText === "product name 2").closest(\'tr\').children[7].querySelectorAll(\'a\')[1].click()');
            $browser->pause(1000);
            $browser->assertValue('input[name="alias"]', 'lipstick1');
            $browser->assertValue('input[name="sku"]', '000011');
            $browser->assertNotChecked('#base > div > div > div > div:nth-child(3) > div > label > input');
            $browser->assertNotChecked('#base > div > div > div > div:nth-child(4) > div > label > input');
            $browser->assertValue('input[name="position"]', '12');
            $browser->assertNotChecked('#base > div > div > div > div:nth-child(5) > div > label > input');
            $browser->assertValue('input[name="original_price_old"]', '2500');
            $browser->assertValue('input[name="original_price"]', '2000');
            $browser->assertNotChecked('#base > div > div > div > div:nth-child(6) > div > label > input');
            $browser->assertNotChecked('#base > div > div > div > div:nth-child(7) > div > label > input');
            $browser->scrollTo('#base > div > div > div > div:nth-child(7) > div > label > span');
            $browser->pause(200);
//            $browser->assertValue('input[name="rating"]', '5');   // todo раскомментировать после фикса (#651)
            $browser->assertChecked('#base > div > div > div > div:nth-child(7) > input');
            $browser->assertNotChecked('#base > div > div > div > div:nth-child(8) > div > label > input');
            $browser->assertNotChecked('#base > div > div > div > div:nth-child(9) > div > label > input');
            $browser->assertNotChecked('#base > div > div > div > div:nth-child(11) > input');
            $browser->assertNotChecked('#base > div > div > div > div:nth-child(11) > div > label > input');
            $browser->assertSeeIn('select[name="currency_id"] > option[selected="selected"]', 'UAH');
            $browser->assertSeeIn('select[name="product_status_id"] > option[selected="selected"]', 'New');
            $browser->assertPresent('#base > div > div > div > div:nth-child(10) > span > span.selection > span > ul > li[title="Тестовый товар 1"]');
//            $browser->assertPresent('#base > div > div > div > div:nth-child(10) > span > span.selection > span > ul > li[title="Тестовый товар 2"]');   // todo раскомментировать после фикса (#634)

            $browser->clickLink('Categories');
            $browser->pause(500);
            $browser->assertNotChecked('#categories > div > div > div > div:nth-child(1) > div > label > input');
            $browser->pause(200);
            $browser->assertPresent('#categories > div > div > div > div:nth-child(1) > span > span.selection > span > ul > li[title="Hair shampoos"] + [title="Hair oil"]');
            $browser->assertPresent('div:nth-child(2) > div > div:nth-child(2) > label > div.checked');

            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->assertNotChecked('#locales-ru > div:nth-child(1) > div > label > input');
            $browser->assertValue('input[name="ru[name]"]', 'название товара 2');
            $browser->assertNotChecked('#locales-ru > div:nth-child(2) > div > label > input');
            $browser->assertValue('textarea[name="ru[introtext]"]', 'интротекст товара 2');
            $browser->assertNotChecked('#locales-ru > div:nth-child(3) > div > label > input');
            $browser->assertValue('textarea[name="ru[description]"]', 'описание товара 2');
            $browser->click('#locale-en-tab');
            $browser->pause(200);
            $browser->assertNotChecked('#locales-en > div:nth-child(1) > div > label > input');
            $browser->assertValue('input[name="en[name]"]', 'product name 2');
            $browser->assertNotChecked('#locales-en > div:nth-child(2) > div > label > input');
            $browser->assertValue('textarea[name="en[introtext]"]', 'product introtext 2');
            $browser->assertNotChecked('#locales-en > div:nth-child(3) > div > label > input');
            $browser->assertValue('textarea[name="en[description]"]', 'product description 2');
            $browser->click('#seo-tab');
            $browser->pause(200);
            $browser->assertNotChecked('#seo-locales-ru > div:nth-child(1) > div > label > input');
            $browser->assertValue('input[name="ru[seo_title]"]', 'сео загловок 2');
            $browser->assertNotChecked('#seo-locales-ru > div:nth-child(2) > div > label > input');
            $browser->assertValue('input[name="ru[seo_keywords]"]', 'сео ключевые слова 2');
            $browser->assertNotChecked('#seo-locales-ru > div:nth-child(3) > div > label > input');
            $browser->assertValue('input[name="ru[seo_description]"]', 'сео описаие 2');
            $browser->assertNotChecked('#seo-locales-ru > div:nth-child(4) > div > label > input');
            $browser->assertValue('input[name="ru[seo_canonical]"]', 'сео каноникал 2');
            $browser->assertNotChecked('#seo-locales-ru > div:nth-child(5) > div > label > input');
            $browser->assertValue('input[name="ru[seo_robots]"]', 'сео роботс 2');
            $browser->assertNotChecked('#seo-locales-ru > div:nth-child(6) > div > label > input');
            $browser->assertValue('textarea[name="ru[seo_content]"]', 'сео контент 2');
            $browser->click('#seo-locales-en-tab');
            $browser->pause(200);
            $browser->assertNotChecked('#seo-locales-en > div:nth-child(1) > div > label > input');
            $browser->assertValue('input[name="en[seo_title]"]', 'seo title 2');
            $browser->assertNotChecked('#seo-locales-en > div:nth-child(2) > div > label > input');
            $browser->assertValue('input[name="en[seo_keywords]"]', 'seo keywords 2');
            $browser->assertNotChecked('#seo-locales-en > div:nth-child(3) > div > label > input');
            $browser->assertValue('input[name="en[seo_description]"]', 'seo description 2');
            $browser->assertNotChecked('#seo-locales-en > div:nth-child(4) > div > label > input');
            $browser->assertValue('input[name="en[seo_canonical]"]', 'seo canonical 2');
            $browser->assertNotChecked('#seo-locales-en > div:nth-child(5) > div > label > input');
            $browser->assertValue('input[name="en[seo_robots]"]', 'seo robots 2');
            $browser->assertNotChecked('#seo-locales-en > div:nth-child(6) > div > label > input');
            $browser->assertValue('textarea[name="en[seo_content]"]', 'seo content 2');

            $browser->clickLink('Filters');
            $browser->pause(200);
            $browser->assertNotChecked('#filters > div.pull-right > label > span');
            $browser->assertPresent('#filters > div.js_filters > div:nth-child(1) > span > span.selection > span > span[title="80 Ml"]');
            $browser->assertPresent('#filters > div.js_filters > div:nth-child(2) > span > span.selection > span > ul > li[title="США"]');
            $browser->assertPresent('#filters > div.js_filters > div:nth-child(2) > span > span.selection > span > ul > li[title="Япония"]');
            $browser->assertPresent('#filters > div.js_filters > div:nth-child(3) > span > span.selection > span > ul > li[title="Cefine"]');
            $browser->assertPresent('#filters > div.js_filters > div:nth-child(3) > span > span.selection > span > ul > li[title="Fiole"]');
            $browser->assertPresent('#filters > div.js_filters > div:nth-child(4) > span > span.selection > span > ul > li[title="Чувствительная кожа"]');
            $browser->assertPresent('#filters > div.js_filters > div:nth-child(4) > span > span.selection > span > ul > li[title="Не содержит этанол"]');
            $browser->clickLink('Video');
            $browser->pause(200);
            $browser->assertNotChecked('#video > div > div > div > div:nth-child(1) > div > label > input');
            $browser->assertValue('input[name="video"]', 'https://www.youtube.com/watch?v=dEMLYbtsmkM');

            $browser->clickLink('Product group');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#group > div > div > div.row.text-center > a'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('All non-saved item data will be lost. Do you really want to move on to managing the group?')
                ->click('#confirmBtnYes');
            $browser->pause(200);
            $browser->assertSeeIn('#group_products > tr:nth-child(1) > td.js_name', 'product name 2 (000011) - 80 Ml');
            $browser->assertSeeIn('#group_products > tr:nth-child(2) > td.js_name', 'Тестовый товар 3 (TOV3) - 40 Ml');
            $browser->assertSeeIn('#group_products > tr:nth-child(3) > td.js_name', 'Тестовый товар 2 (TOV2) - 80 Ml');
            $browser->assertChecked('#group_products > tr:nth-child(1) > td:nth-child(5) > input');
            $browser->assertNotChecked('#group_products > tr:nth-child(2) > td:nth-child(5) > input');
            $browser->assertNotChecked('#group_products > tr:nth-child(3) > td:nth-child(5) > input');
            $browser->clickLink('Back');
            $browser->pause(500);
            $browser->press('#confirmBtnYes');
            $browser->pause(1000);
        });
    }

    public function testProductDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(3) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(1500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[2]).find(cell => cell.innerText === "product name 2").closest(\'tr\').children[7].querySelectorAll(\'a\')[0].click()');
            $browser->pause(1000);
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->press('#confirmBtnYes');
            });
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(500);
            Sitemap::where('alias', 'lipstick1-item')->forceDelete();
            Product::where('alias', 'lipstick1')->forceDelete();
        });
    }
}

