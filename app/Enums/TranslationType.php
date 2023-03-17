<?php

namespace App\Enums;

final class TranslationType
{
    const AUTH                 = 'auth';
    const BACKEND              = 'backend';
    const BACKEND_FAQ          = 'backend/faq/index';
    const BACKEND_PRODUCT      = 'backend/product/index';
    const BACKEND_PROFILE      = 'backend/profile/index';
    const BACKEND_REVIEW       = 'backend/review/index';
    const BACKEND_SERVICE      = 'backend/service/index';
    const BACKEND_STOCK        = 'backend/stocks/index';
    const ENUMS                = 'enums';
    const FRONTEND             = 'frontend';
    const FRONTEND_404         = 'frontend/404/index';
    const FRONTEND_ALERTS      = 'frontend/alerts/index';
    const FRONTEND_AUTH        = 'frontend/auth/index';
    const FRONTEND_CHECKOUT    = 'frontend/checkout/index';
    const FRONTEND_COMPARE     = 'frontend/compare/index';
    const FRONTEND_CONTENT     = 'frontend/content/index';
    const FRONTEND_PRODUCT     = 'frontend/product/index';
    const FRONTEND_PROFILE     = 'frontend/profile/index';
    const FRONTEND_REVIEW      = 'frontend/review/index';
    const FRONTEND_SERVICE     = 'frontend/service/index';
    const FRONTEND_STOCK       = 'frontend/stock/index';
    const MAILS                = 'mails';
    const PAGINATION           = 'pagination';
    const PASSWORDS            = 'passwords';
    const VALIDATION           = 'validation';
    const BACKEND_FILE_MANAGER = 'vendor/laravel-filemanager';


    public static function getDescriptions(): array
    {
        return [
            'Caйт'    => [
                TranslationType::FRONTEND          => 'Разное',
                TranslationType::FRONTEND_404      => 'Страница 404',
                TranslationType::FRONTEND_ALERTS   => 'Оповещение на сайте',
                TranslationType::FRONTEND_AUTH     => 'Авторизации',
                TranslationType::FRONTEND_CHECKOUT => 'Оформление заказа',
                TranslationType::FRONTEND_COMPARE  => 'Сравнение',
                TranslationType::FRONTEND_CONTENT  => 'Контетные страницы',
                TranslationType::FRONTEND_PRODUCT  => 'Страница товара',
                TranslationType::FRONTEND_PROFILE  => 'Кабинет пользователя',
                TranslationType::FRONTEND_REVIEW   => 'Отзывы',
                TranslationType::FRONTEND_SERVICE  => 'Сервисы',
                TranslationType::FRONTEND_STOCK    => 'Акции',
            ],
            'Админка' => [
                TranslationType::BACKEND              => 'Разное',
                TranslationType::BACKEND_FAQ          => 'Модуль вопрос ответ',
                TranslationType::BACKEND_PRODUCT      => 'Модуль Товары',
                TranslationType::BACKEND_PROFILE      => 'Профайл пользователя',
                TranslationType::BACKEND_REVIEW       => 'Модуль отзывов',
                TranslationType::BACKEND_SERVICE      => 'Модуль сервисов',
                TranslationType::BACKEND_STOCK        => 'Модуль акции',
                TranslationType::BACKEND_FILE_MANAGER => 'Фаил менеджер',
            ],
            'Общее'   => [
                TranslationType::AUTH       => 'Авторизация',
                TranslationType::MAILS      => 'Письма',
                TranslationType::PASSWORDS  => 'Пароли',
                TranslationType::VALIDATION => 'Сообщения валидации',
                TranslationType::ENUMS      => 'Перечисления',
            ],
        ];
    }

}
