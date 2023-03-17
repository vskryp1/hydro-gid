<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\Page\PageAdditionalField;
use App\Models\Page\PageAdditionalFieldType;
use App\Models\Page\PageTemplate;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PageTemplateTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    public function testPageTemplateCreate()
    {

        $additional = PageAdditionalFieldType::where('type', 'file')->first();

        $this->browse(function (Browser $browser) use ($additional) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(4) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(2)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(1000);
            $browser->type('input[name="name"]', 'Test_Page');
            $browser->type('input[name="file"]', 'test_page');
            $browser->type('textarea[name="content"]', 'Test en Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('div:nth-child(6) > span'))
                ->click();
            $browser->driver->findElement(WebDriverBy::cssSelector('div:nth-child(7) > span'))
                ->click();
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success!');
            $browser->pause(500);
            $browser->assertValue('input[name="name"]', 'Test_Page');
            $browser->assertValue('input[name="file"]', 'test_page');
            $browser->assertSeeIn('textarea[name="content"]', 'Test en Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->assertChecked('#base > div:nth-child(5) > input');
            $browser->assertChecked('#base > div:nth-child(6) > input');
            $browser->click('#additional-fields-tab');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('#additional-fields > p > a'))
                ->click();
            $browser->pause(1000);
            $browser->assertSee('Add additional field');
            $browser->whenAvailable('.modal', function ($modal) use ($browser, $additional) {
                $modal->assertSee('Add additional field');
//                $browser->driver->findElement(WebDriverBy::cssSelector('#add-field > div > div > form > div.modal-body > div.checkbox > span'))
//                    ->click();                                                                                // todo после фикса дописать тест на вкл/выкл активации при создании (#641)
                $browser->type('div.modal-body > div > input[name="name"]', 'Test name');
                $browser->pause(200);
                $browser->type('div.modal-body > div > input[name="key"]', 'Test key');
                $browser->pause(200);
                $browser->select('select[name="page_additional_field_type_id"]',  $additional->id);
                $browser->pause(200);
                $browser->type('input[name="default"]', 'New value')
                    ->click('form > div.modal-footer > button.btn.btn-info');
            });
            $browser->pause(1000);
            $browser->assertSee('Success');
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success!');
            $browser->pause(200);
            $browser->click('#additional-fields-tab');
            $browser->pause(200);
            $browser->assertSeeIn('#additional-fields > table > tbody > tr > td:nth-child(1)', 'Test name');
            $browser->assertSeeIn('#additional-fields > table > tbody > tr > td:nth-child(2)', 'file');
            $browser->assertChecked('tbody > tr > td:nth-child(4) > div > input');
            $add = PageAdditionalField::where([
                ['name', 'Test name'],
                ['key', 'Test key'],
                ['default','New value'],
                ['active', '1'],
                ['page_additional_field_type_id', $additional->id]
            ])->exists();
            $this->assertTrue($add);
            $browser->pause(500);
        });
    }

    public function testPageTemplateEdit()
    {

        $additional2 = PageAdditionalFieldType::where('type', 'textarea')->first();
        $additional3 = PageAdditionalFieldType::where('type', 'text')->first();

        $this->browse(function (Browser $browser) use ($additional2,  $additional3) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(4) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(2)');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "Test_Page").closest(\'tr\').children[3].querySelectorAll(\'a\')[1].click()');
            $browser->pause(1000);
            $browser->type('input[name="name"]', 'New Test Page');
            $browser->type('input[name="file"]', 'new_test_page');
            $browser->clear('textarea[name="content"]');
            $browser->type('textarea[name="content"]', 'Lorem ipsum dolor sit amet, Римский император Константин I Великий, 北京位於華北平原的西北边缘');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div:nth-child(5) > span'))
                ->click();
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div:nth-child(6) > span'))
                ->click();
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success!');
            $browser->pause(500);
            $browser->assertValue('input[name="name"]', 'New Test Page');
            $browser->assertValue('input[name="file"]', 'new_test_page');
            $browser->assertSeeIn('textarea[name="content"]', 'Lorem ipsum dolor sit amet, Римский император Константин I Великий, 北京位於華北平原的西北边缘');
            $browser->assertNotChecked('#base > div:nth-child(5) > input');
            $browser->assertNotChecked('#base > div:nth-child(6) > input');
            $browser->click('#additional-fields-tab');
            $browser->pause(500);
            $browser->click('#additional-fields > table > tbody > tr > td:nth-child(4) > div > span');  // выкл.активность
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->click('#additional-fields-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('#additional-fields > p > a'))
                ->click();
            $browser->pause(200);
            $browser->whenAvailable('.modal', function ($modal) use ($browser, $additional2) {
                $modal->assertSee('Add additional field');
                    $browser->driver->findElement(WebDriverBy::cssSelector('#add-field > div > div > form > div.modal-body > div.checkbox > span'))
                    ->click();                                                                                // todo после фикса дописать тест на вкл/выкл активации при создании (#641)
                $browser->type('div.modal-body > div > input[name="name"]', 'Another name');
                $browser->pause(200);
                $browser->type('div.modal-body > div > input[name="key"]', 'Another key');
                $browser->pause(200);
                $browser->select('select[name="page_additional_field_type_id"]',  $additional2->id);
                $browser->pause(200);
                $browser->type('input[name="default"]', 'Another value')
                    ->pause(500)
                    ->press('form > div.modal-footer > button.btn.btn-info');
            });
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->click('#additional-fields-tab');
            $browser->pause(200);
//            $browser->assertNotChecked('tbody > tr:nth-child(2) > td:nth-child(4) > div > input');
//            $browser->assertSeeIn('#additional-fields > table > tbody > tr:nth-child(2) > td:nth-child(1)', 'Another name');   // todo перепесать после фикса с порядком сохранения
//            $browser->assertSeeIn('#additional-fields > table > tbody > tr:nth-child(2) > td:nth-child(2)', 'textarea');
//            $browser->assertSeeIn('#additional-fields > table > tbody > tr:nth-child(2) > td:nth-child(3) > textarea', 'Another value');
            $add2 = PageAdditionalField::where([
                ['name', 'Another name'],
                ['key', 'Another key'],
                ['default','Another value'],
                ['active', '1'],
                ['page_additional_field_type_id', $additional2->id]
            ])->exists();
            $this->assertTrue($add2);
//            $browser->assertChecked('tbody > tr:nth-child(2) > td:nth-child(4) > div > input');  // todo раскомментить после фикса с порядком сохранения
            $browser->driver->findElement(WebDriverBy::cssSelector('#additional-fields > p > a'))
                ->click();
            $browser->pause(200);
            $browser->whenAvailable('.modal', function ($modal) use ($browser, $additional3) {
                $modal->assertSee('Add additional field')
                    ->driver->findElement(WebDriverBy::cssSelector('#add-field > div > div > form > div.modal-body > div.checkbox > span'))
                    ->click();
                $browser->type('div.modal-body > div > input[name="name"]', 'Text name');
                $browser->pause(200);
                $browser->type('div.modal-body > div > input[name="key"]', 'Text key');
                $browser->pause(200);
                $browser->select('select[name="page_additional_field_type_id"]',  $additional3->id);
                $browser->pause(200);
                $browser->type('input[name="default"]', 'Text value')
                    ->click('form > div.modal-footer > button.btn.btn-info');
            });
            $browser->pause(500);
            $browser->click('#additional-fields-tab');
            $browser->pause(200);
//            $browser->assertSeeIn('#additional-fields > table > tbody > tr:nth-child(3) > td:nth-child(1)', 'Text name');  // todo перепесать после фикса с порядком сохранения
//            $browser->assertSeeIn('#additional-fields > table > tbody > tr:nth-child(3) > td:nth-child(2)', 'text');
//            $browser->assertValue('#additional-fields > table > tbody > tr:nth-child(3) > td:nth-child(3) > input', 'Text value');
//            $browser->assertChecked('tbody > tr:nth-child(3) > td:nth-child(4) > div > input');
            $add3 = PageAdditionalField::where([
                ['name', 'Text name'],
                ['key', 'Text key'],
                ['default','Text value'],
                ['active', '1'],
                ['page_additional_field_type_id', $additional3->id]
            ])->exists();
            $this->assertTrue($add3);
            $browser->click('#base-tab');
            $browser->pause(500);
            $browser->scrollTo('.btn.btn-info.text-uppercase.pull-right');
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(2000);
            $browser->assertSee('Success!');
        });
    }

    public function testPageTemplateDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(4) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(2)');
            $browser->pause(1500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "New Test Page").closest(\'tr\').children[3].querySelectorAll(\'a\')[1].click()');
            $browser->pause(1000);
            $browser->click('#additional-fields-tab');
            $browser->pause(200);
            $browser->assertPresent('tbody > tr:nth-child(3) > td:nth-child(5) > a');
            $browser->click('tbody > tr:nth-child(3) > td:nth-child(5) > a');
            $browser->pause(1000);
            $browser->acceptDialog();
            $browser->pause(500);
            $browser->click('#additional-fields-tab');
            $browser->pause(200);
            $browser->assertMissing('tbody > tr:nth-child(3) > td:nth-child(5) > a');
            $browser->pause(200);
            $browser->assertPresent('tbody > tr:nth-child(2) > td:nth-child(5) > a');
            $browser->click('tbody > tr:nth-child(2) > td:nth-child(5) > a');
            $browser->pause(500);
            $browser->acceptDialog();
            $browser->pause(500);
            $browser->click('#additional-fields-tab');
            $browser->pause(200);
            $browser->assertMissing('tbody > tr:nth-child(2) > td:nth-child(5) > a');
            $browser->pause(200);
            $browser->assertPresent('tbody > tr:nth-child(1) > td:nth-child(5) > a');
            $browser->click('tbody > tr:nth-child(1) > td:nth-child(5) > a');
            $browser->pause(500);
            $browser->acceptDialog();
            $browser->pause(500);
            $browser->click('#additional-fields-tab');
            $browser->pause(200);
            $browser->assertMissing('tbody > tr:nth-child(1) > td:nth-child(5) > a');
            $browser->clickLink('Templates');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "New Test Page").closest(\'tr\').children[3].querySelectorAll(\'a\')[0].click()');
            $browser->pause(500);
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->driver->findElement(WebDriverBy::cssSelector('#confirmBtnYes'))
                    ->click();
            });
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "New Test Page").closest(\'tr\').children[3].querySelectorAll(\'a\')[1].click()');
            $browser->pause(200);
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->driver->findElement(WebDriverBy::cssSelector('#confirmBtnYes'))
                    ->click();
            });
//            PageTemplate::where('name', 'New Test Page')->forceDelete();
        });
    }

}

