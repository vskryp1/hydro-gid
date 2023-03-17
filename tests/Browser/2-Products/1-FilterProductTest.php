<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\Filters\Filter;
use App\Models\Filters\FilterType;
use App\Models\Page\Page;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FilterProductTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testFilterProductCreate()
    {

        $filterType = FilterType::where('name', 'Radiobutton')->first();
        $filterType2 = FilterType::where('name', 'Checkbox')->first();
//        $filterCategory = Page::whereTranslation('name', 'Indelible care')->orWhereTranslation('name', 'Hair cream')->get()->pluck('id');
        $filterCategory = Page::whereTranslation('name', 'Indelible care')->first();
        $filter2Category = Page::whereTranslation('name', 'Hair cream')->first();

        $this->browse(function (Browser $browser) use ($filterType, $filterType2,  $filterCategory, $filter2Category) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(3) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(2)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(200);
            $browser->type('input[name="alias"]', 'testfilter1');
            $browser->pause(200);
            $browser->select('select[name="filter_type_id"]', $filterType->id);
            $browser->select('select[name="categories[]"]', $filterCategory->id);
            $browser->type(' li.select2-search.select2-search--inline > input', 'Face cosmetics');
            $browser->pause(1000);
            $browser->keys(' li.select2-search.select2-search--inline > input', ['{ENTER}']);
//            foreach ($filterCategory as $item) {
//                $browser->select('select[name="categories[]"]', $item);
//            }
            $browser->pause(200);
            $browser->type('input[name="position"]', '222');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[@class=\'switchery switchery-default\']'))
                ->click();
            $browser->click('#base > div > div > div > div:nth-child(6) > span');
            $browser->pause(200);
            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'фильтр товара');
            $browser->type('textarea[name="ru[description]"]', 'описнаие товара');
            $browser->click('#v-pills-en-tab');
            $browser->pause(500);
            $browser->type('input[name="en[name]"]', 'product filter');
            $browser->type('textarea[name="en[description]"]', 'product description');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[@class=\'col-12 col-sm-12 col-md-12 col-lg-12\']//button[1]'))  // Save and continue
            ->click();
            $browser->pause(1000);
            $browser->assertSee('Success');

//  проверка значений при создании

            $browser->pause(500);
            $browser->assertValue('input[name="alias"]', 'testfilter1');
            $browser->assertSeeIn('select[name="filter_type_id"] > option[selected="selected"]', 'Radiobutton');
            $browser->assertPresent('#base > div > div > div > div:nth-child(3) > span > span.selection > span > ul > li[title="Face cosmetics"] + [title="Indelible care"]');
            $browser->assertValue('input[name="position"]', '222');
            $browser->assertChecked('input[name="active"]');
            $browser->assertChecked('input[name="is_option"]');
            $browser->clickLink('Locale');
            $browser->pause(500);
            $browser->assertValue('input[name="ru[name]"]', 'фильтр товара');
            $browser->assertValue('textarea[name="ru[description]"]', 'описнаие товара');
            $browser->click('#v-pills-en-tab');
            $browser->pause(500);
            $browser->assertValue('input[name="en[name]"]', 'product filter');
            $browser->assertValue('textarea[name="en[description]"]', 'product description');
            $browser->pause(500);

//  редактирование фильтра

            $browser->clickLink('Base');
            $browser->pause(500);
            $browser->type('input[name="alias"]', 'testfilter2');
            $browser->pause(200);
            $browser->select('select[name="filter_type_id"]', $filterType2->id);
            $browser->click('span.selection > span > ul > li:nth-child(1) > span');
            $browser->pause(500);
            $browser->select('select[name="categories[]"]', $filter2Category->id);
            $browser->click('li.select2-selection__choice');
            $browser->type('input[name="position"]', '333');
            $browser->pause(500);
            $browser->clickLink('Locale');
            $browser->pause(500);
            $browser->click('#v-pills-ru-tab');
            $browser->pause(500);
            $browser->type('input[name="ru[name]"]', 'фильтр товара!');
            $browser->type('textarea[name="ru[description]"]', 'описнаие товара xxx');
            $browser->click('#v-pills-en-tab');
            $browser->pause(500);
            $browser->type('input[name="en[name]"]', 'product filter!');
            $browser->type('textarea[name="en[description]"]', 'product description xxx');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//div[@class=\'col-12 col-sm-12 col-md-12 col-lg-12\']//button[1]'))  // Save and continue
            ->click();
            $browser->pause(1000);
            $browser->assertSee('Success');

