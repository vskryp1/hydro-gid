<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SettingsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testSettingsCreate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(9) > a');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(5)');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(500);
            $browser->type('input[name="key"]', 'test-key');
            $browser->type('input[name="value"]', 'test setting');
            $browser->click('#base > div > div > div:nth-child(3) > span');
            $browser->click('#locale-tab');
            $browser->pause(500);
            $browser->type('input[name="values[ru]"]', 'тестовая настройка');
            $browser->click('#locale-en-tab');
            $browser->pause(500);
            $browser->type('input[name="values[en]"]', 'test setting');
            $browser->click('button.btn.btn-info.text-uppercase.pull-right');
            $browser->pause(500);
            // todo убрать выбор в таблице после фикса (#656)
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "test-key").closest(\'tr\').children[3].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->assertValue('input[name="key"]', 'test-key');
            $browser->assertValue('input[name="value"]', 'test setting');
            $browser->assertMissing('#active');
            $browser->click('#locale-tab');
            $browser->pause(500);
            $browser->assertValue('input[name="values[ru]"]', 'тестовая настройка');
            $browser->click('#locale-en-tab');
            $browser->pause(500);
            $browser->assertValue('input[name="values[en]"]', 'test setting');

        });
    }

    public function testSettingsEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(9) > a');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(5)');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "test-key").closest(\'tr\').children[3].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->type('input[name="value"]', 'test setting2');
            $browser->click('#locale-tab');
            $browser->pause(500);
            $browser->type('input[name="values[ru]"]', 'тестовая настройка2');
            $browser->click('#locale-en-tab');
            $browser->pause(500);
            $browser->type('input[name="values[en]"]', 'test setting2');
            $browser->click('button.btn.btn-info.text-uppercase.pull-right');
            $browser->pause(500);
            // todo убрать выбор в таблице после фикса (#656)
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "test-key").closest(\'tr\').children[3].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->assertValue('input[name="value"]', 'test setting2');
            $browser->assertMissing('#active');
            $browser->click('#locale-tab');
            $browser->pause(500);
            $browser->assertValue('input[name="values[ru]"]', 'тестовая настройка2');
            $browser->click('#locale-en-tab');
            $browser->pause(500);
            $browser->assertValue('input[name="values[en]"]', 'test setting2');
        });
    }

    public function testSettingsDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(9) > a');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(5)');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "test-key").closest(\'tr\').children[3].querySelectorAll(\'a\')[0].click()');
            $browser->pause(500);
            $browser->assertSee('Are you sure you want delete this?'); // 'Вы уверены, что хотите удалить это?'
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('#confirmBtnYes'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success!');
            $browser->pause(500);
        });
    }
}

