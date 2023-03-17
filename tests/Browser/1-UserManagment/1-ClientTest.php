<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\Region\Region;
use App\Models\User;
use Carbon\Carbon;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ClientCreate extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testClientCreate()
    {

        $regionSelect = Region::whereTranslation('name', 'Ukraine')->first();

        $this->browse(function (Browser $browser) use ($regionSelect) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->assertPathIs('/back');
            $browser->pause(500);
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(2) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(2)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(200);
            $browser->type('input[name="name"]', 'Client_1');
            $browser->pause(200);
            $browser->type('input[name="email"]', 'uniqid@mail.com');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '0931234567');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', '15 октября 1980');
            $browser->pause(200);
            $browser->type('input[name="password"]', rand(100000, 999999));
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->select('select[name="address[region_id][]"]', $regionSelect->id);
            $browser->pause(200);
            $browser->type('input[name="address[city][]"]', 'Kyiv');
            $browser->pause(200);
            $browser->type('input[name="address[zip][]"]', '951753');
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '5 Avenue');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(1000);
            $browser->assertSee('Success');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[1]).find(cell => cell.innerText === "uniqid@mail.com").closest(\'tr\').children[4].querySelectorAll(\'a\')[1].click()');
            $browser->pause(200);
            $browser->assertValue('input[name="name"]', 'Client_1');
            $browser->assertValue('input[name="email"]', 'uniqid@mail.com');
            $browser->assertValue('input[name="phone"]', '0931234567');
            $browser->assertValue('input[name="birthday"]', '15 октября 1980');
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->assertSeeIn('select.form-control > option[selected="selected"]', 'Ukraine');
            $browser->assertValue('input[name="address[city][]"]', 'Kyiv');
            $browser->assertValue('input[name="address[zip][]"]', '951753');
            $browser->assertValue('input[name="address[address][]"]', '5 Avenue');
        });
    }

    public function testClientEdit()
    {

        $regionSelect = Region::whereTranslation('name', 'USA')->first();

        $this->browse(function (Browser $browser) use ($regionSelect){
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->assertPathIs('/back');
            $browser->pause(500);
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(2) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(2)');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[1]).find(cell => cell.innerText === "uniqid@mail.com").closest(\'tr\').children[4].querySelectorAll(\'a\')[1].click()');
            $browser->pause(200);
            $browser->type('input[name="name"]', 'Client_0');
            $browser->pause(200);
            $browser->type('input[name="email"]', 'uniqid0@mail.com');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '1111111111');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', '1 апреля 1984');
            $browser->pause(200);
            $browser->type('input[name="password"]', rand(100000, 999999));
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('#address > div > div > div:nth-child(1) > div > div.x_title > ul > li:nth-child(1) > a'))
                ->click();
            $browser->select('div:nth-child(2) > div > div.x_content > div:nth-child(2) > select', $regionSelect->id);
            $browser->pause(500);
            $browser->type('#address > div > div > div:nth-child(2) > div > div.x_content > div:nth-child(3) > input', 'Kharkiv');
            $browser->pause(500);
            $browser->type('#address > div > div > div:nth-child(2) > div > div.x_content > div:nth-child(4) > input', '456357');
            $browser->pause(500);
            $browser->type('#address > div > div > div:nth-child(2) > div > div.x_content > div:nth-child(5) > input', '12 Palm Beach');
            $browser->pause(200);
            $browser->scrollTo(':nth-child(4) > button.btn.btn-primary.text-uppercase.pull-right');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(4) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[1]).find(cell => cell.innerText === "uniqid0@mail.com").closest(\'tr\').children[4].querySelectorAll(\'a\')[1].click()');
            $browser->pause(200);
            $browser->assertValue('input[name="name"]', 'Client_0');
            $browser->assertValue('input[name="email"]', 'uniqid0@mail.com');
            $browser->assertValue('input[name="phone"]', '1111111111');
            $browser->assertValue('input[name="birthday"]', '1 апреля 1984');
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->assertSeeIn('div:nth-child(1) > div > div.x_content > div:nth-child(2) > select > option[selected="selected"]', 'USA');
            $browser->assertValue('div:nth-child(1) > div > div.x_content > div:nth-child(3) > input[name="address[city][]"]', 'Kharkiv');
            $browser->assertValue('div:nth-child(1) > div > div.x_content > div:nth-child(4) > input[name="address[zip][]"]', '456357');
            $browser->assertValue('div:nth-child(1) > div > div.x_content > div:nth-child(5) > input[name="address[address][]"]', '12 Palm Beach');
            $browser->assertSeeIn('div:nth-child(2) > div > div.x_content > div:nth-child(2) > select > option[selected="selected"]', 'Ukraine');
            $browser->assertValue('div:nth-child(2) > div > div.x_content > div:nth-child(3) > input[name="address[city][]"]', 'Kyiv');
            $browser->assertValue('div:nth-child(2) > div > div.x_content > div:nth-child(4) > input[name="address[zip][]"]', '951753');
            $browser->assertValue('div:nth-child(2) > div > div.x_content > div:nth-child(5) > input[name="address[address][]"]', '5 Avenue');
            $browser->pause(500);
        });
    }

    public function testClientDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->assertPathIs('/back');
            $browser->pause(500);
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(2) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(2)');
            $browser->pause(1000);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[1]).find(cell => cell.innerText === "uniqid0@mail.com").closest(\'tr\').children[4].querySelectorAll(\'a\')[0].click()');
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->pause(200)
                    ->click('#confirmBtnYes');
            });
            $browser->pause(2000);
            $browser->assertSee('Success');
            $browser->driver->findElement(WebDriverBy::cssSelector('body > div.container.body > div > div.right_col > div:nth-child(3) > div > div.table-responsive > table > tbody > tr.bg-red > td.text-right > div > a.delete-btn.btn.btn-danger.btn-sm.text-uppercase.pull-right'))
                ->click();
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->pause(200)
                    ->click('#confirmBtnYes');
            });
            $browser->pause(500);
            $browser->assertSee('Success');
        });
    }
}

