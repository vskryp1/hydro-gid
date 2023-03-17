<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MailTemplateTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testMailTemplateCreate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->clickLink('Mails');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(500);
            $browser->click('#v-pills-ru-tab');
            $browser->pause(500);
            $browser->type('input[name="ru[name]"]', 'Шаблон письма');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_37'))
                ->click();
            $browser->pause(1000);
            $browser->type('#cke_1_contents > textarea', '北京位於華北平原的西北边缘，背靠燕山，有永定河流经老城西南，毗邻天津市、河北省，是一座有三千余年建城历史、八百六十余年建都史的历史文化名城，历史上有金、元、明、清、中华民国（北洋政府时期）等五个朝代在此定都，以及数个政权建政于此，荟萃了自元明清以来的中华文化，拥有众多历史名胜古迹和人文景观。《不列颠百科全书》将北京形容为全球最伟大的城市之一，而且断言，“这座城市是中国历史上最重要的组成部分。在中国过去的八个世纪里，不论历史是否悠久，几乎北京所有主要建筑都拥有着不可磨灭的民族和历史意义”。北京古迹众多，著名的有故宫、天坛、颐和园、圆明园、北海公园等');
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_37'))
                ->click();
            $browser->pause(1000);
            $browser->click('#v-pills-en-tab');
            $browser->pause(500);
            $browser->type('input[name="en[name]"]', 'Mail template');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_88'))
                ->click();
            $browser->pause(1000);
            $browser->type('#cke_2_contents > textarea', 'وضع ابن الهيثم تصور واضح للعلاقة بين النموذج الرياضي المثالي ومنظومة الظواهر الملحوظة.');
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_88'))
                ->click();
            $browser->pause(1000);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->assertValue('input[name="ru[name]"]', 'Шаблон письма');
            $browser->driver->findElement(WebDriverBy::xpath('//textarea[contains(@name,\'ru[body]\')][contains(text(),\'<p>北京位於華北平原的西北边缘，背靠燕山，有永定河流经老城西南，毗邻天津市、河北省，是一座有三千余年建城历史、八百六十余年建都史的历史文化名城，历史上有金、元、明、清、中华民国（北洋政府时期）等五个朝代在此定都，以及数个政权建政于此，荟萃了自元明清以来的中华文化，拥有众多历史名胜古迹和人文景观。《不列颠百科全书》将北京形容为全球最伟大的城市之一，而且断言，“这座城市是中国历史上最重要的组成部分。在中国过去的八个世纪里，不论历史是否悠久，几乎北京所有主要建筑都拥有着不可磨灭的民族和历史意义”。北京古迹众多，著名的有故宫、天坛、颐和园、圆明园、北海公园等</p>\')] '));
            $browser->click('#v-pills-en-tab');
            $browser->pause(500);
            $browser->assertValue('input[name="en[name]"]', 'Mail template');
            $browser->driver->findElement(WebDriverBy::xpath('//textarea[contains(@name,\'en[body]\')][contains(text(),\'<p>وضع ابن الهيثم تصور واضح للعلاقة بين النموذج الرياضي المثالي ومنظومة الظواهر الملحوظة.</p>\')] '));
        });
    }

    public function testMailTemplateEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->clickLink('Mails');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "Mail template").closest(\'tr\').children[1].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->click('#v-pills-ru-tab');
            $browser->pause(500);
            $browser->type('input[name="ru[name]"]', 'Новый шаблон письма');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_37'))
                ->click();
            $browser->pause(1000);
            $browser->type('#cke_1_contents > textarea', 'Здравствуйте уважаемый абонент!');
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_37'))
                ->click();
            $browser->pause(1000);
            $browser->click('#v-pills-en-tab');
            $browser->pause(500);
            $browser->type('input[name="en[name]"]', 'New mail template');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_88'))
                ->click();
            $browser->pause(1000);
            $browser->type('#cke_2_contents > textarea', 'Hello dear subscriber!');
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_88'))
                ->click();
            $browser->pause(1000);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->assertValue('input[name="ru[name]"]', 'Новый шаблон письма');
            $browser->driver->findElement(WebDriverBy::xpath('//textarea[contains(@name,\'ru[body]\')][contains(text(),\'<p>Здравствуйте уважаемый абонент!</p>\')] '));
            $browser->click('#v-pills-en-tab');
            $browser->pause(500);
            $browser->assertValue('input[name="en[name]"]', 'New mail template');
            $browser->driver->findElement(WebDriverBy::xpath('//textarea[contains(@name,\'en[body]\')][contains(text(),\'<p>Hello dear subscriber!</p>\')] '));
        });
    }

    public function testMailTemplateDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->clickLink('Mails');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(1500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "New mail template").closest(\'tr\').children[1].querySelectorAll(\'a\')[0].click()');
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


