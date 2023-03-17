<?php

namespace Tests\Browser;

use App\Enums\UserType;
use App\Models\Client\Client;
use App\Models\User;
use Carbon\Carbon;
use Facebook\WebDriver\WebDriverBy;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ClientNegativeTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testClientNegativeCreate()
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
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(2)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(200);

//создание клиента

            $browser->type('input[name="name"]', 'Tester');
            $browser->pause(200);
            $browser->type('input[name="email"]', 'sheridan15@example.com');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '16968767831');
            $browser->pause(200);
            $browser->type('input[name="password"]', '123456');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Medhurstmouth');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '2847 Quincy CliffsLelaborough, KS 26431');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(1000);

//1. empty fields

            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
                ->click();
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(1000);
            $browser->assertSee('The Name field is required', 'The E-Mail field is required');
            $browser->pause(200);

            //2. spaces in fields
            $browser->type('input[name="name"]', '                              ');
            $browser->pause(200);
            $browser->type('input[name="email"]', '                              ');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '                              ');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', '                              ');
            $browser->pause(200);
            $browser->type('input[name="password"]', '                              ');
            $browser->pause(200);
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[@class=\'switchery switchery-default\']'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', '               ');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', '               ');
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '               ');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail field is required');
            $browser->pause(1000);

            //3. special symbols
            $browser->type('input[name="name"]', '!@#$%^&*(){}');
            $browser->pause(200);
            $browser->type('input[name="email"]', '!@#$%^&*(){}');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '!@#$%^&*(){}');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', '!@#$%^&*(){}');
            $browser->pause(200);
            $browser->type('input[name="password"]', '!@#$%^&*(){}');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', '!@#$%^&*(){}');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', '!@#$%^&*(){}');
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '!@#$%^&*(){}');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(1000);

            //4. null
            $browser->type('input[name="name"]', 'null');
            $browser->pause(200);
            $browser->type('input[name="email"]', 'null');
            $browser->pause(200);
            $browser->type('input[name="phone"]', 'null');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', 'null');
            $browser->pause(200);
            $browser->type('input[name="password"]', 'null');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'null');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', 'null');
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', 'null');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address', 'The Password must be at least 6 characters');
            $browser->pause(1000);

            //5. zero
            $browser->type('input[name="name"]', '0');
            $browser->pause(200);
            $browser->type('input[name="email"]', '0');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '0');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', '0');
            $browser->pause(200);
            $browser->type('input[name="password"]', '0');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', '0');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', '0');
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '0');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address', 'The Password must be at least 6 characters');
            $browser->pause(1000);

