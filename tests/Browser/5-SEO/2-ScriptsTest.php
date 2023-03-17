<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ScriptsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testScripts()
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
            $browser->click('li.active > ul > li:nth-child(3)');
            $browser->pause(200);
            // вписываю и проверяю новые значения
            $browser->type('textarea[name="head"]', 'Test head');
            $browser->type('textarea[name="afterHead"]', 'Test afterhead');
            $browser->type('textarea[name="footer"]', 'Test footer');
            $browser->pause(200);
            $browser->scrollTo('button.btn.btn-primary.text-uppercase.pull-right');
            $browser->click('button.btn.btn-primary.text-uppercase.pull-right');
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(200);
            //  редактирую и проверяю значения
            $browser->assertSeeIn('textarea[name="head"]', 'Test head');
            $browser->assertSeeIn('textarea[name="afterHead"]', 'Test afterhead');
            $browser->assertSeeIn('textarea[name="footer"]', 'Test footer');
            $browser->type('textarea[name="head"]', 'Test head2');
            $browser->type('textarea[name="afterHead"]', 'Test afterhead2');
            $browser->type('textarea[name="footer"]', 'Test footer2');
            $browser->pause(200);
            $browser->scrollTo('button.btn.btn-primary.text-uppercase.pull-right');
            $browser->click('button.btn.btn-primary.text-uppercase.pull-right');
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(200);
            // стираю значения
            $browser->clear('textarea[name="head"]');
            $browser->clear('textarea[name="afterHead"]');
            $browser->clear('textarea[name="footer"]');
            $browser->pause(200);
            $browser->scrollTo('button.btn.btn-primary.text-uppercase.pull-right');
            $browser->click('button.btn.btn-primary.text-uppercase.pull-right');
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(200);
        });
    }
}

