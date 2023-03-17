<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\Region\Region;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PaymentTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testPaymentCreate()
    {

        $paymentRegion = Region::whereTranslation('name', 'Ukraine')->first();
        $paymentRegion2 = Region::whereTranslation('name', 'USA')->first();

        $this->browse(function (Browser $browser) use ($paymentRegion, $paymentRegion2){
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(5) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(3)');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(500);
            $browser->select('select[name="type"]', '2');
            $browser->pause(200);
            $browser->select('select[name="regions[]"]', $paymentRegion->id);
            $browser->select('select[name="regions[]"]', $paymentRegion2->id);
            $browser->pause(200);
            $browser->type('input[name="position"]', '1');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="base"]/div/div/div[4]/span'))
                ->click();
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div:nth-child(5) > span'))
                ->click();
            $browser->pause(200);
            $browser->clickLink('Locale');
            $browser->pause(500);
            $browser->type('input[name="ru[name]"]', 'chek');
            $browser->pause(200);
            $browser->click('#locale-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'chek');
            $browser->pause(200);
            $browser->clickLink('API');
            $browser->pause(200);
            $browser->type('#api_key_public', 'test key');
            $browser->type('#api_key_private', 'test private key');
            $browser->driver->findElement(WebDriverBy::cssSelector('#api > div > div > div:nth-child(3) > span'))
                ->click();
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(200);
            $browser->assertSee('Success');
            $browser->assertSelected('select[name="type"]', '2');
            $browser->assertSelected('select[name="regions[]"]', $paymentRegion->id);
            $browser->assertSelected('select[name="regions[]"]', $paymentRegion2->id);
            $browser->assertValue('input[name="position"]', '1');
            $browser->assertChecked('#active');
            $browser->assertChecked('#default');
            $browser->clickLink('Locale');
            $browser->pause(500);
            $browser->assertValue('input[name="ru[name]"]', 'chek');
            $browser->click('#locale-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'chek');
            $browser->clickLink('API');
            $browser->pause(200);
            $browser->assertValue('#api_key_public', 'test key');
            $browser->assertValue('#api_key_private', 'test private key');
            $browser->assertChecked('#api_key_sandbox');
            $browser->pause(1000);
        });
    }

    public function testPaymentsEdit()
    {

        $paymentRegion = Region::whereTranslation('name', 'Italy')->first();
        $paymentRegion2 = Region::whereTranslation('name', 'Spain')->first();

        $this->browse(function (Browser $browser) use ($paymentRegion, $paymentRegion2){
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(5) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(3)');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "chek").closest(\'tr\').children[5].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->select('select[name="type"]', '3');
            $browser->pause(200);
            $browser->click('span.selection > span > ul > li:nth-child(1) > span');
            $browser->pause(200);
            $browser->click('span.selection > span > ul > li:nth-child(1) > span');
            $browser->pause(200);
            $browser->select('select[name="regions[]"]', $paymentRegion->id);
            $browser->select('select[name="regions[]"]', $paymentRegion2->id);
            $browser->click('#base > div > div > div:nth-child(2) > span');
            $browser->pause(500);
            $browser->type('input[name="position"]', '2');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="base"]/div/div/div[4]/span'))
                ->click();
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div:nth-child(5) > span'))
                ->click();
            $browser->pause(200);
            $browser->clickLink('Locale');
            $browser->pause(500);
            $browser->type('input[name="ru[name]"]', 'cheked');
            $browser->pause(200);
            $browser->click('#locale-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'cheked');
            $browser->pause(200);
            $browser->clickLink('API');
            $browser->pause(200);
            $browser->type('#api_key_public', 'test key2');
            $browser->type('#api_key_private', 'test private key2');
            $browser->driver->findElement(WebDriverBy::cssSelector('#api > div > div > div:nth-child(3) > span'))
                ->click();
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(200);
            $browser->assertSee('Success');
            $browser->assertSelected('select[name="type"]', '3');
            $browser->assertSelected('select[name="regions[]"]', $paymentRegion->id);
            $browser->assertSelected('select[name="regions[]"]', $paymentRegion2->id);
            $browser->assertValue('input[name="position"]', '2');
            $browser->assertNotChecked('#active');
            $browser->assertNotChecked('#default');
            $browser->clickLink('Locale');
            $browser->pause(500);
            $browser->assertValue('input[name="ru[name]"]', 'cheked');
            $browser->click('#locale-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'cheked');
            $browser->clickLink('API');
            $browser->pause(200);
            $browser->assertValue('#api_key_public', 'test key2');
            $browser->assertValue('#api_key_private', 'test private key2');
            $browser->assertNotChecked('#api_key_sandbox');
            $browser->pause(1000);
        });
    }

    public function testPaymentsDelete()
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
            $browser->click('li.active > ul > li:nth-child(3)');
            $browser->pause(1500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "cheked").closest(\'tr\').children[5].querySelectorAll(\'a\')[0].click()');
            $browser->pause(500);
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


