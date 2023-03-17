<?php

    Breadcrumbs::register('backend.dashboard', function($crumbs) {
        $crumbs->push(__('backend.dashboard'), route('backend.dashboard'));
    });

    Breadcrumbs::register('backend.templates.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.templates'), route('backend.templates.index'));
    });

    Breadcrumbs::register('backend.templates.create', function($crumbs) {
        $crumbs->parent('backend.templates.index');
        $crumbs->push(__('backend.create_template'), route('backend.templates.create'));
    });

    Breadcrumbs::register('backend.templates.edit', function($crumbs, $id) {
        $crumbs->parent('backend.templates.index');
        $crumbs->push(__('backend.edit_template'), route('backend.templates.edit', $id));
    });

    Breadcrumbs::register('backend.pages.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.pages'), route('backend.pages.index'));
    });

    Breadcrumbs::register('backend.pages.create', function($crumbs) {
        $crumbs->parent('backend.pages.index');
        $crumbs->push(__('backend.create_page'), route('backend.pages.create'));
    });

    Breadcrumbs::register('backend.pages.edit', function($crumbs, $id) {
        $crumbs->parent('backend.pages.index');
        $crumbs->push(__('backend.edit_page'), route('backend.pages.edit', $id));
    });

    Breadcrumbs::register('backend.seo-metas.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.seo_metatags'), route('backend.seo-metas.index'));
    });

    Breadcrumbs::register('backend.seo-metas.create', function($crumbs) {
        $crumbs->parent('backend.seo-metas.index');
        $crumbs->push(__('backend.seo_metatag_create'), route('backend.seo-metas.create'));
    });

    Breadcrumbs::register('backend.seo-metas.edit', function($crumbs, $id) {
        $crumbs->parent('backend.seo-metas.index');
        $crumbs->push(__('backend.seo_metatag_edit'), route('backend.seo-metas.edit', $id));
    });

    Breadcrumbs::register('backend.seo-redirects.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.redirects'), route('backend.seo-redirects.index'));
    });

    Breadcrumbs::register('backend.seo-redirects.create', function($crumbs) {
        $crumbs->parent('backend.seo-redirects.index');
        $crumbs->push(__('backend.redirect_create'), route('backend.seo-redirects.create'));
    });

    Breadcrumbs::register('backend.seo-redirects.edit', function($crumbs, $id) {
        $crumbs->parent('backend.seo-redirects.index');
        $crumbs->push(__('backend.redirect_edit'), route('backend.seo-redirects.edit', $id));
    });

    Breadcrumbs::register('backend.seo-scripts.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.scripts'), route('backend.seo-scripts.index'));
    });

    Breadcrumbs::register('backend.seo-scripts.edit', function($crumbs, $id) {
        $crumbs->parent('backend.seo-scripts.index');
        $crumbs->push(__('backend.seo_script_edit'), route('backend.seo-scripts.edit', $id));
    });

    Breadcrumbs::register('backend.seo-robots.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.robots'), route('backend.seo-robots.index'));
    });

    Breadcrumbs::register('backend.seo-robots.edit', function($crumbs, $id) {
        $crumbs->parent('backend.seo-scripts.index');
        $crumbs->push(__('backend.robots_txt_edit'), route('backend.seo-robots.edit', $id));
    });

    Breadcrumbs::register('backend.sitemap.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.seo-sitemap'), route('backend.sitemap.index'));
    });

    Breadcrumbs::register('backend.sitemap.edit', function($crumbs, $id) {
        $crumbs->parent('backend.sitemap.index');
        $crumbs->push(__('backend.seo-sitemap-edit'), route('backend.sitemap.edit', $id));
    });

    Breadcrumbs::register('backend.users.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.user_managment'), route('backend.users.index'));
    });

    Breadcrumbs::register('backend.users.create', function($crumbs) {
        $crumbs->parent('backend.users.index');
        $crumbs->push(__('backend.create_user'), route('backend.users.create'));
    });

    Breadcrumbs::register('backend.users.edit', function($crumbs, $id) {
        $crumbs->parent('backend.users.index');
        $crumbs->push(__('backend.edit_user'), route('backend.users.edit', $id));
    });

    Breadcrumbs::register('backend.users.show', function($crumbs, $id) {
        $crumbs->parent('backend.users.index');
        $crumbs->push(__('backend.show_user'), route('backend.users.show', $id));
    });

    Breadcrumbs::register('backend.roles.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.roles'), route('backend.roles.index'));
    });

    Breadcrumbs::register('backend.roles.create', function($crumbs) {
        $crumbs->parent('backend.roles.index');
        $crumbs->push(__('backend.create_new_role'), route('backend.roles.create'));
    });

    Breadcrumbs::register('backend.roles.edit', function($crumbs, $id) {
        $crumbs->parent('backend.roles.index');
        $crumbs->push(__('backend.edit_roles'), route('backend.roles.edit', $id));
    });

    Breadcrumbs::register('backend.roles.show', function($crumbs, $id) {
        $crumbs->parent('backend.roles.index');
        $crumbs->push(__('backend.role_show'), route('backend.roles.show', $id));
    });

    Breadcrumbs::register('backend.permissions.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.permissions'), route('backend.permissions.index'));
    });

    Breadcrumbs::register('backend.permissions.create', function($crumbs) {
        $crumbs->parent('backend.permissions.index');
        $crumbs->push(__('backend.create_new_permission'), route('backend.permissions.create'));
    });

    Breadcrumbs::register('backend.permissions.edit', function($crumbs, $id) {
        $crumbs->parent('backend.permissions.index');
        $crumbs->push(__('backend.edit_permission'), route('backend.permissions.edit', $id));
    });

    Breadcrumbs::register('backend.permissions.show', function($crumbs, $id) {
        $crumbs->parent('backend.permissions.index');
        $crumbs->push(__('backend.permission_show'), route('backend.permissions.show', $id));
    });

    Breadcrumbs::register('backend.faqs.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend/faq/index.faq'), route('backend.faqs.index'));
    });

    Breadcrumbs::register('backend.faqs.create', function($crumbs) {
        $crumbs->parent('backend.faqs.index');
        $crumbs->push(__('backend/faq/index.create_faq'), route('backend.faqs.create'));
    });

    Breadcrumbs::register('backend.faqs.edit', function($crumbs, $id) {
        $crumbs->parent('backend.faqs.index');
        $crumbs->push(__('backend/faq/index.edit_faq'), route('backend.faqs.edit', $id));
    });

    Breadcrumbs::register('backend.filters.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.filters'), route('backend.filters.index'));
    });

    Breadcrumbs::register('backend.filters.create', function($crumbs) {
        $crumbs->parent('backend.filters.index');
        $crumbs->push(__('backend.filter_create'), route('backend.filters.create'));
    });

    Breadcrumbs::register('backend.filters.edit', function($crumbs, $id) {
        $crumbs->parent('backend.filters.index');
        $crumbs->push(__('backend.filter_edit'), route('backend.filters.edit', $id));
    });

    Breadcrumbs::register('backend.products.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.products'), route('backend.products.index'));
    });

    Breadcrumbs::register('backend.products.create', function($crumbs) {
        $crumbs->parent('backend.products.index');
        $crumbs->push(__('backend.product_create_new'), route('backend.products.create'));
    });

    Breadcrumbs::register('backend.products.edit', function($crumbs, $id) {
        $crumbs->parent('backend.products.index');
        $crumbs->push(__('backend.product_edit'), route('backend.products.edit', $id));
    });

    Breadcrumbs::register('backend.orders.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.orders'), route('backend.orders.index'));
    });

    Breadcrumbs::register('backend.orders.create', function($crumbs) {
        $crumbs->parent('backend.orders.index');
        $crumbs->push(__('backend.order_create_new'), route('backend.orders.create'));
    });

    Breadcrumbs::register('backend.orders.edit', function($crumbs, $id) {
        $crumbs->parent('backend.orders.index');
        $crumbs->push(__('backend.order_edit'), route('backend.orders.edit', $id));
    });

    Breadcrumbs::register('backend.payments.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.payments'), route('backend.payments.index'));
    });

    Breadcrumbs::register('backend.payments.create', function($crumbs) {
        $crumbs->parent('backend.payments.index');
        $crumbs->push(__('backend.create_payment'), route('backend.payments.create'));
    });

    Breadcrumbs::register('backend.payments.edit', function($crumbs, $id) {
        $crumbs->parent('backend.payments.index');
        $crumbs->push(__('backend.edit_payment'), route('backend.payments.edit', $id));
    });

    Breadcrumbs::register('backend.deliveries.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.deliveries'), route('backend.deliveries.index'));
    });

    Breadcrumbs::register('backend.deliveries.create', function($crumbs) {
        $crumbs->parent('backend.deliveries.index');
        $crumbs->push(__('backend.create_delivery'), route('backend.deliveries.create'));
    });

    Breadcrumbs::register('backend.deliveries.edit', function($crumbs, $id) {
        $crumbs->parent('backend.deliveries.index');
        $crumbs->push(__('backend.edit_delivery'), route('backend.deliveries.edit', $id));
    });

    Breadcrumbs::register('backend.orders.statuses.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.order_status'), route('backend.orders.statuses.index'));
    });

    Breadcrumbs::register('backend.orders.statuses.create', function($crumbs) {
        $crumbs->parent('backend.orders.statuses.index');
        $crumbs->push(__('backend.order_status_create'), route('backend.orders.statuses.create'));
    });

    Breadcrumbs::register('backend.orders.statuses.edit', function($crumbs, $id) {
        $crumbs->parent('backend.orders.statuses.index');
        $crumbs->push(__('backend.order_status_edit'), route('backend.orders.statuses.edit', $id));
    });

    Breadcrumbs::register('backend.clients.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.clients'), route('backend.clients.index'));
    });

    Breadcrumbs::register('backend.clients.create', function($crumbs) {
        $crumbs->parent('backend.clients.index');
        $crumbs->push(__('backend.create_client'), route('backend.clients.create'));
    });

    Breadcrumbs::register('backend.clients.edit', function($crumbs, $id) {
        $crumbs->parent('backend.clients.index');
        $crumbs->push(__('backend.edit_client'), route('backend.clients.edit', $id));
    });

    Breadcrumbs::register('backend.products.statuses.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.product_status'), route('backend.products.statuses.index'));
    });

    Breadcrumbs::register('backend.products.statuses.create', function($crumbs) {
        $crumbs->parent('backend.products.statuses.index');
        $crumbs->push(__('backend.product_status_create'), route('backend.products.statuses.create'));
    });

    Breadcrumbs::register('backend.products.statuses.edit', function($crumbs, $id) {
        $crumbs->parent('backend.products.statuses.index');
        $crumbs->push(__('backend.product_status_edit'), route('backend.products.statuses.edit', $id));
    });

    Breadcrumbs::register('backend.promocodes.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.promocodes'), route('backend.promocodes.index'));
    });

    Breadcrumbs::register('backend.promocodes.create', function($crumbs) {
        $crumbs->parent('backend.promocodes.index');
        $crumbs->push(__('backend.promocode_create'), route('backend.promocodes.create'));
    });

    Breadcrumbs::register('backend.promocodes.edit', function($crumbs, $id) {
        $crumbs->parent('backend.promocodes.index');
        $crumbs->push(__('backend.promocode_edit'), route('backend.promocodes.edit', $id));
    });

    Breadcrumbs::register('backend.mail.templates.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.templates'), route('backend.mail.templates.index'));
    });

    Breadcrumbs::register('backend.mail.templates.create', function($crumbs) {
        $crumbs->parent('backend.mail.templates.index');
        $crumbs->push(__('backend.create_template'), route('backend.mail.templates.create'));
    });

    Breadcrumbs::register('backend.settings.regions.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.regions'), route('backend.settings.regions.index'));
    });

    Breadcrumbs::register('backend.settings.regions.create', function($crumbs) {
        $crumbs->parent('backend.settings.regions.index');
        $crumbs->push(__('backend.create_region'), route('backend.settings.regions.create'));
    });

    Breadcrumbs::register('backend.settings.regions.edit', function($crumbs, $id) {
        $crumbs->parent('backend.settings.regions.index');
        $crumbs->push(__('backend.edit_region'), route('backend.settings.regions.edit', $id));
    });

    Breadcrumbs::register('backend.mail.templates.edit', function($crumbs, $id) {
        $crumbs->parent('backend.mail.templates.index');
        $crumbs->push(__('backend.edit_template'), route('backend.mail.templates.edit', $id));
    });

    Breadcrumbs::register('backend.edit.main.template', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.edit_main_template'), route('backend.edit.main.template'));
    });

    Breadcrumbs::register('backend.mail.email.templates.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.mail_templates'), route('backend.mail.email.templates.index'));
    });

    Breadcrumbs::register('backend.mail.email.templates.create', function($crumbs) {
        $crumbs->parent('backend.mail.email.templates.index');
        $crumbs->push(__('backend.create_mail_template'), route('backend.mail.email.templates.create'));
    });

    Breadcrumbs::register('backend.mail.email.templates.edit', function($crumbs, $id) {
        $crumbs->parent('backend.mail.email.templates.index');
        $crumbs->push(__('backend.edit_mail_template'), route('backend.mail.email.templates.edit', $id));
    });

    Breadcrumbs::register('backend.subscribers.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.subscribers'), route('backend.subscribers.index'));
    });

    Breadcrumbs::register('backend.subscribers.settings', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.mail_settings'), route('backend.subscribers.settings'));
    });

    Breadcrumbs::register('backend.settings.currencies.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.currencies'), route('backend.settings.currencies.index'));
    });

    Breadcrumbs::register('backend.settings.currencies.create', function($crumbs) {
        $crumbs->parent('backend.settings.currencies.index');
        $crumbs->push(__('backend.currency_create'), route('backend.settings.currencies.create'));
    });

    Breadcrumbs::register('backend.settings.currencies.edit', function($crumbs, $id) {
        $crumbs->parent('backend.settings.currencies.index');
        $crumbs->push(__('backend.currency_edit'), route('backend.settings.currencies.edit', $id));
    });

    Breadcrumbs::register('backend.sliders.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.sliders'), route('backend.sliders.index'));
    });

    Breadcrumbs::register('backend.sliders.create', function($crumbs) {
        $crumbs->parent('backend.sliders.index');
        $crumbs->push(__('backend.slider_create'), route('backend.sliders.create'));
    });

    Breadcrumbs::register('backend.sliders.edit', function($crumbs, $id) {
        $crumbs->parent('backend.sliders.index');
        $crumbs->push(__('backend.slider_edit'), route('backend.sliders.edit', $id));
    });

    Breadcrumbs::register('backend.settings.global.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.settings'), route('backend.settings.global.index'));
    });

    Breadcrumbs::register('backend.settings.global.create', function($crumbs) {
        $crumbs->parent('backend.settings.global.index');
        $crumbs->push(__('backend.create_settings'), route('backend.settings.global.create'));
    });

    Breadcrumbs::register('backend.settings.global.edit', function($crumbs, $id) {
        $crumbs->parent('backend.settings.global.index');
        $crumbs->push(__('backend.edit_setting'), route('backend.settings.global.edit', $id));
    });

    Breadcrumbs::register('backend.settings.backups.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.backup'), route('backend.settings.backups.index'));
    });

    Breadcrumbs::register('backend.menus.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.menus'), route('backend.menus.index'));
    });

    Breadcrumbs::register('backend.menus.create', function($crumbs) {
        $crumbs->parent('backend.menus.index');
        $crumbs->push(__('backend.menu_create'), route('backend.menus.create'));
    });

    Breadcrumbs::register('backend.menus.edit', function($crumbs, $id) {
        $crumbs->parent('backend.menus.index');
        $crumbs->push(__('backend.menu_edit'), route('backend.menus.edit', $id));
    });

    Breadcrumbs::register('backend.menus.menu_items.create', function($crumbs, $menu) {
        $crumbs->parent('backend.menus.edit', ['menu' => $menu]);
        $crumbs->push(__('backend.menu_items_create'), route('backend.menus.menu_items.create', ['menu' => $menu]));
    });

    Breadcrumbs::register('backend.menus.menu_items.edit', function($crumbs, $menu, $menu_item) {
        $crumbs->parent('backend.menus.edit', ['menu' => $menu, 'menu_item' => $menu_item]);
        $crumbs->push(__('backend.menu_items_edit'), route('backend.menus.menu_items.edit', ['menu' => $menu, 'menu_item' => $menu_item]));
    });

    Breadcrumbs::register('backend.reviews.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend.reviews'), route('backend.reviews.index'));
    });

    Breadcrumbs::register('backend.reviews.create', function($crumbs) {
        $crumbs->parent('backend.reviews.index');
        $crumbs->push(__('backend.reviews_create'), route('backend.reviews.create'));
    });

    Breadcrumbs::register('backend.reviews.edit', function($crumbs, $id) {
        $crumbs->parent('backend.reviews.index');
        $crumbs->push(__('backend.reviews_edit'), route('backend.reviews.edit', $id));
    });

    Breadcrumbs::register('backend.service-orders.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend/service/index.service_order'), route('backend.service-orders.index'));
    });

    Breadcrumbs::register('backend.service-orders.create', function($crumbs) {
        $crumbs->parent('backend.service-orders.index');
        $crumbs->push(__('backend/service/index.create'), route('backend.service-orders.create'));
    });

    Breadcrumbs::register('backend.service-orders.edit', function($crumbs, $id) {
        $crumbs->parent('backend.service-orders.index');
        $crumbs->push(__('backend/service/index.edit'), route('backend.service-orders.edit', $id));
    });

    Breadcrumbs::register('backend.stocks.index', function($crumbs) {
        $crumbs->parent('backend.dashboard');
        $crumbs->push(__('backend/stocks/index.stocks'), route('backend.stocks.index'));
    });

    Breadcrumbs::register('backend.stocks.create', function($crumbs) {
        $crumbs->parent('backend.stocks.index');
        $crumbs->push(__('backend/stocks/index.create'), route('backend.stocks.create'));
    });

    Breadcrumbs::register('backend.stocks.edit', function($crumbs, $id) {
        $crumbs->parent('backend.stocks.index');
        $crumbs->push(__('backend/stocks/index.edit'), route('backend.stocks.edit', $id));
    });
