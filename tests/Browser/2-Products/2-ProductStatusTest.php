<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\Product\ProductStatus;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductStatusTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testProductStatusCreate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(3) > a');
            $browser->pause(800);
            $browser->click('li.active > ul > li:nth-child(3)');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a')) //кнопка Создать
            ->click();
            $browser->pause(1000);
            $browser->type('input[name="color"]', 'red');
            $browser->pause(500);
            $browser->type('input[name="class"]','the class');
            $browser->pause(200);
            $browser->click('#base > div > div > div > div:nth-child(3) > span');
            $browser->click('#base > div > div > div > div:nth-child(4) > span');
            $browser->pause(500);
            $browser->clickLink('Locale');
            $browser->pause(1000);
            $browser->type('input[name="ru[name]"]', 'Возвращён');
            $browser->pause(200);
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'Returned');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "Returned").closest(\'tr\').children[3].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->assertValue('input[name="color"]', 'red');
            $browser->assertValue('input[name="class"]','the class');
            $browser->assertChecked('input[name="active"]');
            $browser->assertChecked('input[name="in_stock"]');
            $browser->pause(500);
            $browser->clickLink('Locale');
            $browser->pause(1000);
            $browser->assertValue('input[name="ru[name]"]', 'Возвращён');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'Returned');
            $browser->pause(200);
        });
    }

    public function testProductStatusEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(3) > a');
            $browser->pause(800);
            $browser->click('li.active > ul > li:nth-child(3)');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "Returned").closest(\'tr\').children[3].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->type('input[name="color"]', '#225555');
            $browser->pause(500);
            $browser->type('input[name="class"]', 'new class');
            $browser->pause(500);
            $browser->click('#base > div > div > div > div:nth-child(3) > span');
            $browser->click('#base > div > div > div > div:nth-child(4) > span');
            $browser->pause(1000);
            $browser->clickLink('Locale');
            $browser->pause(800);
            $browser->type('input[name="ru[name]"]', 'Новый статус');
            $browser->pause(200);
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'New status');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "New status").closest(\'tr\').children[3].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->assertValue('input[name="color"]', '#225555');
            $browser->assertValue('input[name="class"]','new class');
            $browser->assertNotChecked('input[name="active"]');
            $browser->assertNotChecked('input[name="in_stock"]');
            $browser->pause(500);
            $browser->clickLink('Locale');
            $browser->pause(1000);
            $browser->assertValue('input[name="ru[name]"]', 'Новый статус');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'New status');
            $browser->pause(200);
            $browser->clickLink(' Back');
            $browser->pause(200);
            $browser->press('button[id="confirmBtnYes"]');
            $browser->pause(1000);
        });
    }

    public function testProductStatusDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(3) > a');
            $browser->pause(800);
            $browser->click('li.active > ul > li:nth-child(3)');
            $browser->pause(100);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "New status").closest(\'tr\').children[3].querySelectorAll(\'a\')[0].click()');
            $browser->pause(1000);
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->driver->findElement(WebDriverBy::cssSelector('#confirmBtnYes'))
                    ->click();
            });
            $browser->pause(200);
            $browser->assertSee('Success');
            $browser->pause(200);
            ProductStatus::where('class', 'new class')->forceDelete();
        });
    }
}


