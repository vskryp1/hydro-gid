<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RoleTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRoleCreate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(2) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(3)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->type('name', '@dmin');
            $browser->driver->findElement(WebDriverBy::xpath('//span[@class=\'switchery switchery-default\']//small'))
                ->click();
            $browser->check('roles[]', 'add clients');
            $browser->check('roles[]', 'edit clients');
            $browser->check('roles[]', 'delete clients');
            $browser->scrollTo('div:nth-child(3) > div:nth-child(13) > input[type="checkbox"]')
                ->check('roles[]', 'add roles');
            $browser->pause(1000);
            $browser->scrollTo('div:nth-child(3) > div:nth-child(23) > input[type="checkbox"]')
                ->check('roles[]', 'delete product statuses');
            $browser->pause(1000);
            $browser->scrollTo('div:nth-child(3) > div:nth-child(82) > input[type="checkbox"]')
                ->check('roles[]', 'delete subscribers');
            $browser->pause(1000);
            $browser->scrollTo('button.btn.btn-primary.text-uppercase.pull-right');
            $browser->click('button[type="submit"]');
            $browser->pause(500);
            $browser->assertSee('Success');

        });
    }

    public function testRoleEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(2) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(3)');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "@dmin").closest(\'tr\').children[3].querySelectorAll(\'a\')[1].click()');
            $browser->assertChecked('roles[]', 'add clients');
            $browser->assertChecked('roles[]', 'edit clients');
            $browser->assertChecked('roles[]', 'delete clients');
            $browser->assertChecked('roles[]', 'add roles');
            $browser->assertChecked('roles[]', 'delete product statuses');
            $browser->assertChecked('roles[]', 'delete subscribers');
            $browser->clear('name');
            $browser->type('name', 'Product_Manager');
            $browser->uncheck('roles[]', 'add clients');
            $browser->uncheck('roles[]', 'edit clients');
            $browser->uncheck('roles[]', 'delete clients');
            $browser->check('roles[]', 'add admins');
            $browser->check('roles[]', 'edit admins');
            $browser->check('roles[]', 'delete admins');
            $browser->scrollTo('button.btn.btn-primary.text-uppercase.pull-right');
            $browser->click('button[type="submit"]');
            $browser->pause(500);
            $browser->assertSee('Success');
        });
    }

    public function testRoleDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(2) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(3)');
            $browser->pause(2000);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "Product_Manager").closest(\'tr\').children[3].querySelectorAll(\'a\')[1].click()');
            $browser->assertNotChecked('roles[]', 'add clients');
            $browser->assertNotChecked('roles[]', 'edit clients');
            $browser->assertNotChecked('roles[]', 'delete clients');
            $browser->assertChecked('roles[]', 'add roles');
            $browser->assertChecked('roles[]', 'delete product statuses');
            $browser->assertChecked('roles[]', 'delete subscribers');
            $browser->clickLink('Roles');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "Product_Manager").closest(\'tr\').children[3].querySelectorAll(\'a\')[0].click()');
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->driver->findElement(WebDriverBy::cssSelector('#confirmBtnYes'))
                    ->click();
            });
            $browser->assertSee('Success');
            $browser->pause(200);
            $browser->assertDontSee('Product_Manager');
            $browser->pause(500);
        });
    }
}

