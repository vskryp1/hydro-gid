<?php

    use Illuminate\Database\Seeder;

    class SettingsSeeder extends Seeder
    {
        public function run(): void
        {
            Setting::set('no_avatar', 'assets/frontend/images/no_avatar.png');
            Setting::set('no_image', 'no_image_2.png');
            Setting::set('backend_paginate_limit', 20);
            Setting::set('image_mimes', 'jpeg,jpg,png');
            Setting::set('file_mimes', 'jpeg,jpg,png,pdf,doc,docx');
            Setting::set('image_size', 1000);
            Setting::set('file_size', 1000);
            Setting::lang('ru')->set('site_name', 'ООО “Гидро - Гид”');
            Setting::lang('uk')->set('site_name', 'ООО “Гідро - Гід”');
            Setting::set('site_email', 'website@example.org');
            Setting::lang('ru')->set('site_address', 'г. Харьков, ул. Шевченко, 15');
            Setting::lang('uk')->set('site_address', 'м. Харків, вул. Шевченко, 15');
            Setting::set('site_geo', json_encode(['lat' => 49.9834118, 'lng' => 36.2695878]));
            Setting::lang('ru')->set('pickup_address', 'Ул. Тарасовская, 21 Б”');
            Setting::lang('uk')->set('pickup_address', 'Вул. Тарасовская, 21 Б');
            Setting::set('client_discount', json_encode(['discount' => 0, 'is_percentage' => false]));
            Setting::lang('ru')->set('schedule', json_encode([
                [
                    'day'      => 'Пн - Пт',
                    'full_day' => 'Пн - Пт',
                    'time'     => '09.00 - 19.00',
                ],
                [
                    'day'      => 'Сб',
                    'full_day' => 'Cуббота',
                    'time'     => '09.00 - 15.00',
                ],
                [
                    'day'      => 'Вс',
                    'full_day' => 'Воскресенье',
                    'time'     => 'Выходной',
                ],
            ]));
            Setting::lang('uk')->set('schedule', json_encode([
                [
                    'day'      => 'Пн - Пт',
                    'full_day' => 'Пн - Пт',
                    'time'     => '09.00 - 19.00',
                ],
                [
                    'day'      => 'Сб',
                    'full_day' => 'Cуббота',
                    'time'     => '09.00 - 15.00',
                ],
                [
                    'day'      => 'Нд',
                    'full_day' => 'Неділя',
                    'time'     => 'Вихідний',
                ],
            ]));
            Setting::set('phone_number_first', '(067) 633 23 53');
            Setting::set('phone_number_second', '(050) 702 33 12');
            Setting::set('phone_number_third', '(050) 702 33 12');
            Setting::set('facebook_link', 'https://www.facebook.com/');
            Setting::set('instagram_link', 'https://www.instagram.com/');
            Setting::set('linkedin_link', 'https://www.linkedin.com/');
            Setting::set('telegram_link', 'https://www.telegram.com/');
            Setting::set('skype_link', 'https://www.skype.com/');
            Setting::set('viber_link', 'https://www.viber.com/');
            Setting::set('refund_1', 'Пункт 1');
            Setting::set('refund_2', 'Пункт 2');
        }
    }
