<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\Currency\Currency;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CurrencyTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCurrencyCreate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(9) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(2)');
            $browser->pause(1000);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(500);
            $browser->type('input[name="code"]', 'CAD');
            $browser->type('input[name="name"]', 'Canadian Dollar');
            $browser->type('input[name="sign"]', 'C$');
            $browser->type('input[name="course"]', '20.8');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector(' div:nth-child(5) > span'))
                ->click();
            $browser->click('div:nth-child(6) > span');
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success!');
            $browser->pause(500);
            $browser->assertValue('input[name="code"]', 'CAD');
            $browser->assertValue('input[name="name"]', 'Canadian Dollar');
            $browser->assertValue('input[name="sign"]', 'C$');
            $browser->assertValue('input[name="course"]', '20.800000');
            $browser->assertChecked('input[name="default"]');
            $browser->assertChecked('input[name="active"]');
        });
    }

    public function testCurrencyEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(9) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(2)');
            $browser->pause(1000);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "CAD").closest(\'tr\').children[5].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->type('input[name="code"]', 'ASD');
            $browser->type('input[name="name"]', 'Australian Dollar');
            $browser->type('input[name="sign"]', 'AS$');
            $browser->type('input[name="course"]', '10.5');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector(' div:nth-child(5) > span'))
                ->click();
            $browser->click('div:nth-child(6) > span');
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success!');
            $browser->pause(500);
            $browser->assertValue('input[name="code"]', 'ASD');
            $browser->assertValue('input[name="name"]', 'Australian Dollar');
            $browser->assertValue('input[name="sign"]', 'AS$');
            $browser->assertValue('input[name="course"]', '10.500000');
            $browser->assertChecked('input[name="default"]');
            $browser->assertNotChecked('input[name="active"]');
            $browser->pause(200);

        });
    }

    public function testCurrencyDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(9) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(2)');
            $browser->pause(1500);
            Currency::where('code', 'JPY')->update(['default'=>'1']);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "USD").closest(\'tr\').children[5].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->click('div:nth-child(5) > span');
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success!');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "ASD").closest(\'tr\').children[5].querySelectorAll(\'a\')[0].click()');
            $browser->pause(500);
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->driver->findElement(WebDriverBy::cssSelector('#confirmBtnYes'))
                    ->click();
            });
            $browser->pause(500);
            $browser->assertSee('Success!');
            $browser->pause(500);
            Currency::where('code', 'ASD')->forceDelete();

        });
    }
}


