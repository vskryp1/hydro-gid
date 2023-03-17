<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\Currency\Currency;
use App\Models\Region\Region;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeliveriesTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testDeliveriesCreate()
    {

        $selectCurrency = Currency::where('name', 'UAH')->first();
        $paymentRegion = Region::whereTranslation('name', 'Ukraine')->first();
        $paymentRegion2 = Region::whereTranslation('name', 'USA')->first();

        $this->browse(function (Browser $browser) use ($selectCurrency, $paymentRegion, $paymentRegion2){
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(5) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(4)');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(500);
            $browser->select('select[name="type"]', '1');
            $browser->pause(200);
            $browser->type('#api_key', '000111');
            $browser->pause(200);
            $browser->type('input[type="number"]', '100.00');
            $browser->pause(200);
            $browser->select('select[name="currency_id"]', $selectCurrency->id);
            $browser->pause(200);
            $browser->select('select[name="regions[]"]', $paymentRegion->id);
            $browser->select('select[name="regions[]"]', $paymentRegion2->id);
            $browser->pause(800);
            $browser->type('input[name="position"]', '1');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div:nth-child(7) > span'))
                ->click();
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div:nth-child(8) > span'))
                ->click();
            $browser->pause(200);
            $browser->click('#locale-tab');
            $browser->pause(500);
            $browser->type('input[name="ru[name]"]', 'courier ru');
            $browser->pause(200);
            $browser->type('input[name="ru[description]"]', 'description ru');
            $browser->click('#locale-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'courier en');
            $browser->pause(200);
            $browser->type('input[name="en[description]"]', 'description en');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(1500);
            $browser->assertSee('Success');
            $browser->assertSelected('select[name="type"]', '1');
            $browser->assertValue('#api_key', '000111');
            $browser->assertValue('input[type="number"]', '100.00');
            $browser->assertSelected('select[name="currency_id"]', $selectCurrency->id);
            $browser->assertSelected('select[name="regions[]"]', $paymentRegion->id);
            $browser->assertSelected('select[name="regions[]"]', $paymentRegion2->id);
            $browser->assertValue('input[name="position"]', '1');
            $browser->assertChecked('#active');
            $browser->assertChecked('#default');
            $browser->click('#locale-tab');
            $browser->pause(500);
            $browser->assertValue('input[name="ru[name]"]', 'courier ru');
            $browser->assertValue('input[name="ru[description]"]', 'description ru');
            $browser->click('#locale-en-tab');
            $browser->assertValue('input[name="en[name]"]', 'courier en');
            $browser->assertValue('input[name="en[description]"]', 'description en');
            $browser->pause(200);
            $browser->click('#delivery_places-tab');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(200);
            $browser->type('input[name="position"]', '10');
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div.checkbox > span'))
                ->click();
            $browser->pause(200);
            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'Харьков');
            $browser->type('textarea[name="ru[description]"]', 'Тут описание');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('#v-pills-en > div:nth-child(1) > input[name="en[name]"]', 'Kharkiv');
            $browser->type('textarea[name="en[description]"]', 'Description here');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(1000);
            $browser->assertSee('Success');
            $browser->assertValue('input[name="position"]', '10');
            $browser->assertChecked('input[name="is_active"]');
            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[name]"]', 'Харьков');
            $browser->assertSeeIn('textarea[name="ru[description]"]', 'Тут описание');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('#v-pills-en > div:nth-child(1) > input[name="en[name]"]', 'Kharkiv');
            $browser->assertSeeIn('textarea[name="en[description]"]', 'Description here');
            $browser->pause(200);
        });
    }

    public function testDeliveriesEdit()
    {
        $selectCurrency = Currency::where('name', 'EUR')->first();
        $paymentRegion = Region::whereTranslation('name', 'Germany')->first();
        $paymentRegion2 = Region::whereTranslation('name', 'Other regions')->first();

        $this->browse(function (Browser $browser) use ($selectCurrency, $paymentRegion, $paymentRegion2){
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(5) > a');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(4)');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "courier en").closest(\'tr\').children[7].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->select('select[name="type"]', '3');
            $browser->pause(200);
            $browser->type('#api_key', '000222');
            $browser->pause(200);
            $browser->type('input[type="number"]', '200.00');
            $browser->pause(200);
            $browser->select('select[name="currency_id"]', $selectCurrency->id);
            $browser->pause(200);
            $browser->click('span.selection > span > ul > li:nth-child(1) > span');
            $browser->pause(200);
            $browser->click('span.selection > span > ul > li:nth-child(1) > span');
            $browser->pause(200);
            $browser->select('select[name="regions[]"]', $paymentRegion->id);
            $browser->select('select[name="regions[]"]', $paymentRegion2->id);
            $browser->click('#base > div > div > div:nth-child(5) > span');
            $browser->pause(800);
            $browser->type('input[name="position"]', '2');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div:nth-child(7) > span'))
                ->click();
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div:nth-child(8) > span'))
                ->click();
            $browser->pause(200);
            $browser->click('#locale-tab');
            $browser->pause(500);
            $browser->type('input[name="ru[name]"]', 'New courier ru');
            $browser->pause(200);
            $browser->type('input[name="ru[description]"]', 'New description ru');
            $browser->click('#locale-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'New courier en');
            $browser->pause(200);
            $browser->type('input[name="en[description]"]', 'New description en');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(1500);
            $browser->assertSee('Success');
            $browser->assertSelected('select[name="type"]', '3');
            $browser->assertValue('#api_key', '000222');
            $browser->assertValue('input[type="number"]', '200.00');
            $browser->assertSelected('select[name="currency_id"]', $selectCurrency->id);
            $browser->assertSelected('select[name="regions[]"]', $paymentRegion->id);
            $browser->assertSelected('select[name="regions[]"]', $paymentRegion2->id);
            $browser->assertValue('input[name="position"]', '2');
            $browser->assertNotChecked('#active');
            $browser->assertNotChecked('#default');
            $browser->click('#locale-tab');
            $browser->pause(500);
            $browser->assertValue('input[name="ru[name]"]', 'New courier ru');
            $browser->assertValue('input[name="ru[description]"]', 'New description ru');
            $browser->click('#locale-en-tab');
            $browser->assertValue('input[name="en[name]"]', 'New courier en');
            $browser->assertValue('input[name="en[description]"]', 'New description en');
            $browser->pause(200);
            $browser->click('#delivery_places-tab');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "Kharkiv").closest(\'tr\').children[3].querySelectorAll(\'a\')[0].click()');
            $browser->pause(500);
            $browser->type('input[name="position"]', '11');
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div.checkbox > span'))
                ->click();
            $browser->pause(200);
            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'Киев');
            $browser->type('textarea[name="ru[description]"]', 'Тут новое описание');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('#v-pills-en > div:nth-child(1) > input[name="en[name]"]', 'Kiev');
            $browser->type('textarea[name="en[description]"]', 'Description new here');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(1000);
            $browser->assertSee('Success');
            $browser->assertValue('input[name="position"]', '11');
            $browser->assertNotChecked('input[name="is_active"]');
            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[name]"]', 'Киев');
            $browser->assertSeeIn('textarea[name="ru[description]"]', 'Тут новое описание');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('#v-pills-en > div:nth-child(1) > input[name="en[name]"]', 'Kiev');
            $browser->assertSeeIn('textarea[name="en[description]"]', 'Description new here');
            $browser->pause(200);
        });
    }

    public function testDeliveriesDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(5) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(4)');
            $browser->pause(1500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "New courier en").closest(\'tr\').children[7].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->click('#delivery_places-tab');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "Kiev").closest(\'tr\').children[3].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->press('#confirmBtnYes');
            });
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->click(' a.btn.btn-dark.text-uppercase.pull-right');
            $browser->pause(500);
            $browser->waitForText('Want to go back?');
            $browser->press('Yes');
            $browser->pause(1000);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "New courier en").closest(\'tr\').children[7].querySelectorAll(\'a\')[0].click()');
            $browser->pause(500);
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->driver->findElement(WebDriverBy::cssSelector('#confirmBtnYes'))
                    ->click();
            });
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(200);
        });
    }
}

