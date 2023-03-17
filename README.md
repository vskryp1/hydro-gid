# Laravel shop template

Laravel 5.7

# Installation
1. Clone this repository `git clone git@git.artjoker.ua:laravel/template-shop.git`
1. Clone this repository `git clone git@git.artjoker.ua:vinz/valerka.git`
2. Use Valerka for install your project.

# Run in Docker ([Valerka](https://git.artjoker.ua/vinz/valerka))

# Deployment

1. Install environments and config deployment by DevOps.  
2. For change any variables in `.env` for dev or prod servers you need ask DevOps or your technical lead.
3. In `config/deploy.php` you can change config for deployment.
4. If you need custom tasks for deployment you can use file `deployer_tasks.php`

[Used package for deployment. More details instructions](https://github.com/lorisleiva/laravel-deployer)


# Translations google spreadsheets

### Google Api

- head to https://console.developers.google.com/
- create a new project 
- Make sure to activate Sheet Api for the project
    - Navigate to "Library"
    - Search "Google Sheets API" > Click on "Google Sheets API"
    - Click "Enable"
- Create a Service Account and credentials
    - Navigate to "Credentials"
    - Click "Create credentials" 
    - choose "Service Account key"
    - Choose A "New Service Account" in the "Service account" select
    - Choose a name. (ie. This is the name that will show up in the Spreadsheet history operations), "Editor" as role and "JSON" for the key type.
    - Save the credentials to 'resources/google/service-account.json' folder. (You can choose another name/folder if you want in your application folder)
    - Make sure to write down the service account email, you will need it later for the package configuration.               

### Spreadsheet
 - Create a blank/new spreadsheet here [https://docs.google.com/spreadsheets/](https://docs.google.com/spreadsheets/) .
 - Share it with the service account email with `Can edit` permission.

### Usage
   
  1/ Setup the spreadsheet 
   
 This need to be done only once.
   
 ```bash
 $ php artisan translation_sheet:setup
 ```  
   
 2/ Prepare the sheet
  
 To avoid some conflicts, we will first run this command to rewrite the locale languages files.
 
 ```bash
 $ php artisan translation_sheet:prepare
 ```  
   
 3/ Publish translation to sheet
 
 ```bash
 $ php artisan translation_sheet:push
 ```  
[Example](https://docs.google.com/spreadsheets/d/1RN-mKLb4wyx8yczOOA2gYMdqHreEEDKR7aDxBUzs9uc/edit#gid=0)

### Modules

 - Managers
 - Clients
 - Roles / Permissions
 - Reviews
 - Products
 - Filters
 - Product statuses
 - Pages
 - Page templates
 - Sliders / Banners
 - Menu management
 - Orders
 - Order statuses
 - Payment
 - Deliveries
 - Promocodes
 - SEO redirects
 - SEO robots
 - SEO scripts
 - SEO meta
 - SEO sitemap
 - Subscribes
 - Subscribers
 - Languages / Translations
 - Currencies
 - Regions
 - Backups
 - Settings 


### Features

 - Управление статическими переводами в гугл таблице
 - Гибкая настройка разделителей фильтров и управление их порядком( TODO в рамках отдельных категорий )
 - Фильтр в качестве параметра иcиспользуемого в корзине параметра (напр. разные размеры одежды (S,M,L...), цвет и объём памяти у телефонов)
 - Управление ролями пользователей и доступами к функциям админки
 - Управление статусами товаров ( с возможностью поменять лэйбу или цвет лэйбы )
 - Управление статусами заказов
 - Скачать EXCEL invoice одного заказа
 - Управление слайдерами
 - Управление Оплатами
 - Управление Доставками (возможность разделять на регионы, управление позицией, местами конкретной доставки, управление ценой с учетом мультивалютности)
 - Возможность выбора валюты для конкретной цены, будь то цена заказа, товара, доставки или промокода
 - Управление картой сайта, возможность ручной корректировки определенных позиций
 - Управление валютами/курсом
 - Управление регионами
 - Копирование товара
 - Сохранение корзины авторизованного пользователя
 - У всех картинок есть возможность указать альт и тайтл с учетом мультиязычности
 - Импорт курса валют с сервиса CURRENCYLAYER
 - Глобальное управление форматами дат
 - Глобальное управление кол-ом элементов пагинации
 - Глобальное управление размерами изображений
 - Авторизация/Регистрация через FB, GP, Instagram, Twitter
 - Dashboard
 - CI&CD
 - Админка покрыта автотестами
 - Соответствие СЕО 2.0. https://docs.google.com/document/d/1q5qlnHcmhLncwPQL_8yHmIX1Mf_pUnpSYN4i0-kkMqo/edit
 - Sentry мониторинг 500
 - Redis кеширование
 - QA Browser test
 - QA User stories
 - Умный поиск (автокомплит)
 - Новая почта
 - LiqPay
 - PayPay
 - Импорт/Экспорт товаров в EXEL
 - Экспорт заказов в EXEL
 - Импорт/Экспорт пользователей подписавшихся на рассылку в EXEL
 - Избраные товары
 - Похожие товары
 - Возможность залогинится от любого клиента
 - Группы товаров (возможность добавлять товар с разными характеристиками(например: цвет, размер), реализует возможность указания параметров(цена, описание, картинки и т.д.) с разным вариантами одного товара)
 - Групповое изменение параметров товара
 - Следить за ценой
 - Обрезка картинок и их кеширование
 - Отзывы
 - Рейтинг у товара, возможность проставить рейтинг вручнуи или тянуть с отзывов
 - Кнопка "Показать больше" в каталоге"# hydro-gid" 
