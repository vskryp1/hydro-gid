<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\User;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserNegativeTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testUserNegativeCreate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->assertPathIs('/back');
            $browser->pause(500);
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(2) > a');
            $browser->pause(1000);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The Name field is required', 'The E-Mail field is required', 'The role field is required');
            $browser->pause(200);

            //without role select
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Саша');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'sasha1@artjoker.ua');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '1597635');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '123456');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(800);
            $browser->assertSee('The role field is required');
            $browser->pause(200);

            //spaces in fields
            $browser->type('#userCreateName', '                                 ');
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', '                               ');
            $browser->type('#userCreatePhone', '                              ');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '                                 ');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail field is required');
            $browser->pause(200);

            //more than 255 symbols
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The Name may not be greater than 255 characters', 'The Phone may not be greater than 30 characters', 'The Password may not be greater than 20 characters');
            $browser->pause(200);

            //more than 255 symbols with valid email
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'test@example.com');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The Name may not be greater than 255 characters', 'The Phone may not be greater than 30 characters', 'The Password may not be greater than 20 characters');
            $browser->pause(200);

            //special symbols
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', '!@#$%&^*)({}');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', '!@#$%&^*)({}');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '!@#$%&^*)({}');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(200);

            //null
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'null');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'null');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', 'null');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', 'null');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(200);

            //already exist user
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Саша');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'sasha@artjoker.ua');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '456789');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '123456');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(1000);
            $browser->assertSee('The E-Mail has already been taken.', 'The Phone has already been taken.');
            $browser->pause(200);

            //without  a local part email
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Саша');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', '@artjoker.ua');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '456389');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '123456');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(200);

            //without a domain part email
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Саша');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'sasha@.ua');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '456389');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '123456');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(200);

            //with dot after extensions in email
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Саша');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'sasha@artjoker.ua.');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '456389');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '123456');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(200);

            //special symbols in domain part email
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Саша');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'sasha@!#$%%^&*.ua');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '456389');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '123456');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(200);

            //without user name
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', '');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'sasha1@artjoker.ua');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '456389');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '123456');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The Name field is required.');
            $browser->pause(200);

            //without password
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Саша');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'sasha1@artjoker.ua');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '456389');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The Password field is required');
            $browser->pause(500);

            //without phone
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Саша');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'sasha1@artjoker.ua');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '123456');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The Phone field is required');
            $browser->pause(200);

        });
    }

    public function testUserNegativeEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
            $browser->maximize();
            $browser->visit('/back');
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(200);
            $browser->assertPathIs('/back');
            $browser->pause(500);
            $browser->click('.language-switcher');
            $browser->clickLink('English');
            $browser->pause(500);
            $browser->click('#sidebar-menu > div > ul > li:nth-child(2) > a');
            $browser->pause(500);
            $browser->click('li.active > ul > li:nth-child(1)');
            $browser->pause(500);

            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(200);
            $browser->type('#userCreateName', 'Admin' . uniqid());
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'testadmin@mail.com');
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div:nth-child(3) > span'))
                ->click();
            $browser->type('#userCreatePhone', '(111) 111-1111');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::cssSelector('#base > div > div > div > div:nth-child(6) > span'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', uniqid());
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(1000);
            $browser->assertSee('Success');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(2) > td.text-right > div > a.btn.btn-sm.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(200);
            $browser->assertSee('Edit User');
            $user_id = User::latest()->first()->id;
            $url = route('backend.users.edit', ['id' => $user_id]);
            $browser->visit($url);
            $browser->pause(500);

//without role select

            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Саша');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'sasha1@artjoker.ua');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->click('#userCreateRole');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//option[contains(text(),\'Role\')]'))
                ->click();
            $browser->type('#userCreatePhone', '1597635');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '123456');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(800);
            $browser->assertSee('The role field is required');
            $browser->pause(200);

            //spaces in fields
            $browser->type('#userCreateName', '                        ');
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', '                       ');
            $browser->type('#userCreatePhone', '                       ');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '                    ');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail field is required');
            $browser->pause(200);

            //more than 255 symbols
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The Name may not be greater than 255 characters', 'The Phone may not be greater than 30 characters', 'The Password may not be greater than 20 characters');
            $browser->pause(200);

            //more than 255 symbols with valid email
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'test@example.com');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The Name may not be greater than 255 characters', 'The Phone may not be greater than 30 characters', 'The Password may not be greater than 20 characters');
            $browser->pause(200);

            //special symbols
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', '!@#$%&^*)({}');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', '!@#$%&^*)({}');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '!@#$%&^*)({}');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(200);

            //null
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'null');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'null');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', 'null');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', 'null');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(200);

            //already exist user
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Саша');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'sancho@artjoker.ua');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '456789');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '123456');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail has already been taken.', 'The Phone has already been taken.');
            $browser->pause(200);

            //without  a local part email
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Саша');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', '@artjoker.ua');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '456389');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '123456');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(200);

            //without a domain part email
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Саша');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'sasha@.ua');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '456389');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '123456');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(200);

            //with dot after extensions in email
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Саша');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'sasha@artjoker.ua.');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '456389');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '123456');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(200);

            //special symbols in domain part email
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Саша');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'sasha@!#$%%^&*.ua');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '456389');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '123456');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(200);

            //without user name
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', '');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'sasha1@artjoker.ua');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '456389');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '123456');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The Name field is required.');
            $browser->pause(200);

            //without phone
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Саша');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'sasha1@artjoker.ua');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '123456');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The Phone field is required');
            $browser->pause(200);

            //without password
            $browser->clear('#userCreateName');
            $browser->type('#userCreateName', 'Саша');
            $browser->pause(200);
            $browser->clear('#userCreateEmail');
            $browser->pause(200);
            $browser->type('#userCreateEmail', 'sasha1@artjoker.ua');
            $browser->pause(200);
            $browser->clear('#userCreatePhone');
            $browser->type('#userCreatePhone', '456389');
            $browser->select('#userCreateRole', '2');
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->clear('#userCreatePassword');
            $browser->type('#userCreatePassword', '');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//div[contains(@class,\'col-12 col-sm-12 col-md-12 col-lg-12\')]//button[2]'))
                ->click();
            $browser->pause(1000);
            $browser->assertSee('Success');
            User::where('email', 'sasha1@artjoker.ua')->forceDelete();
            $browser->pause(1000);

        });
    }
}

