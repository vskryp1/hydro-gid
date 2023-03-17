<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OrderStatusTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testOrderStatusCreate()
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
            $browser->click('li.active > ul > li:nth-child(2)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(200);
            $browser->type('input[name="color"]', 'rgb(48,176,176)');
            $browser->type('input[name="position"]', '1');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[@id=\'base\']//div//div[3]//span[1]'))
                ->click();
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'right_col\')]//div//div[4]//span[1]'))
                ->click();
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'right_col\')]//div//div[5]//span[1]'))
                ->click();
            $browser->pause(200);
            $browser->clickLink('Locale');
            $browser->pause(500);
            $browser->type('input[name="ru[name]"]', 'возвращён');
            $browser->pause(200);
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'returned');
            $browser->pause(200);
            $browser->click('button.btn.btn-info.text-uppercase.pull-right');
            $browser->pause(200);
            $browser->assertSee('Success');
            $browser->assertValue('input[name="color"]', 'rgb(48,176,176)');
            $browser->assertValue('input[name="position"]', '1');
            $browser->assertChecked('input[name="active"]');
            $browser->assertChecked('input[name="default"]');
            $browser->assertChecked('input[name="processed"]');
            $browser->pause(200);
            $browser->clickLink('Locale');
            $browser->pause(500);
            $browser->assertValue('input[name="ru[name]"]', 'возвращён');
            $browser->pause(200);
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'returned');
            $browser->pause(200);
        });
    }

    public function testOrderStatusEdit()
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
            $browser->click('li.active > ul > li:nth-child(2)');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "returned").closest(\'tr\').children[3].querySelectorAll(\'a\')[1].click()');
            $browser->pause(200);
            $browser->type('input[name="color"]', 'rgb(255,176,176)');
            $browser->type('input[name="position"]', '2');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[@id=\'base\']//div//div[3]//span[1]'))
                ->click();
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'right_col\')]//div//div[4]//span[1]'))
                ->click();
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'right_col\')]//div//div[5]//span[1]'))
                ->click();
            $browser->pause(200);
            $browser->clickLink('Locale');
            $browser->pause(500);
            $browser->type('input[name="ru[name]"]', 'возвращён опять');
            $browser->pause(200);
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'returned again');
            $browser->pause(200);
            $browser->click(' button.btn.btn-info.text-uppercase.pull-right');
            $browser->pause(200);
            $browser->assertSee('Success');
            $browser->pause(200);
            $browser->assertValue('input[name="color"]', 'rgb(255,176,176)');
            $browser->assertValue('input[name="position"]', '2');
            $browser->assertNotChecked('input[name="active"]');
            $browser->assertNotChecked('input[name="default"]');
//            $browser->assertNotChecked('input[name="processed"]');   // todo раскомментить после фикса
            $browser->pause(200);
            $browser->clickLink('Locale');
            $browser->pause(500);
            $browser->assertValue('input[name="ru[name]"]', 'возвращён опять');
            $browser->pause(200);
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'returned again');
            $browser->pause(200);
        });
    }

    public function testOrderStatusDelete()
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
            $browser->click('li.active > ul > li:nth-child(2)');
            $browser->pause(1500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "returned again").closest(\'tr\').children[3].querySelectorAll(\'a\')[0].click()');
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

