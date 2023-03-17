<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\Page\PageTemplate;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PagesTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testPagesCreate()
    {
        $templateSort = PageTemplate::where('name', 'Category')->first();

        $this->browse(function (Browser $browser) use ($templateSort) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(4) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(1000);
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div:nth-child(2) > span'))
                ->click();
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div:nth-child(3) > span'))
                ->click();
            $browser->pause(200);
            $browser->type('input[name="alias"]', 'catalog/lipstick/test');
            $browser->select('select[name="page_template_id"]', $templateSort->id);
            $browser->pause(500);

            $browser->clickLink('Locale');
            $browser->pause(500);
            $browser->type('#v-pills-ru-locale > div:nth-child(1) > input', 'Помада in da house');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_45'))
                ->click();
            $browser->type('#cke_1_contents > textarea', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum.');
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_45'))
                ->click();
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_95'))
                ->click();
            $browser->type('#cke_2_contents > textarea', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_95'))
                ->click();
            $browser->pause(200);
            $browser->click('#v-pills-en-tab');
            $browser->pause(500);
            $browser->type('#v-pills-en-locale > div:nth-child(1) > input', 'Lipstick in da house');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_145'))
                ->click();
            $browser->type('#cke_3_contents > textarea', 'en Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum.');
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_145'))
                ->click();
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_195'))
                ->click();
            $browser->type('#cke_4_contents > textarea', 'en Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_195'))
                ->click();
            $browser->pause(200);

            $browser->click('#seo-tab');
            $browser->pause(200);
            $browser->type('#v-pills-ru-SEO > div:nth-child(1) > input', 'сео заголовок');
            $browser->type('#v-pills-ru-SEO > div:nth-child(2) > input', 'сео ключевые слова');
            $browser->type('#v-pills-ru-SEO > div:nth-child(3) > input', 'сео описание');
            $browser->type('#v-pills-ru-SEO > div:nth-child(4) > input', 'сео роботс');
            $browser->type('#v-pills-ru-SEO > div:nth-child(5) > input', 'сео каноникал');
            $browser->type('#v-pills-ru-SEO > div:nth-child(6) > textarea', 'сео контент');
            $browser->pause(200);
            $browser->clickLink('EN');
            $browser->pause(200);
            $browser->type('#v-pills-en-SEO > div:nth-child(1) > input', 'seo title');
            $browser->type('#v-pills-en-SEO > div:nth-child(2) > input', 'seo keywords');
            $browser->type('#v-pills-en-SEO > div:nth-child(3) > input', 'seo description');
            $browser->type('#v-pills-en-SEO > div:nth-child(4) > input', 'seo robots');
            $browser->type('#v-pills-en-SEO > div:nth-child(5) > input', 'seo canonical');
            $browser->type('#v-pills-en-SEO > div:nth-child(6) > textarea', 'seo content');
            $browser->pause(200);

            $browser->clickLink('Parent');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::linkText('Makeup'))
                ->click();
            $browser->pause(200);
            $browser->scrollTo('button.btn.btn-primary.text-uppercase.pull-right');
            $browser->press('button.btn.btn-info.text-uppercase.pull-right');
            $browser->pause(200);
            $browser->assertSee('Success');

            // проверка после сохранения

            $browser->assertChecked('#base > div:nth-child(2) > input.js-switch');
            $browser->assertChecked('#base > div:nth-child(3) > input.js-switch');
            $browser->assertChecked('#base > div:nth-child(4) > input.js-switch');
            $browser->assertValue('input[name="alias"]', 'catalog/lipstick/test');
            $browser->assertSelected('select[name="page_template_id"]', $templateSort->id);
            $browser->pause(500);

            $browser->clickLink('Locale');
            $browser->pause(500);
            $browser->assertValue('#v-pills-ru-locale > div:nth-child(1) > input', 'Помада in da house');
            $browser->driver->findElement(WebDriverBy::xpath('//textarea[contains(@name,\'ru[introtext]\')][contains(text(),\'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum.</p>\')] '));
            $browser->driver->findElement(WebDriverBy::xpath('//textarea[contains(@name,\'ru[description]\')][contains(text(),\'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.</p>\')]'));
            $browser->pause(200);
            $browser->click('#locale #v-pills-en-tab');
            $browser->pause(500);
            $browser->assertValue('#v-pills-en-locale > div:nth-child(1) > input', 'Lipstick in da house');
            $browser->driver->findElement(WebDriverBy::xpath('//textarea[contains(@name,\'en[introtext]\')][contains(text(),\'<p>en Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum.</p>\')] '));
            $browser->driver->findElement(WebDriverBy::xpath('//textarea[contains(@name,\'en[description]\')][contains(text(),\'<p>en Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.</p>\')]'));
            $browser->click('#seo-tab');
            $browser->pause(200);
            $browser->assertValue('#v-pills-ru-SEO > div:nth-child(1) > input', 'сео заголовок');
            $browser->assertValue('#v-pills-ru-SEO > div:nth-child(2) > input', 'сео ключевые слова');
            $browser->assertValue('#v-pills-ru-SEO > div:nth-child(3) > input', 'сео описание');
            $browser->assertValue('#v-pills-ru-SEO > div:nth-child(4) > input', 'сео роботс');
            $browser->assertValue('#v-pills-ru-SEO > div:nth-child(5) > input', 'сео каноникал');
            $browser->assertValue('#v-pills-ru-SEO > div:nth-child(6) > textarea', 'сео контент');
            $browser->pause(200);
            $browser->clickLink('EN');
            $browser->pause(200);
            $browser->assertValue('#v-pills-en-SEO > div:nth-child(1) > input', 'seo title');
            $browser->assertValue('#v-pills-en-SEO > div:nth-child(2) > input', 'seo keywords');
            $browser->assertValue('#v-pills-en-SEO > div:nth-child(3) > input', 'seo description');
            $browser->assertValue('#v-pills-en-SEO > div:nth-child(4) > input', 'seo robots');
            $browser->assertValue('#v-pills-en-SEO > div:nth-child(5) > input', 'seo canonical');
            $browser->assertValue('#v-pills-en-SEO > div:nth-child(6) > textarea', 'seo content');
            $browser->clickLink('Parent');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//a[contains(@class,\'jstree-clicked\')][contains(text(),\'Makeup\')] '));
            $browser->pause(1000);
        });
    }

    public function testPagesEdit()
    {

        $templateSort2 = PageTemplate::where('name', 'Content')->first();

        $this->browse(function (Browser $browser) use ($templateSort2) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(4) > a');
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::partialLinkText('Lipstick in da house'))
                ->click();
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div:nth-child(2) > span'))
                ->click();
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div:nth-child(3) > span'))
                ->click();
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div:nth-child(4) > span'))
                ->click();
            $browser->pause(500);
            $browser->type('input[name="alias"]', 'catalog/lipstick/tested');
            $browser->select('select[name="page_template_id"]', $templateSort2->id);
            $browser->pause(500);

            $browser->clickLink('Locale');
            $browser->pause(500);
            $browser->type('#v-pills-ru-locale > div:nth-child(1) > input', 'Модная помада');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_45'))
                ->click();
            $browser->type('#cke_1_contents > textarea', 'Test Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum.');
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_45'))
                ->click();
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_95'))
                ->click();
            $browser->type('#cke_2_contents > textarea', 'Test Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_95'))
                ->click();
            $browser->pause(200);
            $browser->clickLink('EN');
            $browser->pause(500);
            $browser->type('#v-pills-en-locale > div:nth-child(1) > input', 'Fashion lipstick');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_145'))
                ->click();
            $browser->type('#cke_3_contents > textarea', 'Test en Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum.');
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_145'))
                ->click();
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_195'))
                ->click();
            $browser->type('#cke_4_contents > textarea', 'Test en Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->driver->findElement(WebDriverBy::cssSelector('#cke_195'))
                ->click();
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#seo-tab'))
                ->click();
            $browser->pause(200);
            $browser->type('#v-pills-ru-SEO > div:nth-child(1) > input', 'сео заголовок2');
            $browser->type('#v-pills-ru-SEO > div:nth-child(2) > input', 'сео ключевые слова2');
            $browser->type('#v-pills-ru-SEO > div:nth-child(3) > input', 'сео описание2');
            $browser->type('#v-pills-ru-SEO > div:nth-child(4) > input', 'сео роботс2');
            $browser->type('#v-pills-ru-SEO > div:nth-child(5) > input', 'сео каноникал2');
            $browser->type('#v-pills-ru-SEO > div:nth-child(6) > textarea', 'сео контент2' );
            $browser->pause(200);
            $browser->clickLink('EN');
            $browser->pause(200);
            $browser->type('#v-pills-en-SEO > div:nth-child(1) > input', 'seo title2');
            $browser->type('#v-pills-en-SEO > div:nth-child(2) > input', 'seo keywords2');
            $browser->type('#v-pills-en-SEO > div:nth-child(3) > input', 'seo description2');
            $browser->type('#v-pills-en-SEO > div:nth-child(4) > input', 'seo robots2');
            $browser->type('#v-pills-en-SEO > div:nth-child(5) > input', 'seo canonical2');
            $browser->type('#v-pills-en-SEO > div:nth-child(6) > textarea', 'seo content2');
            $browser->pause(200);
            $browser->clickLink('Parent');
            $browser->pause(500);
            $browser->scrollTo('li[aria-selected="true"]');
            $browser->pause(1000);
            $browser->driver->findElement(WebDriverBy::linkText('Face cosmetics'))
                ->click();
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::linkText('Makeup'))
                ->click();
            $browser->pause(200);
            $browser->scrollTo('button.btn.btn-info.text-uppercase.pull-right');
            $browser->press('button.btn.btn-info.text-uppercase.pull-right');
            $browser->pause(1000);
            $browser->assertSee('Success');
            $browser->pause(200);

            // проверка после редактирования

            $browser->assertNotChecked('#base > div:nth-child(2) > input.js-switch');
            $browser->assertNotChecked('#base > div:nth-child(3) > input.js-switch');
            $browser->assertNotChecked('#base > div:nth-child(4) > input.js-switch');
            $browser->assertSelected('select[name="page_template_id"]', $templateSort2->id);
            $browser->pause(500);

            $browser->clickLink('Locale');
            $browser->pause(500);
            $browser->assertValue('#v-pills-ru-locale > div:nth-child(1) > input', 'Модная помада');
            $browser->driver->findElement(WebDriverBy::xpath('//textarea[contains(@name,\'ru[introtext]\')][contains(text(),\'<p>Test Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum.</p>\')] '));
            $browser->driver->findElement(WebDriverBy::xpath('//textarea[contains(@name,\'ru[description]\')][contains(text(),\'<p>Test Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.</p>\')]'));
            $browser->pause(200);
            $browser->click('#locale #v-pills-en-tab');
            $browser->pause(500);
            $browser->assertValue('#v-pills-en-locale > div:nth-child(1) > input', 'Fashion lipstick');
            $browser->driver->findElement(WebDriverBy::xpath('//textarea[contains(@name,\'en[introtext]\')][contains(text(),\'<p>Test en Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum.</p>\')] '));
            $browser->driver->findElement(WebDriverBy::xpath('//textarea[contains(@name,\'en[description]\')][contains(text(),\'<p>Test en Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.</p>\')]'));
            $browser->click('#seo-tab');
            $browser->pause(200);
            $browser->assertValue('#v-pills-ru-SEO > div:nth-child(1) > input', 'сео заголовок2');
            $browser->assertValue('#v-pills-ru-SEO > div:nth-child(2) > input', 'сео ключевые слова2');
            $browser->assertValue('#v-pills-ru-SEO > div:nth-child(3) > input', 'сео описание2');
            $browser->assertValue('#v-pills-ru-SEO > div:nth-child(4) > input', 'сео роботс2');
            $browser->assertValue('#v-pills-ru-SEO > div:nth-child(5) > input', 'сео каноникал2');
            $browser->assertValue('#v-pills-ru-SEO > div:nth-child(6) > textarea', 'сео контент2');
            $browser->pause(200);
            $browser->clickLink('EN');
            $browser->pause(200);
            $browser->assertValue('#v-pills-en-SEO > div:nth-child(1) > input', 'seo title2');
            $browser->assertValue('#v-pills-en-SEO > div:nth-child(2) > input', 'seo keywords2');
            $browser->assertValue('#v-pills-en-SEO > div:nth-child(3) > input', 'seo description2');
            $browser->assertValue('#v-pills-en-SEO > div:nth-child(5) > input', 'seo canonical2');
            $browser->assertValue('#v-pills-en-SEO > div:nth-child(6) > textarea', 'seo content2');
            $browser->clickLink('Parent');
            $browser->pause(500);
//            $browser->driver->findElement(WebDriverBy::xpath('//a[contains(@class,\'jstree-clicked\')][contains(text(),\'Face cosmetics\')]'));  // todo раскоментить после фикса (#640)
            $browser->pause(1000);
            $browser->scrollTo('button.btn.btn-primary.text-uppercase.pull-right');
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(200);
            $browser->assertSee('Success');
            $browser->pause(200);
        });
    }

    public function testPagesDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(4) > a');
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::partialLinkText('Fashion lipstic'))
                ->click();
            $browser->pause(200);
            $browser->click('a.btn.btn-danger.text-uppercase.pull-right');
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

