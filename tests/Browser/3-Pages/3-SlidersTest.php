<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\Sliders\Slider;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use phpseclib\Crypt\Random;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SlidersTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testSlidersCreate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(4) > a');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(3)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            //создание alias и названия+проверка
            $browser->pause(200);
            $browser->type('input[name="alias"]', 'test-slider');
            $browser->driver->findElement(WebDriverBy::xpath('//span[@class=\'switchery switchery-default\']'))
                ->click();
            $browser->pause(200);
            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'тестовый слайдер');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'test slider');
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(200);
            $browser->assertSee('Success');
            $browser->pause(200);
            $browser->assertValue('input[name="alias"]', 'test-slider');
            $browser->assertChecked('input[name="active"]');
            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[name]"]', 'тестовый слайдер');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'test slider');
            // редактирование alias и названия+проверка
            $browser->click('#base-tab');
            $browser->pause(200);
            $browser->type('input[name="alias"]', 'test-slider2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[@class=\'switchery switchery-default\']'))
                ->click();
            $browser->pause(200);
            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->click('#v-pills-ru-tab');
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'тестовый слайдер2');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'test slider2');
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(200);
            $browser->assertSee('Success');
            $browser->pause(200);
            $browser->assertValue('input[name="alias"]', 'test-slider2');
            $browser->assertNotChecked('input[name="active"]');
            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[name]"]', 'тестовый слайдер2');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'test slider2');
            // создание, редактирование, проверка самих слайдов
            $browser->click('#slider_items-tab');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(200);
            $browser->type('input[name="position"]', '1');
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div.checkbox > span'))
                ->click();
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->attach('input[name="ru[image]"]', ('resources/assets/frontend/images/slider/1.jpg')); //TODO need to specify the path to the image
            $browser->type('input[name="ru[alt]"]', 'Alt ru');
            $browser->type('input[name="ru[title]"]', 'Title ru');
            $browser->type('input[name="ru[link]"]', 'Link ru');
            $browser->pause(200);
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->attach('input[name="en[image]"]', ('resources/assets/frontend/images/slider/1.jpg')); //TODO need to specify the path to the image
            $browser->type('input[name="en[alt]"]', 'Alt en');
            $browser->type('input[name="en[title]"]', 'Title en');
            $browser->type('input[name="en[link]"]', 'Link en');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(1000);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[1]).find(cell => cell.innerText === "Title en").closest(\'tr\').children[5].querySelectorAll(\'a\')[0].click()');
            $browser->pause(500);
            $browser->assertValue('input[name="position"]', '1');
            $browser->assertChecked('input[name="active"]');
            $browser->type('input[name="position"]', '2');
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div.checkbox > span'))
                ->click();
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[alt]"]', 'Alt ru');
            $browser->assertValue('input[name="ru[title]"]', 'Title ru');
            $browser->assertValue('input[name="ru[link]"]', 'Link ru');
            $browser->type('input[name="ru[alt]"]', 'Alt2 ru');
            $browser->type('input[name="ru[title]"]', 'Title2 ru');
            $browser->type('input[name="ru[link]"]', 'Link2 ru');
            $browser->pause(200);
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[alt]"]', 'Alt en');
            $browser->assertValue('input[name="en[title]"]', 'Title en');
            $browser->assertValue('input[name="en[link]"]', 'Link en');
            $browser->type('input[name="en[alt]"]', 'Alt2 en');
            $browser->type('input[name="en[title]"]', 'Title2 en');
            $browser->type('input[name="en[link]"]', 'Link2 en');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(1000);
            $browser->assertSee('Success');
            $browser->assertValue('input[name="position"]', '2');
            $browser->assertNotChecked('input[name="active"]');
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[alt]"]', 'Alt2 ru');
            $browser->assertValue('input[name="ru[title]"]', 'Title2 ru');
            $browser->assertValue('input[name="ru[link]"]', 'Link2 ru');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[alt]"]', 'Alt2 en');
            $browser->assertValue('input[name="en[title]"]', 'Title2 en');
            $browser->assertValue('input[name="en[link]"]', 'Link2 en');

            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(500);
        });
    }


    public function testSlidersDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(4) > a');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(3)');
            $browser->pause(1500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "test slider2").closest(\'tr\').children[3].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->click('#slider_items-tab');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[1]).find(cell => cell.innerText === "Title2 en").closest(\'tr\').children[5].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->driver->findElement(WebDriverBy::cssSelector('#confirmBtnYes'))
                    ->click();
            });
            $browser->pause(800);
            $browser->assertSee('Success');
            $browser->clickLink('Sliders');
            $browser->pause(800);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "test slider2").closest(\'tr\').children[3].querySelectorAll(\'a\')[0].click()');
            $browser->pause(500);
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->driver->findElement(WebDriverBy::cssSelector('#confirmBtnYes'))
                    ->click();
            });
            $browser->assertSee('Success');
            $browser->pause(800);
            Slider::where('alias', 'test-slider2')->forceDelete();
        });
    }
}

