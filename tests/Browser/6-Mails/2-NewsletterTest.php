<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Helpers\MailHelper;
use App\Mail\Frontend\CallbackMail;
use App\Mail\TemplateEmail;
use App\Models\Template;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Jobs\ShipOrder;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class Newsletter extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     * @throws \Throwable
     */
    public function testNewsletter()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);

            // с начала создаём шаблон для рассылки

            $browser->clickLink('Mails');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->click('#v-pills-ru-tab');
            $browser->pause(500);
            $browser->type('input[name="ru[name]"]', 'Новый шаблон письма');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_37'))
                ->click();
            $browser->pause(1000);
            $browser->type('#cke_1_contents > textarea', 'Здравствуйте уважаемый абонент! Это тест рассылка');
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
            $browser->type('#cke_2_contents > textarea', 'Hello dear subscriber! This is a test mailing');
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_88'))
                ->click();
            $browser->pause(1000);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->assertValue('input[name="ru[name]"]', 'Новый шаблон письма');
            $browser->driver->findElement(WebDriverBy::xpath('//textarea[contains(@name,\'ru[body]\')][contains(text(),\'<p>Здравствуйте уважаемый абонент! Это тест рассылка</p>\')] '));
            $browser->click('#v-pills-en-tab');
            $browser->pause(500);
            $browser->assertValue('input[name="en[name]"]', 'New mail template');
            $browser->driver->findElement(WebDriverBy::xpath('//textarea[contains(@name,\'en[body]\')][contains(text(),\'<p>Hello dear subscriber! This is a test mailing</p>\')] '));
            $browser->pause(500);

            // создание рассылки

            $browser->clickLink('Mails');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(5)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(500);
            $browser->type('#template-name', 'template-test');
            $browser->pause(300);
            $browser->select('#template-body', Template::whereTranslation('name', 'New mail template')->first()->id);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(300);
            $browser->assertSee('Success');
            $browser->pause(300);
            $browser->assertValue('#template-name', 'template-test');
            $browser->assertSelected('#template-body', Template::whereTranslation('name', 'New mail template')->first()->id);
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > form > div:nth-child(6) > a'))
                ->click();
            $browser->pause(300);
            $browser->assertSee('Success');

        });
    }

    public function testNewsletterEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);

            // с начала создаём ещё один шаблон для рассылки

            $browser->clickLink('Mails');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->click('#v-pills-ru-tab');
            $browser->pause(500);
            $browser->type('input[name="ru[name]"]', 'Ещё один шаблон письма');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_37'))
                ->click();
            $browser->pause(1000);
            $browser->type('#cke_1_contents > textarea', 'Здравствуйте уважаемый абонент! Это тест рассылочка!');
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_37'))
                ->click();
            $browser->pause(1000);
            $browser->click('#v-pills-en-tab');
            $browser->pause(500);
            $browser->type('input[name="en[name]"]', 'Another mail template');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_88'))
                ->click();
            $browser->pause(1000);
            $browser->type('#cke_2_contents > textarea', 'Hello dear subscriber! This is a test mailing list!');
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_88'))
                ->click();
            $browser->pause(1000);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->assertValue('input[name="ru[name]"]', 'Ещё один шаблон письма');
            $browser->driver->findElement(WebDriverBy::xpath('//textarea[contains(@name,\'ru[body]\')][contains(text(),\'<p>Здравствуйте уважаемый абонент! Это тест рассылочка!</p>\')] '));
            $browser->click('#v-pills-en-tab');
            $browser->pause(500);
            $browser->assertValue('input[name="en[name]"]', 'Another mail template');
            $browser->driver->findElement(WebDriverBy::xpath('//textarea[contains(@name,\'en[body]\')][contains(text(),\'<p>Hello dear subscriber! This is a test mailing list!</p>\')] '));
            $browser->pause(500);

            // редактирование рассылки

            $browser->clickLink('Mails');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(5)');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "template-test").closest(\'tr\').children[2].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->type('#template-name', 'template-test2');
            $browser->pause(300);
            $browser->select('#template-body', Template::whereTranslation('name', 'Another mail template')->first()->id);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(300);
            $browser->assertSee('Success');
            $browser->pause(300);
            $browser->assertValue('#template-name', 'template-test2');
            $browser->assertSelected('#template-body', Template::whereTranslation('name', 'Another mail template')->first()->id);
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > form > div:nth-child(6) > a'))
                ->click();
            $browser->pause(300);
            $browser->assertSee('Success');

        });
    }

    public function testNewsletterDelete()
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
            $browser->click('li.active > ul > li:nth-child(5)');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "template-test2").closest(\'tr\').children[2].querySelectorAll(\'a\')[0].click()');
            $browser->pause(500);
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->driver->findElement(WebDriverBy::cssSelector('#confirmBtnYes'))
                    ->click();
            });
            $browser->pause(200);
            $browser->assertSee('Success');
            $browser->pause(200);
            Template::whereTranslation('name', 'New mail template')->forceDelete();
            Template::whereTranslation('name', 'Another mail template')->forceDelete();
        });
    }
}



