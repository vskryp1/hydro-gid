<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\Currency\Currency;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PromocodesTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testPromocodesCreate()
    {

        $selectCurrency = Currency::where('name', 'UAH')->first();

        $this->browse(function (Browser $browser) use($selectCurrency){
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(5) > a');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(5)');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(200);
            $browser->type('input[name="alias"]', 'promotest');
            $browser->pause(200);
            $browser->select('select[name="type"]', 'amount');
            $browser->pause(200);
            $browser->type('input[name="original_discount_size"]','25.00');
            $browser->pause(200);
            $browser->select('select[name="currency_id"]', $selectCurrency->id);
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-sm-6.col-xs-12 > span'))
                ->click();
            $browser->pause(200);
            $browser->type('#single_cal2', '2020-04-12');
            $browser->pause(200);
            $browser->click('input[name="original_discount_size"]');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('.checkbox > span'))
                ->click();
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(1000);
            $browser->assertSee('Success');
            $browser->pause(200);

            $browser->assertValue('input[name="alias"]', 'promotest');
            $browser->assertSelected('select[name="type"]', 'amount');
            $browser->assertValue('input[name="original_discount_size"]','25.00');
            $browser->assertSelected('select[name="currency_id"]', $selectCurrency->id);
            $browser->assertChecked('input[name="type_of_use"]');
//            $browser->assertValue('#single_cal2', '2020-04-12');    // todo раскомментировать после фикса (#654)
            $browser->assertChecked('input[name="active"]');
            $browser->pause(500);
        });
    }

    public function testPromocodesEdit()
    {

        $selectCurrency = Currency::where('name', 'EUR')->first();

        $this->browse(function (Browser $browser) use($selectCurrency){
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(5) > a');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(5)');
            $browser->pause(1000);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "promotest").closest(\'tr\').children[6].querySelectorAll(\'a\')[1].click()');
            $browser->pause(200);
            $browser->type('input[name="alias"]', 'promotest2');
            $browser->pause(200);
            $browser->select('select[name="type"]', 'percent');
            $browser->pause(200);
            $browser->type('input[name="original_discount_size"]','50.00');
            $browser->pause(200);
            $browser->select('select[name="currency_id"]', $selectCurrency->id);
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-sm-6.col-xs-12 > span'))
                ->click();
            $browser->pause(200);
            $browser->type('input[name="use_count"]','5');
            $browser->pause(200);
            $browser->type('#single_cal2', '2020-12-31');
            $browser->pause(200);
            $browser->click('input[name="original_discount_size"]');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('.checkbox > span'))
                ->click();
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(1000);
            $browser->assertSee('Success');
            $browser->pause(200);

            $browser->assertValue('input[name="alias"]', 'promotest2');
            $browser->assertSelected('select[name="type"]', 'percent');
            $browser->assertValue('input[name="original_discount_size"]','50.00');
            $browser->assertSelected('select[name="currency_id"]', $selectCurrency->id);
            $browser->assertValue('input[name="use_count"]','5');
            $browser->assertNotChecked('input[name="type_of_use"]');
//            $browser->assertValue('#single_cal2', '2020-12-31');    // todo раскомментировать после фикса (#654)
            $browser->assertNotChecked('input[name="active"]');
            $browser->pause(500);
        });
    }

    public function testPromocodesDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(5) > a');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(5)');
            $browser->pause(1500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "promotest2").closest(\'tr\').children[6].querySelectorAll(\'a\')[0].click()');
            $browser->pause(200);
            $browser->pause(200);
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


