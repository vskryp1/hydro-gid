<?php

    Route::as('backend.')->prefix(env('BACKEND_URI'))->group(function () {
        Route::get('login', 'Backend\AuthController@showLoginForm')->name('login');
        Route::post('login', 'Backend\AuthController@login')->name('login');
        Route::any('logout', 'Backend\AuthController@logout')->name('logout');
        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('auth:admin');
        Route::middleware(['auth:admin', 'setLocale'])->group(function () {
            Route::any('adminer', '\Aranyasen\LaravelAdminer\AdminerAutologinController@index'); // adminer
            Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
            Route::put('/users/restore/{id}', 'Backend\Users\UsersController@restore')->name('users.restore');
            Route::resource('users', 'Backend\Users\UsersController')->parameter('', 'id')->except('show');
            Route::get('/password/change', 'Backend\ChangePasswordController@showChangePassForm')->name('users.show.change.pass');
            Route::post('/password/change', 'Backend\ChangePasswordController@changePassword')->name('users.change.pass');
            Route::get('/profile', 'Backend\Users\UsersController@profile')->name('users.profile');
            Route::put('/profile', 'Backend\Users\UsersController@updateProfile')->name('users.profile.update');
            Route::resource('roles', 'Backend\Users\RolesController')->parameter('', 'role');
            Route::resource('permissions', 'Backend\Users\PermissionsController');
            Route::get('search/model', 'Backend\DashboardController@searchByModel')->name('search.model')->middleware('ajax');
            Route::get('setlocale/{locale}', 'Backend\DashboardController@setLocale')->name('setLanguage');
            Route::get('clearCache', 'Backend\DashboardController@clearCache')->name('clearCache');
            Route::get('/', 'Backend\DashboardController@index')->name('dashboard');
            Route::group(['prefix' => 'subscribers', 'as' => 'subscribers.'], function () {
                Route::get('/', 'Backend\SubscribersController@index')
                    ->name('index')
                    ->middleware('permission:list newsletter');
                Route::get('settings', 'Backend\SubscribersController@settings')
                    ->name('settings')
                    ->middleware('permission:list subscribers');
                Route::put('settings', 'Backend\SubscribersController@setSettings')
                    ->name('settings.update')
                    ->middleware('permission:edit subscribers');
//                Route::get('start-newsletter', 'Backend\SubscribersController@startNewsLetter')
//                    ->name('newsletter.start')
//                    ->middleware('permission:start newsletter');
                Route::delete('{subscriber}/destroy', 'Backend\SubscribersController@destroy')
                    ->name('destroy')
                    ->middleware('permission:delete subscribers');
            });
            Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
                Route::resource('/statuses', 'Backend\Orders\OrderStatusController');
                Route::resource('/', 'Backend\Orders\OrderController')
                     ->parameter('', 'order')->except('show');
                Route::get('export/{order}', 'Backend\Orders\OrderController@export')
                     ->name('export');
                Route::get('index','Backend\Orders\OrdersBuyClickController@index')
                    ->name('order_buy_click');
                Route::post('/feedback/{order}', 'Backend\Orders\OrdersBuyClickController@markAsViewed')
                    ->name('feedback_viewed')->middleware('permission:list orders buy click');
            });
            Route::group(['prefix' => 'clients', 'as' => 'clients.'], function () {
                Route::resource('/{client}/addresses', 'Backend\Users\AddressController')
                    ->parameter('', 'client')
                    ->except(['index', 'show']);
                Route::get('/search', 'Backend\Users\ClientsController@search')
                    ->name('search')
                    ->middleware('ajax');
                Route::get('/addresses/{client}', 'Backend\Users\ClientsController@getAddresses')
                    ->name('addresses')
                    ->middleware('ajax');
                Route::resource('/', 'Backend\Users\ClientsController')
                    ->parameter('', 'client')
                    ->except(['show']);
                Route::put('/restore/{id}', 'Backend\Users\ClientsController@restore')
                    ->name('restore');
                Route::get('{client}/auth', 'Backend\Users\ClientsController@auth')->name('auth');
            });
            Route::group(['prefix' => 'filters', 'as' => 'filters.'], function () {
                Route::post('/categories', 'Backend\Filters\FiltersController@byCategories')->name('categories');
                Route::resource('/{filter}/values', 'Backend\Filters\ValuesController')->except(['index', 'show']);
                Route::resource('/', 'Backend\Filters\FiltersController')->parameter('', 'filter')->except('show');
            });
            Route::group(['prefix' => 'pages', 'as' => 'pages.'], function () {
                Route::get('/', 'Backend\Page\PageController@index')->name('index');
                Route::get('create', 'Backend\Page\PageController@create')->name('create');
                Route::post('/', 'Backend\Page\PageController@store')->name('store');
                Route::get('edit/{page}', 'Backend\Page\PageController@edit')->name('edit');
                Route::get('products/{page}', 'Backend\Page\PageController@pageProducts')->name('products');
                Route::post('updateSortProducts', 'Backend\Page\PageController@updateSortProducts')->name('update.product.sort');
                Route::get('resetSortProducts/{page}', 'Backend\Page\PageController@resetSortProducts')->name('reset.product.sort');
                Route::put('/{page}', 'Backend\Page\PageController@update')->name('update');
                Route::delete('/{page}', 'Backend\Page\PageController@destroy')->name('destroy');
                Route::post('updateSort', 'Backend\Page\PageController@updateSort')->name('update.sort');
                Route::post('updateParent', 'Backend\Page\PageController@updateParent')->name('update.parent');
                Route::get('restore/{page}', 'Backend\Page\PageController@restore')->name('restore');
	            Route::get('search', 'Backend\Page\PageController@search')->name('search')->middleware('ajax');
            });
            Route::group(['prefix' => 'additional-field'], function () {
                Route::post('/', 'Backend\Page\PageAdditionalFieldController@store')->name('additional-field.store');
                Route::get('/delete/{id}', 'Backend\Page\PageAdditionalFieldController@delete')->name('additional-field.delete');
            });
            Route::put('/templates/restore/{template}', 'Backend\Page\TemplateController@restore')->name('templates.restore');
            Route::resource('templates', 'Backend\Page\TemplateController');
            Route::group(['prefix' => 'import-export', 'as' => 'import-export.'], function () {
                Route::group(['prefix' => 'clients', 'as' => 'clients.'], function () {
                    Route::get('/', 'Backend\ImportExport\ImportExportClientController@index')->name('index');
                });
                Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
                    Route::get('/', 'Backend\ImportExport\ImportExportProductController@index')->name('index');
                });
                Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
                    Route::get('/', 'Backend\ImportExport\ImportExportOrderController@index')->name('index');
                    Route::post('/', 'Backend\ImportExport\ImportExportOrderController@export')->name('export');
                });
            });
            Route::group(['prefix' => 'export', 'as' => 'export.'], function () {
                Route::get('products', 'Backend\ExportController@products')->name('products');
                Route::get('clients', 'Backend\ExportController@clients')->name('clients');
            });
            Route::group(['prefix' => 'import', 'as' => 'import.'], function () {
                Route::post('products', 'Backend\ImportController@products')->name('products');
                Route::put('product/headers', 'Backend\ImportController@productHeaders')->name('product.headers');
            });
            Route::resource('reviews', 'Backend\Review\ReviewController')->except(['show']);
            Route::resource('service-orders', 'Backend\Orders\ServiceOrderController')->except(['show']);
            Route::resource('seo-redirects', 'Backend\Seo\SeoRedirectsController');
            Route::resource('sitemap', 'Backend\Seo\SitemapController')->except(['show']);
            Route::get('sitemap/entities', 'Backend\Seo\SitemapController@getEntities')->name('sitemap.getEntities');
            Route::get('sitemap/generate', 'Backend\Seo\SitemapController@generate')->name('sitemap.generate');
            Route::resource('seo-metas', 'Backend\Seo\SeoMetasController');
            Route::group(['prefix' => 'seo-robots', 'as' => 'seo-robots.'], function () {
                Route::get('/', 'Backend\Seo\SeoRobotsController@index')
                    ->name('index')
                    ->middleware('permission:list seo robots');
                Route::put('update', 'Backend\Seo\SeoRobotsController@update')
                    ->name('update')
                    ->middleware('permission:edit seo robots');
            });
            Route::group(['prefix' => 'seo-scripts', 'as' => 'seo-scripts.'], function () {
                Route::get('/', 'Backend\Seo\SeoScriptsController@index')
                    ->name('index')->middleware('permission:list seo scripts');
                Route::put('update', 'Backend\Seo\SeoScriptsController@update')
                    ->name('update')->middleware('permission:edit seo scripts');
            });
            Route::group(['prefix' => 'mail', 'as' => 'mail.'], function () {
                Route::resource('templates', 'Backend\Templates\TemplatesController')->except(['show']);
                Route::group(['prefix' => 'email', 'as' => 'email.'], function () {
                    Route::resource('templates', 'Backend\Templates\MailTemplatesController')->except(['show']);
                });
                Route::get('start-newsletter/{template}', 'Backend\Templates\MailTemplatesController@startNewsLetter')->name('newsletter.start');
            });
            Route::get('edit-main-template', 'Backend\Templates\TemplatesController@editMainTemplate')->name('edit.main.template');
            Route::put('edit-main-template', 'Backend\Templates\TemplatesController@updateMainTemplate')->name('update.main.template');
            Route::resource('faqs', 'Backend\Faq\FaqController');
            Route::group(['prefix' => 'deliveries', 'as' => 'deliveries.'], function () {
                Route::resource('/{delivery}/delivery_places', 'Backend\Orders\DeliveryPlaceController')->except(['index', 'show']);
                Route::resource('/', 'Backend\Orders\DeliveryController')->except(['show'])->parameter('', 'delivery');
            });
            Route::resource('payments', 'Backend\Orders\PaymentController')->except(['show']);

            Route::group(['prefix' => 'products', 'as' => 'products.', 'namespace' => 'Backend\Products'], function () {
                Route::resource('statuses', 'StatusesController')->except(['show']);
                Route::resource('{product}/warranty', 'ProductWarrantyController')->except(['show', 'index']);
                Route::resource('', 'ProductsController')->parameter('', 'product')->except(['show']);
                Route::post('copy/{product}', 'ProductsController@copy')->name('copy');
                Route::post('gallery/{product}', 'ProductsController@galleryUpload')->name('gallery');
                Route::get('search', 'ProductsController@search')->name('search')->middleware('ajax');
                Route::prefix('group')->as('group.')->group(function () {
                    Route::get('{product}', 'ProductsController@groupEdit')->name('edit');
                    Route::post('{product}', 'ProductsController@groupUpdate')->name('update');
                    Route::post('remove/{product}/{parent?}', 'ProductsController@removeGroup')
                         ->name('remove')->middleware('ajax');
                });
                Route::post('copy/{product}', 'ProductsController@copy')->name('copy');
            });

            Route::resource('promocodes', 'Backend\Orders\PromocodesController');
            Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
                Route::resource('global', 'Backend\Settings\SettingsController');
                Route::group(['prefix' => 'backups', 'as' => 'backups.'], function () {
                    Route::get('/', 'Backend\Settings\BackupController@index')->name('index');
                    Route::post('/', 'Backend\Settings\BackupController@store')->name('store');
                    Route::get('/download/{filename}', 'Backend\Settings\BackupController@download')->name('download');
                    Route::get('/make', 'Backend\Settings\BackupController@make')->name('make');
                    Route::get('/clear', 'Backend\Settings\BackupController@clear')->name('clear');
                });
                Route::resource('currencies', 'Backend\Settings\CurrencyController')->except(['show']);
                Route::group(['prefix' => 'currencies', 'as' => 'currencies.'], function () {
                    Route::get('actual/courses', 'Backend\Settings\CurrencyController@actualCourses')
                        ->name('actual.courses')->middleware('permission:actual courses');
                });
                Route::group(['prefix' => 'translations'], function () {
                    Route::get('/{groupKey?}', 'Backend\Settings\TranslationController@index')
                        ->name('translations.index')->middleware('permission:manage translations');
                    Route::get('view/{groupKey?}', 'Backend\Settings\TranslationController@index')
                        ->name('translations.view')->middleware('permission:manage translations');
                    Route::post('locales/add', 'Backend\Settings\TranslationController@postAddLocale')
                        ->name('locale.add')->middleware('permission:manage languages');
                    Route::post('locales/remove', 'Backend\Settings\TranslationController@postRemoveLocale')
                        ->name('locale.remove')->middleware('permission:manage languages');
                    Route::post('gs/import', 'Backend\Settings\TranslationController@gsImport')
                        ->name('gs.import')->middleware('permission:publish translations');
                    Route::post('gs/export', 'Backend\Settings\TranslationController@gsExport')
                        ->name('gs.export')->middleware('permission:publish translations');
                });
                Route::resource('regions', 'Backend\Settings\RegionController');
            });
            Route::group(['prefix' => 'sliders', 'as' => 'sliders.'], function () {
                Route::resource('/{slider}/slider_items', 'Backend\Sliders\SliderItemsController')->except(['index', 'show']);
                Route::resource('/', 'Backend\Sliders\SlidersController')->parameter('', 'slider');
            });
            Route::group(['prefix' => 'menus', 'as' => 'menus.'], function () {
                Route::resource('/{menu}/menu_items', 'Backend\Menus\MenuItemsController')->except(['index', 'show']);
                Route::post('/{menu}/menu_items/updateSort', 'Backend\Menus\MenuItemsController@updateSort')->name('menu_items.update.sort');
                Route::resource('/', 'Backend\Menus\MenusController')->parameter('', 'menu');
            });

            Route::resource('/stocks', 'Backend\Products\StockController')->except(['show']);
            Route::resource('warranties', 'Backend\WarrantiesController')->except(['show']);
        });
    });
