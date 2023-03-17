<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PermissionsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testPermissionsCreate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(2) > a');
            $browser->pause(1500);
            $browser->click('li.active > ul > li:nth-child(4)');
            $browser->pause(1500);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(200);
            $browser->type('#roleName', 'check client');
            $browser->driver->findElement(WebDriverBy::xpath('//div[@class=\'col-12 col-sm-12 col-md-12 col-lg-12\']//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(200);
        });
    }

    public function testPermissionsEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(2) > a');
            $browser->pause(1500);
            $browser->click('li.active > ul > li:nth-child(4)');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "check client").closest(\'tr\').children[1].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->assertValue('#roleName', 'check client');
            $browser->type('#roleName', 'client check');
            $browser->driver->findElement(WebDriverBy::xpath('//div[@class=\'col-12 col-sm-12 col-md-12 col-lg-12\']//button[2]'))
                ->click();
            $browser->assertSee('Success');
            $browser->pause(500);
        });
    }

    public function testPermissionsDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(2) > a');
            $browser->pause(1500);
            $browser->click('li.active > ul > li:nth-child(4)');
            $browser->pause(1000);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "client check").closest(\'tr\').children[1].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->assertValue('#roleName', 'client check');
            $browser->clickLink('Permissions');
            $browser->pause(1000);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "client check").closest(\'tr\').children[1].querySelectorAll(\'a\')[0].click()');
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

