<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\Region\Region;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegionsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegionsCreate()
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
            $browser->click('li.active > ul > li:nth-child(3)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(200);
            $browser->type('input[name="position"]', '11');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div:nth-child(2) > span'))
                ->click();
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div:nth-child(3) > span'))
                ->click();
            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'Нарния');
            $browser->click('#locale-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'Narnia');
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->assertValue('input[name="position"]', '11');
            $browser->assertChecked('#active');
            $browser->assertChecked('#default');
            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[name]"]', 'Нарния');
            $browser->click('#locale-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'Narnia');

        });
    }

    public function testRegionsEdit()
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
            $browser->click('li.active > ul > li:nth-child(3)');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "Narnia").closest(\'tr\').children[4].querySelectorAll(\'a\')[1].click()');
            $browser->pause(200);
            $browser->type('#base > div > div > div:nth-child(1) > input', '22');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div:nth-child(2) > span'))
                ->click();
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div:nth-child(3) > span'))
                ->click();
            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->type('#locales-ru > div > input', 'Нарния сити');
            $browser->click('#locale-en-tab');
            $browser->pause(200);
            $browser->type('#locales-en > div > input', 'Narnia city');
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->assertValue('input[name="position"]', '22');
            $browser->assertNotChecked('#active');
            $browser->assertNotChecked('#default');
            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[name]"]', 'Нарния сити');
            $browser->click('#locale-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'Narnia city');


        });
    }

    public function testRegionsDelete()
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
            $browser->click('li.active > ul > li:nth-child(3)');
            $browser->pause(1500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "Narnia city").closest(\'tr\').children[4].querySelectorAll(\'a\')[0].click()');
            $browser->pause(500);
            $browser->assertSee('Are you sure you want delete this?'); // 'Вы уверены, что хотите удалить это?'
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('#confirmBtnYes'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Region removed successfully.'); //'Регион удален'
            $browser->pause(500);
            Region::whereTranslation('name', 'Ukraine')->update(['is_default'=>'1']);
            Region::whereTranslation('name', 'Narnia city')->forceDelete();

        });
    }
}


