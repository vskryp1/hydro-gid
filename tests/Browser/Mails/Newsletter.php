<?php

namespace Tests\Browser;

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
//    public function testNewsletter()
//    {
//        $this->browse(function (Browser $browser) {
//            $browser->loginAs(User::role(UserType::ROLE_SUPER_ADMIN)->first(), 'admin');
//            $browser->maximize();
//            $browser->visit('/back');
//            $browser->click('.language-switcher');
//            $browser->clickLink('English');
//            $browser->pause(200);
//            $browser->clickLink('Mails');
//            $browser->pause(500);
//            $browser->click('li.active > ul > li:nth-child(5)');
//            $browser->pause(200);
//            $browser->driver->findElement(WebDriverBy::cssSelector('.col-lg-2 > p > a'))
//                ->click();
//            $browser->pause(500);
//            $browser->type('#template-name', 'template_test');
//            $browser->pause(300);
//            $browser->click('#template-body');
//            $browser->select('#template-body');
//            $browser->driver->findElement(WebDriverBy::cssSelector('.btn-info.text-uppercase.pull-right'))
//                ->click();
//            $browser->pause(300);
//            $browser->assertSee('Success');
//            $browser->pause(300);
//            $browser->driver->findElement(WebDriverBy::cssSelector('#base > form > div:nth-child(6) > a'))
//                ->click();
//            $browser->pause(300);
//            $browser->assertSee('Success');
//
//        });
//    }

    /**
     *
     */
    public function testOrderShipping()
    {
        Mail::fake();
//        Mail::assertNothingSent();
//$mail = new TemplateEmail(MailHelper::replaceParams(Template::first(), []));
//dd($mail);
//        Mail::to('bodeek3@yopmail.com', new TemplateEmail(MailHelper::replaceParams(Template::first(), [])));
        Mail::assertSent(Mail::to('bodeek3@yopmail.com')->send(new CallbackMail(['name'=>'','phone'=>''])), function ($mail) {
            dd($mail);
        });


    }

}

