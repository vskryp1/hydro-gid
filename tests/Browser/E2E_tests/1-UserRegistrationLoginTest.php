<?php

namespace Tests\Browser;

use App\Models\Client\Client;
use App\Models\Product\Product;
use App\Models\Region\Region;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserRegistrationLoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegistrationLogin()
    {

        $regionSelect = Region::whereTranslation('name', 'Испания')->first();


        $this->browse(function (Browser $browser) use ($regionSelect) {
            $browser->visit('/')
                ->maximize()

//  Регистрация

                ->clickLink('Регистрация')
                ->pause(2000)
                ->type('name', 'Смазоров Роджер Лаврентьевич')
                ->pause(200)
                ->type('phone', '0867774411')
                ->type('div.form-round > div:nth-child(3) > input[name="email"]', 'moeller080@ukr.net')
                ->select('select[name="region_id"]', $regionSelect->id)
                ->type('zip', '61000')
                ->type('city', 'Харьков')
                ->type('address', 'ул. Шевченко 23')
                ->press('Регистрация')
                ->pause(1000)
                ->assertSeeIn('#modalAlert > div > div > div.modal-title.js_title', 'Регистрация успешно завершена.')
                ->click('#modalAlert > div > div > button')
                ->pause(1000);

//  логин ноывым пользователем

            Client::where('email', 'moeller080@ukr.net')->update(['password' => bcrypt(111111)]);
            $browser->clickLink('Вход')
                ->pause(1000)
                ->waitForLink('Забыли пароль?')
                ->type('div.form-round > div:nth-child(1) > input[name="email"]', 'moeller080@ukr.net')
                ->type('div.form-round > div:nth-child(2) > input[name="password"]', '111111')
                ->press('Вход')
                ->pause(1000)

//  редактированипе и смена пароля в л/к

                ->clickLink('Профиль')
                ->assertValue('#profile_firstname', 'Смазоров Роджер Лаврентьевич')
                ->assertValue('#profile_phone', '0867774411')
                ->assertValue('#profile_email', 'moeller080@ukr.net')
                ->assertValue('#profile_zipcode', '61000')
                ->assertValue('#profile_city', 'Харьков')
                ->assertValue('#profile_address', 'ул. Шевченко 23')
                ->assertVisible('span[title=Испания]')
                ->type('#profile_firstname', 'Смазоров Роджер Альфредович')
                ->type('#profile_phone', '0867774000')
                ->type('#profile_zipcode', '61111')
                ->type('#profile_city', 'Харьков city')
                ->type('#profile_address', 'ул. Властилина колец 66')
                ->type('#profile_birthday', '15 октября 1980')
                ->select('region_id', Region::whereTranslation('name', 'Украина')->first()->id)
                ->type('#profile_password', '111111')
                ->type('#profile_newPassword', '123456')
                ->type('#profile_repeatPassword', '123456')
                ->press('Сохранить данные')
                ->pause(500)
                ->assertValue('#profile_firstname', 'Смазоров Роджер Альфредович')
                ->assertValue('#profile_phone', '0867774000')
                ->assertValue('#profile_zipcode', '61111')
                ->assertValue('#profile_city', 'Харьков city')
                ->assertValue('#profile_address', 'ул. Властилина колец 66')
                ->assertValue('#profile_birthday', '15 октября 1980')
                ->assertVisible('span[title=Украина]')
                ->clickLink('Выход')
                ->clickLink('Вход')
                ->pause(2000)
                ->type('div.form-round > div:nth-child(1) > input[name="email"]', 'moeller080@ukr.net')
                ->type('div.form-round > div:nth-child(2) > input[name="password"]', '123456')
                ->press('Вход')
                ->clickLink('Профиль')
                ->assertTitle('Профиль')
                ->clickLink('Выход');
            Client::where('email', 'moeller080@ukr.net')->forceDelete();


        });
    }
}
