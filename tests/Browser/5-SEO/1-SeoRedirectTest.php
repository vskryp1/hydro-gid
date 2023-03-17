<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SeoRedirectTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testSeoRedirectCreate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(6) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(500);
            $browser->select('select[name="status_code"]', '302');
            $browser->type('input[name="from"]', 'https://www.site.com');
            $browser->type('input[name="to"]', 'https://site.com');
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(200);
            $browser->assertSee('Success');
            $browser->pause(200);
            $browser->assertSelected('select[name="status_code"]', '302');
            $browser->assertValue('input[name="from"]', 'https://www.site.com');
            $browser->assertValue('input[name="to"]', 'https://site.com');
        });
    }

    public function testSeoRedirectEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(6) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[1]).find(cell => cell.innerText === "https://www.site.com").closest(\'tr\').children[3].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->select('select[name="status_code"]', '301');
            $browser->type('input[name="from"]', 'https://www.new.site.com');
            $browser->type('input[name="to"]', 'https://new.site.com');
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(200);
            $browser->assertSee('Success');
            $browser->pause(200);
            $browser->assertSelected('select[name="status_code"]', '301');
            $browser->assertValue('input[name="from"]', 'https://www.new.site.com');
            $browser->assertValue('input[name="to"]', 'https://new.site.com');
        });
    }

    public function testSeoRedirectDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(6) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[1]).find(cell => cell.innerText === "https://www.new.site.com").closest(\'tr\').children[3].querySelectorAll(\'a\')[0].click()');
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

