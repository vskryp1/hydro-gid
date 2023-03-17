<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateUser()
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
            $browser->pause(1000);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(200);
            $browser->type('#userCreateName', 'Admin007');
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'testadmin@mail.com');
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div:nth-child(3) > span'))
                ->click();
            $browser->type('#userCreatePhone', '1111111111');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div:nth-child(6) > span'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', uniqid());
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(1000);
            $browser->assertSee('Success');

        });
    }

    public function testEditUser()
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
            $browser->pause(1000);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[1]).find(cell => cell.innerText === "testadmin@mail.com").closest(\'tr\').children[5].querySelectorAll(\'a\')[1].click()');
            $browser->assertValue('#userCreateName', 'Admin007');
            $browser->assertValue('#userCreateEmail', 'testadmin@mail.com');
            $browser->assertValue('#userCreatePhone', '1111111111');
            $browser->assertSelected('#userCreateRole', '2');

            $browser->type('#userCreateName', 'Admin008');
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'testadmin2@mail.com');
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div:nth-child(3) > span'))
                ->click();
            $browser->type('#userCreatePhone', '2222223344');
            $browser->select('#userCreateRole', '3');
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div:nth-child(6) > span'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', uniqid());
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
        });
    }

    public function testDeleteUser()
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
            $browser->pause(1000);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(1000);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[1]).find(cell => cell.innerText === "testadmin2@mail.com").closest(\'tr\').children[5].querySelectorAll(\'a\')[1].click()');
            $browser->pause(1000);
            $browser->assertValue('#userCreateName', 'Admin008');
            $browser->assertValue('#userCreateEmail', 'testadmin2@mail.com');
            $browser->assertValue('#userCreatePhone', '2222223344');
            $browser->assertSelected('#userCreateRole', '3');
            $browser->clickLink('Managers');
            $browser->pause(1000);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[1]).find(cell => cell.innerText === "testadmin2@mail.com").closest(\'tr\').children[5].querySelectorAll(\'a\')[0].click()');
            $browser->pause(200);
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->pause(200)
                    ->click('#confirmBtnYes');
            });
            $browser->pause(1000);
            $browser->assertSee('Success');
            $browser->driver->findElement(WebDriverBy::cssSelector('.bg-red > td.text-right > div > a.delete-btn.btn.btn-danger.btn-sm.text-uppercase.pull-right'))
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