//  проверка значений после редактирования

            $browser->pause(500);
            $browser->assertValue('input[name="alias"]', 'testfilter2');
            $browser->assertSeeIn('select[name="filter_type_id"] > option[selected="selected"]', 'Checkbox');
            $browser->assertPresent('#base > div > div > div > div:nth-child(3) > span > span.selection > span > ul > li[title="Hair cream"] + [title="Indelible care"]');
            $browser->assertValue('input[name="position"]', '333');
            $browser->assertChecked('input[name="active"]');
            $browser->assertChecked('input[name="is_option"]');
            $browser->clickLink('Locale');
            $browser->pause(500);
            $browser->assertValue('input[name="ru[name]"]', 'фильтр товара!');
            $browser->assertValue('textarea[name="ru[description]"]', 'описнаие товара xxx');
            $browser->click('#v-pills-en-tab');
            $browser->pause(500);
            $browser->assertValue('input[name="en[name]"]', 'product filter!');
            $browser->assertValue('textarea[name="en[description]"]', 'product description xxx');
            $browser->pause(500);


//  создание и проверка двух значений фильтра

            $browser->clickLink('Values');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(200);
            $browser->type('input[name="alias"]', 'filtervalue1');
            $browser->type('input[name="position"]', '1');
            $browser->driver->findElement(WebDriverBy::xpath('//span[@class=\'switchery switchery-default\']'))
                ->click();
            $browser->pause(200);
            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'значение фильтра');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'filter value');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(1000);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "filter value").closest(\'tr\').children[4].querySelectorAll(\'a\')[0].click()');
            $browser->pause(500);
            $browser->assertValue('input[name="alias"]', 'filtervalue1');
            $browser->assertValue('input[name="position"]', '1');
            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[name]"]', 'значение фильтра');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'filter value');
            $browser->clickLink(' Back');
            $browser->pause(200);
            $browser->press('button[id="confirmBtnYes"]');
            $browser->pause(1500);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(200);
            $browser->type('input[name="alias"]', 'filtervalue2');
            $browser->type('input[name="position"]', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[@class=\'switchery switchery-default\']'))
                ->click();
            $browser->pause(200);
            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'значение фильтра 2');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'filter value 2');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "filter value 2").closest(\'tr\').children[4].querySelectorAll(\'a\')[0].click()');
            $browser->pause(500);
            $browser->assertValue('input[name="alias"]', 'filtervalue2');
            $browser->assertValue('input[name="position"]', '2');
            $browser->clickLink('Locale');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[name]"]', 'значение фильтра 2');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'filter value 2');
            $browser->clickLink(' Back');
            $browser->pause(200);
            $browser->press('button[id="confirmBtnYes"]');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(200);
        });
    }

    public function testFilterProductDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(3) > a');
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(2)');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "product filter!").closest(\'tr\').children[4].querySelectorAll(\'a\')[1].click()');
            $browser->clickLink('Values');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "filter value").closest(\'tr\').children[4].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->press('button[id="confirmBtnYes"]');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "filter value 2").closest(\'tr\').children[4].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->press('button[id="confirmBtnYes"]');
            $browser->pause(500);
            $browser->clickLink(' Back');
            $browser->pause(500);
            $browser->press('button[id="confirmBtnYes"]');
            $browser->pause(1000);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "product filter!").closest(\'tr\').children[4].querySelectorAll(\'a\')[0].click()');
            $browser->pause(500);
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->driver->findElement(WebDriverBy::cssSelector('#confirmBtnYes'))
                    ->click();
            });
            $browser->pause(200);
            $browser->assertSee('Success');
            $browser->pause(200);
            Filter::where('alias', 'testfilter2')->forceDelete();
        });
    }
}
