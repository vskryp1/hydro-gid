<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\Menu\MenuItem;
use App\Models\Page\Page;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MenuTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testMenuCreate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(500);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(4) > a');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(4)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(1000);
            $browser->type('input[name="alias"]', 'unique-alias');
            $browser->select('select[name="type"]', '1');
            $browser->select('select[name="page_id"]', 'No parent page');
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(200);
            $browser->assertSee('Success');
            $browser->pause(500);
            // новый пункт меню
            $browser->click('#menu_items-tab');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(500);
            $browser->type('input[name="position"]', '1');
            $browser->select('#menuType', '1');  //  -------------------------  выбираем тип "ссылка"
            $browser->pause(200);
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'имя ссылки');
            $browser->type('input[name="ru[properties]"]', 'атрибуты ссылки');
            $browser->type('input[name="ru[link]"]', 'ссылка.com');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'name link');
            $browser->type('input[name="en[properties]"]', 'attribute link');
            $browser->type('input[name="en[link]"]', 'link.com');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->click('#base-tab');
            $browser->pause(500);
            $browser->assertValue('input[name="alias"]', 'unique-alias');
            $browser->assertSelected('select[name="type"]', '1');
            $browser->assertPresent('select[name="page_id"] > option[selected="selected"]');
            $browser->click('#menu_items-tab');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "name link").closest(\'tr\').children[5].querySelectorAll(\'a\')[0].click()');
            $browser->pause(1000);
            $browser->assertValue('input[name="position"]', '1');
            $browser->assertSelected('#menuType', '1');
            $browser->pause(200);
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[name]"]', 'имя ссылки');
            $browser->assertValue('input[name="ru[properties]"]', 'атрибуты ссылки');
            $browser->assertValue('input[name="ru[link]"]', 'ссылка.com');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'name link');
            $browser->assertValue('input[name="en[properties]"]', 'attribute link');
            $browser->assertValue('input[name="en[link]"]', 'link.com');
            $browser->click(' a.btn.btn-dark.text-uppercase.pull-right');
            $browser->pause(500);
            $browser->waitForText('Want to go back?');
            $browser->press('Yes');
            $browser->pause(1000);
            // новый пункт меню
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(500);
            $browser->type('input[name="position"]', '2');
            $browser->select('#menuType', '2');  //  -------------------------  выбираем тип страница"
            $browser->click('span > span.selection > span');
            $browser->pause(200);
            $browser->type('span.select2-search.select2-search--dropdown > input', 'Hair cosmetics');
            $browser->pause(1000);
            $browser->keys('span.select2-search.select2-search--dropdown > input', ['{ENTER}']);
            $browser->pause(200);
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'имя страницы');
            $browser->type('input[name="ru[properties]"]', 'атрибуты страницы');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'name page');
            $browser->type('input[name="en[properties]"]', 'attribute page');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "name page").closest(\'tr\').children[5].querySelectorAll(\'a\')[0].click()');
            $browser->pause(1000);
            $browser->assertValue('input[name="position"]', '2');
            $browser->assertSelected('#menuType', '2');
            $browser->assertPresent('#select2-modelResults-container[title="Hair cosmetics"]');
            $browser->pause(200);
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[name]"]', 'имя страницы');
            $browser->assertValue('input[name="ru[properties]"]', 'атрибуты страницы');

            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'name page');
            $browser->assertValue('input[name="en[properties]"]', 'attribute page');
            $browser->click(' a.btn.btn-dark.text-uppercase.pull-right');
            $browser->pause(500);
            $browser->waitForText('Want to go back?');
            $browser->press('Yes');
            $browser->pause(1000);
            // новый пункт меню
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(500);
            $browser->type('input[name="position"]', '3');
            $browser->select('#menuType', '3');  //  -------------------------  выбираем тип страница с дочерним ресурсом"
            $browser->click('span > span.selection > span');
            $browser->pause(200);
            $browser->type('span.select2-search.select2-search--dropdown > input', 'Face essences');
            $browser->pause(1000);
            $browser->keys('span.select2-search.select2-search--dropdown > input', ['{ENTER}']);
            $browser->select('select[name="menu_item_id"]', MenuItem::whereTranslation('name', 'name page')->first()->id);
            $browser->pause(200);
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'имя страницы с дочерним ресурсом');
            $browser->type('input[name="ru[properties]"]', 'атрибуты страницы с дочерним ресурсом');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'name page with childs resources');
            $browser->type('input[name="en[properties]"]', 'attribute page with childs resources');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "name page with childs resources").closest(\'tr\').children[5].querySelectorAll(\'a\')[0].click()');
            $browser->pause(1000);
            $browser->assertValue('input[name="position"]', '3');
            $browser->assertSelected('#menuType', '3');
            $browser->assertPresent('#select2-modelResults-container[title="Face essences"]');