//6. already exist client  // TODO t already exist client data in all fields before run test

            $browser->type('input[name="name"]', 'Travon');
            $browser->pause(200);
            $browser->type('input[name="email"]', 'sheridan15@example.com');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '169687678310780318615193131');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', '0');
            $browser->pause(200);
            $browser->type('input[name="password"]', '0');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Medhurstmouth');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '2847 Quincy CliffsLelaborough, KS 26431');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail has already been taken');
            $browser->pause(1000);

            //7. more than 255 symbols
            $browser->type('input[name="name"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->type('input[name="email"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '3,14159 26535 89793 23846 26433  83279 50288 41971 69399 37510 58209 74944 59230 78164 06286 20899 86280 34825 34211 70679 82148 08651 32823 06647 09384 46095 50582 23172 53594 08128 48111 74502 84102 70193 85211 05559 64462 29489 54930 38196 44288 10975 66593 34461 28475 64823 37867 83165');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->type('input[name="password"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The Name may not be greater than 255 characters', 'The E-Mail must be a valid email address', 'The Phone may not be greater than 30 characters', 'The Password may not be greater than 20 characters');
            $browser->pause(1000);

            //8. more than 255 symbols with valid email
            $browser->type('input[name="name"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->type('input[name="email"]', 'test@example.com');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '3,14159 26535 89793 23846 26433  83279 50288 41971 69399 37510 58209 74944 59230 78164 06286 20899 86280 34825 34211 70679 82148 08651 32823 06647 09384 46095 50582 23172 53594 08128 48111 74502 84102 70193 85211 05559 64462 29489 54930 38196 44288 10975 66593 34461 28475 64823 37867 83165');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->type('input[name="password"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The Name may not be greater than 255 characters', 'The Phone may not be greater than 30 characters', 'The Password may not be greater than 20 characters');
            $browser->pause(1000);

            //9. without a local part email
            $browser->type('input[name="name"]', 'Good Uncle Focus');
            $browser->pause(200);
            $browser->type('input[name="email"]', '@example.com');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '314159');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', Carbon::now()->subDays(rand(100, 1000))->format(config('app.formats.php.date')));
            $browser->pause(200);
            $browser->type('input[name="password"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Medhurstmouth');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '2847 Quincy CliffsLelaborough, KS 26431');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(1000);

            //10. without domain part email
            $browser->type('input[name="name"]', 'Good Uncle Focus');
            $browser->pause(200);
            $browser->type('input[name="email"]', 'test@.com');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '314159');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', Carbon::now()->subDays(rand(100, 1000))->format(config('app.formats.php.date')));
            $browser->pause(200);
            $browser->type('input[name="password"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Medhurstmouth');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '2847 Quincy CliffsLelaborough, KS 26431');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(1000);

            //11. with dot after extensions in email
            $browser->type('input[name="name"]', 'Good Uncle Focus');
            $browser->pause(200);
            $browser->type('input[name="email"]', 'test@example.com.');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '314159');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', Carbon::now()->subDays(rand(100, 1000))->format(config('app.formats.php.date')));
            $browser->pause(200);
            $browser->type('input[name="password"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Medhurstmouth');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '2847 Quincy CliffsLelaborough, KS 26431');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(1000);

            //12. special symbols in domain part email
            $browser->type('input[name="name"]', 'Good Uncle Focus');
            $browser->pause(200);
            $browser->type('input[name="email"]', 'test@!@#$%^&*(){}.com');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '314159');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', Carbon::now()->subDays(rand(100, 1000))->format(config('app.formats.php.date')));
            $browser->pause(200);
            $browser->type('input[name="password"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Medhurstmouth');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '2847 Quincy CliffsLelaborough, KS 26431');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(1000);

            //13. without user name
            $browser->clear('input[name="name"]');
            $browser->pause(200);
            $browser->type('input[name="email"]', uniqid() . time() . 'test@example.com');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '314159');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', Carbon::now()->subDays(rand(100, 1000))->format(config('app.formats.php.date')));
            $browser->pause(200);
            $browser->type('input[name="password"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Medhurstmouth');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '2847 Quincy CliffsLelaborough, KS 26431');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The Name field is required');
            $browser->pause(1000);

            //14. without email
            $browser->type('input[name="name"]', 'Good Uncle Focus');
            $browser->pause(200);
            $browser->clear('input[name="email"]');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '314159');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', Carbon::now()->subDays(rand(100, 1000))->format(config('app.formats.php.date')));
            $browser->pause(200);
            $browser->type('input[name="password"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Medhurstmouth');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '2847 Quincy CliffsLelaborough, KS 26431');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail field is required');
            $browser->pause(1000);

            //16. without phone
            $browser->type('input[name="name"]', 'Good Uncle Focus');
            $browser->pause(200);
            $browser->type('input[name="email"]', rand(1, 20) . 'test@example.com');
            $browser->pause(200);
            $browser->clear('input[name="phone"]');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', Carbon::now()->subDays(rand(100, 1000))->format(config('app.formats.php.date')));
            $browser->pause(200);
            $browser->type('input[name="password"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Medhurstmouth');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '2847 Quincy CliffsLelaborough, KS 26431');
            $browser->click('#base-tab');
            $browser->pause(200);
            $browser->scrollTo(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(3) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(1000);
            $browser->assertSee('Success');
            $browser->pause(1000);
        });
    }


    public function testClientNegativeEdit()
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
            $browser->pause(200);
            $browser->click('li.active > ul > li:nth-child(2)');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//tbody//tr[1]//td[5]//div[1]//a[2]'))
                ->click();
            $browser->pause(200);
            $browser->assertSee('Edit client');
            $client_id = Client::latest()->first()->id;
            $url = route('backend.clients.edit', ['id' =>  $client_id]);
            $browser->visit($url);
            $browser->pause(500);

            //1. clear all fields
            $browser->clear('input[name="name"]');
            $browser->pause(200);
            $browser->clear('input[name="email"]');
            $browser->pause(200);
            $browser->clear('input[name="phone"]');
            $browser->pause(200);
            $browser->clear('input[name="birthday"]');
            $browser->pause(200);
            $browser->clear('input[name="password"]');
            $browser->pause(200);
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::cssSelector('#address > div > div > div:nth-child(1) > div > div.x_title > ul > li:nth-child(4) > a'))
                ->click();
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->clear('input[name="address[city][]"]');
            $browser->pause(500);
            $browser->clear('input[name="address[zip][]"]');
            $browser->pause(200);
            $browser->clear('input[name="address[address][]"]');
            $browser->driver->findElement(WebDriverBy::xpath('//a[contains(@class,\'js_remove_field\')]'))
                ->click();
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(4) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The Name field is required', 'The E-Mail field is required');
            $browser->pause(200);

            //2. special symbols
            $browser->type('input[name="name"]', '!@#$%^&*(){}');
            $browser->pause(200);
            $browser->type('input[name="email"]', '!@#$%^&*(){}');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '!@#$%^&*(){}');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', '!@#$%^&*(){}');
            $browser->pause(200);
            $browser->type('input[name="password"]', '!@#$%^&*(){}');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', '!@#$%^&*(){}');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', '!@#$%^&*(){}');
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '!@#$%^&*(){}');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(4) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(1000);

            //3. null
            $browser->type('input[name="name"]', 'null');
            $browser->pause(200);
            $browser->type('input[name="email"]', 'null');
            $browser->pause(200);
            $browser->type('input[name="phone"]', 'null');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', 'null');
            $browser->pause(200);
            $browser->type('input[name="password"]', 'null');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'null');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', 'null');
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', 'null');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(4) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address', 'The Password must be at least 6 characters');
            $browser->pause(1000);

            //4. zero
            $browser->type('input[name="name"]', '0');
            $browser->pause(200);
            $browser->type('input[name="email"]', '0');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '0');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', '0');
            $browser->pause(200);
            $browser->type('input[name="password"]', '0');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', '0');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', '0');
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '0');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(4) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address', 'The Password must be at least 6 characters');
            $browser->pause(1000);

