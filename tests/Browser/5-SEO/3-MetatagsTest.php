<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MetatagsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testMetatags()
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
            $browser->click('li.active > ul > li:nth-child(4)');
            $browser->pause(200);
            $browser->click('div.col-6.col-md-4.col-lg-2 > p > a');
            $browser->pause(200);

            // вписываю и проверяю новые значения

            $browser->type('#js_seo_url', 'en/example-page');
            $browser->type('#js_seo_title', 'seo title');
            $browser->type('#js_seo_key', 'seo keyword');
            $browser->type('#js_seo_desc', 'seo description');
            $browser->type('#js_seo_robots', 'seo robots');
            $browser->type('#js_seo_canonical', 'seo canonical');
            $browser->type('#js_seo_content', 'seo content');
            $browser->scrollTo('button.btn.btn-info.text-uppercase.pull-right');
            $browser->click('button.btn.btn-info.text-uppercase.pull-right');
            $browser->pause(1000);
            $browser->assertValue('#js_seo_url', 'en/example-page');
            $browser->assertValue('#js_seo_title', 'seo title');
            $browser->assertValue('#js_seo_key', 'seo keyword');
            $browser->assertValue('#js_seo_desc', 'seo description');
            $browser->assertValue('#js_seo_robots', 'seo robots');
            $browser->assertValue('#js_seo_canonical', 'seo canonical');
            $browser->assertSeeIn('#js_seo_content', 'seo content');
        });
    }

    public function testMetatagsEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(500);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(6) > a');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(4)');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "en/example-page").closest(\'tr\').children[7].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);

            // редактирую и проверяю новые значения

            $browser->type('#js_seo_url', 'en/example-page/test');
            $browser->type('#js_seo_title', 'seo title2');
            $browser->type('#js_seo_key', 'seo keyword2');
            $browser->type('#js_seo_desc', 'seo description2');
            $browser->type('#js_seo_robots', 'seo robots2');
            $browser->type('#js_seo_canonical', 'seo canonical2');
            $browser->type('#js_seo_content', 'seo content2');
            $browser->scrollTo('button.btn.btn-info.text-uppercase.pull-right');
            $browser->click('button.btn.btn-info.text-uppercase.pull-right');
            $browser->pause(1000);
            $browser->assertValue('#js_seo_url', 'en/example-page/test');
            $browser->assertValue('#js_seo_title', 'seo title2');
            $browser->assertValue('#js_seo_key', 'seo keyword2');
            $browser->assertValue('#js_seo_desc', 'seo description2');
            $browser->assertValue('#js_seo_robots', 'seo robots2');
            $browser->assertValue('#js_seo_canonical', 'seo canonical2');
            $browser->assertSeeIn('#js_seo_content', 'seo content2');
        });
    }

    public function testMetatagsDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(500);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(6) > a');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(4)');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "en/example-page/test").closest(\'tr\').children[7].querySelectorAll(\'a\')[0].click()');
            $browser->pause(500);
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->press('#confirmBtnYes');
            });
            $browser->assertSee('Success');
            $browser->pause(1000);
        });
    }
}