//            $browser->assertSelected('select[name="menu_item_id"]', MenuItem::whereTranslation('name', 'name page')->first()->id);  // todo  раскомментить после фикса (#642)
            $browser->pause(200);
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[name]"]', 'имя страницы с дочерним ресурсом');
            $browser->assertValue('input[name="ru[properties]"]', 'атрибуты страницы с дочерним ресурсом');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'name page with childs resources');
            $browser->assertValue('input[name="en[properties]"]', 'attribute page with childs resources');
            $browser->click(' a.btn.btn-dark.text-uppercase.pull-right');
            $browser->pause(500);
            $browser->waitForText('Want to go back?');
            $browser->press('Yes');
            $browser->pause(1000);
            // новый пункт меню
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(500);
            $browser->type('input[name="position"]', '4');
            $browser->select('#menuType', '4');  //  -------------------------  выбираем тип продукт
            $browser->click('span > span.selection > span');
            $browser->pause(500);
            $browser->type('span.select2-search.select2-search--dropdown > input', 'Тестовый товар 1');
            $browser->pause(1000);
            $browser->keys('span.select2-search.select2-search--dropdown > input', ['{ENTER}']);
            $browser->select('select[name="menu_item_id"]', MenuItem::whereTranslation('name', 'name link')->first()->id);
            $browser->pause(200);
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'имя продукта');
            $browser->type('input[name="ru[properties]"]', 'атрибуты продукта');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'name product');
            $browser->type('input[name="en[properties]"]', 'attribute product');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "name product").closest(\'tr\').children[5].querySelectorAll(\'a\')[0].click()');
            $browser->pause(1000);
            $browser->assertValue('input[name="position"]', '4');
            $browser->assertSelected('#menuType', '4');
            $browser->assertPresent('#select2-modelResults-container[title="Тестовый товар 1"]');
//            $browser->assertSelected('select[name="menu_item_id"]', MenuItem::whereTranslation('name', 'name page')->first()->id);  // todo  раскомментить после фикса (#642)
            $browser->pause(200);
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[name]"]', 'имя продукта');
            $browser->assertValue('input[name="ru[properties]"]', 'атрибуты продукта');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'name product');
            $browser->assertValue('input[name="en[properties]"]', 'attribute product');
            $browser->click(' a.btn.btn-dark.text-uppercase.pull-right');
            $browser->pause(500);
            $browser->waitForText('Want to go back?');
            $browser->press('Yes');
            $browser->pause(1000);
        });
    }

    public function testMenuEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(500);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(4) > a');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(4)');
            $browser->pause(200);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "unique-alias").closest(\'tr\').children[3].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->type('input[name="alias"]', 'unique-alias2');
            $browser->select('select[name="type"]', '2');
            $browser->select('select[name="page_id"]', Page::whereTranslation('name', 'Makeup')->first()->id);
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-info.text-uppercase.pull-right'))
                ->click();
            $browser->pause(200);
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->assertValue('input[name="alias"]', 'unique-alias2');
            $browser->assertSelected('select[name="type"]', '2');
            $browser->assertSelected('select[name="page_id"]', Page::whereTranslation('name', 'Makeup')->first()->id);
            $browser->click('#menu_items-tab');
            $browser->pause(500);
            // редактирование пункта меню тип "ссылка"
            $browser->click('#menu_items-tab');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "name link").closest(\'tr\').children[5].querySelectorAll(\'a\')[0].click()');