//5. already exist client  // put already exist client data in all fields before run test

            $browser->type('input[name="name"]', 'Travon');
            $browser->pause(200);
            $browser->type('input[name="email"]', 'sheridan15@example.com');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '169687678310780318615193131');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', '0');
            $browser->pause(200);
            $browser->type('input[name="password"]', '0');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Medhurstmouth');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '2847 Quincy CliffsLelaborough, KS 26431');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(4) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(1000);
            $browser->assertSee('The E-Mail has already been taken');
            $browser->pause(1000);

            //6. more than 255 symbols
            $browser->type('input[name="name"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->type('input[name="email"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '3,14159 26535 89793 23846 26433  83279 50288 41971 69399 37510 58209 74944 59230 78164 06286 20899 86280 34825 34211 70679 82148 08651 32823 06647 09384 46095 50582 23172 53594 08128 48111 74502 84102 70193 85211 05559 64462 29489 54930 38196 44288 10975 66593 34461 28475 64823 37867 83165');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->type('input[name="password"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(4) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The Name may not be greater than 255 characters', 'The E-Mail must be a valid email address', 'The Phone may not be greater than 30 characters', 'The Password may not be greater than 20 characters');
            $browser->pause(1000);

            //7. more than 255 symbols with valid email
            $browser->type('input[name="name"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->type('input[name="email"]', 'test@example.com');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '3,14159 26535 89793 23846 26433  83279 50288 41971 69399 37510 58209 74944 59230 78164 06286 20899 86280 34825 34211 70679 82148 08651 32823 06647 09384 46095 50582 23172 53594 08128 48111 74502 84102 70193 85211 05559 64462 29489 54930 38196 44288 10975 66593 34461 28475 64823 37867 83165');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->type('input[name="password"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lobortis dignissim mattis. Integer nibh turpis, tempor varius dolor at, scelerisque vestibulum turpis. In vitae placerat sem. Phasellus bibendum viverra rutrum. Etiam pretium neque a sapien condimentum, non tincidunt ligula mollis. Donec eleifend tortor quam, id tristique diam efficitur laoreet. Phasellus odio metus, iaculis nec scelerisque at, vestibulum eget turpis. Curabitur eget augue eget est pellentesque varius non sed erat. Nunc nec feugiat elit, vulputate facilisis tellus. Vestibulum at accumsan dolor, ac malesuada nibh. Aenean egestas luctus commodo.');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(4) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The Name may not be greater than 255 characters', 'The Phone may not be greater than 30 characters', 'The Password may not be greater than 20 characters');
            $browser->pause(1000);

            //8. without a local part email
            $browser->type('input[name="name"]', 'Good Uncle Focus');
            $browser->pause(200);
            $browser->type('input[name="email"]', '@example.com');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '314159');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', Carbon::now()->subDays(rand(100, 1000))->format(config('app.formats.php.date')));
            $browser->pause(200);
            $browser->type('input[name="password"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Medhurstmouth');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '2847 Quincy CliffsLelaborough, KS 26431');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(4) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(1000);

            //9. without domain part email
            $browser->type('input[name="name"]', 'Good Uncle Focus');
            $browser->pause(200);
            $browser->type('input[name="email"]', 'test@.com');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '314159');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', Carbon::now()->subDays(rand(100, 1000))->format(config('app.formats.php.date')));
            $browser->pause(200);
            $browser->type('input[name="password"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Medhurstmouth');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '2847 Quincy CliffsLelaborough, KS 26431');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(4) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(1000);

            //10. with dot after extensions in email
            $browser->type('input[name="name"]', 'Good Uncle Focus');
            $browser->pause(200);
            $browser->type('input[name="email"]', 'test@example.com.');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '314159');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', Carbon::now()->subDays(rand(100, 1000))->format(config('app.formats.php.date')));
            $browser->pause(200);
            $browser->type('input[name="password"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Medhurstmouth');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '2847 Quincy CliffsLelaborough, KS 26431');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(4) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(1000);

            //11. special symbols in domain part email
            $browser->type('input[name="name"]', 'Good Uncle Focus');
            $browser->pause(200);
            $browser->type('input[name="email"]', 'test@!@#$%^&*(){}.com');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '314159');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', Carbon::now()->subDays(rand(100, 1000))->format(config('app.formats.php.date')));
            $browser->pause(200);
            $browser->type('input[name="password"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Medhurstmouth');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '2847 Quincy CliffsLelaborough, KS 26431');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(4) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail must be a valid email address');
            $browser->pause(1000);

            //12. without user name
            $browser->clear('input[name="name"]');
            $browser->pause(200);
            $browser->type('input[name="email"]', uniqid() . time() . 'test@example.com');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '314159');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', Carbon::now()->subDays(rand(100, 1000))->format(config('app.formats.php.date')));
            $browser->pause(200);
            $browser->type('input[name="password"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Medhurstmouth');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '2847 Quincy CliffsLelaborough, KS 26431');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(4) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The Name field is required');
            $browser->pause(1000);

            //13. without email
            $browser->type('input[name="name"]', 'Good Uncle Focus');
            $browser->pause(200);
            $browser->clear('input[name="email"]');
            $browser->pause(200);
            $browser->type('input[name="phone"]', '314159');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', Carbon::now()->subDays(rand(100, 1000))->format(config('app.formats.php.date')));
            $browser->pause(200);
            $browser->type('input[name="password"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Medhurstmouth');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '2847 Quincy CliffsLelaborough, KS 26431');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(4) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(500);
            $browser->assertSee('The E-Mail field is required');
            $browser->pause(1000);

            //14. without phone
            $browser->type('input[name="name"]', 'Good Uncle Focus');
            $browser->pause(200);
            $browser->type('input[name="email"]', '666test@example.com');
            $browser->pause(200);
            $browser->clear('input[name="phone"]');
            $browser->pause(200);
            $browser->type('input[name="birthday"]', Carbon::now()->subDays(rand(100, 1000))->format(config('app.formats.php.date')));
            $browser->pause(200);
            $browser->type('input[name="password"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->driver->findElement(WebDriverBy::xpath('//span[contains(@class,\'switchery switchery-default\')]'))
                ->click();
            $browser->pause(200);
            $browser->click('#address-tab');
            $browser->pause(500);
            $browser->driver->findElement(WebDriverBy::xpath('//*[@id="address"]/div/div/div/div/div[2]/div[1]/select'))
                ->click();
            $browser->pause(200);
            $browser->select('#address > div > div > div > div > div.x_content > div:nth-child(2) > select');
            $browser->pause(500);
            $browser->type('input[name="address[city][]"]', 'Medhurstmouth');
            $browser->pause(500);
            $browser->type('input[name="address[zip][]"]', rand(111111, 999999));
            $browser->pause(200);
            $browser->type('input[name="address[address][]"]', '2847 Quincy CliffsLelaborough, KS 26431');
            $browser->click('#base-tab');
            $browser->driver->findElement(WebDriverBy::cssSelector(':nth-child(4) > button.btn.btn-primary.text-uppercase.pull-right'))
                ->click();
            $browser->pause(1000);
            $browser->assertSee('Success');
            $browser->pause(1000);
            Client::whereIn('email', ['sheridan15@example.com','666test@example.com'])->forceDelete();

        });
    }
}