//            $browser->pause(1000);
            $browser->type('input[name="position"]', '11');
            $browser->pause(200);
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'имя ссылки2');
            $browser->type('input[name="ru[properties]"]', 'атрибуты ссылки2');
            $browser->type('input[name="ru[link]"]', 'ссылка2.com');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'name link2');
            $browser->type('input[name="en[properties]"]', 'attribute link2');
            $browser->type('input[name="en[link]"]', 'link2.com');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->click('#base-tab');
            $browser->pause(500);

            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "name link2").closest(\'tr\').children[5].querySelectorAll(\'a\')[0].click()');
            $browser->pause(1000);
            $browser->assertValue('input[name="position"]', '11');
            $browser->pause(200);
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[name]"]', 'имя ссылки2');
            $browser->assertValue('input[name="ru[properties]"]', 'атрибуты ссылки2');
            $browser->assertValue('input[name="ru[link]"]', 'ссылка2.com');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'name link2');
            $browser->assertValue('input[name="en[properties]"]', 'attribute link2');
            $browser->assertValue('input[name="en[link]"]', 'link2.com');
            $browser->click(' a.btn.btn-dark.text-uppercase.pull-right');
            $browser->pause(500);
            $browser->waitForText('Want to go back?');
            $browser->press('Yes');
            $browser->pause(1000);
            // редактирование пункта меню c типа "Страница" на "Страница с дочерним ресурсом"
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "name page").closest(\'tr\').children[5].querySelectorAll(\'a\')[0].click()');
            $browser->pause(1000);
            $browser->type('input[name="position"]', '21');
            $browser->select('#menuType', '3');  //  -------------------------  выбираем тип "страница с дочерним ресурсом""
            $browser->click('span > span.selection > span');
            $browser->pause(200);
            $browser->type('span.select2-search.select2-search--dropdown > input', 'Body care');
            $browser->pause(1000);
            $browser->keys('span.select2-search.select2-search--dropdown > input', ['{ENTER}']);
            $browser->pause(200);
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'имя страницы2');
            $browser->type('input[name="ru[properties]"]', 'атрибуты страницы2');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'name page2');
            $browser->type('input[name="en[properties]"]', 'attribute page2');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "name page2").closest(\'tr\').children[5].querySelectorAll(\'a\')[0].click()');
            $browser->pause(1000);
            $browser->assertValue('input[name="position"]', '21');
            $browser->assertSelected('#menuType', '3');
            $browser->assertPresent('#select2-modelResults-container[title="Body care"]');
            $browser->pause(200);
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[name]"]', 'имя страницы2');
            $browser->assertValue('input[name="ru[properties]"]', 'атрибуты страницы2');

            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'name page2');
            $browser->assertValue('input[name="en[properties]"]', 'attribute page2');
            $browser->click(' a.btn.btn-dark.text-uppercase.pull-right');
            $browser->pause(500);
            $browser->waitForText('Want to go back?');
            $browser->press('Yes');
            $browser->pause(1000);
            // редактирование пункта меню c типа "Страница с дочерним ресурсом" на "Страница"
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "name page with childs resources").closest(\'tr\').children[5].querySelectorAll(\'a\')[0].click()');
            $browser->pause(1000);
            $browser->type('input[name="position"]', '31');
            $browser->select('#menuType', '2');  //  -------------------------  выбираем тип страница
            $browser->click('span > span.selection > span');
            $browser->pause(200);
            $browser->type('span.select2-search.select2-search--dropdown > input', 'Catalog');
            $browser->pause(1000);
            $browser->keys('span.select2-search.select2-search--dropdown > input', ['{ENTER}']);
            $browser->pause(200);
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'имя страницы с не дочерним ресурсом');
            $browser->type('input[name="ru[properties]"]', 'атрибуты страницы с не дочерним ресурсом');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'name page with not childs resources');
            $browser->type('input[name="en[properties]"]', 'attribute page with not childs resources');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "name page with not childs resources").closest(\'tr\').children[5].querySelectorAll(\'a\')[0].click()');
            $browser->pause(1000);
            $browser->assertValue('input[name="position"]', '31');
            $browser->assertSelected('#menuType', '2');
            $browser->assertPresent('#select2-modelResults-container[title="Catalog"]');
            $browser->pause(200);
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[name]"]', 'имя страницы с не дочерним ресурсом');
            $browser->assertValue('input[name="ru[properties]"]', 'атрибуты страницы с не дочерним ресурсом');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'name page with not childs resources');
            $browser->assertValue('input[name="en[properties]"]', 'attribute page with not childs resources');
            $browser->click(' a.btn.btn-dark.text-uppercase.pull-right');
            $browser->pause(500);
            $browser->waitForText('Want to go back?');
            $browser->press('Yes');
            $browser->pause(1000);
            // редактирование пункта меню тип "продукт"
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "name product").closest(\'tr\').children[5].querySelectorAll(\'a\')[0].click()');
            $browser->pause(1000);
            $browser->type('input[name="position"]', '41');
            $browser->click('span > span.selection > span');
            $browser->pause(500);
            $browser->type('span.select2-search.select2-search--dropdown > input', 'Тестовый товар 2');
            $browser->pause(1000);
            $browser->keys('span.select2-search.select2-search--dropdown > input', ['{ENTER}']);
            $browser->pause(200);
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->type('input[name="ru[name]"]', 'имя продукта2');
            $browser->type('input[name="ru[properties]"]', 'атрибуты продукта2');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->type('input[name="en[name]"]', 'name product2');
            $browser->type('input[name="en[properties]"]', 'attribute product2');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "name product2").closest(\'tr\').children[5].querySelectorAll(\'a\')[0].click()');
            $browser->pause(1000);
            $browser->assertValue('input[name="position"]', '41');
            $browser->assertSelected('#menuType', '4');
            $browser->assertPresent('#select2-modelResults-container[title="Тестовый товар 2"]');
            $browser->click('#locale-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="ru[name]"]', 'имя продукта2');
            $browser->assertValue('input[name="ru[properties]"]', 'атрибуты продукта2');
            $browser->click('#v-pills-en-tab');
            $browser->pause(200);
            $browser->assertValue('input[name="en[name]"]', 'name product2');
            $browser->assertValue('input[name="en[properties]"]', 'attribute product2');
            $browser->click(' a.btn.btn-dark.text-uppercase.pull-right');
            $browser->pause(500);
            $browser->waitForText('Want to go back?');
            $browser->press('Yes');
            $browser->pause(1000);
        });
    }

    public function testMenuDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(500);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(4) > a');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(4)');
            $browser->pause(1500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "unique-alias2").closest(\'tr\').children[3].querySelectorAll(\'a\')[1].click()');
            $browser->pause(500);
            $browser->click('#menu_items-tab');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "name link2").closest(\'tr\').children[5].querySelectorAll(\'a\')[1].click()');
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->press('#confirmBtnYes');
            });
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "name page2").closest(\'tr\').children[5].querySelectorAll(\'a\')[1].click()');
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->press('#confirmBtnYes');
            });
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "name page with not childs resources").closest(\'tr\').children[5].querySelectorAll(\'a\')[1].click()');
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->press('#confirmBtnYes');
            });
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "name product2").closest(\'tr\').children[5].querySelectorAll(\'a\')[1].click()');
            $browser->whenAvailable('.modal', function ($modal) {
                $modal->assertSee('Are you sure you want delete this?')
                    ->press('#confirmBtnYes');
            });
            $browser->assertSee('Success');
            $browser->pause(500);
            $browser->click(' a.btn.btn-dark.text-uppercase.pull-right');
            $browser->pause(500);
            $browser->waitForText('Want to go back?');
            $browser->press('Yes');
            $browser->pause(1000);
            $browser->driver->executeScript('Array.from(document.querySelector(\'table\').rows).map(row => row.children[0]).find(cell => cell.innerText === "unique-alias2").closest(\'tr\').children[3].querySelectorAll(\'a\')[0].click()');
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

